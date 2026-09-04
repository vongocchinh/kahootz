<?php
/*
Title: Forms
Setting: pa_core
Order: 80
Flow: Pa Core Settings
Tab: General
*/

  pa('field', array(
    'type' => 'checkbox'
    ,'field' => 'form_validate_js'
    ,'label' => __('Javascript Validation', 'pa')
    ,'description' => __('Allow forms to use client side validation using the same rules and methods as the built in server side validation.', 'pa')
    ,'choices' => array(
      'true' => __('Allow', 'pa')
    )
  ));