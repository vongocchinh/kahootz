<?php
/*
Title: Testimonial Details
Post Type: testimonial
*/

pa('field', array(
  'type' => 'text',
  'field' => 'kahootz_client_name',
  'label' => 'Client Name',
  'attributes' => array('class' => 'regular-text', 'placeholder' => 'e.g. Jason Loftus')
));

pa('field', array(
  'type' => 'text',
  'field' => 'kahootz_client_company',
  'label' => 'Client Company / Position',
  'attributes' => array('class' => 'regular-text', 'placeholder' => 'e.g. Sunseeker Asia')
));

pa('field', array(
  'type' => 'select',
  'field' => 'kahootz_rating',
  'label' => 'Star Rating',
  'choices' => array(
    '5' => '5 Stars',
    '4' => '4 Stars',
    '3' => '3 Stars',
    '2' => '2 Stars',
    '1' => '1 Star',
  ),
  'default' => '5'
));
