<?php
/**
 * The template for displaying the search form
 *
 * @package Inti
 * @subpackage Templates
 * @since 1.0.0
 */?>

<form role="search" method="get" id="searchform" action="<?php echo home_url(); ?>">
	<div class="row collapse">
		<label class="screen-reader-text" for="s"><?php _e('Search for:', 'inti'); ?></label>
		<div class="small-9 columns">
			<input type="text" value="<?php get_search_query(); ?>" name="s" id="s" placeholder="<?php echo esc_attr__('Search', 'inti'); ?>" />
		</div>
		<div class="small-3 columns end">
			<input class="button prefix" type="submit" id="searchsubmit" value="<?php echo esc_attr__('Search', 'inti'); ?>" />
		</div>
	</div>
</form>