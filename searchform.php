<?php
/**
 * The template for displaying the search form
 *
 * @package Inti
 * @subpackage Templates
 * @since 1.0.0
 */?>

<form role="search" method="get" id="searchform" action="<?php echo home_url(); ?>">	
	<label class="screen-reader-text" for="s"><?php _e('Search for:', 'inti'); ?></label>
	<div class="grid-x">
		<div class="small-8 cell">
			<input type="text" value="<?php get_search_query(); ?>" name="s" id="s" placeholder="<?php echo esc_attr__('Search', 'inti'); ?>" />
		</div>
		<div class="small-4 cell">
			<input class="button expanded" type="submit" id="searchsubmit" value="<?php echo esc_attr__('Search', 'inti'); ?>" />
		</div>
	</div>
</form>