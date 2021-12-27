<?php
/**
 * Register lineup post type
 */
add_action( 'init', 'joy_register_lineup' );
function joy_register_lineup() {
	$args = array(
		'labels' => array(
			'name'                  => __( 'Line Ups', 'joy' ),
			'singular_name'         => __( 'Line Up', 'joy' ),
			'add_new'               => __( 'Add New', 'joy' ),
			'add_new_item'          => __( 'Add New Line Up', 'joy' ),
			'edit_item'             => __( 'Edit Line Up', 'joy' ),
			'new_item'              => __( 'New Line Up', 'joy' ),
			'view_item'             => __( 'View Line Up', 'joy' ),
			'view_items'            => __( 'View Line Ups', 'joy' ),
			'search_items'          => __( 'Search Line Ups', 'joy' ),
			'not_found'             => __( 'No line up found', 'joy' ),
			'not_found_in_trash'    => __( 'No line up found in Trash', 'joy' ),
			'all_items'             => __( 'Line Ups', 'joy' ),
			'archive'               => __( 'Line Up Archives', 'joy' ),
			'attributes'            => __( 'Line Up Attributes', 'joy' ),
			'insert_into_item'      => __( 'Insert into line up', 'joy' ),
			'uploaded_to_this_item' => __( 'Uploaded to this line up', 'joy' ),
			'not_found'             => __( 'No line up found', 'joy' ),
			'featured_image'        => __( 'Line Up thumbnail', 'joy' ),
			'set_featured_image'    => __( 'Set line up thumbnail', 'joy' ),
			'remove_featured_image' => __( 'Remove line up thumbnail', 'joy' ),
			'use_featured_image'    => __( 'Use as line up thumbnail', 'joy' ),
			'filter_items_list'     => __( 'Filter line up list', 'joy' ),
			'items_list_navigation' => __( 'Line Ups list navigation', 'joy' ),
			'items_list'            => __( 'Line Ups list' ),
    ),
    'menu_position' => 6,
    'menu_icon'     => 'dashicons-groups',
    'public'        => true,
    'has_archive'   => true,
    'show_in_rest'  => true,
    'map_meta_cap'  => true,
    'supports'      => ['title', 'thumbnail', 'editor'],
    'rewrite'       => ['slug' => 'lineup']
	);
  register_post_type( 'lineup', $args );

  // // Add new taxonomy, NOT hierarchical (like tags)
  // $labels = array(
  //   'name'                       => _x( 'Areas', 'taxonomy general name', 'textdomain' ),
  //   'singular_name'              => _x( 'Area', 'taxonomy singular name', 'textdomain' ),
  //   'search_items'               => __( 'Search Areas', 'textdomain' ),
  //   'popular_items'              => __( 'Popular Areas', 'textdomain' ),
  //   'all_items'                  => __( 'All Areas', 'textdomain' ),
  //   'parent_item'                => null,
  //   'parent_item_colon'          => null,
  //   'edit_item'                  => __( 'Edit Area', 'textdomain' ),
  //   'update_item'                => __( 'Update Area', 'textdomain' ),
  //   'add_new_item'               => __( 'Add New Area', 'textdomain' ),
  //   'new_item_name'              => __( 'New Area Name', 'textdomain' ),
  //   'separate_items_with_commas' => __( 'Separate areas with commas', 'textdomain' ),
  //   'add_or_remove_items'        => __( 'Add or remove areas', 'textdomain' ),
  //   'choose_from_most_used'      => __( 'Choose from the most used areas', 'textdomain' ),
  //   'not_found'                  => __( 'No areas found.', 'textdomain' ),
  //   'menu_name'                  => __( 'Areas', 'textdomain' ),
  // );

  // $args = array(
  //   'hierarchical'          => false,
  //   'labels'                => $labels,
  //   'show_ui'               => true,
  //   'show_in_quick_edit'    => false,
  //   'meta_box_cb'           => false,
  //   'show_admin_column'     => true,
  //   'show_in_rest'          => true,
  //   'rest_base'             => 'areas',
  //   'update_count_callback' => '_update_post_term_count',
  //   'query_var'             => true,
  //   'rewrite'               => array( 'slug' => 'area' ),
  // );

  // register_taxonomy( 'area', 'lineup', $args );
}

/**
 * Updated Messages
 */
add_filter( 'post_updated_messages', 'joy_lineup_updated_messages' );
function joy_lineup_updated_messages( $messages ) {
	global $post, $post_ID;
	$messages['lineup'] = array(
		0 => '', // Unused. Messages start at index 1.
		1 => sprintf( __( 'Line Up updated. <a href="%s">View Line Up</a>', 'joy' ), esc_url( get_permalink( $post_ID ) ) ),
		2 => __( 'Line Up updated.', 'joy' ),
		3 => __( 'Line Up deleted.', 'joy' ),
		4 => __( 'Line Up updated.', 'joy' ),
		/* translators: %s: date and time of the revision */
		5 => isset($_GET['revision']) ? sprintf( __( 'Line Up restored to revision from %s', 'joy' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( __( 'Line Up published. <a href="%s">View Line Up</a>', 'joy' ), esc_url( get_permalink( $post_ID ) ) ),
		7 => __('Line Up saved.', 'joy'),
		8 => sprintf( __( 'Line Up submitted. <a target="_blank" href="%s">Preview Line Up</a>', 'joy'), esc_url( add_query_arg( 'preview', 'true', get_permalink( $post_ID ) ) ) ),
		9 => sprintf( __( 'Line Up scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Line Up</a>', 'joy' ),
		// translators: Publish box date format, see http://php.net/date
		date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink( $post_ID ) ) ),
		10 => sprintf( __( 'Line Up draft updated. <a target="_blank" href="%s">Preview Line Up</a>', 'joy' ), esc_url( add_query_arg( 'preview', 'true', get_permalink( $post_ID ) ) ) ),
	);
	return $messages;
}

/**
 * Add custom columns
 */
add_filter( 'manage_lineup_posts_columns', 'joy_lineup_posts_columns', 10, 1 );
function joy_lineup_posts_columns( $columns ) {
  $date = $columns['date'];
  unset( $columns['date'] );
  $columns['schedule'] = __( "Schedule", 'joy' );
  $columns['area'] = __( "Area", 'joy' );
  $columns['date'] = $date;
  return $columns;
}

add_action( 'manage_lineup_posts_custom_column', 'joy_lineup_posts_custom_column', 10, 2 );
function joy_lineup_posts_custom_column( $column, $post_id ) {
  if ( $column === 'schedule' ) {
    $schedule = get_field( 'schedule', $post_id );
    echo $schedule;
  } else if ( $column === 'area' ) {
    $areas = joy_lineup_get_area( $post_id );
    $can_edit = current_user_can( 'edit_post', $post_id );
    
    if ( $areas ) {
      foreach ( $areas as $i => $area ) {
        echo $i > 0 ? ', ' : '';
        if ( $can_edit ) {
          echo '<a href="' . get_edit_post_link( $post_id ) . '">' . html_entity_decode( $area->post_title ) . '</a>';
        } else {
          echo html_entity_decode( $area->post_title );
        }
      }
    }
  }
}

function joy_lineup_get_area( $post_id ) {
  $areas = get_posts( array(
    'post_type' => 'area',
    'meta_query' => array(
      'relation' => 'AND',
      array(
        'key' => 'lineups',
        'value' => '"' . $post_id . '"',
        'compare' => 'LIKE'
      ),
    ),
  ) );

  return $areas;
}

add_filter( 'manage_edit-lineup_sortable_columns', 'joy_lineup_sortable_columns', 10, 1 );
function joy_lineup_sortable_columns( $columns ) {
  $columns['schedule'] = 'schedule';
  return $columns;
}

add_action( 'pre_get_posts', 'joy_lineup_sortable_pre_get_posts', 10, 1 );
function joy_lineup_sortable_pre_get_posts( $query ) {
  if ( !is_admin() )
    return;

  $orderby = $query->get('orderby');
  if ( $orderby === 'schedule' ) {
    $query->set('meta_key', 'schedule');
    $query->set('meta_type', 'DATETIME');
    $query->set('orderby', 'meta_value');
  }
}

/**
 * Save lineups order
 */
// add_action( 'edit_area', 'joy_lineup_edit_area', 10, 2 );
// function joy_lineup_edit_area( $term_id, $tt_id ) {
//   if ( isset( $_POST['lineups_order'] ) ) {
//     update_term_meta( $term_id, 'lineups_order', $_POST['lineups_order'] );
//   }

//   $complete = isset( $_POST['lineups_complete'] ) ? $_POST['lineups_complete'] : 0;
//   update_term_meta( $term_id, 'lineups_complete', $complete );
// }
