<?php

/**
 * Flickity Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'flickity-' . $block['id'];

if ( ! empty( $block['anchor'] ) ) {
	$id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'flickity';

if ( ! empty( $block['className'] ) ) {
	$className .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
	$className .= ' align' . $block['align'];
}

$images      = get_field( 'images' );
$cellalign   = get_field( 'cellalign' );
$wraparound  = get_field( 'mode' );
$image_width = get_field( 'image_width' ) ?: '25%';
$gap         = get_field( 'gap' ) ?: '10px';

$size = 'flickity_image'; // (thumbnail, medium, large, full or custom size)

?>
<section id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $className ); ?>">
<?php
if ( $images ) {
	printf(
		'<div class="images-container" data-cellalign="%s" data-wraparound="%s">',
		esc_attr( $cellalign ),
		esc_attr( $wraparound )
	);
	foreach ( $images as $image ) {
		printf(
			'<img src="%s" alt="%s" width="%s" height="%s" style="margin-right: %s;">',
			esc_attr( wp_get_attachment_image_url( $image['ID'], $size ) ),
			esc_attr( $image['alt'] ),
			esc_attr( $image_width ),
			$image['sizes'][ $size . '-height' ],
			esc_attr( $gap ),
		);
	}
	echo '</div>';
} else {
	echo 'No images found. Add/select some by clicking on the "Add to gallery" button.';
}
?>
</section>
