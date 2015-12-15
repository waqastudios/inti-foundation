<?php
/**
 * TinyMCE Interface
 * Open a window where we can select and insert a shortcode to 
 * a TinyMCE window.
 *
 * @package Inti
 * @since 1.0.0
 * @license GNU General Public License v2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 */
 
$absolute_path = __FILE__;
$path_to_file = explode('wp-content', $absolute_path);
$path_to_wordpress = $path_to_file[0];
require_once( $path_to_wordpress.'/wp-load.php' );
?>


<div class="inti-shortcode-picker">
	<table class="form-table">
		<tbody>
			<tr>
				<th class="label">
					<label for="shortcode-picker"><?php _e('Shortcodes', 'inti'); ?></label>
				</th>
				<td class="field">
					<select name="shortcode-picker" id="shortcode-picker" class="widefat">
						<option value=""><?php _e('Select Shortcode', 'inti'); ?></option>
						<?php inti_shortcode_select(); ?>
					</select>
				</td>
			</tr>

			<?php inti_shortcode_view(); ?>
			
			<tr>
				<th class="label">
					<label for="shortcode-dropdown"><?php _e('Your shortcode', 'inti'); ?></label>
				</th>
				<td class="field">
					<code id="yourshortcode"></code>
				</td>
			</tr>
			<tr>
				<th class="label"></th>
				<td class="field">
					<p><button id="shortcode-insert" class="button-primary"><?php _e('Insert Shortcode', 'inti'); ?></button></p>
				</td>

			</tr>
		</tbody>
	</table>
</div>