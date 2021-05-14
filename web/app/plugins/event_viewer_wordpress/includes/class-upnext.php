<?php

/**
 * The file that defines the core plugin class.
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link Driessen
 * @since 1.0.0
 *
 * @package Upnext
 * @subpackage Upnext/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since 1.0.0
 * @package Upnext
 * @subpackage Upnext/includes
 * @author Driessen Groep <webmasters@driessengroep.nl>
 */
class Upnext {

  /**
   * The loader that's responsible for maintaining and registering all hooks that power
   * the plugin.
   *
   * @since 1.0.0
   * @access protected
   * @var Upnext_Loader
   */
  protected $loader;

  /**
   * The unique identifier of this plugin.
   *
   * @since 1.0.0
   * @access protected
   * @var string
   */
  protected $plugin_name;

  /**
   * The current version of the plugin.
   *
   * @since 1.0.0
   * @access protected
   * @var string
   */
  protected $version;

  /**
   * Define the core functionality of the plugin.
   *
   * Set the plugin name and the plugin version that can be used throughout the plugin.
   * Load the dependencies, define the locale, and set the hooks for the admin area and
   * the public-facing side of the site.
   *
   * @since 1.0.0
   */
  public function __construct() {
    if (defined('PLUGIN_NAME_VERSION')) {
      $this->version = PLUGIN_NAME_VERSION;
    }
    else {
      $this->version = '1.0.0';
    }
    $this->plugin_name = 'upnext';

    $this->load_dependencies();
    $this->set_locale();
    $this->define_admin_hooks();
    $this->define_public_hooks();

  }

  /**
   * Load the required dependencies for this plugin.
   *
   * Include the following files that make up the plugin:
   *
   * - Upnext_Loader. Orchestrates the hooks of the plugin.
   * - Upnext_i18n. Defines internationalization functionality.
   * - Upnext_Admin. Defines all hooks for the admin area.
   * - Upnext_Public. Defines all hooks for the public side of the site.
   *
   * Create an instance of the loader which will be used to register the hooks
   * with WordPress.
   *
   * @since 1.0.0
   * @access private
   */
  private function load_dependencies() {

    /**
         * The class responsible for orchestrating the actions and filters of the
         * core plugin.
         */
    require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-upnext-loader.php';

    /**
         * The class responsible for defining internationalization functionality
         * of the plugin.
         */
    require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-upnext-i18n.php';

    /**
         * The class responsible for defining all actions that occur in the admin area.
         */
    require_once plugin_dir_path(dirname(__FILE__)) . 'admin/class-upnext-admin.php';

    /**
         * The class responsible for defining all actions that occur in the public-facing
         * side of the site.
         */
    require_once plugin_dir_path(dirname(__FILE__)) . 'public/class-upnext-public.php';

    $this->loader = new Upnext_Loader();

  }

  /**
   * Define the locale for this plugin for internationalization.
   *
   * Uses the Upnext_i18n class in order to set the domain and to register the hook
   * with WordPress.
   *
   * @since 1.0.0
   * @access private
   */
  private function set_locale() {

    $plugin_i18n = new Upnext_i18n();

    $this->loader->add_action('plugins_loaded', $plugin_i18n, 'load_plugin_textdomain');

  }

  /**
   * Register all of the hooks related to the admin area functionality
   * of the plugin.
   *
   * @since 1.0.0
   * @access private
   */
  private function define_admin_hooks() {

    $plugin_admin = new Upnext_Admin($this->get_plugin_name(), $this->get_version());

    $this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_styles');
    $this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts');

    $this->loader->add_action('admin_menu', $plugin_admin, 'add_admin_menu');
    $this->loader->add_action('admin_init', $plugin_admin, 'setup_fields');
    $this->loader->add_action('admin_init', $plugin_admin, 'setup_sections');

  }

  /**
   * The name of the plugin used to uniquely identify it within the context of
   * WordPress and to define internationalization functionality.
   *
   * @since 1.0.0
   *
   * @return string    The name of the plugin.
   */
  public function get_plugin_name() {
    return $this->plugin_name;
  }

  /**
   * Retrieve the version number of the plugin.
   *
   * @since 1.0.0
   *
   * @return string    The version number of the plugin.
   */
  public function get_version() {
    return $this->version;
  }

  /**
   * Register all of the hooks related to the public-facing functionality
   * of the plugin.
   *
   * @since 1.0.0
   * @access private
   */
  private function define_public_hooks() {

    $plugin_public = new Upnext_Public($this->get_plugin_name(), $this->get_version());

    $this->loader->add_action('wp', $plugin_public, 'wp_init');
    $this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_styles');
    $this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_scripts', 20);
    $this->loader->add_action('init', $plugin_public, 'event_rewrite_basic');
    $this->loader->add_action('template_redirect', $plugin_public, 'event_prefix_url_rewrite_templates');
    $this->loader->add_filter('query_vars', $plugin_public, 'event_add_query_vars_filter');
    $this->loader->add_shortcode('event_uitschrijven', $plugin_public, 'event_remove_participant_shortcode');
    $this->loader->add_shortcode('upnext_events', $plugin_public, 'upnext_events');
    $this->loader->add_shortcode('upnext_rootevents', $plugin_public, 'upnext_rootevents');

    $this->loader->add_filter('wp_title', $plugin_public, 'custom_seo_title');
    $this->loader->add_filter('wpseo_title', $plugin_public, 'custom_seo_title');
    $this->loader->add_filter('wpseo_opengraph_title', $plugin_public, 'custom_seo_title');
    $this->loader->add_filter('wpseo_canonical', $plugin_public, 'wpseo_canonical');
    $this->loader->add_filter('wpseo_next_rel_link', $plugin_public, 'wpseo_next_rel_link');
    $this->loader->add_filter('wpseo_opengraph_image', $plugin_public, 'custom_wpseo_opengraph_image');
    $this->loader->add_filter('wpseo_metadesc', $plugin_public, 'wpseo_metadesc');
	$this->loader->add_filter('wpseo_opengraph_desc', $plugin_public, 'wpseo_metadesc');
	$this->loader->add_filter('wpseo_opengraph_url', $plugin_public, 'wpseo_canonical');


    $this->loader->add_action('admin_post_register_event_person', $plugin_public, 'handle_register_event_person');
    $this->loader->add_action('admin_post_nopriv_register_event_person', $plugin_public, 'handle_register_event_person');

  }

  /**
   * Run the loader to execute all of the hooks with WordPress.
   *
   * @since 1.0.0
   */
  public function run() {
    $this->loader->run();
  }

  /**
   * The reference to the class that orchestrates the hooks with the plugin.
   *
   * @since 1.0.0
   *
   * @return Upnext_Loader    Orchestrates the hooks of the plugin.
   */
  public function get_loader() {
    return $this->loader;
  }

}
