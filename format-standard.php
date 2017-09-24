<?php
  error_reporting(0);
  $excerpt = cs_get_option('i_post_readmore');
  $feature_num = cs_get_option('i_feature_num');

  $view = cs_get_option('i_post_view');
  $date = cs_get_option('i_post_date');
  $view = cs_get_option('i_post_view');
  $com = cs_get_option('i_post_com');
  $cat = cs_get_option('i_post_cat');
  $tag = cs_get_option('i_post_tag');
  $like = cs_get_option('i_post_like');

  $meta_data = get_post_meta(get_the_ID(), 'standard_options', true);
  $music = $meta_data['i_post_music'];
  $download = $meta_data['i_download'];
  $dlview = $meta_data['i_download_view'];
  $web = $meta_data['i_download_web'];
  $charge = $meta_data['i_download_charge'];
  $link = $meta_data['i_download_link'];
  $code = $meta_data['i_download_code'];
?>

<div class="post-inner colbox">
  <?php if (!is_single() && !is_page() && !is_mobile()) { ?>
    <div class="post-left col">
        <div class="post-featured">
          <a
            class="bg-img"
            href="<?php the_permalink(); ?>"
            title="<?php the_title(); ?>"
            <?php if (has_post_thumbnail()) { ?>
              style="background-image: url('<?php the_post_thumbnail_url('large'); ?>')"
            <?php } else { ?>
              style="background-image: url('<?php bloginfo('template_directory'); ?>/images/thumbnails/img<?php echo rand(1, $feature_num)?>.png')"
            <?php } ?>
          >
          </a>
        </div>
      <?php if (!empty($music)) { ?>
        <div class="audio-wrapper">
          <audio class="wp-audio-shortcode" preload="none" style="width: 100%">
            <source type="audio/mpeg" src="<?php echo $music; ?>">
          </audio>
          <?php wp_enqueue_script('mediaelement'); ?>
          <?php wp_enqueue_style('mediaelement'); ?>
          <script>
            jQuery(document).ready(function($) {
              $('.audio-wrapper audio').mediaelementplayer();
            });
          </script>
        </div>
      <?php } ?>
      <?php if (is_sticky()) { ?>
        <div class="post-sticky f12"><i class="fa fa-star" aria-hidden="true"></i>置顶</div>
      <?php } ?>
      <div class="post-tool bg-gradient">
        <?php if ($view) { ?>
          <div class="item view f13">
            <i class="fa fa-eye" aria-hidden="true"></i>
            <?php echo getPostViews(get_the_ID()); ?>
          </div>
        <?php } ?>
        <?php if ($date) { ?>
          <div class="item date f13">
            <i class="fa fa-clock-o" aria-hidden="true"></i>
            <?php the_time('Y'); ?> 年 <?php the_time('m'); ?> 月 <?php the_time('d'); ?> 日
          </div>
        <?php } ?>
      </div>
      <?php if(current_user_can('level_10')){ ?>
        <div class="post-edit f13 hide">
          <?php edit_post_link('<i class="fa fa-edit"></i>编辑', '<div class="edit-link">', '</div>' ); ?>
        </div>
      <?php } ?>
    </div>
  <?php } ?>
  <div class="post-right col">
    <header class="post-title">
      <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
        <?php the_title(); ?>
      </a>
    </header>
    <div class="post-content">
      <?php if(is_search() || is_archive()) { ?>
        <?php the_excerpt('Read More'); ?>
      <?php } else { ?>
        <?php if(is_home()) { ?>
          <?php if ($excerpt == true) {
            the_excerpt('Read More');
          } else {
            the_content('Read More');
          }?>
        <?php } else { ?>
          <?php the_content('Read More'); ?>
        <?php } ?>
      <?php } ?>
    </div>
    <?php if (!is_single() && !is_page() && !is_mobile()) { ?>
      <ul class="post-meta clearfix">
        <?php if ($cat) { ?>
          <li class="mate-cat fl clearfix">
            <i class="fa fa-bookmark fl"></i>
            <div class="fl">
              <?php the_category(''); ?>
            </div>
          </li>
        <?php } ?>
        <?php if ($tag) { ?>
          <?php $posttags = get_the_tags(); if ($posttags) { ?>
            <li class="meta-tabs fl clearfix">
              <i class="fa fa-tags fl"></i>
              <div class="fl">
                <?php the_tags('', ' ', ''); ?>
              </div>
            </li>
          <?php } ?>
        <?php } ?>
        <?php if ($like) { ?>
          <li class="meta-like fr">
            <?php echo getPostLikeLink(get_the_ID()); ?>
          </li>
        <?php } ?>
        <?php if ($com) { ?>
          <li class="mate-com fr">
            <i class="fa fa-comments-o"></i>
            <span class="mate-num">
              <?php comments_number('0', '1', '%');?>
            </span>
          </li>
        <?php } ?>
      </ul>
    <?php } ?>
    <?php if (!is_single() && !is_page() && !is_mobile()) { ?>
      <div class="textload">
        <p class="title"></p>
        <p class="content"></p>
        <p class="content"></p>
        <p class="content"></p>
        <p class="content"></p>
        <p class="content"></p>
      </div>
    <?php } ?>
  </div>
</div>

<?php if ( is_single() && $download && !is_mobile() ) {?>
  <!-- 下载盒子 开始 -->
  <div class="download-wrap">
    <div class="post-download <?php if (!current_user_can('level_10') && $dlview == true){ echo 'dlview'; }?>">
      <p><i class="fa fa-download"></i>资源下载</p>
      <p>官方网站：<a href="<?php echo $web; ?>" target="_black">访问</a></p>
      <p>软件性质：<?php if ($charge == 'i_charge01'){ echo '免费'; } else { echo '收费'; } ?></p>
      <p>下载地址：
        <a class="link" href="<?php echo $link; ?>" target="_blank">点击下载</a>
        <a class="reply" href="javascript:void(0)">资源评论回复可见！</a>
      </p>
      <p>提取密码：<?php if ($code) { echo $code; }else { echo '无';} ?></p>
    </div>
  </div>
  <!-- 下载盒子 结束 -->
<?php } ?>
