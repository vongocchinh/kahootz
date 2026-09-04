<?php
/*
Title: Users
Setting: pa_core
Order: 20
Flow: Pa Core Settings
Tab: General
*/

  pa('field', array(
    'type' => 'checkbox'
    ,'field' => 'multiple_user_roles'
    ,'label' => __('Multiple User Roles', 'pa')
    ,'description' => __('Users can be assigned multiple roles.', 'pa')
    ,'help' => __('Changes the user role dropdown to a select box.', 'pa')
    ,'choices' => array(
      'true' => __('Allow', 'pa')
    )
  ));