<?php
/** Remove Styles **/
add_action( 'wp_print_styles', 'joy_dequeue_styles', 100 );
function joy_dequeue_styles() {
  wp_dequeue_style( 'wp-block-library' );
}

/** Remove Script **/
add_action( 'wp_footer', 'joy_dequeue_scripts' );
function joy_dequeue_scripts() {
  wp_dequeue_script( 'wp-embed' );
}

/** Remove Emoji **/
// add_action( 'init', 'joy_disable_emojis' );
function joy_disable_emojis() {
  remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
  remove_action( 'wp_print_styles', 'print_emoji_styles' );
}

/** Preload Javascript **/
add_action( 'wp_head', 'joy_preload_scripts', 1 );
function joy_preload_scripts() {
  $app = get_template_directory_uri() . '/assets/js/app.js?ver=' . THEME_VERSION;
  echo "<link rel=\"preload\" href=\"{$app}\" as=\"script\" />\n";
}

// Register & enqueue assets
add_action( 'wp_enqueue_scripts', 'joy_enqueue_assets' );
function joy_enqueue_assets() {
  wp_register_style( 'fonts', get_theme_file_uri( '/assets/fonts/stylesheet.css' ), array(), THEME_VERSION, 'all' );
  wp_register_style( 'swiper', 'https://cdnjs.cloudflare.com/ajax/libs/Swiper/5.4.5/css/swiper.min.css', array(), '5.4.5', 'all' );
  // wp_register_style( 'chunk_vendors', get_theme_file_uri( '/assets/css/chunk-vendors.' . THEME_VERSION . '.css' ), false, THEME_VERSION, 'all' );
  wp_register_style( 'app', get_theme_file_uri( '/assets/css/app.css' ), array( 'fonts', 'swiper' ), THEME_VERSION, 'all' );
  wp_register_script( 'chunk_vendors', get_theme_file_uri( '/assets/views/chunk-vendors.' . THEME_VERSION . '.js' ), false, THEME_VERSION, true );
  wp_register_script( 'app', get_theme_file_uri( '/assets/js/app.js' ), array( 'chunk_vendors' ), THEME_VERSION, true );
  
  wp_enqueue_style( 'app' );
  wp_enqueue_script( 'app' );
  wp_localize_script( 'app', 'appSettings', joy_get_app_settings() );
}
