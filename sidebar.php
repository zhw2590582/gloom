<?php
  error_reporting(0);
  $profile = cs_get_option('i_profile');
  $profile_avatar = cs_get_option('i_profile_avatar');
  $profile_name = cs_get_option('i_profile_name');
  $profile_title = cs_get_option('i_profile_title');
  $profile_content = cs_get_option('i_profile_content');
?>
<!-- sidebar 开始-->
<aside id="sidebar">
  <div class="sidebar_inner">
    <div class="item">
      <?php if ($profile == true) {?>
        <aside id="profile" class="widget">
          <div class="profile-header clearfix">
            <div class="avatar fl avatar-img">
              <img src="<?php echo $profile_avatar; ?>" alt="" />
            </div>
            <div class="name fl">
              <p class="f16 text-ellipsis name_inner"><?php echo $profile_name; ?></p>
              <p class="f13 text-ellipsis">
                <i class="fa fa-check-circle f14" aria-hidden="true"></i>
                <?php echo $profile_title; ?>
              </p>
            </div>
          </div>
          <div class="profile-content f13">
            <?php echo $profile_content; ?>
          </div>
          <ul class="profile-social clearfix">
             <?php
                 $my_socials = cs_get_option( 'i_social' );
                 if(!empty($my_socials)) {
                   foreach ($my_socials as $social) {
                     $iconstyle = $social['i_icon_style'];
                     echo '<li>';
                     if(!empty( $social['i_social_link'])){
                       echo '<a href="'. $social['i_social_link'] .'" class="with-tooltip" data-tooltip="'. $social['i_social_title'] .'"';
                     } else {
                       echo '<a href="javascript:void(0)"  class="with-tooltip" data-tooltip="'. $social['i_social_title'] .'" ';
                     }
                     if ($social['i_social_newtab'] == true){
                       echo 'target="_black"';
                     }
                     if ($iconstyle == 'i_icon'){
                       echo '><i class="'. $social['i_social_icon'] .'"></i>';
                     } else {
                       echo '><img src="'. $social['i_social_image'] .'">';
                     }
                     echo '</a>';
                     echo '</li>';
                   }
                 }
             ?>
         </ul>
        </aside>
      <?php }?>
      <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('Widget1') ) : else : ?>
      <?php endif; ?>
    </div>
    <div class="item hide">
      <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('Widget2') ) : else : ?>
      <?php endif; ?>
    </div>
  </div>
</aside>
<div class="sidebar_switcher">
  <div class="sidebar_switcher_inner hand">
    <i class="fa fa-angle-left" aria-hidden="true"></i>
    <i class="fa fa-angle-right" aria-hidden="true"></i>
  </div>
</div>
<!-- sidebar 结束-->
