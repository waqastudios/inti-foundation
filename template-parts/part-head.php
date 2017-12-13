	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
		
	<!-- Force IE to use the latest rendering engine available -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<!-- Default site icons -->
	
	<!-- Favicon -->
	<?php if ( get_inti_option('favicon_image', 'inti_customizer_options') ) : ?>
		<link rel="icon" href="<?php echo get_inti_option('favicon_image', 'inti_customizer_options'); ?>">
	<?php else : ?>
		<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/library/dist/img/favicon.png">
	<?php endif; ?>

	<!-- App Icon -->
	<?php if ( get_inti_option('apple_touch_icon', 'inti_customizer_options') ) : ?>
		<link href="<?php echo get_inti_option('apple_touch_icon', 'inti_customizer_options'); ?>" rel="apple-touch-icon" />
	<?php else : ?>
		<link href="<?php echo get_template_directory_uri(); ?>/library/dist/img/apple-touch-icon.png" rel="apple-touch-icon" />
	<?php endif; ?>

	<!-- Ms App Tile Color -->
	<?php if ( get_inti_option('ms_tile_color', 'inti_customizer_options') ) : ?>
		<meta name="msapplication-TileColor" content="<?php echo get_inti_option('ms_tile_color', 'inti_customizer_options'); ?>">
	<?php else : ?>
		<meta name="msapplication-TileColor" content="#ffdd00">
	<?php endif; ?>

	<!-- Ms App Tile Image -->
	<?php if ( get_inti_option('ms_tile_image', 'inti_customizer_options') ) : ?>
		<meta name="msapplication-TileImage" content="<?php echo get_inti_option('ms_tile_image', 'inti_customizer_options'); ?>">
	<?php else : ?>
		<meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/library/dist/img/win-tile-icon.png">
	<?php endif; ?>

	<!-- Site Theme Color -->
	<?php if ( get_inti_option('theme_color', 'inti_customizer_options') ) : ?>
		<meta name="theme-color" content="<?php echo get_inti_option('theme_color', 'inti_customizer_options'); ?>">
	<?php else : ?>
		<meta name="theme-color" content="#e80e8a">
	<?php endif; ?>
    
	
	<meta name="robots" content="index, follow" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<link rel="alternate" type="application/rss+xml" title="RSS Feed" href="<?php echo esc_url( home_url() ); ?>/feed/" />
	   
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta class="foundation-mq">

	<title><?php wp_title('&laquo;', true, 'right'); ?></title>