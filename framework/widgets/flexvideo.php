<?php

class inti_widget_flexvideo extends WP_Widget {
	function inti_widget_flexvideo() {
		$widget_ops = array('classname' => 'inti_flexvideo', 'description' => __('Add a video to your sidebar', 'inti') );
		$this->WP_Widget('inti_widget_flexvideo', 'Video', $widget_ops);
	}
 
	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'videoaspect' => '', 'videosource' => '', 'videoid' => '' ) );
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
 
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = $new_instance['title'];
		$instance['videoaspect'] = $new_instance['videoaspect'];
		$instance['videosource'] = $new_instance['videosource'];
		$instance['videoid'] = $new_instance['videoid'];
		return $instance;
	}
 
	function widget($args, $instance) {
		extract($args, EXTR_SKIP);
		echo $before_widget;
		$title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
		$videoaspect = empty($instance['videoaspect']) ? ' ' : apply_filters('widget_title', $instance['videoaspect']);
		$videosource = empty($instance['videosource']) ? ' ' : apply_filters('widget_title', $instance['videosource']);
		$videoid = empty($instance['videoid']) ? ' ' : apply_filters('widget_title', $instance['videoid']);
 
		if (trim($title)) {
			echo "<h4>$title</h4>";
		}
 
		// WIDGET CODE GOES HERE
		$html = '<div class="flex-video '. $videoaspect .' '. $videosource .'">';
		switch ($videosource) {
			case 'youtube' :
				$html .= '<iframe src="http://www.youtube.com/embed/'. $videoid .'?wmode=opaque&showsearch=0&rel=0&modestbranding=1&showinfo=0&controls=2" frameborder="0" allowfullscreen></iframe>';
				break;
			case 'vimeo' :
				$html .= '<iframe src="http://player.vimeo.com/video/'. $videoid .'?title=0&amp;byline=0&amp;portrait=0&amp;color=ff0179" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
				break;
			case 'wistia' :
				$html .= '<iframe src="http://fast.wistia.net/embed/iframe/'. $videoid .'?plugin%5Bsocialbar-v1%5D%5Bon%5D=false" frameborder="0" allowtransparency="true" allowfullscreen scrolling="no"></iframe>';
				break;
		}

		$html .= '</div>';
		
		echo $html;

		echo $after_widget;
	}
 
}
add_action( 'widgets_init', create_function('', 'return register_widget("inti_widget_flexvideo");') );
?>