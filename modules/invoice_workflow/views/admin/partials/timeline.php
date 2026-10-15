<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<ul class="iwf-timeline-list">
    <?php foreach ($history as $log): ?>
        <li class="iwf-timeline-item">

            <div class="iwf-timeline-dot iwf-dot-<?= htmlspecialchars($log->action) ?>">
                <i class="fa <?= iwf_action_icon($log->action) ?>"></i>
            </div>

            <div class="iwf-timeline-content">
                <div class="iwf-timeline-header">
                    <strong><?= htmlspecialchars($log->actor_name) ?></strong>
                    <span class="iwf-timeline-action">
                        <?= _l('iwf_action_' . $log->action) ?>
                    </span>
                    <?php if ($log->to_state): ?>
                        <span class="label <?= iwf_state_badge($log->to_state) ?>">
                            <?= iwf_state_label($log->to_state) ?>
                        </span>
                    <?php endif; ?>
                    <span class="iwf-timeline-time text-muted pull-right">
                        <i class="fa fa-clock-o"></i>
                        <?= _dt($log->created_at) ?>
                    </span>
                </div>

                <?php if (!empty($log->comment_text)): ?>
                    <div class="iwf-timeline-comment <?= $log->is_internal ? 'iwf-internal-comment' : '' ?>">
                        <?php if ($log->is_internal): ?>
                            <span class="label label-default"><?= _l('iwf_comment_internal') ?></span>
                        <?php endif; ?>
                        <blockquote class="small">
                            <?= nl2br(htmlspecialchars($log->comment_text)) ?>
                        </blockquote>
                    </div>
                <?php endif; ?>

                <?php if (!empty($log->metadata)): ?>
                    <?php $meta = json_decode($log->metadata, true); ?>
                    <?php if (!empty($meta)): ?>
                        <div class="iwf-timeline-meta text-muted small">
                            <?php foreach ($meta as $key => $val): ?>
                                <span class="iwf-meta-item">
                                    <strong><?= htmlspecialchars($key) ?>:</strong>
                                    <?= htmlspecialchars((string) $val) ?>
                                </span>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            </div>

        </li>
    <?php endforeach; ?>

    <?php if (empty($history)): ?>
        <li class="text-muted text-center"><?= _l('iwf_timeline_empty') ?></li>
    <?php endif; ?>
</ul>
