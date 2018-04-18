<?php
/**
 * The loop for displaying posts on the front page template
 *
 * @package Inti
 * @subpackage loops
 * @since 1.0.0
 */
?>

	<?php // get the options
		$post_category = get_inti_option('frontpage_post_category', 'inti_general_options', -1);
		$number_posts = get_inti_option('frontpage_number_posts', 'inti_general_options', 3);
		$post_columns = get_inti_option('frontpage_post_columns', 'inti_general_options', 1);
	?>

	<?php // start the loop
		$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
		if (-1 != $post_category) {
			$args = array( 
				'post_type'           => 'post',
				'cat'                 => $post_category,
				'posts_per_page'      => $number_posts,
				'ignore_sticky_posts' => 1,
				'paged'               => $paged );
		} else {
			$args = array( 
				'post_type'           => 'post',
				'posts_per_page'      => $number_posts,
				'ignore_sticky_posts' => 1,
				'paged'               => $paged );
		}
		global $frontpage_query;
		$frontpage_query = new WP_Query( $args ); ?>
			  
		<?php if ( $frontpage_query->have_posts() ) : ?>
		
		<?php inti_hook_loop_before(); ?>
		
			<?php // if more than one column use block-grid
			if ( $post_columns != 1 ) echo '<div class="grid-x grid-margin-x small-up-1 medium-up-1 mlarge-up-' . $post_columns . '">'; ?>
			
				<?php while ( $frontpage_query->have_posts() ) : $frontpage_query->the_post(); global $more; $more = 0; ?>
					
					<?php inti_hook_post_before(); ?>
					
					<?php if ( $post_columns != 1 ) echo '<div class="cell">'; ?>
						
						<?php get_template_part('post-formats/format', 'standard'); ?>
						
					<?php if ( $post_columns != 1 ) echo '</div>'; ?> 
					
					<?php inti_hook_post_after(); ?>

				<?php endwhile; // end of the loop ?>
				
			<?php if ( $post_columns != 1 ) echo '</div>'; // close the block-grid ?>
			
		<?php inti_hook_loop_after(); ?>    
				
		<?php // if no posts are found
		else : inti_hook_loop_else(); ?>

		<?php endif; // end have_posts() check ?>