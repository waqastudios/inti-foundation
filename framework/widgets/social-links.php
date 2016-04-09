<?php

class inti_widget_social_links extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'inti_social_links', // Base ID
			__( 'Social Links', 'inti' ), // Name
			array( 'description' => __( 'Displays icons that link to social media profiles given in theme options', 'inti' ), ) // Args
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
 
		echo inti_get_widget_social_links();

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
	public function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
		$title = $instance['title'];
	?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'inti'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
		
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
	public function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = $new_instance['title'];
		return $instance;
	}

 
}
add_action( 'widgets_init', function(){ register_widget( 'inti_widget_social_links' ); });
?>