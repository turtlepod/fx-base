<?php
/**
 * Settings Page
 * @since 1.0.0
**/
if ( ! defined( 'WPINC' ) ) { die; }

/**
 * Create Settings Page
 * @since 1.0.0
 */
class fx_Base_Settings{

	/* Settings vars */
	public $settings_slug = 'fx-base';
	//public $settings_id = 'settings_page_fx-base'; /* $hook_suffix Under "Settings" */
	public $settings_id = 'fx_base_page_fx-base'; /* $hook_suffix */
	public $options_group = 'fx-base';
	public $option_name = 'fx-base';

	/**
	 * Construct
	 * @since 1.0.0
	 */
	public function __construct(){

		/* Create Settings Page */
		add_action( 'admin_menu', array( $this, 'create_settings_page' ) );

		/* Register Settings and Fields */
		add_action( 'admin_init', array( $this, 'register_settings' ) );

		/* Settings Scripts */
		add_action( 'admin_enqueue_scripts', array( $this, 'settings_scripts' ) );
	}

	/**
	 * Create Settings Page
	 * @since 1.0.0
	 */
	public function create_settings_page(){

		/* Create Settings Sub-Menu */
		add_submenu_page(
			'edit.php?post_type=fx_base', // parent slug "options-general.php"
			_x( 'f(x) Base', 'settings page', 'fx-base' ), // page title
			_x( 'f(x) Settings', 'settings page', 'fx-base' ), // menu title
			'manage_options',  // capability
			$this->settings_slug, // page slug
			array( $this, 'settings_page' ) // callback functions
		);
	}

	/**
	 * Settings Page Output
	 * @since 1.0.0
	 */
	public function settings_page(){
	?>
		<div class="wrap">
			<h1><?php _ex( 'f(x) Base', 'settings page', 'fx-base' ); ?></h1>
			<form method="post" action="options.php">
				<?php settings_fields( $this->options_group ); ?>
				<?php do_settings_sections( $this->settings_slug ); ?>
				<?php submit_button(); ?>
			</form>
		</div><!-- wrap -->
	<?php
	}

	/**
	 * Settings Scripts
	 * @since 1.0.0
	 */
	public function settings_scripts( $hook_suffix ){

		/* Only load in settings page. */
		if ( $this->settings_id == $hook_suffix ){

			/* Style */
			wp_enqueue_style( 'fx-base-settings', FX_BASE_URI. 'assets/css/style.css', array(), FX_BASE_VERSION );

			/* Script */
			wp_enqueue_script( 'fx-base-settings', FX_BASE_URI. 'assets/js/script.js', array( 'jquery' ), FX_BASE_VERSION, true );
		}
	}

	/**
	 * Sanitize Options
	 * @since 1.0.0
	 */
	public function sanitize( $data ){
		return $data;
	}

	/**
	 * Register Settings
	 * @since 0.1.0
	 */
	public function register_settings(){

		/* Register settings */
		register_setting(
			$this->options_group, // options group
			$this->option_name, // option name/database
			array( $this, 'sanitize' ) // sanitize callback function
		);

		/* Create settings section */
		add_settings_section(
			'fx_base_section1', // Section ID
			_x( 'Section #1', 'settings page', 'fx-base' ), // Section title
			'__return_false', // Section callback function
			$this->settings_slug // Settings page slug
		);

		/* Create Setting Field: Boxes, Buttons, Columns */
		add_settings_field(
			'fx_base_settings_field1', // Field ID
			_x( 'Field #1', 'settings page', 'fx-base' ), // Field title 
			array( $this, 'settings_field1' ), // Field callback function
			$this->settings_slug, // Settings page slug
			'fx_base_section1' // Section ID
		);

	}

	/**
	 * Settings Field Callback
	 * @since 1.0.0
	 */
	public function settings_field1(){
	?>
		<p class="fx-base">Hi there, add fields here!</p>
	<?php
	}

}

