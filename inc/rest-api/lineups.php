<?php
add_filter( 'rest_prepare_lineup', 'joy_rest_prepare_lineup', 10, 3 );
function joy_rest_prepare_lineup( $response, $post, $request ) {
  if ( $request->get_param( 'app' ) ) {
    $response = joy_get_lineup_data( $post );
  }
  return $response;
}

/**
 * Get lineup data
 */
function joy_get_lineup_data( $post = 0 ) {
  // If no post, bail
  if ( ! $post )
    return false;

  // If post is not array nor object, get the post
  if ( ! is_array( $post ) || ! is_object( $post ) )
    $post = get_post( $post );

  // Get area
  $areas = joy_lineup_get_area( $post->ID );
  $area = false;
  if ( $areas ) {
    $_area = $areas[0];
    $area = array(
      'id'   => $_area->ID,
      'name' => html_entity_decode( $_area->post_title ),
      'slug' => $_area->post_name,
    );
  }

  // Get schedule
  $schedule = get_field( 'schedule', $post->ID );

  // Build response
  $lineup = array(
    'id'       => $post->ID,
    'name'     => html_entity_decode( $post->post_title ),
    'slug'     => $post->post_name,
    'content'  => apply_filters( 'the_content', $post->post_content ),
    'photo'    => get_the_post_thumbnail_url( $post->ID, 'full' ),
    'area'     => $area,
    'playlist' => get_field( 'playlist', $post->ID ),
    'schedule' => array(
      'date'     => date( 'c', strtotime( $schedule ) ),
      'date_gmt' => get_gmt_from_date( $schedule, 'c' ),
    ),
  );

  return $lineup;
}
