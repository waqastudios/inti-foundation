<?php
/**
 * @package Inti
 * @subpackage Templates
 * @since 1.0.0
 */?><!DOCTYPE html>
<!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if ( IE 7 )&!( IEMobile )]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if ( IE 8 )&!( IEMobile )]><html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->

<head>
	<!-- WordPress head -->
	<?php wp_head(); ?>
	<!-- end WordPress head -->
	<?php inti_hook_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php inti_hook_site_before(); ?>

		<div id="page" class="webpage">

			<?php get_template_part('template-parts/part', 'header-contained'); ?>