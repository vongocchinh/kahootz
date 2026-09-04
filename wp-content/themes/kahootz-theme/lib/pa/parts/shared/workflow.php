
<div class="pa-workflow">

  <?php 
    foreach ($workflows as $tab):
      if ($tab['data']['header']):
        pa::render($tab['part'], array(
          'data' => $tab
        ));
      endif;
    endforeach;
  ?>
    
  <div class="pa-workflow-tabs-container">
    
    <ul class="pa-workflow-tabs">

      <?php 
        foreach ($workflows as $tab):
          if (!$tab['data']['header']):
            if ($layout == 'bar'):
              ?><li><a class="<?php echo $tab['data']['active'] ? 'pa-workflow-tab-current' : null; ?>" <?php echo $tab['url'] ? 'href="' . esc_url($tab['url']) . '"' : null; ?>><?php _e($tab['data']['title']); ?></a></li><?php
            else:
              ?><a class="pa-workflow-tab <?php echo $tab['data']['active'] ? 'pa-workflow-tab-active' : null; ?>" <?php echo $tab['url'] ? 'href="' . esc_url($tab['url']) . '"' : null; ?>><?php _e($tab['data']['title']); ?></a><?php
            endif;
          endif;
        endforeach;
      ?>
  
    </ul>

    <?php do_action('pa_workflow_flow_append', $tab['data']['flow_slug']); ?>
    
  </div>

  <?php if (isset($active['parts'])): ?>

    <div class="pa-workflow-tabs-container">
  
      <ul class="pa-workflow-tabs-sub">
    
        <?php foreach ($active['parts'] as $order => $part): ?>
      
          <li class="pa-workflow-tabs-sub"><a <?php echo $part['url'] ? 'href="' . esc_url($part['url']) . '"' : null; ?> class="<?php echo $part['data']['active'] ? 'current' : null; ?>"><?php _e($part['data']['title']); ?></a> <?php echo $part === end($parts) ? null : '|'; ?></li>

        <?php endforeach; ?>

      </ul>
    
    </div>

  <?php endif; ?>
  
  <?php
    do_action('pa_pre_render_workflow', $active);
  
    pa::render($active['part'], array(
      'data' => $active
    ));
  
    do_action('pa_post_render_workflow', $active);
  ?>

</div>