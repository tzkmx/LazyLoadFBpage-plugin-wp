<?php

/*
Plugin Name: Lazy Load Facebook Widget
Plugin URI: https://github.com/tzkmx/LazyLoadFBpage-plugin-wp
Description: Widget parsed as FB page by waypoints
Version: 0.1
Author: Jesús E. Franco Martínez
Author URI: https://tzkmx.wordpress.com
License: MIT-3 Clause
*/

add_action( 'wp_enqueue_scripts', function() {
    wp_enqueue_script( 'waypoints', plugins_url( 'js/jquery.waypoints.min.js', __FILE__), ['jquery'], '4.0.1', true);
    wp_enqueue_script( 'waypoints-fb', plugins_url( 'js/lazyload_fb.js', __FILE__ ), ['waypoints'], '0.1', true);
});
include(__DIR__ . '/widget-facebook.php');
