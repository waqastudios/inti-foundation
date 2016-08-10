<?php
/**
 * Add SRCSET to non-content images
 * Make images uploaded in Customizer or Theme Options,
 * that don't pass through the WP 4.4 filter responsive
 *
 * @package Inti
 * @since 1.0.0
 * @license GNU General Public License v2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 */

function inti_get_srcset_image ($url, $alt){

	$attachment_id = inti_get_attachment_id($url);
	$img_html = '';
	$img_html .= '<img src="' . $url . '" alt="' . $alt . '">';

	if ($url == "") return "";

	if ($attachment_id == 0) {
		// D'oh - Just return the non-responsive URL
		return $img_html;

	} else {
		if (function_exists('wp_image_add_srcset_and_sizes')){
			$final_image = wp_image_add_srcset_and_sizes($img_html, wp_get_attachment_metadata( $attachment_id, false ), $attachment_id);
			return $final_image;
		} else {
			return $img_html;
		}
	}
}


function inti_do_srcset_image ($url, $alt){
	echo inti_get_srcset_image ($url, $alt);
}