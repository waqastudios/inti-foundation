<?php

class inti_widget_inti_image extends WP_Widget {
	function inti_widget_inti_image() {
		$widget_ops = array('classname' => 'inti_image', 'description' => __('Displays a linkable image in the sidebar', 'inti') );
		$this->WP_Widget('inti_widget_inti_image', 'Image', $widget_ops);

		add_action( 'admin_enqueue_scripts', array($this, 'inti_widget_add_js') );
	}

	function inti_widget_add_js($hook) {
		if( $hook == 'widgets.php' ) {
			wp_enqueue_media();	
			wp_enqueue_style('thickbox');
			wp_enqueue_script('thickbox');
			wp_register_script( 'image-widget', get_template_directory_uri() . '/framework/widgets/js/image.js', array('jquery'), "", TRUE );
			wp_enqueue_script('image-widget');
		}
	}
 
	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'imgurl' => '', 'imgalt' => '', 'linkurl' => '' ) );
		$title = $instance['title'];
		$imgurl = $instance['imgurl'];
		$imgalt = $instance['imgalt'];
		$linkurl = $instance['linkurl'];
	?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'inti'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>

		<p>
			<label for="<?php echo $this->get_field_name('imgurl'); ?>"><?php _e('Image:', 'inti'); ?></label>
			<input class="widefat" style="margin-bottom:.5em;" type="text" name="<?php echo $this->get_field_name('imgurl'); ?>" id="<?php echo $this->get_field_id('imgurl'); ?>" value="<?php echo esc_attr( $imgurl );  ?>" />
			<input class="uploadbutton button button-primary" style="width:66px; text-align: center;" name="<?php echo $this->get_field_id('imgurl'); ?>_button" id="<?php echo $this->get_field_id('imgurl'); ?>_button" value="Insert" />
		</p>		

		<p>
			<label for="<?php echo $this->get_field_name('imgalt'); ?>"><?php _e('Alt text:', 'inti'); ?></label>
			<input class="widefat" style="margin-bottom:.5em;" type="text" name="<?php echo $this->get_field_name('imgalt'); ?>" id="<?php echo $this->get_field_id('imgalt'); ?>" value="<?php echo esc_attr( $imgalt );  ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_name('linkurl'); ?>"><?php _e('Link URL:', 'inti' ); ?></label>
			<input style="width: 100%;margin-bottom:.5em;" name="<?php echo $this->get_field_name('linkurl'); ?>" id="<?php echo $this->get_field_id('linkurl'); ?>" type="text" value="<?php echo esc_attr( $linkurl );  ?>" placeholder="http://google.com" />
		</p>
		
<?php
	}
 
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = $new_instance['title'];
		$instance['imgurl'] = $new_instance['imgurl'];
		$instance['imgalt'] = $new_instance['imgalt'];
		$instance['linkurl'] = $new_instance['linkurl'];
		return $instance;
	}

	function widget($args, $instance) {
		extract($args, EXTR_SKIP);
		echo $before_widget;

		$title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
		$imgurl = empty($instance['imgurl']) ? ' ' : apply_filters('widget_title', $instance['imgurl']);
		$imgalt = empty($instance['imgalt']) ? ' ' : apply_filters('widget_title', $instance['imgalt']);
		$linkurl = empty($instance['linkurl']) ? ' ' : apply_filters('widget_title', $instance['linkurl']);
 
		if (!empty($imgurl))
		   
 
		// WIDGET CODE GOES HERE
		?>
		<?php if ($title) : ?>
			<h4><?php echo $title; ?></h4>
		<?php endif; ?>

		<?php if ($linkurl) : ?>
		<a href="<?php echo $linkurl; ?>">
		<?php endif; ?>

			<?php if ($linkurl) : ?>
			<?php inti_do_srcset_image($imgurl, $imgalt); ?>
			<?php endif; ?>

		<?php if ($linkurl) : ?>
		</a>
		<?php endif; ?>

		<?php
		echo $after_widget;
	}
 
}
add_action( 'widgets_init', create_function('', 'return register_widget("inti_widget_inti_image");') );

?>