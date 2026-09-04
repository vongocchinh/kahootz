<?php
/*
Title: Extend Pa
Setting: pa_core_addons
Tab Order: 0
*/
?>

  <p>
    <?php printf(__('%1$sAdd-ons are Pa plugins%2$s that are included with Pa core, another Pa plugin or your theme. They allow you to turn on additional functionality.', 'pa'), '<a href="https://docs.pa.com/getting-started/pa-add-ons/">', '</a>');?>
  </p>

<?php

  pa('field', array(
    'type' => 'add-ons'
    ,'field' => 'add-ons'
    ,'template' => 'field'
    ,'label' => __('Plugin Add-ons', 'pa')
    ,'choices' => pa(pa_add_on::$available_add_ons, array('add_on', 'name'))
  ));
