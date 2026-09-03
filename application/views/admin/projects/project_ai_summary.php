<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div class="panel_s">
    <div class="panel-body">
        <div class="tw-flex tw-flex-wrap tw-justify-between tw-items-center tw-gap-3 tw-mb-4 tw-pb-4 tw-border-b tw-border-neutral-200">
            <div>
                <h4 class="tw-font-bold tw-text-lg tw-text-neutral-800 tw-m-0 tw-flex tw-items-center">
                    <i class="fa-solid fa-robot tw-text-indigo-600 tw-mr-2"></i>
                    AI Executive Summary
                    <span class="label label-info tw-ml-2 tw-text-xs" id="ai_model_badge"><?php echo !empty($project->ai_summary_model) ? $project->ai_summary_model : 'Qwen Cloud (qwen)'; ?></span>
                </h4>
                <p class="tw-text-xs tw-text-neutral-500 tw-m-0 tw-mt-1" id="ai_summary_time_label">
                    <?php if (!empty($project->ai_summary_last_updated)) { ?>
                        Terakhir diperbarui: <?php echo _dt($project->ai_summary_last_updated); ?>
                    <?php } else { ?>
                        Belum ada ringkasan AI yang dihasilkan.
                    <?php } ?>
                </p>
            </div>
            <div class="tw-flex tw-items-center tw-gap-2">
                <div class="tw-inline-block" style="min-width: 220px;">
                    <select id="ai_summary_model_select" class="form-control input-sm" style="height: 34px; border-radius: 4px;">
                        <option value="qwen" selected>⚡ Qwen 2.5 Cloud (Gratis & Cepat)</option>
                        <option value="qwen-coder">💻 Qwen Coder Cloud</option>
                        <option value="openai">🤖 GPT-4o Mini Cloud</option>
                        <option value="local:qwen2.5:3b">🖥️ Ollama Local (qwen2.5:3b)</option>
                    </select>
                </div>
                <button type="button" class="btn btn-primary" id="generate_ai_summary_btn" onclick="triggerGenerateAiSummary(); return false;">
                    <i class="fa-solid fa-wand-magic-sparkles tw-mr-1"></i>
                    <span id="generate_ai_btn_text">Generate AI Summary</span>
                </button>
            </div>
        </div>

        <!-- Loading indicator -->
        <div id="ai_summary_loading" class="hide tw-p-8 tw-text-center tw-bg-indigo-50 tw-rounded-xl tw-my-4">
            <i class="fa-solid fa-circle-notch fa-spin fa-2x tw-text-indigo-600 tw-mb-3"></i>
            <p class="tw-font-semibold tw-text-indigo-900 tw-m-0">Qwen AI Cloud sedang menganalisis proyek...</p>
            <small class="tw-text-indigo-600">Sedang menyusun ringkasan lengkap proyek, analisis risiko, dan evaluasi personil.</small>
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
                    <p class="tw-m-0 tw-text-sm">Klik tombol <strong>"Generate AI Summary"</strong> di atas untuk menghasilkan ringkasan eksekutif komprehensif dari <strong>Qwen AI Cloud</strong>.</p>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<script>
(function() {
    var _isGenerating = false;
    var _pid = typeof project_id !== 'undefined' ? project_id : '<?php echo (int)$project->id; ?>';

    function setLoading(isLoading, selectedModel) {
        var $btn = $('#generate_ai_summary_btn');
        var $select = $('#ai_summary_model_select');
        _isGenerating = isLoading;

        if (isLoading) {
            $btn.prop('disabled', true).addClass('disabled');
            $select.prop('disabled', true);
            $('#generate_ai_btn_text').text('Menganalisis...');
            $('#ai_summary_loading').removeClass('hide');
            $('#ai_summary_content').css('opacity', '0.4');
        } else {
            $btn.prop('disabled', false).removeClass('disabled');
            $select.prop('disabled', false);
            $('#generate_ai_btn_text').text('Generate AI Summary');
            $('#ai_summary_loading').addClass('hide');
            $('#ai_summary_content').css('opacity', '1');
        }
    }

    window.triggerGenerateAiSummary = function() {
        if (_isGenerating) return;

        var selectedModel = $('#ai_summary_model_select').val() || 'qwen';
        setLoading(true, selectedModel);

        var postData = {
            ai_model: selectedModel
        };
        if (typeof csrfData !== 'undefined') {
            postData[csrfData.token_name] = csrfData.hash;
        }

        $.ajax({
            url: admin_url + 'projects/generate_ai_summary/' + _pid,
            type: 'POST',
            data: postData,
            timeout: 60000
        }).done(function(response) {
            var data = typeof response === 'string' ? JSON.parse(response) : response;
            setLoading(false);

            if (data && data.success && data.summary_html) {
                $('#ai_summary_content').html(data.summary_html);
                $('#ai_summary_empty_state').remove();
                $('#ai_summary_time_label').html('Terakhir diperbarui: ' + data.last_updated);
                if (data.model_used) {
                    $('#ai_model_badge').text(data.model_used);
                }
                alert_float('success', 'AI Summary berhasil diperbarui!');
            } else {
                alert_float('danger', (data && data.message) ? data.message : 'Gagal menghasilkan AI Summary.');
            }
        }).fail(function(xhr, status, error) {
            setLoading(false);
            if (status === 'timeout') {
                alert_float('danger', 'Koneksi timeout. Silakan coba kembali.');
            } else {
                alert_float('danger', 'Error: ' + (xhr.responseText || error || 'Gagal menghubungi server AI.'));
            }
        });
    };
}());
</script>
