<?php
/*
Title: Dashboard
Setting: pa_core
Order: 35
Flow: Pa Core Settings
Tab: General
*/

  pa('field', array(
    'type' => 'checkbox'
    ,'field' => 'dashboard_at_a_glance'
    ,'label' => __('"At A Glance" Widget', 'pa')
    ,'choices' => array(
      'true' => __('Use Pa version', 'pa')
    )
  ));