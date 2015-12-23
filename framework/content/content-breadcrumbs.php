<?php
/**
 * Content - Breadcrumbs
 * add content to predefined hooks
 * found throughout the theme
 *
 * @package Inti
 * @since 1.0.0
 * @license GNU General Public License v2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 */


/**
 * Breadcrumbs at the top
 * Add breadcrumb links before the main content block
 * 
 * @since 1.0.1
 */
function inti_do_content_before_breadcrumbs() { 
	if ( current_theme_supports('inti-breadcrumbs') ) {
		if ( get_inti_option('breadcrumbs', 'inti_general_options') == "top"  || get_inti_option('breadcrumbs', 'inti_general_options') == "topbottom" ) { ?>
			<div class="breadcrumbs top">
				<div class="row">
					<div class="columns">
						<?php echo inti_get_breadcrumbs(); ?>
					</div><!-- .columns -->
				</div><!-- .row -->
			</div><!-- .breadcrumbs -->
<?php 
		}
	}
}
add_action('inti_hook_content_before', 'inti_do_content_before_breadcrumbs', 1);


/**
 * Breadcrumbs at the bottom
 * Add breadcrumb links after the main content block
 * 
 * @since 1.0.1
 */
function inti_do_content_after_breadcrumbs() { 
	if ( current_theme_supports('inti-breadcrumbs') ) {
		if ( get_inti_option('breadcrumbs', 'inti_general_options') == "bottom"  || get_inti_option('breadcrumbs', 'inti_general_options') == "topbottom" ) { ?>
			<div class="breadcrumbs bottom">
				<div class="row">
					<div class="columns">
						<?php echo inti_get_breadcrumbs(); ?>
					</div><!-- .columns -->
				</div><!-- .row -->
			</div><!-- .breadcrumbs -->
<?php 
		}
	}
}
add_action('inti_hook_content_after', 'inti_do_content_after_breadcrumbs', 1);


?>