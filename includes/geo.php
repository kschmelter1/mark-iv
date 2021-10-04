<?php

/*******************************************************
 * Store Lat / Lng for location posts on save / update *
 *******************************************************/

// Takes address array and formats into a single string for geocoding
function create_geocode_address( $loc_data ) {

    $address       = array();
    $address_parts = array( 'street', 'city', 'state', 'zip');

    foreach ( $address_parts as $address_part ) {
        if ( isset( $loc_data[$address_part] ) && $loc_data[$address_part] ) {
            $address[] = trim( $loc_data[$address_part] );
        }
    }

    $geocode_address = implode( ',', $address );

    return $geocode_address;
}

// Takes address string and calls geocode API. Returns lat lng array
function call_geocode_api( $address ) {
    $api = get_field('gmap_api', 'options');
    $url      = 'https://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode( $address ) . '&key='.$api;
    $response = wp_remote_get( $url );

    $responseArray = json_decode( $response['body'], true );
    $latlng = $responseArray['results'][0]['geometry']['location'];
    return $latlng;
}

// On post save, geocode address and update coordinates
function my_acf_save_post( $post_id ) {
  $postAddress = get_field('address', $post_id);
  if (!$postAddress) {
    return;
  }

  $formattedAddress = create_geocode_address( $postAddress );
  $geo = call_geocode_api($formattedAddress);

  if (!$geo) {
    return;
  }

  update_field('geo_lat', $geo['lat'], $post_id);
  update_field('geo_lng', $geo['lng'], $post_id);
}
// Priority > 10 hits after acf fields are updated, priority < 10 hits before
add_action('acf/save_post', 'my_acf_save_post', 15);

?>
