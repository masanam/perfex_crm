<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>

<div id="wrapper">
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="tw-flex tw-justify-between tw-items-center mbot15">
                            <div>
                                <h4 class="no-margin bold">
                                    <i class="fa fa-users menu-icon"></i> <?= _l('iwf_manage_approvers'); ?>
                                </h4>
                                <span class="text-muted"><?= _l('iwf_manage_approvers_subtitle'); ?></span>
                            </div>
                            <?php if ($can_manage ?? true) { ?>
                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#iwf-add-approver-modal">
                                    <i class="fa fa-plus"></i> <?= _l('iwf_add_approver'); ?>
                                </button>
                            <?php } ?>
                        </div>
                        <hr class="hr-panel-heading" />

                        <div class="table-responsive mtop15">
                            <table class="table table-bordered table-striped dt-table">
                                <thead>
                                    <tr>
                                        <th>Nama Staff</th>
                                        <th>Peran Workflow (Role)</th>
                                        <th>Min Amount (IDR)</th>
                                        <th>Max Amount (IDR)</th>
                                        <th>Status</th>
                                        <?php if ($can_manage ?? true) { ?>
                                            <th>Aksi</th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($approvers)) {
                                        foreach ($approvers as $app) { 
                                            $appId       = is_array($app) ? ($app['id'] ?? '') : ($app->id ?? '');
                                            $appStaffId  = is_array($app) ? ($app['staff_id'] ?? '') : ($app->staff_id ?? '');
                                            $appFirst    = is_array($app) ? ($app['firstname'] ?? '') : ($app->firstname ?? '');
                                            $appLast     = is_array($app) ? ($app['lastname'] ?? '') : ($app->lastname ?? '');
                                            $appEmail    = is_array($app) ? ($app['email'] ?? $app['staff_email'] ?? '') : ($app->email ?? $app->staff_email ?? '');
                                            $appRole     = is_array($app) ? ($app['role'] ?? $app['role_slug'] ?? '') : ($app->role ?? $app->role_slug ?? '');
                                            $appMin      = is_array($app) ? ($app['min_amount'] ?? $app['amount_min'] ?? 0) : ($app->min_amount ?? $app->amount_min ?? 0);
                                            $appMax      = is_array($app) ? ($app['max_amount'] ?? $app['amount_max'] ?? null) : ($app->max_amount ?? $app->amount_max ?? null);
                                            $appIsActive = is_array($app) ? ($app['is_active'] ?? 0) : ($app->is_active ?? 0);
                                            $fullName    = trim($appFirst . ' ' . $appLast);
                                        ?>
                                            <tr>
                                                <td class="bold">
                                                    <a href="<?= admin_url('staff/member/' . $appStaffId); ?>" target="_blank">
                                                        <?= html_escape($fullName ?: ('Staff #' . $appStaffId)); ?>
                                                    </a>
                                                    <?php if (!empty($appEmail)) { ?>
                                                        <br><small class="text-muted"><?= html_escape($appEmail); ?></small>
                                                    <?php } ?>
                                                </td>
                                                <td><span class="label label-default"><?= html_escape($appRole); ?></span></td>
                                                <td><?= number_format((float) $appMin, 2); ?></td>
                                                <td><?= $appMax !== null && $appMax !== '' ? number_format((float) $appMax, 2) : 'Tanpa Batas'; ?></td>
                                                <td>
                                                    <?php if ($appIsActive == 1) { ?>
                                                        <span class="label label-success">Aktif</span>
                                                    <?php } else { ?>
                                                        <span class="label label-danger">Non-aktif</span>
                                                    <?php } ?>
                                                </td>
                                                <?php if ($can_manage ?? true) { ?>
                                                    <td>
                                                        <a href="<?= admin_url('invoice_workflow/toggle_approver/' . $appId); ?>" class="btn btn-default btn-xs" title="Toggle Aktif/Nonaktif">
                                                            <i class="fa fa-power-off"></i>
                                                        </a>
                                                        <a href="<?= admin_url('invoice_workflow/delete_approver/' . $appId); ?>" class="btn btn-danger btn-xs _delete" title="Hapus">
                                                            <i class="fa fa-trash"></i>
                                                        </a>
                                                    </td>
                                                <?php } ?>
                                            </tr>
                                    <?php }
                                    } ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Add Approver -->
<div class="modal fade" id="iwf-add-approver-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <?= form_open(admin_url('invoice_workflow/save_approver'), ['id' => 'iwf-approver-form']); ?>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?= _l('iwf_add_approver'); ?></h4>
            </div>
            <div class="modal-body">
                <?php 
                $staff_list = !empty($staff_members) ? $staff_members : (!empty($staff) ? $staff : []);
                ?>
                <div class="form-group">
                    <label for="staff_id" class="control-label">Pilih Staff <span class="text-danger">*</span></label>
                    <select name="staff_id" id="staff_id" class="selectpicker" data-width="100%" data-live-search="true" title="-- Pilih Staff --" required>
                        <option value=""></option>
                        <?php foreach ($staff_list as $st) { 
                            $sId    = is_array($st) ? ($st['staffid'] ?? '') : ($st->staffid ?? '');
                            $sFirst = is_array($st) ? ($st['firstname'] ?? '') : ($st->firstname ?? '');
                            $sLast  = is_array($st) ? ($st['lastname'] ?? '') : ($st->lastname ?? '');
                            $sEmail = is_array($st) ? ($st['email'] ?? '') : ($st->email ?? '');
                            $sName  = trim($sFirst . ' ' . $sLast);
                        ?>
                            <option value="<?= $sId; ?>" data-subtext="<?= html_escape($sEmail); ?>">
                                <?= html_escape($sName . ($sEmail ? ' (' . $sEmail . ')' : '')); ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="role" class="control-label">Peran Workflow (Role) <span class="text-danger">*</span></label>
                    <select name="role" id="role" class="selectpicker" data-width="100%" required>
                        <option value=""></option>
                        <?php foreach ($roles as $rKey => $rLabel) { ?>
                            <option value="<?= $rKey; ?>"><?= $rLabel; ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="min_amount" class="control-label">Min Amount (IDR)</label>
                            <input type="number" step="0.01" min="0" name="min_amount" id="min_amount" class="form-control" value="0.00">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="max_amount" class="control-label">Max Amount (Kosongkan jika tanpa batas)</label>
                            <input type="number" step="0.01" min="0" name="max_amount" id="max_amount" class="form-control" placeholder="No limit">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-info">Simpan Approver</button>
            </div>
            <?= form_close(); ?>
        </div>
    </div>
</div>

<?php init_tail(); ?>
<script>
$(function() {
    $('#iwf-add-approver-modal').on('shown.bs.modal', function () {
        if (typeof init_selectpicker === 'function') {
            init_selectpicker();
        } else {
            $('.selectpicker').selectpicker('refresh');
        }
    });
});
</script>
