<?php
/**
 * Responsive Embed Widget
 *
 * @package Inti
 * @since 1.3.0
 */
class inti_widget_responsive_embed extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'inti_responsive_embed', // Base ID
			__( 'Responsive Embed', 'inti' ), // Name
			array( 'description' => __( 'Add an iframe to your sidebar', 'inti' ), ) // Args
		);
	}

 	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {

		// Output before widget
		echo $args['before_widget'];

		// Title for Widget
		$title = "";
		if ( ! empty( $instance['title'] ) ) {
			$title = $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
			echo trim($title);
		}

		// Custom values for widget
		$iframeaspect = empty($instance['iframeaspect']) ? ' ' : apply_filters('widget_title', $instance['iframeaspect']);
		$iframehtml = empty($instance['iframehtml']) ? ' ' : $instance['iframehtml'];
 
		
		
 
		// WIDGET CODE GOES HERE
		$html = '<div class="responsive-embed '. $iframeaspect .'">';
		$html .= $iframehtml;
		$html .= '</div>';
		
		echo $html;

		// Output after widget
		echo $args['after_widget'];

	}
	
	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'iframeaspect' => '', 'videosource' => '', 'iframehtml' => '' ) );
		$title = $instance['title'];
		$iframeaspect = $instance['iframeaspect'];
		$iframehtml = $instance['iframehtml'];
	?>
	<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'inti'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>

	<p><label for="<?php echo $this->get_field_id('iframeaspect'); ?>"><?php _e('Aspect Ratio', 'inti') ?>: 
		<select name="<?php echo $this->get_field_name('iframeaspect'); ?>" id="<?php echo $this->get_field_id('iframeaspect'); ?>" class="widefat">
			<option value="widescreen" <?php selected( 'widescreen', $iframeaspect ); ?>><?php _e('Widescreen (16:9)', 'inti'); ?></option>
			<option value="fourthree" <?php selected( 'fourthree', $iframeaspect ); ?>><?php _e('Standard (4:3)', 'inti'); ?></option>
			<option value="panorama" <?php selected( 'panorama', $iframeaspect ); ?>><?php _e('Panorama (256:81)', 'inti'); ?></option>
			<option value="square" <?php selected( 'square', $iframeaspect ); ?>><?php _e('Square (1:1)', 'inti'); ?></option>
			<option value="vertical" <?php selected( 'vertical', $iframeaspect ); ?>><?php _e('Vertical (9:16)', 'inti'); ?></option>
		</select>
	</label></p>

	<p><label for="<?php echo $this->get_field_id('iframehtml'); ?>"><?php _e('iframe HTML', 'inti') ?>: 
		<textarea class="widefat" name="<?php echo $this->get_field_name('iframehtml'); ?>" id="<?php echo $this->get_field_id('iframehtml'); ?>" cols="30" rows="3"><?php echo $iframehtml; ?></textarea>	
	</label></p>
<?php
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = $new_instance['title'];
		$instance['iframeaspect'] = $new_instance['iframeaspect'];
		$instance['iframehtml'] = $new_instance['iframehtml'];
		return $instance;
	}
 
}
add_action( 'widgets_init', function(){ register_widget( 'inti_widget_responsive_embed' ); });
