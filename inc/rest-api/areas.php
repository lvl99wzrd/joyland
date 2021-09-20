<?php
add_filter( 'rest_prepare_area', 'joy_rest_prepare_area', 10, 3 );
function joy_rest_prepare_area( $response, $post, $request ) {
  if ( $request->get_param( 'app' ) ) {
    $include_lineups = $request->get_param( 'include_lineups' );
    $include_lineups = $include_lineups ?: false;
    $response = joy_prepare_area_data( $post, $include_lineups );
  }
  return $response;
}

add_filter( 'rest_area_query', 'joy_rest_area_query', 10, 2 );
function joy_rest_area_query( $args, $request ) {
  if ( $request->get_param( 'app' ) ) {
    $args['orderby'] = 'menu_order';
    $args['order'] = 'ASC';
  }
  return $args;
}

function joy_prepare_area_data( $post, $include_lineups = false ) {
  $response = array(
    'id'          => $post->ID,
    'name'        => html_entity_decode( $post->post_title ),
    'slug'        => $post->post_name,
    'description' => get_field( 'description', $post->ID ),
    'complete'    => get_field( 'lineups_complete', $post->ID ),
    'thumbnail'   => get_the_post_thumbnail_url( $post->ID, 'full' ),
    'gallery'     => get_field( 'gallery', $post->ID ),
  );

  if ( $include_lineups ) {
    $lineup_ids = get_field( 'lineups', $post->ID );
    $lineups    = array();
    if ( $lineup_ids ) {
      foreach ( $lineup_ids as $post_id ) {
        $lineups[] = joy_get_lineup_data( $post_id );
      }
    }
    $response['lineups'] = $lineups;
  }
  return $response;
}
