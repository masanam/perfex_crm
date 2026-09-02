#!/bin/bash
# ============================================
# Script Bersihkan Disk Ubuntu - Enhanced
# by: Digivla Indonesia
# Version: 2.0
# Usage: sudo bash disk-cleanup.sh [--dry-run] [--force]
# ============================================

# --- Config ---
LOG_FILE="/var/log/disk-cleanup.log"
MAX_LOG_AGE_DAYS=7
MAX_TMP_AGE_DAYS=7
MAX_CORE_DUMPS=0         # 0 = hapus semua core dumps
DOCKER_PRUNE=true
SNAP_CLEANUP=true
PIP_CACHE_CLEANUP=true
NPM_CACHE_CLEANUP=true

# --- Flags ---
DRY_RUN=false
FORCE=false

for arg in "$@"; do
  case $arg in
    --dry-run) DRY_RUN=true ;;
    --force)   FORCE=true ;;
  esac
done

# --- Colors ---
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
CYAN='\033[0;36m'
BOLD='\033[1m'
NC='\033[0m'

# --- Helper Functions ---
log() {
  local msg="[$(date '+%Y-%m-%d %H:%M:%S')] $1"
  echo -e "$msg"
  echo "$msg" >> "$LOG_FILE" 2>/dev/null
}

section() {
  echo ""
  echo -e "${CYAN}${BOLD}━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━${NC}"
  echo -e "${YELLOW}${BOLD}  $1${NC}"
  echo -e "${CYAN}${BOLD}━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━${NC}"
}

run_cmd() {
  if [ "$DRY_RUN" = true ]; then
    echo -e "  ${CYAN}[DRY-RUN] $*${NC}"
  else
    eval "$@"
  fi
}

bytes_to_human() {
  local bytes=$1
  if   [ "$bytes" -ge $((1024*1024*1024)) ]; then echo "$((bytes/1024/1024/1024)) GB"
  elif [ "$bytes" -ge $((1024*1024)) ];      then echo "$((bytes/1024/1024)) MB"
  elif [ "$bytes" -ge 1024 ];                then echo "$((bytes/1024)) KB"
  else echo "${bytes} B"
  fi
}

# --- Root Check ---
if [ "$EUID" -ne 0 ]; then
  echo -e "${RED}[ERROR] Script ini harus dijalankan sebagai root (sudo).${NC}"
  exit 1
fi

# --- Dry Run Notice ---
if [ "$DRY_RUN" = true ]; then
  echo -e "${CYAN}${BOLD}[DRY-RUN MODE] Tidak ada perubahan nyata yang dilakukan.${NC}"
fi

# ============================================================
# SNAPSHOT AWAL
# ============================================================
section "📊 KONDISI DISK SEBELUM CLEANUP"
df -h /
echo ""
df -h / | awk 'NR==2 {printf "  Used: %s / %s (%s)\n", $3, $2, $5}'

BEFORE_KB=$(df / | awk 'NR==2 {print $3}')
START_TIME=$(date +%s)

# ============================================================
# [1] APT CLEANUP
# ============================================================
section "🔧 [1/9] APT Package Cleanup"

log "Menjalankan apt-get autoremove..."
run_cmd "apt-get autoremove -y 2>&1 | tail -5"

log "Membersihkan APT cache..."
run_cmd "apt-get clean"
run_cmd "apt-get autoclean 2>&1 | tail -3"

APT_CACHE_SIZE=$(du -sb /var/cache/apt/archives/ 2>/dev/null | awk '{print $1}')
log "APT cache sekarang: $(bytes_to_human ${APT_CACHE_SIZE:-0})"

# ============================================================
# [2] JOURNAL / LOG CLEANUP
# ============================================================
section "📋 [2/9] Bersihkan System Logs & Journal"

log "Vacuum journal (simpan max 7 hari / 100MB)..."
run_cmd "journalctl --vacuum-time=${MAX_LOG_AGE_DAYS}d 2>&1"
run_cmd "journalctl --vacuum-size=100M 2>&1"

log "Hapus rotated log files lama..."
for ext in "*.gz" "*.1" "*.2" "*.3" "*.old" "*.bak"; do
  COUNT=$(find /var/log -type f -name "$ext" 2>/dev/null | wc -l)
  [ "$COUNT" -gt 0 ] && log "  Hapus $COUNT file $ext"
  run_cmd "find /var/log -type f -name '$ext' -delete 2>/dev/null"
done

log "Truncate log aktif yang > 50MB..."
find /var/log -type f -name "*.log" -size +50M 2>/dev/null | while read -r f; do
  log "  Truncate besar: $f ($(du -sh "$f" 2>/dev/null | cut -f1))"
  run_cmd "> '$f'"
done

# ============================================================
# [3] TEMP FILES
# ============================================================
section "🗑️  [3/9] Hapus File Temporary"

log "Hapus /tmp lebih dari ${MAX_TMP_AGE_DAYS} hari..."
TMP_COUNT=$(find /tmp -maxdepth 3 -type f -mtime +${MAX_TMP_AGE_DAYS} 2>/dev/null | wc -l)
log "  Ditemukan: $TMP_COUNT file lama di /tmp"
run_cmd "find /tmp -maxdepth 3 -type f -mtime +${MAX_TMP_AGE_DAYS} -delete 2>/dev/null"
run_cmd "find /tmp -maxdepth 3 -type d -empty -mtime +${MAX_TMP_AGE_DAYS} -delete 2>/dev/null"

log "Hapus /var/tmp lebih dari 14 hari..."
run_cmd "find /var/tmp -type f -mtime +14 -delete 2>/dev/null"

# ============================================================
# [4] USER CACHE CLEANUP
# ============================================================
section "💾 [4/9] Bersihkan User Cache"

clean_cache_dir() {
  local dir="$1"
  local label="$2"
  if [ -d "$dir" ]; then
    local size
    size=$(du -sb "$dir" 2>/dev/null | awk '{print $1}')
    log "  Hapus $label: $(bytes_to_human ${size:-0})"
    run_cmd "rm -rf '$dir'"
  fi
}

# Thumbnail cache
for d in /root /home/*; do
  clean_cache_dir "$d/.cache/thumbnails" "thumbnails ($d)"
done

# Pip cache
if [ "$PIP_CACHE_CLEANUP" = true ]; then
  for d in /root /home/*; do
    clean_cache_dir "$d/.cache/pip" "pip cache ($d)"
  done
fi

# NPM cache
if [ "$NPM_CACHE_CLEANUP" = true ]; then
  for d in /root /home/*; do
    clean_cache_dir "$d/.npm" "npm cache ($d)"
    clean_cache_dir "$d/.cache/yarn" "yarn cache ($d)"
  done
fi

# Composer cache
for d in /root /home/*; do
  clean_cache_dir "$d/.composer/cache" "composer cache ($d)"
done

# ============================================================
# [5] CORE DUMPS
# ============================================================
section "💥 [5/9] Hapus Core Dumps"

CORE_COUNT=$(find / -maxdepth 5 -name "core" -o -name "core.*" 2>/dev/null | grep -v proc | wc -l)
log "Ditemukan $CORE_COUNT core dump files"
run_cmd "find / -maxdepth 5 \( -name 'core' -o -name 'core.*' \) ! -path '*/proc/*' -delete 2>/dev/null"
# Systemd coredump
run_cmd "rm -rf /var/lib/systemd/coredump/* 2>/dev/null"

# ============================================================
# [6] SNAP CLEANUP
# ============================================================
section "📦 [6/9] Snap Packages Cleanup"

if [ "$SNAP_CLEANUP" = true ] && command -v snap &>/dev/null; then
  DISABLED=$(snap list --all 2>/dev/null | awk '/disabled/{print $1, $3}')
  if [ -z "$DISABLED" ]; then
    log "Tidak ada snap revision lama yang disabled."
  else
    echo "$DISABLED" | while read -r pkg rev; do
      log "  Remove snap: $pkg revision $rev"
      run_cmd "snap remove '$pkg' --revision='$rev' 2>/dev/null"
    done
  fi
  # Snap cache
  run_cmd "rm -rf /var/lib/snapd/cache/* 2>/dev/null"
  log "Snap cache dibersihkan."
else
  log "Snap tidak terinstall atau dinonaktifkan."
fi

# ============================================================
# [7] DOCKER CLEANUP
# ============================================================
section "🐳 [7/9] Docker Cleanup"

if [ "$DOCKER_PRUNE" = true ] && command -v docker &>/dev/null; then
  log "Docker ditemukan. Prune dangling resources..."
  run_cmd "docker image prune -f 2>&1 | tail -3"
  run_cmd "docker container prune -f 2>&1 | tail -2"
  run_cmd "docker volume prune -f 2>&1 | tail -2"
  run_cmd "docker network prune -f 2>&1 | tail -2"

  DOCKER_SIZE=$(docker system df 2>/dev/null | awk '/Total Space/{print $NF}' | tail -1)
  [ -n "$DOCKER_SIZE" ] && log "  Docker total size: $DOCKER_SIZE"
else
  log "Docker tidak terinstall atau dinonaktifkan."
fi

# ============================================================
# [8] OLD KERNEL CLEANUP
# ============================================================
section "🐧 [8/9] Old Kernel Cleanup"

CURRENT_KERNEL=$(uname -r)
log "Kernel aktif: $CURRENT_KERNEL"

OLD_KERNELS=$(dpkg -l 'linux-image-[0-9]*' 2>/dev/null | awk '/^ii/{print $2}' | grep -v "$CURRENT_KERNEL")
KERNEL_COUNT=$(echo "$OLD_KERNELS" | grep -c "linux-image" 2>/dev/null || echo 0)

if [ "$KERNEL_COUNT" -gt 0 ] && [ "$FORCE" = true ]; then
  log "Menghapus $KERNEL_COUNT kernel lama (--force aktif)..."
  echo "$OLD_KERNELS" | while read -r k; do
    log "  Hapus kernel: $k"
    run_cmd "apt-get purge -y '$k' 2>/dev/null"
  done
  run_cmd "update-grub 2>/dev/null"
elif [ "$KERNEL_COUNT" -gt 0 ]; then
  log "  Ditemukan $KERNEL_COUNT kernel lama:"
  echo "$OLD_KERNELS" | while read -r k; do log "    - $k"; done
  log "  Gunakan --force untuk menghapus kernel lama."
else
  log "Tidak ada kernel lama yang perlu dihapus."
fi

# ============================================================
# [9] ORPHANED PACKAGES & DEBCONF
# ============================================================
section "🧹 [9/9] Orphaned Packages & Misc"

# Hapus debconf db backup
run_cmd "rm -f /var/cache/debconf/*.dat-old 2>/dev/null"

# Hapus thumbnail database (chromium, etc)
run_cmd "find /home -name 'Thumbs.db' -delete 2>/dev/null"
run_cmd "find /home -name '.DS_Store' -delete 2>/dev/null"

# Hapus .bash_history > 10MB
find /root /home/* -name ".bash_history" -size +10M 2>/dev/null | while read -r f; do
  log "  Truncate $f (terlalu besar)"
  run_cmd "> '$f'"
done

log "Misc cleanup selesai."

# ============================================================
# ANALISIS SETELAH CLEANUP
# ============================================================
section "📊 KONDISI DISK SESUDAH CLEANUP"
df -h /
echo ""

AFTER_KB=$(df / | awk 'NR==2 {print $3}')
FREED_KB=$((BEFORE_KB - AFTER_KB))
END_TIME=$(date +%s)
ELAPSED=$((END_TIME - START_TIME))

echo -e ""
echo -e "${GREEN}${BOLD}╔════════════════════════════════════════╗${NC}"
echo -e "${GREEN}${BOLD}║           RINGKASAN CLEANUP            ║${NC}"
echo -e "${GREEN}${BOLD}╚════════════════════════════════════════╝${NC}"
echo -e "${GREEN}  ✅ Ruang dibebaskan : $(bytes_to_human $((FREED_KB * 1024)))${NC}"
echo -e "${GREEN}  ⏱  Waktu eksekusi  : ${ELAPSED} detik${NC}"
echo -e "${GREEN}  📝 Log tersimpan   : $LOG_FILE${NC}"
if [ "$DRY_RUN" = true ]; then
  echo -e "${CYAN}  ⚠️  Mode DRY-RUN   : Tidak ada file yang dihapus${NC}"
fi
echo ""

# ============================================================
# TOP FOLDER BESAR
# ============================================================
section "📁 TOP 20 FOLDER TERBESAR DI SISTEM"

# Exclude virtual/pseudo filesystems yang bisa hang atau tidak relevan
DU_EXCLUDES=(
  --exclude=/proc
  --exclude=/sys
  --exclude=/dev
  --exclude=/run
  --exclude=/snap
)

echo -e "${CYAN}  Scanning... (skip /proc /sys /dev /run /snap)${NC}"
du -x -sh "${DU_EXCLUDES[@]}" /* 2>/dev/null | sort -rh | head -20
# Flag -x = stay on same filesystem, mencegah cross-mount hang

echo ""
echo -e "${YELLOW}--- Detail /var ---${NC}"
du -x -sh /var/* 2>/dev/null | sort -rh | head -10

echo ""
echo -e "${YELLOW}--- Detail /home ---${NC}"
du -x -sh /home/* 2>/dev/null | sort -rh | head -10

echo ""
echo -e "${YELLOW}--- Detail /var/log ---${NC}"
du -x -sh /var/log/* 2>/dev/null | sort -rh | head -10

echo ""
echo -e "${YELLOW}--- Detail /var/lib (top 10) ---${NC}"
du -x -sh /var/lib/* 2>/dev/null | sort -rh | head -10

echo ""
log "=== CLEANUP SELESAI ==="