<?php

if ( ! defined( 'ABSPATH')) {
    exit;
}

/*
 * Let WordPress manage the document title.
 * By adding theme support, we declare that this theme does not use a
 * hard-coded <title> tag in the document head, and expect WordPress to
 * provide it for us.
 */
add_theme_support( 'title-tag' );

/**
 * Включаем миниатюры в записях.
 */
add_theme_support('post-thumbnails');

/**
 * Enqueue scripts and styles.
 */
add_action( 'wp_enqueue_scripts', 'main_style' );
function main_style() {
    wp_enqueue_style( 'main-icon-font', get_template_directory_uri() . '/fonts/icomoon/icon-font.css', array(), null, 'all' );
    wp_enqueue_style( 'main-animate-style', get_template_directory_uri() . '/libs/animate/animate.min.css', array(), null, 'all' );
    wp_enqueue_style( 'main-style', get_template_directory_uri() . '/css/style.min.css', array(), null, 'all' );
}

add_action( 'wp_enqueue_scripts', 'main_scripts' );
function main_scripts() {
    
	global $wp_query; 

    // In most cases it is already included on the page and this line can be removed
	wp_enqueue_script('jquery');

    wp_enqueue_script( 'bootstrap_popper', get_template_directory_uri() . '/libs/bootstrap/js/popper.min.js', array('jquery'), null, true );
    wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/libs/bootstrap/js/bootstrap.min.js', array('jquery'), null, true );
    wp_enqueue_script( 'ofi', get_template_directory_uri() . '/libs/ofi/ofi.min.js', array('jquery'), null, true );
    wp_enqueue_script( 'wowjs', get_template_directory_uri() . '/libs/wowjs/wow.min.js', array('jquery'), null, true );
    wp_enqueue_script( 'main_js', get_template_directory_uri() . '/js/scripts.js', array('jquery'), null, true );

	// when you use wp_localize_script(), do not enqueue the target script immediately
	wp_register_script( 'misha_scripts', get_stylesheet_directory_uri() . '/js/myloadmore.js', array('jquery') );
 
	// passing parameters here
	// actually the <script> tag will be created and the object "misha_loadmore_params" will be inside it 
	wp_localize_script( 'misha_scripts', 'misha_loadmore_params', array(
		'ajaxurl' => site_url() . '/wp-admin/admin-ajax.php', // WordPress AJAX
		'posts' => json_encode( $wp_query->query_vars ), // everything about your loop is here
		'current_page' => $wp_query->query_vars['paged'] ? $wp_query->query_vars['paged'] : 1,
		'max_page' => $wp_query->max_num_pages
	) );
 
 	wp_enqueue_script( 'misha_scripts' );

}

/**
 * Добавляем собственный тип постов
 */
require get_template_directory() . '/includes/post-type.php';

/**
 * Добавляем подгрузку постов через Ajax
 */
require get_template_directory() . '/includes/ajax.php';