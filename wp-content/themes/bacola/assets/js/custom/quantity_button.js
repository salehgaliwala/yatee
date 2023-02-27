jQuery(document).ready(function($) {
	"use strict";
	
	$(document).on('click', '.cart-with-quantity .quantity-button.plus', function(event){
		event.preventDefault(); 

		var clicked = $(this);


        var data = {
			type: 'POST',
			timeout: 3000,
			cache: false,
            action: 'quantity_button',
			beforeSend: function () {
				clicked.css('pointer-events','none');
				clicked.append('<svg class="loader-image preloader added" width="65px" height="65px" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg"><circle class="path" fill="none" stroke-width="6" stroke-linecap="round" cx="33" cy="33" r="30"></circle></svg>')
			},
			id: clicked.closest('.product-button-group').find('a.button').attr('data-product_id'),
			quantity : clicked.prev().val(),
        };

        // since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
		$.post(MyAjax.ajaxurl, data, function(response) {
			if(quantity.notice == 1){
				$(response).appendTo('.klb-notice-ajax').delay(3000).fadeOut(300, function(){ $(this).remove();});
				$('.klb-notice-close').on('click', function(){
					$(this).closest('.woocommerce-message, .woocommerce-error').remove();
				});
			}

			$( document.body ).trigger( 'wc_fragment_refresh' );
			$('svg.preloader.added').remove();
			clicked.css('pointer-events','');
        });
    });
	
	$(document).on('click', '.cart-with-quantity .quantity-button.minus', function(event){
		event.preventDefault(); 
		var clicked = $(this);

        var data = {
			type: 'POST',
			timeout: 3000,
			cache: false,
            action: 'quantity_button',
			beforeSend: function () {
				clicked.css('pointer-events','none');
				clicked.append('<svg class="loader-image preloader added" width="65px" height="65px" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg"><circle class="path" fill="none" stroke-width="6" stroke-linecap="round" cx="33" cy="33" r="30"></circle></svg>')
			},
			id: $(this).closest('.product-button-group').find('a.button').attr('data-product_id'),
			quantity : clicked.next().val(),
        };

        // since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
		$.post(MyAjax.ajaxurl, data, function(response) {
			if(quantity.notice == 1){
				$(response).appendTo('.klb-notice-ajax').delay(3000).fadeOut(300, function(){ $(this).remove();});
				$('.klb-notice-close').on('click', function(){
					$(this).closest('.woocommerce-message, .woocommerce-error').remove();
				});
			}

			$( document.body ).trigger( 'wc_fragment_refresh' );
			$('svg.preloader.added').remove();
			clicked.css('pointer-events','');
        });
    });

	$(document).on('click', '.cart-notice-close', function(event){
		event.preventDefault();
		
		$('.klb-cart-notice').remove();
	});

});