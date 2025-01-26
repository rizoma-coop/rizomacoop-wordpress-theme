<?php

// CONSTANTS =================================================================
define('RC_THEME_DIR', get_theme_file_path() . '/');
define('RC_THEME_URL', get_template_directory_uri() . '/');


// HOOKS =================================================================


// Editor styles
function rc_editor_style() {
  add_theme_support('editor-styles');
  add_editor_style([
    'https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap',
    get_theme_file_uri('css/main.css')
  ]);
}
add_action( 'after_setup_theme', 'rc_editor_style' );

// Frontend styles
function rc_enqueue_styles() {
  wp_enqueue_style(
    'rc-style',
    get_parent_theme_file_uri( 'css/main.css' ),
    array(),
    wp_get_theme()->get( 'Version' )
  );
}
add_action( 'wp_enqueue_scripts', 'rc_enqueue_styles' );

// Head
function rc_head() {
  ?>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
  <?php
}
add_action('wp_enqueue_scripts', 'rc_head', 5);


// Disable auto-update emails for plugins
add_filter( 'auto_plugin_update_send_email', '__return_false' );