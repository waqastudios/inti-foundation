<?php
/**
 * The default index
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

				<?php // get the main loop
				get_template_part('loops/loop', 'index'); ?>
				
			<?php inti_hook_grid_close(); ?>
				
			<?php inti_hook_inner_content_after(); ?>

		</div><!-- #content -->
		
		<?php inti_hook_content_after(); ?>
		
	</div><!-- #primary -->


<?php get_footer(); ?>