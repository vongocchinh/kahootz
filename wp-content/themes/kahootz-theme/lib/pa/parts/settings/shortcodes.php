<?php
/*
Title: Shortcodes
Setting: pa_core
Order: 30
Flow: Pa Core Settings
Tab: General
*/
  
  pa('field', array(
    'type' => 'group'
    ,'field' => 'shortcode_ui'
    ,'label' => __('Allow Shortcode UI', 'pa')
    ,'add_more' => true
    ,'sortable' => false
    ,'fields' => array(
      array(
        'type' => 'select'
        ,'label' => 'Shortcode'
        ,'field' => 'tag'
        ,'columns' => 4
        ,'choices' => array_merge(array('' => '&mdash; Select &mdash;'), pa_shortcode::get_shortcodes())
        ,'value' => 'pa_form'
      )
      ,array(
        'type' => 'checkbox'
        ,'label' => 'Options'
        ,'field' => 'options'
        ,'columns' => 8
        ,'choices' => array(
          'preview' => 'Preview'
        )
        ,'value' => 'preview'
      )
    )
  ));