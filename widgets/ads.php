<?php
/*-----------------------------------------------------------------------------------*/
/*	Ads Widget Class
/*-----------------------------------------------------------------------------------*/

class Flipster_Ads_Widget extends WP_Widget {

	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {
		$widget_ops = array(
			'class_name' => 'flipster_ads_widget',
			'description' => __( 'For inserting ads code (Not visible in post preview)', 'flipster' ),
		);
		parent::__construct( 'flipster_ads_widget', 'Flipster Ads Widget', $widget_ops );
	}

	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
    if( !is_preview() ) {
      echo $args['before_widget'];
  		if ( ! empty( $instance['title'] ) ) {
  			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
  		}
      echo '<div class="tm-ads-widget">';
  		echo $instance['ads_code'];
      echo '</div>';
  		echo $args['after_widget'];
    }
	}

	/**
	 * Outputs the options form on admin
	 *
	 * @param array $instance The widget options
	 */
	public function form( $instance ) {
    $title = ! empty( $instance['title'] ) ? $instance['title'] : __( '', 'flipster' );
    $ads_code = ! empty( $instance['ads_code'] ) ? $instance['ads_code'] : __( '', 'flipster' );
		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
		<label for="<?php echo $this->get_field_id( 'ads_code' ); ?>"><?php _e( 'Ad Code:' ); ?></label>
		<textarea class="widefat" rows="16" cols="20" id="<?php echo $this->get_field_id( 'ads_code' ); ?>" name="<?php echo $this->get_field_name( 'ads_code' ); ?>"><?php echo esc_attr( $ads_code ); ?></textarea>
		</p>
		<?php
	}

	/**
	 * Processing widget options on save
	 *
	 * @param array $new_instance The new options
	 * @param array $old_instance The previous options
	 */
	public function update( $new_instance, $old_instance ) {
    $instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
    $instance['ads_code'] = ( ! empty( $new_instance['ads_code'] ) ) ? $new_instance['ads_code'] : '';

		return $instance;
	}
}
