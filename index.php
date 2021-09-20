<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <meta name="description" content="<?php esc_attr_e( get_bloginfo( 'description' ) ); ?>">
  <link rel="shortcut icon" href="<?php echo get_site_icon_url(); ?>" type="image/x-icon" />
  <title><?php wp_title( ' - ', true, 'right'); ?></title>
  <base href="<?php bloginfo( 'stylesheet_directory' ); ?>" />
  <?php wp_head(); ?>
</head>
<body>
  <noscript>
    <strong>
      <?php
      printf(
        __( "We're sorry but %s doesn't work properly without JavaScript enabled. Please enable it to continue.", 'mfb' ),
        get_bloginfo( 'name' )
      );
      ?>
    </strong>
  </noscript>
  <div id="app"></div>
  <?php wp_footer(); ?>
</body>
</html>
