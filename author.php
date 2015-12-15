<?php
/**
 * The archive index
 *
 * @package Inti
 * @subpackage Templates
 * @since 1.0.0
 */

$default_layout = get_inti_option('page_layout', 'inti_customizer_options', '2c-l');
$layout = $default_layout;

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
				

				<?php } //end switch ?>
				
				<?php inti_hook_inner_content_before(); ?>

				<?php if ( have_posts() ) : the_post(); ?>
					<header class="archive-header">
						<h1 class="archive-title"><?php _e('About:', 'inti'); ?> <span class="vcard"> <?php the_author() ?></span></h1>
						<?php rewind_posts(); ?>
						<?php if ( get_the_author_meta( 'description' ) ) : ?>
						<div class="archive-meta row">
							<div class="small-2 columns">
								<?php echo get_avatar( get_the_author_meta('ID'), apply_filters('inti_status_avatar', '64') ); ?>
								<p class="entry-author"><?php the_author(); ?></p>
							</div>
							<div class="small-10 columns">
								<?php the_author_meta( 'description' ); ?>
							</div>
						</div>
						<?php endif; ?>
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