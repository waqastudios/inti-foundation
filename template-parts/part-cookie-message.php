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
		// Warning: this loads cookies on first visit, with the option to
		// remove them shortly thereafter in the options, which is not strictly
		// how it should be done. 
		// In the future we'll need to load all cookie types asychronously AFTER
		// settings have been accepted by the client.
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