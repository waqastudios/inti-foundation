<?php

class inti_widget_flexvideo extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'inti_flexvideo', // Base ID
			__( 'Video', 'inti' ), // Name
			array( 'description' => __( 'Add a video to your sidebar', 'inti' ), ) // Args
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
		$videoaspect = empty($instance['videoaspect']) ? ' ' : apply_filters('widget_title', $instance['videoaspect']);
		$videosource = empty($instance['videosource']) ? ' ' : apply_filters('widget_title', $instance['videosource']);
		$videoid = empty($instance['videoid']) ? ' ' : apply_filters('widget_title', $instance['videoid']);
 
		
		
 
		// WIDGET CODE GOES HERE
		$html = '<div class="flex-video '. $videoaspect .' '. $videosource .'">';
		switch ($videosource) {
			case 'youtube' :
				$html .= '<iframe src="//www.youtube.com/embed/'. $videoid .'?wmode=opaque&showsearch=0&rel=0&modestbranding=1&showinfo=0&controls=2" frameborder="0" allowfullscreen></iframe>';
				break;
			case 'vimeo' :
				$html .= '<iframe src="//player.vimeo.com/video/'. $videoid .'?title=0&amp;byline=0&amp;portrait=0&amp;color=ff0179" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
				break;
			case 'wistia' :
				$html .= '<iframe src="//fast.wistia.net/embed/iframe/'. $videoid .'?plugin%5Bsocialbar-v1%5D%5Bon%5D=false" frameborder="0" allowtransparency="true" allowfullscreen scrolling="no"></iframe>';
				break;
		}

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
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'videoaspect' => '', 'videosource' => '', 'videoid' => '' ) );
		$title = $instance['title'];
		$videoaspect = $instance['videoaspect'];
		$videosource = $instance['videosource'];
		$videoid = $instance['videoid'];
	?>
	<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'inti'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>

	<p><label for="<?php echo $this->get_field_id('videoaspect'); ?>"><?php _e('Aspect Ratio', 'inti') ?>: 
		<select name="<?php echo $this->get_field_name('videoaspect'); ?>" id="<?php echo $this->get_field_id('videoaspect'); ?>" class="widefat">
			<option value="widescreen" <?php selected( 'widescreen', $videoaspect ); ?>><?php _e('Widescreen', 'inti'); ?></option>
			<option value="fourthree" <?php selected( 'fourthree', $videoaspect ); ?>><?php _e('4:3', 'inti'); ?></option>
		</select>
	</label></p>

	<p><label for="<?php echo $this->get_field_id('videosource'); ?>"><?php _e('Video Source', 'inti') ?>: 
			<select name="<?php echo $this->get_field_name('videosource'); ?>" id="<?php echo $this->get_field_id('videosource'); ?>" class="widefat">
				<option value="youtube" <?php selected( 'youtube', $videosource ); ?>><?php _e('YouTube', 'inti'); ?></option>
				<option value="vimeo" <?php selected( 'vimeo', $videosource ); ?>><?php _e('Vimeo', 'inti'); ?></option>
				<option value="wistia" <?php selected( 'wistia', $videosource ); ?>><?php _e('Wistia', 'inti'); ?></option>
			</select>
	</label></p>

	<p><label for="<?php echo $this->get_field_id('videoid'); ?>"><?php _e('Video ID (just the ID)', 'inti') ?>: 
		<input class="widefat" id="<?php echo $this->get_field_id('videoid'); ?>" name="<?php echo $this->get_field_name('videoid'); ?>" type="text" value="<?php echo esc_attr($videoid); ?>" />
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
		$instance['videoaspect'] = $new_instance['videoaspect'];
		$instance['videosource'] = $new_instance['videosource'];
		$instance['videoid'] = $new_instance['videoid'];
		return $instance;
	}
 
}
add_action( 'widgets_init', function(){ register_widget( 'inti_widget_flexvideo' ); });
?>