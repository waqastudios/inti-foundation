<?php
/**
 * 404 Template
 *
 * @package Inti
 * @subpackage Templates
 * @since 1.6.1
 */


get_header(); ?>


	<div id="primary" class="site-content">
	
		<?php inti_hook_content_before(); ?>
	
		<div id="content" role="main" class="<?php apply_filters('inti_filter_content_classes', ''); ?>">
			
			<?php inti_hook_grid_open(); ?>

				<?php inti_hook_inner_content_before(); ?>

				<?php if (get_inti_option('page_not_found', 'inti_general_options')) : ?>

					<article id="post-0" class="post 404 not-found">
						<div class="entry-body">

							<div class="entry-content">				
								<?php inti_hook_post_content_before_the_content(); ?>

								<?php echo get_inti_option('page_not_found', 'inti_general_options'); ?>

								<?php inti_hook_post_content_after_the_content(); ?>
							</div><!-- .entry-content -->

						</div><!-- .entry-body -->
					</article><!-- #post-0 -->
					

				<?php else : ?>
					<article id="post-0" class="post 404 not-found">
						<div class="entry-body">
						
							<?php inti_hook_post_header_before(); ?>
							
							<header class="entry-header">
								<h1 class="entry-title"><?php _e('404 Not Found', 'inti'); ?></h1>
							</header>

							<?php inti_hook_post_header_after(); ?>

							<div class="entry-content">				
								<?php inti_hook_post_content_before_the_content(); ?>

								<p><?php _e('Apologies, but this content was not found. Perhaps searching will help find a related post.', 'inti'); ?></p>
								<?php get_search_form(); ?>

								<?php inti_hook_post_content_after_the_content(); ?>
							</div><!-- .entry-content -->

						</div><!-- .entry-body -->
					</article><!-- #post-0 -->
				<?php endif; ?>
				
				<?php inti_hook_inner_content_after(); ?>
			
			<?php inti_hook_grid_close(); ?>

		</div><!-- #content -->
		
		<?php inti_hook_content_after(); ?>
		
	</div><!-- #primary -->


<?php get_footer(); ?>