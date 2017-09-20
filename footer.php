<?php
	error_reporting(0);
	$edit = cs_get_option( 'i_footer_edit' );
	$copyright = cs_get_option( 'i_foot_copyright' );
	$gotop = cs_get_option( 'i_gotop' );
	$qrcode = cs_get_option( 'i_qrcode' );
	$qrcodeimg = cs_get_option( 'i_qrcode_image' );
	$comment = cs_get_option( 'i_comment_switch' );
	$player_id = cs_get_option( 'i_player_id' );
	$player = cs_get_option('i_player');
	$player_mobi = cs_get_option('i_player_mobi');
	$shengming = cs_get_option( 'i_download_shengming' );
	$login = cs_get_option( 'i_login' );
	$meta_data = get_post_meta( get_the_ID(), 'standard_options', true );
	$download = $meta_data['i_download'];
	$index = $meta_data['i_index'];
	$footer_text = cs_get_option( 'i_footer_text' );
	$notice = cs_get_option( 'i_notice' );
	$notice_img = cs_get_option( 'i_notice_img' );
	$notice_title = cs_get_option( 'i_notice_title' );
	$notice_text = cs_get_option( 'i_notice_text' );
	$notice_link = cs_get_option( 'i_notice_link' );
?>

			<a href="#top" class="post-top"></a>
		</div>
	</section>
	<!-- content 结束-->

	<!-- footer 开始-->
	<footer id="footer">
		<div class="footer-inner">
      <?php if ($footer_text && !is_mobile()) {?>
        <div class="footer-text wb clearfix m_hide">
            <?php echo $edit ?>
        </div>
      <?php }?>
			<div class="footer-end">
					<?php if(!empty($copyright)){
						echo ''.$copyright.'';
					} else {
						echo'&copy; '.date("Y").' All Rights Reserved.';
					} ?>
					<a href="http://zhw-island.com/" target="_blank"> Theme by Gloom</a>
					<?php if(!empty($tongji)){?>
						echo '<script>'.$tongji.'</script>';
					<?php }?>
			</div>
		</div>
	</footer>
	<!-- footer 结束-->

</div>
<!-- wrapper 结束-->

  <?php if (!is_mobile()) { ?>
		<!-- 浮动按钮 开始 -->
		<div id="footer-btn" class="hide">
			<ul>
				<?php if ($gotop == true) {
					echo '<li class="item">
							<a href="#top" class="icon">
								<i class="hand fa fa-chevron-up"></i>
							</a>
						</li>';
				}?>

				<?php if ($comment == true && is_single ()) {
					echo '<li class="item">
									<a href="#comments" class="comment_btn hand icon"><i class="fa fa-comment-o"></i></a>
								</li>';
				}?>

				<?php if ($qrcode == true) {
					echo '<li class="item">
									<a class="icon" href="javascript:void(0)">
                  	<i class="fa fa-qrcode"></i>
									</a>
									<div class="show-box">
										<div class="show-box-inner qr-box">
											<img src="'. $qrcodeimg .'">
										</div>
									</div>
							</li>';
				}?>
			</ul>
		</div>
		<!-- 浮动按钮 结束 -->
	<?php }?>

	<?php if ($player_mobi == true && is_mobile() ) { }else{ ?>
		<?php if ($player == true && ! empty( $player_id ) && function_exists('cue_playlist') ) {?>
				<!-- 播放器 开始 -->
				<?php cue_playlist( $player_id ); ?>
				<!-- 播放器 结束 -->
		<?php }	 ?>
	<?php }	 ?>

	<?php if ( is_single() && !is_mobile() && $download) {?>
		<!-- 下载弹窗 开始 -->
    <div class="modal-wrap download-modal hide">
      <div class="modal-container">
				<div class="modal-header clearfix">
					<span class="modal-title fl">
						资源下载
					</span>
					<span class="modal-close"></span>
				</div>
        <div class="modal-body text-c">
          <div class="dl-btn">
						<a class="btn" href="javascript:void(0)" target="_black">
							<i class="fa fa-arrow-circle-o-down"></i>点击下载
						</a>
					</div>
          <div class="dl-tqcode">提取码：<span></span></div>
        </div>
        <div class="modal-bottom">
          <span class="ofh">下载声明：<?php echo $shengming ?></span>
        </div>
      </div>
    </div>
		<!-- 下载弹窗 结束 -->
	<?php }	?>

  <?php if ( !is_user_logged_in() && $login == true && !is_mobile() ) { ?>
		<!-- 登陆弹窗 开始 -->
    <div class="modal-wrap login-modal hide">
      <div class="modal-container">
				<div class="modal-header clearfix">
					<span class="modal-title fl">
						登陆
					</span>
					<span class="modal-close"></span>
				</div>
				<div class="modal-body">
					<?php
	            $login_form_args = array (
	                'form_id' => 'login-form',
	                'label_log_in' => '登录',
	                'remember' => false,
	                'value_remember' => false
	            );
	        ?>
	        <?php wp_login_form($login_form_args); ?>
				</div>
				<div class="modal-bottom clearfix">
					<span class="fl">
		          <a href="<?php echo htmlspecialchars(wp_lostpassword_url(get_permalink()), ENT_QUOTES); ?>"><?php echo __('忘记密码', 'pinthis'); ?></a>
		      </span>
		      <?php if (get_option('users_can_register')) { ?>
		          <span class="fr"><?php wp_register('', ''); ?></span>
		      <?php } ?>
				</div>
      </div>
    </div>
		<!-- 登陆弹窗 结束 -->
	<?php }	?>

	<?php if ( $notice == true && !is_mobile()  ) { ?>
		<!-- 公告弹窗 开始 -->
		<div class="notice clearfix hide">
			<div class="notice-img fl">
				<img src="<?php echo $notice_img; ?>" alt="" class="">
			</div>
			<div class="notice-txt fl">
				<h5 class="ofh notice-title ofh">
					<?php echo $notice_title; ?>
				</h5>
				<div class="notice-content wb">
					<?php echo $notice_text; ?>
				</div>
				<div class="notice-btn">
					<a href="<?php echo $notice_link; ?>">阅读更多</a>
					<a href="javascript:void(0)" class="notice-close">关闭</a>
				</div>
			</div>
		</div>
		<!-- 公告弹窗 结束 -->
	<?php }?>

	<?php wp_footer(); ?>

</body>
</html>
