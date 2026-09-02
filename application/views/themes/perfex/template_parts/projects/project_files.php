<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php if ($project->settings->upload_files == 1) { ?>
  <?php echo form_open_multipart(site_url('clients/project/' . $project->id), ['class' => 'dropzone mbot15', 'id' => 'project-files-upload']); ?>
  <input type="file" name="file" multiple class="hide"/>
  <?php echo form_close(); ?>
  <div class="pull-left mbot20">
    <a href="<?php echo site_url('clients/download_all_project_files/' . $project->id); ?>" class="btn btn-primary">
      <?php echo _l('download_all'); ?>
    </a>
  </div>
  <div class="pull-right mbot20">
   <button type="button" class="btn btn-default" data-toggle="modal" data-target="#gdrive_file_modal">
    <i class="fa-brands fa-google tw-text-red-500 tw-mr-1" aria-hidden="true"></i>
    <?php echo _l('choose_from_google_drive'); ?>
  </button>
  <div id="dropbox-chooser-project-files"></div>
</div>
<div class="modal fade" id="gdrive_file_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">
                    <i class="fa-brands fa-google tw-text-red-500 tw-mr-1"></i>
                    <?php echo _l('choose_from_google_drive'); ?>
                </h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="gdrive_file_url" class="control-label">
                        <small class="req text-danger">* </small>Link / URL Google Drive
                    </label>
                    <input type="url" id="gdrive_file_url" class="form-control" placeholder="https://drive.google.com/file/d/... atau https://docs.google.com/..." required>
                    <span class="help-block tw-text-xs tw-text-neutral-500">Paste link bagikan (share link) dari file, dokumen, spreadsheet, atau folder Google Drive Anda.</span>
                </div>
                <div class="form-group">
                    <label for="gdrive_file_name" class="control-label">Nama File / Dokumen (Opsional)</label>
                    <input type="text" id="gdrive_file_name" class="form-control" placeholder="Contoh: Dokumen Perencanaan Q3">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo _l('close'); ?></button>
                <button type="button" class="btn btn-primary" id="save_gdrive_link_btn"><?php echo _l('submit'); ?></button>
            </div>
        </div>
    </div>
</div>
<?php } ?>
<table class="table dt-table" data-order-col="4" data-order-type="desc">
  <thead>
    <tr>
      <th><?php echo _l('project_file_filename'); ?></th>
      <th><?php echo _l('project_file__filetype'); ?></th>
      <th><?php echo _l('project_discussion_last_activity'); ?></th>
      <th><?php echo _l('project_discussion_total_comments'); ?></th>
      <th><?php echo _l('project_file_dateadded'); ?></th>
      <?php if (get_option('allow_contact_to_delete_files') == 1) { ?>
        <th><?php echo _l('options'); ?></th>
      <?php } ?>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($files as $file) {
    $path = get_upload_path_by_type('project') . $project->id . '/' . $file['file_name']; ?>
      <tr>
       <td data-order="<?php echo $file['file_name']; ?>">
        <a href="#" onclick="view_project_file(<?php echo $file['id']; ?>,<?php echo $file['project_id']; ?>); return false;">
         <?php if (is_image(PROJECT_ATTACHMENTS_FOLDER . $project->id . '/' . $file['file_name']) || (!empty($file['external']) && !empty($file['thumbnail_link']))) {
        echo '<div class="text-left"><i class="fa fa-spinner fa-spin mtop30"></i></div>';
        echo '<img class="project-file-image img-table-loading" src="#" data-orig="' . project_file_url($file, true) . '" width="100">';
        echo '</div>';
    }
    echo $file['subject']; ?></a>
      </td>
      <td data-order="<?php echo $file['filetype']; ?>"><?php echo $file['filetype']; ?></td>
      <td data-order="<?php echo $file['last_activity']; ?>">
        <?php
        if (!is_null($file['last_activity'])) {
            echo time_ago($file['last_activity']);
        } else {
            echo _l('project_discussion_no_activity');
        } ?>
      </td>
      <?php $total_file_comments = total_rows(db_prefix() . 'projectdiscussioncomments', ['discussion_id' => $file['id'], 'discussion_type' => 'file']); ?>
      <td data-order="<?php echo $total_file_comments; ?>">
        <?php echo $total_file_comments; ?>
      </td>
      <td data-order="<?php echo $file['dateadded']; ?>">
       <?php echo _dt($file['dateadded']); ?>
     </td>
     <?php if (get_option('allow_contact_to_delete_files') == 1) { ?>
       <td>
        <?php if ($file['contact_id'] == get_contact_user_id()) { ?>
          <a href="<?php echo site_url('clients/delete_file/' . $file['id'] . '/project'); ?>" class="btn btn-danger btn-icon _delete"><i class="fa fa-remove"></i></a>
        <?php } ?>
      </td>
    <?php } ?>
  </tr>
<?php
} ?>
</tbody>
</table>
<div id="project_file_data"></div>
