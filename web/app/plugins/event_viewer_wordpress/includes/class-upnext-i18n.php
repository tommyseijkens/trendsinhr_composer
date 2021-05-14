<?php

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link Driessen
 * @since 1.0.0
 *
 * @package Upnext
 * @subpackage Upnext/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since 1.0.0
 * @package Upnext
 * @subpackage Upnext/includes
 * @author Driessen Groep <webmasters@driessengroep.nl>
 */
class Upnext_i18n {

  /**
   * Load the plugin text domain for translation.
   *
   * @since 1.0.0
   */
  public function load_plugin_textdomain() {

    load_plugin_textdomain(
    'upnext',
    FALSE,
    dirname(dirname(plugin_basename(__FILE__))) . '/languages/'
    );

  }

}
