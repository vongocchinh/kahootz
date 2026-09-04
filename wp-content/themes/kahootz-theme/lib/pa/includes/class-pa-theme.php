<?php

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Pa_Theme
 * Controls theme modifications and features.
 *
 * @package     Pa
 * @subpackage  Theme
 * @copyright   Copyright (c) 2012-2018, Pa, LLC.
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0
 */
class Pa_Theme
{
  /**
   * @var array Registered pointers.
   * @access private
   */
  private static $post_class;

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
    global $pagenow, $wp_version;

    add_action($pagenow == 'customize.php' ? 'customize_controls_init' : 'init', array('pa_theme', 'register_assets'));
    add_action('setup_theme', array('pa_theme', 'setup_theme'));
    add_action('wp_head', array('pa_theme', 'register_assets_head'), 0);
    add_action('wp_head', array('pa_theme', 'version_in_header'));
    add_action('wp_footer', array('pa_theme', 'register_assets_footer'), 0);
    add_action('wp_footer', array('pa_theme', 'pa_love'), 1000);
    add_action('admin_head', array('pa_theme', 'register_assets_head'), 0);
    add_action('admin_footer', array('pa_theme', 'register_assets_footer'), 0);
    add_action('customize_controls_print_footer_scripts', array('pa_theme', 'register_assets_footer'), 0);

    if (version_compare($wp_version, '4.2', '<'))
    {
      add_action('wp_head', array('pa_theme', 'conditional_scripts_start'), -1);
      add_action('wp_footer', array('pa_theme', 'conditional_scripts_start'), -1);
      add_action('admin_head', array('pa_theme', 'conditional_scripts_start'), -1);
      add_action('admin_footer', array('pa_theme', 'conditional_scripts_start'), -1);
      add_action('customize_controls_print_styles', array('pa_theme', 'conditional_scripts_start'), -1);
      add_action('customize_controls_print_scripts', array('pa_theme', 'conditional_scripts_start'), -1);
      add_action('customize_controls_print_footer_scripts', array('pa_theme', 'conditional_scripts_start'), -1);
      add_action('wp_head', array('pa_theme', 'conditional_scripts_end'), 101);
      add_action('wp_footer', array('pa_theme', 'conditional_scripts_end'), 101);
      add_action('admin_head', array('pa_theme', 'conditional_scripts_end'), 101);
      add_action('admin_footer', array('pa_theme', 'conditional_scripts_end'), 101);
      add_action('customize_controls_print_styles', array('pa_theme', 'conditional_scripts_end'), 101);
      add_action('customize_controls_print_scripts', array('pa_theme', 'conditional_scripts_end'), 101);
      add_action('customize_controls_print_footer_scripts', array('pa_theme', 'conditional_scripts_end'), 101);
    }

    add_filter('body_class', array('pa_theme', 'body_class'));
    add_filter('post_class', array('pa_theme', 'post_class'));

    add_filter('pa_assets_footer', array('pa_theme', 'assets'));
  }

  /**
   * setup_theme
   * Determine whether a theme, parent or child, has a pa folder.
   * If so, then pa_admin::$pa_dependent = true.
   *
   * @access public
   * @static
   * @since 1.0
   */
  public static function setup_theme()
  {
    if (is_dir(get_stylesheet_directory() . '/pa'))
    {
      pa::$add_ons['theme'] = array(
        'path' => get_stylesheet_directory() . '/pa'
        ,'url' => get_stylesheet_directory_uri() . '/pa'
      );

      pa::$paths['theme'] = &pa::$add_ons['theme']['path'];

      add_action('load-plugins.php', array('pa_admin', 'deactivation_link'));

      $current_theme = wp_get_theme();
      if ( $current_theme->exists() )
      {
          pa_admin::$pa_dependent['theme'][] = $current_theme->get( 'Name' );	  
      }
    }

    if (get_template_directory() != get_stylesheet_directory() && is_dir(get_template_directory() . '/pa'))
    {
      pa::$add_ons['parent-theme'] = array(
        'path' => get_template_directory() . '/pa'
        ,'url' => get_template_directory_uri() . '/pa'
      );

      pa::$paths['parent-theme'] = &pa::$add_ons['parent-theme']['path'];
    }
  }

  /**
   * assets
   * Add assets needed in frontend for Pa.
   *
   * @param array $assets Collection of registered assets.
   *
   * @access public
   * @static
   * @since 1.0
   */
  public static function assets($assets)
  {
    /**
     * pa_assets_localize
     * Add additional information to the pa local variable
     *
     * @param  array $localize so far.
     *
     * @since 1.0
     */
    $localize = array_merge(apply_filters('pa_assets_localize', array()), array(
                  'prefix' => pa::$prefix
                ));

    array_push($assets['scripts'], array(
      'handle' => 'pa'
      ,'src' => pa::$add_ons['pa']['url'] . '/parts/js/pa.js'
      ,'ver' => pa::$version
      ,'deps' => array(
        'jquery'
        ,'jquery-ui-sortable'
        ,'quicktags'
      )
      ,'enqueue' => true
      ,'in_footer' => true
      ,'admin' => true
      ,'front' => pa_form::render_assets()
      ,'localize' => array(
        'key' => 'pa'
        ,'value' => $localize
      )
    ));

    array_push($assets['scripts'], array(
      'handle' => 'jquery.placeholder'
      ,'src' => pa::$add_ons['pa']['url'] . '/parts/js/jquery.placeholder.js'
      ,'ver' => '1.0'
      ,'deps' => 'jquery'
      ,'enqueue' => true
      ,'in_footer' => true
      ,'admin' => true
      ,'front' => pa_form::render_assets()
    ));

    array_push($assets['styles'], array(
      'handle' => 'pa-css'
      ,'src' => pa::$add_ons['pa']['url'] . '/parts/css/pa.css'
      ,'ver' => pa::$version
      ,'enqueue' => true
      ,'admin' => true
      ,'in_footer' => false
      ,'front' => pa_form::render_assets()
      ,'media' => 'screen, projection'
    ));

    return $assets;
  }

  /**
   * conditional_scripts_start
   * Add all scripts with a condition to the output buffer.
   *
   * @access public
   * @static
   * @since 1.0
   */
  public static function conditional_scripts_start()
  {
    ob_start();
  }

  /**
   * conditional_scripts_end
   * End output buffer for conditional scripts.
   *
   * @access public
   * @static
   * @since 1.0
   */
  public static function conditional_scripts_end()
  {
    $output = ob_get_contents();

    ob_end_clean();

    global $wp_scripts;

    if (!empty($wp_scripts))
    {
      foreach ($wp_scripts->registered as $script)
      {
        if (isset($script->extra['conditional']))
        {
          $src = $script->src . '?ver=' . (!empty($script->ver) ? $script->ver : get_bloginfo('version'));
          $tag = "<script type='text/javascript' src='{$src}'></script>\n";
          $output = str_replace($tag, "<!--[if {$script->extra['conditional']}]>\n{$tag}<![endif]-->\n", $output);
        }
      }
    }

    echo $output;
  }

  /**
   * register_assets_head
   * Load any assets that been set to 'in_footer' => false
   *
   * @access public
   * @static
   * @since 1.0
   */
  public static function register_assets_head()
  {
    self::register_assets('head');
  }

  /**
   * register_assets_footer
   * Load any assets that been set to 'in_footer' => true
   *
   * @access public
   * @static
   * @since 1.0
   */
  public static function register_assets_footer()
  {
    self::register_assets('footer');
  }

  /**
   * register_assets
   * Determine position/condition for assets.
   *
   * @param string $position The position the assets are to be registered.
   *
   * @access public
   * @static
   * @since 1.0
   */
  public static function register_assets($position = false)
  {
    global $wp_scripts, $wp_styles;
    /**
     * pa_assets_$position
     * Register assets to be loaded in the header or footer of a theme.
     *
     * The dynamic portion of the hook name, `$position`, refers to where
     * the assets should be loaded, 'header' or 'footer'.
     *
     *
     * @since 1.0
     */
    $assets = apply_filters('pa_assets' . ($position ? '_' . $position : null), array(
      'scripts' => array()
      ,'styles' => array()
    ));

    $assets_to_enqueue = array(
      'scripts' => array()
      ,'styles' => array()
    );

    foreach ($assets as $type => $list)
    {
      foreach ($assets[$type] as $asset)
      {
        if ((!isset($asset['admin']) && !isset($asset['front']) && !is_admin()) || (isset($asset['admin']) && $asset['admin'] && is_admin()) || (isset($asset['front']) && $asset['front'] && !is_admin()))
        {
          if (isset($asset['deps']) && !is_array($asset['deps']))
          {
            $asset['deps'] = array($asset['deps']);
          }

          if ($type == 'scripts')
          {
            wp_register_script($asset['handle'], $asset['src'], isset($asset['deps']) ? $asset['deps'] : array(), isset($asset['ver']) ? $asset['ver'] : false, isset($asset['in_footer']) ? $asset['in_footer'] : true);

            if (isset($asset['localize']) && isset($asset['localize']['key']) && isset($asset['localize']['value']))
            {
              wp_localize_script($asset['handle'], $asset['localize']['key'], $asset['localize']['value']);
            }

            if (isset($asset['condition']))
            {
              $wp_scripts->add_data($asset['handle'], 'conditional', $asset['condition']);
            }
          }
          elseif ($type == 'styles')
          {
            wp_register_style($asset['handle'], $asset['src'], isset($asset['deps']) ? $asset['deps'] : array(), isset($asset['ver']) ? $asset['ver'] : false, isset($asset['media']) ? $asset['media'] : false);

            if (isset($asset['condition']))
            {
              $wp_styles->add_data($asset['handle'], 'conditional', $asset['condition']);
            }
          }

          if (isset($asset['enqueue']) && $asset['enqueue'])
          {
            array_push($assets_to_enqueue[$type], array(
              'handle' => $asset['handle']
              ,'admin' => isset($asset['admin']) ? $asset['admin'] : false
              ,'front' => isset($asset['front']) ? $asset['front'] : false
            ));
          }
        }
      }
    }

    foreach ($assets_to_enqueue as $type => $assets)
    {
      foreach ($assets as $asset)
      {
        if ((is_admin() && $asset['admin']) || (!is_admin() && $asset['front']) || (!is_admin() && !$asset['admin'] && !$asset['front']))
        {
          if ($type == 'scripts')
          {
            wp_enqueue_script($asset['handle']);
          }
          elseif ($type == 'styles')
          {
            wp_enqueue_style($asset['handle']);
          }
        }
      }
    }
  }

  /**
   * body_class
   * Add some helpful classes to the theme body class.
   *
   * @param string $post_class The classes.
   *
   * @return string The classes.
   *
   * @access public
   * @static
   * @since 1.0
   */
  public static function body_class($classes)
  {
    if (isset($_SERVER['HTTP_USER_AGENT']))
    {
      if (stristr($_SERVER['HTTP_USER_AGENT'], 'ipad'))
      {
        $device = 'ipad';
      }
      elseif (stristr($_SERVER['HTTP_USER_AGENT'], 'iphone') || strstr($_SERVER['HTTP_USER_AGENT'], 'iphone'))
      {
        $device = 'iphone';
      }
      elseif (stristr($_SERVER['HTTP_USER_AGENT'], 'blackberry'))
      {
        $device = 'blackberry';
      }
      elseif (stristr($_SERVER['HTTP_USER_AGENT'], 'android'))
      {
        $device = 'android';
      }

      if (!empty($device))
      {
        $classes[] = $device;

        if ($device && $device != 'ipad')
        {
          $classes[] = 'mobile';
        }
      }
    }

    return $classes;
  }

  /**
   * post_class
   * Add some helpful classes to the theme post class.
   *
   * @param string $post_class The classes.
   *
   * @return string The classes.
   *
   * @access public
   * @static
   * @since 1.0
   */
  public static function post_class($post_class)
  {
    self::$post_class = self::$post_class == 'odd' ? 'even' : 'odd';

    $post_class[] = self::$post_class;

    return $post_class;
  }

  /**
   * version_in_header
   * Adds Pa Version to the <head> tag
   *
   * @access public
   * @static
   * @since 1.0
   */
  public static function version_in_header()
  {
    echo '<meta name="generator" content="Pa ' . pa::$version . '" />' . "\n";
  }

  /**
   * pa_love
   * Display a comment in the footer of your theme.
   * Only viewable in page source.
   *
   * @access public
   * @static
   * @since 1.0
   */
  public static function pa_love()
  {
    echo "\n" . '<!-- This website is powered by Pa. Learn more at https://pa.com/ -->' . "\n";
  }
}
