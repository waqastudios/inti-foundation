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
						<header class="archive-header">
							<h1 class="archive-title"><?php printf( __('Tag: %s', 'reactor'), '<span>' . single_tag_title('', false) . '</span>'); ?></h1>
			
						<?php // show an optional tag description
						if ( tag_description() ) : ?>
							<div class="archive-meta">
							<?php echo tag_description(); ?>
							</div>
						<?php endif; ?>
						</header><!-- .archive-header -->
					<?php endif; // end have_posts() check ?> 

					<?php // get the loop
					get_template_part('loops/loop', 'index'); ?>
				
			<?php inti_hook_grid_close(); ?>
				
			<?php inti_hook_inner_content_after(); ?>

		</div><!-- #content -->
		
		<?php inti_hook_content_after(); ?>
		
	</div><!-- #primary -->


<?php get_footer(); ?>