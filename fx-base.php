<?php
/**
 * Plugin Name: f(x) {BASE}
 * Plugin URI: http://genbumedia.com/plugins/{SLUG}/
 * Description: {SHORT DESCRIPTION}
 * Version: 1.0.0
 * Author: David Chandra Purnama
 * Author URI: http://shellcreeper.com/
 * License: GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: {PLUGIN FOLDER NAME}
 * Domain Path: /languages/
 *
 * @author David Chandra Purnama <david@genbumedia.com>
 * @copyright Copyright (c) 2016, Genbu Media
**/
if ( ! defined( 'WPINC' ) ) { die; }


/* Constants
------------------------------------------ */

define( 'FX_BASE_URI', trailingslashit( plugin_dir_url( __FILE__ ) ) );
define( 'FX_BASE_PATH', trailingslashit( plugin_dir_path( __FILE__ ) ) );
define( 'FX_BASE_FILE', __FILE__ );
define( 'FX_BASE_PLUGIN', plugin_basename( __FILE__ ) );
define( 'FX_BASE_VERSION', '1.0.0' );


/* AutoLoad
------------------------------------------ */
require_once( FX_BASE_PATH . 'library/class-autoload.php' );
$config = array(
	'fx_Base' => 'library',
);
new Fx_Base_AutoLoad( $config, FX_BASE_PATH );


/* Init
------------------------------------------ */

/* Load plugin in "plugins_loaded" hook */
add_action( 'plugins_loaded', 'fx_base_init' );

/**
 * Plugin Init
 * @since 0.1.0
 */
function fx_base_init() {

	/* Var */
	$uri      = FX_BASE_URI;
	$path     = FX_BASE_PATH;
	$file     = FX_BASE_FILE;
	$plugin   = FX_BASE_PLUGIN;
	$version  = FX_BASE_VERSION;

	/* Load text domain */
	load_plugin_textdomain( dirname( $plugin ), false, dirname( $plugin ) . '/languages/' );

	/* Updater */
	new fx_Base_Updater( array( 'id' => $plugin ) );

	/* Plugin Action Link */
	$args = array(
		'plugin'    => $plugin,
		'name'      => __( 'f(x) Base', 'fx-base' ),
		'version'   => $version,
		'text'      => __( 'Get Support', 'fx-base' ),
	);
	new fx_Base_Plugin_Action_Links( $args );

	/* System Requirements */
	$args = array(
		'wp_requires'   => array(
			'version'       => '4.4',
			'notice'        => wpautop( sprintf( __( 'f(x) Base plugin requires at least WordPress 4.4+. You are running WordPress %s. Please upgrade and try again.', 'fx-base' ), get_bloginfo( 'version' ) ) ),
		),
		'php_requires'  => array(
			'version'       => '5.3',
			'notice'        => wpautop( sprintf( __( 'f(x) Base plugin requires at least PHP 5.3+. You are running PHP %s. Please upgrade and try again.', 'fx-base' ), PHP_VERSION ) ),
		),
	);
	$sys_req = new fx_Base_System_Requirements( $args );
	if( ! $sys_req->check() ) return; // bail

	/* Welcome Notices */
	$args = array( 
		'notice'  => wpautop( __( 'Thank you for using our plugin :)', 'fx-base' ) ),
		'dismiss' => __( 'Dismiss this notice.', 'fx-base' ),
		'option'  => 'fx-base_welcome',
	);
	new fx_Base_Welcome_Notice( $args );

	/* Setup */
	require_once( $path . 'includes/setup.php' );
}


/* Activation
------------------------------------------ */

/* Register activation hook. */
register_activation_hook( __FILE__, 'fx_base_plugin_activation' );

/**
 * Runs only when the plugin is activated.
 * @since 1.0.0
 */
function fx_base_plugin_activation() {
	require_once( trailingslashit( plugin_dir_path( __FILE__ ) ) . 'install.php' );
}
