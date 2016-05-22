<?php
/**
 * Inti Pageinate Links
 *
 * @package Inti
 * @author Thomas Scholz (@toscho / toscho.de)
 * @author Anthony Wilhelm (@awshout / anthonywilhelm.com)
 * @since 1.0.0
 * @param $args Optional. Override defaults.
 * @license GNU General Public License v2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 */

/**
 * Paginates posts for archives in one of two ways depending on what was selected in theme options
 *
 * @since 1.0.0
 */
if ( !function_exists('inti_filter_archive_pagination') ) {
	function inti_filter_archive_pagination( $args = '' ) {
		do_action('inti_filter_archive_pagination', $args);
		
		$defaults = array( 
			'query' => 'wp_query',
			'type'  => 'numbered',
		 );
		$args = wp_parse_args( $args, $defaults );

		global ${$args['query']}, $wp_rewrite; $output = '';
		
		$the_query = ( isset( $args['query'] ) ) ? ${$args['query']} : $wp_query;
		
		$pagination_base = $wp_rewrite->pagination_base;
		
		/* If there's not more than one page, return nothing. */
		if ( 1 >= $the_query->max_num_pages ) {
			return;
		}
		
		/**
		 * Previous Next Links
		 *
		 * @since 1.0.0
		 */
		if ( 'nextprev' == $args['type'] ) {
		
			$output .= '<nav class="content-navigation between-older-newer" role="navigation">' . "\n";
			$output .= "\t" . '<div class="row">';
			$output .= "\t\t" . '<div class="medium-6 columns">';
			$output .= "\t\t\t" . '<div class="float-left">';
			$output .= get_next_posts_link('<span class="meta-nav meta-nav-next">&larr; ' . __('Older posts', 'inti') . '</span>', $the_query->max_num_pages);
			$output .= '</div></div>';
			$output .= "\t\t" . '<div class="medium-6 columns">';
			$output .= "\t\t\t" . '<div class="float-right">';
			$output .= get_previous_posts_link('<span class="meta-nav meta-nav-prev">'. __('Newer posts', 'inti') . ' &rarr;</span>', $the_query->max_num_pages);
			$output .= '</div></div></div>';
			$output .= "\n" . '</nav><!-- .content-navigation -->';
			
		} else {
			
		/**
		 * Numbered Pagination
		 *
		 * @link http://codex.wordpress.org/Function_Reference/paginate_links
		 * @see paginate_links
		 * @since 1.0.0
		 */			
		 
			$big = 999999999; // need an unlikely integer
			$count = 0;
			$base = str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) );
			$total = $the_query->max_num_pages;
			$current = max( 1, get_query_var('paged') );
			
			$defaults = array(
				'base' => $base,
				'format' => '?page=%#%',
				'total' => $total,
				'current' => $current,
				'show_all' => false,
				'prev_next' => true,
				'prev_text' => __('&laquo; Previous', 'inti'),
				'next_text' => __('Next &raquo;', 'inti'),
				'end_size' => 2,
				'mid_size' => 3,
				'add_args' => false,
				'add_fragment' => ''
			);

			$args = wp_parse_args( $args, $defaults );
			extract($args, EXTR_SKIP);

			// Who knows what else people pass in $args
			$total = (int) $total;
			if ( $total < 2 )
				return;
			$current  = (int) $current;
			$end_size = 0  < (int) $end_size ? (int) $end_size : 1; // Out of bounds?  Make it the default.
			$mid_size = 0 <= (int) $mid_size ? (int) $mid_size : 2;
			$add_args = is_array($add_args) ? $add_args : false;
			$r = '';
			$page_links = array();
			$n = 0;
			$dots = false;
			
			$output = '<nav class="content-navigation" role="navigation">' . "\n";
			$output .= "<ul class='pagination'>";

			if ( $prev_next && $current && 1 < $current ) :
				$link = str_replace('%_%', 2 == $current ? '' : $format, $base);
				$link = str_replace('%#%', $current - 1, $link);
				if ( $add_args )
					$link = add_query_arg( $add_args, $link );
				$link .= $add_fragment;
				$page_links[] = '<li><a class="prev page-numbers" href="' . esc_url( $link ) . '">' . $prev_text . '</a></li>';
			endif;
			for ( $n = 1; $n <= $total; $n++ ) :
				$n_display = number_format_i18n($n);
				if ( $n == $current ) :
					$page_links[] = "<li class='current'>$n_display</li>";
					$dots = true;
				else :
					if ( $show_all || ( $n <= $end_size || ( $current && $n >= $current - $mid_size && $n <= $current + $mid_size ) || $n > $total - $end_size ) ) :
						$link = str_replace('%_%', 1 == $n ? '' : $format, $base);
						$link = str_replace('%#%', $n, $link);
						if ( $add_args )
							$link = add_query_arg( $add_args, $link );
						$link .= $add_fragment;
						$page_links[] = "<li><a class='page-numbers' href='" . esc_url( $link ) . "'>$n_display</a></li>";
						$dots = true;
					elseif ( $dots && !$show_all ) :
						$page_links[] = '<li><a class="page-numbers dots">&hellip;</a></li>';
						$dots = false;
					endif;
				endif;
			endfor;
			if ( $prev_next && $current && ( $current < $total || -1 == $total ) ) :
				$link = str_replace('%_%', $format, $base);
				$link = str_replace('%#%', $current + 1, $link);
				if ( $add_args )
					$link = add_query_arg( $add_args, $link );
				$link .= $add_fragment;
				$page_links[] = '<li><a class="next page-numbers" href="' . esc_url( $link ) . '">' . $next_text . '</a></li>';
			endif;

			$output .= join("\n", $page_links);
			$output .= "</ul>";
			$output .= "\n" . '</nav><!-- .content-navigation -->';
		}
	
	echo apply_filters( 'inti_paginate_links', $output );	
	} 	
}


/**
 * Paginates sections of individual posts and pages that have <!––nextpage––>
 *
 * @since 1.0.0
 */
function inti_do_post_page_split_links( $args ){
	$defaults = array(
		'before'      => '<nav class="page-links"><span>' . __('Keep reading', 'inti') . ':</span><ul class="pagination">',
		'after'       => '</ul></nav>',
		'link_before' => '',
		'link_after'  => '',
		'separator'        => '',
		'pagelink'    => '%',
		'echo'        => 1
	);

	$r = wp_parse_args( $args, $defaults );
	$r = apply_filters( 'inti_filter_link_pages', $r );
	extract( $r, EXTR_SKIP );

	global $page, $numpages, $multipage, $more, $pagenow;

	if ( !$multipage )	return;

	$output = $before;

	for ( $i = 1; $i < ( $numpages + 1 ); $i++ ) {
		$j       = str_replace( '%', $i, $pagelink );
		$output .= ' ';

		if ( $i != $page || ( ! $more && 1 == $page ) )	{
			$output .= "<li>" . _wp_link_page( $i ) . "{$link_before}{$j}{$link_after}</a></li>";
		} else {   
			// highlight the current page
			$output .= "<li class='current'>{$j}</li>";
		}
	}

	print $output . $after;
}