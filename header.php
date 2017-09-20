<?php
	error_reporting(0);
	$keywords = cs_get_option('i_seo_keywords');
	$description = cs_get_option('i_seo_description');
	$favicon = cs_get_option('i_favicon_icon');
	$logo = cs_get_option('i_logo' );
	$switcher = cs_get_option('i_switcher');
	$setting = cs_get_option('i_setting');
	$layout = cs_get_option('i_layout');
	$notices = cs_get_option('i_notices');
	$notices_text = cs_get_option('i_notices_text');
	$notices_effect = cs_get_option('i_notices_effect');
	$layout_list = cs_get_option('i_layout_list');
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
	<div id="wrapper" class="<?php echo $layout_list; ?>">

		<!-- header 开始-->
		<?php if (!is_mobile()) { ?>
		  <header id="header" class="m_hide">
				<div class="header_inner">
					<div class="topbar clearfix">
						<?php if ($switcher) {?>
							<div class="skin clearfix">
								<a href="<?php echo get_template_directory_uri(); ?>/skin/switcher.php?style=skin01.css" class="with-tooltip skin01" data-tooltip="布质"></a>
								<a href="<?php echo get_template_directory_uri(); ?>/skin/switcher.php?style=skin02.css" class="with-tooltip skin02" data-tooltip="暗黑"></a>
							</div>
						<?php } ?>
						<?php if ($setting) {?>
							<a class="fr setting f18" href="#">
								<i class="fa fa-cog" aria-hidden="true"></i>
							</a>
						<?php } ?>
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
				<?php if ($notices) {?>
					<i class="fa fa-bell-o fl" aria-hidden="true"></i>
					<div class="fl notices" data-effect="<?php echo $notices_effect; ?>" data-notices="<?php echo $notices_text; ?>"></div>
				<?php } ?>
				<?php if ($layout) {?>
					<div class="fr layouts clearfix">
						<a class="layout layout_width fl on" href="#">
	            <span></span>
	            <span></span>
	          </a>
						<a class="layout layout_box fl" href="#">
	            <span style="margin-right:2px"></span>
	            <span></span>
	            <span style="margin-right:2px"></span>
	            <span></span>
	          </a>
					</div>
				<?php } ?>
			</div>
	    <div class="content_inner">
