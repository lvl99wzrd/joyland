<?php
add_action( 'init', 'joy_register_page_endpoints' );
function joy_register_page_endpoints() {
  add_rewrite_endpoint( 'digital', EP_PAGES );
  add_rewrite_endpoint( 'info', EP_PAGES );
}
