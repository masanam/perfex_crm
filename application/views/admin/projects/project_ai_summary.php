<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div class="panel_s">
    <div class="panel-body">
        <div class="tw-flex tw-justify-between tw-items-center tw-mb-4 tw-pb-4 tw-border-b tw-border-neutral-200">
            <div>
                <h4 class="tw-font-bold tw-text-lg tw-text-neutral-800 tw-m-0 tw-flex tw-items-center">
                    <i class="fa-solid fa-robot tw-text-indigo-600 tw-mr-2"></i>
                    AI Executive Summary
                    <span class="label label-info tw-ml-2 tw-text-xs" id="ai_model_badge"><?php echo !empty($project->ai_summary_model) ? $project->ai_summary_model : 'qwen2.5:7b'; ?></span>
                </h4>
                <p class="tw-text-xs tw-text-neutral-500 tw-m-0 tw-mt-1" id="ai_summary_time_label">
                    <?php if (!empty($project->ai_summary_last_updated)) { ?>
                        Terakhir diperbarui: <?php echo _dt($project->ai_summary_last_updated); ?>
                    <?php } else { ?>
                        Belum ada ringkasan AI yang dihasilkan.
                    <?php } ?>
                </p>
            </div>
            <div>
                <button type="button" class="btn btn-primary" id="generate_ai_summary_btn" onclick="triggerGenerateAiSummary(); return false;">
                    <i class="fa-solid fa-wand-magic-sparkles tw-mr-1"></i>
                    <span id="generate_ai_btn_text">Generate AI Summary</span>
                </button>
            </div>
        </div>

        <!-- Loading indicator -->
        <div id="ai_summary_loading" class="hide tw-p-8 tw-text-center tw-bg-indigo-50 tw-rounded-xl tw-my-4">
            <i class="fa-solid fa-circle-notch fa-spin fa-2x tw-text-indigo-600 tw-mb-3"></i>
            <p class="tw-font-semibold tw-text-indigo-900 tw-m-0">AI sedang menganalisis proyek...</p>
            <small class="tw-text-indigo-600">Model <strong id="ai_loading_model">qwen2.5:7b</strong> sedang memproses data task, milestone, dan personil. Harap tunggu.</small>
            <div class="tw-mt-3">
                <div class="progress" style="height:6px; background:#c7d2fe;">
                    <div class="progress-bar progress-bar-striped active" role="progressbar" style="width:100%; background:#6366f1;"></div>
                </div>
            </div>
        </div>

        <!-- Content area -->
        <div id="ai_summary_content" class="tc-content tw-prose tw-max-w-none">
            <?php if (!empty($project->ai_summary)) {
                $Parsedown = new Parsedown();
                echo $Parsedown->text($project->ai_summary);
            } else { ?>
                <div class="text-center text-muted tw-py-12" id="ai_summary_empty_state">
                    <i class="fa-solid fa-brain fa-3x tw-mb-3 tw-opacity-30"></i>
                    <p class="tw-m-0 tw-text-sm">Klik tombol <strong>"Generate AI Summary"</strong> di atas untuk menghasilkan rekapitulasi cerdas, analisis risiko, serta rekomendasi tindakan untuk personil proyek ini.</p>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<script>
(function() {
    var _aiSummaryPollTimer = null;
    var _pid = typeof project_id !== 'undefined' ? project_id : '<?php echo (int)$project->id; ?>';

    function setLoading(isLoading) {
        var $btn = $('#generate_ai_summary_btn');
        if (isLoading) {
            $btn.prop('disabled', true).addClass('disabled');
            $('#generate_ai_btn_text').text('Menganalisis...');
            $('#ai_summary_loading').removeClass('hide');
            $('#ai_summary_content').css('opacity', '0.4');
        } else {
            $btn.prop('disabled', false).removeClass('disabled');
            $('#generate_ai_btn_text').text('Generate AI Summary');
            $('#ai_summary_loading').addClass('hide');
            $('#ai_summary_content').css('opacity', '1');
        }
    }

    function pollStatus() {
        $.getJSON(admin_url + 'projects/get_ai_summary_status/' + _pid, function(data) {
            if (data.status === 'done') {
                clearInterval(_aiSummaryPollTimer);
                _aiSummaryPollTimer = null;
                setLoading(false);
                $('#ai_summary_content').html(data.summary_html);
                $('#ai_summary_empty_state').remove();
                $('#ai_summary_time_label').html('Terakhir diperbarui: ' + data.last_updated);
                if (data.model_used) { $('#ai_model_badge').text(data.model_used); }
                alert_float('success', 'AI Summary berhasil diperbarui!');
            } else if (data.status === 'error') {
                clearInterval(_aiSummaryPollTimer);
                _aiSummaryPollTimer = null;
                setLoading(false);
                alert_float('danger', data.message || 'AI gagal menganalisis proyek. Silakan coba lagi.');
            }
            // if 'processing', keep polling
        }).fail(function() {
            // network hiccup — keep polling, don't stop
        });
    }

    window.triggerGenerateAiSummary = function() {
        if (_aiSummaryPollTimer) return; // already running

        setLoading(true);

        var postData = {};
        if (typeof csrfData !== 'undefined') {
            postData[csrfData.token_name] = csrfData.hash;
        }

        $.post(admin_url + 'projects/generate_ai_summary/' + _pid, postData)
            .done(function(response) {
                var data = typeof response === 'string' ? JSON.parse(response) : response;
                if (data && (data.status === 'processing' || data.success)) {
                    // Start polling every 2 seconds
                    _aiSummaryPollTimer = setInterval(pollStatus, 2000);
                } else {
                    setLoading(false);
                    alert_float('danger', (data && data.message) ? data.message : 'Gagal memulai analisis AI.');
                }
            })
            .fail(function(xhr) {
                setLoading(false);
                alert_float('danger', 'Error: ' + (xhr.responseText || 'Gagal menghubungi server.'));
            });
    };

    // If page loads with status=processing, auto-start polling
    <?php if (isset($project->ai_summary_status) && $project->ai_summary_status === 'processing') { ?>
    $(function() {
        setLoading(true);
        _aiSummaryPollTimer = setInterval(pollStatus, 2000);
    });
    <?php } ?>
}());
</script>
