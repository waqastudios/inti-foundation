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

