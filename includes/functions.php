<?php
namespace fx_base;

/**
 * Class Wrapper for plugin functions.
 * All functions are "public" and "static"
 * The idea is to enable "use" in "child" namespace.
 * Usage:
 *
 * use fx_base\Functions;
 * Functions::get_option( $args ); 
 *
 * @since 1.0.0
 */
class Functions{

	/**
	 * Get Option helper function
	 * To get option easier when merging multiple option in single option name.
	 * @since 1.0.0
	 */
	public static function fx_base_get_option( $option, $default = '', $option_name = 'fx-base' ) {

		/* Bail early if no option defined */
		if ( !$option ){
			return false;
		}

		/* Get option from db */
		$get_option = get_option( $option_name );

		/* if the data is not array, return false */
		if( !is_array( $get_option ) ){
			return $default;
		}

		/* Get data if it's set */
		if( isset( $get_option[$option] ) ){
			return $get_option[$option];
		}

		/* Data is not set */
		else{
			return $default;
		}
	}

} // end class