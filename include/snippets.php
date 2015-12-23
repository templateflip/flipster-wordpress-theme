<?php
/*-----------------------------------------------------------------------------------*/
/*	Include snippets to modify/add some features to this theme
/*-----------------------------------------------------------------------------------*/

/* Allow shortcodes in widgets */
add_filter( 'widget_text', 'do_shortcode' );

/* Add classes to body tag */
if ( !function_exists( 'shamrock_body_class' ) ):
	function shamrock_body_class( $classes ) {

		//Add class if featured image is turned off
		if( ( is_single() && !shamrock_get_option('single_show_fimg') ) || ( ( is_front_page() || is_archive() ) && !shamrock_get_option('show_fimg') ) ){
			$classes[] = 'smr-nofimg';
		}

		return $classes;
	}
endif;

add_filter( 'body_class', 'shamrock_body_class' );

/* Backwards support for wp title tag ( if version < wp 4.1) */
if ( ! function_exists( '_wp_render_title_tag' ) ) :

	if ( ! function_exists( 'shamrock_render_title' ) ) :
		function shamrock_render_title() { ?>
			<title><?php wp_title( '|', true, 'right' ); ?></title>
		<?php } ?>
	<?php endif; ?>

<?php

	add_action( 'wp_head', 'shamrock_render_title' );

	/* Add wp_title filter */
	if ( !function_exists( 'shamrock_wp_title' ) ):
		function shamrock_wp_title( $title, $sep ) {
			global $paged, $page;

			if ( is_feed() )
				return $title;

			// Add the site name.
			$title .= get_bloginfo( 'name' );

			// Add the site description for the home/front page.
			$site_description = get_bloginfo( 'description', 'display' );
			if ( $site_description && ( is_home() || is_front_page() ) )
				$title = "$title $sep $site_description";

			// Add a page number if necessary.
			if ( $paged >= 2 || $page >= 2 )
				$title = "$title $sep " . sprintf( __( 'Page %s', 'shamrock' ), max( $paged, $page ) );

			return $title;
		}
	endif;

	add_filter( 'wp_title', 'shamrock_wp_title', 10, 2 );

endif;



/* Show welcome message and quick tips after theme activation */
if ( !function_exists( 'shamrock_welcome_msg' ) ):
	function shamrock_welcome_msg() {
		if ( !get_option( 'shamrock_welcome_box_displayed' ) ) { update_option( 'shamrock_theme_version', THEME_VERSION ); ?>
			<?php include_once THEME_DIR.'sections/welcome-panel.php';?>
		<?php
		}
	}
endif;



/* Function that outputs the contents of our dashboard widget */
if ( !function_exists( 'shamrock_dashboard_widget_cb' ) ):
	function shamrock_dashboard_widget_cb() {
		
		$hide = false;
		if ( $data = get_transient( 'shamrock_mksaw' ) ) {
			if ( $data != 'error' ) {
				echo $data;
			} else {
				$hide = true;
			}
		} else {
			
			$url = 'http://demo.mekshq.com/mksaw-free.php';
			$args = array( 'body' => array( 'key' => md5( 'meks' ), 'theme' => 'shamrock' ) );
			$response = wp_remote_post( $url, $args );
			if ( !is_wp_error( $response ) ) {
				$json = wp_remote_retrieve_body( $response );
				if ( !empty( $json ) ) {
					$json = ( json_decode( $json ) );
					if ( isset( $json->data ) ) {
						echo $json->data;
						set_transient( 'shamrock_mksaw', $json->data, 86400 );
					} else {
						set_transient( 'shamrock_mksaw', 'error', 86400 );
						$hide = true;
					}
				} else {
					set_transient( 'shamrock_mksaw', 'error', 86400 );
					$hide = true;
				}

			} else {
				set_transient( 'shamrock_mksaw', 'error', 86400 );
				$hide = true;
			}
		}

		if ( $hide ) {
			echo '<style>#shamrock_dashboard_widget {display:none;}</style>'; //hide widget if data is not returned properly
		}

	}
endif;

/* Add dashboard widget */
if ( !function_exists( 'shamrock_add_dashboard_widgets' ) ):
	function shamrock_add_dashboard_widgets() {
		add_meta_box( 'shamrock_dashboard_widget', 'Meks - WordPress Themes & Plugins', 'shamrock_dashboard_widget_cb', 'dashboard', 'side', 'high' );
	}
endif;

add_action( 'wp_dashboard_setup', 'shamrock_add_dashboard_widgets' );




/* Change default arguments of flickr widget plugin */
if ( !function_exists( 'shamrock_flickr_widget_defaults' ) ):
	function shamrock_flickr_widget_defaults( $defaults ) {

		$defaults['t_width'] = 73;
		$defaults['t_height'] = 73;
		return $defaults;
	}
endif;

add_filter( 'mks_flickr_widget_modify_defaults', 'shamrock_flickr_widget_defaults' );


/* Change default arguments of author widget plugin */
if ( !function_exists( 'shamrock_author_widget_defaults' ) ):
	function shamrock_author_widget_defaults( $defaults ) {
		$defaults['avatar_size'] = 60;
		return $defaults;
	}
endif;

add_filter( 'mks_author_widget_modify_defaults', 'shamrock_author_widget_defaults' );

/* Change default arguments of social widget plugin */
if ( !function_exists( 'shamrock_social_widget_defaults' ) ):
	function shamrock_social_widget_defaults( $defaults ) {
		$defaults['size'] = 40;
		$defaults['style'] = 'circle';
		return $defaults;
	}
endif;

add_filter( 'mks_social_widget_modify_defaults', 'shamrock_social_widget_defaults' );




/* Add class to gallery images to run our pop-up */
if ( !function_exists( 'shamrock_gallery_atts' ) ):
	function shamrock_gallery_atts( $output, $pairs, $atts ) {

		if ( isset( $atts['link'] ) && $atts['link'] == 'file' ) {
			add_filter( 'wp_get_attachment_link', 'shamrock_add_class_attachment_link', 10, 1 );
		} else {
			remove_filter( 'wp_get_attachment_link', 'shamrock_add_class_attachment_link' );
		}

		if ( !isset( $output['columns'] ) ) {
			$output['columns'] = 1;
		}

		if ( $output['columns'] == 1 ) {
			$output['size'] = 'smr-thumb';
		}

		return $output;
	}
endif;

if ( !function_exists( 'shamrock_add_class_attachment_link' ) ):
	function shamrock_add_class_attachment_link( $link ) {
		$link = str_replace( '<a', '<a class="smr-popup"', $link );
		return $link;
	}
endif;

add_filter( 'shortcode_atts_gallery', 'shamrock_gallery_atts', 10, 3 );


/* Add theme generated image sizes to media editor */

if ( !function_exists( 'shamrock_add_sizes_media_editor' ) ):
	function shamrock_add_sizes_media_editor( $sizes ) {

		$shamrock_sizes = shamrock_get_image_sizes();

		if ( !empty( $shamrock_sizes ) ) {
			foreach ( $shamrock_sizes as $id => $size ) {
				$sizes[$id] = $size['title'];
			}
		}

		return $sizes;
	}
endif;

add_filter( 'image_size_names_choose', 'shamrock_add_sizes_media_editor' );


/* Add media grabber features */
if ( !function_exists( 'shamrock_add_media_grabber' ) ):
	function shamrock_add_media_grabber() {
		if ( !class_exists( 'Hybrid_Media_Grabber' ) ) {
			include_once 'classes/class-hybrid-media-grabber.php';
		}
	}
endif;

add_action( 'init', 'shamrock_add_media_grabber' );

if(!function_exists('shamrock_check_default_fimg_class')):
function shamrock_check_default_fimg_class( $classes ) {
	if(!is_single() && shamrock_get_option( 'show_fimg' ) && shamrock_get_option( 'default_fimg' )){
		$classes[] = 'has-post-thumbnail';
	}
	return $classes;
}
endif;

add_filter( 'post_class', 'shamrock_check_default_fimg_class' );

?>