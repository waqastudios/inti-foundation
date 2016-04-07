<?php
/**
 * @package Inti
 * @author Waqa Studios
 * @since 1.0.0
 * @version 1.0.8
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/WebDevStudios/CMB2
 */


/**
 * Conditionally displays a metabox when used as a callback in the 'show_on_cb' cmb2_box parameter
 */
function inti_show_if_front_page( $cmb ) {
	// Don't show this metabox if it's not the front page template
	if ( $cmb->object_id !== get_option( 'page_on_front' ) ) {
		return false;
	}
	return true;
}

/**
 * Conditionally hides a metabox when used as a callback in the 'show_on_cb' cmb2_box parameter
 */
function inti_hide_if_front_page( $cmb ) {
	// Don't show this metabox if it IS the front page template
	if ( $cmb->object_id !== get_option( 'page_on_front' ) ) {
		return true;
	}
	return false;
}

add_action( 'cmb2_init', 'inti_register_layout_metabox' );
/**
 * Hook in and add a layout metabox. Can only happen on the 'cmb2_init' hook.
 */
function inti_register_layout_metabox() {
	// Start with an underscore to hide fields from custom fields list
	$prefix = '_inti_layout_';

	$cmb_layout = new_cmb2_box( array(
		'id'            => $prefix . 'metabox',
		'title'         => __( 'Layout', 'inti' ),
		'object_types'  => array( 'page', 'post' ), // Post type
		// 'show_on_cb' => 'inti_hide_if_front_page', // function should return a bool value
		'context'    => 'side',
		'priority'   => 'core',
		// 'show_names' => true, // Show field names on the left
		// 'cmb_styles' => false, // false to disable the CMB stylesheet
		// 'closed'     => true, // true to keep the metabox closed by default
	) );	

	$cmb_layout->add_field( array(
		'name'    => __( 'Page Layout', 'inti' ),
		'desc'    => __( 'Decide whether to show or hide a sidebar and where to place it.', 'inti' ),
		'id'      => $prefix . 'radio',
		'type'    => 'radio',
		'default' => 'default',
		'options' => inti_get_theme_layouts(true) // get theme layouts, with customizer default = true
	) );

}