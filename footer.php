<?php
/**
 * Template for footer
 *
 * @package Inti
 * @subpackage Templates
 * @since 1.0.0
 */
?>
					<?php inti_hook_footer_before(); ?>
					
					<?php get_template_part('template-parts/part', 'footer-wide') ?>

					<?php inti_hook_footer_after(); ?>


				</div><!-- #page .webpage -->
	<?php inti_hook_site_after(); ?>
<?php wp_footer(); inti_hook_footer(); ?>
</body>
</html> 