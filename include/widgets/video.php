<?php
/*-----------------------------------------------------------------------------------*/
/*	Video Widget Class
/*-----------------------------------------------------------------------------------*/

class SMR_Video_Widget extends WP_Widget { 

	var $defaults;

	function __construct() {
		$widget_ops = array( 'classname' => 'shamrock_video_widget', 'description' => __('You can easily place YouTube or Vimeo video here', 'shamrock') );
		$control_ops = array( 'id_base' => 'shamrock_video_widget' );
		parent::__construct( 'shamrock_video_widget', __('Shamrock Video', 'shamrock'), $widget_ops, $control_ops );

		$this->defaults = array( 
				'title' => __('Video', 'shamrock'),
				'video_id' => '',
				'type' => 'youtube',
				'height' => 144,
				'content' => ''
			);
	}

	function widget( $args, $instance ) {
		extract( $args );
		$instance = wp_parse_args( (array) $instance, $this->defaults );
		$title = apply_filters('widget_title', $instance['title'] );
		
		echo $before_widget;

		if ( !empty($title) ) {
			echo $before_title . $title . $after_title;
		}
		?>
		<div class="video-widget-inside">
		<?php if(!empty($instance['video_id'])) : ?>

			<?php $protocol =  is_ssl() ? 'https://' : 'http://'; ?>

			<?php if($instance['type'] == 'youtube') : ?>
			
				<iframe width="100%" height="<?php echo absint($instance['height']); ?>" src="<?php echo $protocol;?>www.youtube.com/embed/<?php echo esc_attr($instance['video_id']); ?>?showinfo=0;controls=0" frameborder="0" allowfullscreen></iframe>
			
			<?php elseif($instance['type'] == 'vimeo') : ?>
				
				<iframe width="100%" height="<?php echo absint($instance['height']); ?>" src="<?php echo $protocol;?>player.vimeo.com/video/<?php echo esc_attr($instance['video_id']);?>?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
			
			<?php endif; ?>
			
		<?php endif; ?>
		
		<?php if(!empty($instance['content'])) : ?>
			<?php echo wpautop($instance['content']);?>
		<?php endif; ?>
		
		<div class="clear"></div>
		
		</div>
		
		<?php
		echo $after_widget;
	}

	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['video_id'] = strip_tags( $new_instance['video_id'] );
		$instance['type'] = $new_instance['type'];
		$instance['height'] = absint($new_instance['height']);
		$instance['content'] = $new_instance['content'];
		return $instance;
	}

	function form( $instance ) {
	
		$instance = wp_parse_args( (array) $instance, $this->defaults ); ?>
				
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title', 'shamrock'); ?>:</label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" type="text" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr($instance['title']); ?>" class="widefat" />
		</p>
		
		<p>
			<label><?php _e('Video type', 'shamrock'); ?>:</label><br/>
			<input type="radio" name="<?php echo $this->get_field_name( 'type' ); ?>" value="youtube" <?php checked($instance['type'],'youtube'); ?>/>
			<label><?php _e('YouTube', 'shamrock'); ?></label><br/>
			<input type="radio" name="<?php echo $this->get_field_name( 'type' ); ?>" value="vimeo" <?php checked($instance['type'],'vimeo'); ?>/>
			<label><?php _e('Vimeo', 'shamrock'); ?></label>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'video_id' ); ?>"><?php _e('Video ID', 'shamrock'); ?>:</label>
			<input id="<?php echo $this->get_field_id( 'video_id' ); ?>" type="text" name="<?php echo $this->get_field_name( 'video_id' ); ?>" value="<?php echo esc_attr($instance['video_id']); ?>" class="widefat" />
			<small class="howto"><?php _e('ID example', 'shamrock'); ?>: XsEMu5UCy0g</small>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'height' ); ?>"><?php _e('Height', 'shamrock'); ?>: </label>
			<input id="<?php echo $this->get_field_id( 'height' ); ?>" type="text" name="<?php echo $this->get_field_name( 'height' ); ?>" value="<?php echo absint($instance['height']); ?>" class="small-text" /> px
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'content' ); ?>"><?php _e('Description (optional)', 'shamrock'); ?>:</label>
			<textarea id="<?php echo $this->get_field_id( 'content' ); ?>" rows="5" name="<?php echo $this->get_field_name( 'content' ); ?>" class="widefat"><?php echo $instance['content']; ?></textarea>
		</p>
		
	<?php
	}
}

?>