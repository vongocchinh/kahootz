<?php
/**
 * Pa Theme Loader
 * Loads Pa as an internal theme library instead of a plugin.
 *
 * Why this file is needed:
 * - The original Pa uses plugins_url() to calculate URLs → incorrect when loaded from a theme.
 * - WordPress fires the 'setup_theme' action BEFORE functions.php is loaded,
 *   so pa_theme::setup_theme() never runs → theme parts are not scanned.
 * - This file fixes both issues.
 *
 * Usage: require_once from functions.php
 * When the Pa plugin is active → this file automatically skips (class_exists check).
 */

if (defined('ABSPATH') && !class_exists('Pa')) {

    $__pa_lib_path = get_template_directory() . '/lib/pa';
    $__pa_lib_uri  = get_template_directory_uri() . '/lib/pa';

    // 1. Load core class
    include_once $__pa_lib_path . '/includes/class-pa.php';

    // 2. Register the path of lib/pa (replacing the plugin path)
    pa::add_plugin('pa', $__pa_lib_path);

    // 3. Override the URL because plugins_url() returns incorrect URLs when loaded from a theme
    pa::$add_ons['pa']['url'] = $__pa_lib_uri;
    pa::$urls['pa']           = &pa::$add_ons['pa']['url'];

    // 4. Set version
    pa::$version = '1.0.12-theme';

    // 5. Auto-load all classes in includes/
    pa::auto_load();

    // 6. Register theme path manually
    //    (because the 'setup_theme' action fired before functions.php was loaded,
    //    pa_theme::setup_theme() didn't run in time to register itself)
    if (is_dir(get_stylesheet_directory() . '/pa')) {
        pa::$add_ons['theme'] = [
            'path' => get_stylesheet_directory() . '/pa',
            'url'  => get_stylesheet_directory_uri() . '/pa',
        ];
        pa::$paths['theme'] = &pa::$add_ons['theme']['path'];
    }

    if (get_template_directory() !== get_stylesheet_directory()
        && is_dir(get_template_directory() . '/pa')
    ) {
        pa::$add_ons['parent-theme'] = [
            'path' => get_template_directory() . '/pa',
            'url'  => get_template_directory_uri() . '/pa',
        ];
        pa::$paths['parent-theme'] = &pa::$add_ons['parent-theme']['path'];
    }

    // 7. Register hooks (copied from pa::load(), excluding plugin-only ones)
    add_filter('pa_part_data', ['pa', 'part_data'], 10, 2);

    add_action('init',              ['pa', 'process_parts_callback'], 1000);
    add_action('admin_init',        ['pa', 'process_parts_callback'], 1000);
    add_action('admin_head',        ['pa', 'process_parts_callback'], 1000);
    add_action('template_redirect', ['pa', 'process_parts_callback'], 0);
    add_action('widgets_init',      ['pa', 'process_parts_callback'], 50);

    add_filter('pa_workflow_part_exclude_folders', ['pa', 'part_exclude_folders'], 10, 3);

    // Hide the Pa menu from WP Admin (used as an internal library, UI not needed)
    add_action('admin_menu', function () {
        remove_menu_page('pa');
        remove_submenu_page('pa', 'pa');
    }, 999);


    // Disable all Pa notices/warnings
    add_action('admin_notices',        '__return_false', 1);
    add_filter('pa_notice',       '__return_false');
    add_filter('pa_notices',      '__return_empty_array');
    add_action('pa_notice_error', '__return_false');

    // Disable "deactivation" and "requires Pa plugin" warnings
    add_action('load-plugins.php', function () {
        remove_action('load-plugins.php', ['pa_admin', 'deactivation_link']);
    }, 1);

    // Ignore Pa's trigger_error (E_USER_WARNING/E_USER_NOTICE)
    set_error_handler(function ($errno, $errstr) {
        if (stripos($errstr, 'pa') !== false) {
            return true; // Suppress Pa errors silently
        }
        return false; // Let other errors through normally
    }, E_USER_WARNING | E_USER_NOTICE);
}
