<?php

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Pa_Admin
 * Controls admin modifications and features.
 *
 * @package     Pa
 * @subpackage  Admin
 * @copyright   Copyright (c) 2012-2018, Pa, LLC.
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0
 */
class Pa_Admin
{
  /**
   * @var bool Stores all dependent plugins and theme
   * @access public
   */
  public static $pa_dependent = array();

  /**
   * @var bool Whether Pa is network activated.
   * @access public
   */
  public static $network_wide = false;

  /**
   * @var bool|array Pa page icon configuration.
   * @access public
   */
  public static $page_icon = false;

  /**
   * @var array Admin pages that have been registered with Pa.
   * @access private
   */
  private static $admin_pages = array();

  /**
   * @var array Admin page sections that have been registered with Pa.
   * @access private
   */
  private static $admin_page_sections = array();

  /**
   * @var string Admin page layout to use if set.
   * @access private
   */
  public static $admin_page_layout = null;

  /**
   * @var array Whether or not to check capabilities on save.
   * @access private
   */
  private static $capability_save = array();

  /**
   * @var array Allowed Pa variables to pass through a redirect of a post.
   * @access private
   */
  private static $redirect_post_location_allowed = array(
    'admin_hide_ui'
  );

  /**
   * _construct
   * Class constructor.
   *
   * @access public
   * @static
   * @since 1.0
   */
  public static function _construct()
  {
    global $pagenow;

    if (is_admin())
    {
      add_action('init', array('pa_admin', 'init'));
    }

    add_action('admin_head', array('pa_admin', 'admin_head'));
    add_action('wp_head', array('pa_admin', 'admin_head'));
    add_action('admin_menu', array('pa_admin', 'register_admin_pages'));
    add_action('redirect_post_location', array('pa_admin', 'redirect_post_location'), 10, 2);

    // add_filter('admin_footer_text', array('pa_admin', 'admin_footer_text'));
    add_filter('admin_body_class', array('pa_admin', 'admin_body_class'));
    add_filter('screen_options_show_screen', array('pa_admin', 'screen_options_show_screen'), 10, 2);

    add_filter('plugin_action_links_pa/pa.php', array('pa_admin', 'plugin_action_links'));
    add_filter('plugin_row_meta', array('pa_admin', 'plugin_row_meta'), 10, 2);

    if ($pagenow == 'customize.php')
    {
      add_filter('pa_assets_footer', array('pa_admin', 'assets'), 100);
    }
    else
    {
      add_filter('pa_assets', array('pa_admin', 'assets'), 100);
    }
  }

  /**
   * init
   * Checks for updates.
   *
   * @access public
   * @static
   * @since 1.0
   */
  public static function init()
  {
    $data = get_file_data(pa::$add_ons['pa']['path'] . '/pa.php', array(
              'version' => 'Version'
            ));

    if ($data['version'])
    {
      self::check_update('pa/pa.php', $data['version']);
    }

    self::check_persistant_update();

    add_action('in_plugin_update_message-pa/pa.php', array('pa_admin', 'update_available'), null, 2);
  }

  /**
   * admin_head
   * Check if any actions need to be performed in the admin_head.
   *
   * @access public
   * @static
   * @since 1.0
   */
  public static function admin_head()
  {
    global $menu, $submenu;

    if (self::hide_ui())
    {
      pa::render('shared/admin-hide-ui');

      $menu = $submenu = null;
    }
  }

  /**
   * assets
   * Add assets needed in the admin for Pa.
   *
   * @param array $assets Assets already in queue.
   *
   * @return array Assets to load.
   *
   * @access public
   * @static
   * @since 1.0
   */
  public static function assets($assets)
  {
    array_push($assets['scripts'], array(
      'handle' => 'pa-admin-js'
      ,'src' => pa::$add_ons['pa']['url'] . '/parts/js/admin.js'
      ,'ver' => pa::$version
      ,'deps' => 'jquery'
      ,'enqueue' => true
      ,'in_footer' => true
      ,'admin' => true
    ));

    array_push($assets['styles'], array(
      'handle' => 'pa-admin-css'
      ,'src' => pa::$add_ons['pa']['url'] . '/parts/css/admin.css'
      ,'ver' => pa::$version
      ,'enqueue' => true
      ,'in_footer' => false
      ,'media' => 'screen, projection'
      ,'admin' => true
    ));

    return $assets;
  }

  /**
   * update_available
   * Check if an update is available for a plugin.
   *
   * @param array $plugin_data Current plugin configuration.
   * @param array $new_plugin_data New plugin configuration.
   *
   * @access public
   * @static
   * @since 1.0
   */
  public static function update_available($plugin_data, $new_plugin_data)
  {
    require_once(ABSPATH . 'wp-admin/includes/plugin-install.php');

    $plugin = plugins_api('plugin_information', array('slug' => $new_plugin_data->slug));

    if (!$plugin || is_wp_error($plugin) || empty($plugin->sections['changelog']))
    {
      return;
    }

    $changes = $plugin->sections['changelog'];

    // remove everthing between p tags
    $changes = preg_replace('#<\s*?p\b[^>]*>(.*?)</p\b[^>]*>#s', '', $changes);

    // Find where plugin version starts
    $pos = stripos($changes, '<h4>' . $plugin_data['Version'] . '</h4>');

    if ($pos !== false)
    {
      $changes = trim(substr($changes, 0, $pos));

      pa::render('shared/update-available');

      $changes = preg_replace('/<h4>(.*)<\/h4>.*/iU', '', $changes);
      $changes = strip_tags($changes, '<li>');

      echo '<ul class="update-available">' . $changes . '</ul>';
    }
  }



  /**
   * hide_ui
   * Determine if the admin ui should be hidden.
   *
   * @return bool Whether or not to hide the admin UI.
   *
   * @access public
   * @static
   * @since 1.0
   */
  public static function hide_ui()
  {
    return isset($_REQUEST[pa::$prefix]['admin_hide_ui']) && $_REQUEST[pa::$prefix]['admin_hide_ui'] == 'true';
  }

  /**
   * redirect_post_location
   * A helper to redirect the post location and keep it friendly to pa.
   *
   * @param string $location The location to redirect to.
   * @param int $post_id The post id for the location.
   *
   * @return string The update location.
   *
   * @access public
   * @static
   * @since 1.0
   */
  public static function redirect_post_location($location, $post_id)
  {
    if (isset($_REQUEST[pa::$prefix]))
    {
      $variables = array(
        pa::$prefix => array()
      );

      /**
       * pa_redirect_post_location_allowed
       *
       * Whitelist which variables should be carried through a post location redirect.
       *
       * @param array $allowed
       *
       * @since 1.0
       */
      self::$redirect_post_location_allowed = array_merge(self::$redirect_post_location_allowed, apply_filters('pa_redirect_post_location_allowed', array()));

      foreach ($_REQUEST[pa::$prefix] as $key => $value)
      {
        if (in_array($key, self::$redirect_post_location_allowed))
        {
          $variables[pa::$prefix][$key] = $value;
        }
      }

      if (!empty($variables[pa::$prefix]))
      {
        $location .= (substr($location, -1) != '&' ? '&' : null) . http_build_query($variables);
      }
    }

    return $location;
  }

  /**
   * register_admin_pages
   * Register admin pages to be added to the admin.
   *
   * @access public
   * @static
   * @since 1.0
   */
  public static function register_admin_pages()
  {
    /**
     * pa_admin_pages
     * Register Admin pages with Pa
     *
     * Allows for all custom Pa parameters when registering an Admin or Settings page.
     *
     * @param array $post_types
     *
     * @since 1.0
     */
    self::$admin_pages = apply_filters('pa_admin_pages', array());

    foreach (self::$admin_pages as $page)
    {
      if (isset($page['capability_save']))
      {
        pa_admin::$capability_save = $page['capability_save'];

        add_filter("option_page_capability_{$page['setting']}", array('pa_admin', 'option_page_capability'));
      }

      $page['capability'] = isset($page['capability']) ? $page['capability'] : 'manage_options';

      if (isset($page['sub_menu']))
      {
        add_submenu_page($page['sub_menu'], $page['page_title'], $page['menu_title'], $page['capability'], $page['menu_slug'], array('pa_admin', 'admin_page'));
      }
      else
      {
        $menu_icon = isset($page['menu_icon']) ? $page['menu_icon'] : (isset($page['icon_url']) ? $page['icon_url'] : null);

        add_menu_page($page['page_title'], $page['menu_title'], $page['capability'], $page['menu_slug'], array('pa_admin', 'admin_page'), $menu_icon, isset($page['position']) ? $page['position'] : null);
        add_submenu_page($page['menu_slug'], $page['page_title'], $page['page_title'], $page['capability'], $page['menu_slug'], array('pa_admin', 'admin_page'));
      }
    }

    foreach (self::$admin_pages as $page)
    {
      if (isset($page['layout']) && isset($_REQUEST['page']) && $page['menu_slug'] == (string) $_REQUEST['page'])
      {
        self::$admin_page_layout = $page['layout'];

        break;
      }
    }

    $data = array(
              'title' => 'Title'
              ,'page' => 'Page'
              ,'order' => 'Order'
              ,'position' => 'Position'
            );

    pa::process_parts('admin-pages', $data, array('pa_admin', 'register_admin_pages_callback'));
  }

  /**
   * register_admin_pages_callback
   * Handle admin page registration.
   *
   * @param array $arguments The configuration data for the admin page.
   *
   * @access public
   * @static
   * @since 1.0
   */
  public static function register_admin_pages_callback($arguments)
  {
    extract($arguments);

    if (!empty($data['page']) && (!isset($_REQUEST['flow_page']) || (isset($_REQUEST['flow_page']) && $_REQUEST['flow_page'] === $data['flow_page'])))
    {
      foreach ($data['page'] as $page)
      {
        if (!isset(self::$admin_page_sections[$page]))
        {
          self::$admin_page_sections[$page] = array();
        }

        if (!$arguments['data']['position'])
        {
          $arguments['data']['position'] = 'before';
        }

        array_push(self::$admin_page_sections[$page], $arguments);

        uasort(self::$admin_page_sections[$page], array('pa', 'sort_by_order'));
      }
    }
  }

  /**
   * admin_page
   * Render the admin page.
   *
   * @access public
   * @static
   * @since 1.0
   */
  public static function admin_page()
  {
    $page = false;

    foreach (self::$admin_pages as $admin_page)
    {
      if ($_REQUEST['page'] === $admin_page['menu_slug'])
      {
        $page = $admin_page;

        break;
      }
    }

    if ($page)
    {
      pa::render('shared/admin-page', array(
        'section' => $page['menu_slug']
        ,'notice' => isset($page['sub_menu']) ? !in_array($page['sub_menu'], array('options-general.php')) : false
        ,'icon' => isset($page['icon']) ? $page['icon'] : false
        ,'single_line' => isset($page['single_line']) ? $page['single_line'] : false
        ,'title' => ($page['page_title'])
        ,'setting' => isset($page['setting']) ? $page['setting'] : false
        ,'page_sections' => isset(self::$admin_page_sections[$page['menu_slug']]) ? self::$admin_page_sections[$page['menu_slug']] : null
        ,'save' => isset($page['save']) ? $page['save'] : true
        ,'save_text' => isset($page['save_text']) ? $page['save_text'] : __('Save Changes', 'pa')
        ,'page' => isset($page['page']) ? $page['page'] : false
        ,'layout' => self::$admin_page_layout
      ));
    }
  }

  /**
   * add_meta_box_callback
   * Replaces the default submitdiv metabox on custom post types to allow UI support for custom statuses.
   *
   * @param $object
   * @param $arguments
   *
   * @access public
   * @static
   * @since 1.0
   */
  public static function add_meta_box_submitdiv_callback($object, $arguments)
  {
    pa::render('shared/meta-box-submitdiv', $arguments['args']);
  }

  /**
   * screen_options_show_screen
   * Show screen options tab.
   *
   * @param bool $show_screen Whether to show the tab or not.
   * @param object $screen Screen object.
   *
   * @return bool Whether to show the tab or not.
   *
   * @access public
   * @static
   * @since 1.0
   */
  public static function screen_options_show_screen($show_screen, $screen)
  {
    if (self::$admin_page_layout == 'meta-boxes')
    {
      add_screen_option('layout_columns', array('max' => 2, 'default' => 2));

      return true;
    }

    return $show_screen;
  }

  /**
   * admin_body_class
   * Add custom classes to the admin body tag.
   *
   * @param string $classes Classes to add.
   *
   * @return string Updated classes.
   *
   * @access public
   * @static
   * @since 1.0
   */
  public static function admin_body_class($classes)
  {
    global $typenow;

    $screen = get_current_screen();

    if (pa_admin::$pa_dependent == true && $screen->base == 'plugins')
    {
      $classes .= ' pa-dependent';
    }

    if (isset($_REQUEST['taxonomy']))
    {
      $classes .= ' taxonomy-' . esc_attr($_REQUEST['taxonomy']);
    }

    if ($typenow)
    {
      $classes .= ' post_type-' . $typenow;
    }

    return $classes;
  }

  /**
   * option_page_capability
   * Pass capabilities to check on option page save if applicable.
   *
   * @return array Capabalities to check on options page save action.
   *
   * @access public
   * @static
   * @since 1.0
   */
  public static function option_page_capability()
  {
    return pa_admin::$capability_save;
  }

  /**
   * get
   * A simple getter function.
   *
   * @param string $variable The variable name to get.
   *
   * @return mixed The requested value.
   *
   * @access public
   * @static
   * @since 1.0
   */
  public static function get($variable)
  {
    return isset(self::$$variable) ? self::$$variable : false;
  }

  /**
   * deactivation_link
   * Whether or not to set the deactivation link on the plugins page.
   *
   * @access public
   * @static
   * @since 1.0
   */
  public static function deactivation_link()
  {
    if (isset($_REQUEST['pa_lock']) && $_REQUEST['pa_lock'] == 'false')
    {
      return;
    }

    add_filter('plugin_action_links_pa/pa.php', array('pa_admin', 'replace_deactivation_link'));
    add_filter('network_admin_plugin_action_links_pa/pa.php', array('pa_admin', 'replace_deactivation_link'));
    add_filter('admin_body_class', array('pa_admin', 'admin_body_class'));
  }

  /**
   * replace_deactivation_link
   * Checks whether to replace the deactivation link with a warning.
   *
   * @param array $actions The list of actions available for a plugin on the plugins screen.
   *
   * @return array Updated actions.
   *
   * @access public
   * @static
   * @since 1.0
   */
  public static function replace_deactivation_link($actions)
  {
    unset($actions['deactivate']);

    array_unshift($actions, sprintf(__('%1$sDependent plugins or theme are active.%2$s', 'pa'), '<div style="color:#a00"><a href="admin.php?page=pa">', pa_admin::replace_deactivation_link_help() .'</a></div>') . (is_network_admin() ? __('Network Deactivate', 'pa') :  __('Deactivate', 'pa')));

    return $actions;
  }

  /**
   * replace_deactivation_link_help
   * Checks whether to add help to the deactivation link.
   *
   * @return string The updated message.
   *
   * @access public
   * @static
   * @since 1.0
   */
  public static function replace_deactivation_link_help()
  {
    $message = pa::render(
        'shared/tooltip-help'
          ,array(
            'message' => __('Pa has disabled the deactivation link to protect your website.  Either your theme or a plugin is dependent on Pa. Please change your theme or deactivate the dependent plugin(s) to allow deactivation.', 'pa')
          )
          ,true
        );

    return $message;
  }

  /**
   * plugin_action_links
   * Filters the plugin action links
   *
   * @param array $links Current plugin action links.
   *
   * @return array Updated links.
   *
   * @access public
   * @static
   * @since 1.0
   */
  public static function plugin_action_links($links)
  {
    $links[] = '<a href="' . get_admin_url(null, 'admin.php?page=pa-core-settings') . '">' . __('Settings', 'pa') . '</a>';
    $links[] = '<a href="' . get_admin_url(null, 'admin.php?page=pa-core-addons') . '">' . __('Demo', 'pa') . '</a>';

    return $links;
  }

  /**
   * plugin_row_meta
   * Additional links and meta for the plugin screen.
   *
   * @param array $links The current links for a plugin.
   * @param string $file The plugin filename.
   *
   * @return array Updated links.
   *
   * @access public
   * @static
   * @since 1.0
   */
  public static function plugin_row_meta($links, $file)
  {
    if ($file == 'pa/pa.php')
    {
      $links[] = '<a href="https://pa.com/user-guide/" target="_blank">' . __('User Guide', 'pa') . '</a>';
      $links[] = '<a href="https://pa.com/support/" target="_blank">' . __('Support', 'pa') . '</a>';
      $links[] = '<a href="' . get_admin_url(null, 'admin.php?page=pa-core-addons') . '">' . __('Add-ons', 'pa') . '</a>';
    }

    return $links;
  }

  /**
   * check_update
   * Check if a pa plugin needs an update.
   *
   * @param string $file The plugin filename.
   * @param string $version The plugin version.
   *
   * @access public
   * @static
   * @since 1.0
   */
  public static function check_update($file, $version)
  {
    global $pagenow;

    if (!is_admin() || !current_user_can('manage_options'))
    {
      return;
    }

    $plugin = plugin_basename($file);

    if (is_plugin_active_for_network($plugin))
    {
      pa_admin::$network_wide = true;
      $versions = get_site_option('pa_active_plugin_versions', array());
    }
    elseif (is_plugin_active($plugin))
    {
      pa_admin::$network_wide = false;
      $versions = get_option('pa_active_plugin_versions', array());
    }
    else
    {
      return;
    }

    if (empty($versions[$plugin]))
    {
      $versions[$plugin][] = $version;
    }
    else
    {
      if (!is_array($versions[$plugin]))
      {
        $versions[$plugin] = array($versions[$plugin]);
      }

      $current_version = is_array($versions[$plugin]) ? current($versions[$plugin]) : $versions[$plugin];

      if (version_compare($version, $current_version, '>'))
      {
        self::get_update($file, $version, $current_version);

        array_unshift($versions[$plugin], $version);
      }
    }

    if (pa_admin::$network_wide)
    {
      update_site_option('pa_active_plugin_versions', $versions);
    }
    else
    {
      update_option('pa_active_plugin_versions', $versions);
    }
  }

  /**
   * check_persistant_update
   * Check if a pa plugin needs to continue with an update
   *
   * @access public
   * @static
   * @since 1.0
   */
  public static function check_persistant_update()
  {
    $persistant_updates = pa_admin::$network_wide ? get_site_option('pa_updates') : get_option('pa_updates');

    if ($persistant_updates === false)
    {
      return;
    }

    $valid_persistant_updates = array();
    foreach ($persistant_updates as $plugin => $versions)
    {
      foreach ($versions as $version)
      {
        $valid_persistant_updates[$version] = WP_PLUGIN_DIR . '/' . $plugin . '/parts/updates/' . $version . '.php';
      }
    }

    if (!empty($valid_persistant_updates))
    {
      pa::check_network_propagate(array('pa_admin', 'run_update'), $valid_persistant_updates);
    }
  }

  /**
   * get_update
   * Get the update for a pa plugin.
   *
   * @param string $file The plugin filename.
   * @param string $version The plugin version.
   * @param string $current_version The current plugin version.
   *
   * @access public
   * @static
   * @since 1.0
   */
  public static function get_update($file, $version, $current_version)
  {
    $updates_url = WP_PLUGIN_DIR . '/' . dirname($file) . '/parts/updates/';
    $updates = pa::get_directory_list($updates_url);

    if ($updates)
    {
      array_multisort($updates);
    }
    else
    {
      return;
    }

    $valid_updates = array();
    foreach ($updates as $update)
    {
      $update_version_number = rtrim($update, '.php');

      if (version_compare($current_version, $update_version_number, '<'))
      {
        $valid_updates[$update_version_number] = $updates_url . $update;
      }
    }

    if ($valid_updates)
    {
      pa::check_network_propagate(array('pa_admin', 'run_update'), $valid_updates);
    }
  }

  /**
   * run_update
   * Run the updates for a pa plugin.
   *
   * @param array $updates An array of methods to execute for the update.
   *
   * @access public
   * @static
   * @since 1.0
   */
  public static function run_update($updates)
  {
    foreach ($updates as $version => $update)
    {
      include_once $update;

      $class = 'Pa_Update_' . str_replace('.', '_', $version);

      if (class_exists($class))
      {
        $execute = new $class();
      }
    }
  }

  /**
   * is_widget
   * Checks if the current page supports widgets in the admin.
   *
   * @return bool Whether or not the page in question is a widget admin page.
   *
   * @access public
   * @static
   * @since 1.0
   */
  public static function is_widget()
  {
    global $pagenow;

    return ($pagenow == 'widgets.php'
            || $pagenow == 'customize.php'
            || ($pagenow == 'admin-ajax.php' && (
                in_array($_REQUEST['action'], array('save-widget', 'update-widget'))
                || substr($_REQUEST['action'], 0, strlen('pa_universal_widget')) == 'pa_universal_widget')
                || (isset($_REQUEST['action']) && $_REQUEST['action'] == 'pa_form' && isset($_REQUEST['widget']))
               )
           );
  }

  /**
   * is_setting
   * Checks if the current page action is for the Settings API
   *
   * @return bool Whether or not the page in question is a settings admin page.
   *
   * @access public
   * @static
   * @since 1.0
   */
  public static function is_setting()
  {
    global $pagenow;

    return isset($_REQUEST['option_page']) && isset($_REQUEST[$_REQUEST['option_page']]);
  }

  /**
   * is_post
   * Checks if the current page is a post page in the admin.
   *
   * @return mixed Whether or not the page in question is a edit post type admin page, if it is it will return the id.
   *
   * @access public
   * @static
   * @since 1.0
   */
  public static function is_post()
  {
    global $pagenow, $post;

    $id = $post ? $post->ID : true;

    return in_array($pagenow, array('post.php', 'post-new.php')) ? $id : false;
  }

  /**
   * is_term
   * Checks if the current page is a term page in the admin.
   *
   * @return mixed Whether or not the page in question is a term or taxonomy admin page, if it is it will return the id.
   *
   * @access public
   * @static
   * @since 1.0
   */
  public static function is_term()
  {
    global $pagenow;

    if (in_array($pagenow, array('edit-tags.php', 'term.php')))
    {
      return !empty($_REQUEST['tag_ID']) ? $_REQUEST['tag_ID'] : 'new';
    }

    return false;
  }

  /**
   * is_user
   * Checks if the current page is a user page in the admin.
   *
   * @return mixed Whether or not the page in question is a user admin page, if it is it will return the id.
   *
   * @access public
   * @static
   * @since 1.0
   */
  public static function is_user()
  {
    global $pagenow, $user_id;

    switch ($pagenow)
    {
      case 'user-edit.php':

        $id = $user_id ? $user_id : true;

        return $id;

      break;

      case 'profile.php':

        $current_user = wp_get_current_user();

        return is_user_logged_in() ? $current_user->ID : true;

      break;

      case 'user-new.php':
      case 'user.php':

        return true;

      break;
    }

    return false;
  }

  /**
   * is_media
   * Checks if the current page is a media page in the admin.
   *
   * @return mixed Whether or not the page in question is a media admin page, it returns the type of page or the id if editing.
   *
   * @access public
   * @static
   * @since 1.0
   */
  public static function is_media()
  {
    global $pagenow, $post;

    if (in_array($pagenow, array('async-upload.php', 'media.php', 'media-upload.php', 'media-new.php')))
    {
      $id = $post ? $post->ID : true;

      return $pagenow == 'media.php' ? $id : 'upload';
    }

    return false;
  }

  /**
   * is_comment
   * Checks if the current page is a comment page in the admin.
   *
   * @return mixed Whether or not the page in question is a comment admin page, if it is it will return the id.
   *
   * @access public
   * @static
   * @since 1.0
   */
  public static function is_comment()
  {
    global $pagenow, $comment;

    $id = $comment ? $comment->ID : true;

    return $pagenow == 'comment.php' ? $id : false;
  }

/**
   * responsive_admin
   * Checks for WP 3.8 or above, which has a responsive admin.
     * TODO: depreciate
   *
   * @return bool Whether admin is responsive or not.
   *
   * @access public
   * @static
   * @since 1.0
   */
  public static function responsive_admin()
  {
    if (version_compare($GLOBALS['wp_version'], '3.8', '>=' ))
    {
      return true;
    }
    else
    {
      return false;
    }
  }
}
