jQuery(document).ready(function() {
	let popupPosition = function() {
		let pad = jQuery('#wpcontent').css('padding-left');

		jQuery('.trustindex-popup').css({
			right: pad,
			'margin-left': pad
		});
	};

	popupPosition();
	jQuery(window).resize(popupPosition);

	jQuery(document).on('click', 'a.trustindex-rateus', function(event) {
		// get link, close button and url
		let link = jQuery(this);
		let closeButton = link.closest('.notice').find('.notice-dismiss');
		let url = link.attr('href');

		// hide the modal - click close button
		closeButton.click();

		// make ajax at the background if not the rate button clicked
		if (link.attr('target') === undefined) {
			event.preventDefault();

			return jQuery.get(url);
		}
	});
});