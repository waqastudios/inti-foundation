<?php
/**
 * Content - Footer
 * add content to predefined hooks
 * found throughout the theme
 *
 * @package Inti
 * @since 1.0.0
 * @license GNU General Public License v2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 */


/**
 * Footer widgets
 * Adds a row in which a sidebar is displayed in the footer
 * See sidebar.php for details of how it is displayed horizontally
 * 
 * @since 1.0.1
 */
function inti_do_footer_widgets() { ?>
	<div class="footer-widgets">
		<div class="grid-container fluid">
			<div class="grid-x grid-margin-x">
				<div class="small-12 cell">
					<?php get_sidebar('footer'); ?>  
				</div><!-- .cell -->
			</div><!-- .grid-x -->  
		</div> 

	</div><!-- .footer-widgets -->
<?php 
}
add_action('inti_hook_footer_inside', 'inti_do_footer_widgets', 1);


/**
 * Footer menu
 * Adds a menu to the footer
 * 
 * @since 1.0.0
 */
function inti_do_footer_menu() { 
	if ( has_nav_menu('footer-menu') ) : ?>
		<div class="footer-menu">
			<div class="grid-container fluid">
				<div class="grid-x grid-margin-x">
					<div class="small-12 cell">
						<?php echo inti_get_footer_menu();	?>
					</div><!-- .cell -->
				</div><!-- .grid-x -->
			</div>
		</div><!-- .footer-menu -->
<?php
	endif;
}
add_action('inti_hook_footer_inside', 'inti_do_footer_menu', 2);


/**
 * Footer info, copyright etc
 * Adds spurious details such as copyright messages, could also
 * be a home for terms and conditions links etc.
 * 
 * @since 1.0.2
 */
function inti_do_footer_info() { ?>
	<div class="footer-info">
		<div class="grid-container fluid">
			<div class="grid-x grid-margin-x">
				<div class="small-12 cell">
									
						<?php 
						if ( get_inti_option('custom_copyright', 'inti_customizer_options') ) : 
							echo get_inti_option('custom_copyright', 'inti_customizer_options'); 
						else : ?>
							<p><span class="copyright">Copyright &copy; <?php echo date_i18n('Y'); ?> <?php bloginfo('name'); ?> | </span>
							<span class="site-credits"><?php _e('Powered by', 'inti'); ?> <a href="<?php echo esc_url('http://wordpress.org/'); ?>" title="<?php esc_attr_e('Personal Publishing Platform', 'inti'); ?>">WordPress</a> &amp; <a href="<?php echo esc_url('http://inti.waqastudios.com/') ?>" title="<?php esc_attr_e('Foundation 6 WordPress Framework', 'inti'); ?>" rel="nofollow">Inti Foundation</a></span></p>
						<?php endif; ?>
				
				</div><!-- .cell -->
			</div><!-- .grid-x -->
		</div>
	</div><!-- .footer-info -->
<?php 
}
add_action('inti_hook_footer_inside', 'inti_do_footer_info', 4);


/**
 * Footer social media
 * Adds linked icons to various social media profiles set in theme options
 * 
 * @since 1.0.0
 */
function inti_do_footer_social() { 
	if ( get_inti_option('footer_social', 'inti_footer_options') ) { ?>
		<div class="footer-social">
			<div class="grid-container fluid">
				<div class="grid-x grid-margin-x">
					<div class="small-12 cell">
						<?php echo inti_get_footer_social_links(); ?>
					</div><!-- .cell -->
					
				</div><!-- .grid-x -->
			</div>
		</div><!-- .footer-social -->
<?php 
	}
}
add_action('inti_hook_footer_inside', 'inti_do_footer_social', 3);


/**
 * Footer Analytics code
 * Adds Analytics code to the footer of the page - log page views only when the page is loaded
 * 
 * @since 1.0.0
 */
function inti_do_footer_analytics() { 
	$analytics_id = stripslashes(get_inti_option('analytics_id', 'inti_footer_options'));
	if ( $analytics_id ) { ?>
		<!-- Google Analytics -->
		<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		ga('create', '<?php echo $analytics_id; ?>', 'auto');
		ga('send', 'pageview');
		</script>
		<!-- End Google Analytics -->
<?php 
	}
}
add_action('inti_hook_footer', 'inti_do_footer_analytics', 2);


/**
 * Footer Custom JS
 * Add custom JS from theme options into the page footer
 * 
 * @since 1.0.0
 */
function inti_do_footer_js() { 
	$customjs = stripslashes(get_inti_option('footer_js', 'inti_footer_options'));
	if ( $customjs ) { ?>
		<!-- Custom JS -->
		<script>
			<?php echo $customjs; ?>
		</script>
		<!-- End Custom JS -->
<?php 
	}
}
add_action('inti_hook_footer', 'inti_do_footer_js', 3);


?>