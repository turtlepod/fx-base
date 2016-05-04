<?php
/**
 * Load & Register Scripts
 * @since 1.1.0
**/
if ( ! defined( 'WPINC' ) ) { die; }


/* === ADMIN SCRIPTS === */
//add_action( 'admin_enqueue_scripts', 'fx_base_admin_scripts' );

/**
 * Admin Scripts
 * @since 1.0.0
 */
function fx_base_admin_scripts( $hook_suffix ){
	global $post_type, $taxonomy;

	/* Conditional */
	if( in_array( $hook_suffix, array( 'post-new.php', 'post.php' ) ) ){
			
	}

	/* Style */
	wp_enqueue_style( 'fx-base-admin', FX_BASE_URI. 'assets/css/style.css', array(), FX_BASE_VERSION );

	/* Script */
	wp_enqueue_script( 'fx-base-admin', FX_BASE_URI. 'assets/js/script.js', array( 'jquery' ), FX_BASE_VERSION, true );
}


/* === FRONT END SCRIPTS === */
//add_action( 'wp_enqueue_scripts', 'fx_base_scripts' );

/**
 * Front End Scripts
 * @since 1.0.0
 */
function fx_base_scripts(){

	/* Vars */
	$object_id = get_queried_object_id();

	/* Page Template Check */
	if( is_page_template( 'templates/about.php' ) ){
		
	}
	/* Front Page Check */
	if( is_page() && is_front_page() ){
		
	}

	/* Style */
	wp_enqueue_style( 'fx-base', FX_BASE_URI. 'assets/css/style.css', array(), FX_BASE_VERSION );

	/* Script */
	wp_enqueue_script( 'fx-base', FX_BASE_URI. 'assets/js/script.js', array( 'jquery' ), FX_BASE_VERSION, true );
}





