/**
 * Theme functions file
 *
 * Contains handlers for navigation, accessibility, header sizing
 * footer widgets and Featured Content slider
 *
 */

var honos = {};

jQuery(window).load(function() {
	jQuery('body.blog .content-wrapper, body.archive .content-wrapper, body.search .content-wrapper').isotope();

	jQuery(window).resize(function() {
		jQuery('body.blog .content-wrapper, body.archive .content-wrapper, body.search .content-wrapper').isotope();
	});
});

jQuery(document).ready(function($) {

	jQuery(window).scroll(function () {
		if ( jQuery(this).scrollTop() >= 100 ) {
			jQuery('.main-header').addClass('scrolled');
		} else {
			jQuery('.main-header').removeClass('scrolled');
		}
	});

	jQuery(document).on('click', '.header-top .header-search', function() {
		if ( jQuery('.header-top .search-field').val() == '' ) {
			jQuery('.header-top .search-form').toggleClass('active');
		} else {
			jQuery('.header-top .search-submit').click();
		}
	});

	jQuery(document).on('click', '.mobile-menu-button', function() {
		jQuery('#mobile-navigation').toggleClass('active');
	});

	jQuery(document).on('click', '.honos-practice-container', function() {
		window.location = jQuery(this).find('a').attr('href');
	})

	if ( jQuery('#testimonial-container').length && jQuery('#testimonial-container').children().length > 1 ) {
		jQuery('.tespimonial-background').css({"width": jQuery(window).width()+"px", "left": "-"+parseInt(jQuery(".tespimonial-background").offset().left+1)+"px"});

		jQuery('.testimonial-wrapper').on("jcarousel:scroll", function(event, carousel) {
			jQuery("#testimonial-container").parent().hide().fadeIn(700);
		}).jcarousel({
			wrap: "circular",
			animation: {
				duration: 0
			}
		}).jcarouselAutoscroll({
			interval: 8000,
			target: '+=1',
			autostart: true
		});

		jQuery('.testimonial-pagination').on('jcarouselpagination:create', function(carousel) {
			jQuery(carousel.target).find('a:first-child').addClass('active');
		}).on('jcarouselpagination:active', 'a', function() {
			jQuery(this).addClass('active');
		}).on('jcarouselpagination:inactive', 'a', function() {
			jQuery(this).removeClass('active');
		}).jcarouselPagination({
			'carousel': jQuery('.testimonial-wrapper'),
			'perPage': 1
		});
	}

	if ( jQuery('.row.slider-overlay').length ) {
		jQuery('.row.slider-overlay').css({"width": jQuery(window).width()+"px", "left": "-"+parseInt(jQuery(".row.slider-overlay").offset().left+1)+"px", "position": "relative"});
		jQuery('.slider-overlay-left, .slider-overlay-right, .slider-overlay-middle').height('auto');
		jQuery('.slider-overlay-left, .slider-overlay-right, .slider-overlay-middle').height(jQuery('.row.slider-overlay').innerHeight()-45);
		jQuery('.row.slider-overlay').css({"margin-top": "-"+jQuery('.row.slider-overlay').height()+"px"});
	};

	jQuery(window).resize(function() {
		// Resize slider overlay
		if ( jQuery('.row.slider-overlay').length && jQuery(window).width() < 1200 && jQuery(window).width() > 768 ) {
			jQuery('.slider-overlay-left, .slider-overlay-right, .slider-overlay-middle').height('auto');
			jQuery('.slider-overlay-left, .slider-overlay-right, .slider-overlay-middle').height(jQuery('.row.slider-overlay').innerHeight()-45);
		} else if ( jQuery('.row.slider-overlay').length && jQuery(window).width() > 1200) {
			jQuery('.row.slider-overlay').css({"left": "0px"});
			jQuery('.row.slider-overlay').css({"width": jQuery(window).width()+"px", "left": "-"+parseInt(jQuery(".row.slider-overlay").offset().left+1)+"px", "position": "relative"});
			jQuery('.slider-overlay-left, .slider-overlay-right, .slider-overlay-middle').height('auto');
			jQuery('.slider-overlay-left, .slider-overlay-right, .slider-overlay-middle').height(jQuery('.row.slider-overlay').innerHeight()-45);
			jQuery('.row.slider-overlay').css({"margin-top": "-"+jQuery('.row.slider-overlay').height()+"px"});
		}

		// Resize testimonials
		if ( jQuery('.tespimonial-background').length && jQuery(window).width() > 768 ) {
			jQuery('.tespimonial-background').css({"left": "0px"});
			jQuery('.tespimonial-background').css({"width": jQuery(window).width()+"px", "left": "-"+parseInt(jQuery(".tespimonial-background").offset().left+1)+"px"});
		} else {
			jQuery('.testimonial-wrapper, .testimonial-item').width(jQuery(window).width()-60);
		}

	});
});

function clearInput (input, inputValue) {
	"use strict";

	if (input.value === inputValue) {
		input.value = '';
	}
}

( function( $ ) {
	var body    = $( 'body' ),
		_window = $( window );

	$('.scroll-to-top').click(function () {
		$('body,html').animate({
			scrollTop: 0
		}, 800);
		return false;
	});

	jQuery(document).scroll(function() {
		if ( jQuery(document).scrollTop() >= 200 ) {
			jQuery('.site-header').addClass('scrolled');
		} else {
			jQuery('.site-header').removeClass('scrolled');
		}
	});

	// Enable menu toggle for small screens.
	( function() {
		var nav = $( '#primary-navigation' ), button, menu;
		if ( ! nav ) {
			return;
		}

		button = nav.find( '.menu-toggle' );
		if ( ! button ) {
			return;
		}

		// Hide button if menu is missing or empty.
		menu = nav.find( '.nav-menu' );
		if ( ! menu || ! menu.children().length ) {
			button.hide();
			return;
		}

		$( '.menu-toggle' ).on( 'click.honos', function() {
			nav.toggleClass( 'toggled-on' );
		} );
	} )();

	/*
	 * Makes "skip to content" link work correctly in IE9 and Chrome for better
	 * accessibility.
	 *
	 * @link http://www.nczonline.net/blog/2013/01/15/fixing-skip-to-content-links/
	 */
	_window.on( 'hashchange.honos', function() {
		var element = document.getElementById( location.hash.substring( 1 ) );

		if ( element ) {
			if ( ! /^(?:a|select|input|button|textarea)$/i.test( element.tagName ) ) {
				element.tabIndex = -1;
			}

			element.focus();

			// Repositions the window on jump-to-anchor to account for header height.
			window.scrollBy( 0, -80 );
		}
	} );

	$( function() {

		/*
		 * Fixed header for large screen.
		 * If the header becomes more than 48px tall, unfix the header.
		 *
		 * The callback on the scroll event is only added if there is a header
		 * image and we are not on mobile.
		 */
		if ( _window.width() > 781 ) {
			var mastheadHeight = $( '#masthead' ).height(),
				toolbarOffset, mastheadOffset;

			if ( mastheadHeight > 48 ) {
				body.removeClass( 'masthead-fixed' );
			}

			if ( body.is( '.header-image' ) ) {
				toolbarOffset  = body.is( '.admin-bar' ) ? $( '#wpadminbar' ).height() : 0;
				mastheadOffset = $( '#masthead' ).offset().top - toolbarOffset;

				_window.on( 'scroll.honos', function() {
					if ( ( window.scrollY > mastheadOffset ) && ( mastheadHeight < 49 ) ) {
						body.addClass( 'masthead-fixed' );
					} else {
						body.removeClass( 'masthead-fixed' );
					}
				} );
			}
		}

		// Focus styles for menus.
		$( '.primary-navigation, .secondary-navigation' ).find( 'a' ).on( 'focus.honos blur.honos', function() {
			$( this ).parents().toggleClass( 'focus' );
		} );
	} );
} )( jQuery );

/*------------------------------------------------------------
 * FUNCTION: Scroll Page Back to Top
 * Used for ajax navigation scroll position reset
 *------------------------------------------------------------*/

function scrollPageToTop(){
	// Height hack for mobile/tablet
	jQuery('body').css('height', 'auto');
	jQuery("html, body").animate({ scrollTop: 0 }, "slow");

	// if( honos.device != 'desktop' ){
		// jQuery('body').scrollTop(0);
	// }else{
	//  jQuery('.content-wrapper').scrollTop(0);
	// }

	jQuery('body').css('height', '');
}

(function() {

	// detect if IE : from http://stackoverflow.com/a/16657946      
	var ie = (function(){
		var undef,rv = -1; // Return value assumes failure.
		var ua = window.navigator.userAgent;
		var msie = ua.indexOf('MSIE ');
		var trident = ua.indexOf('Trident/');

		if (msie > 0) {
			// IE 10 or older => return version number
			rv = parseInt(ua.substring(msie + 5, ua.indexOf('.', msie)), 10);
		} else if (trident > 0) {
			// IE 11 (or newer) => return version number
			var rvNum = ua.indexOf('rv:');
			rv = parseInt(ua.substring(rvNum + 3, ua.indexOf('.', rvNum)), 10);
		}

		return ((rv > -1) ? rv : undef);
	}());


	// disable/enable scroll (mousewheel and keys) from http://stackoverflow.com/a/4770179                  
	// left: 37, up: 38, right: 39, down: 40,
	// spacebar: 32, pageup: 33, pagedown: 34, end: 35, home: 36
	var keys = [37, 38, 39, 40], wheelIter = 0;

	function preventDefault(e) {
		e = e || window.event;
		if (e.preventDefault)
		e.preventDefault();
		e.returnValue = false;  
	}

	function keydown(e) {
		for (var i = keys.length; i--;) {
			if (e.keyCode === keys[i]) {
				preventDefault(e);
				return;
			}
		}
	}

	function touchmove(e) {
		preventDefault(e);
	}

	function wheel(e) {
		// for IE 
		//if( ie ) {
			//preventDefault(e);
		//}
	}

	function disable_scroll() {
		window.onmousewheel = document.onmousewheel = wheel;
		document.onkeydown = keydown;
		document.body.ontouchmove = touchmove;
	}

	function enable_scroll() {
		window.onmousewheel = document.onmousewheel = document.onkeydown = document.body.ontouchmove = null;  
	}

	var docElem = window.document.documentElement,
		scrollVal,
		isRevealed, 
		noscroll, 
		isAnimating;

	function scrollY() {
		return window.pageYOffset || docElem.scrollTop;
	}

	function scrollPage() {
		scrollVal = scrollY();
		
		if( noscroll && !ie ) {
			if( scrollVal < 0 ) return false;
			// keep it that way
			window.scrollTo( 0, 0 );
		}

		if( jQuery('body').hasClass( 'notrans' ) ) {
			jQuery('body').removeClass( 'notrans' );
			return false;
		}

		if( isAnimating ) {
			return false;
		}
		
		if( scrollVal <= 0 && isRevealed ) {
			toggle(0);
		}
		else if( scrollVal > 0 && !isRevealed ){
			toggle(1);
		}
	}

	function toggle( reveal ) {
		isAnimating = true;
		
		if( reveal ) {
			jQuery('body').addClass( 'modify' );
		}
		else {
			noscroll = true;
			disable_scroll();
			jQuery('body').removeClass( 'modify' );
		}

		// simulating the end of the transition:
		setTimeout( function() {
			isRevealed = !isRevealed;
			isAnimating = false;
			if( reveal ) {
				noscroll = false;
				enable_scroll();
			}
		}, 600 );
	}

	if( !/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {

		// refreshing the page...
		var pageScroll = scrollY();
		noscroll = pageScroll === 0;

		disable_scroll();

		if( pageScroll ) {
			isRevealed = true;
			jQuery('body').addClass( 'notrans' );
			jQuery('body').addClass( 'modify' );
		}

		
	} else if ( jQuery('body').hasClass('single-post') && /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
		jQuery('body').addClass( 'notrans' );
		jQuery('body').addClass( 'modify' );
	}
	
})();

// Stretch slider full-width
( function( $ ) {
	if ( jQuery('.frontpage-slider-wrapper').length ) {
		jQuery('.frontpage-slider-wrapper').css({"width": jQuery(window).width()+"px", "left": "-"+parseInt(jQuery(".frontpage-slider-wrapper").offset().left+1)+"px", "position": "relative"});
	};
})();