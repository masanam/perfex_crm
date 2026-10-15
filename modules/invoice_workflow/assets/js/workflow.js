/**
 * Invoice Workflow Engine - Admin JavaScript
 * Handles AJAX transitions, modals, dynamic panel refresh, and delegation options.
 */

$(function () {
    'use strict';

    // Delegate action button clicks inside panel container
    $(document).on('click', '.iwf-action-btn', function (e) {
        e.preventDefault();
        var $btn = $(this);
        var action = $btn.data('action');
        var actionLabel = $btn.data('label') || $btn.text().trim();
        var requiresComment = $btn.data('requires-comment') == 1 || $btn.data('requires-comment') === true;
        var producesState = $btn.data('produces-state');
        var invoiceId = $btn.data('invoice-id');

        var $modal = $('#iwf-transition-modal');
        if (!$modal.length) {
            alert_float('warning', 'Transition modal structure not found on page.');
            return;
        }

        $modal.find('#iwf-modal-action-name').val(action);
        $modal.find('#iwf-modal-invoice-id').val(invoiceId);
        $modal.find('#iwf-modal-action-label').text(actionLabel);
        $modal.find('#iwf-modal-target-state').text(producesState || '');
        $modal.find('#iwf-modal-comment').val('');

        // Payment fields (Treasury Bank Voucher) display logic
        var $paymentGroup = $modal.find('#iwfPaymentFieldsGroup');
        if (action === 'confirm_payment') {
            $paymentGroup.removeClass('hide').show();
            $modal.find('#iwf_bank_voucher_number').prop('required', true);
        } else {
            $paymentGroup.addClass('hide').hide();
            $modal.find('#iwf_bank_voucher_number').prop('required', false);
        }

        // Delegatee selection display logic
        var $delegateWrapper = $modal.find('#iwf-delegate-wrapper, #iwfDelegateeGroup');
        if (action === 'delegate') {
            $delegateWrapper.removeClass('hide').show();
            $modal.find('#iwf-modal-delegate-id, #iwfDelegateeId').prop('required', true);
        } else {
            $delegateWrapper.addClass('hide').hide();
            $modal.find('#iwf-modal-delegate-id, #iwfDelegateeId').prop('required', false);
        }

        // Comment mandatory indicator
        var $reqMark = $modal.find('#iwf-comment-required-indicator, #iwfCommentRequired');
        if (requiresComment) {
            $reqMark.removeClass('hide').show();
            $modal.find('#iwf-modal-comment, #iwfComment').prop('required', true);
        } else {
            $reqMark.addClass('hide').hide();
            $modal.find('#iwf-modal-comment, #iwfComment').prop('required', false);
        }

        $modal.modal('show');
    });

    // Handle transition form submission
    $(document).on('submit', '#iwf-transition-form', function (e) {
        e.preventDefault();
        var $form = $(this);
        var $submitBtn = $form.find('button[type="submit"]');
        var invoiceId = $form.find('#iwf-modal-invoice-id').val();
        var action = $form.find('#iwf-modal-action-name').val();
        var comment = $form.find('#iwf-modal-comment, #iwfComment').val().trim();
        var requiresComment = $form.find('#iwf-modal-comment, #iwfComment').prop('required');

        if (requiresComment && !comment) {
            alert_float('warning', 'Catatan/Komentar wajib diisi untuk tindakan ini.');
            return false;
        }

        if (action === 'confirm_payment') {
            var voucherNum = $form.find('#iwf_bank_voucher_number').val().trim();
            if (!voucherNum) {
                alert_float('warning', 'Nomor Bukti Bank Voucher wajib diisi oleh Treasury.');
                return false;
            }
        }

        if (action === 'delegate') {
            var delegateId = $form.find('#iwf-modal-delegate-id, #iwfDelegateeId').val();
            if (!delegateId) {
                alert_float('warning', 'Silakan pilih penerima delegasi.');
                return false;
            }
        }

        $submitBtn.prop('disabled', true).addClass('disabled');

        $.ajax({
            url: admin_url + 'invoice_workflow/transition/' + invoiceId,
            type: 'POST',
            data: $form.serialize(),
            dataType: 'json'
        }).done(function (response) {
            $submitBtn.prop('disabled', false).removeClass('disabled');
            $('#iwf-transition-modal').modal('hide');

            if (response.success) {
                alert_float('success', response.message || 'Workflow state successfully updated.');
                // Refresh panel and timeline
                iwfRefreshPanel(invoiceId);
            } else {
                var errMessage = response.error ? (response.error.message || response.error) : 'Transition failed.';
                alert_float('danger', errMessage);
            }
        }).fail(function (jqXHR) {
            $submitBtn.prop('disabled', false).removeClass('disabled');
            $('#iwf-transition-modal').modal('hide');
            var msg = 'An unexpected server error occurred.';
            if (jqXHR.responseJSON && jqXHR.responseJSON.error) {
                msg = jqXHR.responseJSON.error.message || jqXHR.responseJSON.error;
            }
            alert_float('danger', msg);
        });
    });

    // Helper to refresh panel via AJAX
    window.iwfRefreshPanel = function (invoiceId) {
        var $container = $('#iwf-workflow-panel-container');
        if (!$container.length) {
            // If on invoice detail page, reload window or panel
            if (typeof (reload_invoices_tables) === 'function') {
                reload_invoices_tables();
            } else {
                window.location.reload();
            }
            return;
        }

        $container.addClass('pulse');
        $.get(admin_url + 'invoice_workflow/panel/' + invoiceId, function (html) {
            $container.html(html);
            $container.removeClass('pulse');
            if ($.fn.selectpicker) {
                $container.find('.selectpicker').selectpicker('refresh');
            }
        }).fail(function () {
            $container.removeClass('pulse');
            alert_float('danger', 'Gagal memuat pembaruan panel workflow.');
        });
    };
});
