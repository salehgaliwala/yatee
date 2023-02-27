(function ($) {
  "use strict";

	$(document).on('bacolaShopPageInit', function () {
		bacolaThemeModule.counter();
	});

	bacolaThemeModule.counter = function() {
      var container = $( '.countdown' );

      container.each( function() {
        var countDate = $(this).data('date');
        var countDownDate = new Date( countDate ).getTime();
        var expired = $(this).data('expiredText');

        var d = $(this).find( '.days' );
        var h = $(this).find( '.hours' );
        var m = $(this).find( '.minutes' );
        var s = $(this).find( '.second' );

        var x = setInterval(function() {

          var now = new Date().getTime();

          var distance = countDownDate - now;

          var days = Math.floor(distance / (1000 * 60 * 60 * 24));
          var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
          var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
          var seconds = Math.floor((distance % (1000 * 60)) / 1000);

          d.html( ( '0' + days ).slice(-2) );
          h.html( ( '0' + hours ).slice(-2) );
          m.html( ( '0' + minutes ).slice(-2) );
          s.html( ( '0' + seconds ).slice(-2) );

          /* if (distance < 0) {
            clearInterval(x);
            document.getElementById("demo").innerHTML = "EXPIRED";
          } */
        }, 1000);
      });
	}
	
	$(document).ready(function() {
		bacolaThemeModule.counter();
	});

})(jQuery);
