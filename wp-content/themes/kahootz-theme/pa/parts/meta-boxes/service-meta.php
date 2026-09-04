<?php
/*
Title: Service Details
Post Type: service
*/

pa('field', array(
  'type'        => 'text',
  'field'       => 'service_icon',
  'label'       => 'Service Icon URL',
  'description' => 'Paste the image URL here. To upload: Media Library → click image → copy URL at bottom right.',
  'attributes'  => array('class' => 'large-text', 'placeholder' => 'https://yoursite.com/wp-content/uploads/icon.png')
));

pa('field', array(
  'type' => 'text',
  'field' => 'hero_subtitle',
  'label' => 'Hero Subtitle',
  'attributes' => array('class' => 'regular-text', 'placeholder' => 'e.g. Content and strategy that actually builds a brand...')
));

pa('field', array(
  'type' => 'group',
  'field' => 'whats_included',
  'label' => 'What\'s Included',
  'add_more' => true,
  'fields' => array(
    array(
      'type' => 'text',
      'field' => 'item',
      'label' => 'Feature Item',
      'columns' => 12,
      'attributes' => array('placeholder' => 'e.g. Technical SEO audits & fixes')
    )
  )
));

pa('field', array(
  'type'  => 'editor',
  'field' => 'why_it_matters',
  'label' => 'Why It Matters / Who It\'s For',
  'options' => array(
    'wpautop'       => true,
    'media_buttons' => false,
    'teeny'         => true
  )
));

pa('field', array(
  'type'  => 'text',
  'field' => 'starting_price',
  'label' => 'Starting Price (card display)',
  'attributes' => array('class' => 'regular-text', 'placeholder' => 'e.g. From $450 / ฿15,000/mo')
));

pa('field', array(
  'type'      => 'group',
  'field'     => 'pricing_tiers',
  'label'     => 'Pricing Tiers',
  'add_more'  => true,
  'sortable'  => true,
  'fields'    => array(
    array(
      'type'       => 'text',
      'field'      => 'tier_name',
      'label'      => 'Tier Name',
      'columns'    => 3,
      'attributes' => array('placeholder' => 'e.g. Starter')
    ),
    array(
      'type'       => 'text',
      'field'      => 'tier_price_thb',
      'label'      => 'Price (฿ THB)',
      'columns'    => 2,
      'attributes' => array('placeholder' => 'e.g. ฿15,000/mo')
    ),
    array(
      'type'       => 'text',
      'field'      => 'tier_price_usd',
      'label'      => 'Price ($ USD)',
      'columns'    => 2,
      'attributes' => array('placeholder' => 'e.g. $450/mo')
    ),
    array(
      'type'       => 'text',
      'field'      => 'tier_best_for',
      'label'      => 'Best For',
      'columns'    => 5,
      'attributes' => array('placeholder' => 'e.g. Businesses building their presence from scratch')
    ),
  )
));
