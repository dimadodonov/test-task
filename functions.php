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
    wp_enqueue_script( 'main_jquery', 'https://code.jquery.com/jquery-2.2.4.min.js', array(), '2.2.4', true );
    wp_enqueue_script( 'bootstrap_popper', get_template_directory_uri() . '/libs/bootstrap/js/popper.min.js', array('jquery'), null, true );
    wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/libs/bootstrap/js/bootstrap.min.js', array('jquery'), null, true );
    wp_enqueue_script( 'ofi', get_template_directory_uri() . '/libs/ofi/ofi.min.js', array('jquery'), null, true );
    wp_enqueue_script( 'wowjs', get_template_directory_uri() . '/libs/wowjs/wow.min.js', array('jquery'), null, true );
    wp_enqueue_script( 'main_js', get_template_directory_uri() . '/js/scripts.js', array('jquery'), null, true );
}

/**
 * Добавляем собственный тип постов
 */
require get_template_directory() . '/includes/post-type.php';