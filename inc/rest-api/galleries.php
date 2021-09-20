<?php
add_filter( 'rest_prepare_gallery', 'joy_rest_prepare_gallery', 10, 3 );
function joy_rest_prepare_gallery( $response, $post, $request ) {
  if ( $request->get_param( 'app' ) ) {
    $response = joy_get_gallery_data( $post );
  }
  return $response;
}

/**
 * Get gallery data
 */
function joy_get_gallery_data( $post = false ) {
  // If no post, bail
  if ( ! $post )
    return false;

  $gallery = get_field( 'gallery', $post->ID );

  $thumbnail = false;
  if ( has_post_thumbnail( $post ) ) {
    $thumbnail = get_the_post_thumbnail_url( $post, 'full' );
  } else if ( $gallery ) {
    $thumbnail = $gallery[0]['url'];
  }

  // Build response
  $gallery = array(
    'id'          => $post->ID,
    'title'       => html_entity_decode( $post->post_title ),
    'slug'        => $post->post_name,
    'gallery'     => $gallery,
    'description' => get_field( 'description', $post->ID ),
    'date'        => get_field( 'date', $post->ID ),
    'venue'       => get_field( 'venue', $post->ID ),
    'thumbnail'   => $thumbnail,
  );

  return $gallery;
}
