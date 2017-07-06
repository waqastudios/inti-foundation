<?php
/**
 * The template for displaying post content
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
	
			<?php if ( is_search() || is_archive() ) : // Only display Excerpts for Search ?>
			<div class="entry-summary">
				<?php the_excerpt(); ?>
			</div><!-- .entry-summary -->
			<?php elseif ( is_single() ) : ?>
			<div class="entry-content">
				<?php inti_hook_post_content_before_the_content(); ?>
				<?php the_content(); ?>
				<?php inti_hook_post_content_after_the_content(); ?>
			</div><!-- .entry-content --> 
			<?php else : ?>
			<div class="entry-content">
				<?php the_content(); ?>
			</div><!-- .entry-content -->
			<?php endif; ?>
	
			<footer class="entry-footer">
				<?php inti_hook_post_footer(); ?>
			</footer><!-- .entry-footer -->
		</div><!-- .entry-body -->
	</article><!-- #post -->

<?php 
else : // short interface with excerpt ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class('short'); ?>>
		<div class="entry-body">
			<?php  if ( has_post_thumbnail() ) : ?>
				<div class="grid-x grid-padding-x grid-padding-y large-up-2">
					<div class="large-4 cell">
						<div class="entry-thumbnail">
							<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
								<?php the_post_thumbnail( 'blog-thumbnail', array( 'class' => 'blog-thumbnail', 'alt' => get_the_title() ) ); ?>
							</a>
						</div>
					</div>

				
					<div class="large-8 cell"> 

						<?php inti_hook_post_header_before(); ?>
						<header class="entry-header">
							<?php inti_hook_post_header(); ?>
						</header><!-- .entry-header -->
						<?php inti_hook_post_header_after(); ?>

						<div class="entry-summary">
							<?php the_excerpt(); ?>
						</div><!-- .entry-content -->               

						 <footer class="entry-footer">
							<?php inti_hook_post_footer(); ?>
						</footer><!-- .entry-footer -->

					</div>
				</div>
			<?php else : ?>

				<?php inti_hook_post_header_before(); ?>
				<header class="entry-header">
					<?php inti_hook_post_header(); ?>
				</header><!-- .entry-header -->
				<?php inti_hook_post_header_after(); ?>

				<div class="entry-summary">
					<?php the_excerpt(); ?>
				</div><!-- .entry-summary -->

				 <footer class="entry-footer">
					<?php inti_hook_post_footer(); ?>
				</footer><!-- .entry-footer -->
				
				
			<?php endif; ?>


		</div><!-- .entry-body -->
	</article><!-- #post -->

<?php endif; ?>