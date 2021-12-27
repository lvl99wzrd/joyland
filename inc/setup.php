<?php
/**
 * Define global variables
 */
if ( !defined( 'THEME_VERSION' ) ) {
	$theme = wp_get_theme();
	define( 'THEME_VERSION', $theme->get( 'Version' ) );
}

/**
 * After setup theme
 */
add_action( 'after_setup_theme', 'joy_after_setup' );
function joy_after_setup() {
  /**
   * Add theme support
   */
  add_theme_support( 'post-thumbnails' );

	/**
   * Remove unused wp_head
   */
	remove_action( 'wp_head', 'wp_generator' );
	remove_action( 'wp_head', 'rsd_link' );
	remove_action( 'wp_head', 'wlwmanifest_link' );
	remove_action( 'wp_head', 'start_post_rel_link' );
	remove_action( 'wp_head', 'index_rel_link' );
	remove_action( 'wp_head', 'adjacent_posts_rel_link' );

	remove_image_size( 'medium_large' );
	remove_image_size( '1536x1536' );
  remove_image_size( '2048x2048' );

	/**
   * Hide Admin Bar
   */
	if ( ( !current_user_can( 'edit_posts' ) && !is_admin() ) || wp_is_mobile() ) {
		show_admin_bar( false );
	}
}

/**
 * Disable image sizes
 */
add_filter( 'intermediate_image_sizes_advanced', 'joy_disable_image_sizes' );
function joy_disable_image_sizes( $sizes ) {
	unset( $sizes['medium_large'] ); // disable 768px size images
	unset( $sizes['1536x1536'] ); // disable 2x medium-large size
	unset( $sizes['2048x2048'] ); // disable 2x large size
	return $sizes;
}

/**
 * Remove unused image size
 */
add_filter( 'intermediate_image_sizes', function( $sizes ) {
  return array_filter( $sizes, function( $val ) {
    $excludes = ['medium_large', '1536x1536', '2048x2048'];
    return !in_array( $val, $excludes ); // Filter out 'medium_large'
  } );
} );

/**
 * Remove all default WP template redirects/lookups
 */
remove_action( 'template_redirect', 'redirect_canonical' );

/**
 * Redirect all requests to index.php
 * so the Vue app is loaded and 404s aren't thrown
 */
add_action( 'init', 'joy_remove_redirects' );
function joy_remove_redirects() {
	add_rewrite_rule( '^/(.+)/?', 'index.php', 'top' );
}

/**
 * Filter WP title
 */
add_filter( 'wp_title', 'joy_wp_title', 100, 3 );
function joy_wp_title( $title, $sep, $seplocation ) {
	$sitename = get_bloginfo( 'name' );
	if ( is_home() || is_front_page() ) {
		$title = $sitename;
	} else {
		if ( empty( $title ) ) {
			$title = $sitename;
		} else {
			$title = ( $seplocation === 'right' ? $title.$sitename : $sitename.$title );
		}
	}
	return $title;
}

/**
 * Add ACF option sub page for footer settings
 */
add_action( 'init', 'joy_acf_init' );
function joy_acf_init() {
  if ( function_exists( 'acf_add_options_sub_page' ) ) {
    acf_add_options_sub_page(
      array(
        'page_title'      => __( "Site Footer", 'joy' ),
        'menu_title'      => __( "Site Footer", 'joy' ),
        'menu_slug'       => 'joy_footer',
        'capability'      => 'edit_others_posts',
        'post_id'         => 'joy_footer',
        'autoload'        => true,
        'update_button'   => __( "Save Settings", 'joy' ),
        'updated_message' => __( "Footer settings updated", 'joy' ),
        'parent_slug'     => 'options-general.php',
      )
    );
  }
}

/**
 * Hide default posts
 */
add_action( 'admin_menu', 'joy_remove_default_post_type' );
function joy_remove_default_post_type() {
  remove_menu_page( 'edit.php' );
}

add_action( 'admin_bar_menu', 'joy_remove_default_post_type_menu_bar', 999 );
function joy_remove_default_post_type_menu_bar( $wp_admin_bar ) {
  $wp_admin_bar->remove_node( 'new-post' );
}

add_action( 'admin_footer', 'remove_add_new_post_href_in_admin_bar' );
function remove_add_new_post_href_in_admin_bar() {
  ?>
  <script type="text/javascript">
    function remove_add_new_post_href_in_admin_bar() {
      var add_new = document.getElementById('wp-admin-bar-new-content');
      if (!add_new) return;
      var add_new_a = add_new.getElementsByTagName('a')[0];
      if (add_new_a) add_new_a.setAttribute('href','#!');
    }
    remove_add_new_post_href_in_admin_bar();
  </script>
  <?php
}

add_action( 'init', 'remove_frontend_post_href' );
function remove_frontend_post_href(){
  if ( is_user_logged_in() ) {
    add_action( 'wp_footer', 'remove_add_new_post_href_in_admin_bar' );
  }
}

add_action( 'wp_dashboard_setup', 'remove_draft_widget', 999 );
function remove_draft_widget(){
  remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
}
