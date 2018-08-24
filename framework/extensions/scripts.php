<?php
/**
 * Scripts
 * WordPress will add these scripts to the theme
 *
 * @package Inti
 * @since 1.0.0
 * @link http://codex.wordpress.org/Function_Reference/wp_register_script
 * @link http://codex.wordpress.org/Function_Reference/wp_enqueue_script
 * @see wp_register_script
 * @see wp_enqueue_script
 * @license GNU General Public License v2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 */

add_action('wp_enqueue_scripts', 'inti_register_scripts', 1);
add_action('wp_enqueue_scripts', 'inti_enqueue_scripts');
 
function inti_register_scripts() {
	// register scripts
	wp_register_script('toastr-js', get_template_directory_uri() . '/library/dist/js/toastr.min.js', array(), filemtime(get_template_directory() . '/library/dist/js/toastr.min.js'), true);
	wp_register_script('inti-js', get_template_directory_uri() . '/library/dist/js/inti.js', array(), filemtime(get_template_directory() . '/library/dist/js/inti.js'), true);

}

function inti_enqueue_scripts() {
	if ( !is_admin() ) { 
		// enqueue scripts
		wp_enqueue_script('jquery');
		wp_enqueue_script('toastr-js');
		wp_enqueue_script('inti-js');

		// comment reply script for threaded comments
		if ( is_singular() && comments_open() && get_option('thread_comments') ) {
			wp_enqueue_script('comment-reply'); 
		}
	}
}