<?php
/**
 * Theme functions and definitions.
 *
 * For additional information on potential customization options,
 * read the developers' documentation:
 *
 * https://developers.elementor.com/docs/hello-elementor-theme/
 *
 * @package HelloElementorChild
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

define( 'HELLO_ELEMENTOR_CHILD_VERSION', '2.0.0' );

/**
 * Load child theme scripts & styles.
 *
 * @return void
 */
function hello_elementor_child_styles() {
    $child_theme_css_path = get_stylesheet_directory_uri() . '/style.css';

    // Check if the child theme's CSS file exists
    if (file_exists(get_stylesheet_directory() . '/style.css')) {
        wp_enqueue_style(
            'hello-elementor-child-style',
            $child_theme_css_path,
            [
                'hello-elementor-theme-style',
            ],
            HELLO_ELEMENTOR_CHILD_VERSION
        );

        // Print a message to indicate that the child theme's CSS file was enqueued
        //echo '<div style="background-color: #dff0d8; color: #3c763d; padding: 10px; border: 1px solid #d6e9c6;">Hello Elementor Child Theme CSS enqueued: ' . $child_theme_css_path . '</div>';
    } else {
        // Print a message to indicate that the child theme's CSS file was not found
        //echo '<div style="background-color: #f2dede; color: #a94442; padding: 10px; border: 1px solid #ebccd1;">Hello Elementor Child Theme CSS not found: ' . $child_theme_css_path . '</div>';
    }
}
add_action('wp_enqueue_scripts', 'hello_elementor_child_styles', 10);

/**
 * Load Bootstrap 5 Custom theme scripts & styles.
 *
 * @return void
 */
function hello_DMS_Bootstrap5_scripts_styles() {

	wp_enqueue_style('hello-DMS-bs5-style', get_stylesheet_directory_uri() . '/bootstrap-dev/dist/styles.min.css');
	wp_enqueue_script( 'bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js', array(), '5.3.3', true );
	wp_enqueue_script('hello-DMS-bs5-script', get_stylesheet_directory_uri() . '/bootstrap-dev/dist/main.min.js');

}
add_action( 'wp_enqueue_scripts', 'hello_DMS_Bootstrap5_scripts_styles', 21 );


/**
 * Theme functions and definitions.
 *
 * For additional information on potential customization options,
 * read the developers' documentation:
 *
 * https://developers.elementor.com/docs/hello-elementor-theme/
 *
 * @package HelloElementorChild
 */


function my_excerpt_length($length){ return 20; } 
add_filter('excerpt_length', 'my_excerpt_length');

/**
 * Allow SVG upload
 */
function cc_mime_types($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

/**
 * Allow WebP upload
 */
function webp_upload_mimes($existing_mimes) {
    $existing_mimes['webp'] = 'image/webp';
    return $existing_mimes;
}
add_filter('mime_types', 'webp_upload_mimes');

/**
 * Allow AVIF upload
 */
function avif_upload_mimes($existing_mimes) {
    $existing_mimes['avif'] = 'image/avif';
    return $existing_mimes;
}
add_filter('mime_types', 'avif_upload_mimes');


/**
 * Enqueue Font Awesome 6 Brands/All and Google Material Icons CDN
 */
function enqueue_icons_cdn() {
	$theme_dir = get_stylesheet_directory_uri();
    $assets_dir = $theme_dir . '/assets/fontAwesome/';
    wp_enqueue_style( 'font-awesome-css', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css', array(), '6.4.0', 'all' );
    wp_enqueue_style( 'material-awesome-css', 'https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0' );
    wp_enqueue_script( 'iconify-js', 'https://cdn.jsdelivr.net/npm/iconify-icon@2.1.0/dist/iconify-icon.min.js' );
    // wp_enqueue_style( 'font-awesome-webfonts',  $assets_dir . 'fa-solid-900.woff2', array(), '6.5.2', 'all' );
}
add_action( 'wp_enqueue_scripts', 'enqueue_icons_cdn' );


/**
 * Add footer menus for more menus */

function hello_DMS_register_more_menus() {
    register_nav_menus(
        array(
            'footer-menu-2' => __( 'Footer Menu 2' ),
            'footer-menu-3' => __( 'Footer Menu 3' ),
        )
    );
}
add_action( 'init', 'hello_DMS_register_more_menus' );

function dequeue_elementor_global__css() {
    wp_dequeue_style('elementor-global');
    wp_deregister_style('elementor-global');
  }
  add_action('wp_print_styles', 'dequeue_elementor_global__css', 9999);

  

/** Fix pagination for /%Category%//%PostName%/ */
function category_request($query_string )
{
    if( isset( $query_string['page'] ) ) {
        if( ''!=$query_string['page'] ) {
            if( isset( $query_string['name'] ) ) {
                unset( $query_string['name'] );
            }
        }
    }
    return $query_string;
}
add_filter('request', 'category_request');

add_action('pre_get_posts','custom_pre_get_posts');
function custom_pre_get_posts( $query ) { 
    if( $query->is_main_query() && !$query->is_feed() && !is_admin() ) { 
        $query->set( 'paged', str_replace( '/', '', get_query_var( 'page' ) ) ); 
    } 
}
/** End pagination for /%Category%//%PostName%/ */

// Add class to searched terms for highlighting
function highlight_results($text) {
    if (is_search() && !is_admin() && in_the_loop()) {
        $sr = get_query_var('s');
        $keys = explode(' ', $sr);
        $keys = array_filter($keys);
        $text = preg_replace('/('.implode('|', $keys) .')/iu', '<span class="search-highlight">\0</span>', $text);
    }
    return $text;
}
add_filter('the_content', 'highlight_results');
add_filter('the_excerpt', 'highlight_results');
add_filter('the_title', 'highlight_results');

