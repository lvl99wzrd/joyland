<?php
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
  $frontpage = get_option( 'page_on_front' );

  // Get lineups
  $lineup_ids = get_field( 'lineups', $frontpage );
  $lineups = array();
  if ( $lineup_ids ) {
    foreach ( $lineup_ids as $post_id ) {
      $lineups[] = joy_get_lineup_data( $post_id );
    }
  }

  $homepage = array(
    'hero'     => get_field( 'hero', $frontpage ),
    'lineups'  => $lineups,
    'video'    => get_field( 'video', $frontpage ),
    'playlist' => get_field( 'playlist', $frontpage ),
  );

  return $homepage;
}
