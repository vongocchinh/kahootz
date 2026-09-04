<?php
/*
Title: Package / Pricing Details
Post Type: package
*/

pa('field', array(
  'type' => 'text',
  'field' => 'package_price',
  'label' => 'Price',
  'attributes' => array('class' => 'regular-text', 'placeholder' => 'e.g. ฿15,000 / $450/mo')
));

pa('field', array(
  'type' => 'text',
  'field' => 'package_best_for',
  'label' => 'Best For',
  'attributes' => array('class' => 'large-text', 'placeholder' => 'e.g. Businesses building their presence from scratch')
));

pa('field', array(
  'type' => 'group',
  'field' => 'package_features',
  'label' => 'Features List',
  'add_more' => true,
  'fields' => array(
    array(
      'type' => 'text',
      'field' => 'feature_name',
      'label' => 'Feature',
      'columns' => 10
    ),
    array(
      'type' => 'checkbox',
      'field' => 'is_included',
      'label' => 'Included?',
      'choices' => array(
        'yes' => 'Yes'
      ),
      'columns' => 2
    )
  )
));
