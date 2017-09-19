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

	<!-- wrapper 开始-->
	<div id="wrapper">

		<!-- header 开始-->
		<?php if (!is_mobile()) { ?>
		  <header id="header" class="m_hide">
				<div class="header_inner">
					<div class="topbar clearfix">
						<div class="skin fl clearfix">
							<a href="#" class="with-tooltip skin_1 fl" data-tooltip="布质"></a>
							<a href="#" class="with-tooltip skin_2 fl" data-tooltip="布质"></a>
							<a href="#" class="with-tooltip skin_3 fl" data-tooltip="布质"></a>
							<a href="#" class="with-tooltip skin_4 fl" data-tooltip="布质"></a>
						</div>
						<a class="fr setting f18" href="#">
							<i class="fa fa-cog" aria-hidden="true"></i>
						</a>
					</div>
					<div class="logo text-c">
						<a class="logo_img" href="<?php echo home_url( '/' ); ?>" title="<?php bloginfo('name'); ?>">
							<img src="<?php echo $logo; ?>" alt="<?php bloginfo('name'); ?>">
						</a>
						<p class="blog_name f14"><?php bloginfo('description') ?></p>
					</div>
					<nav class="menu">
						<?php wp_nav_menu(array(
							'theme_location' => 'header',
							'depth' => 2,
							'container_class' => 'menu-wrapper',
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
			<div class="topbar clearfix">
				<div class="fl breadcrumbs">
					breadcrumbs
				</div>
				<div class="fr layouts clearfix">
					<a class="layout_width fl selected" href="#">
            <span></span>
            <span></span>
          </a>
					<a class="layout_box fl" href="#">
            <span style="margin-right:2px"></span>
            <span></span>
            <span style="margin-right:2px"></span>
            <span></span>
          </a>
				</div>
			</div>
	    <div class="content_inner">
