<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>

<div id="wrapper">
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="main-workflow-header flex justify-between items-center mbot15">
                            <div>
                                <h4 class="no-margin bold">
                                    <i class="fa fa-sitemap menu-icon" aria-hidden="true"></i> 
                                    <?= _l('iwf_dashboard_title'); ?>
                                </h4>
                                <span class="text-muted"><?= _l('iwf_dashboard_subtitle'); ?></span>
                            </div>
                            <div class="btn-group">
                                <?php if (has_permission('invoice_workflow', '', 'manage_approvers')) { ?>
                                    <a href="<?= admin_url('invoice_workflow/approvers'); ?>" class="btn btn-default">
                                        <i class="fa fa-users"></i> <?= _l('iwf_manage_approvers'); ?>
                                    </a>
                                <?php } ?>
                                <?php if (has_permission('invoice_workflow', '', 'manage_delegations')) { ?>
                                    <a href="<?= admin_url('invoice_workflow/delegations'); ?>" class="btn btn-default">
                                        <i class="fa fa-user-plus"></i> <?= _l('iwf_manage_delegations'); ?>
                                    </a>
                                <?php } ?>
                            </div>
                        </div>
                        <hr class="hr-panel-heading" />

                        <!-- Overview Summary Cards -->
                        <div class="row mtop15">
                            <div class="col-md-3 col-sm-6">
                                <div class="iwf-stat-card border-left-blue">
                                    <div class="iwf-stat-number"><?= $total_invoices ?? 0; ?></div>
                                    <div class="iwf-stat-label"><?= _l('iwf_stat_total_in_workflow'); ?></div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="iwf-stat-card border-left-orange">
                                    <div class="iwf-stat-number"><?= count($stuck_invoices ?? []); ?></div>
                                    <div class="iwf-stat-label"><?= _l('iwf_stat_stuck_invoices'); ?></div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="iwf-stat-card border-left-green">
                                    <div class="iwf-stat-number"><?= $total_approvers_count ?? 0; ?></div>
                                    <div class="iwf-stat-label"><?= _l('iwf_stat_active_approvers'); ?></div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="iwf-stat-card border-left-purple">
                                    <div class="iwf-stat-number"><?= $active_delegations_count ?? 0; ?></div>
                                    <div class="iwf-stat-label"><?= _l('iwf_stat_active_delegations'); ?></div>
                                </div>
                            </div>
                        </div>

                        <!-- State Distribution Cards -->
                        <h5 class="bold mtop20 mbot15"><?= _l('iwf_state_distribution'); ?></h5>
                        <div class="row">
                            <?php
                            $states = [
                                'DRAFT' => ['label' => 'Draft / Entry', 'badge' => 'iwf-badge-draft'],
                                'AP_RECEIVER' => ['label' => 'AP Receiver Verification', 'badge' => 'iwf-badge-ap'],
                                'TAX_VERIFICATION' => ['label' => 'Tax Verification', 'badge' => 'iwf-badge-tax'],
                                'TREASURY_VERIFICATION' => ['label' => 'Treasury Verification', 'badge' => 'iwf-badge-treasury'],
                                'SENIOR_MANAGER' => ['label' => 'Senior Manager Approval', 'badge' => 'iwf-badge-sm'],
                                'GM_FINANCE' => ['label' => 'GM Finance Approval', 'badge' => 'iwf-badge-gmf'],
                                'APPROVED' => ['label' => 'Approved (Ready for Pay)', 'badge' => 'iwf-badge-approved'],
                                'REJECTED' => ['label' => 'Rejected', 'badge' => 'iwf-badge-rejected'],
                                'CLOSED' => ['label' => 'Closed', 'badge' => 'iwf-badge-closed'],
                            ];
                            foreach ($states as $stKey => $stMeta) {
                                $count = isset($state_summary[$stKey]) ? $state_summary[$stKey] : 0;
                                ?>
                                <div class="col-md-4 col-sm-6 mbot15">
                                    <div class="panel_s no-margin" style="border: 1px solid #edf2f7;">
                                        <div class="panel-body flex justify-between items-center" style="padding: 12px 15px;">
                                            <div>
                                                <span class="iwf-badge <?= $stMeta['badge']; ?>"><?= $stMeta['label']; ?></span>
                                            </div>
                                            <div class="bold text-lg"><?= $count; ?></div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>

                        <!-- Stuck Invoices Warning Section -->
                        <h5 class="bold mtop25 mbot15 text-danger">
                            <i class="fa fa-exclamation-triangle"></i> <?= _l('iwf_stuck_invoices_table_title'); ?>
                        </h5>
                        <?php if (!empty($stuck_invoices)) { ?>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Invoice #</th>
                                            <th>Status Workflow</th>
                                            <th>Tanggal Masuk State</th>
                                            <th>Durasi Tertahan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($stuck_invoices as $stuck) { ?>
                                            <tr>
                                                <td>
                                                    <a href="<?= admin_url('invoices/list_invoices/' . $stuck['invoice_id']); ?>" target="_blank" class="bold">
                                                        <?= format_invoice_number($stuck['invoice_id']); ?>
                                                    </a>
                                                </td>
                                                <td><?= iwf_state_badge($stuck['current_state']); ?></td>
                                                <td><?= _dt($stuck['entered_at']); ?></td>
                                                <td><span class="label label-warning"><?= $stuck['days_stuck']; ?> hari</span></td>
                                                <td>
                                                    <a href="<?= admin_url('invoices/list_invoices/' . $stuck['invoice_id']); ?>" class="btn btn-default btn-xs">
                                                        <i class="fa fa-eye"></i> Lihat Invoice
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php } else { ?>
                            <div class="alert alert-success mtop10">
                                <i class="fa fa-check-circle"></i> Tidak ada invoice yang tertahan melebihi batas waktu (SLA).
                            </div>
                        <?php } ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php init_tail(); ?>
