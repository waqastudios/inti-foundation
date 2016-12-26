<?php
/**
 * Typography
 * Enqueues fonts to be used across the theme
 *
 * @package Inti
 * @author Anthony Wilhelm (@awshout / anthonywilhelm.com)
 * @since 1.0.0
 * @author Ben Word (@retlehs / rootstheme.com (nav.php))
 * @link http://codex.wordpress.org/Function_Reference/Walker_Class
 * @license GNU General Public License v2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 */


/**
 * Add Fonts
 * Checks font options to see if a Google font is selected.
 * If so, inti_do_typography_enqueue_google_font is called to enqueue the font.
 *
 * http://wptheming.com/2012/06/loading-google-fonts-from-theme-options/
 */
 
// standard fonts
if ( !function_exists('inti_get_typography_os_fonts') ) {
	function inti_get_typography_os_fonts(){
		
		$os_faces = array(
			"Arial, Helvetica, sans-serif" => "Arial",
			"'Avant Garde', sans-serif" => "Avant Garde",
			"Cambria, Georgia, serif" => "Cambria",
			"Garamond, 'Hoefler Text', 'Times New Roman', Times, serif" => "Garamond",
			"Georgia, serif" => "Georgia",
			"'Helvetica Neue', Helvetica, Arial, sans-serif" => "Helvetica Neue",
			"Tahoma, Geneva, sans-serif" => "Tahoma",
			"'Times New Roman', Times, serif" => "Times New Roman");	
		$os_faces = apply_filters('inti_filter_get_typography_os_fonts', $os_faces);
		return $os_faces;
	}
}

// google fonts
if ( !function_exists('inti_get_typography_google_fonts') ) {
	function inti_get_typography_google_fonts(){
	
		$google_faces = array(
			"'Arvo', serif" => "Arvo",
			"'Copse', sans-serif" => "Copse",
			"'Cabin', sans-serif" => "Cabin",
			"'Droid Sans', sans-serif" => "Droid Sans",
			"'Droid Serif', serif" => "Droid Serif",
			"'Josefin Slab', serif" => "Josefin Slab",
			"'Lato', sans-serif" => "Lato",
			"'Lobster', cursive" => "Lobster",
			"'Nobile', sans-serif" => "Nobile",
			"'Open Sans', sans-serif" => "Open Sans",
			"'Oswald', sans-serif" => "Oswald",
			"'Pacifico', cursive" => "Pacifico",
			"'Roboto', sans-serif" => "Roboto",
			"'Rokkitt', serif" => "Rokkit",
			"'PT Sans', sans-serif" => "PT Sans",
			"'Quattrocento', serif" => "Quattrocento",
			"'Raleway', cursive" => "Raleway",
			"'Titillium Web', sans-serif" => "Titillium Web",
			"'Ubuntu', sans-serif" => "Ubuntu",
			"'Vollkorn', serif" => "Vollkorn",
			"'Yanone Kaffeesatz', sans-serif" => "Yanone Kaffeesatz");
		$google_faces = apply_filters('inti_filter_get_typography_google_fonts', $google_faces);
		return $google_faces;
	}
}

// font sizes
if ( !function_exists('inti_get_typography_font_sizes') ) {
	function inti_get_typography_font_sizes(){
	
		$fontsizes = array(
			"80%" => "20% Smaller",
			"100%" => "Default",
			"120%" => "20% Bigger",
			"140%" => "40% Bigger",
			"160%" => "60% Bigger",
			"180%" => "80% Bigger",
			"200%" => "100% Bigger");

		$fontsizes = apply_filters('inti_filter_get_typography_font_sizes', $fontsizes);
		return $fontsizes;
	}
}

/**
 * Create an array of fonts to be enqueued
 *
 * @since 1.0.0
 * @version 1.2.10
 */
if ( !function_exists('inti_do_typography_google_fonts') ) {
	function inti_do_typography_google_fonts(){
		$all_google_fonts = array_keys( inti_get_typography_google_fonts() );
		// Get the font face for each option and put it in an array
		$title_font = get_inti_option('title_font', 'inti_customizer_options', "'Helvetica Neue', Helvetica, Arial, sans-serif");
		$paragraph_font = get_inti_option('paragraph_font', 'inti_customizer_options', "'Open Sans', sans-serif");
		$h1_font = get_inti_option('h1_font', 'inti_customizer_options', "'Open Sans', sans-serif");
		$h2_font = get_inti_option('h2_font', 'inti_customizer_options', "'Open Sans', sans-serif");
		$h3_font = get_inti_option('h3_font', 'inti_customizer_options', "'Open Sans', sans-serif");
		$h4_font = get_inti_option('h4_font', 'inti_customizer_options', "'Open Sans', sans-serif");
		$h5_font = get_inti_option('h5_font', 'inti_customizer_options', "'Open Sans', sans-serif");
		$h6_font = get_inti_option('h6_font', 'inti_customizer_options', "'Open Sans', sans-serif");
		$selected_fonts = array(
			$title_font,
			$paragraph_font,
			$h1_font,
			$h2_font,
			$h3_font,
			$h4_font,
			$h5_font,
			$h6_font );
		$selected_fonts = apply_filters('inti_filter_do_typography_google_fonts', $selected_fonts);
		// Remove any duplicates in the list
		$selected_fonts = array_unique( $selected_fonts );
		// Check each of the unique fonts against the defined Google fonts

		// Choose which weights/styles to enqueue
		$weights = "400,600";
		$weights = apply_filters('inti_filter_do_typography_weights', $weights);

		// If it is a Google font, go ahead and call the function to enqueue it
		foreach ( $selected_fonts as $font ){
			if ( in_array( $font, $all_google_fonts ) ){
				inti_do_typography_enqueue_google_font( $font, $weights );
			}
		}
	}
	add_action('wp_enqueue_scripts', 'inti_do_typography_google_fonts');
}

/**
 * Enqueues the Google $font that is passed
 *
 * @since 1.0.0
 */
if ( !function_exists('inti_do_typography_enqueue_google_font') ) {
	function inti_do_typography_enqueue_google_font( $font, $weights ){
		$font = explode( ',', $font );
		$font = $font[0];
		$font = preg_replace( '/[^A-Za-z0-9 ]/', '', $font );
		$font = str_replace( ' ', '+', $font );
		$handle = 'typography-' . $font;
		$src = '//fonts.googleapis.com/css?family=' . $font . ":" . $weights;
		wp_enqueue_style( $handle, $src, false, false, 'all' );
	}
}