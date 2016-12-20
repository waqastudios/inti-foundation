<?php inti_hook_site_header_before(); ?>

<div id="site-header" class="site-header">

	<?php inti_hook_site_banner_before(); // inti_do_main_dropwdown_menu() is placed above or below banner ?>

	<div id="site-banner" class="site-banner<?php if ( !get_inti_option('show_site_banner_mobile', 'inti_customizer_options') ) echo " show-for-mlarge"; ?>" role="banner">

		<div class="column">
			<?php inti_hook_site_banner_site_logo_before(); ?>
			<?php  
			/**
			* Add logo or site title to the site-banner, hidden in on smaller screens where another logo is shown on top-bar
			*/
			$mainbanner = get_inti_option('logo_image', 'inti_customizer_options');

			if ( $mainbanner ) : ?>
			<div class="site-logo">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
					<?php inti_do_srcset_image(get_inti_option('logo_image', 'inti_customizer_options'), esc_attr( get_bloginfo('name', 'display') . ' logo')); ?>
				</a>
			</div><!-- .site-logo -->
			<?php inti_hook_site_banner_site_logo_after(); ?>
			<?php inti_hook_site_banner_title_area_before(); ?>
			<?php endif; // end of logo ?>
			<div class="title-area">
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
				<p class="site-description"><?php bloginfo('description'); ?></p>
			</div>
			<?php inti_hook_site_banner_title_area_after(); ?>
		</div><!-- .column -->

	</div><!-- .site-banner -->

	<?php inti_hook_site_banner_after(); // inti_do_main_dropwdown_menu() is placed above or below banner ?>

</div>

<?php inti_hook_site_header_after(); ?>