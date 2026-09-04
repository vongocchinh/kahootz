<?php 
  
  $values = array_keys($choices);
    
  foreach ($choices as $_add_on => $_name):
    if (pa_add_on::$available_add_ons[$_add_on]['plugin']):
      unset($choices[$_add_on]);
    endif;
  endforeach;
  
  $settings = pa_setting::get('settings');
  $values = array_keys($choices);
  $attributes['style'] = 'display: none !important;';
  
  for ($index = 0; $index < count($choices); $index++):
    $active = (!is_array($value) && $value == $values[$index]) || (is_array($value) && in_array($values[$index], $value));
?>
    
    <div class="pa-field-add-on">  
  
      <h3>
        <?php echo pa_add_on::$available_add_ons[$values[$index]]['name']; ?>
      </h3>
    
      <p>
        <?php echo pa_add_on::$available_add_ons[$values[$index]]['description']; ?>
      </p>
    
      <input 
        type="checkbox"
        id="<?php echo pa_form::get_field_id($arguments); ?>" 
        name="<?php echo pa_form::get_field_name($arguments); ?>"
        value="<?php echo esc_attr($values[$index]); ?>"
        <?php echo $active ? 'checked="checked"' : ''; ?>
        <?php echo pa_form::attributes_to_string($attributes); ?>
      />
    
      <a href="#<?php echo pa::dashes(pa_add_on::$available_add_ons[$values[$index]]['name']); ?>" class="button<?php echo $active ? '' : '-primary'; ?> pa-field-add-on-button">
        <?php $active ? _e('Disable','pa') : _e('Activate', 'pa');?>
      </a>

      <?php if (isset($settings[$values[$index]])): ?>
      
        <a href="<?php echo admin_url('admin.php?page=' . $values[$index]); ?>" class="button pa-field-add-on-button-settings">
          <?php _e('Settings','pa'); ?>
        </a>
      
      <?php endif; ?>
    
    </div>

<?php endfor; ?>