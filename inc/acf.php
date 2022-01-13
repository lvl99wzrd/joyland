<?php
/** --- Advanced Custom Fields Distribution --- **/
// Customize ACF path
add_filter( 'acf/settings/path', 'joy_acf_settings_path' );
function joy_acf_settings_path( $path ) {
	$path = get_theme_file_path( '/inc/acf/' );
	return $path;
}

// Customize ACF dir
add_filter( 'acf/settings/dir', 'joy_acf_settings_dir' );
function joy_acf_settings_dir( $dir ) {
	$dir = get_theme_file_uri( '/inc/acf/' );
	return $dir;
}

// Hide ACF field group menu item
add_filter( 'acf/settings/show_admin', 'joy_show_acf_admin_menu' );
function joy_show_acf_admin_menu( $show ) {
  return get_current_user_id() == 1;
}

// Local JSON save directory
add_filter( 'acf/settings/save_json', 'joy_acf_json_save_point' );
function joy_acf_json_save_point( $path ) {
  $path = get_theme_file_path( '/inc/acf-json' );
	wp_mkdir_p( $path );
  return $path;
}

// Local JSON load directory
add_filter( 'acf/settings/load_json', 'joy_acf_json_load_point' );
function joy_acf_json_load_point( $paths ) {
  $paths[] = get_theme_file_path( '/inc/acf-json' );
  return $paths;
}

// Include ACF
include_once( get_theme_file_path( '/inc/acf/acf.php' ) );

/**
 * Add ACF option sub page for footer settings
 */
add_action( 'init', 'joy_acf_init' );
function joy_acf_init() {
  if ( function_exists( 'acf_add_options_sub_page' ) ) {
    acf_add_options_sub_page(
      array(
        'page_title'      => __( "Site Footer", 'joy' ),
        'menu_title'      => __( "Site Footer", 'joy' ),
        'menu_slug'       => 'joy_footer',
        'capability'      => 'edit_others_posts',
        'post_id'         => 'joy_footer',
        'autoload'        => true,
        'update_button'   => __( "Save Settings", 'joy' ),
        'updated_message' => __( "Footer settings updated", 'joy' ),
        'parent_slug'     => 'themes.php',
      )
    );
  }
}
