<?php
/**
 * Content - Header, Site Banner, Menus, Off-canvas
 * add content to predefined hooks
 * found throughout the theme
 *
 * @package Inti
 * @since 1.0.0
 * @license GNU General Public License v2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 */


/**
 * Head goes in the head
 * Add our <head> template into the <head>
 * 
 * @since 1.0.0
 */
function inti_do_inti_head() { 
	get_template_part('template-parts/part-head');
}
add_action('wp_head', 'inti_do_inti_head', 1);


/**
 * Custom JS
 * Add custom JS from theme options into the <head>
 * 
 * @since 1.0.0
 */
function inti_do_head_js() { 
	$customjs = stripslashes(get_inti_option('head_js', 'inti_headernav_options'));
	if ( $customjs ) { ?>
		<!-- Custom JS -->
		<script>
			<?php echo $customjs; ?>
		</script>
		<!-- End Custom JS -->
<?php 
	}
}
add_action('inti_hook_head', 'inti_do_head_js', 1);


/**
 * Custom CSS
 * Add custom CSS from theme options into the <head>
 * 
 * @since 1.0.0
 */
function inti_do_head_css() { 
	$customcss = stripslashes(get_inti_option('head_css', 'inti_headernav_options'));
	if ( $customcss ) { ?>
		<!-- Custom CSS -->
		<style>
			<?php echo $customcss; ?>
		</style>
		<!-- End Custom CSS -->
<?php 
	}
}
add_action('inti_hook_head', 'inti_do_head_css', 1);


/**
 * Custom Meta Tags
 * Add custom meta tags from theme options into the <head>
 * 
 * @since 1.0.0
 */
function inti_do_head_meta() { 
	$custommeta = stripslashes(get_inti_option('head_meta', 'inti_headernav_options'));
	if ( $custommeta ) { ?>
		<!-- Custom Meta Tags -->
		<?php echo $custommeta; ?>
		<!-- End Custom Meta Tags -->
<?php 
	}
}
add_action('inti_hook_head', 'inti_do_head_meta', 1);


/**
 * Custom Code first thing inside <body>
 * 
 * @since 1.0.0
 */
function inti_do_body_inside() { 
	$custombodyinside = get_inti_option('body_inside', 'inti_headernav_options');
	if ( $custombodyinside ) { ?>
		<?php echo trim($custombodyinside); ?>
<?php 
	}
}
add_action('inti_hook_site_before', 'inti_do_body_inside', 1);


/**
 * Add opening wrappers for default off-canvas menu behaviour
 * 
 * @since 1.0.0
 */
function inti_do_site_off_canvas_header() {
	?>
	<div class="off-canvas-menu off-canvas position-right" id="inti-off-canvas-menu" data-off-canvas>
		<?php inti_hook_off_canvas(); ?>
	</div>
	<div class="off-canvas-content" data-off-canvas-content>
		<?php inti_hook_off_canvas_content(); ?>
	<?php
}
add_action('inti_hook_site_before', 'inti_do_site_off_canvas_header');


/**
 * Add closing wrappers for default off-canvas menu behaviour
 * 
 * @since 1.0.0
 */
function inti_do_site_off_canvas_footer() {
	?>
	</div><!-- .off-canvas-wrapper-content -->

	<?php
}
add_action('inti_hook_site_after', 'inti_do_site_off_canvas_footer');


/**
 * Add main menu before or after site banner
 * add or remove .row to control max width
 * 
 * @since 1.0.0
 */
function inti_do_main_dropdown_menu() {
   //adds the main menu
	if ( has_nav_menu('dropdown-menu') ) {?>	
		<div id="site-banner-sticky-container" class="sticky-container" data-sticky-container>
			<div class="sticky" data-sticky data-sticky-on="small" data-top-anchor="primary" data-margin-top="0">	
				<nav class="top-bar" id="top-bar-menu">
					<div class="row column">
					<?php

					/**
					* Add logo or site title to the navigation bar
					* i. if one is set for the 'mobile nav' in customizer
					* ii. if a different one is to be shown on the nav bar if it's currently sticky
					*/
					$mobile_logo = get_inti_option('show_nav_logo_title', 'inti_customizer_options', 'none');
					$sticky_logo = get_inti_option('show_sticky_logo_title', 'inti_customizer_options', 'none');
					
					// logo in nav on small screens
					if ('none' != $mobile_logo) : ?>
						<div class="top-bar-left hide-for-mlarge mobile-logo">
							<div class="site-logo">
								<?php if ( get_inti_option('nav_logo_image', 'inti_customizer_options') ) : ?>
									<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
										<?php inti_do_srcset_image(get_inti_option('nav_logo_image', 'inti_customizer_options'), esc_attr( get_bloginfo('name', 'display') . ' logo')); ?>
									</a>
								<?php endif; ?>
							</div>
							<div class="site-title"><?php bloginfo('name'); ?></div>
						</div>

					<?php endif; 

					// logo on nav when sticky (needs CSS _navigation.scss)
					if ('none' != $sticky_logo) : ?>
						<div class="top-bar-left show-for-mlarge sticky-logo animated fadeInLeft">
							<div class="site-logo">
								<?php if ( get_inti_option('nav_logo_image', 'inti_customizer_options') ) : ?>
									<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
										<?php inti_do_srcset_image(get_inti_option('nav_logo_image', 'inti_customizer_options'), esc_attr( get_bloginfo('name', 'display') . ' logo')); ?>
									</a>
								<?php endif; ?>
							</div>
							<div class="site-title"><?php bloginfo('name'); ?></div>
						</div>

					<?php endif; ?>
						<div class="top-bar-left show-for-mlarge main-dropdown-menu">
							<?php echo inti_get_dropdown_menu();
							$showsocial = get_inti_option('nav_social', 'inti_headernav_options');
							if ($showsocial) echo inti_get_dropdown_social_links(); 
							?>
						</div>
						<div class="top-bar-right hide-for-mlarge">
							<ul class="menu">
								<li class="menu-text off-canvas-button"><a data-toggle="inti-off-canvas-menu">
									<div class="hamburger">
										<span></span>
										<span></span>
										<span></span>
									</div>
								</a></li>
							</ul>
						</div>
					</div>
				</nav>
			</div>
		</div>
	<?php
	}
}
add_action('inti_hook_site_banner_after', 'inti_do_main_dropdown_menu');


/**
 * Add main offcanvas menu
 * 
 * @since 1.0.0
 */
function inti_do_main_off_canvas_menu() {
   //adds the main menu
	if ( has_nav_menu('off-canvas-menu') ) {
		echo inti_get_drilldown_menu();
		$showsocial = get_inti_option('nav_social', 'inti_headernav_options');
		if ($showsocial) echo inti_get_off_canvas_social_links();
	}
}
add_action('inti_hook_off_canvas', 'inti_do_main_off_canvas_menu');


?>