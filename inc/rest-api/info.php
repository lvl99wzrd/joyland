<?php
/**
 * Add ACF option page for info page settings
 */
add_action( 'init', 'joy_info_page_acf_settings' );
function joy_info_page_acf_settings() {
  if ( function_exists( 'acf_add_options_page' ) ) {
    acf_add_options_page(
      array(
        'page_title'      => __( "Info", 'joy' ),
        'menu_title'      => __( "Info", 'joy' ),
        'menu_slug'       => 'joy_info',
        'capability'      => 'manage_options',
        'post_id'         => 'joy_info',
        'autoload'        => true,
        'update_button'   => __( "Save Settings", 'joy' ),
        'updated_message' => __( "Info settings updated", 'joy' ),
        'position'        => 20,
        'icon_url'        => 'dashicons-info-outline',
      )
    );
  }
}

/**
 * Register custom rest API route
 */
add_action( 'rest_api_init', 'joy_register_info_page_routes' );
function joy_register_info_page_routes() {
	$namespace = joy_rest_namespace();
  register_rest_route(
		$namespace,
		'/info-page',
		array(
			'methods'  => 'GET',
      'callback' => 'joy_get_info_page',
      'permission_callback' => '__return_true',
		)
	);
}

function joy_get_info_page( WP_REST_Request $request ) {
  $sections = get_field( 'sections', 'joy_info' );
  return $sections;
}
