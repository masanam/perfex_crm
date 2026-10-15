<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div class="iwf-workflow-panel" id="iwf-panel-<?= $invoiceId ?>">

    <!-- ── STATE BADGE ────────────────────────────────────────────── -->
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <i class="fa fa-sitemap"></i> <?= _l('iwf_panel_title') ?>
                <?php if ($state): ?>
                    <span class="label <?= iwf_state_badge($state->current_state) ?> pull-right">
                        <?= iwf_state_label($state->current_state) ?>
                    </span>
                <?php endif; ?>
            </h4>
        </div>

        <div class="panel-body">

            <?php if (isset($poDetails) && $poDetails): ?>
                <!-- ── KLASIFIKASI PO / NON-PO SUMMARY ──────────────────── -->
                <div class="well well-sm mbot15" style="background:#f8fafc; border-left: 3px solid #0284c7;">
                    <div class="row">
                        <div class="col-md-6">
                            <strong>Tipe Invoice:</strong> 
                            <span class="label <?= $poDetails->invoice_type === 'po' ? 'label-info' : 'label-default' ?>">
                                <?= strtoupper($poDetails->invoice_type) ?>
                            </span>
                            <?php if ($poDetails->vendor_invoice_number): ?>
                                <br><small class="text-muted">No Inv Vendor: <strong><?= html_escape($poDetails->vendor_invoice_number) ?></strong></small>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-6">
                            <?php if ($poDetails->invoice_type === 'po'): ?>
                                <small class="text-muted">No. PO:</small> <strong><?= html_escape($poDetails->po_number ?: '-') ?></strong><br>
                                <small class="text-muted">No. GR / BA:</small> <strong><?= html_escape($poDetails->gr_number ?: '-') ?></strong>
                            <?php else: ?>
                                <small class="text-muted">Justifikasi Non-PO:</small><br>
                                <span class="text-muted font-italic"><?= html_escape($poDetails->non_po_reason ?: '-') ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php if ($poDetails->faktur_pajak_number || $poDetails->wht_type): ?>
                        <hr style="margin: 8px 0;">
                        <div class="row text-xs">
                            <div class="col-md-6">
                                <small class="text-muted">Faktur Pajak:</small> <?= html_escape($poDetails->faktur_pajak_number ?: '-') ?>
                                <?= $poDetails->faktur_pajak_date ? ' (' . _d($poDetails->faktur_pajak_date) . ')' : '' ?>
                            </div>
                            <div class="col-md-6">
                                <small class="text-muted">PPh / WHT:</small> <?= html_escape($poDetails->wht_type ?: 'Tanpa PPh') ?>
                                <?= $poDetails->wht_amount > 0 ? ' (Rp ' . number_format($poDetails->wht_amount, 2) . ')' : '' ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <?php if (isset($paymentDetails) && $paymentDetails): ?>
                <!-- ── BANK VOUCHER & PAYMENT DETAILS SUMMARY (FR-10) ──────── -->
                <div class="well well-sm mbot15" style="background:#f0fdf4; border-left: 3px solid #16a34a;">
                    <div class="row">
                        <div class="col-md-6">
                            <strong class="text-success"><i class="fa fa-check-circle"></i> Pembayaran Dikonfirmasi Treasury</strong><br>
                            <small class="text-muted">No. Bank Voucher:</small> <strong><?= html_escape($paymentDetails->bank_voucher_number) ?></strong>
                        </div>
                        <div class="col-md-6">
                            <small class="text-muted">Tgl Bayar:</small> <strong><?= _d($paymentDetails->payment_date) ?></strong><br>
                            <small class="text-muted">Metode:</small> <strong><?= strtoupper(str_replace('_', ' ', $paymentDetails->payment_method)) ?></strong>
                        </div>
                    </div>
                    <?php if ($paymentDetails->bank_name || $paymentDetails->bank_account_number): ?>
                        <hr style="margin: 6px 0;">
                        <div class="text-xs text-muted">
                            Bank: <?= html_escape($paymentDetails->bank_name ?: '-') ?> | No Rek: <?= html_escape($paymentDetails->bank_account_number ?: '-') ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <?php if (!$state): ?>
                <div class="alert alert-warning">
                    <?= _l('iwf_state_not_initialized') ?>
                </div>

            <?php elseif ($state->locked_at): ?>
                <!-- Invoice sudah closed/locked -->
                <div class="alert alert-success">
                    <i class="fa fa-lock"></i>
                    <?= _l('iwf_state_locked_at') ?> <?= _dt($state->locked_at) ?>
                </div>

            <?php else: ?>
                <!-- ── ACTION BUTTONS ────────────────────────────────── -->
                <?php if (!empty($availableActions)): ?>
                    <div class="iwf-actions-wrapper">
                        <p class="text-muted small"><?= _l('iwf_available_actions') ?></p>
                        <div class="btn-group flex-wrap" role="group">
                            <?php foreach ($availableActions as $act): ?>
                                <button
                                    type="button"
                                    class="btn <?= iwf_action_btn_class($act['action']) ?> btn-sm iwf-action-btn"
                                    data-action="<?= htmlspecialchars($act['action']) ?>"
                                    data-invoice-id="<?= $invoiceId ?>"
                                    data-comment-required="<?= $act['comment_required'] ? '1' : '0' ?>"
                                    data-special="<?= htmlspecialchars($act['special'] ?? '') ?>"
                                >
                                    <i class="fa <?= iwf_action_icon($act['action']) ?>"></i>
                                    <?= htmlspecialchars($act['label']) ?>
                                </button>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php else: ?>
                    <p class="text-muted small">
                        <i class="fa fa-info-circle"></i>
                        <?= _l('iwf_no_actions_available') ?>
                    </p>
                <?php endif; ?>

            <?php endif; ?>

            <!-- ── TIMELINE ──────────────────────────────────────── -->
            <?php if (!empty($history)): ?>
                <hr>
                <h5><?= _l('iwf_timeline_title') ?></h5>
                <div class="iwf-timeline" id="iwf-timeline-<?= $invoiceId ?>">
                    <?php $this->load->view(IWF_MODULE_NAME . '/admin/partials/timeline', [
                        'history'   => $history,
                        'allStates' => $allStates ?? [],
                    ]); ?>
                </div>
            <?php endif; ?>

        </div><!-- /.panel-body -->
    </div><!-- /.panel -->

</div><!-- /.iwf-workflow-panel -->

<!-- ── MODAL: Konfirmasi Aksi Workflow ─────────────────────────────────────── -->
<div class="modal fade" id="iwfActionModal" tabindex="-1" role="dialog" aria-labelledby="iwfActionModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                <h4 class="modal-title" id="iwfActionModalLabel"><?= _l('iwf_modal_confirm_action') ?></h4>
            </div>
            <div class="modal-body">

                <div class="form-group">
                    <label><?= _l('iwf_label_action') ?></label>
                    <p class="form-control-static" id="iwfActionLabel">—</p>
                </div>

                <!-- Fields Khusus Confirm Payment (Treasury Bank Voucher) -->
                <div id="iwfPaymentFieldsGroup" style="display:none;" class="well well-sm">
                    <h5 class="bold text-primary mtop0 mbot10"><i class="fa fa-university"></i> Rincian Pembayaran & Bank Voucher</h5>
                    <div class="form-group">
                        <label for="iwf_bank_voucher_number">Nomor Bukti Bank Voucher <span style="color:red;">*</span></label>
                        <input type="text" class="form-control" id="iwf_bank_voucher_number" name="bank_voucher_number" placeholder="Contoh: BV-NEC-2026/10/089">
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="iwf_payment_date">Tanggal Bayar</label>
                                <input type="text" class="form-control datepicker" id="iwf_payment_date" name="payment_date" value="<?= date('Y-m-d') ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="iwf_payment_method">Metode Pembayaran</label>
                                <select class="form-control" id="iwf_payment_method" name="payment_method">
                                    <option value="bank_transfer">Bank Transfer (SKN/RTGS/BI-FAST)</option>
                                    <option value="cheque">Cek / Cheque</option>
                                    <option value="giro">Bilyet Giro</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="iwf_bank_name">Nama Bank Pengirim/Tujuan</label>
                                <input type="text" class="form-control" id="iwf_bank_name" name="bank_name" placeholder="BCA / Mandiri / BNI">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="iwf_bank_account_number">Nomor Rekening</label>
                                <input type="text" class="form-control" id="iwf_bank_account_number" name="bank_account_number">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group" id="iwfCommentGroup">
                    <label for="iwfComment">
                        <?= _l('iwf_label_comment') ?>
                        <span class="iwf-required-mark" id="iwfCommentRequired" style="display:none;color:red;"> *</span>
                    </label>
                    <textarea
                        class="form-control"
                        id="iwfComment"
                        name="comment"
                        rows="4"
                        placeholder="<?= _l('iwf_comment_placeholder') ?>"
                    ></textarea>
                </div>

                <!-- Delegatee selector (hanya muncul saat aksi = delegate) -->
                <div class="form-group" id="iwfDelegateeGroup" style="display:none;">
                    <label for="iwfDelegateeId"><?= _l('iwf_label_delegatee') ?> <span style="color:red;">*</span></label>
                    <select class="form-control" id="iwfDelegateeId" name="delegatee_id">
                        <option value="">— <?= _l('iwf_select_staff') ?> —</option>
                        <?php if (!empty($allStaff)): ?>
                            <?php foreach ($allStaff as $staff): ?>
                                <option value="<?= $staff->staffid ?>">
                                    <?= htmlspecialchars($staff->firstname . ' ' . $staff->lastname) ?>
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>

                <div id="iwfActionError" class="alert alert-danger" style="display:none;"></div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?= _l('close') ?></button>
                <button type="button" class="btn btn-primary" id="iwfSubmitAction">
                    <i class="fa fa-check"></i> <?= _l('iwf_btn_confirm') ?>
                </button>
            </div>
        </div>
    </div>
</div>

