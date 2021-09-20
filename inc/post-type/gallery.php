<?php
/**
 * Register gallery post type
 */
add_action( 'init', 'joy_register_gallery' );
function joy_register_gallery() {
	$args = array(
		'labels' => array(
			'name'                  => __( 'Galleries', 'joy' ),
			'singular_name'         => __( 'Gallery', 'joy' ),
			'add_new'               => __( 'Add New', 'joy' ),
			'add_new_item'          => __( 'Add New Gallery', 'joy' ),
			'edit_item'             => __( 'Edit Gallery', 'joy' ),
			'new_item'              => __( 'New Gallery', 'joy' ),
			'view_item'             => __( 'View Gallery', 'joy' ),
			'view_items'            => __( 'View Galleries', 'joy' ),
			'search_items'          => __( 'Search Galleries', 'joy' ),
			'not_found'             => __( 'No gallery found', 'joy' ),
			'not_found_in_trash'    => __( 'No gallery found in Trash', 'joy' ),
			'all_items'             => __( 'Galleries', 'joy' ),
			'archive'               => __( 'Gallery Archives', 'joy' ),
			'attributes'            => __( 'Gallery Attributes', 'joy' ),
			'insert_into_item'      => __( 'Insert into gallery', 'joy' ),
			'uploaded_to_this_item' => __( 'Uploaded to this gallery', 'joy' ),
			'not_found'             => __( 'No gallery found', 'joy' ),
			'featured_image'        => __( 'Gallery thumbnail', 'joy' ),
			'set_featured_image'    => __( 'Set gallery thumbnail', 'joy' ),
			'remove_featured_image' => __( 'Remove gallery thumbnail', 'joy' ),
			'use_featured_image'    => __( 'Use as gallery thumbnail', 'joy' ),
			'filter_items_list'     => __( 'Filter gallery list', 'joy' ),
			'items_list_navigation' => __( 'Galleries list navigation', 'joy' ),
			'items_list'            => __( 'Galleries list' ),
    ),
    'menu_position' => 8,
    'menu_icon'     => 'dashicons-format-gallery',
    'public'        => true,
    'has_archive'   => true,
    'show_in_rest'  => true,
    'rest_base'     => 'galleries',
    'map_meta_cap'  => true,
    'supports'      => ['title', 'thumbnail'],
    'rewrite'       => ['slug' => 'gallery']
	);
  register_post_type( 'gallery', $args );
}

/**
 * Updated Messages
 */
add_filter( 'post_updated_messages', 'joy_gallery_updated_messages' );
function joy_gallery_updated_messages( $messages ) {
	global $post, $post_ID;
	$messages['gallery'] = array(
		0 => '', // Unused. Messages start at index 1.
		1 => sprintf( __( 'Gallery updated. <a href="%s">View Gallery</a>', 'joy' ), esc_url( get_permalink( $post_ID ) ) ),
		2 => __( 'Gallery updated.', 'joy' ),
		3 => __( 'Gallery deleted.', 'joy' ),
		4 => __( 'Gallery updated.', 'joy' ),
		/* translators: %s: date and time of the revision */
		5 => isset($_GET['revision']) ? sprintf( __( 'Gallery restored to revision from %s', 'joy' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( __( 'Gallery published. <a href="%s">View Gallery</a>', 'joy' ), esc_url( get_permalink( $post_ID ) ) ),
		7 => __('Gallery saved.', 'joy'),
		8 => sprintf( __( 'Gallery submitted. <a target="_blank" href="%s">Preview Gallery</a>', 'joy'), esc_url( add_query_arg( 'preview', 'true', get_permalink( $post_ID ) ) ) ),
		9 => sprintf( __( 'Gallery scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Gallery</a>', 'joy' ),
		// translators: Publish box date format, see http://php.net/date
		date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink( $post_ID ) ) ),
		10 => sprintf( __( 'Gallery draft updated. <a target="_blank" href="%s">Preview Gallery</a>', 'joy' ), esc_url( add_query_arg( 'preview', 'true', get_permalink( $post_ID ) ) ) ),
	);
	return $messages;
}

/**
 * Add custom columns
 */
add_filter( 'manage_gallery_posts_columns', 'joy_gallery_posts_columns', 10, 1 );
function joy_gallery_posts_columns( $columns ) {
  $date = $columns['date'];
  unset( $columns['date'] );
  $columns['images'] = __( "Images", 'joy' );
  $columns['date'] = $date;
  return $columns;
}

add_action( 'manage_gallery_posts_custom_column', 'joy_gallery_posts_custom_column', 10, 2 );
function joy_gallery_posts_custom_column( $column, $post_id ) {
  if ( $column === 'images' ) {
    $gallery = get_field( 'gallery', $post_id );
    if ( $gallery ) {
      $three = array_slice( $gallery, 0, 3 );
      foreach ( $three as $image ) {
        $thumbnail = $image['sizes']['thumbnail'];
        echo "<img src=\"{$thumbnail}\" width=\"50\">&nbsp;";
      }

      if ( count( $gallery ) > 3 ) {
        $more = count( $gallery ) - 3;
        echo "<span>+ {$more} more</span>";
      }
    } else {
      echo "No image";
    }
  }
}
