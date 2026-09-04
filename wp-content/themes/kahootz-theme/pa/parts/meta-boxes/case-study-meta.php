<?php
/*
Title: Case Study Details
Post Type: case_study
*/

pa('field', array(
  'type' => 'text',
  'field' => 'service_provided',
  'label' => 'Service Provided',
  'attributes' => array('class' => 'regular-text', 'placeholder' => 'e.g. SEO & Content Strategy')
));

pa('field', array(
  'type' => 'text',
  'field' => 'result_metric',
  'label' => 'Result Metric',
  'attributes' => array('class' => 'regular-text', 'placeholder' => 'e.g. +240% Organic Traffic')
));

pa('field', array(
  'type' => 'textarea',
  'field' => 'challenge',
  'label' => 'The Challenge',
  'attributes' => array('rows' => 4, 'class' => 'large-text')
));

pa('field', array(
  'type' => 'textarea',
  'field' => 'what_we_did',
  'label' => 'What We Did',
  'attributes' => array('rows' => 4, 'class' => 'large-text')
));

pa('field', array(
  'type' => 'textarea',
  'field' => 'results_detail',
  'label' => 'Detailed Results',
  'attributes' => array('rows' => 4, 'class' => 'large-text')
));

pa('field', array(
  'type' => 'textarea',
  'field' => 'client_quote',
  'label' => 'Client Quote',
  'attributes' => array('rows' => 3, 'class' => 'large-text')
));

pa('field', array(
  'type' => 'text',
  'field' => 'client_name',
  'label' => 'Client Name (for Quote)',
  'attributes' => array('class' => 'regular-text', 'placeholder' => 'e.g. Jason Loftus, Sunseeker Asia')
));
