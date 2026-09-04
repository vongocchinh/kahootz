
<?php if ($field || (!$field && $type == 'group')): ?>
  
  <?php array_push($attributes['class'], 'pa-field-display pa-field-part'); ?>
  
  <div 
    <?php echo pa_form::attributes_to_string($attributes); ?>
    id="<?php echo pa_form::get_field_id($arguments); ?>" 
    name="<?php echo pa_form::get_field_name($arguments); ?>">

    <?php
      if ((!$field && $type == 'group')):
      
        $value = array();
        
        foreach ($fields as $f):

          $value[$f['field']] = pa_form::get_field_value($scope, $f, $scope, pa_form::get_field_object_id(array('field' => $field, 'scope' => $scope)));
          
        endforeach;
      
      endif;
    ?>

    <?php if (is_array($value)): ?>

      <?php if (count($value) > 1 ): ?>

        <?php 
          if (pa::is_flat($value)):          
      
            echo implode('<br />', $value);
    
          else:
            
            $depth = count(current($value));
            
            for ($i = 0; $i < $depth; $i++):

              foreach ($value as $_key => $_value):
                
                if (pa::is_flat($_value)):
                  
                  echo $_value[$i] . '<br />';
                
                else:
                  
                  foreach ($_value[$i] as $__value):

                    echo $__value . '<br />';
                    
                  endforeach;
                  
                endif;
                  
              endforeach;
              
              if ($depth != $i + 1)
              {
                echo '<hr />';
              }
              
            endfor;
      
          endif; 
        ?>

      <?php else: ?>

        <?php echo implode($value); ?>

      <?php endif; ?>

    <?php else: ?>

      <?php echo $type == 'editor' ? wpautop($value) : $value ; ?>

    <?php endif; ?>

  </div>

<?php elseif (empty($value) && !$field): ?>
  
  <em>&mdash;</em>
  
<?php endif; ?>
