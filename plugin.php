<?php
/*
Plugin Name:	Block - Flickity
Plugin URI:		https://wpdevdesign.com/building-a-custom-gutenberg-block-flickity-using-acf-pro/
Description:	Custom Gutenberg block for showing images as slider/carousel using Flickity - Needs ACF Pro.
Version:		1.0.0
Author:			Sridhar Katakam
Author URI:		https://wpdevdesign.com
License:		GPL-2.0+
License URI:	http://www.gnu.org/licenses/gpl-2.0.txt

This plugin is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.

This plugin is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with This plugin. If not, see {URI to Plugin License}.
*/

if ( ! defined( 'WPINC' ) ) {
	die;
}

// Register a custom image size for images in the slider/carousel.
add_image_size( 'flickity_image', 500, 726, true );

add_action( 'acf/init', 'block_flickity_acf_init_block_types' );
/**
 * Register a custom block using ACF Pro.
 */
function block_flickity_acf_init_block_types() {

	// Check function exists.
	if ( function_exists( 'acf_register_block_type' ) ) {

		// register a Flickity block.
		acf_register_block_type(
			array(
				'name'            => 'flickity',
				'title'           => __( 'Flickity' ),
				'description'     => __( 'Image carousel/slider block using Flickity.' ),
				'render_template' => plugin_dir_path( __FILE__ ) . 'template-parts/blocks/flickity/flickity.php',
				'category'        => 'media',
				'icon'            => 'media-code',
				'keywords'        => array( 'carousel', 'slider', 'flickity' ),
				'enqueue_assets'  => function() {
					wp_enqueue_style( 'flickity', plugin_dir_url( __FILE__ ) . 'template-parts/blocks/flickity/flickity.min.css' );
					wp_enqueue_style( 'block-flickity', plugin_dir_url( __FILE__ ) . 'template-parts/blocks/flickity/block-flickity.css' );

					wp_enqueue_script( 'flickity', plugin_dir_url( __FILE__ ) . 'template-parts/blocks/flickity/flickity.pkgd.min.js', '', '2.2.1', true );
					wp_enqueue_script( 'flickity-init', plugin_dir_url( __FILE__ ) . 'template-parts/blocks/flickity/block-flickity.js', array( 'flickity' ), '1.0.0', true );
				},
			)
		);

	}
}
