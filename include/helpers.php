<?php
/*-----------------------------------------------------------------------------------*/
/*	Helpers and utils functions for theme use
/*-----------------------------------------------------------------------------------*/

/* 	Get theme option function */
if ( !function_exists( 'shamrock_get_option' ) ):
	function shamrock_get_option( $option ) {
		return Kirki::get_option( 'shamrock_settings', $option );
	}
endif;

/* Get list of image sizes to generate for theme use */
if ( !function_exists( 'shamrock_get_image_sizes' ) ):
	function shamrock_get_image_sizes() {

		$sizes = array();

		//Standard (with sidebar)
		if ( shamrock_get_option( 'img_size_standard' ) ) {
			$width = 805;
			$crop = true;
			$ratio = shamrock_get_option( 'img_size_standard_ratio' );
			if ( $ratio == 'original' ) {
				$height = 9999;
				$crop = false;
			} else if ( $ratio == 'custom' ) {
					$ratio = shamrock_get_option( 'img_size_standard_custom' );
					$ratio_opts = explode( ":", $ratio );
					$height = absint( $width * absint( $ratio_opts[1] ) / absint( $ratio_opts[0] ) );
				} else {
				$ratio_opts = explode( "_", $ratio );
				$height = absint( $width * $ratio_opts[1] / $ratio_opts[0] );
			}
			$sizes['smr-thumb'] = array( 'title' => __( 'Standard (with sidebar)', 'shamrock' ), 'args' => array( 'w' => $width, 'h' => $height, 'crop' => $crop ) );
		}

		//Full width (no sidebar)
		if ( shamrock_get_option( 'img_size_full' ) ) {
			$width = 1090;
			$crop = true;
			$ratio = shamrock_get_option( 'img_size_full_ratio' );
			if ( $ratio == 'original' ) {
				$height = 9999;
				$crop = false;
			} else if ( $ratio == 'custom' ) {
					$ratio = shamrock_get_option( 'img_size_full_custom' );
					$ratio_opts = explode( ":", $ratio );
					$height = absint( $width * absint( $ratio_opts[1] ) / absint( $ratio_opts[0] ) );
				} else {
				$ratio_opts = explode( "_", $ratio );
				$height = absint( $width * $ratio_opts[1] / $ratio_opts[0] );
			}
			$sizes['smr-thumb-full'] = array( 'title' => __( 'Full Width (no sidebar)', 'shamrock' ), 'args' => array( 'w' => $width, 'h' => $height, 'crop' => $crop ) );
		}

		$sizes = apply_filters( 'shamrock_modify_image_sizes', $sizes );

		return $sizes;
	}
endif;



/* Include simple numeric pagination */
if ( !function_exists( 'shamrock_pagination' ) ):
	function shamrock_pagination( $prev = '&lsaquo;', $next = '&rsaquo;' ) {
		global $wp_query, $wp_rewrite;
		$wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;
		$pagination = array(
			'base' => @add_query_arg( 'paged', '%#%' ),
			'format' => '',
			'total' => $wp_query->max_num_pages,
			'current' => $current,
			'prev_text' => $prev,
			'next_text' => $next,
			'type' => 'plain'
		);
		if ( $wp_rewrite->using_permalinks() )
			$pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg( 's', get_pagenum_link( 1 ) ) ) . 'page/%#%/', 'paged' );

		if ( !empty( $wp_query->query_vars['s'] ) )
			$pagination['add_args'] = array( 's' => str_replace( ' ', '+', get_query_var( 's' ) ) );

		$links = paginate_links( $pagination );

		if ( $links ) {
			return $links;
		}
	}
endif;


/* Convert hexdec color string to rgba */
if ( !function_exists( 'shamrock_hex2rgba' ) ):
	function shamrock_hex2rgba( $color, $opacity = false ) {
		$default = 'rgb(0,0,0)';

		//Return default if no color provided
		if ( empty( $color ) )
			return $default;

		//Sanitize $color if "#" is provided
		if ( $color[0] == '#' ) {
			$color = substr( $color, 1 );
		}

		//Check if color has 6 or 3 characters and get values
		if ( strlen( $color ) == 6 ) {
			$hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
		} elseif ( strlen( $color ) == 3 ) {
			$hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
		} else {
			return $default;
		}

		//Convert hexadec to rgb
		$rgb =  array_map( 'hexdec', $hex );

		//Check if opacity is set(rgba or rgb)
		if ( $opacity ) {
			if ( abs( $opacity ) > 1 ) { $opacity = 1.0; }
			$output = 'rgba('.implode( ",", $rgb ).','.$opacity.')';
		} else {
			$output = 'rgb('.implode( ",", $rgb ).')';
		}

		//Return rgb(a) color string
		return $output;
	}

endif;


/* Get All Translation Strings */
if ( !function_exists( 'shamrock_get_translate_options' ) ):
	function shamrock_get_translate_options() {
		global $shamrock_translate;
		get_template_part( 'include/translate' );
		$translate = apply_filters( 'shamrock_modify_translate_options', $shamrock_translate );
		return $translate;
	}
endif;


/* Trim chars of string */
if ( !function_exists( 'shamrock_trim_chars' ) ):
	function shamrock_trim_chars( $string, $limit, $more = '...' ) {

		if ( !empty( $limit ) && strlen( $string ) > $limit ) {
			$last_space = strrpos( substr( $string, 0, $limit ), ' ' );
			$string = substr( $string, 0, $last_space );
			$string = rtrim( $string, ".,-?!" );
			$string.= $more;
		}

		return $string;
	}
endif;


/* Generate dynamic CSS */
if ( !function_exists( 'shamrock_generate_dynamic_css' ) ):
	function shamrock_generate_dynamic_css() {
		ob_start();
		get_template_part( 'css/dynamic-css' );
		$output = ob_get_contents();
		ob_end_clean();
		return shamrock_compress_css_code( $output );
		//return  $output ;
	}
endif;

/* Compress CSS Code  */
if ( !function_exists( 'shamrock_compress_css_code' ) ) :
	function shamrock_compress_css_code( $code ) {

		// Remove Comments
		$code = preg_replace( '!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $code );

		// Remove tabs, spaces, newlines, etc.
		$code = str_replace( array( "\r\n", "\r", "\n", "\t", '  ', '    ', '    ' ), '', $code );

		return $code;
	}
endif;

/* Custom function to limit post content words */
if ( !function_exists( 'shamrock_get_excerpt' ) ):
	function shamrock_get_excerpt( $layout = 'lay_a' ) {

		$manual_excerpt = false;

		if ( has_excerpt() ) {
			$content =  get_the_excerpt();
			$manual_excerpt = true;
		} else {
			//$content = apply_filters('the_content',get_the_content(''));
			$text = get_the_content( '' );
			$text = strip_shortcodes( $text );
			$text = apply_filters( 'the_content', $text );
			$content = str_replace( ']]>', ']]&gt;', $text );
		}

		//print_r($content);


		if ( !empty( $content ) ) {
			$limit = shamrock_get_option( 'excerpt_length' );
			if ( !empty( $limit ) || !$manual_excerpt ) {
				$more = shamrock_get_option( 'excerpt_more' );
				$content = wp_strip_all_tags( $content );
				$content = preg_replace( '/\b(https?|ftp|file):\/\/[-A-Z0-9+&@#\/%?=~_|$!:,.;]*[A-Z0-9+&@#\/%=~_|$]/i', '', $content );
				$content = shamrock_trim_chars( $content, $limit, $more );
			}
			return $content;
		}

		return '';

	}
endif;

/* Custom function to get meta data for specific layout */
if ( !function_exists( 'shamrock_get_meta_data' ) ):
	function shamrock_get_meta_data( $force_meta = false ) {

		$output = '';

		//Check for sticky
		if ( is_sticky() ) {
			$output = $output .= '<div class="meta-item"><i class="fa fa-thumb-tack"></i>'.__('Sticky', 'shamrock').'</div>';
		}

		//Check meta options

		if ( !$force_meta ) {

			if ( is_single() ) {
				$metas = shamrock_get_option( 'single_meta' );
			} else {
				$metas = shamrock_get_option( 'meta' );
			}

		} else {

			$metas = array( $force_meta );
		}

		if ( !empty( $metas ) ) {

			foreach ( $metas as $meta_id ) {


				$meta = '';

				switch ( $meta_id ) {

				case 'date':
					$meta = '<i class="fa fa-calendar"></i><span class="updated">'.get_the_date().'</span>';
					break;
				case 'author':
					$author_id = get_post_field( 'post_author', get_the_ID() );
					$meta = '<i class="fa fa-user"></i><span class="vcard author"><span class="fn">'.__('by', 'shamrock').' <a href="'.esc_url( get_author_posts_url( get_the_author_meta( 'ID', $author_id ) ) ).'">'.get_the_author_meta( 'display_name', $author_id ).'</a></span></span>';
					break;

				case 'rtime':
					$meta = shamrock_read_time( get_post_field( 'post_content', get_the_ID() ) );
					if ( !empty( $meta ) ) {
						$meta = '<i class="fa fa-clock-o"></i>'.$meta.' '.__('min read', 'shamrock');
					}
					break;

				case 'comments':
					if ( comments_open() || get_comments_number() ) {
						ob_start();
						comments_popup_link( __('Add Comment', 'shamrock'), __('1 Comment', 'shamrock'), __('% Comments', 'shamrock') );
						$meta = '<i class="fa fa-comments-o"></i>'.ob_get_contents();
						ob_end_clean();
					} else {
						$meta = '';
					}
					break;

				default:
					break;
				}

				if ( !empty( $meta ) ) {
					$output .= '<div class="meta-item">'.$meta.'</div>';
				}
			}
		}


		return $output;

	}
endif;

/* Check if sidebar is used on current template */
if ( !function_exists( 'shamrock_has_sidebar' ) ):
	function shamrock_has_sidebar() {
		if ( is_single() ) {
			return shamrock_get_option( 'single_layout' ) == 'sidebar' ? true : false;
		} else {
			return shamrock_get_option( 'blog_layout' ) == 'sidebar' ? true : false;
		}

	}
endif;


/* 	Calculate reading time by content length */
if ( !function_exists( 'shamrock_read_time' ) ):
	function shamrock_read_time( $text ) {
		$words = str_word_count( strip_tags( $text ) );
		if ( !empty( $words ) ) {
			$time_in_minutes = ceil( $words / 200 );
			return $time_in_minutes;
		}
		return false;
	}
endif;

/* Check if post is paginated */
if ( !function_exists( 'shamrock_is_paginated_post' ) ):
	function shamrock_is_paginated_post() {

		global $multipage;
		return 0 !== $multipage;

	}
endif;


/* Pull audio video or gallery from the post content */
if ( !function_exists( 'shamrock_get_post_media' ) ):
	function shamrock_get_post_media( $format ) {

		$media = '';

		if ( empty( $format ) )
			return $media;

		if ( $format != 'image' ) {
			$media = hybrid_media_grabber( array( 'type' => $format, 'split_media' => true ) );
		} else {
			if ( has_post_thumbnail() ) {
				$media = '<figure class="post-thumbnail">';
				$full_img = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
				$media .= '<a href="'.esc_url( $full_img[0] ).'" class="smr-image-format">'.shamrock_get_featured_image().'</a>';
				if ( $caption = get_post( get_post_thumbnail_id() )->post_excerpt ) {
					$media .= '<figcaption>'.$caption.'</figcaption>';
				}
			}
		}

		return $media;

	}
endif;

/* Get featured image */
if ( !function_exists( 'shamrock_get_featured_image' ) ) :
	function shamrock_get_featured_image( $img_size = false ) {

		$img = '';

		if ( !$img_size ) {
			$img_size = shamrock_has_sidebar() ? 'smr-thumb' : 'smr-thumb-full';
		}

		$img = get_the_post_thumbnail( get_the_ID(), $img_size );

		if ( empty( $img ) && $defimg = shamrock_get_option( 'default_fimg' ) ) {

				$img = '<img src="'.esc_url( $defimg ).'" alt="'.esc_attr( get_the_title() ).'" class="attachment-smr-thumb wp-post-image"/>';
			}

			return $img;
		}
	endif;

/* Placeholder div */
if ( !function_exists( 'shamrock_placeholder_img' ) ) :
	function shamrock_placeholder_img() {
		return '<span class="smr-placeholder-img"><i class="fa fa-file-text-o"></i></span>';
	}
endif;


/* Generate fonts link */
if ( !function_exists( 'shamrock_fonts_url' ) ) :
function shamrock_fonts_url() {
    $fonts_url = '';
 
    $pt_sans_narrow = _x( 'on', 'PT Sans Narrow font: on or off', 'shamrock' );
 	$pt_serif = _x( 'on', 'PT Serif font: on or off', 'shamrock' );
 
    if ( 'off' !== $pt_sans_narrow || 'off' !== $pt_serif ) {
        
        $font_families = array();
 
        if ( 'off' !== $pt_sans_narrow ) {
            $font_families[] = 'PT Sans Narrow:400,700';
        }
 
        if ( 'off' !== $pt_serif ) {
            $font_families[] = 'PT Serif:400,700,400italic';
        }
 
        $query_args = array(
            'family' => urlencode( implode( '|', $font_families ) ),
            'subset' => urlencode( 'latin,latin-ext' ),
        );
 
        $fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
    }
 
    return esc_url_raw( $fonts_url );
}
endif;

?>