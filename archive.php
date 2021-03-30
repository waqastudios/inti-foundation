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

				<?php if ( have_posts() ) : ?>
					<header class="archive-header">
						<h1 class="archive-title"><?php
							if ( is_day() ) :
								printf( __('Daily Archives: %s', 'inti'), '<span>' . get_the_date() . '</span>');
							elseif ( is_month() ) :
								printf( __('Monthly Archives: %s', 'inti'), '<span>' . get_the_date( _x('F Y', 'monthly archives date format', 'inti') ) . '</span>');
							elseif ( is_year() ) :
								printf( __('Yearly Archives: %s', 'inti'), '<span>' . get_the_date( _x('Y', 'yearly archives date format', 'inti') ) . '</span>');
							else :
								_e('Archives', 'inti');
							endif;
						?></h1>
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