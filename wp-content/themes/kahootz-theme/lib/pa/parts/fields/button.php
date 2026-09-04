
<input 
  type="<?php echo $type; ?>"
  id="<?php echo pa_form::get_field_id($arguments); ?>" 
  name="<?php echo pa_form::get_field_name($arguments); ?>"
  value="<?php echo esc_attr(empty($value) ? $label : $value); ?>" 
  <?php echo pa_form::attributes_to_string($attributes); ?>
/>