<?php
/*  
Title: Shortcode
Method: post
Message: Shortcode Updated.
*/

  $shortcode = isset($_REQUEST[pa::$prefix . 'shortcode']) ? $_REQUEST[pa::$prefix . 'shortcode'] : null;
  $shortcode_data = isset($_REQUEST[pa::$prefix . 'shortcode_data']) ? $_REQUEST[pa::$prefix . 'shortcode_data'] : null;
  $shortcodes = pa_shortcode::$shortcodes;
  
  ksort($shortcodes);
  
  $name = isset($shortcode_data['name']) ? $shortcode_data['name'] : false;
  $action = isset($shortcode_data['action']) ? $shortcode_data['action'] : false;
  $index = empty($shortcode_data) ? -1 : array_key_exists('index', $shortcode_data) ? $shortcode_data['index'] : -1;
  
  if (in_array($action, array('insert', 'update'))):
    
    $forms = array();
    
    if (isset($shortcodes[$name])):

      foreach ($shortcodes[$name]['render'] as $render):
        
        if (strstr($render, '-form.php')):
       
          array_push($forms, $render);
      
        endif;
        
      endforeach;

    endif;

    if (!empty($forms)):
      
      $data = $shortcode_data;
      $data['attributes'] = $shortcode;
      $data['index'] = $index;
        
      if (isset($_REQUEST[pa::$prefix . 'post'])):
        
        $data['post_id'] = (int) $_REQUEST[pa::$prefix . 'post']['ID'];
      
      endif;
        
      foreach ($forms as $form):
        
        pa::render($form, array(
          'shortcode' => $data
        ));
      
      endforeach;
      
    elseif ($shortcode):
        
      foreach ($shortcode as $attribute => $value):
        
        pa('field', array(
          'type' => 'text'
          ,'scope' => 'shortcode'
          ,'field' => $attribute
          ,'label' => pa::humanize($attribute)
          ,'attributes' => array(
            'class' => 'large-text'
          )
        ));
      
      endforeach;

    endif;
    
    foreach ($shortcode_data as $attribute => $value):

      switch ($attribute):

        case 'content':

          pa('field', array(
            'type' => 'editor'
            ,'scope' => 'shortcode_data'
            ,'field' => $attribute
            ,'label' => __('Shortcode Content', 'pa')
            ,'description' => __('This is the content that the shortcode is wrapped around.', 'pa')
            ,'options' => array(
              'shortcode_buttons' => true
            )
          ));

        break;
  
        default:

          pa('field', array(
            'type' => 'hidden'
            ,'scope' => 'shortcode_data'
            ,'field' => $attribute
          ));

        break;

      endswitch;

    endforeach;
?>    
  
  <div id="pa-thickbox-actions">
    
    <?php
      pa('field', array(
        'type' => 'submit'
        ,'field' => 'action'
        ,'template' => 'field'
        ,'value' => __($action == 'insert' ? 'Insert into editor' : 'Update')
        ,'attributes' => array(
          'class' => 'button button-primary'
        )
      ));
    ?>

    <?php if ($action == 'insert'): ?>
      
      <a href="javascript:history.back(1);" class="button">&larr; <?php _e('Back'); ?></a>
    
    <?php endif; ?>
    
  </div>

<?php    
  else:
?>

  <ul class="attachments pa-shortcodes">
    
    <?php foreach ($shortcodes as $shortcode => $data): ?>
    
      <li class="attachment" title="<?php echo esc_attr($data['data']['description']); ?>" data-pa-shortcode="<?php echo esc_attr($data['data']['shortcode']); ?>">
        <div class="attachment-preview landscape">
          <div class="thumbnail">
            <div class="centered">
              <?php if (substr($data['data']['icon'], 0, strlen('dashicons-')) == 'dashicons-'): ?>
                <div class="dashicons <?php echo esc_attr($data['data']['icon']); ?>"></div>
              <?php elseif (file_exists($data['data']['icon'])): ?>
                <img src="<?php echo esc_attr($data['data']['icon']); ?>" class="icon" />
              <?php else: ?>
                <div class="dashicons dashicons-media-code"></div>
              <?php endif; ?>
            </div>
            <div class="filename">
              <div><?php echo esc_attr($data['data']['name']); ?></div>
            </div>
          </div>
        </div>
      </li>
    
    <?php endforeach; ?>
  
  </ul>
  
<?php      
      
    pa('field', array(
      'type' => 'hidden'
      ,'scope' => 'shortcode_data'
      ,'field' => 'name'
    ));

    pa('field', array(
      'type' => 'hidden'
      ,'scope' => 'shortcode_data'
      ,'field' => 'action'
      ,'value' => 'insert'
    ));

  endif; 