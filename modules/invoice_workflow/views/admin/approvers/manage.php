<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>

<div id="wrapper">
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="flex justify-between items-center mbot15">
                            <div>
                                <h4 class="no-margin bold">
                                    <i class="fa fa-users menu-icon"></i> <?= _l('iwf_manage_approvers'); ?>
                                </h4>
                                <span class="text-muted"><?= _l('iwf_manage_approvers_subtitle'); ?></span>
                            </div>
                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#iwf-add-approver-modal">
                                <i class="fa fa-plus"></i> <?= _l('iwf_add_approver'); ?>
                            </button>
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
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($approvers)) {
                                        foreach ($approvers as $app) { ?>
                                            <tr>
                                                <td class="bold">
                                                    <a href="<?= admin_url('staff/member/' . $app['staff_id']); ?>" target="_blank">
                                                        <?= html_escape($app['firstname'] . ' ' . $app['lastname']); ?>
                                                    </a>
                                                    <br><small class="text-muted"><?= html_escape($app['email']); ?></small>
                                                </td>
                                                <td><span class="label label-default"><?= html_escape($app['role']); ?></span></td>
                                                <td><?= number_format($app['min_amount'], 2); ?></td>
                                                <td><?= $app['max_amount'] !== null ? number_format($app['max_amount'], 2) : 'Tanpa Batas'; ?></td>
                                                <td>
                                                    <?php if ($app['is_active'] == 1) { ?>
                                                        <span class="label label-success">Aktif</span>
                                                    <?php } else { ?>
                                                        <span class="label label-danger">Non-aktif</span>
                                                    <?php } ?>
                                                </td>
                                                <td>
                                                    <a href="<?= admin_url('invoice_workflow/toggle_approver/' . $app['id']); ?>" class="btn btn-default btn-xs" title="Toggle Aktif/Nonaktif">
                                                        <i class="fa fa-power-off"></i>
                                                    </a>
                                                    <a href="<?= admin_url('invoice_workflow/delete_approver/' . $app['id']); ?>" class="btn btn-danger btn-xs _delete" title="Hapus">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                </td>
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
                <div class="form-group">
                    <label for="staff_id" class="control-label">Pilih Staff <span class="text-danger">*</span></label>
                    <select name="staff_id" id="staff_id" class="selectpicker" data-width="100%" data-live-search="true" required>
                        <option value=""></option>
                        <?php foreach ($staff_members as $staff) { ?>
                            <option value="<?= $staff['staffid']; ?>">
                                <?= html_escape($staff['firstname'] . ' ' . $staff['lastname'] . ' (' . $staff['email'] . ')'); ?>
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
