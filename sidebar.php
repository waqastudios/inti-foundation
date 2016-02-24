<?php
/**
 * The sidebar template containing the main widget area
 *
 * @package Inti
 * @subpackage Templates
 * @since 1.0.0
 * @version 1.2.0
 */?>

<?php // get the page layout
wp_reset_postdata(); 
$layout = inti_get_layout(get_inti_option('', '', '', '_inti_layout_radio')); ?>
	
<?php inti_hook_sidebar_before(); ?>

<?php 
// Build column classes depending on layout
$column_classes = "";
$has_sidebar = true;

switch ($layout) {
	case '1c':
	case '1c-thin':
		$has_sidebar = false;
	break;

	case '2c-l':
		$column_classes = "small-12 medium-5 large-4";
	break;

	case '2c-r':
		$column_classes = "small-12 medium-5 medium-pull-7 large-4 large-pull-8";
	break;
	
}

// Display the right sidebar for the template
if ( is_page() ) : ?>


	<?php 
	if ( is_front_page() && $has_sidebar ) : ?>

		<div id="sidebar" class="sidebar <?php echo $column_classes; ?> columns" role="complementary">
			<?php dynamic_sidebar('sidebar-frontpage'); ?>
		</div><!-- #sidebar -->

	<?php 
	elseif ( !is_front_page() && $has_sidebar ) : ?>

		<div id="sidebar" class="sidebar <?php echo $column_classes; ?> columns" role="complementary">
			<?php dynamic_sidebar('sidebar'); ?>
		</div><!-- #sidebar -->

	<?php 
	else : // no sidebar ?>

	<?php 
	endif; ?>


<?php elseif ( ( is_archive() || is_home() || is_search() ) && $has_sidebar ) : ?>


	<div id="sidebar" class="sidebar <?php echo $column_classes; ?> columns" role="complementary">
		<?php dynamic_sidebar('sidebar'); ?>
	</div><!-- #sidebar -->
	

<?php elseif ( is_single() && $has_sidebar ) : ?>


	<div id="sidebar" class="sidebar <?php echo $column_classes; ?> columns" role="complementary">
		<?php dynamic_sidebar('sidebar'); ?>
	</div><!-- #sidebar -->


<?php endif; ?>

<?php inti_hook_sidebar_after(); ?>   