<?php
/**
 * Child theme functions
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development
 * and http://codex.wordpress.org/Child_Themes), you can override certain
 * functions (those wrapped in a function_exists() call) by defining them first
 * in your child theme's functions.php file. The child theme's functions.php
 * file is included before the parent theme's file, so the child theme
 * functions would be used.
 *
 * Text Domain: velocity
 * @link http://codex.wordpress.org/Plugin_API
 *
 */

/**
 * Load other required files
 *
 */
$inc = get_stylesheet_directory() . '/inc';
$includes = [
    'function-child.php',
    'ajax-child.php',
	'enqueue.php',
    'widget-post.php',
    'produk-post.php',
    'function_vdposts.php',
	'shortcodes.php',
    'simulasi-kredit.php',
];

foreach( $includes as $include ) {
	require_once( $inc . '/' . $include );
}