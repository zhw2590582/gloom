<?php

//启用css和js
function Gloom_widget_js() {
    global $wp_customize;
    if (!isset($wp_customize)) {
        wp_enqueue_script(array(
            'jquery',
            'jquery-ui-datepicker',
            'jquery-ui-sortable',
            'jquery-ui-sortable',
            'jquery-ui-draggable',
            'jquery-ui-droppable',
            'admin-widgets'
        ));
    }
}
add_action('admin_enqueue_scripts', 'Gloom_widget_js');

// 博客统计
class EfanBlogStat extends WP_Widget {
    function EfanBlogStat() {
        $widget_ops = array(
            'classname' => 'widget_blogstat',
            'description' => '显示博客的统计信息'
        );
        $this->WP_Widget(false, 'Gloom博客统计', $widget_ops);
    }
    function form($instance) {
        $instance = wp_parse_args((array)$instance, array(
            'title' => '博客统计',
            'establish_time' => '2013-01-27'
        ));
        $title = htmlspecialchars($instance['title']);
        $establish_time = htmlspecialchars($instance['establish_time']);
        $output = '<table>';
        $output.= '<tr><td>标题</td><td>';
        $output.= '<input id="' . $this->get_field_id('title') . '" name="' . $this->get_field_name('title') . '" type="text" value="' . $instance['title'] . '" />';
        $output.= '</td></tr><tr><td>建站日期：</td><td>';
        $output.= '<input id="' . $this->get_field_id('establish_time') . '" name="' . $this->get_field_name('establish_time') . '" type="text" value="' . $instance['establish_time'] . '" />';
        $output.= '</td></tr></table>';
        echo $output;
    }
    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = strip_tags(stripslashes($new_instance['title']));
        $instance['establish_time'] = strip_tags(stripslashes($new_instance['establish_time']));
        return $instance;
    }
    function widget($args, $instance) {
        extract($args);
        $title = apply_filters('widget_title', empty($instance['title']) ? '&nbsp;' : $instance['title']);
        $establish_time = empty($instance['establish_time']) ? '2013-01-27' : $instance['establish_time'];
        echo $before_widget;
        echo $before_title . $title . $after_title;
        echo '<ul>';
        $this->efan_get_blogstat($establish_time);
        echo '</ul>';
        echo $after_widget;
    }
    function efan_get_blogstat($establish_time /*, $instance */) {
        global $wpdb;
        $count_posts = wp_count_posts();
        $published_posts = $count_posts->publish;
        $draft_posts = $count_posts->draft;
        $comments_count = $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->comments");
        $time = floor((time() - strtotime($establish_time)) / 86400);
        $count_tags = wp_count_terms('post_tag');
        $count_pages = wp_count_posts('page');
        $page_posts = $count_pages->publish;
        $count_categories = wp_count_terms('category');
        $link = $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->links WHERE link_visible = 'Y'");
        $users = $wpdb->get_var("SELECT COUNT(ID) FROM $wpdb->users");
        $last = $wpdb->get_results("SELECT MAX(post_modified) AS MAX_m FROM $wpdb->posts WHERE (post_type = 'post' OR post_type = 'page') AND (post_status = 'publish' OR post_status = 'private')");
        $last = date('Y-n-j', strtotime($last[0]->MAX_m));
        $output = '<li>日志总数：';
        $output.= $published_posts;
        $output.= ' 篇</li>';
        $output.= '<li>评论数目：';
        $output.= $comments_count;
        $output.= ' 条</li>';
        $output.= '<li>建站日期：';
        $output.= $establish_time;
        $output.= '</li>';
        $output.= '<li>运行天数：';
        $output.= $time;
        $output.= ' 天</li>';
        $output.= '<li>标签总数：';
        $output.= $count_tags;
        $output.= ' 个</li>';
        if (is_user_logged_in()) {
            $output.= '<li>草稿数目：';
            $output.= $draft_posts;
            $output.= ' 篇</li>';
            $output.= '<li>页面总数：';
            $output.= $page_posts;
            $output.= ' 个</li>';
            $output.= '<li>分类总数：';
            $output.= $count_categories;
            $output.= ' 个</li>';
            $output.= '<li>友链总数：';
            $output.= $link;
            $output.= ' 个</li>';
        }
        if (get_option("users_can_register") == 1) {
            $output.= '<li>用户总数：';
            $output.= $users;
            $output.= ' 个</li>';
        }
        $output.= '<li>最后更新：';
        $output.= $last;
        $output.= '</li>';
        echo $output;
    }
}

function EfanBlogStat() {
    register_widget('EfanBlogStat');
}
add_action('widgets_init', 'EfanBlogStat');

//图像链接
if (!class_exists('CS_Widget_Link')) {
    class CS_Widget_Link extends WP_Widget {
        function __construct() {
            $widget_ops = array(
                'classname' => 'cs_widget_link',
                'description' => '图像链接小工具'
            );
            parent::__construct('cs_widget_link', 'Gloom图像链接', $widget_ops);
        }
        function widget($args, $instance) {
            extract($args);
            echo $before_widget;
            if (!empty($instance['title'])) {
                echo $before_title . $instance['title'] . $after_title;
            }
            $NewTab = $instance['sure'];
            echo '<div class="textwidget">';
            echo '<a href="' . $instance['link'] . '"';
            if ($NewTab == true) {
                echo 'target="_black"';
            }
            echo '><img src="' . $instance['advertising'] . '" />';
            echo '</a>';
            echo '</div>';
            echo $after_widget;
        }
        function update($new_instance, $old_instance) {
            $instance = $old_instance;
            $instance['title'] = $new_instance['title'];
            $instance['advertising'] = $new_instance['advertising'];
            $instance['link'] = $new_instance['link'];
            $instance['sure'] = $new_instance['sure'];
            return $instance;
        }
        function form($instance) {
            $instance = wp_parse_args($instance, array(
                'title' => '图像链接',
                'advertising' => '',
                'link' => '',
                'sure' => '',
            ));
            $text_value = esc_attr($instance['title']);
            $text_field = array(
                'id' => $this->get_field_name('title') ,
                'name' => $this->get_field_name('title') ,
                'type' => 'text',
                'title' => '标题',
            );
            echo cs_add_element($text_field, $text_value);
            $upload_value = esc_attr($instance['advertising']);
            $upload_field = array(
                'id' => $this->get_field_name('advertising') ,
                'name' => $this->get_field_name('advertising') ,
                'type' => 'upload',
                'title' => '图像',
            );
            echo cs_add_element($upload_field, $upload_value);
            $link_value = esc_attr($instance['link']);
            $link_field = array(
                'id' => $this->get_field_name('link') ,
                'name' => $this->get_field_name('link') ,
                'type' => 'text',
                'title' => '链接',
                'attributes' => array(
                    'placeholder' => 'http://...'
                )
            );
            echo cs_add_element($link_field, $link_value);
            $switcher_value = esc_attr($instance['sure']);
            $switcher_field = array(
                'id' => $this->get_field_name('sure') ,
                'name' => $this->get_field_name('sure') ,
                'type' => 'switcher',
                'title' => '新标签打开',
            );
            echo cs_add_element($switcher_field, $switcher_value);
        }
    }
}

if (!function_exists('cs_widget_init_Link')) {
    function cs_widget_init_Link() {
        register_widget('CS_Widget_Link');
    }
    add_action('widgets_init', 'cs_widget_init_Link', 2);
}

// 最新评论
if (!class_exists('CS_Widget_comment')) {
    class CS_Widget_comment extends WP_Widget {
        function __construct() {
            $widget_ops = array(
                'classname' => 'cs_widget_comment',
                'description' => 'Gloom最新评论'
            );
            parent::__construct('cs_widget_comment', 'Gloom最新评论', $widget_ops);
        }
        function widget($args, $instance) {
            extract($args);
            echo $before_widget;
            if (!empty($instance['title'])) {
                echo $before_title . $instance['title'] . $after_title;
            }
            echo '<div class="textwidget" id="comment-list"><ul>';
            h_comments($outer = '博主', $limit = $instance['number']);
            echo '</ul></div>';
            echo $after_widget;
        }
        function update($new_instance, $old_instance) {
            $instance = $old_instance;
            $instance['title'] = $new_instance['title'];
            $instance['number'] = $new_instance['number'];
            return $instance;
        }
        function form($instance) {
            $instance = wp_parse_args($instance, array(
                'title' => '最新评论',
                'number' => '10',
            ));
            $text_value = esc_attr($instance['title']);
            $text_field = array(
                'id' => $this->get_field_name('title') ,
                'name' => $this->get_field_name('title') ,
                'type' => 'text',
                'title' => '标题',
            );
            echo cs_add_element($text_field, $text_value);
            $number_value = esc_attr($instance['number']);
            $number_field = array(
                'id' => $this->get_field_name('number') ,
                'name' => $this->get_field_name('number') ,
                'type' => 'number',
                'title' => '数目',
            );
            echo cs_add_element($number_field, $number_value);
        }
    }
}

if (!function_exists('cs_widget_init_comment')) {
    function cs_widget_init_comment() {
        register_widget('CS_Widget_comment');
    }
    add_action('widgets_init', 'cs_widget_init_comment', 2);
}
