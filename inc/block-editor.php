<?php
// Handpick core blocks
add_filter( 'allowed_block_types', 'crtr_allowed_block_types', 10, 2 );
function crtr_allowed_block_types( $allowed_blocks, $post ) {
  $common = array(
    'core/paragraph',
    'core/image',
    'core/heading',
    // 'core/gallery',
    'core/list',
    'core/quote',
    'core/audio',
    'core/cover',
    'core/file',
    'core/video',
  );

  $formatting = array(
    // 'core/table',
    // 'core/verse',
    'core/code',
    // 'core/freeform',
    'core/html',
    'core/preformatted',
    'core/pullquote',
  );

  $elements = array(
    'core/buttons',
    'core/columns',
    'core/media-text',
    // 'core/more',
    // 'core/nextpage',
    'core/separator',
    'core/spacer',
  );

  $widgets = array(
    'core/shortcode',
    // 'core/archives',
    // 'core/categories',
    // 'core/latest-comments',
    // 'core/latest-posts',
    // 'core/calendar',
    // 'core/rss',
    // 'core/search',
    // 'core/tag-cloud',
  );

  $embeds = array(
    'core/embed',
    'core-embed/twitter',
    'core-embed/youtube',
    'core-embed/facebook',
    'core-embed/instagram',
    // 'core-embed/wordpress',
    'core-embed/soundcloud',
    'core-embed/spotify',
    // 'core-embed/flickr',
    'core-embed/vimeo',
    // 'core-embed/animoto',
    // 'core-embed/cloudup',
    // 'core-embed/collegehumor',
    // 'core-embed/dailymotion',
    // 'core-embed/funnyordie',
    // 'core-embed/hulu',
    // 'core-embed/imgur',
    // 'core-embed/issuu',
    // 'core-embed/kickstarter',
    // 'core-embed/meetup-com',
    'core-embed/mixcloud',
    // 'core-embed/photobucket',
    // 'core-embed/polldaddy',
    'core-embed/reddit',
    // 'core-embed/reverbnation',
    // 'core-embed/screencast',
    // 'core-embed/scribd',
    // 'core-embed/slideshare',
    // 'core-embed/smugmug',
    // 'core-embed/speaker',
    // 'core-embed/ted',
    'core-embed/tumblr',
    // 'core-embed/videopress',
    // 'core-embed/wordpress-tv',
  );

  $acf = array(
    'acf/flash-content',
    // 'acf/hover-exposed',
    'acf/columns-hidden-content',
  );

  $allowed_blocks = array_merge( $common, $formatting, $elements, $widgets, $embeds, $acf );

  return $allowed_blocks;
}

/**
 * Templates and Page IDs without editor
 */
function joy_disable_editor( $id = false ) {
	$excluded_templates = array();
	$excluded_ids = array(
		get_option( 'page_on_front' )
	);

	if ( empty( $id ) )
		return false;

	$id = intval( $id );
	$template = get_page_template_slug( $id );

	return get_post_type( $id ) !== 'page' || in_array( $id, $excluded_ids ) || in_array( $template, $excluded_templates );
}

/**
 * Disable Gutenberg by template
 */
add_filter( 'gutenberg_can_edit_post_type', 'joy_disable_gutenberg', 10, 2 );
add_filter( 'use_block_editor_for_post_type', 'joy_disable_gutenberg', 10, 2 );
function joy_disable_gutenberg( $can_edit, $post_type ) {
	if ( ! ( is_admin() && !empty( $_GET['post'] ) ) )
		return $can_edit;

	if ( joy_disable_editor( $_GET['post'] ) )
		$can_edit = false;

	return $can_edit;
}

/**
 * Load block editor style
 */
add_action( 'after_setup_theme', 'joy_block_editor_setup' );
function joy_block_editor_setup() {
	add_theme_support( 'align-wide' );
	add_theme_support( 'editor-styles' );
	add_editor_style( 'assets/admin/css/block-editor.min.css' );
}

/**
 * Load block editor script
 */
add_action( 'enqueue_block_editor_assets', 'crtr_enqueue_block_editor_assets' );
function crtr_enqueue_block_editor_assets() {
  wp_enqueue_script( 'joy-block-editor-page-colors', get_theme_file_uri( '/assets/admin/js/block-editor.js' ), array( 'jquery' ), false, true );
}
