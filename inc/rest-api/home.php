<?php
/**
 * Add ACF option page for home page settings
 */
add_action( 'init', 'joy_home_page_acf_settings' );
function joy_home_page_acf_settings() {
  if ( function_exists( 'acf_add_options_page' ) ) {
    acf_add_options_page(
      array(
        'page_title'      => __( "Home Page", 'joy' ),
        'menu_title'      => __( "Home", 'joy' ),
        'menu_slug'       => 'joy_home',
        'capability'      => 'edit_others_posts',
        'post_id'         => 'joy_home',
        'autoload'        => true,
        'update_button'   => __( "Save Settings", 'joy' ),
        'updated_message' => __( "Home page settings updated", 'joy' ),
        'position'        => 4,
        'icon_url'        => 'dashicons-admin-home',
      )
    );
  }
}

/**
 * Register custom rest API route
 */
add_action( 'rest_api_init', 'joy_register_homepage_routes' );
function joy_register_homepage_routes() {
	$namespace = joy_rest_namespace();
  register_rest_route(
		$namespace,
		'/home-page',
		array(
			'methods'  => 'GET',
      'callback' => 'joy_get_homepage',
      'permission_callback' => '__return_true',
		)
	);
}

function joy_get_homepage( WP_REST_Request $requests ) {
  // Get lineups
  $lineup_ids = get_field( 'lineups', 'joy_home' );
  $lineups = array();
  if ( $lineup_ids ) {
    foreach ( $lineup_ids as $post_id ) {
      $lineups[] = joy_get_lineup_data( $post_id );
    }
  }

  $response = array(
    'hero'     => get_field( 'hero', 'joy_home' ),
    'lineups'  => $lineups,
    'video'    => get_field( 'video', 'joy_home' ),
    'playlist' => get_field( 'playlist', 'joy_home' ),
    'hide'     => array(
      'lineups'  => get_field( 'hide_lineups', 'joy_home' ),
      'video'    => get_field( 'hide_video', 'joy_home' ),
      'playlist' => get_field( 'hide_playlist', 'joy_home' ),
    ),
  );

  return $response;
}
