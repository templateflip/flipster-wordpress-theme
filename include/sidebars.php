<?php
/*-----------------------------------------------------------------------------------*/
/*	Register Theme Sidebars
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'shamrock_register_sidebars' ) ) :
	function shamrock_register_sidebars() {
		
		/* Default Sidebar */
		register_sidebar(
			array(
				'id' => 'shamrock_home_sidebar',
				'name' => __( 'Home Sidebar', 'shamrock' ),
				'description' => __( 'This sidebar is used for home page.', 'shamrock' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget' => '</div>',
				'before_title' => '<h4 class="widget-title"><span>',
				'after_title' => '</span></h4>'
			)
		);
		register_sidebar(
			array(
				'id' => 'shamrock_single_sidebar',
				'name' => __( 'Post Sidebar', 'shamrock' ),
				'description' => __( 'This sidebar is used for single post templates.', 'shamrock' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget' => '</div>',
				'before_title' => '<h4 class="widget-title"><span>',
				'after_title' => '</span></h4>'
			)
		);
		register_sidebar(
			array(
				'id' => 'shamrock_page_sidebar',
				'name' => __( 'Page Sidebar', 'shamrock' ),
				'description' => __( 'This sidebar is used for your pages.', 'shamrock' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget' => '</div>',
				'before_title' => '<h4 class="widget-title"><span>',
				'after_title' => '</span></h4>'
			)
		);
		register_sidebar(
			array(
				'id' => 'shamrock_archive_sidebar',
				'name' => __( 'Archive Sidebar', 'shamrock' ),
				'description' => __( 'This sidebar is used for category, tag and other archive templates.', 'shamrock' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget' => '</div>',
				'before_title' => '<h4 class="widget-title"><span>',
				'after_title' => '</span></h4>'
			)
		);

	}

endif;

?>
