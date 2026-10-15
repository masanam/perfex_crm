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
                                    <i class="fa fa-user-plus menu-icon"></i> <?= _l('iwf_manage_delegations'); ?>
                                </h4>
                                <span class="text-muted"><?= _l('iwf_manage_delegations_subtitle'); ?></span>
                            </div>
                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#iwf-add-delegation-modal">
                                <i class="fa fa-plus"></i> <?= _l('iwf_add_delegation'); ?>
                            </button>
                        </div>
                        <hr class="hr-panel-heading" />

                        <div class="table-responsive mtop15">
                            <table class="table table-bordered table-striped dt-table">
                                <thead>
                                    <tr>
                                        <th>Pemberi Delegasi (Delegator)</th>
                                        <th>Penerima Delegasi (Delegatee)</th>
                                        <th>Peran Workflow</th>
                                        <th>Periode Mulai</th>
                                        <th>Periode Selesai</th>
                                        <th>Status</th>
                                        <th>Alasan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($delegations)) {
                                        foreach ($delegations as $del) { ?>
                                            <tr>
                                                <td class="bold"><?= html_escape($del['delegator_name']); ?></td>
                                                <td class="bold text-info"><?= html_escape($del['delegatee_name']); ?></td>
                                                <td><span class="label label-default"><?= html_escape($del['role']); ?></span></td>
                                                <td><?= _dt($del['start_date']); ?></td>
                                                <td><?= _dt($del['end_date']); ?></td>
                                                <td>
                                                    <?php if ($del['status'] === 'active') { ?>
                                                        <span class="label label-success">Aktif</span>
                                                    <?php } else { ?>
                                                        <span class="label label-default"><?= html_escape($del['status']); ?></span>
                                                    <?php } ?>
                                                </td>
                                                <td><?= html_escape($del['reason'] ?? '-'); ?></td>
                                                <td>
                                                    <?php if ($del['status'] === 'active') { ?>
                                                        <a href="<?= admin_url('invoice_workflow/revoke_delegation/' . $del['id']); ?>" class="btn btn-warning btn-xs _delete" title="Revoke/Batalkan">
                                                            <i class="fa fa-ban"></i> Revoke
                                                        </a>
                                                    <?php } ?>
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

<!-- Modal Add Delegation -->
<div class="modal fade" id="iwf-add-delegation-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <?= form_open(admin_url('invoice_workflow/save_delegation'), ['id' => 'iwf-delegation-form']); ?>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?= _l('iwf_add_delegation'); ?></h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="delegator_id" class="control-label">Pemberi Delegasi (Delegator) <span class="text-danger">*</span></label>
                    <select name="delegator_id" id="delegator_id" class="selectpicker" data-width="100%" data-live-search="true" required>
                        <option value=""></option>
                        <?php foreach ($staff_members as $staff) { ?>
                            <option value="<?= $staff['staffid']; ?>">
                                <?= html_escape($staff['firstname'] . ' ' . $staff['lastname'] . ' (' . $staff['email'] . ')'); ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="delegatee_id" class="control-label">Penerima Delegasi (Delegatee) <span class="text-danger">*</span></label>
                    <select name="delegatee_id" id="delegatee_id" class="selectpicker" data-width="100%" data-live-search="true" required>
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
                            <label for="start_date" class="control-label">Tanggal Mulai <span class="text-danger">*</span></label>
                            <input type="text" name="start_date" id="start_date" class="form-control datetimepicker" required autocomplete="off">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="end_date" class="control-label">Tanggal Selesai <span class="text-danger">*</span></label>
                            <input type="text" name="end_date" id="end_date" class="form-control datetimepicker" required autocomplete="off">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="reason" class="control-label">Alasan Delegasi</label>
                    <textarea name="reason" id="reason" class="form-control" rows="3" placeholder="Contoh: Cuti tahunan / Perjalanan dinas"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-info">Simpan Delegasi</button>
            </div>
            <?= form_close(); ?>
        </div>
    </div>
</div>

<?php init_tail(); ?>
