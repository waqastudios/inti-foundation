<?php

class inti_widget_image extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'inti_image', // Base ID
			__( 'Image', 'inti' ), // Name
			array( 'description' => __( 'Displays a linkable image in the sidebar', 'inti' ), ) // Args
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
		$imgurl = empty($instance['imgurl']) ? ' ' : apply_filters('widget_title', $instance['imgurl']);
		$imgalt = empty($instance['imgalt']) ? ' ' : apply_filters('widget_title', $instance['imgalt']);
		$linkurl = empty($instance['linkurl']) ? ' ' : apply_filters('widget_title', $instance['linkurl']);
 
		if ( ! empty( $imgurl ) ) : ?>

			<?php if ($linkurl) : ?>
			<a href="<?php echo $linkurl; ?>">
			<?php endif; ?>

				<?php if ($linkurl) : ?>
				<?php inti_do_srcset_image($imgurl, $imgalt); ?>
				<?php endif; ?>

			<?php if ($linkurl) : ?>
			</a>
			<?php endif; 

		else : ?>

			<div class="callout alert">
				<p><?php e_('No image added to this image widget', 'inti') ?></p>
			</div>

		<?php
		endif;

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
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'imgurl' => '', 'imgalt' => '', 'linkurl' => '' ) );
		$title = $instance['title'];
		$imgurl = $instance['imgurl'];
		$imgalt = $instance['imgalt'];
		$linkurl = $instance['linkurl'];

		wp_enqueue_media();	
		wp_enqueue_style('thickbox');
		wp_enqueue_script('thickbox');
		wp_register_script( 'image-widget', get_template_directory_uri() . '/framework/widgets/js/image.js', array('jquery'), "", TRUE );
		wp_enqueue_script('image-widget');

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
		$instance['imgurl'] = $new_instance['imgurl'];
		$instance['imgalt'] = $new_instance['imgalt'];
		$instance['linkurl'] = $new_instance['linkurl'];
		return $instance;
	}

 
}
add_action( 'widgets_init', function(){ register_widget( 'inti_widget_image' ); });
?>