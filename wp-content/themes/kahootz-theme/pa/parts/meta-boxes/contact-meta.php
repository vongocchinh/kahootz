<?php
/*
Title: Lead Information
Post Type: contact
*/

// These fields are typically populated by the frontend form.
pa('field', array(
  'type' => 'text',
  'field' => 'contact_email',
  'label' => 'Email',
  'attributes' => array('class' => 'regular-text', 'readonly' => 'readonly')
));

pa('field', array(
  'type' => 'text',
  'field' => 'contact_phone',
  'label' => 'Phone',
  'attributes' => array('class' => 'regular-text', 'readonly' => 'readonly')
));

pa('field', array(
  'type' => 'text',
  'field' => 'contact_business',
  'label' => 'Business Name',
  'attributes' => array('class' => 'regular-text', 'readonly' => 'readonly')
));

pa('field', array(
  'type' => 'text',
  'field' => 'contact_looking_for',
  'label' => 'Looking For',
  'attributes' => array('class' => 'regular-text', 'readonly' => 'readonly')
));

pa('field', array(
  'type' => 'textarea',
  'field' => 'contact_message',
  'label' => 'Message',
  'attributes' => array('rows' => 6, 'class' => 'large-text', 'readonly' => 'readonly')
));
