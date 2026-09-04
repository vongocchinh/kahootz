<?php
/**
 * Kahootz Theme functions and definitions
 */

if ( ! defined( 'KAHOOTZ_THEME_VERSION' ) ) {
	define( 'KAHOOTZ_THEME_VERSION', '1.0.1' );
}

// Load Pa library
require_once get_template_directory() . '/lib/pa-theme-loader.php';
// require_once get_template_directory() . '/lib/seed-services.php';
// require_once get_template_directory() . '/lib/seed-data.php';


if ( ! function_exists( 'kahootz_theme_setup' ) ) :
	function kahootz_theme_setup() {
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'custom-logo', array(
			'height'      => 100,
			'width'       => 400,
			'flex-height' => true,
			'flex-width'  => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'kahootz_theme_setup' );

/**
 * Enqueue scripts and styles.
 */
function kahootz_theme_scripts() {
	// Tailwind CSS
	wp_enqueue_style( 'kahootz-tailwind', get_template_directory_uri() . '/assets/css/tailwind-output.css', array(), KAHOOTZ_THEME_VERSION );
	
	// Main Theme Style (style.css at root)
	wp_enqueue_style( 'kahootz-style', get_stylesheet_uri(), array(), KAHOOTZ_THEME_VERSION );

	// Phosphor Icons
	wp_enqueue_script( 'phosphor-icons', 'https://unpkg.com/@phosphor-icons/web', array(), null, false );

	// Swiper CSS & JS
	wp_enqueue_style( 'swiper-style', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css', array(), '11.0.0' );
	wp_enqueue_script( 'swiper-script', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', array(), '11.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'kahootz_theme_scripts' );

// Include Custom Post Types
require_once get_template_directory() . '/lib/custom-post-types.php';
require_once get_template_directory() . '/lib/custom-taxonomies.php';

/**
 * Remove default Posts and Comments from Admin Menu
 */
function kahootz_remove_default_menus() {
	remove_menu_page( 'edit.php' );                   // Posts
	remove_menu_page( 'edit-comments.php' );          // Comments
}
add_action( 'admin_menu', 'kahootz_remove_default_menus' );

/**
 * Fix Docker cURL error 35: Force WordPress HTTP requests to use IPv4 and HTTP/1.1
 * This resolves issues with downloads/updates failing due to OpenSSL 3.0 strictness and IPv6 bugs in Docker.
 */
add_action( 'http_api_curl', function( $handle ) {
	curl_setopt( $handle, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4 );
	curl_setopt( $handle, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1 );
});

add_action( 'requests-curl.before_request', function( $handle ) {
	curl_setopt( $handle, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4 );
	curl_setopt( $handle, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1 );
});

function enqueue_phosphor_icons()
{
	wp_enqueue_style(
		'phosphor-icons',
		'https://unpkg.com/@phosphor-icons/web@2.1.1/src/style.css',
		array(),
		'2.1.1'
	);
}
add_action('wp_enqueue_scripts', 'enqueue_phosphor_icons');

// Include Handlers
require_once get_template_directory() . '/handlers/contact-handler.php';
require_once get_template_directory() . '/handlers/query-handler.php';

/**
 * 404 redirect for single contact posts and remove from sitemaps
 */
function kahootz_restrict_contact_cpt() {
	if ( is_singular( 'contact' ) ) {
		global $wp_query;
		$wp_query->set_404();
		status_header( 404 );
		nocache_headers();
		require get_query_template( '404' );
		exit;
	}
}
add_action( 'template_redirect', 'kahootz_restrict_contact_cpt' );

add_filter( 'wp_sitemaps_post_types', function( $post_types ) {
	if ( isset( $post_types['contact'] ) ) {
		unset( $post_types['contact'] );
	}
	return $post_types;
} );
/**
 * Register Theme Settings Page
 */
add_filter('pa_admin_pages', 'kahootz_register_theme_settings');
function kahootz_register_theme_settings($pages) {
    $pages[] = array(
        'page_title' => __('Theme Settings', 'kahootz'),
        'menu_title' => __('Theme Settings', 'kahootz'),
        'capability' => 'manage_options',
        'menu_slug' => 'kahootz_settings',
        'setting' => 'kahootz_settings',
        'menu_icon' => 'dashicons-admin-generic',
        'page_icon' => 'dashicons-admin-generic',
        'save_text' => 'Save Settings',
        'default_tab' => 'Social Links'
    );
    return $pages;
}
