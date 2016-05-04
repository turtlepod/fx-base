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

/* Do not access this file directly */
if ( ! defined( 'WPINC' ) ) { die; }

/* Constants
------------------------------------------ */

/* Set plugin version constant. */
define( 'FX_BASE_VERSION', '1.0.0' );

/* Set constant path to the plugin directory. */
define( 'FX_BASE_PATH', trailingslashit( plugin_dir_path(__FILE__) ) );

/* Set the constant path to the plugin directory URI. */
define( 'FX_BASE_URI', trailingslashit( plugin_dir_url( __FILE__ ) ) );


/* Includes
------------------------------------------ */

/* Functions */
require_once( FX_BASE_PATH . 'includes/functions.php' );


/* Plugins Loaded
------------------------------------------ */

/* Load plugins file */
add_action( 'plugins_loaded', 'fx_base_plugins_loaded' );

/**
 * Load plugins file
 * @since 0.1.0
 */
function fx_base_plugins_loaded(){

	/* Load Text Domain (Language Translation) */
	load_plugin_textdomain( 'fx-base', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );

	/* Load Settings */
	if( is_admin() ){
		require_once( FX_BASE_PATH . 'includes/settings.php' );
		$fx_base_settings = new fx_Base_Settings();
	}

	/* Custom Content */
	require_once( FX_BASE_PATH . 'includes/custom-content.php' );

	/* Scripts */
	require_once( FX_BASE_PATH . 'includes/scripts.php' );

	/* Plugin Action Link */
	add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'fx_base_plugin_action_links' );

}

/**
 * Add Action Link For Support
 * @since 1.0.0
 */
function fx_base_plugin_action_links( $links ){

	/* Get current user info */
	if( function_exists( 'wp_get_current_user' ) ){
		$current_user = wp_get_current_user();
	}
	else{
		global $current_user;
		get_currentuserinfo();
	}

	/* Build support url */
	$support_url = add_query_arg(
		array(
			'about'      => urlencode( 'f(x) {BASE} (v.' . FX_BASE_VERSION . ')' ),
			'sp_name'    => urlencode( $current_user->display_name ),
			'sp_email'   => urlencode( $current_user->user_email ),
			'sp_website' => urlencode( home_url() ),
		),
		'http://genbumedia.com/contact/'
	);

	/* Add support link */
	$links[] = '<a target="_blank" href="' . esc_url( $support_url ) . '">' . __( 'Get Support', 'fx-base' ) . '</a>';

	return $links;
}


/* Activation and Uninstall
------------------------------------------ */

/* Register activation hook. */
register_activation_hook( __FILE__, 'fx_base_plugin_activation' );


/**
 * Runs only when the plugin is activated.
 * @since 1.0.0
 */
function fx_base_plugin_activation() {

	/* Temporary Data (5sec) to Add Activation Notice */
	set_transient( 'fx_base_activation_notice', '1', 5 );

	/* Uninstall hook */
	register_uninstall_hook( __FILE__, 'fx_base_plugin_uninstall' );
}


/**
 * Runs only when the plugin is uninstalled (deleted via wp-admin).
 * @since 1.0.0
 */
function fx_base_plugin_uninstall(){
	/* Delete option */
	delete_option( 'fx-base' );
}


/* Activation Notice
------------------------------------------ */

/* Add admin notice */
add_action( 'admin_notices', 'fx_base_plugin_activation_notice' );

/**
 * Admin Notice on Activation.
 * @since 1.0.0
 */
function fx_base_plugin_activation_notice(){
	$transient = get_transient( 'fx_base_activation_notice' );
	if( $transient ){
		?>
		<div class="updated notice is-dismissible">
			<p><?php _e( 'Thank you for using our plugin :)', 'fx-base' ); ?></p>
		</div>
		<?php
		delete_transient( 'fx_base_activation_notice' );
	}
}


