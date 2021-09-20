<?php
// Filter rest page
add_filter( 'rest_prepare_page', 'joy_rest_prepare_page', 10, 3 );
function joy_rest_prepare_page( $response, $post, $request ) {
  if ( ! is_admin() && $request->get_param( 'app' ) ) {
    $response = joy_rest_page_data( $post, $request->get_params() );
  }
  return $response;
}

// Set rest page data
function joy_rest_page_data( $post, $request = array() ) {
  $data = array(
    'id'         => $post->ID,
    'title'      => html_entity_decode( $post->post_title ),
    'slug'       => $post->post_name,
    'date'       => $post->post_date,
    'date_gmt'   => $post->post_date_gmt,
    'link'       => get_permalink( $post ),
    'content'    => apply_filters( 'the_content', $post->post_content ),
    'excerpt'    => $post->post_excerpt,
    'hide_title' => get_field( 'hide_title', $post ),
    'style' => array(
      'bg_color' => get_field( 'page_bg_color', $post->ID ),
      'color'    => get_field( 'page_color', $post->ID ),
    ),
  );

  return $data;
}
