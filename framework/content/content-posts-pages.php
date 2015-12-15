<?php
/**
 * Content - Posts and Pages
 * add content to predefined hooks
 * found throughout the theme
 *
 * @package Inti
 * @since 1.0.0
 * @license GNU General Public License v2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 */


/**
 * Page Title 
 * Title for the <header> of each page, we don't show this on a front-page
 * 
 * @since 1.0.0
 */
function inti_do_page_header_title() {
	if ( !is_page_template('page-templates/front-page.php') ) : 
		if ( !is_search() ) :
		?>
			<h1 class="entry-title"><?php the_title(); ?></h1>
		<?php else : ?>
			<h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __('%s', 'inti'), the_title_attribute('echo=0') ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
		<?php endif;
	endif;
}
add_action('inti_hook_page_header', 'inti_do_page_header_title');


/**
 * WooCommerce Wrappers
 * Add wrapper before and after the loop on WC pages
 * 
 * @since 1.0.1
 * @see http://docs.woothemes.com/document/third-party-custom-theme-compatibility/
 * 
 */

function inti_woo_wrapper_start() { ?>
	<div class="row">
		<div class="large-8 columns">
<?php }

add_action('woocommerce_before_main_content', 'inti_woo_wrapper_start', 10);

function inti_woo_wrapper_end() { ?> 
		</div><!-- .columns -->
<?php }

add_action('woocommerce_after_main_content', 'inti_woo_wrapper_end', 10);

function inti_woo_after_sidebar() { ?> 
	</div><!-- .row -->
<?php }

add_action('woocommerce_sidebar', 'inti_woo_after_sidebar', 999);


/**
 * Post featured tag
 * Add a label when a post is set as sticky in WordPress
 * 
 * @since 1.0.0
 */
function inti_do_standard_format_sticky() { 
	if ( is_sticky() ) { ?>
		<div class="entry-meta">
			<span class="label sticky-post"><?php echo apply_filters('inti_featured_post_title', __('Featured Post', 'inti')); ?></span>
		</div>
<?php }
}
add_action('inti_hook_post_header', 'inti_do_standard_format_sticky', 2);


/**
 * Post header title for Standard post format
 * Title for the <header> of each post, different for displaying on an archive and on a single
 * 
 * @since 1.0.0
 */
function inti_do_standard_format_header_titles() {
	if ( is_page_template('page-templates/front-page.php') ) { ?>
		<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __('%s', 'inti'), the_title_attribute('echo=0') ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
	<?php }
	elseif ( !get_post_format() && !is_page_template('page-templates/front-page.php') ) {  ?>    
		<?php if ( is_single() ) { ?>
		<h1 class="entry-title"><?php the_title(); ?></h1>
		<?php } else { ?>
		<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __('%s', 'inti'), the_title_attribute('echo=0') ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
		<?php } ?>
<?php }
}
add_action('inti_hook_post_header', 'inti_do_standard_format_header_titles', 3);


/**
 * Post thumbnail/featured image displayed when in archives and "short"
 * blog style is chosen in theme options
 * 
 * @since 1.0.0
 */
function inti_do_post_thumbnail() {   
	$blog_style = get_inti_option('blog_interface', 'inti_general_options');  
	if ( has_post_thumbnail() && $blog_style == 1 ) { ?>

		<div class="entry-thumbnail">
			<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail(); ?></a>
		</div>
	<?php }
}
add_action('inti_hook_post_header', 'inti_do_post_thumbnail', 4);
  

/**
 * Post footer title 
 * Some formats have their titles in the post <footer>
 * i.e. format-audio, format-gallery, format-image, format-video
 * 
 * @since 1.0.0
 */
function inti_do_post_footer_title() {
$format = ( get_post_format() ) ? get_post_format() : 'standard'; 

	switch ( $format ) { 
		case 'audio' : 
		case 'gallery' :
		case 'image' :
		case 'video' : ?>
		
			<h2 class="entry-title">
				<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __('%s', 'inti'), the_title_attribute('echo=0') ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
			</h2>
			   
		<?php break; 
	}
}
add_action('inti_hook_post_footer', 'inti_do_post_footer_title', 1);


/**
 * Post header meta
 * Add the post meta in all formats' <header>
 * By default, inti_get_post_header_meta() returns author, time, categories
 * 
 * @since 1.0.0
 */
function inti_do_post_header_meta() {
	$format = ( get_post_format() ) ? get_post_format() : 'standard'; 
	$show_meta_in_header = true;

	if (current_theme_supports('inti-post-header-meta') && $show_meta_in_header && $format == "standard" ) { 
		echo inti_get_post_header_meta();
	}
}
add_action('inti_hook_post_header', 'inti_do_post_header_meta', 3);


/**
 * Post footer meta
 * Add the post meta in all formats' <footer>
 * By default, inti_get_post_footer_meta() returns tags
 * 
 * @since 1.0.0
 */
function inti_do_post_footer_meta() {
	$format = ( get_post_format() ) ? get_post_format() : 'standard'; 
	$show_meta_in_header = true; // in some post formats, the footer is the header


	// Single posts always get meta in the footer
	if (is_single()) echo inti_get_post_footer_meta();

	// Post formats that have their footer as a header get meta in their footer
	if (current_theme_supports('inti-post-header-meta') && $show_meta_in_header) { 
		switch ( $format ) { 
			case 'audio' : 
			case 'gallery' :
			case 'image' :
			case 'video' : 
				// But not if they already have it
				if (!is_single()) {
					echo inti_get_post_footer_meta();
				}
				
			break; 
		}
	}
	
}
add_action('inti_hook_post_footer', 'inti_do_post_footer_meta', 2);


/**
 * Content Split Links
 * in the footer of format-page
 * 
 * @since 1.0.0
 */
function inti_do_post_content_split_links() { 
	$format = ( get_post_format() ) ? get_post_format() : 'standard'; 
	$defaults = array(
		'before'      => '<nav class="page-links"><span>' . __('Keep reading:', 'inti') . '</span><ul class="pagination">',
		'after'       => '</ul></nav>',
		'link_before' => '',
		'link_after'  => '',
		'separator'   => '',
		'pagelink'    => '%',
		'echo'        => 1
	);

	switch ( $format ) { 
		case 'standard' : 
		case 'chat' :
			inti_do_post_page_split_links( $defaults );
		break; 
	}
}
add_action('inti_hook_post_content_after_the_content', 'inti_do_post_content_split_links');


/**
 * Content Split Links
 * When a <!––nextpage––> tag exists, do pagination
 * 
 * @since 1.0.0
 */
function inti_do_page_content_split_links() { 	
	$defaults = array(
		'before'      => '<nav class="page-links"><span>' . __('Keep reading:', 'inti') . '</span><ul class="pagination">',
		'after'       => '</ul></nav>',
		'link_before' => '',
		'link_after'  => '',
		'separator'   => '',
		'pagelink'    => '%',
		'echo'        => 1
	);
	inti_do_post_page_split_links( $defaults );
}
add_action('inti_hook_page_footer', 'inti_do_page_content_split_links');


/**
 * Post footer edit 
 * in single.php
 * 
 * @since 1.0.0
 */
function inti_do_post_edit() {
	if ( is_single() ) {
		edit_post_link( __('Edit', 'inti'), '<div class="edit-link"><span>', '</span></div>');
	}
}
add_action('inti_hook_post_footer', 'inti_do_post_edit', 4);


/**
 * Page Edit 
 * Add an edit button for a page in the page footer
 * 
 * @since 1.0.0
 */
function inti_do_page_edit() { 
	edit_post_link( __('Edit', 'inti'), '<div class="edit-link"><span>', '</span></div>');
}
add_action('inti_hook_page_footer', 'inti_do_page_edit');


/**
 * Single post navigation
 * Add links to the next and previous posts on a single post
 * 
 * @since 1.0.0
 */
function inti_do_nav_single() {
	if ( is_single() ) { 
	$exclude = ( get_inti_option('frontpage_exclude_cat', 'inti_general_options', 1) ) ? get_inti_option('frontpage_post_category', 'inti_general_options', -1) : ''; ?>
		<nav class="nav-single">
			<span class="nav-previous alignleft">
			<?php previous_post_link('%link', '<span class="meta-nav">' . _x('&larr;', 'Previous post link', 'inti') . '</span> %title', false, $exclude); ?>
			</span>
			<span class="nav-next alignright">
			<?php next_post_link('%link', '%title <span class="meta-nav">' . _x('&rarr;', 'Next post link', 'inti') . '</span>', false, $exclude); ?>
			</span>
		</nav><!-- .nav-single -->
<?php }
}
add_action('inti_hook_post_after', 'inti_do_nav_single', 1);


?>