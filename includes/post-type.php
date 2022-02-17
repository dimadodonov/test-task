<?php
if ( ! defined( 'ABSPATH')) {
    exit;
}

if ( ! function_exists( 'buildings_post_type' ) ) {

	// Register Custom Post Type
	function buildings_post_type() {

		$labels = array(
			'name'                  => _x( 'Buildings', 'Post Type General Name', 'dd' ),
			'singular_name'         => _x( 'Buildings', 'Post Type Singular Name', 'dd' ),
			'menu_name'             => __( 'Buildings', 'dd' ),
			'name_admin_bar'        => __( 'Building', 'dd' ),
		);

		$args = array(
			'label'                 => __( 'Buildings', 'dd' ),
			'labels'                => $labels,
			'supports'              => array( 'title', 'editor', 'thumbnail', 'custom-fields' ),
			// 'taxonomies'            => array( 'category', 'post_tag' ),
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 20,
			'menu_icon'             => 'dashicons-admin-multisite',
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => true,
			'exclude_from_search'   => false,
			'publicly_queryable'    => true,
			'capability_type'       => 'post',
			'show_in_rest'          => true,
		);
		
		register_post_type( 'buildings', $args );

	}

	add_action( 'init', 'buildings_post_type', 0 );

}