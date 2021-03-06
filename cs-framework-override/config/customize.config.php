<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.
// ===============================================================================================
// -----------------------------------------------------------------------------------------------
// CUSTOMIZE SETTINGS
// -----------------------------------------------------------------------------------------------
// ===============================================================================================
$options              = array();

// -----------------------------------------
// Gloom密钥验证                   -
// -----------------------------------------
$options[]            = array(
  'name'              => 'Gloom',
  'title'             => 'Gloom密钥验证',
  'settings'          => array(
    array(
      'name'          => 'Gloom_key',
      'control'       => array(
        'label'       => '密钥',
        'wrap_class'  => 'hide',
        'class'       => 'hide',
        'type'        => 'password',
      ),
    ),

  )
);

CSFramework_Customize::instance( $options );
