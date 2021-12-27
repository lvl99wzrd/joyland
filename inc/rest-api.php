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
  $settings = array(
    'site' => array(
      'title'       => get_bloginfo( 'name' ),
      'description' => get_bloginfo( 'description' ),
      'timezone'    => wp_timezone_string(),
      'host'        => $parse_url['host'],
    ),
    'header' => array(
      'shop'      => get_theme_mod( 'joy_shop', true ),
      'youtube'   => get_theme_mod( 'joy_youtube', true ),
      'instagram' => get_theme_mod( 'joy_instagram', true ),
      'spotify'   => get_theme_mod( 'joy_spotify', true ),
      'plainsong' => get_theme_mod( 'joy_plainsong', true ),
      'ticket'    => get_theme_mod( 'joy_ticket', true ),
    ),
    'rest' => array(
      'base'  => $base_url,
      'wp'    => '/wp/v2',
      'theme' => joy_rest_namespace(),
    ),
    'footer' => array(
      'sponsors'  => get_field( 'sponsors', 'joy_footer' ),
      'subscribe' => get_field( 'subscribe', 'joy_footer' ),
      'copyright' => get_field( 'copyright', 'joy_footer' ),
    ),
  );
  $settings = apply_filters( 'joy_app_settings', $settings );
  return $settings;
}

include_once( 'rest-api/page-endpoints.php' );
include_once( 'rest-api/home-page.php' );
include_once( 'rest-api/about-page.php' );
include_once( 'rest-api/pages.php' );
include_once( 'rest-api/lineups.php' );
include_once( 'rest-api/galleries.php' );
include_once( 'rest-api/areas.php' );
include_once( 'rest-api/mailchimp.php' );
include_once( 'rest-api/digital.php' );
include_once( 'rest-api/info.php' );
