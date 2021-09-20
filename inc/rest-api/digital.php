<?php
/**
 * Add ACF option page for digital page settings
 */
add_action( 'init', 'joy_digital_page_acf_settings' );
function joy_digital_page_acf_settings() {
  if ( function_exists( 'acf_add_options_page' ) ) {
    acf_add_options_page(
      array(
        'page_title'      => __( "Digital", 'joy' ),
        'menu_title'      => __( "Digital", 'joy' ),
        'menu_slug'       => 'joy_digital',
        'capability'      => 'edit_others_posts',
        'post_id'         => 'joy_digital',
        'autoload'        => true,
        'update_button'   => __( "Save Settings", 'joy' ),
        'updated_message' => __( "Digital settings updated", 'joy' ),
        'position'        => 8,
        'icon_url'        => 'dashicons-laptop',
      )
    );
  }
}

/**
 * Register custom rest API route
 */
add_action( 'rest_api_init', 'joy_register_digital_page_routes' );
function joy_register_digital_page_routes() {
	$namespace = joy_rest_namespace();
  register_rest_route(
		$namespace,
		'/digital-page',
		array(
			'methods'  => 'GET',
      'callback' => 'joy_get_digital_page',
      'permission_callback' => '__return_true',
		)
	);
}

function joy_get_digital_page( WP_REST_Request $request ) {
  $items = get_field( 'items', 'joy_digital' );
  return $items;
}
