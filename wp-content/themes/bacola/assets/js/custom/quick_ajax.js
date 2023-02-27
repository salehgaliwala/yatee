jQuery(document).ready(function($) {
	"use strict";

	$(document).on('click', 'a.detail-bnt', function(event){
		event.preventDefault(); 
        var data = {
			cache: false,
            action: 'quick_view',
			beforeSend: function() {
				$('body').append('<svg class="loader-image preloader quick-view" width="65px" height="65px" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg"><circle class="path" fill="none" stroke-width="6" stroke-linecap="round" cx="33" cy="33" r="30"></circle></svg></div>');
			},
			'id': $(this).attr('href'),
        };

        // since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
		$.post(MyAjax.ajaxurl, data, function(response) {
            $.magnificPopup.open({
                type: 'inline',
                items: {
                    src: response
                }
            })


			  var container = $( '.site-slider' );

			  container.each( function() {
				var self = $(this);

				var sliderItems = $( '.slider-item' );
				sliderItems.imagesLoaded( function() {
				  self.closest( '.slider-wrapper' ).addClass( 'slider-loaded' );
				});

				var autoplay = $( this ).data( 'autoplay' );
				var autospeed = $( this ).data( 'autospeed' );
				var arrows = $( this ).data( 'arrows' );
				var dots = $( this ).data( 'dots' );
				var slideshow = $( this ).data( 'slideshow' );
				var slidescroll = $( this ).data( 'slidescroll' );
				var slidespeed = $( this ).data( 'slidespeed' );
				var asnav = $( this ).data( 'asnav' );
				var focusselect = $( this ).data( 'focusselect' );
				var vertical = $( this ).data( 'vertical' );

				self.not('.slick-initialized').slick({
				  autoplay: autoplay,
				  autoplaySpeed: autospeed,
				  arrows: arrows,
				  dots: dots,
				  slidesToShow: slideshow,
				  slidesToScroll: slidescroll,
				  speed: slidespeed,
				  asNavFor: asnav,
				  focusOnSelect: focusselect,
				  centerPadding: false,
				  cssEase: 'cubic-bezier(.48,0,.12,1)',
				  vertical: vertical,
				  /* prevArrow: prevButton,
				  nextArrow: nextButton, */
				  responsive: [
					{
					  breakpoint: 1400,
					  settings: {
						slidesToShow: slideshow < 6 ? slideshow: 5
					  }
					},
					{
					  breakpoint: 1200,
					  settings: {
						slidesToShow: slideshow < 5 ? slideshow: 4
					  }
					},
					{
					  breakpoint: 1024,
					  settings: {
						slidesToShow: slideshow < 4 ? slideshow: 3
					  }
					},
					{
					  breakpoint: 991,
					  settings: {
						slidesToShow: slideshow < 3 ? slideshow: 2
					  }
					},
					{
					  breakpoint: 768,
					  settings: {
						slidesToShow: slideshow < 2 ? slideshow: 3
					  }
					},
				  ],
				});
			  });
			  
			  
			  function qty() {
				var container = $( '.quantity:not(.ajax-quantity)' );
				container.each( function() {
				  var self = $( this );
				  var buttons = $( this ).find( '.quantity-button' );
				  buttons.each( function() {
					$(this).on( 'click', function(event) {
					  var qty_input = self.find( '.input-text.qty' );
					  if ( $(qty_input).prop('disabled') ) return;
					  var qty_step = parseFloat($(qty_input).attr('step'));
					  var qty_min = parseFloat($(qty_input).attr('min'));
					  var qty_max = parseFloat($(qty_input).attr('max'));


					  if ( $(this).hasClass('minus') ){
						var vl = parseFloat($(qty_input).val());
						vl = ( (vl - qty_step) < qty_min ) ? qty_min : (vl - qty_step);
						$(qty_input).val(vl);
					  } else if ( $(this).hasClass('plus') ) {
						var vl = parseFloat($(qty_input).val());
						vl = ( (vl + qty_step) > qty_max ) ? qty_max : (vl + qty_step);
						$(qty_input).val(vl);
					  }

					  qty_input.trigger( 'change' );
					});
				  });
				});
			  }

			  qty();
			  $('body').on( 'updated_cart_totals', qty );
			  
			if ( $('.product-brand > *').length < 1 ) {
				$('.product-brand').remove();
			}

			$("form.cart.grouped_form .input-text.qty").attr("value", "0");

			$( document.body ).trigger( 'bacolaSinglePageInit' );

			$(".loader-image").remove();

			$('.input-text.qty').closest('.quick-product-wrapper').find( '.input-text.qty' ).val($('.input-text.qty').closest('.quick-product-wrapper').find( '.input-text.qty' ).attr('min'));
        });
    });	

});