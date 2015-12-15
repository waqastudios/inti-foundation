<?php
/**
 * The template for displaying the status post format
 *
 * @package Inti
 * @subpackage Templates
 * @since 1.0.0
 */

/**
 * In the Theme Options, users can choose whether post archives display the full posts
 * or a group of excerpts with a "read more" button to see the rest. Post formats should
 * check which option is set and modify the interface accordingly.
 * 1 == standard (shown on singles or on archives when option is set to 1)
 * 2 == short (shown on archives when option is set to 2)
 *
 */
$interface = get_inti_option('blog_interface', 'inti_general_options');

if ($interface == 1 || is_single()) : // standard interface
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>        
		<div class="entry-body">
		
			<?php inti_hook_post_header_before(); ?>

			<header class="entry-header">
				<?php inti_hook_post_header(); ?>
			</header><!-- .entry-header -->

			<?php inti_hook_post_header_after(); ?>
			
			<header class="entry-header large-2 small-2 columns">
				<?php echo get_avatar( get_the_author_meta('ID'), apply_filters('inti_status_avatar', '57') ); ?>
				<p class="entry-author"><?php the_author(); ?></p>
			</header><!-- .entry-header -->
	
			<div class="entry-content large-offset-2 small-offset-2">
				<?php inti_hook_post_content_before_the_content(); ?>
				<?php the_content(); ?>
				<?php inti_hook_post_content_after_the_content(); ?>
			</div><!-- .entry-content -->
	
			<footer class="entry-footer">
				<?php inti_hook_post_footer(); ?>
			</footer><!-- .entry-footer -->
		</div><!-- .entry-body -->
	</article><!-- #post -->

<?php 
else : // short interface with excerpt ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class('short'); ?>>        
		<div class="entry-body">
		
			<?php inti_hook_post_header_before(); ?>

			<header class="entry-header">
				<?php inti_hook_post_header(); ?>
			</header><!-- .entry-header -->

			<?php inti_hook_post_header_after(); ?>
			
			<header class="entry-header large-2 small-2 columns">
				<?php echo get_avatar( get_the_author_meta('ID'), apply_filters('inti_status_avatar', '64') ); ?>
				<p class="entry-author"><?php the_author(); ?></p>
			</header><!-- .entry-header -->
	
			<div class="entry-summary large-offset-2 small-offset-2">
				<?php the_excerpt(); ?>
			</div><!-- .entry-summary -->
	
			<footer class="entry-footer">
				<?php inti_hook_post_footer(); ?>
			</footer><!-- .entry-footer -->
		</div><!-- .entry-body -->
	</article><!-- #post -->

<?php endif; ?>