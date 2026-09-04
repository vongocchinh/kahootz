
<div id="<?php echo $id; ?>" class="notice pa-notice <?php echo (isset($dismiss) && $dismiss == true) || (isset($notice_id) && !empty($notice_id)) ? 'is-dismissible' : 'null'; ?> <?php echo esc_attr((is_admin() ? (isset($notice_type) && $notice_type == 'update' ? 'updated ' : null) : 'pa-notice-') . (isset($notice_type) ? $notice_type : 'updated')); ?>">

  <?php echo pa::has_block_level_tags($content) ? $content : wpautop($content); ?>

</div>
