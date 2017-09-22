<?php
  error_reporting(0);
  $link = cs_get_option('i_post_link');
  $related = cs_get_option('i_post_related');
  $date = cs_get_option('i_post_date');
  $view = cs_get_option('i_post_view');
  $com = cs_get_option('i_post_com');
  $cat = cs_get_option('i_post_cat');
  $tag = cs_get_option('i_post_tag');
  $like = cs_get_option('i_post_like');
?>

<?php get_header(); ?>

  <div class="posts">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
      <?php setPostViews(get_the_ID());?>
        <article <?php post_class('single-post'); ?>>
          <?php if (!is_mobile()) { ?>
            <div class="post-top clearfix">
              <?php if ($view) { ?>
                <div class="item view f13 fl">
                  <i class="fa fa-eye" aria-hidden="true"></i>
                  <?php echo getPostViews(get_the_ID()); ?>
                </div>
              <?php } ?>
              <?php if ($date) { ?>
                <div class="item date f13 fl">
                  <i class="fa fa-clock-o" aria-hidden="true"></i>
                  <?php the_time('Y'); ?> 年 <?php the_time('m'); ?> 月 <?php the_time('d'); ?> 日
                </div>
              <?php } ?>
              <?php if(current_user_can('level_10')){ ?>
                <div class="item edit f13 fr">
                  <?php edit_post_link('<i class="fa fa-edit"></i>编辑', '<div class="edit-link">', '</div>' ); ?>
                </div>
              <?php } ?>
            </div>
          <?php } ?>
          <div class="post-wrap">
            <?php get_template_part('format', 'standard'); ?>
            <?php if ($link && !is_mobile()) { ?>
              <div class="post-copyright text-c">
                <div class="post-copyright-inner">
                  转载原创文章请注明，转载自：
                  <a href="<?php bloginfo('url'); ?>" title="<?php bloginfo('name'); ?>">
                    <?php bloginfo('name'); ?>
                  </a>
                   »
                  <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                    <?php the_title(); ?>
                  </a>
                </div>
              </div>
            <?php } ?>

            <?php if ($related && !is_mobile()) { ?>
              <div class="post-related">
                <ul class="related_box clearfix">
                  <?php
                    $post_num = 4;
                    $exclude_id = $post->ID;
                    $posttags = get_the_tags(); $i = 0;
                    if ($posttags) {
                        $tags = ''; foreach ( $posttags as $tag ) $tags .= $tag->term_id . ',';
                        $args = array(
                          'post_status' => 'publish',
                          'tag__in' => explode(',', $tags),
                          'post__not_in' => explode(',', $exclude_id),
                          'caller_get_posts' => 1,
                          'orderby' => 'comment_date',
                          'posts_per_page' => $post_num
                        );
                        query_posts($args);
                        while( have_posts() ) { the_post(); ?>
                            <li class="fl">
                              <a
                                class="bg-img"
                                href="<?php the_permalink(); ?>"
                                title="<?php the_title(); ?>"
                                style="background-image: url('<?php echo post_thumbnail_src(); ?>')">
                                <p class="bg-gradient text-ellipsis"><?php the_title(); ?></p>
                              </a>
                            </li>
                        <?php
                            $exclude_id .= ',' . $post->ID; $i ++;
                        } wp_reset_query();
                    }
                    if ($i < $post_num) {
                        $cats = ''; foreach ( get_the_category() as $cat ) $cats .= $cat->cat_ID . ',';
                        $args = array(
                          'category__in' => explode(',', $cats),
                          'post__not_in' => explode(',', $exclude_id),
                          'caller_get_posts' => 1,
                          'orderby' => 'comment_date',
                          'posts_per_page' => $post_num - $i
                        );
                        query_posts($args);
                        while( have_posts() ) { the_post(); ?>
                        <li class="fl">
                          <a
                            class="bg-img"
                            href="<?php the_permalink(); ?>"
                            title="<?php the_title(); ?>"
                            style="background-image: url('<?php echo post_thumbnail_src(); ?>')">
                            <p class="bg-gradient text-ellipsis"><?php the_title(); ?></p>
                          </a>
                        </li>
                        <?php $i++;
                        } wp_reset_query();
                    }
                  if ( $i  == 0 )  echo '<div class="r_title"></div>';
                  ?>
                </ul>
              </div>
            <?php } ?>

            <?php if(!is_mobile()) { ?>
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
          </div>
        </article>
      <?php endwhile; ?>
    <?php endif; ?>
    <?php if(is_single() && !is_mobile()) { ?>
      <?php if ('open' == $post->comment_status) { ?>
      <div id="comment-jump" class="comments">
        <?php comments_template(); ?>
      </div>
      <?php } ?>
    <?php } ?>
  </div>

<?php get_footer(); ?>
