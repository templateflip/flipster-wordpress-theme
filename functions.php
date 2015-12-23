<?php

/*	Define Theme Vars */
define( 'THEME_DIR', trailingslashit( get_template_directory() ) );
define( 'THEME_URI', trailingslashit( get_template_directory_uri() ) );
define( 'THEME_NAME', 'Shamrock' );
define( 'THEME_VERSION', '1.0.7' );
define( 'JS_URI', trailingslashit( THEME_URI . 'js' ) );
define( 'CSS_URI', trailingslashit( THEME_URI . 'css' ) );
define( 'IMG_DIR', trailingslashit( THEME_DIR . 'images' ) );
define( 'IMG_URI', trailingslashit( THEME_URI . 'images' ) );

/* Define content width */
if ( !isset( $content_width ) ) {
	$content_width = 1090;
}

/*	After Theme Setup Hook */
add_action( 'after_setup_theme', 'shamrock_theme_setup' );

function shamrock_theme_setup() {

	/* Load frontend scripts and styles */
	add_action( 'wp_enqueue_scripts', 'shamrock_load_scripts' );

	/* Register sidebars */
	add_action( 'widgets_init', 'shamrock_register_sidebars' );

	/* Register menus */
	add_action( 'init', 'shamrock_register_menus' );

	/* Register widgets */
	add_action( 'widgets_init', 'shamrock_register_widgets' );

	/* Add localization support */
	load_theme_textdomain( 'shamrock' , THEME_DIR . 'languages' );

	/* Add default posts and comments RSS feed links to head. */
	add_theme_support( 'automatic-feed-links' );

	/* Add support for title tag */
	add_theme_support( 'title-tag' );

	/* Add support for post thumbnails */
	add_theme_support( 'post-thumbnails' );

	/* Add image sizes */
	$image_sizes = shamrock_get_image_sizes();

	if ( !empty( $image_sizes ) ) {
		foreach ( $image_sizes as $id => $size ) {
			add_image_size( $id, $size['args']['w'], $size['args']['h'], $size['args']['crop'] );
		}
	}

	/* Add HTML5 markup */
	add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

	/* Post formats support */
	add_theme_support( 'post-formats', array(
			'image',
			'video',
			'gallery',
			'audio',
		) );

	/*Add editor style */
	add_editor_style( array( 'css/editor-style.css', shamrock_fonts_url() ) );

}


/* Load frontend styles */
function shamrock_load_styles() {

	//Fonts
	wp_enqueue_style( 'smr-fonts', shamrock_fonts_url(), array(), null );

	//Load Bootstrap CSS file
	wp_enqueue_style( 'smr-bootstrap', CSS_URI . 'bootstrap/bootstrap.min.css', false, THEME_VERSION, 'screen, print' );

	//Load FontAwesome CSS file
	wp_enqueue_style( 'smr-fontawesome', CSS_URI . 'fontawesome/css/font-awesome.min.css', false, THEME_VERSION, 'screen, print' );

	//Load main CSS file
	wp_enqueue_style( 'smr-style', THEME_URI . 'style.css', false, THEME_VERSION, 'screen, print' );

	//Optionally add RTL styles
	if ( shamrock_get_option( 'rtl' ) ) {
		wp_enqueue_style( 'smr-rtl', CSS_URI . 'rtl.css', false, THEME_VERSION, 'screen, print' );
	}

	//Add dynamic styles generated from theme options
	wp_add_inline_style( 'smr-style', shamrock_generate_dynamic_css() );

}


/* Load frontend scripts */
function shamrock_load_scripts() {

	shamrock_load_styles();

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_script( 'smr-owl-carousel', JS_URI . 'jquery.owl.carousel.min.js', array( 'jquery' ), THEME_VERSION, true );

	wp_enqueue_script( 'smr-magnific-popup', JS_URI . 'jquery.magnific-popup.min.js', array( 'jquery' ), THEME_VERSION, true );

	wp_enqueue_script( 'smr-fitvids', JS_URI . 'jquery.fitvids.js', array( 'jquery' ), THEME_VERSION, true );

	wp_enqueue_script( 'smr-custom', JS_URI . 'custom.js', array( 'jquery' ), THEME_VERSION, true );

}


/* Helpers and utility functions */
require_once 'include/helpers.php';

/* Menus */
require_once 'include/menus.php';

/* Sidebars */
require_once 'include/sidebars.php';

/* Widgets */
require_once 'include/widgets.php';

/* Theme options - Customizer */
require_once 'include/options.php';

/* Snippets (modify/add some special features to this theme) */
require_once 'include/snippets.php';

/* Include plugins (required or recommended for this theme) */
require_once 'include/plugins.php';


?>