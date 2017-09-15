<?php
error_reporting(0);
$keywords = cs_get_option( 'i_seo_keywords' );
$description = cs_get_option( 'i_seo_description' );
$favicon = cs_get_option( 'i_favicon_icon' );
$logo = cs_get_option( 'i_logo' );
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<title><?php if(function_exists('show_wp_title')){show_wp_title();} ?></title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0,minimal-ui">
	<meta name="keywords" content="<?php echo $keywords ?>" />
	<meta name="description" content="<?php echo $description ?>" />
	<link rel="shortcut icon" href="<?php echo $favicon; ?>" title="Favicon">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?> id="top">

	<?php if (is_mobile()) { ?>
		<!-- 微信缩略图 -->
		<div style="display:none;"><?php the_post_thumbnail( 'medium' ); ?></div>
	<?php }?>

	<!-- header 开始-->
	<?php if (!is_mobile()) { ?>
	  <header id="header" class="m_hide">
			<div class="topbar clearfix">
				<div class="skin fl clearfix">
					<a href="<?php echo get_template_directory_uri(); ?>/skin/switcher.php?style=skin01_cloth.css" class="with-tooltip skin-cloth" data-tooltip="布质"></a>
					<a href="<?php echo get_template_directory_uri(); ?>/skin/switcher.php?style=skin02_black.css" class="with-tooltip skin-black" data-tooltip="暗黑"></a>
					<a href="<?php echo get_template_directory_uri(); ?>/skin/switcher.php?style=skin03_paper.css" class="with-tooltip skin-paper" data-tooltip="纸质"></a>
					<a href="<?php echo get_template_directory_uri(); ?>/skin/switcher.php?style=skin04_steam.css" class="with-tooltip skin-steam" data-tooltip="朋克"></a>
				</div>
				<div class="fr clearfix">
					切换
				</div>
			</div>

			<div class="logo">
				<a class="logo_img" href="<?php echo home_url( '/' ); ?>" title="<?php bloginfo('name'); ?>">
					<img src="<?php echo $favicon; ?>" alt="<?php bloginfo('name'); ?>">
				</a>
				<p class="blog_name"><?php bloginfo('name'); ?></p>
			</div>

			<nav class="menu">
				<?php wp_nav_menu(array('theme_location' => 'header', 'container' => 'div','depth' => 2, 'container_class' => 'wrapper', 'menu_class' => 'list clearfix')); ?>
			</nav>

		</header>
		<!-- header 结束-->
	<?php } ?>

	<header id="m-header" class="m_show">
		<div class="m-header-inner colbox">
			<a class="col m-back" href="javascript:history.go(-1)">
				<i class="fa fa-chevron-left" aria-hidden="true"></i>
			</a>
			<a class="col m-logo" href="<?php echo home_url( '/' ); ?>" title="<?php bloginfo('name'); ?>">
				<?php bloginfo('name'); ?>
			</a>
			<a class="col m-menu" href="javascript:void(0)">
				<i class="fa fa-bars" aria-hidden="true"></i>
			</a>
		</div>
	</header>

	<nav id="m-menu" class="m_show">
		<div class="menu-tab clearfix">
			<a href="javascript:void(0)" class="menu-tab-item fl current">菜单</a>
			<a href="javascript:void(0)" class="menu-tab-item fl">分类</a>
			<a href="javascript:void(0)" class="m-menu-close fl"><i class="fa fa-times" aria-hidden="true"></i></a>
		</div>
		<div class="menu-content">
			<?php wp_nav_menu(array('theme_location' => 'header', 'container' => 'div','depth' => 1, 'container_class' => 'menu-wrapper', 'menu_class' => 'menu-list clearfix')); ?>
			<?php wp_nav_menu(array('theme_location' => 'main', 'container' => 'div','depth' => 1, 'container_class' => 'menu-wrapper hide', 'menu_class' => 'menu-list clearfix')); ?>
		</div>
	</nav>

	<!-- content 开始-->
	<section id="content" name="content">
	  <!-- container 开始-->
	  <div class="container">
	    <!-- content-inner 开始-->
	    <div class="content-inner">

	        <?php if (!is_mobile()) { ?>
	          <!-- 分类菜单 开始-->
	          <nav class="mianmenu m_hide">
	              <?php wp_nav_menu(array('theme_location' => 'main', 'container' => 'div','depth' => 2, 'container_class' => 'menu-wrapper', 'menu_class' => 'menu-list header-item clearfix')); ?>
	          </nav>
	          <!-- 分类菜单 结束-->
	        <?php } ?>
