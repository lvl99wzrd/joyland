<?php
function joy_get_template_page_id( $template ) {
  $page_id = null;

  $pages = get_posts(
    array(
      'post_type'      => 'page',
      'posts_per_page' => 1,
      'fields'         => 'ids',
      'meta_key'       => '_wp_page_template',
      'meta_value'     => $template
    )
  );

  if ( $pages ) {
    $page_id = $pages[0];
  }

  return $page_id;
}

add_filter( 'theme_page_templates', 'joy_theme_page_templates', 10, 3 );
function joy_theme_page_templates( $templates, $theme, $post ) {
  // Add about page template
  $templates['about'] = __( "About Page", 'joy' );

  // Limit about page template for 1 page only
  $about_page_id = joy_get_template_page_id( 'about' );
  if ( $about_page_id && ! empty( $post ) && ( $about_page_id != $post->ID ) ) {
    unset( $templates['about'] );
  }
  
  return $templates;
}
