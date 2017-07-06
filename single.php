<?php
/**
 * The template for displaying single posts
 *
 * @package Inti
 * @subpackage Templates
 * @since 1.0.0
 */

get_header(); ?>


	<div id="primary" class="site-content">
	
		<?php inti_hook_content_before(); ?>
	
		<div id="content" role="main" class="<?php apply_filters('inti_filter_content_classes', ''); ?>">
				
			<?php inti_hook_grid_open(); ?>
				
				<?php inti_hook_inner_content_before(); ?>

				<?php // start the loop
				while ( have_posts() ) : the_post(); ?>
				
				<?php inti_hook_post_before(); ?>
					
				<?php // get post format and display code for that format
				if ( !get_post_format() ) : get_template_part('post-formats/format', 'standard'); 
				else : get_template_part('post-formats/format', get_post_format() ); endif; ?>
				
				<?php inti_hook_post_after(); ?>
	
				<?php endwhile; // end of the loop ?>
			
				<?php inti_hook_inner_content_after(); ?>
				
			<?php inti_hook_grid_close(); ?>

		</div><!-- #content -->
		
		<?php inti_hook_content_after(); ?>
		
	</div><!-- #primary -->


<?php get_footer(); ?>