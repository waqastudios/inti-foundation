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
 * Cookie Permissions
 * Adds cookie policy message
 * 
 * @since 1.6.1
 */
function inti_do_footer_cookie_policy() { ?>
	<div class="reveal cookies" id="inti-cookie-policy">
		<?php 
			$allow_no_cookies = get_inti_option('privacy_allow_no_cookies', 'inti_privacy_options');
			$cookie_text = get_inti_option('privacy_cookie_text', 'inti_privacy_options');
			$cookie_accept_button_text = get_inti_option('privacy_cookie_accept_button_text', 'inti_privacy_options');
		 ?>
		<div class="grid-x grid-margin-x grid-margin-y align-middle">
			<div class="mlarge-8 cell">
				<?php echo wpautop($cookie_text); ?>
			</div>
			<div class="mlarge-4 cell">
				<div class="expanded button-group">
					<button class="accept-all-cookies primary button" id="accept-all-cookies-1" type="button">
						<span><?php echo $cookie_accept_button_text; ?></span>
					</button>
					<button class="secondary button hollow" data-open="inti-cookie-policy-manage">
						<span>Manage Options</span>
					</button>
				</div>
			</div>
		</div>

		<div class="reveal cookies" id="inti-cookie-policy-manage" data-reveal data-close-on-click="false">
			<h1>Manage Options</h1>

			<?php 
			// Get existing cookie states
			if ( isset($_COOKIE["needed-cookies"]) ) {
				$needed = $_COOKIE["needed-cookies"];
			} else {
				$needed = 'true';
			}
			if ( isset($_COOKIE["functional-cookies"]) ) {
				$functional = $_COOKIE["functional-cookies"];
			} else {
				$functional = 'true';
			}
			if ( isset($_COOKIE["optional-cookies"]) ) {
				$optional = $_COOKIE["optional-cookies"];
			} else {
				$optional = 'true';
			}

			?>


			<!-- Accept All / [NEEDED]-->
			<div class="grid-x grid-margin-x grid-margin-y align-middle">
				<div class="mlarge-9 cell">
					<h3>Strictly Necessary</h3>
					<p>Cookies needed for the website to work correctly.</p>
				</div>
				<div class="mlarge-3 cell">
					<div class="switch">
						<?php if ($allow_no_cookies) : ?>
							<input class="switch-input" id="needed-cookies" type="checkbox" name="needed-cookies" <?php if ($needed == 'true') { echo 'checked'; } ?>>
							<label class="switch-paddle" for="needed-cookies">
								<span class="show-for-sr">Allow Strictly Necessary Cookies?</span>
								<span class="switch-active" aria-hidden="true">Yes</span>
								<span class="switch-inactive" aria-hidden="true">No</span>
							</label>
						<?php else : 
							// Force-set cookie permissions to yes
						?>
							<button class="button hollow" id="needed-cookies-forced" disabled>Always On</button>
						<?php endif; ?>
						
					</div>
				</div>
			</div>

			<!-- [FUNCTIONAL] -->
			<div class="grid-x grid-margin-x grid-margin-y align-middle">
				<div class="mlarge-9 cell">
					<h3>Important functions</h3>
					<p>Cookies that are needed for the website to work optimally and to remember who you are.</p>
				</div>
				<div class="mlarge-3 cell">
					<div class="switch">
						<input class="switch-input" id="functional-cookies" type="checkbox" name="functional-cookies" <?php if ($functional == 'true') { echo 'checked'; } ?>>
						<label class="switch-paddle" for="functional-cookies">
							<span class="show-for-sr">Allow Important Functional Cookies?</span>
							<span class="switch-active" aria-hidden="true">Yes</span>
							<span class="switch-inactive" aria-hidden="true">No</span>
						</label>
					</div>
				</div>
			</div>

			<!-- [OPTIONAL] -->
			<div class="grid-x grid-margin-x grid-margin-y align-middle">
				<div class="mlarge-9 cell">
					<h3>Optional</h3>
					<p>Cookies that allow us to record statistics that can improve our service and that provide you relevant information.</p>
				</div>
				<div class="mlarge-3 cell">
					<div class="switch">
						<input class="switch-input" id="optional-cookies" type="checkbox" name="optional-cookies" <?php if ($optional == 'true') { echo 'checked'; } ?>>
						<label class="switch-paddle" for="optional-cookies">
							<span class="show-for-sr">Allow Optional Cookies?</span>
							<span class="switch-active" aria-hidden="true">Yes</span>
							<span class="switch-inactive" aria-hidden="true">No</span>
						</label>
					</div>
				</div>
			</div>


			<div class="expanded button-group">
				<button class="accept-all-cookies primary button" id="accept-all-cookies-2" type="button">
					<span>Allow all cookies</span>
				</button>
				<button class="keep-these-settings secondary button hollow" type="button">
					<span>Keep these settings</span>
				</button>
				<button class="block-all-cookies secondary button hollow" type="button">
					<span>Block all cookies</span>
				</button>
			</div>


			<div class="reveal cookies" id="inti-cookie-block" data-reveal data-close-on-click="false">
				<p>Cookies have been blocked and this website is no longer accessible. To manage your cookie configuration, click one of the buttons below.</p>
				<div class="expanded button-group">
					<button class="accept-all-cookies primary button" id="accept-all-cookies-3" type="button">
						<span><?php echo $cookie_accept_button_text; ?></span>
					</button>
					<button class="secondary button hollow" data-open="inti-cookie-policy-manage">
						<span>Manage Options</span>
					</button>
				</div>
			</div>

		</div>

	</div>
	<div class="button-group">
		<button class="button" data-open="inti-cookie-policy">Click me for a modal</button>
	</div>
<?php 
}
add_action('inti_hook_footer_inside', 'inti_do_footer_cookie_policy', 4);


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