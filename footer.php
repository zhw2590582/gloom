<?php
	error_reporting(0);
	$edit = cs_get_option('i_footer_edit');
	$copyright = cs_get_option('i_foot_copyright');
	$gotop = cs_get_option('i_gotop');
	$comment = cs_get_option('i_comment_switch');
	$player_id = cs_get_option( 'i_player_id');
	$player = cs_get_option('i_player');
	$footer_text = cs_get_option('i_footer_text');
	$notice = cs_get_option('i_notice');
	$notice_img = cs_get_option('i_notice_img');
	$notice_title = cs_get_option('i_notice_title');
	$notice_text = cs_get_option('i_notice_text');
	$notice_link = cs_get_option('i_notice_link');
	$tongji = cs_get_option('i_js_tongji');
?>

			<a href="#top" class="post-top"></a>
		</div>
	</section>
	<!-- content 结束-->

	<!-- footer 开始-->
	<?php if (!is_mobile()) { ?>
		<footer id="footer">
			<div class="footer-inner">
	      <?php if ($footer_text && !is_mobile()) {?>
	        <div class="footer-text wb clearfix">
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
				</div>
			</div>
		</footer>
		<!-- footer 结束-->
	<?php }?>

</div>
<!-- wrapper 结束-->

  <?php if (!is_mobile()) { ?>
		<!-- 浮动按钮 开始 -->
		<div id="footer-btn" class="hide">
			<?php if($gotop) { ?>
				<a href="#top" class="top_btn">
					<i class="fa fa-angle-up" aria-hidden="true"></i>
				</a>
			<?php } ?>
			<?php if($comment && is_single ()) { ?>
				<a href="#comments" class="comment_btn">
					<i class="fa fa-comment-o" aria-hidden="true"></i>
				</a>
			<?php } ?>
		</div>
		<!-- 浮动按钮 结束 -->
	<?php }?>

	<?php if ($player && !empty($player_id) && function_exists('cue_playlist') && !is_mobile()) {?>
		<!-- 播放器 开始 -->
		<?php cue_playlist( $player_id ); ?>
		<!-- 播放器 结束 -->
	<?php }?>

	<?php if ( $notice == true && !is_mobile()  ) { ?>
		<!-- 公告弹窗 开始 -->
		<div class="notice-pop clearfix">
			<div class="notice-img fl">
				<img src="<?php echo $notice_img; ?>" alt="" class="">
			</div>
			<div class="notice-txt fl">
				<div class="ofh notice-title text-ellipsis">
					<?php echo $notice_title; ?>
				</div>
				<div class="notice-content">
					<?php echo $notice_text; ?>
				</div>
				<div class="notice-btn f12">
					<a href="<?php echo $notice_link; ?>">阅读更多</a>
					<a href="javascript:void(0)" class="notice-close">关闭</a>
				</div>
			</div>
		</div>
		<!-- 公告弹窗 结束 -->
	<?php }?>

	<?php if(!empty($tongji)){?>
		<!-- 统计代码 开始 -->
		<div class="hide"><script><?php echo $tongji; ?></script></div>
		<!-- 统计代码 结束 -->
	<?php }?>

	<?php wp_footer(); ?>
</body>
</html>
