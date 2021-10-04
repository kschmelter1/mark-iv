<?php
add_theme_support( 'post-thumbnails' );
add_theme_support( 'title-tag' );
add_theme_support( 'responsive-embeds' );

//Advanced Custom Fields Options page
if( function_exists('acf_add_options_page') ) {

	$option_page = acf_add_options_page(array(
		'page_title' => 'Site Options',
		'menu_slug' => 'options',
		'position' => '2.5',
		'post_id' => 'options',
		'icon_url' => 'dashicons-smiley'
	));

}

/*** Helper Functions ***/
function clean_phone($num, $full = false) {
	$clean = 'tel:'.preg_replace('/\D+/', '', $num);
	if ($full) {
		$output = '<a href="'.$clean.'" class="phone">'.$num.'</a>';
		return $output;
	} else {
		return $clean;
	}
}

function echo_image($img, $size = 'full', $class = "img-fluid") {
	if (is_array($img)) { //ACF image array
		$src = acf_image($img['id'],$size);
		$alt = $img['alt'];
	} else { //Assuming $img is an ID
		$src = acf_image($img,$size);
		$alt = get_post_meta($img, '_wp_attachment_image_alt', TRUE);
	}

	return '<img class="'.$class.'" alt="'.$alt.'" '.$src.'>';
}

function echo_link($link, $class) {
	return '<a href="'.$link['url'].'" '.a_target($link).' class="'.$class.'">'.$link['title'].'</a>';
}

function a_target($link) {
	if ($link['target']) {return 'target="_blank"';} else {return;}
}

function make_id($str) {
		$str = strip_tags( $str );
		return str_replace(' ', '-', strtolower($str));
		// return: convert-spaces-to-dash-and-lowercase-with-php
}

function echo_addr($addr) {
	if (!$addr) {
		return;
	}
	$output = ($addr['street'] ? "<div>".$addr['street']."</div>" : "");
	$output .= '<div>'.($addr['city']);
	$output .= ($addr['state'] ? ($addr['city'] ? ', ' : '').$addr['state'] : '');
	$output .= ($addr['zip'] ? ($addr['city'] || $addr['state'] ? ' ' : '').$addr['zip'] : '');
	$output .= '</div>';
	return $output;
}

/**
 * Responsive Image Helper Function
 *
 * @param string $image_id the id of the image (from ACF or similar)
 * @param string $image_size the size of the thumbnail image or custom image size
 * @param string $max_width the max width this image will be shown to build the sizes attribute
 */

function acf_image($image_id,$image_size){
	switch ($image_size) {
		case 'thumbnail': $max_width = '150px'; break;
		case 'medium': $max_width = '300px'; break;
		case 'medium_large': $max_width = '768px'; break;
		case 'large': $max_width = '1024px'; break;
		default: $max_width = '2048px'; break;
	}

	// check the image ID is not blank
	if($image_id != '') {

		// set the default src image size
		$image_src = wp_get_attachment_image_url( $image_id, $image_size );

		// set the srcset with various image sizes
		$image_srcset = wp_get_attachment_image_srcset( $image_id, $image_size );

		$imgString = 'src="'.$image_src.'" ';
		if ($image_srcset) {
			$imgString .= 'srcset="'.$image_srcset.'" sizes="(max-width: '.$max_width.') 100vw, '.$max_width.'"';
		}

		// generate the markup for the responsive image
		return $imgString;

	}
}
