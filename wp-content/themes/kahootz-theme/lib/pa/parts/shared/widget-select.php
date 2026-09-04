
<?php if (!empty($widgets)): ?>
  
  <div class="pa-universal-widget-select-container">
    
    <?php
      $choices = array(
        '' => __('Select a Widget', 'pa')
      );

      foreach ($widgets as $w):
      
        if ($widget == $w['id']):
          $widget_data = $w;
        endif;
      
        $choices[$w['id']] = $w['data']['title'];
      
      endforeach;
    
      $default_widget = current($widgets);
      
      pa('field', array(
        'type' => 'select'
        ,'field' => 'widget'
        ,'label' => __('Select a Widget', 'pa')
        ,'attributes' => array(
          'class' => array(
            'widefat'
            ,$class_name . '-select'
          )
          ,'data-pa-addon' => $default_widget['add_on']
        )
        ,'position' => 'wrap'
        ,'choices' => $choices
        ,'value' => $widget
      ));
      
      $data_attributes = '';
      
      if (isset($widget_data)):
     
        $data_attributes .= 'data-widget-title="' . $widget_data['data']['title'] . '" data-widget-height="' . $widget_data['data']['height'] . '" data-widget-width="' . $widget_data['data']['width'] . '"';
     
      endif;
    ?>
    
    <p>
      <?php
       if (isset($widgets[$widget])):
     
         echo $widgets[$widget]['data']['description']; 
     
       endif;
      ?>
    </p>
      
  </div>

  <div class="pa-universal-widget-form-container" <?php echo $data_attributes; ?>>
    
    <?php 
      if ($widget):
        
        do_action('pa_notices');
        
        foreach ($forms[$widget]['render'] as $render):
          pa::render($render, array(
            'instance' => $instance
          ));
        endforeach;

        pa_form::save_fields();
      
      endif;
    ?>
    
  </div>

<?php else: ?>
  
  <p>
    <em><?php _e('There are currently no Widgets available.', 'pa'); ?></em>
  </p>
  
  <h4><?php _e('Learn to make Widgets', 'pa'); ?></h4>
  
  <p>
    <?php _e('Check out the documentation for how to easily build your own custom widgets!', 'pa')?>
  </p>  
  
<?php endif; ?>
