<?php
/**
 * Set namespace
 */
function joy_rest_namespace() {
	$theme = wp_get_theme();
	$textdomain = $theme->get('TextDomain');
	$version = $theme->get('Version');
	list($major, $minor, $revision) = explode( '.', $version );
	return "{$textdomain}/v{$major}";
}

/**
 * Set rest title
 */
function joy_rest_set_title( $title ) {
	global $rest_title;
	$rest_title = $title;

	add_filter( 'rest_pre_serve_request', function( $value ) {
		global $rest_title;
		header( 'X-WP-Title: ' . $rest_title );
		header( 'Access-Control-Expose-Headers: X-WP-Total, X-WP-TotalPages, X-WP-Title' );
		return $value;
	} );
}

/**
 * Get app settings
 */
function joy_get_app_settings() {
  $base_url = site_url( 'wp-json', 'https' );
  $parse_url = parse_url( $base_url );

  // Get footer menu
  $footer_menu = get_field( 'menu', 'joy_footer' );
  if ( $footer_menu ) {
    $footer_menu = array_map( function( $item ) {
      return array(
        'slug'  => $item->post_name,
        'title' => $item->post_title,
      );
    }, $footer_menu);
  }

  $settings = array(
    'site' => array(
      'logo'        => wp_get_attachment_url( get_theme_mod( 'custom_logo' ) ),
      'title'       => get_bloginfo( 'name' ),
      'description' => get_bloginfo( 'description' ),
      'timezone'    => wp_timezone_string(),
      'host'        => $parse_url['host'],
    ),
    'header' => array(
      'show_lineup'  => get_theme_mod( 'joy_lineup', true ),
      'show_areas'   => get_theme_mod( 'joy_areas', true ),
      'show_info'    => get_theme_mod( 'joy_info', true ),
      'show_gallery' => get_theme_mod( 'joy_gallery', true ),
      'show_digital' => get_theme_mod( 'joy_digital', true ),
      'shop'         => get_theme_mod( 'joy_shop', true ),
      'youtube'      => get_theme_mod( 'joy_youtube', true ),
      'instagram'    => get_theme_mod( 'joy_instagram', true ),
      'spotify'      => get_theme_mod( 'joy_spotify', true ),
      'plainsong'    => get_theme_mod( 'joy_plainsong', true ),
      'ticket'       => get_theme_mod( 'joy_ticket', true ),
    ),
    'rest' => array(
      'base'  => $base_url,
      'wp'    => '/wp/v2',
      'theme' => joy_rest_namespace(),
    ),
    'lineup' => array(
      'full'     => get_field( 'full_lineup', 'joy_lineup' ),
      'past'     => get_field( 'past_lineup', 'joy_lineup' ),
      'schedule' => get_field( 'schedule', 'joy_lineup' ),
    ),
    'footer' => array(
      'menu'      => $footer_menu ? $footer_menu : [],
      'sponsors'  => get_field( 'sponsors', 'joy_footer' ),
      'subscribe' => get_field( 'subscribe', 'joy_footer' ),
      'copyright' => get_field( 'copyright', 'joy_footer' ),
    ),
  );
  $settings = apply_filters( 'joy_app_settings', $settings );
  return $settings;
}

include_once( 'rest-api/page-endpoints.php' );
include_once( 'rest-api/home.php' );
include_once( 'rest-api/about.php' );
include_once( 'rest-api/pages.php' );
include_once( 'rest-api/lineups.php' );
include_once( 'rest-api/galleries.php' );
include_once( 'rest-api/areas.php' );
include_once( 'rest-api/mailchimp.php' );
include_once( 'rest-api/digital.php' );
include_once( 'rest-api/info.php' );
