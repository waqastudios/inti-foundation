<?php
/**
 * The archive index
 *
 * @package Inti
 * @subpackage Templates
 * @since 1.0.0
 */

$layout = inti_get_layout('');

get_header(); ?>


	<div id="primary" class="site-content">
	
		<?php inti_hook_content_before(); ?>
	
		<div id="content" role="main" class="<?php apply_filters('inti_filter_content_classes', ''); ?>">
			<div class="row">
				<?php switch ( $layout ) { 

					case '1c': ?>

				<div class="small-12 medium-12 large-12 columns">
				


				<?php break;
					case '2c-l': ?>

				<div class="small-12 medium-7 large-8 columns">
				


				<?php break;
					case '2c-r': ?>

				<div class="small-12 medium-7 medium-push-5 large-8 large-push-4 columns">
				


				<?php break;
					case '1c-thin': ?>

				<div class="small-12 medium-10 medium-centered large-9 columns">
				

				<?php } //end switch ?>
				
				<?php inti_hook_inner_content_before(); ?>

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
				
				<?php inti_hook_inner_content_after(); ?>
				
				</div><!-- .columns -->
				
				<?php get_sidebar(); ?>
				
			</div><!-- .row -->
		</div><!-- #content -->
		
		<?php inti_hook_content_after(); ?>
		
	</div><!-- #primary -->


<?php get_footer(); ?>