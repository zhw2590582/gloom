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

	<!-- wrapper 开始-->
	<div id="wrapper">

		<!-- header 开始-->
		<?php if (!is_mobile()) { ?>
		  <header id="header" class="m_hide">
				<div class="header_inner">
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
							<img src="<?php echo $logo; ?>" alt="<?php bloginfo('name'); ?>">
						</a>
						<p class="blog_name"><?php bloginfo('name'); ?></p>
					</div>
					<nav class="menu">
						<?php wp_nav_menu(array(
							'theme_location' => 'header',
							'container' => 'div',
							'depth' => 2,
							'container_class' => 'wrapper',
							'menu_class' => 'list clearfix'
						)); ?>
					</nav>
				</div>
			</header>
			<!-- header 结束-->
		<?php } ?>

		<?php get_sidebar(); ?>

		<!-- content 开始-->
		<section id="content" name="content">
	    <div class="content_inner">

	        <?php if (!is_mobile()) { ?>
	          <!-- 分类菜单 开始-->
	          <nav class="mianmenu m_hide">
	              <?php wp_nav_menu(array('theme_location' => 'main', 'container' => 'div','depth' => 2, 'container_class' => 'menu-wrapper', 'menu_class' => 'menu-list header-item clearfix')); ?>
	          </nav>
	          <!-- 分类菜单 结束-->
	        <?php } ?>
