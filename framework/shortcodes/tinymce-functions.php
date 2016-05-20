<?php
/**
 * TinyMCE Shortcode selector
 * Functions to configure and insert shortcodes into the WP Editor
 *
 * @package Inti
 * @author Stuart Starrs
 * @since 1.0.0
 * @license GNU General Public License v2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 */


/**
 * Add the shortcode picker button to TinyMCE... and the JS files to run it.
 * @since 1.0.0
 */
function inti_add_mce_button() {
	// check user permissions
	if ( !current_user_can( 'edit_posts' ) && !current_user_can( 'edit_pages' ) ) {
		return;
	}
	// check if WYSIWYG is enabled
	if ( 'true' == get_user_option( 'rich_editing' ) ) {
		add_filter( 'mce_external_plugins', 'inti_add_tinymce_plugin' );
		add_filter( 'mce_buttons', 'inti_register_mce_button' );
	}
}
add_action('admin_head', 'inti_add_mce_button');

// Declare script for new button
function inti_add_tinymce_plugin( $plugin_array ) {
	$plugin_array['intifoundationshortcodes'] = get_template_directory_uri() . '/framework/shortcodes/js/inti-tinymce.js';
	return $plugin_array;
}

// Register new button in the editor
function inti_register_mce_button( $buttons ) {
	array_push( $buttons, 'intifoundationshortcodes' );
	return $buttons;
}



/**
 * Enable font size & font family selects in the editor
 * @since 1.0.0
 */
if ( ! function_exists( 'inti_mce_standard_buttons' ) ) {
	function inti_mce_standard_buttons( $buttons ) {
		array_unshift( $buttons, 'fontselect' ); // Add Font Select
		array_unshift( $buttons, 'fontsizeselect' ); // Add Font Size Select
		return $buttons;
	}
}
add_filter( 'mce_buttons_2', 'inti_mce_standard_buttons' );


// Customize mce editor font sizes
if ( ! function_exists( 'inti_mce_text_sizes' ) ) {
	function inti_mce_text_sizes( $initArray ){
		$fontsizes_array = inti_get_typography_font_sizes();
		$fontsizes_string = "";

		foreach ($fontsizes_array as $key => $value) {
			$fontsizes_string .= $key . " ";
		}

		$initArray['fontsize_formats'] = trim($fontsizes_string);
		return $initArray;
	}
}
add_filter( 'tiny_mce_before_init', 'inti_mce_text_sizes' );

// Add custom Fonts to the Fonts list
if ( ! function_exists( 'inti_mce_google_fonts_array' ) ) {
	function inti_mce_google_fonts_array( $initArray ) {
		$googlefonts_array = inti_get_typography_google_fonts();
		$googlefonts_string = "";

		foreach ($googlefonts_array as $key => $value) {
			$googlefonts_string .= $value . "=" . $key . ";";
		}

		$initArray['font_formats'] = trim($googlefonts_string);
		//$initArray['font_formats'] = 'Lato=Lato;Andale Mono=andale mono,times;Arial=arial,helvetica,sans-serif;Arial Black=arial black,avant garde;Book Antiqua=book antiqua,palatino;Comic Sans MS=comic sans ms,sans-serif;Courier New=courier new,courier;Georgia=georgia,palatino;Helvetica=helvetica;Impact=impact,chicago;Symbol=symbol;Tahoma=tahoma,arial,helvetica,sans-serif;Terminal=terminal,monaco;Times New Roman=times new roman,times;Trebuchet MS=trebuchet ms,geneva;Verdana=verdana,geneva;Webdings=webdings;Wingdings=wingdings,zapf dingbats';
			return $initArray;
	}
}
add_filter( 'tiny_mce_before_init', 'inti_mce_google_fonts_array' );




/**
 * Functions we'll need for the TinyMCE shortcode popup.
 *
 */
function inti_shortcode_interface_stylesheets($hook) {
	if ($hook == "post.php" || $hook == "post-new.php"){
		wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/library/css/font-awesome-min.css', array(), '' );
		wp_enqueue_style( 'inti-shortcodes-css', get_template_directory_uri() . '/framework/shortcodes/css/thickbox-shortcodes.css', array(), '' );
	}
}
add_action( 'admin_enqueue_scripts', 'inti_shortcode_interface_stylesheets', 100);


/**
 * Types of shortcode available.
 * @since 1.0.0
 */
function inti_shortcode_add_select() {
	$options = array(
		'inti-button' => __('Button', 'inti'),
		'inti-dropdown-button' => __('Dropdown Button', 'inti'),
		'inti-flex-video' => __('Video', 'inti'),
		'inti-callout' => __('Callout', 'inti'),
		'inti-accordion' => __('Accordion', 'inti'),
		'inti-tabs' => __('Tabs', 'inti'),
		'inti-tooltip' => __('Tooltip', 'inti'),
		'inti-label' => __('Label', 'inti'),
		);
	$options = apply_filters('inti_shortcode_filter_select', $options);

	foreach ($options as $option => $value) {
		echo '<option value="'. $option .'" id="'. $option .'">'. $value .'</option>';
	}
}
add_action('inti_shortcode_select', 'inti_shortcode_add_select');


/**
 * Enqueue javascript files for each shortcode.
 * These can be unqueued in a child theme if a shortcode there overwrites Inti functionality
 * @since 1.0.0
 */
function inti_shortcode_enqueue_shortcodes($hook) {
	if ($hook == "post.php" || $hook == "post-new.php"){

		wp_register_script('inti-shortcode-button', get_template_directory_uri() . '/framework/shortcodes/js/shortcode-button.js', '', filemtime(get_template_directory() . '/framework/shortcodes/js/shortcode-button.js'), TRUE);
		wp_enqueue_script('inti-shortcode-button'); 
		
		wp_register_script('inti-shortcode-dropdown-button', get_template_directory_uri() . '/framework/shortcodes/js/shortcode-dropdown-button.js', '', filemtime(get_template_directory() . '/framework/shortcodes/js/shortcode-dropdown-button.js'), TRUE);
		wp_enqueue_script('inti-shortcode-dropdown-button'); 
		
		wp_register_script('inti-shortcode-flex-video', get_template_directory_uri() . '/framework/shortcodes/js/shortcode-flex-video.js', '', filemtime(get_template_directory() . '/framework/shortcodes/js/shortcode-flex-video.js'), TRUE);
		wp_enqueue_script('inti-shortcode-flex-video'); 
		
		wp_register_script('inti-shortcode-callout', get_template_directory_uri() . '/framework/shortcodes/js/shortcode-callout.js', '', filemtime(get_template_directory() . '/framework/shortcodes/js/shortcode-callout.js'), TRUE);
		wp_enqueue_script('inti-shortcode-callout'); 
		
		wp_register_script('inti-shortcode-accordion', get_template_directory_uri() . '/framework/shortcodes/js/shortcode-accordion.js', '', filemtime(get_template_directory() . '/framework/shortcodes/js/shortcode-accordion.js'), TRUE);
		wp_enqueue_script('inti-shortcode-accordion'); 
		
		wp_register_script('inti-shortcode-tabs', get_template_directory_uri() . '/framework/shortcodes/js/shortcode-tabs.js', '', filemtime(get_template_directory() . '/framework/shortcodes/js/shortcode-tabs.js'), TRUE);
		wp_enqueue_script('inti-shortcode-tabs'); 
		
		wp_register_script('inti-shortcode-tooltip', get_template_directory_uri() . '/framework/shortcodes/js/shortcode-tooltip.js', '', filemtime(get_template_directory() . '/framework/shortcodes/js/shortcode-tooltip.js'), TRUE);
		wp_enqueue_script('inti-shortcode-tooltip'); 
		
		wp_register_script('inti-shortcode-label', get_template_directory_uri() . '/framework/shortcodes/js/shortcode-label.js', '', filemtime(get_template_directory() . '/framework/shortcodes/js/shortcode-label.js'), TRUE);
		wp_enqueue_script('inti-shortcode-label'); 
	}
}
add_action('admin_enqueue_scripts', 'inti_shortcode_enqueue_shortcodes');


/**
 * Button Shortcode - with options
 * @since 1.0.0
 */
function inti_shortcode_add_button() {
	ob_start();?>

	<tr class="option inti-button">
		<td class="label" colspan="2">
			<div class="updated"><p><?php _e("Buttons are convenient tools when you need more traditional actions.", 'inti'); ?></p></div>
		</td>
	</tr>
	<tr class="option inti-button">
		<th class="label">
			<label for="button-content"><?php _e('Button Text', 'inti'); ?></label>
		</th>

		<td class="field">
			<input type="text" name="button-content" id="button-content" value="" class="widefat">
		</td>
	</tr>
	<tr class="option inti-button">
		<th class="label">
			<label for="button-url"><?php _e('URL', 'inti'); ?></label>
		</th>

		<td class="field">
			<input type="text" name="button-url" id="button-url" value="" class="widefat">
		</td>
	</tr>			
	<tr class="option inti-button">
		<th class="label">
			<label for="button-target"><?php _e('Open link in a new window/tab', 'inti'); ?></label>
		</th>

		<td class="field">
			<input type="checkbox" name="button-target" id="button-target" value="_blank">
		</td>
	</tr>
	<tr class="option inti-button">
		<th class="label">
			<label for="button-type"><?php _e('Type', 'inti'); ?></label>
		</th>

		<td class="field">
			<select name="button-type" id="button-type" class="widefat">
				<option value="" selected><?php _e('Primary', 'inti'); ?></option>
				<option value="secondary"><?php _e('Secondary', 'inti'); ?></option>
				<option value="success"><?php _e('Success', 'inti'); ?></option>
				<option value="alert"><?php _e('Alert', 'inti'); ?></option>
				<option value="warning"><?php _e('Warning', 'inti'); ?></option>
				<option value="disabled"><?php _e('Disabled', 'inti'); ?></option>
				<option value="hollow"><?php _e('Primary Hollow', 'inti'); ?></option>
				<option value="secondary hollow"><?php _e('Secondary Hollow', 'inti'); ?></option>
				<option value="success hollow"><?php _e('Success Hollow', 'inti'); ?></option>
				<option value="alert hollow"><?php _e('Alert Hollow', 'inti'); ?></option>
				<option value="warning hollow"><?php _e('Warning Hollow', 'inti'); ?></option>
				<option value="disabled hollow"><?php _e('Disabled Hollow', 'inti'); ?></option>
			</select>
		</td>
	</tr>
	<tr class="option inti-button">
		<th class="label">
			<label for="button-style"><?php _e('Style', 'inti'); ?></label>
		</th>

		<td class="field">
			<select name="button-style" id="button-style" class="widefat">
				<option value="" selected><?php _e('Default', 'inti'); ?></option>
				<option value="tiny"><?php _e('Tiny', 'inti'); ?></option>
				<option value="small"><?php _e('Small', 'inti'); ?></option>
				<option value="large"><?php _e('Large', 'inti'); ?></option>
				<option value="expanded"><?php _e('Default Expanded', 'inti'); ?></option>
				<option value="tiny expanded"><?php _e('Tiny Expanded', 'inti'); ?></option>
				<option value="small expanded"><?php _e('Small Expanded', 'inti'); ?></option>
				<option value="large expanded"><?php _e('Large Expanded', 'inti'); ?></option>
			</select>
		</td>
	</tr>

	<?php
	$html = ob_get_clean();
	$html = apply_filters('inti_shortcode_filter_button', $html);
	echo $html;
}
add_action('inti_shortcode_view', 'inti_shortcode_add_button');

/**
 * Dropdown Button Shortcode - with options
 * @since 1.0.0
 */
function inti_shortcode_add_dropdown_button() {
	ob_start();?>

	<tr class="option inti-dropdown-button">
		<td class="label" colspan="2">
			<div class="updated"><p><?php _e("Dropdown Buttons aren't clickable on their own, clicking them displays more options.", 'inti'); ?></p></div>
		</td>
	</tr>
	<tr class="option inti-dropdown-button">
		<th class="label">
			<label for="dropdown-button-title"><?php _e('Button Text', 'inti'); ?></label>
		</th>

		<td class="field">
			<input type="text" name="dropdown-button-title" id="dropdown-button-title" value="" class="widefat">
		</td>
	</tr>
	<tr class="option inti-dropdown-button">
		<th class="label">
			<label for="dropdown-button-type"><?php _e('Type', 'inti'); ?></label>
		</th>

		<td class="field">
			<select name="dropdown-button-type" id="dropdown-button-type" class="widefat">
				<option value="" selected><?php _e('Primary', 'inti'); ?></option>
				<option value="secondary"><?php _e('Secondary', 'inti'); ?></option>
				<option value="success"><?php _e('Success', 'inti'); ?></option>
				<option value="alert"><?php _e('Alert', 'inti'); ?></option>
				<option value="warning"><?php _e('Warning', 'inti'); ?></option>
				<option value="disabled"><?php _e('Disabled', 'inti'); ?></option>
			</select>
		</td>
	</tr>
	<tr class="option inti-dropdown-button">
		<th class="label">
			<label for="dropdown-button-style"><?php _e('Style', 'inti'); ?></label>
		</th>

		<td class="field">
			<select name="dropdown-button-style" id="dropdown-button-style" class="widefat">
				<option value="" selected><?php _e('Default', 'inti'); ?></option>
				<option value="tiny"><?php _e('Tiny', 'inti'); ?></option>
				<option value="small"><?php _e('Small', 'inti'); ?></option>
				<option value="large"><?php _e('Large', 'inti'); ?></option>
				<option value="expanded"><?php _e('Expanded', 'inti'); ?></option>
			</select>
		</td>
	</tr>
	<tr class="option inti-dropdown-button">
		<th class="label">
			<label for="dropdown-button-align"><?php _e('Reveal Content Alignment', 'inti'); ?></label>
		</th>

		<td class="field">
			<select name="dropdown-button-align" id="dropdown-button-align" class="widefat">
				<option value="" selected><?php _e('Below Button', 'inti'); ?></option>
				<option value="above"><?php _e('Above Button', 'inti'); ?></option>
				<option value="right"><?php _e('Right of Button', 'inti'); ?></option>
				<option value="left"><?php _e('Left of Button', 'inti'); ?></option>
			</select>
		</td>
	</tr>
	<tr class="option inti-dropdown-button">
		<th class="label">
			<label for="dropdown-button-hover"><?php _e('Reveal on hover', 'inti'); ?></label>
		</th>

		<td class="field">
			<input type="checkbox" name="dropdown-button-hover" id="dropdown-button-hover" value="true" class="widefat">
		</td>
	</tr>		
	<tr class="option inti-dropdown-button">
		<th class="label">
			<label for="dropdown-button-icon"><?php _e('Show arrow icon', 'inti'); ?></label>
		</th>

		<td class="field">
			<input type="checkbox" name="dropdown-button-icon" id="dropdown-button-icon" value="dropdown" class="widefat">
		</td>
	</tr>
	<tr class="option inti-dropdown-button">
		<th class="label">
			<label for="dropdown-button-content"><?php _e('Revealed Content', 'inti'); ?></label>
		</th>

		<td class="field">
			<textarea name="dropdown-button-content" id="dropdown-button-content" cols="30" rows="3" class="widefat">
Text, HTML, other shortcodes...
			</textarea>
		</td>
	</tr>

	<?php
	$html = ob_get_clean();
	$html = apply_filters('inti_shortcode_filter_dropdown_button', $html);
	echo $html;
}
add_action('inti_shortcode_view', 'inti_shortcode_add_dropdown_button');


/**
 * Flex Video shortcode - with options
 * @since 1.0.0
 */
function inti_shortcode_add_flex_video() {
	ob_start();?>

	<tr class="option inti-flex-video">
		<th class="label">
			<label for="flex-video-aspect"><?php _e('Aspect Ratio', 'inti'); ?></label>
		</th>

		<td class="field">
			<select name="flex-video-aspect" id="flex-video-aspect" class="widefat">
				<option value="widescreen" selected><?php _e('Widescreen', 'inti'); ?></option>
				<option value="fourthree"><?php _e('4:3', 'inti'); ?></option>
			</select>
		</td>
	</tr>
	<tr class="option inti-flex-video">
		<th class="label">
			<label for="flex-video-source"><?php _e('Source', 'inti'); ?></label>
		</th>

		<td class="field">
			<select name="flex-video-source" id="flex-video-source" class="widefat">
				<option value="youtube" selected><?php _e('YouTube', 'inti'); ?></option>
				<option value="vimeo"><?php _e('Vimeo', 'inti'); ?></option>
				<option value="wistia"><?php _e('Wistia', 'inti'); ?></option>
			</select>
		</td>
	</tr>
	<tr class="option inti-flex-video">
		<th class="label">
			<label for="flex-video-id"><?php _e('Video ID', 'inti'); ?></label>
		</th>

		<td class="field">
			<input type="text" name="flex-video-id" id="flex-video-id" value="" class="widefat">
		</td>
	</tr>

	<?php
	$html = ob_get_clean();
	$html = apply_filters('inti_shortcode_filter_flex_video', $html);
	echo $html;
}
add_action('inti_shortcode_view', 'inti_shortcode_add_flex_video');


/**
 * Callout Shortcode - with options
 * @since 1.0.0
 */
function inti_shortcode_add_callout() {
	ob_start();?>

	<tr class="option inti-callout">
		<td class="label" colspan="2">
			<div class="updated"><p><?php _e("Outline sections of your page easily but wrapping them in a box. Set the area as a 'closable alert' to make an alert box, which can communicate success, warnings, failure or just information.", 'inti'); ?></p></div>
		</td>
	</tr>
	<tr class="option inti-callout">
		<th class="label">
			<label for="callout-type"><?php _e('Type', 'inti'); ?></label>
		</th>

		<td class="field">			
			<select name="callout-type" id="callout-type" class="widefat">
				<option value=""><?php _e('None', 'inti'); ?></option>
				<option value="primary" selected><?php _e('Primary', 'inti'); ?></option>
				<option value="secondary"><?php _e('Secondary', 'inti'); ?></option>
				<option value="success"><?php _e('Success', 'inti'); ?></option>
				<option value="alert"><?php _e('Alert', 'inti'); ?></option>
				<option value="warning"><?php _e('Warning', 'inti'); ?></option>
			</select>
		</td>
	</tr>
	<tr class="option inti-callout">
		<th class="label">
			<label for="callout-style"><?php _e('Style', 'inti'); ?></label>
		</th>

		<td class="field">
			<select name="callout-style" id="callout-style" class="widefat">
				<option value="" selected><?php _e('Default', 'inti'); ?></option>
				<option value="tiny"><?php _e('Small', 'inti'); ?></option>
				<option value="large"><?php _e('Large', 'inti'); ?></option>
			</select>
		</td>
	</tr>
	<tr class="option inti-callout">
		<th class="label">
			<label for="callout-content"><?php _e('Callout Content', 'inti'); ?></label>
		</th>

		<td class="field">
			<textarea name="callout-content" id="callout-content" cols="30" rows="3" class="widefat"></textarea>
		</td>
	</tr>	
	<tr class="option inti-callout">
		<th class="label">
			<label for="callout-close"><?php _e('Closable Alert', 'inti'); ?></label>
		</th>

		<td class="field">
			<input type="checkbox" name="callout-close" id="callout-close" value="true">
		</td>
	</tr>	
	<?php
	$html = ob_get_clean();
	$html = apply_filters('inti_shortcode_filter_callout', $html);
	echo $html;
}
add_action('inti_shortcode_view', 'inti_shortcode_add_callout');


/**
 * Accordion Shortcode - with options
 * @since 1.0.0
 */
function inti_shortcode_add_accordion() {
	ob_start();?>

	<tr class="option inti-accordion">
		<td class="label" colspan="2">
			<div class="updated"><p><?php _e("Accordions are elements used to expand and collapse content that is broken into logical sections, much like tabs.", 'inti'); ?></p></div>
		</td>
	</tr>
	<tr class="option inti-accordion">
		<th class="label">
			<label for="inti-accordion-multiexpand"><?php _e('Allow more than one open at a time', 'inti'); ?></label>
		</th>

		<td class="field">
			<input type="checkbox" name="inti-accordion-multiexpand" id="inti-accordion-multiexpand" value="true">
		</td>
	</tr>
	<tr class="option inti-accordion">
		<th class="label">
			<label for="inti-accordion-allclosed"><?php _e('Allow closing of all tabs', 'inti'); ?></label><br><br>
		</th>

		<td class="field">
			<input type="checkbox" name="inti-accordion-allclosed" id="inti-accordion-allclosed" value="true"><br><br>
		</td>
	</tr>

	<tr class="option inti-accordion">
		<th class="label">
			<label for="accordion-item-1-title"><?php _e('Item Title', 'inti'); ?> <span class="count">1</span></label>
		</th>

		<td class="field">
			<input type="text" name="accordion-item-1-title" id="accordion-item-1-title" value="" class="widefat">
		</td>
	</tr>	

	<tr class="option inti-accordion">
		<th class="label">
			<label for="accordion-item-1-content"><?php _e('Item Text', 'inti'); ?> <span class="count">1</span></label>
		</th>

		<td class="field">
			<textarea name="accordion-item-1-content" id="accordion-item-1-content" cols="30" rows="5" class="widefat"></textarea>
		</td>
	</tr>

<!-- 	<tr class="option inti-accordion">
		<th class="label">
			
		</th>
		<td class="field">
			<p><button id="inti-accordion-add-item" class="button-secondary"><?php _e('Add item', 'inti'); ?></button></p>
		</td>
	</tr> -->

	<?php
	$html = ob_get_clean();
	$html = apply_filters('inti_shortcode_filter_accordion', $html);
	echo $html;
}
add_action('inti_shortcode_view', 'inti_shortcode_add_accordion');


/**
 * Tabs Shortcode - with options
 * @since 1.0.0
 */
function inti_shortcode_add_tabs() {
	ob_start();?>

	<tr class="option inti-tabs">
		<td class="label" colspan="2">
			<div class="updated"><p><?php _e("Tabs are elements that help you organize and navigate multiple documents in a single container. They can be used for switching between items in the container.", 'inti'); ?></p></div>
		</td>
	</tr>
	<tr class="option inti-tabs">
		<th class="label">
			<label for="tabs-orientation"><?php _e('Style', 'inti'); ?></label>
		</th>

		<td class="field">
			<select name="tabs-orientation" id="tabs-orientation" class="widefat">
				<option value="horizontal" selected><?php _e('Horizontal', 'inti'); ?></option>
				<option value="vertical"><?php _e('Vertical', 'inti'); ?></option>
			</select>
		</td>
	</tr>
	<tr class="option inti-tabs">
		<th class="label">
			<label for="tab-item-1-title"><?php _e('Item Title', 'inti'); ?> <span class="count">1</span></label>
		</th>

		<td class="field">
			<input type="text" name="tab-item-1-title" id="tab-item-1-title" value="" class="widefat">
		</td>
	</tr>	

	<tr class="option inti-tabs">
		<th class="label">
			<label for="tab-item-1-content"><?php _e('Item Text', 'inti'); ?> <span class="count">1</span></label>
		</th>

		<td class="field">
			<textarea name="tab-item-1-content" id="tab-item-1-content" cols="30" rows="5" class="widefat"></textarea>
		</td>
	</tr>

<!-- 	<tr class="option inti-tabs">
		<th class="label">
			
		</th>
		<td class="field">
			<p><button id="inti-tabs-add-item" class="button-secondary"><?php _e('Add item', 'inti'); ?></button></p>
		</td>
	</tr> -->

	<?php
	$html = ob_get_clean();
	$html = apply_filters('inti_shortcode_filter_tabs', $html);
	echo $html;
}
add_action('inti_shortcode_view', 'inti_shortcode_add_tabs');


/**
 * Tooltip Shortcode - with options
 * @since 1.0.0
 */
function inti_shortcode_add_tooltip() {
	ob_start();?>

	<tr class="option inti-tooltip">
		<td class="label" colspan="2">
			<div class="updated"><p><?php _e("Tooltips are a quick way to provide extended information on a term or action on a page. You can wrap these around words, buttons, images or just about anything else in your page.", 'inti'); ?></p></div>
		</td>
	</tr>
	<tr class="option inti-tooltip">
		<th class="label">
			<label for="tooltip-title"><?php _e('Title', 'inti'); ?></label>
		</th>

		<td class="field">
			<input type="text" name="tooltip-title" id="tooltip-title" value="" class="widefat">
		</td>
	</tr>
	<tr class="option inti-tooltip">
		<th class="label">
			<label for="tooltip-type"><?php _e('Type', 'inti'); ?></label>
		</th>

		<td class="field">
			<select name="tooltip-type" id="tooltip-type" class="widefat">
				<option value="" selected><?php _e('Block', 'inti'); ?></option>
				<option value="inline"><?php _e('Inline', 'inti'); ?></option>
			</select>
		</td>
	</tr>
	<tr class="option inti-tooltip">
		<th class="label">
			<label for="tooltip-direction"><?php _e('Direction', 'inti'); ?></label>
		</th>

		<td class="field">
			<select name="tooltip-direction" id="tooltip-direction" class="widefat">
				<option value="bottom" selected><?php _e('Bottom', 'inti'); ?></option>
				<option value="left"><?php _e('Left', 'inti'); ?></option>
				<option value="right"><?php _e('Right', 'inti'); ?></option>
				<option value="top"><?php _e('Top', 'inti'); ?></option>

			</select>
		</td>
	</tr>
	<tr class="option inti-tooltip">
		<th class="label">
			<label for="tooltip-content"><?php _e('Tooltip Content', 'inti'); ?> <span class="count">1</span></label>
		</th>

		<td class="field">
			<textarea name="tooltip-content" id="tooltip-content" cols="30" rows="5" class="widefat"></textarea>
			<p><small><?php _e('Content the tooltip will be wrapped around.', 'inti'); ?></small></p>
		</td>
	</tr>
	

	<?php
	$html = ob_get_clean();
	$html = apply_filters('inti_shortcode_filter_tooltip', $html);
	echo $html;
}
add_action('inti_shortcode_view', 'inti_shortcode_add_tooltip');


/**
 * Label Shortcode - with options
 * @since 1.0.0
 */
function inti_shortcode_add_label() {
	ob_start();?>

	<tr class="option inti-label">
		<td class="label" colspan="2">
			<div class="updated"><p><?php _e("Labels are useful inline styles that can be dropped into body copy to call out certain sections or to attach metadata. For example, you can attach a label that notes when something was updated.", 'inti'); ?></p></div>
		</td>
	</tr>
	<tr class="option inti-label">
		<th class="label">
			<label for="label-title"><?php _e('Title', 'inti'); ?></label>
		</th>

		<td class="field">
			<input type="text" name="label-title" id="label-title" value="" class="widefat">
		</td>
	</tr>
	<tr class="option inti-label">
		<th class="label">
			<label for="label-type"><?php _e('Type', 'inti'); ?></label>
		</th>

		<td class="field">
			<select name="label-type" id="label-type" class="widefat">
				<option value="" selected><?php _e('Primary', 'inti'); ?></option>
				<option value="secondary"><?php _e('Secondary', 'inti'); ?></option>
				<option value="success"><?php _e('Success', 'inti'); ?></option>
				<option value="warning"><?php _e('Warning', 'inti'); ?></option>
				<option value="alert"><?php _e('Alert', 'inti'); ?></option>
			</select>
		</td>
	</tr>
	<tr class="option inti-label">
		<th class="label">
			<label for="label-icon"><?php _e('Icon', 'inti'); ?></label>
		</th>

		<td class="field">
			<input type="text" additional="label-icon" id="label-icon" value="" class="widefat">
		</td>
	</tr>

	<?php
	$html = ob_get_clean();
	$html = apply_filters('inti_shortcode_filter_label', $html);
	echo $html;
}
add_action('inti_shortcode_view', 'inti_shortcode_add_label');


/**
 * Hooks for shortcodes
 */
function inti_shortcode_select() {
	do_action('inti_shortcode_select');
}

function inti_shortcode_view() {
	do_action('inti_shortcode_view');
}



?>