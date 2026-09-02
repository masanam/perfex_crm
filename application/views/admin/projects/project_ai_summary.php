<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div class="panel_s">
    <div class="panel-body">
        <div class="tw-flex tw-justify-between tw-items-center tw-mb-4 tw-pb-4 tw-border-b tw-border-neutral-200">
            <div>
                <h4 class="tw-font-bold tw-text-lg tw-text-neutral-800 tw-m-0 tw-flex tw-items-center">
                    <i class="fa-solid fa-robot tw-text-indigo-600 tw-mr-2"></i>
                    AI Executive Summary
                    <span class="label label-info tw-ml-2 tw-text-xs">qwen2.5:14b</span>
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
                <button type="button" class="btn btn-primary" id="generate_ai_summary_btn">
                    <i class="fa-solid fa-wand-magic-sparkles tw-mr-1"></i>
                    <span id="generate_ai_btn_text">Generate AI Summary</span>
                </button>
            </div>
        </div>

        <div id="ai_summary_loading" class="hide tw-p-8 tw-text-center tw-bg-indigo-50 tw-rounded-lg tw-my-4">
            <i class="fa-solid fa-circle-notch fa-spin fa-2x tw-text-indigo-600 tw-mb-2"></i>
            <p class="tw-font-semibold tw-text-indigo-900 tw-m-0">Sedang Menganalisis Proyek dengan AI (qwen2.5:14b)...</p>
            <small class="tw-text-indigo-600">Memproses task, progres, milestone, dan data personil proyek. Harap tunggu beberapa saat.</small>
        </div>

        <div id="ai_summary_content" class="tc-content tw-prose tw-max-w-none">
            <?php if (!empty($project->ai_summary)) { 
                $Parsedown = new Parsedown();
                echo $Parsedown->text($project->ai_summary);
            } else { ?>
                <div class="text-center text-muted tw-py-12">
                    <i class="fa-solid fa-brain fa-3x tw-mb-3 tw-opacity-40"></i>
                    <p class="tw-m-0 tw-text-sm">Klik tombol <strong>"Generate AI Summary"</strong> di atas untuk menghasilkan rekapitulasi cerdas, analisis risiko, serta rekomendasi tindakan untuk personil proyek ini.</p>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<script>
$(function(){
    $('#generate_ai_summary_btn').on('click', function(){
        var $btn = $(this);
        var $btnText = $('#generate_ai_btn_text');
        var pid = typeof project_id !== 'undefined' ? project_id : '<?php echo $project->id; ?>';
        
        $btn.prop('disabled', true).addClass('disabled');
        $btnText.text('Menganalisis...');
        $('#ai_summary_loading').removeClass('hide');
        $('#ai_summary_content').addClass('tw-opacity-50');

        var postData = {};
        if (typeof csrfData !== 'undefined') {
            postData[csrfData.token_name] = csrfData.hash;
        }

        $.post(admin_url + 'projects/generate_ai_summary/' + pid, postData)
            .done(function(response){
                try {
                    var data = typeof response === 'string' ? JSON.parse(response) : response;
                    if (data.success) {
                        $('#ai_summary_content').html(data.summary_html).removeClass('tw-opacity-50');
                        $('#ai_summary_time_label').html('Terakhir diperbarui: ' + data.last_updated);
                        alert_float('success', 'AI Summary berhasil diperbarui!');
                    } else {
                        alert_float('danger', data.message || 'Gagal menghasilkan AI Summary.');
                        $('#ai_summary_content').removeClass('tw-opacity-50');
                    }
                } catch(e) {
                    alert_float('danger', 'Gagal memproses respons dari server.');
                    $('#ai_summary_content').removeClass('tw-opacity-50');
                }
            })
            .fail(function(xhr){
                alert_float('danger', 'Error: ' + (xhr.responseText || 'Gagal menghubungi server AI.'));
                $('#ai_summary_content').removeClass('tw-opacity-50');
            })
            .always(function(){
                $btn.prop('disabled', false).removeClass('disabled');
                $btnText.text('Generate AI Summary');
                $('#ai_summary_loading').addClass('hide');
            });
    });
});
</script>
