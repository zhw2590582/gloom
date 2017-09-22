<?php
	error_reporting(0);
	$keywords = cs_get_option('i_seo_keywords');
	$description = cs_get_option('i_seo_description');
	$favicon = cs_get_option('i_favicon_icon');
	$logo = cs_get_option('i_logo' );
	$switcher = cs_get_option('i_switcher');
	$setting = cs_get_option('i_setting');
	$layout = cs_get_option('i_layout');
	$layout_list = cs_get_option('i_layout_list');
	$notices = cs_get_option('i_notices');
	$notices_text = cs_get_option('i_notices_text');
	$notices_effect = cs_get_option('i_notices_effect');
	$widget1 = cs_get_option('i_widget1');
	$widget2 = cs_get_option('i_widget2');
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>" />
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

		<?php if (is_mobile()) { ?>
			<header id="m-header">
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
					<a href="javascript:void(0)" class="m-menu-close fl">
						<i class="fa fa-times" aria-hidden="true"></i>
					</a>
				</div>
				<div class="menu-content">
					<?php wp_nav_menu(array(
						'theme_location' => 'header',
						'depth' => 1,
						'container_class' => 'menu-wrapper',
						'menu_class' => 'list clearfix'
					)); ?>
				</div>
			</nav>
		<?php } ?>

		<!-- topbar 开始-->
		<?php if (!is_mobile()) { ?>
			<div id="topbar" class="clearfix">
				<div class="item1 fl clearfix">
					<?php if ($switcher) {?>
						<div class="skin fl">
							<a href="<?php echo get_template_directory_uri(); ?>/skin/switcher.php?style=skin01.css" class="skin01"></a>
							<a href="<?php echo get_template_directory_uri(); ?>/skin/switcher.php?style=skin02.css" class="skin02"></a>
						</div>
					<?php } ?>
					<?php if ($setting) {?>
						<div class="fr setting">
							<a class="fr setting-btn f18" href="#">
								<i class="fa fa-cog" aria-hidden="true"></i>
							</a>
							<div class="setting-pop hide">
								<?php if (!is_user_logged_in()) { ?>
									<?php
											$login_form_args = array (
													'form_id' => 'login-form',
													'label_log_in' => '登录',
													'remember' => false,
													'value_remember' => false
											);
											wp_login_form($login_form_args);
									?>
									<div class="setting-bottom clearfix">
										<span class="fl">
											<a href="<?php echo htmlspecialchars(wp_lostpassword_url(get_permalink()), ENT_QUOTES); ?>">忘记密码</a>
										</span>
										<?php if (get_option('users_can_register')) { ?>
											<span class="fr"><?php wp_register('', ''); ?></span>
										<?php } ?>
									</div>
								<?php } else { ?>
									<div class="admin-list">
										<a href="<?php echo admin_url('post-new.php') ; ?>">发文章</a>
										<a href="<?php echo admin_url('edit-comments.php') ; ?>">看评论</a>
										<a href="<?php if(current_user_can('level_10')){
											echo admin_url('admin.php?page=cs-framework');
										} else {
											echo admin_url('index.php');
										} ?>">后台管理</a>
										<a href="<?php echo wp_logout_url(home_url()); ?>">登出</a>
									</div>
								<?php } ?>
							</div>
						</div>
					<?php } ?>
				</div>
				<div class="item2 fl clearfix">
					<div class="widget_btn text-c hand fl text-ellipsis on"><?php echo $widget1; ?></div>
			    <div class="widget_btn text-c hand fr text-ellipsis"><?php echo $widget2; ?></div>
				</div>
				<div class="item3 fl clearfix">
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
			</div>
		<?php } ?>
		<!-- topbar 结束-->

		<!-- header 开始-->
		<?php if (!is_mobile()) { ?>
		  <header id="header">
				<div class="header_inner">
					<div class="logo text-c">
						<a class="logo_img" href="<?php echo home_url('/'); ?>" title="<?php bloginfo('name'); ?>">
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

		<?php if (!is_mobile()) { ?>
			<?php get_sidebar(); ?>
		<?php } ?>

		<!-- content 开始-->
		<section id="content" name="content">
	    <div class="content_inner">
