<?php
/**
 * The template for displaying page content
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

if ($interface == 1 || !is_search()) : // standard interface
?>


	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="entry-body">

			<?php inti_hook_page_header_before(); ?>

			<header class="entry-header">
				<?php inti_hook_page_header(); ?>
			</header><!-- .entry-header -->
			
			<?php inti_hook_page_header_after(); ?>
					
			<div class="entry-content">
				<?php inti_hook_page_content_before_the_content(); ?>
				<?php the_content(); ?>
				<?php inti_hook_page_content_after_the_content(); ?>
			</div><!-- .entry-content -->
			
			<footer class="entry-footer">
				<?php inti_hook_page_footer(); ?>
			</footer><!-- .entry-footer -->
			
		</div><!-- .entry-body -->
	</article><!-- #post -->

<?php 
else : // short interface with excerpt for search results ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="entry-body">

			<?php inti_hook_page_header_before(); ?>

			<header class="entry-header">
				<?php inti_hook_page_header(); ?>
			</header><!-- .entry-header -->
			
			<?php inti_hook_page_header_after(); ?>
					
			<div class="entry-content">
				<?php inti_hook_page_content_before_the_content(); ?>
				<?php the_excerpt(); ?>
				<?php inti_hook_page_content_after_the_content(); ?>
			</div><!-- .entry-content -->
			
			<footer class="entry-footer">
				<?php inti_hook_page_footer(); ?>
			</footer><!-- .entry-footer -->
			
		</div><!-- .entry-body -->
	</article><!-- #post -->

<?php endif; ?>