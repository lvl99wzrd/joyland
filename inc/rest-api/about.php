<?php
/**
 * Register custom rest API route
 */
add_action( 'rest_api_init', 'joy_register_about_page_routes' );
function joy_register_about_page_routes() {
	$namespace = joy_rest_namespace();
  register_rest_route(
		$namespace,
		'/about-page',
		array(
			'methods'  => 'GET',
      'callback' => 'joy_get_about_page',
      'permission_callback' => '__return_true',
		)
	);
}

function joy_get_about_page( WP_REST_Request $requests ) {
  $page_id = joy_get_template_page_id( 'about' );
  $post    = get_post( $page_id );

  $about_page = array(
    'id'      => $post->ID,
    'slug'    => $post->post_name,
    'title'   => html_entity_decode( $post->post_title ),
    'content' => apply_filters( 'the_content', $post->post_content ),
  );

  return $about_page;
}
