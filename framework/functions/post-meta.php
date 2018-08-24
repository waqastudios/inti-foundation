<?php 
/**
 * Post Meta
 *
 * @package Inti
 * @author Anthony Wilhelm (@awshout / anthonywilhelm.com)
 * @since 1.0.0
 * @param $args Optional. Override defaults.
 * @license GNU General Public License v2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 */


/**
 * Return a list of categories correctly formatted
 *
 * @since 1.0.0
 */
if ( !function_exists('inti_get_categories_meta') ) {
	function inti_get_categories_meta( $args = '' ) {
		$count = 0;
		$categories_list = '';
		$categories = get_the_category();			
		foreach ( $categories as $category ) {
			$count++;
			if ( $args['show_uncategorized'] ) {
				$categories_list .= '<a href="' . get_category_link( $category->term_id ) . '" title="'.sprintf( __('View all posts in %s', 'inti'), $category->name ) . '"><span class="label category">' . $category->name . '</span></a>';
				if ( $count != count( $categories ) ){
					$categories_list .= ' '; //separator
				}
			} else {
				if ( $category->slug != 'uncategorized' || $category->name != 'Uncategorized' ) {
					$categories_list .= '<a href="' . get_category_link( $category->term_id ) . '" title="'.sprintf( __('View all posts in %s', 'inti'), $category->name ) . '"><span class="label category">' . $category->name . '</span></a>';
					if ( $count != count( $categories ) ){
						$categories_list .= ' '; //separator
					}
				}
			}
				
		}
		return $categories_list;
	}
}


/**
 * Return a list of tags correctly formatted
 *
 * @since 1.0.0
 */
if ( !function_exists('inti_get_tags_meta') ) {
	function inti_get_tags_meta( $args = '' ) {
		$count = 0;
		$tags_list = '';
		$tags = get_the_tags();	
		if ($tags) {		
			foreach ( $tags as $tag ) {
				$count++;
				$tags_list .= '<a href="' . get_tag_link( $tag->term_id ) . '" title="'.sprintf( __('View all posts tagged %s', 'inti'), $tag->name ) . '"><span class="label tag">' . $tag->name . '</span></a>';
				if ( $count != count( $tags ) ){
					$tags_list .= ' '; //separator
				}
			}
		}
		return $tags_list;
	}
}


/**
 * Return the formatted date
 *
 * @since 1.0.0
 */
if ( !function_exists('inti_get_date_meta') ) {
	function inti_get_date_meta( $args = '' ) {
		$date = sprintf('<a href="%1$s" title="%2$s" rel="bookmark"><time class="pubdate" datetime="%3$s" pubdate>%4$s</time></a>',
			esc_url( get_month_link( get_the_time('Y'), get_the_time('m') ) ),
			esc_attr( sprintf( __('View all posts from %s %s', 'inti'), get_the_time('M'), get_the_time('Y') ) ),
			esc_attr( get_the_date('c') ),
			esc_html( get_the_date() )
		);

		return $date;
	}
}


/**
 * Return the author link
 *
 * @since 1.0.0
 */
if ( !function_exists('inti_get_author_meta') ) {
	function inti_get_author_meta( $args = '' ) {
		$author = sprintf('<a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a>',
			esc_url( get_author_posts_url( get_the_author_meta('ID') ) ),
			esc_attr( sprintf( __('View all posts by %s', 'inti'), get_the_author() ) ),
			get_the_author()
		);

		return $author;
	}
}


/**
 * inti_get_post_header_meta
 * Combine and return all the meta information for the post header
 *
 * @since 1.0.0
 * @version 1.0.7
 */
if ( !function_exists('inti_get_post_header_meta') ) {
	function inti_get_post_header_meta( $args = '' ) {

		do_action('inti_get_post_header_meta', $args);
		
		global $post; $meta = ''; $output = '';
		
		$defaults = array( 
			'show_author' => true,
			'show_date'   => true,
			'show_cat'    => true,
			'show_tag'    => false,
			'show_icons'  => true,
			'show_label'  => false,
			'show_uncategorized' => false,
		 );
		$args = wp_parse_args( $args, $defaults );
		
		$categories_list = inti_get_categories_meta($args);
		$tag_list = inti_get_tags_meta();
		$date = inti_get_date_meta();
		$author = inti_get_author_meta();

		/**
		 * 1 is category, 2 is tag, 3 is the date and 4 is the author's name
		 */
		if ( $date || $categories_list || $author || $tag_list ) {
			if ( $args['show_icons'] ) {
				$meta .= ( $author && $args['show_author'] ) ? '<span class="by-author"><i class="far fa-user" title="Written by"></i> %4$s</span>' : '';
				$meta .= ( $date && $args['show_date'] ) ? '<span class="post-date"><i class="far fa-calendar" title="Publish on"></i> %3$s</span>' : '';
				$meta .= ( $categories_list && $args['show_cat'] ) ? '<span class="post-cats"><i class="far fa-folder" title="Posted in"></i> %1$s</span>' : '';
				$meta .= ( $tag_list && $args['show_tag'] ) ? '<div class="post-tags"><i class="far fa-flag" title="Tagged with"></i> %2$s</div>' : '';
				
				if ( $meta ) {
					$output = '<div class="post-meta icons">' . $meta . '</div>';
				}
			} else {
				$meta .= ( $date && $args['show_date'] ) ? '%3$s ' : '';
				$meta .= ( $author && $args['show_author'] ) ? __('by', 'inti') . ' <span class="by-author">%4$s</span> ' : '';
				$meta .= ( $categories_list && $args['show_cat'] ) ? '<div class="post-cats">%1$s</div>' : '';
				$meta .= ( $tag_list && $args['show_tag'] ) ? '<div class="post-tags">' . __('Tags:', 'inti') . ' %2$s</div>' : '';

				if ( $meta ) {
					if ( $args['show_label'] ) {
						$output = '<div class="post-meta">' . __('Posted: ', 'inti') . $meta . '</div>';
					} else {
						$output = '<div class="post-meta">' . $meta . '</div>';
					}
				}
			}
	
			$post_meta = sprintf( $output, $categories_list, $tag_list, $date, $author );

			return apply_filters('inti_get_post_header_meta', $post_meta, $defaults);
		}
	}
}


/**
 * inti_get_post_footer_meta
 * Combine and return all the meta information for the post footer
 *
 * @since 1.0.0
 * @version 1.0.7
 */
if ( !function_exists('inti_get_post_footer_meta') ) {
	function inti_get_post_footer_meta( $args = '' ) {

		do_action('inti_get_post_footer_meta', $args);
		
		global $post; $meta = ''; $output = '';
		
		$defaults = array( 
			'show_author' => true,
			'show_date'   => true,
			'show_cat'    => true,
			'show_tag'    => true,
			'show_icons'  => true,
			'show_label'  => false,
			'show_uncategorized' => false,
		 );
		$args = wp_parse_args( $args, $defaults );
		
		$categories_list = inti_get_categories_meta($args);
		$tag_list = inti_get_tags_meta();
		$date = inti_get_date_meta();
		$author = inti_get_author_meta();

		/**
		 * 1 is category, 2 is tag, 3 is the date and 4 is the author's name
		 */
		if ( $date || $categories_list || $author || $tag_list ) {
			if ( $args['show_icons'] ) {
				$meta .= ( $author && $args['show_author'] ) ? '<span class="by-author"><i class="far fa-user" title="Written by"></i> %4$s</span>' : '';
				$meta .= ( $date && $args['show_date'] ) ? '<span class="post-date"><i class="far fa-calendar" title="Publish on"></i> %3$s</span>' : '';
				$meta .= ( $categories_list && $args['show_cat'] ) ? '<div class="post-cats"><i class="far fa-folder" title="Posted in"></i> %1$s</div>' : '';
				$meta .= ( $tag_list && $args['show_tag'] ) ? '<div class="post-tags"><i class="far fa-flag" title="Tagged with"></i> %2$s</div>' : '';
				
				if ( $meta ) {
					$output = '<div class="post-meta icons">' . $meta . '</div>';
				}
			} else {
				$meta .= ( $date && $args['show_date'] ) ? '%3$s ' : '';
				$meta .= ( $author && $args['show_author'] ) ? __('by', 'inti') . ' <span class="by-author">%4$s</span> ' : '';
				$meta .= ( $categories_list && $args['show_cat'] ) ? '<div class="post-cats">%1$s</div>' : '';
				$meta .= ( $tag_list && $args['show_tag'] ) ? '<div class="post-tags">' . __('Tags:', 'inti') . ' %2$s</div>' : '';

				if ( $meta ) {
					if ( $args['show_label'] ) {
						$output = '<div class="post-meta">' . __('Posted: ', 'inti') . $meta . '</div>';
					} else {
						$output = '<div class="post-meta">' . $meta . '</div>';
					}
				}
			}
	
			$post_meta = sprintf( $output, $categories_list, $tag_list, $date, $author );

			return apply_filters('inti_get_post_footer_meta', $post_meta, $defaults);
		}
	}
}

/**
 * Post/Page footer comments link 
 * Gets a link to the post and page footers with a link that shows the number
 * of comments and takes the user to the #respond area when clicked
 * 
 * @since 1.0.7
 */
function inti_get_post_page_footer_comments_link() {	
	$system = get_inti_option('commenting_system', 'inti_commenting_options');

	ob_start();

	if ( comments_open() ) :
		switch ( $system ) { 
			case 'wordpress' : ?>
				<div class="comments-link">
					<i class="fi fi-comments" title="Comments"></i>
					<?php comments_popup_link('<span class="leave-comment">' . __('Leave a comment', 'inti') . '</span>', __('1 Comment', 'inti'), __('% Comments', 'inti') ); ?>
				</div><!-- .comments-link -->
				<?php
			break; 
			case 'disqus' : ?>
				<div class="comments-link">
					<i class="fi fi-comments" title="Comments"></i>
					<a href="<?php the_permalink() ?>#disqus_thread"></a>
				</div><!-- .comments-link -->
				<?php
			break; 
			case 'facebook' : ?>
				<div class="comments-link">
					<i class="fi fi-comments" title="Comments"></i>
					<fb:comments-count href="<?php the_permalink(); ?>"></fb:comments-count>
				</div><!-- .comments-link -->
				<?php
			break; 
			case 'google' : ?>
				<div class="comments-link">
					<i class="fi fi-comments" title="Comments"></i>
					<span class="leave-comment"><div class="g-commentcount" data-href="<?php the_permalink(); ?>"></div></span>
				</div><!-- .comments-link -->
				<?php 
			break; 
		}
	endif;

	$comments_link = ob_get_clean();
	return $comments_link;
}