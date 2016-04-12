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
	<div class="off-canvas-wrapper">
		<div class="off-canvas-wrapper-inner" data-off-canvas-wrapper>
			<div class="off-canvas-menu off-canvas position-left" id="inti-off-canvas-menu" data-off-canvas data-position="left">
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
		</div><!-- .off-canvas-wrapper-inner -->
	</div><!-- .off-canvas-wrapper -->
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
		<div class="row">
			<nav class="top-bar" id="top-bar-menu">
			<?php 
				/**
				* Add logo or site title to the navigation bar, in addition or instead of having the site banner
				*/
				$mobilebanner = get_inti_option('show_nav_logo_title', 'inti_customizer_options', 'none');

				if ($mobilebanner != 'none') :
			?>
				<div class="top-bar-left float-left hide-for-mlarge mobile-banner">
					<ul class="menu">
						<li class="menu-text site-logo">
							<?php if ( get_inti_option('nav_logo_image', 'inti_customizer_options') ) : ?>
								<?php inti_do_srcset_image(get_inti_option('nav_logo_image', 'inti_customizer_options'), esc_attr( get_bloginfo('name', 'display') . ' logo')); ?>
							<?php endif; ?>
						</li>
						<li class="menu-text site-title"><?php bloginfo('name'); ?></li>
					</ul>
				</div>
			<?php endif; ?>
				<div class="top-bar-left show-for-mlarge main-dropdown-menu">
					<?php echo inti_get_dropdown_menu();
					$showsocial = get_inti_option('nav_social', 'inti_headernav_options');
					if ($showsocial) echo inti_get_dropdown_social_links(); 
					?>
				</div>
				<div class="top-bar-right float-right hide-for-mlarge">
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
			</nav>
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