<?php
/*
Plugin Name: Simple Page View Counter
Description: A simple plugin to count and display page views.
Version: 1.0
Author: Your Name
*/

function spvc_set_view_count() {
    if (is_single()) {
        global $post;
        $views = get_post_meta($post->ID, 'spvc_views', true);
        $views = $views ? $views : 0;
        $views++;
        update_post_meta($post->ID, 'spvc_views', $views);
    }
}
add_action('wp_head', 'spvc_set_view_count');

function spvc_get_view_count($postID) {
    $views = get_post_meta($postID, 'spvc_views', true);
    return $views ? $views : '0';
}

function spvc_add_view_count_to_content($content) {
    if (is_single()) {
        global $post;
        $views = spvc_get_view_count($post->ID);
        $content .= "<p>This post has been viewed {$views} times</p>";
    }
    return $content;
}
add_filter('the_content', 'spvc_add_view_count_to_content');
?>
