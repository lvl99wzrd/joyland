<?php
/**
 * Register custom rest API route
 */
add_action( 'rest_api_init', 'joy_register_mailchimp_routes' );
function joy_register_mailchimp_routes() {
	$namespace = joy_rest_namespace();
  register_rest_route(
		$namespace,
		'/mailchimp',
		array(
			'methods'  => 'POST',
      'callback' => 'joy_subscribe_mailchimp_audience',
      'permission_callback' => '__return_true',
		)
	);
}

function joy_subscribe_mailchimp_audience( $data ) {
  $email = $data['email'];

  // Validate email
  if (! filter_var( $email, FILTER_VALIDATE_EMAIL ) ) {
    return new WP_Error(
      'invalid_email_format',
      __( "Invalid email format")
    );
  }

  // Get mailchimp api key and list id
  $subscribe = get_field( 'subscribe', 'joy_footer' );
  $apiKey = $subscribe['mailchimp']['api_key'];
  $listId = $subscribe['mailchimp']['list_id'];

  $memberId = md5( strtolower( $data['email'] ) );
  $dataCenter = substr( $apiKey, strpos( $apiKey, '-' ) + 1 );
  $url = 'https://' . $dataCenter . '.api.mailchimp.com/3.0/lists/' . $listId . '/members/' . $memberId;

  $json = json_encode([
    'email_address' => $data['email'],
    'status' => 'subscribed', // "subscribed","unsubscribed","cleaned","pending"
  ]);

  $ch = curl_init($url);

  curl_setopt( $ch, CURLOPT_USERPWD, 'user:' . $apiKey );
  curl_setopt( $ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json'] );
  curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
  curl_setopt( $ch, CURLOPT_TIMEOUT, 10 );
  curl_setopt( $ch, CURLOPT_CUSTOMREQUEST, 'PUT' );
  curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
  curl_setopt( $ch, CURLOPT_POSTFIELDS, $json );                                                                                                                 

  $result = json_decode( curl_exec($ch) );
  // $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
  curl_close($ch);

  return $result;
}
