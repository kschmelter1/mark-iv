<?php
/********************************
 * Loads jQuery from Google CDN *
 ********************************/
function use_jquery_from_google () {
	if (is_admin()) {
		return;
	}

	global $wp_scripts;
	if (isset($wp_scripts->registered['jquery']->ver)) {
		$ver = $wp_scripts->registered['jquery']->ver;
                $ver = str_replace("-wp", "", $ver);
	} else {
		$ver = '1.12.4';
	}

	wp_deregister_script('jquery');
	wp_register_script('jquery', "//ajax.googleapis.com/ajax/libs/jquery/$ver/jquery.min.js", false, $ver);
}
add_action('init', 'use_jquery_from_google');


/***************************
 * Master Enqueue Function *
 ***************************/
function compulse_enqueue_scripts() {
	$style_name = 'compulse';

	if( is_singular( 'location' ) ){
		wp_register_style('lightgallery', 'https://cdnjs.cloudflare.com/ajax/libs/lightgallery/1.6.11/css/lightgallery.css');
		wp_enqueue_style('lightgallery');
		wp_enqueue_script('lightgalleryjs', 'https://cdnjs.cloudflare.com/ajax/libs/lightgallery/1.6.11/js/lightgallery.min.js', array('jquery'), null, true );
		wp_enqueue_script('lightgalleryhash', 'https://cdnjs.cloudflare.com/ajax/libs/lg-hash/1.0.4/lg-hash.min.js', array('jquery'), null, true );

    wp_register_script( 'locationpage', get_template_directory_uri() . '/js/location.js', array('jquery'), null, true );
  	wp_enqueue_script('locationpage');
  }

	wp_register_style($style_name, get_stylesheet_directory_uri() . '/style.css');
	wp_enqueue_style($style_name);

	wp_enqueue_script('vendor', get_stylesheet_directory_uri() . '/js/vendor.js', array('jquery'), '', true);
	wp_enqueue_script('app', get_stylesheet_directory_uri() . '/js/app.js', array('jquery'), '', true);

	if (is_archive() && get_field('google_map')) {
		$api = get_field('gmap_api', 'options');
		$archive = get_queried_object_id();

		wp_enqueue_script( 'GoogleMap', 'https://maps.googleapis.com/maps/api/js?key='.$api, null, null, true );

		wp_enqueue_script( 'CustomMap', get_template_directory_uri() . '/js/map.js', null, null, true );

		wp_localize_script('GoogleMap', 'WPURLS', array(
			'siteurl' => get_option('siteurl'),
			'archive' => $archive
		));

	}
}
add_action('wp_enqueue_scripts', 'compulse_enqueue_scripts');

/*********************************
 * Enqueues Swiper in ACF Blocks *
 *********************************/
function compulse_acf_enqueue_scripts() {
	wp_register_style( 'Swiper', 'https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.0/css/swiper.min.css' );
	wp_enqueue_style('Swiper');

	wp_register_script( 'Swiper', 'https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.0/js/swiper.min.js', null, null, true );
	wp_enqueue_script('Swiper');
}

/********************************************
 * Enqueues Google Map Script in ACF Blocks *
 ********************************************/
function compulse_map_enqueue_scripts() {
	$api = get_field('gmap_api', 'options');
	wp_enqueue_script( 'GoogleMap', 'https://maps.googleapis.com/maps/api/js?key='.$api, null, null, true );

	wp_enqueue_script( 'CustomMap', get_template_directory_uri() . '/js/map.js', null, null, true );

	wp_localize_script('GoogleMap', 'WPURLS', array( 'siteurl' => get_option('siteurl') ));
}
