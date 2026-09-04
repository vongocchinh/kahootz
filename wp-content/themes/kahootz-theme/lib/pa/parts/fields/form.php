
<form 
  method="<?php echo strtolower($data['method']); ?>" 
  action="<?php echo $data['filter'] ? home_url() . $data['action'] : null; ?>" 
  enctype="multipart/form-data"
  id="<?php echo $id; ?>"
  autocomplete="off"
  data-pa-form="true"
  class="pa-form <?php echo is_admin() ? 'hidden' : null; ?>"
>
  <?php
    do_action('pa_notices', $id);
  
    foreach ($render as $form):

      pa::render($form, $data);

    endforeach;
      
    pa('field', array(
      'type' => 'hidden'
      ,'scope' => pa::$prefix
      ,'field' => 'form_id'
      ,'value' => $id
    ));
    
    if ($data['filter']):

      pa('field', array(
        'type' => 'hidden'
        ,'scope' => pa::$prefix
        ,'field' => 'filter'
        ,'value' => 'true'
      ));

    endif;
    
    if ($data['redirect']):

      pa('field', array(
        'type' => 'hidden'
        ,'scope' => pa::$prefix
        ,'field' => 'redirect'
        ,'value' => $data['redirect']
      ));

    endif;
    
    if (pa_admin::hide_ui()):

      pa('field', array(
        'type' => 'hidden'
        ,'scope' => pa::$prefix
        ,'field' => 'admin_hide_ui'
        ,'value' => 'true'
      ));

    endif;
  
    pa_form::save_fields(); 
  ?>  
</form>