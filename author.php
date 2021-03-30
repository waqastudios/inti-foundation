<?php
/**
 * The archive index
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

				<?php if ( have_posts() ) : the_post(); ?>
					<header class="archive-header">
						<h1 class="archive-title"><?php _e('About:', 'inti'); ?> <span class="vcard"> <?php the_author() ?></span></h1>
						<?php rewind_posts(); ?>
						<?php if ( get_the_author_meta( 'description' ) ) : ?>
						<div class="archive-meta grid-x">
							<div class="small-2 cell">
								<?php echo get_avatar( get_the_author_meta('ID'), apply_filters('inti_status_avatar', '64') ); ?>
								<p class="entry-author"><?php the_author(); ?></p>
							</div>
							<div class="small-10 cell">
								<?php the_author_meta( 'description' ); ?>
							</div>
						</div>
						<?php endif; ?>
					</header><!-- .archive-header -->
				<?php endif; // end have_posts() check ?> 

				<?php // get the main loop
				get_template_part('loops/loop', 'index'); ?>
				
			<?php inti_hook_grid_close(); ?>
				
			<?php inti_hook_inner_content_after(); ?>

		</div><!-- #content -->
		
		<?php inti_hook_content_after(); ?>
		
	</div><!-- #primary -->


<?php get_footer(); ?>