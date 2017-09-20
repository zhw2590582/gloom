<?php
  error_reporting(0);
  $slider = cs_get_option('i_slider');
  $slider_effect = cs_get_option('i_slider_effect');
  $pagination = cs_get_option('i_pagination');
  $loadmore = cs_get_option('i_ajax_loading');
  $loadend = cs_get_option('i_ajax_end');
  $loadnum = cs_get_option('i_ajax_num');
?>

<?php get_header(); ?>

        <?php if(is_home() && !is_paged() && $slider) { ?>
          <!-- slider 开始 -->
          <div class="content_header clearfix">
            <div class="header_left fl">
              <div class="sliderWrap" data-effect="<?php echo $slider_effect; ?>">
                <ul>
                  <?php
                      $my_sliders = cs_get_option( 'i_slider_custom' );
                      if(!empty($my_sliders)) {
                        foreach ($my_sliders as $slider) {
                          echo '<li><a class="bg-img" target="_black" href="'. $slider['i_slider_link'] .'" style="background-image: url('. $slider['i_slider_image'] .')">';
                          echo '<p class="text-ellipsis bg-gradient">'. $slider['i_slider_text'] .'</p>';
                          echo '</a></li>';
                        }
                      }
                  ?>
                </ul>
              </div>
            </div>
            <div class="header_right fr">
              <ul class="featured clearfix">
                <?php
                    $my_ad = cs_get_option( 'i_ad_custom' );
                    if(!empty($my_ad)) {
                      foreach ($my_ad as $ad) {
                        echo '<li class="fl"><a class="bg-img" target="_black" href="'. $ad['i_ad_link'] .'" style="background-image: url('. $ad['i_ad_image'] .')">';
                        echo '<p class="text-ellipsis bg-gradient">'. $ad['i_ad_text'] .'</p>';
                        echo '</a></li>';
                      }
                    }
                ?>
              </ul>
            </div>
          </div>
          <!-- slider 结束 -->
        <?php } ?>

        <!-- archive title 开始  -->
        <?php if(is_search()) { ?>
          <h6 class="archive-title">
            <div class="title-inner">
              <?php printf('搜索:  %s', '<span>' . get_search_query() . '</span>' ); ?>
            </div>
          </h6>
        <?php } else if(is_tag()) { ?>
          <h6 class="archive-title">
            <div class="title-inner">
              标签： <?php single_tag_title(); ?>
            </div>
          </h6>
        <?php } else if(is_day()) { ?>
          <h6 class="archive-title">
            <div class="title-inner">
              日期： <?php _e('归档'); ?> <?php echo get_the_date(); ?>
            </div>
          </h6>
        <?php } else if(is_month()) { ?>
          <h6 class="archive-title">
            <div class="title-inner">
              日期： <?php echo get_the_date('F Y'); ?>
            </div>
          </h6>
        <?php } else if(is_year()) { ?>
          <h6 class="archive-title">
            <div class="title-inner">
              日期： <?php echo get_the_date('Y'); ?>
            </div>
          </h6>
        <?php } else if(is_category()) { ?>
          <h6 class="archive-title">
            <div class="title-inner">
              分类： <?php single_cat_title(); ?>
            </div>
          </h6>
        <?php } else if(is_author()) { ?>
          <h6 class="archive-title">
            <div class="title-inner">
              作者： <?php $curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author)); echo $curauth->display_name; ?>
            </div>
          </h6>
        <?php } ?>
        <!-- archive title 结束  -->

        <div
          class="posts clearfix"
          data-pagination="<?php echo $pagination; ?>"
          data-more="<?php echo $loadmore; ?>"
          data-end="<?php echo $loadend; ?>"
          data-num="<?php echo $loadnum; ?>">
          <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
          <?php setPostViews(get_the_ID());?>
          <article <?php post_class('index-post'); ?>>
            <div class="post-wrap">
              <?php get_template_part('format', 'standard'); ?>
            </div>
          </article>
          <?php endwhile; ?>
          <?php endif; ?>
        </div>

        <?php if ($pagination == 'i_ajax') { ?>
          <?php if(island_page_has_nav()) : ?>
            <div class="post-nav">
              <div class="post-nav-inside text-c clearfix">
                <div class="post-nav-left"><?php previous_posts_link('上一页') ?></div>
                <div class="post-nav-right"><?php next_posts_link('下一页') ?></div>
              </div>
            </div>
            <?php endif; ?>
          <?php } else { ?>
          <div class="posts-nav text-c">
            <div class="nav-inside clearfix">
              <?php echo paginate_links(array(
                'prev_text'          =>'<i class="fa fa-chevron-left" aria-hidden="true"></i>',
                'next_text'          =>'<i class="fa fa-chevron-right" aria-hidden="true"></i>',
                'before_page_number' => '',
                'mid_size'           => 2,
              ));?>
            </div>
          </div>
        <?php } ?>

<?php get_footer(); ?>
