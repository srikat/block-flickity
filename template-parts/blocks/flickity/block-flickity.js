(function ($) {
	/**
	 * initializeBlock
	 *
	 * Adds custom JavaScript to the block HTML.
	 *
	 * @date    23/11/20
	 * @since   1.0.0
	 *
	 * @param   object $block The block jQuery element.
	 * @param   object attributes The block attributes (only available when editing).
	 * @return  void
	 */
	var initializeBlock = function ($block) {
		$images_container = $block.find('.images-container');

		$images_container.flickity({
			imagesLoaded: true, // re-positions cells once their images have loaded
			groupCells: true, // group cells that fit in carousel viewport
			cellAlign: $images_container.data( 'cellalign' ),
			freeScroll: true, // enables content to be freely scrolled and flicked without aligning cells to an end position
			wrapAround: $images_container.data( 'wraparound' ),
		});
	};

	// Initialize each block on page load (front end).
	$(document).ready(function () {
		$('.flickity').each(function () {
			initializeBlock($(this));
		});
	});

	// Initialize dynamic block preview (editor).
	if (window.acf) {
		window.acf.addAction(
			'render_block_preview/type=flickity',
			initializeBlock
		);
	}
})(jQuery);
