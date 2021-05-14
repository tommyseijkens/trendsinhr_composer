<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              Driessen
 * @since             1.0.0
 * @package           Upnext
 *
 * @wordpress-plugin
 * Plugin Name:       UpNext
 * Plugin URI:        http://www.driessengroep.nl
 * Description:       Show events from UpNext.
 * Version:           1.0.14
 * Author:            Driessen Groep
 * Author URI:        http://www.driessengroep.nl
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       upnext
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'PLUGIN_NAME_VERSION', '1.0.14' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-upnext-activator.php
 */
function activate_upnext() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-upnext-activator.php';
	Upnext_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-upnext-deactivator.php
 */
function deactivate_upnext() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-upnext-deactivator.php';
	Upnext_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_upnext' );
register_deactivation_hook( __FILE__, 'deactivate_upnext' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-upnext.php';
require plugin_dir_path( __FILE__ ) . 'includes/class-upnext-connectapi.php';
require plugin_dir_path( __FILE__ ) . 'includes/class-upnext-eventfunctions.php';
require plugin_dir_path( __FILE__ ) . 'includes/class-upnext-config.php';

require 'plugin-update-checker/plugin-update-checker.php';
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
  'https://github.com/driessenhrm/event_viewer_wordpress/',
  __FILE__,
  'upnext'
);

$myUpdateChecker->setAuthentication(GITHUB_API_UPNEXT);

$myUpdateChecker->getVcsApi()->enableReleaseAssets();

$myUpdateChecker->setBranch('master');

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_upnext() {

	$plugin = new Upnext();
	$plugin->run();

}
run_upnext();
