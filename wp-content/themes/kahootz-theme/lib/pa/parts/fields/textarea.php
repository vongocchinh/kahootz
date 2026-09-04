
<?php $attributes['class'] = array_filter($attributes['class']) ? array_filter($attributes['class'], 'trim') : array('large-text', 'code'); ?>

<textarea
  id="<?php echo pa_form::get_field_id($arguments); ?>" 
  name="<?php echo pa_form::get_field_name($arguments); ?>"
  <?php echo pa_form::attributes_to_string($attributes); ?>
><?php echo is_array($value) ? esc_textarea(end($value)) : esc_textarea($value ?? ""); ?></textarea>
