<?php
add_action( 'customize_register', 'joy_customizer_settings', 50 );
function joy_customizer_settings( $wp_customize ) {
	// Social media links
	$wp_customize->add_section(
		'joy_header',
		array(
      'title' => 'Header Links',
      'priority' => 110,
		)
  );
  
  $wp_customize->add_setting(
    'joy_shop',
    array(
      'default' => '',
      'transport' => 'refresh',
    )
  );
  $wp_customize->add_control(
    'joy_shop',
    array(
      'type' => 'text',
      'section' => 'joy_header',
      'label' => __( "Shop", 'joy' ),
    )
  );
  
  $wp_customize->add_setting(
    'joy_youtube',
    array(
      'default' => '',
      'transport' => 'refresh',
    )
  );
  $wp_customize->add_control(
    'joy_youtube',
    array(
      'type' => 'text',
      'section' => 'joy_header',
      'label' => __( "YouTube", 'joy' ),
    )
  );
  
  $wp_customize->add_setting(
    'joy_instagram',
    array(
      'default' => '',
      'transport' => 'refresh',
    )
  );
  $wp_customize->add_control(
    'joy_instagram',
    array(
      'type' => 'text',
      'section' => 'joy_header',
      'label' => __( "Instagram", 'joy' ),
    )
  );
  
  $wp_customize->add_setting(
    'joy_spotify',
    array(
      'default' => '',
      'transport' => 'refresh',
    )
  );
  $wp_customize->add_control(
    'joy_spotify',
    array(
      'type' => 'text',
      'section' => 'joy_header',
      'label' => __( "Spotify", 'joy' ),
    )
  );
  
  $wp_customize->add_setting(
    'joy_plainsong',
    array(
      'default' => '',
      'transport' => 'refresh',
    )
  );
  $wp_customize->add_control(
    'joy_plainsong',
    array(
      'type' => 'text',
      'section' => 'joy_header',
      'label' => __( "Plainsong", 'joy' ),
    )
  );
  
  $wp_customize->add_setting(
    'joy_ticket',
    array(
      'default' => '',
      'transport' => 'refresh',
    )
  );
  $wp_customize->add_control(
    'joy_ticket',
    array(
      'type' => 'text',
      'section' => 'joy_header',
      'label' => __( "Ticket", 'joy' ),
    )
  );

  $wp_customize->remove_panel( 'nav_menus' );
}

function joy_sanitize_checkbox( $checked ) {
  // Boolean check.
  return ( ( isset( $checked ) && true == $checked ) ? true : false );
}
