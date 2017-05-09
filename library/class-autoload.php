<?php
/**
 * AutoLoad
 * 
 * A very simple autoload.
 * This class need to be loaded as early as possible.
 * 
 * @version 1.0.0
 *
 * @author David Chandra Purnama <david@genbumedia.com>
 * @copyright Copyright (c) 2017, Genbu Media
 * @license GPLv2 or later
 */
class Fx_Base_AutoLoad{

	/* Vars */
	public $config;
	public $path;

	/**
	 * Constructor
	 * 
	 * @since 1.0.0
	 * 
	 * @param array $config Prefix/NameSpace as key and directory as value
	 * @param string $path Base plugin path
	 * @return void
	 */
	public function __construct( $config, $path ) {
		$this->config = $config;
		$this->path   = $path;

		/* Register Autoload */
		spl_autoload_register( array( $this, 'autoload' ) );
	}

	/**
	 * AutoLoad Callback
	 * 
	 * @since 1.0.0
	 *
	 * @param string $class_name
	 */
	public function autoload( $class_name ) {

		/* Foreach autoload configuration */
		foreach ( $this->config as $prefix => $dirs ) {

			/* If match */
			if ( false !== strpos( strtolower( $class_name ), strtolower( $prefix ) ) ) {

				/* Get file name from class name */
				$file_name = $this->get_file_name( $class_name, $prefix );

				/* if multiple directory config */
				if ( is_array( $dirs ) ) {

					/* Loop foreach dirs */
					foreach ( $dirs as $dir ) {
						$file_path = trailingslashit( $this->path . $dir ) . $file_name;
						if ( file_exists( $file_path ) ) {
							require_once $file_path;
							return;
						}
					}
				}
				/* Single Directory */
				else {
					$dir = $dirs;
					$file_path = trailingslashit( $this->path . $dir ) . $file_name;
					if ( file_exists( $file_path ) ) {
						require_once $file_path;
						return;
					}
				}
			}
		}
	}

	/**
	 * Get File Name From Class Name
	 * 
	 * @since 1.0.0
	 * 
	 * @param string $class_name
	 * @return string $file_name
	 */
	public function get_file_name( $class_name, $prefix ) {

		$file_name = str_replace( $prefix, '', $class_name ); // remove prefix
		$file_name = str_replace( '_', '-', $file_name ); // underscore to dash
		$file_name = wp_unslash( $file_name ); // remove backslash
		$file_name = strtolower( $file_name ); // lowercase it
		$file_name = trim( $file_name ); // remove white space
		$file_name = trim( $file_name, "_" ); // remove first and last underscore
		$file_name = trim( $file_name, "-" ); // remove first and last dash
		$file_name = "class-{$file_name}.php";

		return $file_name;
	}
}
