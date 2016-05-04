<?php 
/**
 * Inti Hooks
 * Locations throughout the theme that functionality can be hooked onto
 *
 * @package Inti
 * @since 1.0.0
 */

/**
 * Register hook: inti_hook_head
 *
 * in header.php after wp_head
 * @since 1.0.0
 */
function inti_hook_head() { 
	do_action('inti_hook_head');
}

/**
 * Register hook: inti_hook_site_before
 *
 * in header.php right after body 
 * and before anything else
 * @since 1.0.0 
 */
function inti_hook_site_before() {
	do_action('inti_hook_site_before');
}

/**
 * Register hook: inti_hook_off_canvas
 *
 * in header.php before #page 
 * and after opening body tag
 * @since 1.0.0 
 */
function inti_hook_off_canvas() {
	do_action('inti_hook_off_canvas');
}

/**
 * Register hook: inti_hook_off_canvas_content
 *
 * in header.php before #page 
 * and after opening body tag
 * @since 1.0.0 
 */
function inti_hook_off_canvas_content() {
	do_action('inti_hook_off_canvas_content');
}

/**
 * Register hook: inti_hook_site_after
 *
 * in header.php before #page 
 * and after opening body tag
 * @since 1.0.0 
 */
function inti_hook_site_after() {
	do_action('inti_hook_site_after');
}

/**
 * Register hook: inti_hook_site_header_before
 *
 * in header.php before whole header
 * @since 1.2.6
 */
function inti_hook_site_header_before() {
	do_action('inti_hook_site_header_before');
}

/**
 * Register hook: inti_hook_site_banner_before
 *
 * in header.php before header tag
 * @since 1.0.0 
 */
function inti_hook_site_banner_before() {
	do_action('inti_hook_site_banner_before');
}

/**
 * Register hook: inti_hook_site_banner_site_logo_before
 *
 * in header.php after header tag
 * @since 1.0.0 
 */
function inti_hook_site_banner_site_logo_before() {
	do_action('inti_hook_site_banner_site_logo_before');
}

/**
 * Register hook: inti_hook_site_banner_site_logo_after
 *
 * in header.php where a nav for big screens goes
 * @since 1.0.0 
 */
function inti_hook_site_banner_site_logo_after() {
	do_action('inti_hook_site_banner_site_logo_after');
}

/**
 * Register hook: inti_hook_site_banner_title_area_before
 *
 * in header.php where a nav for small screens goes
 * @since 1.0.0 
 */
function inti_hook_site_banner_title_area_before() {
	do_action('inti_hook_site_banner_title_area_before');
}

/**
 * Register hook: inti_hook_site_banner_title_area_after
 *
 * in header.php where a nav for small screens goes
 * @since 1.0.0 
 */
function inti_hook_site_banner_title_area_after() {
	do_action('inti_hook_site_banner_title_area_after');
}

/**
 * Register hook: inti_hook_site_banner_after
 *
 * in header.php after closing header tag
 * @since 1.0.0 
 */
function inti_hook_site_banner_after() {
	do_action('inti_hook_site_banner_after');
}

/**
 * Register hook: inti_hook_site_header_after
 *
 * in header.php after closing header tag
 * @since 1.2.6 
 */
function inti_hook_site_header_after() {
	do_action('inti_hook_site_header_after');
}

/**
 * Register hook: inti_hook_content_before
 *
 * in page template files, index.php, home.php before #content
 * @since 1.0.0 
 */
function inti_hook_content_before() {
	do_action('inti_hook_content_before');
}

/**
 * Register hook: inti_hook_content_after
 *
 * in page template files, index.php, home.php after #content
 * @since 1.0.0 
 */
function inti_hook_content_after() {
	do_action('inti_hook_content_after');
}

/**
 * Register hook: inti_hook_inner_content_before
 *
 * in page template files, index.php, home.php inside #content
 * before contents starts
 * @since 1.0.0 
 */
function inti_hook_inner_content_before() {
	do_action('inti_hook_inner_content_before');
}

/**
 * Register hook: inti_hook_inner_content_after
 *
 * in page template files, index.php, home.php inside #content
 * after contents ends
 * @since 1.0.0 
 */
function inti_hook_inner_content_after() {
	do_action('inti_hook_inner_content_after');
}

/**
 * Register hook: inti_hook_sidebar_before
 *
 * in page template files, index.php, home.php before #sidebar
 * @since 1.0.0 
 */
function inti_hook_sidebar_before() {
	do_action('inti_hook_sidebar_before');
}

/**
 * Register hook: inti_hook_sidebar_before
 *
 * in page template files, index.php, home.php after #sidebar
 * @since 1.0.0 
 */
function inti_hook_sidebar_after() {
	do_action('inti_hook_sidebar_after');
}

/**
 * Register hook: inti_hook_loop_before
 *
 * 
 * @since 1.0.0
 */
function inti_hook_loop_before() {
	do_action('inti_hook_loop_before');
}

/**
 * Register hook: inti_hook_loop_after
 *
 * 
 * @since 1.0.0
 */
function inti_hook_loop_after() {
	do_action('inti_hook_loop_after');
}

/**
 * Register hook: inti_hook_loop_else
 *
 * 
 * @since 1.0.0
 */
function inti_hook_loop_else() {
	do_action('inti_hook_loop_else');
}

/**
 * Register hook: inti_hook_post_before
 *
 * 
 * @since 1.0.0
 */
function inti_hook_post_before() {
	do_action('inti_hook_post_before');
}

/**
 * Register hook: inti_hook_post_header_before
 *
 * 
 * @since 1.0.0
 */
function inti_hook_post_header_before() {
	do_action('inti_hook_post_header_before');
}

/**
 * Register hook: inti_hook_post_header
 *
 * 
 * @since 1.0.0
 */
function inti_hook_post_header() {
	do_action('inti_hook_post_header');
}

/**
 * Register hook: inti_hook_post_header_after
 *
 * 
 * @since 1.0.0
 */
function inti_hook_post_header_after() {
	do_action('inti_hook_post_header_after');
}

/**
 * Register hook: inti_hook_post_content_before_the_content
 *
 * 
 * @since 1.0.0
 */
function inti_hook_post_content_before_the_content() {
	do_action('inti_hook_post_content_before_the_content');
}

/**
 * Register hook: inti_hook_post_content_after_the_content
 *
 * 
 * @since 1.0.0
 */
function inti_hook_post_content_after_the_content() {
	do_action('inti_hook_post_content_after_the_content');
}

/**
 * Register hook: inti_hook_post_footer
 *
 * 
 * @since 1.0.0
 */
function inti_hook_post_footer() {
	do_action('inti_hook_post_footer');
}

/**
 * Register hook: inti_hook_post_after
 *
 * 
 * @since 1.0.0
 */
function inti_hook_post_after() {
	do_action('inti_hook_post_after');
}

/**
 * Register hook: inti_hook_page_before
 *
 * 
 * @since 1.0.0
 */
function inti_hook_page_before() {
	do_action('inti_hook_page_before');
}

/**
 * Register hook: inti_hook_page_header_before
 *
 * 
 * @since 1.0.0
 */
function inti_hook_page_header_before() {
	do_action('inti_hook_page_header_before');
}

/**
 * Register hook: inti_hook_page_header
 *
 * 
 * @since 1.0.0
 */
function inti_hook_page_header() {
	do_action('inti_hook_page_header');
}

/**
 * Register hook: inti_hook_page_header_after
 *
 * 
 * @since 1.0.0
 */
function inti_hook_page_header_after() {
	do_action('inti_hook_page_header_after');
}

/**
 * Register hook: inti_hook_page_content_before_the_content
 *
 * 
 * @since 1.0.0
 */
function inti_hook_page_content_before_the_content() {
	do_action('inti_hook_page_content_before_the_content');
}

/**
 * Register hook: inti_hook_page_content_after_the_content
 *
 * 
 * @since 1.0.0
 */
function inti_hook_page_content_after_the_content() {
	do_action('inti_hook_page_content_after_the_content');
}
/**
 * Register hook: inti_hook_page_footer
 *
 * 
 * @since 1.0.0
 */
function inti_hook_page_footer() {
	do_action('inti_hook_page_footer');
}

/**
 * Register hook: inti_hook_page_after
 *
 * 
 * @since 1.0.0
 */
function inti_hook_page_after() {
	do_action('inti_hook_page_after');
}

/**
 * Register hook: inti_hook_footer_before
 *
 * 
 * @since 1.0.0
 */
function inti_hook_footer_before() {
	do_action('inti_hook_footer_before');
}

/**
 * Register hook: inti_hook_footer_inside
 *
 * 
 * @since 1.0.0
 */
function inti_hook_footer_inside() {
	do_action('inti_hook_footer_inside');
}

/**
 * Register hook: inti_hook_footer_after
 *
 * 
 * @since 1.0.0
 */
function inti_hook_footer_after() {
	do_action('inti_hook_footer_after');
}

/**
 * Register hook: inti_hook_footer
 *
 * 
 * @since 1.0.0
 */
function inti_hook_footer() {
	do_action('inti_hook_footer');
}