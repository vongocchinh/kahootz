<?php
/*
Name: Pa Form
Description: Embed a Pa form
Shortcode: pa_form
Icon: dashicons-forms
*/

  $forms = array();
  
  $registered_forms = pa_form::get('forms');
  foreach ($registered_forms as $form)
  {
    if ($form['add_on'] != 'pa')
    {
      if (!isset($forms[$form['add_on']]))
      {
        $forms[$form['add_on']] = array(
          'name' => pa('humanize', $form['add_on'])
          ,'add_on' => $form['add_on']
          ,'forms' => array()
        );
      }
    
      $forms[$form['add_on']]['forms'][$form['id']] = $form['data']['title'] ? $form['data']['title'] : $form['id'];
    }
  }
  
  pa('field', array(
    'type' => 'select'
    ,'field' => 'add_on'
    ,'label' => __('Add-on', 'pa')
    ,'required' => true
    ,'choices' => array('' => 'Select Add-on') + pa($forms, array('add_on', 'name'))
  ));
  
  $fields = array();
  
  foreach ($forms as $data):

    array_push($fields, array(
      'type' => 'radio'
      ,'field' => 'form'
      ,'choices' => $data['forms']
      ,'required' => true
      ,'conditions' => array(
        array(
          'field' => 'add_on'
          ,'value' => $data['add_on']
        )
      )
    ));

  endforeach;
  
  pa('field', array(
    'type' => 'group'
    ,'fields' => $fields
  ));