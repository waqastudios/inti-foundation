<?php
/**
 * The template for displaying single posts
 *
 * @package Inti
 * @subpackage Templates
 * @since 1.0.0
 */

$default_layout = get_inti_option('page_layout', 'inti_customizer_options', '2c-l');
$meta_layout = get_inti_option('', '', '', '_inti_layout_radio');
$layout = inti_get_layout($default_layout, $meta_layout);

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

					<?php // start the loop
					while ( have_posts() ) : the_post(); ?>
					
					<?php inti_hook_post_before(); ?>
						
					<?php // get post format and display code for that format
					if ( !get_post_format() ) : get_template_part('post-formats/format', 'standard'); 
					else : get_template_part('post-formats/format', get_post_format() ); endif; ?>
					
					<?php inti_hook_post_after(); ?>
		
					<?php endwhile; // end of the loop ?>
				
					<?php inti_hook_inner_content_after(); ?>
				
				</div><!-- .columns -->
				
				<?php get_sidebar(); ?>
				
			</div><!-- .row -->
		</div><!-- #content -->
		
		<?php inti_hook_content_after(); ?>
		
	</div><!-- #primary -->


<?php get_footer(); ?>