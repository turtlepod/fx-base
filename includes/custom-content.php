<?php
/**
 * Custom Content
 * @since 1.0.0
**/

/* === REGISTER POST TYPE === */

/* add register post type on the 'init' hook */
add_action( 'init', 'fx_base_register_custom_content' );

/**
 * Register Post Type
 * @since  0.1.0
 */
function fx_base_register_custom_content() {

	/* = CUSTOM POST TYPE = */
	$cpt_args = array(
		'description'           => '',
		'public'                => true,
		'publicly_queryable'    => true,
		'show_in_nav_menus'     => true,
		'show_in_admin_bar'     => true,
		'exclude_from_search'   => false,
		'show_ui'               => true,
		'show_in_menu'          => true,
		//'menu_position'         => 5,
		'menu_icon'             => 'dashicons-screenoptions',
		'can_export'            => true,
		'delete_with_user'      => false,
		'hierarchical'          => false,
		'has_archive'           => true, 
		'query_var'             => true,
		'rewrite'               => array( 'slug' => 'fx-base', 'with_front' => false ),
		'capability_type'       => 'page',
		'supports'              => array( 'title', 'editor', 'excerpt', 'thumbnail' ),
		'labels'                => array(
			'name'                      => _x( 'Stuffs', 'cc', 'fx-base' ),
			'singular_name'             => _x( 'Stuff', 'cc', 'fx-base' ),
			'add_new'                   => _x( 'Add New', 'cc', 'fx-base' ),
			'add_new_item'              => _x( 'Add New Item', 'cc', 'fx-base' ),
			'edit_item'                 => _x( 'Edit Item', 'cc', 'fx-base' ),
			'new_item'                  => _x( 'New Item', 'cc', 'fx-base' ),
			'all_items'                 => _x( 'All Items', 'cc', 'fx-base' ),
			'view_item'                 => _x( 'View Item', 'cc', 'fx-base' ),
			'search_items'              => _x( 'Search Items', 'cc', 'fx-base' ),
			'not_found'                 => _x( 'Not Found', 'cc', 'fx-base' ),
			'not_found_in_trash'        => _x( 'Not Found in Trash', 'cc', 'fx-base' ), 
			'menu_name'                 => _x( 'f(x) Base', 'cc', 'fx-base' ),
		),
	);
	register_post_type( 'fx_base', $cpt_args );

	/* = CUSTOM TAXONOMY = */
	$ctax_args = array(
		'public'            => true,
		'show_ui'           => true,
		'show_in_nav_menus' => true,
		'show_tagcloud'     => true,
		'show_admin_column' => true,
		'hierarchical'      => true,
		'query_var'         => true,
		'labels' => array(
			'name'                       => _x( 'Stuff Cats', 'cc', 'fx-base' ),
			'singular_name'              => _x( 'Stuff Cat', 'cc', 'fx-base' ),
			'name_admin_bar'             => _x( 'Cat', 'cc', 'fx-base' ),
			'search_items'               => _x( 'Search Items', 'cc', 'fx-base' ),
			'popular_items'              => _x( 'Popular Items', 'cc', 'fx-base' ),
			'all_items'                  => _x( 'All Items', 'cc', 'fx-base' ),
			'edit_item'                  => _x( 'Edit Item', 'cc', 'fx-base' ),
			'view_item'                  => _x( 'View Item', 'cc', 'fx-base' ),
			'update_item'                => _x( 'Update Item', 'cc', 'fx-base' ),
			'add_new_item'               => _x( 'Add New Item', 'cc', 'fx-base' ),
			'new_item_name'              => _x( 'New Item Name', 'cc', 'fx-base' ),
			'separate_items_with_commas' => _x( 'Separate items with commas', 'cc', 'fx-base' ),
			'add_or_remove_items'        => _x( 'Add or remove items', 'cc', 'fx-base' ),
			'choose_from_most_used'      => _x( 'Choose from the most used items', 'cc', 'fx-base' ),
			'menu_name'                  => _x( 'Cats', 'cc', 'fx-base' ),
		)
	);
	register_taxonomy( 'fx_base_cat', array( 'fx_base' ), $ctax_args );
}


/* ===== ADMIN SCRIPTS ===== */

/* Load Admin Scripts */
//add_action( 'admin_enqueue_scripts', 'fx_base_cc_scripts' );

/**
 * Admin Scripts
 */
function fx_base_cc_scripts( $hook_suffix ){
	global $post_type, $taxonomy;

	/* Register Style */
	wp_register_style( 'fx-base-admin', FX_BASE_URI. 'assets/css/style.css', array(), FX_BASE_VERSION );

	/* Script */
	wp_register_script( 'fx-base-admin', FX_BASE_URI. 'assets/js/script.js', array( 'jquery' ), FX_BASE_VERSION, true );

	/* Post Type Screen */
	if( 'fx_base' == $post_type ){

		/* Columns/List */
		if( 'edit.php' == $hook_suffix ){
			wp_enqueue_style( 'fx-base-admin' );
			wp_enqueue_script( 'fx-base-admin' );
		}
		/* Add/Edit Screen */
		if( in_array( $hook_suffix, array( 'post-new.php', 'post.php' ) ) ){
			wp_enqueue_style( 'fx-base-admin' );
			wp_enqueue_script( 'fx-base-admin' );
		}
	}

	/* Taxonomy Screen */
	if( 'fx_base_cat' == $taxonomy ){

		/* Add New & Column/List */
		if( "edit-tags.php" == $hook_suffix ){
			wp_enqueue_style( 'fx-base-admin' );
			wp_enqueue_script( 'fx-base-admin' );
		}
		/* Edit Screen */
		if( "term.php" == $hook_suffix ){
			wp_enqueue_style( 'fx-base-admin' );
			wp_enqueue_script( 'fx-base-admin' );
		}
	}


}
































