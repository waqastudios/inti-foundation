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
	$pagination_type = get_inti_option('pagination', 'inti_general_options');
	
	if ( is_page_template('page-templates/front-page.php') && current_theme_supports('inti-pagination') ) {
		$show_page_links = get_inti_option('frontpage_page_links', 0);
		if ( $show_page_links ) {
			inti_filter_archive_pagination( array('query' => 'frontpage_query', 'type' => $pagination_type) );
		}
	} elseif ( current_theme_supports('inti-pagination') ) {
		inti_filter_archive_pagination( array('type' => $pagination_type) );
	}
}
add_action('inti_hook_inner_content_after', 'inti_do_archive_pagination', 1);


/**
 * Archive Headers
 * For every archive template, add a header area
 * to display archive meta
 * 
 * @since 1.10.0
 */
function inti_do_archive_header() {
	if ( have_posts() && is_category() ) : ?>		
		<header class="archive-header">
			<div class="grid-container">
				<h1 class="archive-title"><?php printf( __('Category: %s', 'inti'), '<span>' . single_cat_title( '', false ) . '</span>'); ?></h1>

				<?php // show an optional category description 
				if ( category_description() ) : ?>
					<div class="archive-meta">
					<?php echo category_description(); ?>
					</div>
				<?php endif; ?>
			</div>
		</header><!-- .archive-header -->
	<?php
	elseif ( have_posts() && is_tag() ) : ?>		
		<header class="archive-header">
			<div class="grid-container">
				<h1 class="archive-title"><?php printf( __('Category: %s', 'inti'), '<span>' . single_cat_title( '', false ) . '</span>'); ?></h1>

				<?php // show an optional category description 
				if ( category_description() ) : ?>
					<div class="archive-meta">
					<?php echo category_description(); ?>
					</div>
				<?php endif; ?>
			</div>
		</header><!-- .archive-header -->
	<?php
	elseif ( have_posts() && is_search() ) : ?>		
		<header class="archive-header">
			<div class="grid-container">
				<h1 class="archive-title">
					<?php printf( __('Search Results for: %s', 'inti'), '<span>' . get_search_query() . '</span>'); ?>
				</h1>
			</div>
		</header> 
	<?php
	elseif ( have_posts() && is_author() ) : the_post(); ?>
		<header class="archive-header">
			<div class="grid-container">
				<h1 class="archive-title"><?php _e('About:', 'inti'); ?> <span class="vcard"> <?php the_author() ?></span></h1>
				<?php rewind_posts(); ?>
				<?php if ( get_the_author_meta( 'description' ) ) : ?>
				<div class="archive-meta grid-x">
					<div class="small-2 cell">
						<?php echo get_avatar( get_the_author_meta('ID'), apply_filters('inti_status_avatar', '64') ); ?>
						<p class="entry-author"><?php the_author(); ?></p>
					</div>
					<div class="small-10 cell">
						<?php the_author_meta( 'description' ); ?>
					</div>
				</div>
				<?php endif; ?>
			</div>
		</header><!-- .archive-header -->
	<?php
	elseif ( have_posts() && is_archive() ) : ?>
		<header class="archive-header">
			<div class="grid-container">
				<h1 class="archive-title"><?php
					if ( is_day() ) :
						printf( __('Daily Archives: %s', 'inti'), '<span>' . get_the_date() . '</span>');
					elseif ( is_month() ) :
						printf( __('Monthly Archives: %s', 'inti'), '<span>' . get_the_date( _x('F Y', 'monthly archives date format', 'inti') ) . '</span>');
					elseif ( is_year() ) :
						printf( __('Yearly Archives: %s', 'inti'), '<span>' . get_the_date( _x('Y', 'yearly archives date format', 'inti') ) . '</span>');
					else :
						_e('Archives', 'inti');
					endif;
				?></h1>
			</div>
		</header><!-- .archive-header -->
	<?php
	endif;
}
add_action('inti_hook_inner_content_before', 'inti_do_archive_header', 1);
?>