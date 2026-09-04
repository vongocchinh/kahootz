<?php array_push($attributes['class'], 'pa-field-part'); ?>

<div
  <?php echo pa_form::attributes_to_string($attributes); ?>
  id="<?php echo pa_form::get_field_id($arguments); ?>" 
  name="<?php echo pa_form::get_field_name($arguments); ?>"><?php echo is_array($value) ? implode($value, ' ') : $value; ?></div>
