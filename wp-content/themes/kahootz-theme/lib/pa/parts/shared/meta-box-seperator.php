
  <?php echo pa_form::template_tag_fetch('field_wrapper', $wrapper, 'end'); ?>

<?php if (!isset($close) || $close): ?>

  </div>

<?php endif; ?>

<div class="pa-meta-box">

  <h3 id="<?php echo $meta_box['id']; ?>" class="pa-meta-box-title"><?php echo $meta_box['data']['title']; ?></h3>

  <?php if (!empty($meta_box['data']['description'])): ?>

    <?php echo wpautop($meta_box['data']['description']); ?>

  <?php endif; ?>

  <?php echo pa_form::template_tag_fetch('field_wrapper', $wrapper, 'start'); ?>

</div>
