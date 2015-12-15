<?php
/**
 * The template for displaying a "No posts found" message.
 *
 * @package Inti
 * @subpackage Templates
 * @since 1.0.0
 */
?>

	<article id="post-0" class="post no-results not-found">
		<div class="entry-body">
		
			<?php inti_hook_post_header_before(); ?>
			
			<header class="entry-header">
				<h1 class="entry-title"><?php _e('Nothing Found', 'inti'); ?></h1>
			</header>

			<?php inti_hook_post_header_after(); ?>

			<div class="entry-content">				
				<?php inti_hook_post_content_before_the_content(); ?>

				<p><?php _e('Apologies, but no results were found. Perhaps searching will help find a related post.', 'inti'); ?></p>
				<?php get_search_form(); ?>

				<?php inti_hook_post_content_after_the_content(); ?>
			</div><!-- .entry-content -->

		</div><!-- .entry-body -->
	</article><!-- #post-0 -->