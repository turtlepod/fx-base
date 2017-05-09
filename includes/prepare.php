<?php
/* Do not access directly */
if ( ! defined( 'WPINC' ) ) {
	die;
}


/* Load Text Domain
------------------------------------------ */
load_plugin_textdomain( dirname( $plugin ), false, dirname( $plugin ) . '/languages/' );


/* Load Updater
------------------------------------------ */
$args = array(
	'id' => $plugin,
);
new fx_Base_Updater( $args );


/* Add Support Link
------------------------------------------ */
$args = array(
	'plugin'    => $plugin,
	'name'      => __( 'f(x) Base', 'fx-base' ),
	'version'   => $version,
	'text'      => __( 'Get Support', 'fx-base' ),
);
new fx_Base_Plugin_Action_Links( $args );


/* Check PHP and WordPress Version
------------------------------------------ */



/* Welcome Notice
------------------------------------------ */

