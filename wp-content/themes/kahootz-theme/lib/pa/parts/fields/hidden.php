
<input 
  type="hidden"
  id="<?php echo pa_form::get_field_id($arguments); ?>" 
  name="<?php echo pa_form::get_field_name($arguments); ?>"
  value="<?php echo is_array($value) ? esc_attr(end($value)) : esc_attr($value); ?>" 
  <?php echo pa_form::attributes_to_string($attributes); ?>
/>
