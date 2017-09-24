<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.
// ===============================================================================================
// -----------------------------------------------------------------------------------------------
// SHORTCODE GENERATOR OPTIONS
// -----------------------------------------------------------------------------------------------
// ===============================================================================================
$options       = array();

// -----------------------------------------
// 常用功能                -
// -----------------------------------------
$options[]     = array(
  'title'      => '常用功能',
  'shortcodes' => array(

    // begin: 代码高亮
    array(
      'name'          => 'code_prettify',
      'title'         => '代码高亮',
      'view'          => 'clone_duplicate',
      'clone_title'   => '添加',
      'clone_fields'  =>
      array(
        array(
          'id'        => 'language',
          'type'      => 'select',
          'title'     => '选择语言',
          'desc'      => '没找到你要的语言？请向作者咨询',
          'options'   => array(
              'html'  => 'Html',
              'css'   => 'Css',
              'js' => 'Javascript',
              'php'   => 'Php',
              'markup' => 'Markup',
              'clike' => 'C-like',
              'json'  => 'JSON',
              'less'  => 'Less',
              'sass'  => 'Sass',
          ) ,
        ),
        array(
          'id'        => 'content',
          'type'      => 'textarea',
          'title'     => '高亮代码',
          'desc'      => '主要Html代码存在转义问题',
        ),
      ),
    ),
    // end: 代码高亮

    // begin: 文本高亮
    array(
      'name'          => 'text_prettify',
      'title'         => '文本高亮',
      'view'          => 'clone_duplicate',
      'clone_title'   => '添加',
      'clone_fields'  =>
      array(
        array(
          'id'        => 'type',
          'type'      => 'select',
          'title'     => '选择类型',
          'options'   => array(
            'red'     => '红色',
            'green'   => '绿色',
            'yellow'  => '黄色',
          ) ,
        ),
        array(
          'id'        => 'content',
          'type'      => 'textarea',
          'title'     => '高亮文本',
        ),
      ),
    ),
    // end: 文本高亮

  ),
);

CSFramework_Shortcode_Manager::instance( $options );
