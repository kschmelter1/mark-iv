<?php
add_filter( 'block_categories', function( $categories, $post ) {
    return array_merge(
        $categories,
        array(
            array(
                'slug'  => 'compulse',
                'title' => 'Compulse Custom Blocks',
            ),
        )
    );
}, 10, 2 );


/*** Blocks ***/
function register_acf_block_types() {

  acf_register_block_type(array(
      'name'              => 'hero-slider',
      'title'             => __('Hero Slider'),
      'description'       => __('A custom hero block.'),
      'render_template'   => 'templates/blocks/hero_slider.php',
      'category'          => 'compulse',
      'icon'              => 'admin-comments',
      'keywords'          => array( 'hero', 'homepage' ),
      'mode'              => 'edit',
      'supports' => array(
        'mode' => false, // Turns off preview mode permanently
        'multiple' => false, // Does not allow multiple of this block on one page
        'anchor' => false // If true, allows custom ID
      ),
      'enqueue_assets' => 'compulse_acf_enqueue_scripts'
  ));

  acf_register_block_type(array(
      'name'              => 'image-banner',
      'title'             => __('Image Banner'),
      'description'       => __('A custom image block.'),
      'render_template'   => 'templates/blocks/image_banner.php',
      'category'          => 'compulse',
      'icon'              => 'admin-comments',
      'keywords'          => array( 'image', 'internal' ),
      'mode'              => 'edit',
      'supports' => array(
        'mode' => false, // Turns off preview mode permanently
        'multiple' => true, // Does not allow multiple of this block on one page
        'anchor' => false // If true, allows custom ID
      )
  ));

  acf_register_block_type(array(
      'name'              => 'call-to-action',
      'title'             => __('Call to Action'),
      'description'       => __('A call to action block.'),
      'render_template'   => 'templates/blocks/cta.php',
      'category'          => 'compulse',
      'icon'              => 'admin-comments',
      'keywords'          => array( 'cta', 'button' ),
      'mode'              => 'edit',
      'supports' => array(
        'mode' => false, // Turns off preview mode permanently
        'multiple' => false, // Does not allow multiple of this block on one page
        'anchor' => false // If true, allows custom ID
      ),
      'enqueue_script' => get_template_directory_uri() . '/js/cta.js'
  ));

  acf_register_block_type(array(
      'name'              => 'map-embed',
      'title'             => __('Map Embed'),
      'description'       => __('A full-width Google map.'),
      'render_template'   => 'templates/blocks/map_embed.php',
      'category'          => 'compulse',
      'icon'              => 'admin-comments',
      'keywords'          => array( 'map', 'iframe', 'html' ),
      'mode'              => 'edit',
      'supports' => array(
        'mode' => false, // Turns off preview mode permanently
        'multiple' => true, // Does not allow multiple of this block on one page
        'anchor' => false // If true, allows custom ID
      )
  ));

  acf_register_block_type(array(
      'name'              => 'featured-locations',
      'title'             => __('Featured Locations'),
      'description'       => __('Featured Locations'),
      'render_template'   => 'templates/blocks/featured.php',
      'category'          => 'compulse',
      'icon'              => 'admin-comments',
      'keywords'          => array( 'location', 'property', 'posts' ),
      'mode'              => 'edit',
      'supports' => array(
        'mode' => false, // Turns off preview mode permanently
        'multiple' => true, // Does not allow multiple of this block on one page
        'anchor' => false // If true, allows custom ID
      ),
      'enqueue_assets' => 'compulse_acf_enqueue_scripts'
  ));

  acf_register_block_type(array(
      'name'              => 'careers',
      'title'             => __('Career List'),
      'description'       => __('A custom Career List block.'),
      'render_template'   => 'templates/blocks/careers.php',
      'category'          => 'compulse',
      'icon'              => 'admin-comments',
      'keywords'          => array( 'list', 'jobs' ),
      'mode'              => 'edit',
      'supports' => array(
        'mode' => false, // Turns off preview mode permanently
        'multiple' => true, // Does not allow multiple of this block on one page
        'anchor' => true // If true, allows custom ID
      )
  ));

  acf_register_block_type(array(
      'name'              => 'blurbs',
      'title'             => __('Blurbs'),
      'description'       => __('A custom image and text block.'),
      'render_template'   => 'templates/blocks/blurbs.php',
      'category'          => 'compulse',
      'icon'              => 'admin-comments',
      'keywords'          => array( 'image', 'text' ),
      'mode'              => 'edit',
      'supports' => array(
        'mode' => false, // Turns off preview mode permanently
        'multiple' => true, // Does not allow multiple of this block on one page
        'anchor' => false // If true, allows custom ID
      )
  ));

  acf_register_block_type(array(
      'name'              => 'google-map',
      'title'             => __('Homepage Map'),
      'description'       => __('Homepage Map'),
      'render_template'   => 'templates/blocks/google_map.php',
      'category'          => 'compulse',
      'icon'              => 'admin-comments',
      'keywords'          => array( 'map', 'homepage' ),
      'mode'              => 'edit',
      'supports' => array(
        'mode' => false, // Turns off preview mode permanently
        'multiple' => false, // Does not allow multiple of this block on one page
        'anchor' => false // If true, allows custom ID
      ),
      'enqueue_assets' => 'compulse_map_enqueue_scripts'
  ));

}

// Check if function exists and hook into setup.
if( function_exists('acf_register_block_type') ) {
    add_action('acf/init', 'register_acf_block_types');
}

/*
//Adds support for editor color palette.
add_theme_support( 'editor-color-palette', array(
	array(
		'name'  => __( 'Cyan', 'mark-iv' ),
		'slug'  => 'primary',
		'color'	=> '#CCE7EB',
	),
  array(
		'name'  => __( 'White', 'mark-iv' ),
		'slug'  => 'white',
		'color'	=> '#FFF',
	),
	array(
		'name'  => __( 'Teal', 'mark-iv' ),
		'slug'  => 'secondary',
		'color' => '#4C7880',
	),
	array(
		'name'  => __( 'Brown', 'mark-iv' ),
		'slug'  => 'dark',
		'color' => '#59585A',
       ),
) );*/

// Add backend styles for Gutenberg.
add_action( 'enqueue_block_editor_assets', 'compulse_add_gutenberg_assets' );

/**
 * Load Gutenberg stylesheet.
 */
function compulse_add_gutenberg_assets() {
	// Load the theme styles within Gutenberg.
	wp_enqueue_style( 'compulse-gutenberg', get_stylesheet_directory_uri(). '/includes/gutenberg-editor-style.css' , false );
}
