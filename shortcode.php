<?php

// 代码高亮
function prefix_code_prettify($atts, $content = '') {
    $atts = shortcode_atts( array(
      'language' => '',
    ), $atts);
    return '<pre class="line-numbers"><code class="language-' .$atts['language']. '">' .$content. '</code></pre>';
}
add_shortcode('code_prettify', 'prefix_code_prettify');

// 文本高亮
function prefix_text_prettify($atts, $content = '') {
    $atts = shortcode_atts( array(
      'type' => '',
    ), $atts);
    return '<blockquote class="type-' .$atts['type']. '">' .$content. '</blockquote>';
}
add_shortcode('text_prettify', 'prefix_text_prettify');
