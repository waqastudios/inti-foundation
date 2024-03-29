<?php
/**
 * The main template file and posts page
 *
 * @package Inti
 * @subpackage Templates
 * @since 1.0.0
 */

get_header(); ?>


	<div id="primary" class="site-content">
	
		<?php inti_hook_content_before(); ?>
	
		<div id="content" role="main" class="<?php apply_filters('inti_filter_content_classes', ''); ?>">

			<?php inti_hook_inner_content_before(); ?>

			<?php inti_hook_grid_open(); ?>

					<?php if ( have_posts() ) : ?>

						<?php // start the loop
						while ( have_posts() ) : the_post(); ?>
						
							<?php 
							if ( $post->post_type == 'page' ) : 

								get_template_part('post-formats/format', 'page'); 

							else :

								// get post format and display template for that format
								if ( !get_post_format() ) : get_template_part('post-formats/format', 'standard');
								else : get_template_part('post-formats/format', get_post_format()); endif;

							endif; ?>
							
						<?php endwhile; ?>
						
						
						<?php // if no posts are found
						else : ?>
							<p><?php _e('Apologies, but this content was not found.', 'inti'); ?></p>
							<?php get_search_form(); ?>
					<?php endif; // end have_posts() check ?> 
				
			<?php inti_hook_grid_close(); ?>
			
			<?php inti_hook_inner_content_after(); ?>

		</div><!-- #content -->
		
		<?php inti_hook_content_after(); ?>
		
	</div><!-- #primary -->


<?php get_footer(); ?>