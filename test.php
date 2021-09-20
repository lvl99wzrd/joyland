<?php
// Template Name: Test

$post_id = 116;
$lineup_ids = get_field( 'lineups', 113 );

echo '<pre>';
print_r( $lineup_ids );
echo '</pre>';
