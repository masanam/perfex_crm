<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<?php
$po_details = isset($po_details) ? $po_details : null;
$inv_type = isset($po_details->invoice_type) ? $po_details->invoice_type : 'non_po';
$po_num = isset($po_details->po_number) ? $po_details->po_number : '';
$gr_num = isset($po_details->gr_number) ? $po_details->gr_number : '';
$vendor_inv_num = isset($po_details->vendor_invoice_number) ? $po_details->vendor_invoice_number : '';
$faktur_num = isset($po_details->faktur_pajak_number) ? $po_details->faktur_pajak_number : '';
$faktur_date = isset($po_details->faktur_pajak_date) ? _d($po_details->faktur_pajak_date) : '';
$wht_type = isset($po_details->wht_type) ? $po_details->wht_type : '';
$wht_rate = isset($po_details->wht_rate) ? $po_details->wht_rate : 0.00;
$wht_amount = isset($po_details->wht_amount) ? $po_details->wht_amount : 0.00;
$non_po_reason = isset($po_details->non_po_reason) ? $po_details->non_po_reason : '';
?>

<div class="panel_s mtop15" id="iwf-po-classification-panel">
    <div class="panel-body">
        <h4 class="no-margin bold text-info flex items-center">
            <i class="fa fa-file-text-o mright10"></i> Klasifikasi Invoice & Perpajakan (PO vs Non-PO)
        </h4>
        <hr class="hr-panel-heading" />

        <div class="row">
            <!-- Tipe Invoice Toggle -->
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label bold">Jenis Klasifikasi Invoice <span class="text-danger">*</span></label>
                    <div class="radio radio-primary radio-inline">
                        <input type="radio" name="iwf_invoice_type" id="iwf_type_non_po" value="non_po" <?= $inv_type === 'non_po' ? 'checked' : ''; ?>>
                        <label for="iwf_type_non_po">Invoice Non-PO</label>
                    </div>
                    <div class="radio radio-primary radio-inline">
                        <input type="radio" name="iwf_invoice_type" id="iwf_type_po" value="po" <?= $inv_type === 'po' ? 'checked' : ''; ?>>
                        <label for="iwf_type_po">Invoice PO (Purchase Order)</label>
                    </div>
                </div>
            </div>

            <!-- Nomor Invoice Vendor -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="iwf_vendor_invoice_number" class="control-label">Nomor Invoice Vendor / Supplier</label>
                    <input type="text" name="iwf_vendor_invoice_number" id="iwf_vendor_invoice_number" class="form-control" value="<?= html_escape($vendor_inv_num); ?>" placeholder="Contoh: INV-VEND-2026/X/001">
                    <small class="text-muted">Nomor surat invoice fisik dari vendor (digunakan untuk validasi duplikasi).</small>
                </div>
            </div>
        </div>

        <!-- Section Khusus PO -->
        <div class="row <?= $inv_type !== 'po' ? 'hide' : ''; ?>" id="iwf-po-fields-container">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="iwf_po_number" class="control-label">Nomor Purchase Order (PO) <span class="text-danger">*</span></label>
                    <input type="text" name="iwf_po_number" id="iwf_po_number" class="form-control" value="<?= html_escape($po_num); ?>" placeholder="Contoh: PO-NEC-2026-089">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="iwf_gr_number" class="control-label">Nomor Goods Receipt / BA Penerimaan (GR) <span class="text-danger">*</span></label>
                    <input type="text" name="iwf_gr_number" id="iwf_gr_number" class="form-control" value="<?= html_escape($gr_num); ?>" placeholder="Contoh: GR-NEC-2026-104">
                </div>
            </div>
        </div>

        <!-- Section Khusus Non-PO -->
        <div class="row <?= $inv_type !== 'non_po' ? 'hide' : ''; ?>" id="iwf-non-po-fields-container">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="iwf_non_po_reason" class="control-label">Justifikasi / Alasan Pengajuan Non-PO <span class="text-danger">*</span></label>
                    <textarea name="iwf_non_po_reason" id="iwf_non_po_reason" class="form-control" rows="2" placeholder="Jelaskan alasan pengajuan tanpa PO (misal: Langganan rutin utilitas / Penunjukan langsung darurat)"><?= html_escape($non_po_reason); ?></textarea>
                </div>
            </div>
        </div>

        <hr class="hr-panel-heading" />
        <h5 class="bold mbot15 text-muted"><i class="fa fa-calculator"></i> Data Faktur Pajak & PPh (WHT - Withholding Tax)</h5>

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="iwf_faktur_pajak_number" class="control-label">Nomor Seri Faktur Pajak (16 Digit)</label>
                    <input type="text" name="iwf_faktur_pajak_number" id="iwf_faktur_pajak_number" class="form-control" maxlength="20" value="<?= html_escape($faktur_num); ?>" placeholder="010.000-26.00000001">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="iwf_faktur_pajak_date" class="control-label">Tanggal Faktur Pajak</label>
                    <input type="text" name="iwf_faktur_pajak_date" id="iwf_faktur_pajak_date" class="form-control datepicker" value="<?= html_escape($faktur_date); ?>" autocomplete="off">
                </div>
            </div>
            <div class="col-md-5">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="iwf_wht_type" class="control-label">Jenis PPh (WHT)</label>
                            <select name="iwf_wht_type" id="iwf_wht_type" class="selectpicker" data-width="100%">
                                <option value="">Tanpa PPh</option>
                                <option value="PPh 23" <?= $wht_type === 'PPh 23' ? 'selected' : ''; ?>>PPh 23 (Jasa/Sewa)</option>
                                <option value="PPh 4(2)" <?= $wht_type === 'PPh 4(2)' ? 'selected' : ''; ?>>PPh 4(2) Final</option>
                                <option value="PPh 21" <?= $wht_type === 'PPh 21' ? 'selected' : ''; ?>>PPh 21 Perorangan</option>
                                <option value="PPh 22" <?= $wht_type === 'PPh 22' ? 'selected' : ''; ?>>PPh 22 Impor/Barang</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="iwf_wht_amount" class="control-label">Nilai Potongan PPh (IDR)</label>
                            <input type="number" step="0.01" min="0" name="iwf_wht_amount" id="iwf_wht_amount" class="form-control" value="<?= html_escape($wht_amount); ?>">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(function() {
    'use strict';
    $('input[name="iwf_invoice_type"]').on('change', function() {
        var type = $(this).val();
        if (type === 'po') {
            $('#iwf-po-fields-container').removeClass('hide').show();
            $('#iwf-non-po-fields-container').addClass('hide').hide();
        } else {
            $('#iwf-po-fields-container').addClass('hide').hide();
            $('#iwf-non-po-fields-container').removeClass('hide').show();
        }
    });
});
</script>
