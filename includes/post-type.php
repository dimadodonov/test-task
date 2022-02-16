<?php
if ( ! defined( 'ABSPATH')) {
    exit;
}

if ( ! function_exists( 'projects_post_type' ) ) {

	// Register Custom Post Type
	function projects_post_type() {

		$labels = array(
			'name'                  => _x( 'Жк', 'Post Type General Name', 'mitroliti' ),
			'singular_name'         => _x( 'Жк', 'Post Type Singular Name', 'mitroliti' ),
			'menu_name'             => __( 'Жк', 'mitroliti' ),
			'name_admin_bar'        => __( 'Объект', 'mitroliti' ),
			'archives'              => __( 'Item Archives', 'mitroliti' ),
			'parent_item_colon'     => __( 'Parent Item:', 'mitroliti' ),
			'all_items'             => __( 'Все проекты', 'mitroliti' ),
			'add_new_item'          => __( 'Добавить новый проект', 'mitroliti' ),
			'add_new'               => __( 'Добавить проект', 'mitroliti' ),
			'new_item'              => __( 'Новый проект', 'mitroliti' ),
			'edit_item'             => __( 'Редактировать проект', 'mitroliti' ),
			'update_item'           => __( 'Обновить проект', 'mitroliti' ),
			'view_item'             => __( 'Посмотреть проект', 'mitroliti' ),
			'search_items'          => __( 'Поиск проекта', 'mitroliti' ),
			'not_found'             => __( 'Не найден', 'mitroliti' ),
			'not_found_in_trash'    => __( 'Проектов корзине не найдено', 'mitroliti' )
		);

		$args = array(
			'label'                 => __( 'Жк', 'mitroliti' ),
			'labels'                => $labels,
			'supports'              => array( 'title', 'editor', 'thumbnail', 'custom-fields' ),
			// 'taxonomies'            => array( 'category', 'post_tag' ),
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 20,
			'menu_icon'             => 'dashicons-admin-home',
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => true,
			'exclude_from_search'   => false,
			'publicly_queryable'    => true,
			'capability_type'       => 'post',
			'show_in_rest'          => true,
		);
		
		register_post_type( 'projects', $args );

	}

	add_action( 'init', 'projects_post_type', 0 );

}

if ( ! function_exists( 'projects_cat' ) ) {

	// Register Custom Taxonomy
	function projects_cat() {

		$labels = array(
			'name'                       => _x( 'Категории работ', 'Taxonomy General Name', 'mitroliti' ),
			'singular_name'              => _x( 'Категория работы', 'Taxonomy Singular Name', 'mitroliti' ),
			'menu_name'                  => __( 'Категории', 'mitroliti' ),
			'all_items'                  => __( 'Все категории', 'mitroliti' ),
			'parent_item'                => __( 'Родительская категория', 'mitroliti' ),
			'parent_item_colon'          => __( 'Родительская категория:', 'mitroliti' ),
			'new_item_name'              => __( 'Название новой категории', 'mitroliti' ),
			'add_new_item'               => __( 'Добавить категорию', 'mitroliti' ),
			'edit_item'                  => __( 'Изменить категорию', 'mitroliti' ),
			'update_item'                => __( 'Обновить категорию', 'mitroliti' ),
			'view_item'                  => __( 'Посмотреть категорию', 'mitroliti' ),
			'separate_items_with_commas' => __( 'Separate items with commas', 'mitroliti' ),
			'add_or_remove_items'        => __( 'Add or remove items', 'mitroliti' ),
			'choose_from_most_used'      => __( 'Choose from the most used', 'mitroliti' ),
			'popular_items'              => __( 'Popular Items', 'mitroliti' ),
			'search_items'               => __( 'Search Items', 'mitroliti' ),
			'not_found'                  => __( 'Not Found', 'mitroliti' ),
			'no_terms'                   => __( 'No items', 'mitroliti' ),
			'items_list'                 => __( 'Items list', 'mitroliti' ),
			'items_list_navigation'      => __( 'Items list navigation', 'mitroliti' ),
		);
		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => true,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => true,
			'show_in_rest'               => true,
		);
		register_taxonomy( 'projects_cat', array( 'projects' ), $args );

	}

	add_action( 'init', 'projects_cat', 0 );

}