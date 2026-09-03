<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div class="panel_s">
    <div class="panel-body">
        <div class="tw-flex tw-flex-wrap tw-justify-between tw-items-center tw-gap-3 tw-mb-4 tw-pb-4 tw-border-b tw-border-neutral-200">
            <div>
                <h4 class="tw-font-bold tw-text-lg tw-text-neutral-800 tw-m-0 tw-flex tw-items-center">
                    <i class="fa-solid fa-robot tw-text-indigo-600 tw-mr-2"></i>
                    AI Executive Summary
                    <span class="label label-info tw-ml-2 tw-text-xs" id="ai_model_badge" style="display:none;"><?php echo !empty($project->ai_summary_model) ? $project->ai_summary_model : ''; ?></span>
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
                <div class="tw-inline-block" style="min-width: 260px;">
                    <select id="ai_summary_model_select" class="form-control input-sm" style="height: 34px; border-radius: 4px;">
                        <option value="local:qwen2.5:3b" selected>⚡ Ultra Cepat (Qwen 2.5 - Respon Kilat & Realtime)</option>
                        <option value="qwen-turbo">🚀 Qwen Turbo (Alibaba Cloud - Cepat)</option>
                        <option value="qwen-plus">🎯 Qwen Plus (Alibaba Cloud - Cerdas & Lengkap)</option>
                        <option value="qwen-max">🧠 Qwen Max (Alibaba Cloud - Analisis Maksimal)</option>
                    </select>
                </div>
                <button type="button" class="btn btn-primary" id="generate_ai_summary_btn" onclick="triggerGenerateAiSummary(); return false;">
                    <i class="fa-solid fa-wand-magic-sparkles tw-mr-1"></i>
                    <span id="generate_ai_btn_text">Generate AI Summary</span>
                </button>
            </div>
        </div>

        <!-- Live Streaming Status Header -->
        <div id="ai_streaming_badge" class="hide tw-mb-3 tw-flex tw-items-center tw-text-xs tw-font-semibold tw-text-indigo-700 tw-bg-indigo-50 tw-p-2 tw-rounded-lg tw-border tw-border-indigo-100">
            <i class="fa-solid fa-circle-notch fa-spin tw-mr-2 tw-text-indigo-600"></i>
            <span>Qwen AI Model Studio sedang menyusun analisis secara real-time...</span>
        </div>

        <!-- Content area -->
        <div id="ai_summary_content" class="tc-content tw-prose tw-max-w-none tw-min-h-[120px]">
            <?php if (!empty($project->ai_summary)) {
                $Parsedown = new Parsedown();
                echo $Parsedown->text($project->ai_summary);
            } else { ?>
                <div class="text-center text-muted tw-py-12" id="ai_summary_empty_state">
                    <i class="fa-solid fa-brain fa-3x tw-mb-3 tw-opacity-30"></i>
                    <p class="tw-m-0 tw-text-sm">Klik tombol <strong>"Generate AI Summary"</strong> di atas untuk menghasilkan analisis dan ringkasan eksekutif secara instan dari <strong>Qwen AI Model Studio</strong>.</p>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<style>
.ai-stream-cursor {
    display: inline-block;
    width: 8px;
    height: 16px;
    background-color: #6366f1;
    vertical-align: text-bottom;
    margin-left: 2px;
    animation: aiCursorBlink 0.8s infinite;
}
@keyframes aiCursorBlink {
    0%, 100% { opacity: 1; }
    50% { opacity: 0; }
}
</style>

<script>
(function() {
    var _isGenerating = false;
    var _pid = typeof project_id !== 'undefined' ? project_id : '<?php echo (int)$project->id; ?>';

    function setLoading(isLoading) {
        var $btn = $('#generate_ai_summary_btn');
        var $select = $('#ai_summary_model_select');
        _isGenerating = isLoading;

        if (isLoading) {
            $btn.prop('disabled', true).addClass('disabled');
            $select.prop('disabled', true);
            $('#generate_ai_btn_text').text('Menganalisis...');
            $('#ai_streaming_badge').removeClass('hide');
        } else {
            $btn.prop('disabled', false).removeClass('disabled');
            $select.prop('disabled', false);
            $('#generate_ai_btn_text').text('Generate AI Summary');
            $('#ai_streaming_badge').addClass('hide');
        }
    }

    // Helper to format basic markdown on the fly during streaming
    function formatStreamMarkdown(text) {
        var escaped = text
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;');

        // Replace headers
        escaped = escaped.replace(/^### (.*$)/gim, '<h4 class="tw-font-bold tw-text-base tw-mt-4 tw-mb-2">$1</h4>');
        escaped = escaped.replace(/^## (.*$)/gim, '<h3 class="tw-font-bold tw-text-lg tw-mt-5 tw-mb-3 tw-text-indigo-900 tw-border-b tw-pb-1">$1</h3>');
        escaped = escaped.replace(/^# (.*$)/gim, '<h2 class="tw-font-bold tw-text-xl tw-mt-6 tw-mb-3">$1</h2>');

        // Bold
        escaped = escaped.replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>');
        // Italic
        escaped = escaped.replace(/\*(.*?)\*/g, '<em>$1</em>');
        // Unordered list items
        escaped = escaped.replace(/^- (.*$)/gim, '<li class="tw-ml-4">$1</li>');

        // Paragraph linebreaks
        escaped = escaped.replace(/\n\n/g, '<br><br>');
        escaped = escaped.replace(/\n/g, '<br>');

        return escaped;
    }

    window.triggerGenerateAiSummary = function() {
        if (_isGenerating) return;

        var selectedModel = $('#ai_summary_model_select').val() || 'local:qwen2.5:3b';
        setLoading(true);

        $('#ai_summary_empty_state').remove();
        var $content = $('#ai_summary_content');
        $content.html('<span id="ai_stream_text"></span><span class="ai-stream-cursor"></span>');

        var streamUrl = admin_url + 'projects/stream_ai_summary/' + _pid + '?ai_model=' + encodeURIComponent(selectedModel);
        var rawAccumulatedText = '';

        if (window.fetch && window.ReadableStream) {
            fetch(streamUrl, {
                method: 'GET',
                headers: { 'Accept': 'text/event-stream' }
            }).then(function(response) {
                if (!response.ok) {
                    throw new Error('HTTP status ' + response.status);
                }
                var reader = response.body.getReader();
                var decoder = new TextDecoder('utf-8');
                var buffer = '';

                function readChunk() {
                    return reader.read().then(function(result) {
                        if (result.done) {
                            setLoading(false);
                            $('.ai-stream-cursor').remove();
                            return;
                        }

                        buffer += decoder.decode(result.value, { stream: true });
                        var events = buffer.split("\n\n");
                        buffer = events.pop();

                        for (var i = 0; i < events.length; i++) {
                            var ev = events[i].trim();
                            if (ev.indexOf('data: ') === 0) {
                                var jsonStr = ev.substring(6);
                                try {
                                    var data = JSON.parse(jsonStr);
                                    if (data.token) {
                                        rawAccumulatedText += data.token;
                                        $('#ai_stream_text').html(formatStreamMarkdown(rawAccumulatedText));
                                    } else if (data.done) {
                                        setLoading(false);
                                        if (data.summary_html) {
                                            $content.html(data.summary_html);
                                        } else {
                                            $('.ai-stream-cursor').remove();
                                        }
                                        if (data.last_updated) {
                                            $('#ai_summary_time_label').html('Terakhir diperbarui: ' + data.last_updated);
                                        }
                                        if (data.model_used) {
                                            $('#ai_model_badge').text(data.model_used);
                                        }
                                        alert_float('success', 'AI Summary berhasil diperbarui!');
                                        return;
                                    } else if (data.error) {
                                        $.post(admin_url + 'projects/generate_ai_summary/' + _pid, { ai_model: selectedModel }, function(res) {
                                            setLoading(false);
                                            $('.ai-stream-cursor').remove();
                                            var d = typeof res === 'string' ? JSON.parse(res) : res;
                                            if (d && d.success && d.summary_html) {
                                                $content.html(d.summary_html);
                                                if (d.last_updated) $('#ai_summary_time_label').html('Terakhir diperbarui: ' + d.last_updated);
                                                if (d.model_used) $('#ai_model_badge').text(d.model_used);
                                                alert_float('success', 'AI Summary berhasil diperbarui!');
                                            } else {
                                                alert_float('danger', (d && d.message) ? d.message : 'Gagal menghasilkan AI Summary.');
                                            }
                                        }).fail(function() {
                                            setLoading(false);
                                            $('.ai-stream-cursor').remove();
                                            alert_float('danger', 'Gagal menghubungi server AI.');
                                        });
                                        return;
                                    }
                                } catch (e) {}
                            }
                        }

                        return readChunk();
                    });
                }

                return readChunk();
            }).catch(function(err) {
                // Fallback to AJAX POST
                $.post(admin_url + 'projects/generate_ai_summary/' + _pid, { ai_model: selectedModel }, function(res) {
                    setLoading(false);
                    $('.ai-stream-cursor').remove();
                    var data = typeof res === 'string' ? JSON.parse(res) : res;
                    if (data && data.success && data.summary_html) {
                        $content.html(data.summary_html);
                        if (data.last_updated) $('#ai_summary_time_label').html('Terakhir diperbarui: ' + data.last_updated);
                        if (data.model_used) {
                            $('#ai_model_badge').text(data.model_used);
                        }
                        alert_float('success', 'AI Summary berhasil diperbarui!');
                    } else {
                        alert_float('danger', (data && data.message) ? data.message : 'Gagal menghasilkan AI Summary.');
                    }
                }).fail(function() {
                    setLoading(false);
                    $('.ai-stream-cursor').remove();
                    alert_float('danger', 'Gagal menghubungi server Qwen AI.');
                });
            });
        } else {
            // Fallback for older browsers
            $.post(admin_url + 'projects/generate_ai_summary/' + _pid, { ai_model: selectedModel }, function(res) {
                setLoading(false);
                var data = typeof res === 'string' ? JSON.parse(res) : res;
                if (data && data.success && data.summary_html) {
                    $content.html(data.summary_html);
                    $('#ai_summary_time_label').html('Terakhir diperbarui: ' + data.last_updated);
                    if (data.model_used) {
                        $('#ai_model_badge').text(data.model_used);
                    }
                    alert_float('success', 'AI Summary berhasil diperbarui!');
                }
            });
        }
    };
}());
</script>
