(function($) {

	$(document).ready(function() {

		wceb.dateFormat      = wceb_object.booking_dates;
		wceb.firstDate       = parseInt( wceb_object.first_date );
		wceb.bookingMin      = parseInt( wceb_object.min );
		wceb.bookingMax      = wceb_object.max === '' ? '' : parseInt( wceb_object.max );
		wceb.bookingDuration = parseInt( wceb_object.booking_duration );
		wceb.priceHtml       = wceb_object.prices_html;

		wceb.pickers.init();
		wceb.pickers.render();

	});

})(jQuery);