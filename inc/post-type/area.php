<?php
/**
 * Register area post type
 */
add_action( 'init', 'joy_register_area' );
function joy_register_area() {
	$args = array(
		'labels' => array(
			'name'                  => __( 'Areas', 'joy' ),
			'singular_name'         => __( 'Area', 'joy' ),
			'add_new'               => __( 'Add New', 'joy' ),
			'add_new_item'          => __( 'Add New Area', 'joy' ),
			'edit_item'             => __( 'Edit Area', 'joy' ),
			'new_item'              => __( 'New Area', 'joy' ),
			'view_item'             => __( 'View Area', 'joy' ),
			'view_items'            => __( 'View Areas', 'joy' ),
			'search_items'          => __( 'Search Areas', 'joy' ),
			'not_found'             => __( 'No area found', 'joy' ),
			'not_found_in_trash'    => __( 'No area found in Trash', 'joy' ),
			'all_items'             => __( 'Areas', 'joy' ),
			'archive'               => __( 'Area Archives', 'joy' ),
			'attributes'            => __( 'Area Attributes', 'joy' ),
			'insert_into_item'      => __( 'Insert into area', 'joy' ),
			'uploaded_to_this_item' => __( 'Uploaded to this area', 'joy' ),
			'not_found'             => __( 'No area found', 'joy' ),
			'featured_image'        => __( 'Area thumbnail', 'joy' ),
			'set_featured_image'    => __( 'Set area thumbnail', 'joy' ),
			'remove_featured_image' => __( 'Remove area thumbnail', 'joy' ),
			'use_featured_image'    => __( 'Use as area thumbnail', 'joy' ),
			'filter_items_list'     => __( 'Filter area list', 'joy' ),
			'items_list_navigation' => __( 'Areas list navigation', 'joy' ),
			'items_list'            => __( 'Areas list' ),
    ),
    'menu_position' => 7,
    'menu_icon'     => 'dashicons-location-alt',
    'public'        => true,
    'has_archive'   => true,
    'show_in_rest'  => true,
    'rest_base'     => 'areas',
    'map_meta_cap'  => true,
    'supports'      => ['title', 'thumbnail'],
    'rewrite'       => ['slug' => 'area']
	);
  register_post_type( 'area', $args );
}

/**
 * Updated Messages
 */
add_filter( 'post_updated_messages', 'joy_area_updated_messages' );
function joy_area_updated_messages( $messages ) {
	global $post, $post_ID;
	$messages['area'] = array(
		0 => '', // Unused. Messages start at index 1.
		1 => sprintf( __( 'Area updated. <a href="%s">View Area</a>', 'joy' ), esc_url( get_permalink( $post_ID ) ) ),
		2 => __( 'Area updated.', 'joy' ),
		3 => __( 'Area deleted.', 'joy' ),
		4 => __( 'Area updated.', 'joy' ),
		/* translators: %s: date and time of the revision */
		5 => isset($_GET['revision']) ? sprintf( __( 'Area restored to revision from %s', 'joy' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( __( 'Area published. <a href="%s">View Area</a>', 'joy' ), esc_url( get_permalink( $post_ID ) ) ),
		7 => __('Area saved.', 'joy'),
		8 => sprintf( __( 'Area submitted. <a target="_blank" href="%s">Preview Area</a>', 'joy'), esc_url( add_query_arg( 'preview', 'true', get_permalink( $post_ID ) ) ) ),
		9 => sprintf( __( 'Area scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Area</a>', 'joy' ),
		// translators: Publish box date format, see http://php.net/date
		date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink( $post_ID ) ) ),
		10 => sprintf( __( 'Area draft updated. <a target="_blank" href="%s">Preview Area</a>', 'joy' ), esc_url( add_query_arg( 'preview', 'true', get_permalink( $post_ID ) ) ) ),
	);
	return $messages;
}

/**
 * Add custom columns
 */
add_filter( 'manage_area_posts_columns', 'joy_area_posts_columns', 10, 1 );
function joy_area_posts_columns( $columns ) {
  $date = $columns['date'];
  unset( $columns['date'] );
  $columns['lineup_count'] = __( "Line-Ups", 'joy' );
  $columns['date'] = $date;
  return $columns;
}

add_action( 'manage_area_posts_custom_column', 'joy_area_posts_custom_column', 10, 2 );
function joy_area_posts_custom_column( $column, $post_id ) {
  if ( $column === 'lineup_count' ) {
    $lineups = get_field( 'lineups', $post_id );
    echo $lineups ? count( $lineups ) : 0;
  }
}
