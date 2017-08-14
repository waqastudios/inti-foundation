<?php
/**
 * The main template for a static front page
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

				<header class="archive-header">
					<?php 
					/**
					 * Get the page loop
					 * Content of the page that set as the front-page is 
					 * displayed as a header as a kind of header to the
					 * rest of the what is displayed...
					 */
					get_template_part('loops/loop', 'page'); ?>
				</header><!-- .archive-header -->

				<?php 
				/** 
				 * Get the main loop
				 * ...while by default we also how the loop of posts
				 * under the front-page content. Modify as needed or
				 * overwrite front-page.php with a child theme version.
				 */
				get_template_part('loops/loop', 'frontpage'); ?>
				
				<?php inti_hook_inner_content_after(); ?>
				
			<?php inti_hook_grid_close(); ?>

		</div><!-- #content -->
		
		<?php inti_hook_content_after(); ?>
		
	</div><!-- #primary -->


<?php get_footer(); ?>