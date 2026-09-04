<?php
/*
Title: Enhancements
Setting: pa_core
Order: 40
Flow: Pa Core Settings
Tab: General
*/

  pa('field', array(
    'type' => 'checkbox'
    ,'field' => 'meta_queries'
    ,'label' => __('Accelerate meta queries', 'pa')
    ,'description' => __('May conflict with certain plugins', 'pa')
    ,'help' => __('Allow Pa to speed up all meta queries in WordPress or any plugin.', 'pa')
    ,'choices' => array(
      'true' => __('Allow', 'pa')
    )
  ));