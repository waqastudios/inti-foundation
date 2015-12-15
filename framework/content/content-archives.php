<?php
/**
 * Content - Archives
 * add content to predefined hooks
 * found throughout the theme
 *
 * @package Inti
 * @since 1.0.0
 * @license GNU General Public License v2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 */

/**
 * No Posts
 * When a loop finds no posts, get the 'none'
 * post format from post-formats and display it
 * 
 * @since 1.0.0
 */
function inti_do_loop_else() {
	get_template_part('post-formats/format', 'none');
}
add_action('inti_hook_loop_else', 'inti_do_loop_else', 1);


/**
 * Pagination for Archives
 * Either "older/newer" or numbered navigation to view pages of posts
 * Displayed on the default front page template with a loop of posts, 
 * and of course on all archive pages after the loop
 * 
 * @since 1.0.0
 */
function inti_do_archive_pagination() {
	$pagination_type = get_inti_option('inti_general_options', 'pagination');
	
	if ( is_page_template('page-templates/front-page.php') && current_theme_supports('inti-pagination') ) {
		$show_page_links = get_inti_option('frontpage_page_links', 0);
		if ( $show_page_links ) {
			inti_filter_archive_pagination( array('query' => 'frontpage_query', 'type' => $pagination_type) );
		}
	} elseif ( current_theme_supports('inti-pagination') ) {
		inti_filter_archive_pagination( array('type' => $pagination_type) );
	}
}
add_action('inti_hook_loop_after', 'inti_do_archive_pagination', 1);


?>