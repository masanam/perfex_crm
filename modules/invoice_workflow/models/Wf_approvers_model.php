<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Wf_approvers_model
 *
 * Manajemen konfigurasi pejabat berwenang per role workflow.
 *
 * @package invoice_workflow
 */
class Wf_approvers_model extends App_Model
{
    /**
     * Daftar role yang dikenali sistem.
     */
    public const VALID_ROLES = [
        'ap_receiver',
        'tax',
        'treasury',
        'senior_manager',
        'gm_finance',
    ];

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Ambil semua approver aktif, join dengan data staff.
     */
    public function getAll(bool $activeOnly = true): array
    {
        $this->db->select(
            db_prefix() . 'wf_approvers.*, ' .
            db_prefix() . 'wf_approvers.role_slug as role, ' .
            db_prefix() . 'wf_approvers.amount_min as min_amount, ' .
            db_prefix() . 'wf_approvers.amount_max as max_amount, ' .
            'staff.firstname, ' .
            'staff.lastname, ' .
            'staff.email, ' .
            'CONCAT(staff.firstname, " ", staff.lastname) as staff_name, ' .
            'staff.email as staff_email'
        );
        $this->db->from(db_prefix() . 'wf_approvers');
        $this->db->join(db_prefix() . 'staff staff', 'staff.staffid = ' . db_prefix() . 'wf_approvers.staff_id', 'left');

        if ($activeOnly) {
            $this->db->where(db_prefix() . 'wf_approvers.is_active', 1);
        }

        $this->db->order_by(db_prefix() . 'wf_approvers.role_slug', 'ASC');

        $query = $this->db->get();

        return $query ? $query->result_array() : [];
    }

    /**
     * Ambil satu approver berdasarkan ID.
     */
    public function getById(int $id): ?object
    {
        $this->db->where('id', $id);
        $query = $this->db->get(db_prefix() . 'wf_approvers');
        return ($query && $query->num_rows() > 0) ? $query->row() : null;
    }

    /**
     * Ambil semua role yang dimiliki seorang staff.
     *
     * @return string[]  Array of role slugs
     */
    public function getRolesByStaff(int $staffId): array
    {
        $this->db->select('role_slug');
        $this->db->where('staff_id', $staffId);
        $this->db->where('is_active', 1);
        $query = $this->db->get(db_prefix() . 'wf_approvers');
        $rows  = $query ? $query->result() : [];

        return array_column($rows, 'role_slug');
    }

    /**
     * Ambil approver aktif untuk role tertentu.
     * Jika amount diberikan, filter juga berdasarkan amount_min/amount_max.
     */
    public function getByRole(string $roleSlug, ?float $amount = null): array
    {
        $this->db->select(
            db_prefix() . 'wf_approvers.staff_id, ' .
            db_prefix() . 'wf_approvers.role_slug, ' .
            'CONCAT(staff.firstname, " ", staff.lastname) as staff_name, ' .
            'staff.email as staff_email'
        );
        $this->db->from(db_prefix() . 'wf_approvers');
        $this->db->join(db_prefix() . 'staff staff', 'staff.staffid = ' . db_prefix() . 'wf_approvers.staff_id', 'left');
        $this->db->where(db_prefix() . 'wf_approvers.role_slug', $roleSlug);
        $this->db->where(db_prefix() . 'wf_approvers.is_active', 1);

        if ($amount !== null) {
            $this->db->group_start();
            $this->db->where(db_prefix() . 'wf_approvers.amount_min IS NULL OR ' . db_prefix() . 'wf_approvers.amount_min <=', $amount, false);
            $this->db->group_end();

            $this->db->group_start();
            $this->db->where(db_prefix() . 'wf_approvers.amount_max IS NULL OR ' . db_prefix() . 'wf_approvers.amount_max >=', $amount, false);
            $this->db->group_end();
        }

        $query = $this->db->get();

        return $query ? $query->result() : [];
    }

    /**
     * Simpan approver baru atau update yang sudah ada.
     *
     * @param  array     $data  ['staff_id', 'role_slug', 'amount_min', 'amount_max', 'notes']
     * @param  int|null  $id    Jika null = insert, jika ada = update
     * @return int|bool  ID jika insert, true jika update, false jika gagal
     */
    public function save(array $data, ?int $id = null): int|bool
    {
        // Validasi role
        if (!in_array($data['role_slug'] ?? '', self::VALID_ROLES, true)) {
            return false;
        }

        // Sanitize amount
        $data['amount_min'] = !empty($data['amount_min']) ? (float) $data['amount_min'] : null;
        $data['amount_max'] = !empty($data['amount_max']) ? (float) $data['amount_max'] : null;

        if ($id) {
            $this->db->where('id', $id);
            $this->db->update(db_prefix() . 'wf_approvers', $data);
            return $this->db->affected_rows() > 0;
        }

        $data['created_by'] = get_staff_user_id();
        $data['created_at'] = date('Y-m-d H:i:s');
        $this->db->insert(db_prefix() . 'wf_approvers', $data);
        return (int) $this->db->insert_id();
    }

    /**
     * Toggle active/inactive.
     */
    public function toggleActive(int $id): bool
    {
        $this->db->set('is_active', 'IF(is_active=1, 0, 1)', false);
        $this->db->where('id', $id);
        $this->db->update(db_prefix() . 'wf_approvers');
        return $this->db->affected_rows() > 0;
    }

    /**
     * Hapus approver.
     */
    public function delete(int $id): bool
    {
        $this->db->where('id', $id);
        $this->db->delete(db_prefix() . 'wf_approvers');
        return $this->db->affected_rows() > 0;
    }
}
