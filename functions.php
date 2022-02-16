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
    wp_enqueue_style( 'main-style', get_template_directory_uri() . '/fonts/icomoon/icon-font.css', array(), null, 'all' );
    wp_enqueue_style( 'main-style', get_template_directory_uri() . '/libs/animate/animate.min.css', array(), null, 'all' );
    wp_enqueue_style( 'main-style', get_template_directory_uri() . '/css/style.min.css', array(), null, 'all' );
}

add_action( 'wp_enqueue_scripts', 'main_scripts' );
function main_scripts() {
    wp_enqueue_script( 'main_js', get_template_directory_uri() . '/assets/js/app.min.js', array(), null, true );
}

/**
 * Добавляем собственный тип постов
 */
require get_template_directory() . '/includes/post-type.php';