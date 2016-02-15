<?php
/**
 * Template for footer
 *
 * @package Inti
 * @subpackage Templates
 * @since 1.0.0
 */
?>
					<?php get_template_part('template-parts/part', 'footer-wide') ?>

				</div><!-- #page .webpage -->
	<?php inti_hook_site_after(); ?>
<?php wp_footer(); inti_hook_footer(); ?>
</body>
</html> 