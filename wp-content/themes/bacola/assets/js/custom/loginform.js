(function ($) {
  "use strict";

	bacolaThemeModule.loginform = function() {
		
      var tab = $( '.login-page-tab li' );
      var forms = $( '.login-form-container' );

      var removeClass = () => {
        for ( var i = 0; i < tab.length; i++ ) {
          if ( tab[i].children[0].classList.contains( 'active' ) ) {
            tab[i].children[0].classList.remove('active');
          }
        }
      }

      for ( var i = 0; i < tab.length; i++ ) {
        const button = tab[i].children[0];
        button.addEventListener( 'click', (event) => {
          event.preventDefault();
          if ( !event.target.classList.contains( 'active' ) ) {
            removeClass();
            event.target.classList.add( 'active' );
            forms.toggleClass( 'show-register-form' );
          }
        });
      }
	}
	
	$(document).ready(function() {
		bacolaThemeModule.loginform();
	});

})(jQuery);
