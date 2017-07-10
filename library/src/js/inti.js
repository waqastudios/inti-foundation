import $ from 'jquery';
import whatInput from 'what-input';

window.$ = $;

import Foundation from 'foundation-sites';
// If you want to pick and choose which modules to include, comment out the above and uncomment
// the line below
//import './lib/foundation-explicit-pieces';


// Initialize Foundation
$(document).foundation();

// Basic Interface

// Hamburger Menu active state
$(document).on( "opened.zf.offcanvas", function(){
	$('.hamburger').addClass('is-active');
});
$(document).on( "closed.zf.offcanvas", function(){
	$('.hamburger').removeClass('is-active');
});



import slick from 'slick-carousel';

$('.inti-carousel').slick({
	accessibility: true,
	adaptiveHeight: false,
	autoplay: true,
	autoplaySpeed: 6000,
	arrows: true,
	asNavFor: null,
	centerMode: true,
	centerPadding: '0px',
	cssEase: 'ease',
	dots: false,
	draggable: true,
	fade: false,
	infinite: true,
	initialSlide: 0,
	pauseOnHover: true,
	pauseOnDotsHover: false,
	variableWidth: false,
	slidesToShow: 4, 
	slidesToScroll: 1,
	speed: 600,
	swipe: true,
	// prevArrow: '<button type="button" class="slick-prev arrows"><i class="fa fa-chevron-left"></i></button>',
	// nextArrow: '<button type="button" class="slick-next arrows"><i class="fa fa-chevron-right"></i></button>',
	responsive: [
		{
			breakpoint: 768,
			settings: {
				arrows: false,
				slidesToShow: 3, 
			}
		},
		{
			breakpoint: 512,
			settings: {
				arrows: false,
				slidesToShow: 2, 
			}
		}
	],
});