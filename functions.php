<?php

// Include Beans
require_once( get_template_directory() . '/lib/init.php' );


// Remove Beans Default Styling
remove_theme_support( 'beans-default-styling' );


// Enqueue uikit assets
beans_add_smart_action( 'beans_uikit_enqueue_scripts', 'jenkins_enqueue_uikit_assets', 5 );

function jenkins_enqueue_uikit_assets() {

	// Enqueue uikit overwrite theme folder
	beans_uikit_enqueue_theme( 'jenkins', get_stylesheet_directory_uri() . '/assets/less/uikit' );

	// Add the theme style as a uikit fragment to have access to all the variables
	beans_compiler_add_fragment( 'uikit', get_stylesheet_directory_uri() . '/assets/less/style.less', 'less' );

}


// Remove page post type comment support
beans_add_smart_action( 'init', 'jenkins_post_type_support' );

function jenkins_post_type_support() {

	remove_post_type_support( 'page', 'comments' );

}


// Setup document fragements, markups and attributes
beans_add_smart_action( 'wp', 'jenkins_setup_document' );

function jenkins_setup_document() {

	// Header
	beans_add_attribute( 'beans_site_branding', 'class', 'uk-margin-small-top' );

	// Breadcrumb
	beans_remove_action( 'beans_breadcrumb' );

	// Navigation
	beans_add_attribute( 'beans_sub_menu_wrap', 'class', 'uk-dropdown-center' );
	beans_remove_attribute( 'beans_menu_item_child_indicator', 'class', 'uk-margin-small-left' );

	// Post content
	beans_add_attribute( 'beans_post_content', 'class', 'uk-text-large' );

	// Post image
	beans_add_attribute( 'beans_post_image', 'class', 'tm-cover-article' );

	// Post meta
	beans_remove_attribute( 'beans_post_meta', 'class', 'uk-subnav-line' );
	beans_remove_action( 'beans_post_meta_tags' );
	beans_remove_action( 'beans_post_meta_categories' );
	beans_remove_output( 'beans_post_meta_categories_prefix' );

	// Post embed
	beans_add_attribute( 'beans_embed_oembed', 'class', 'tm-cover-article' );

	// Comment meta
	beans_modify_action_priority( 'beans_comment_metadata', 9 );

	// Comment form
	beans_add_attribute( 'beans_comment_form_wrap', 'class', 'tm-cover-article' );
	beans_add_attribute( 'beans_comment_fields_inner_wrap', 'class', 'uk-grid-small' );
	beans_add_attribute( 'beans_comment_form_submit', 'class', 'uk-button-large' );

	if ( !is_user_logged_in() )
		beans_replace_attribute( 'beans_comment_form_comment', 'class', 'uk-width-medium-1-1', 'uk-width-medium-6-10' );

	// Search
	if ( is_search() )
		beans_remove_action( 'beans_post_image' );

}


// Modify beans layout (filter)
beans_add_smart_action( 'beans_layout_grid_settings', 'jenkins_layout_grid_settings' );

function jenkins_layout_grid_settings( $layouts ) {

	return array_merge( $layouts, array(
		'grid' => 10,
		'sidebar_primary' => 3,
		'sidebar_secondary' => 3,
	) );

}


// Modify beans post meta items (filter)
beans_add_smart_action( 'beans_post_meta_items', 'jenkins_post_meta_items' );

function jenkins_post_meta_items( $items ) {

	// Remove author meta
	unset( $items['author'] );

	// Add categories meta
	$items['categories'] = 20;

	return $items;

}

// Add post meta item date icon
beans_add_smart_action( 'beans_post_meta_item_date_prepend_markup', 'jenkins_post_meta_item_date_icon' );

function jenkins_post_meta_item_date_icon() {

	echo beans_open_markup( 'jenkins_post_meta_item_date_icon', 'i', 'class=uk-icon-clock-o uk-margin-small-right uk-text-muted' );
	echo beans_close_markup( 'jenkins_post_meta_item_date_icon', 'i' );

}


// Add post meta item author icon
beans_add_smart_action( 'beans_post_meta_item_categories_prepend_markup', 'jenkins_post_meta_item_categories_icon' );

function jenkins_post_meta_item_categories_icon() {

	echo beans_open_markup( 'jenkins_post_meta_item_categories_icon', 'i', 'class=uk-icon-archive uk-margin-small-right uk-text-muted' );
	echo beans_close_markup( 'jenkins_post_meta_item_categories_icon', 'i' );

}


// Add post meta item comment icon
beans_add_smart_action( 'beans_post_meta_item_comments_prepend_markup', 'jenkins_post_meta_item_comments_icon' );

function jenkins_post_meta_item_comments_icon() {

	echo beans_open_markup( 'jenkins_post_meta_item_comments_icon', 'i', 'class=uk-icon-comments uk-margin-small-right uk-text-muted' );
	echo beans_close_markup( 'jenkins_post_meta_item_comments_icon', 'i' );

}


// Remove comment after note (filter)
beans_add_smart_action( 'comment_form_defaults', 'jenkins_comment_form_defaults' );

function jenkins_comment_form_defaults( $args ) {

	$args['comment_notes_after'] = '';

	return $args;

}


// Add avatar uikit circle class (filter)
beans_add_smart_action( 'get_avatar', 'jenkins_avatar' );

function jenkins_avatar( $output ) {

	return str_replace( "class='avatar", "class='avatar uk-border-circle", $output ) ;

}


// Modify the tags cloud widget
beans_add_smart_action( 'wp_generate_tag_cloud', 'jenkins_widget_tags_cloud' );

function jenkins_widget_tags_cloud( $output ) {

	return preg_replace( "#style='font-size:.+pt;'#", '', $output );

}


// Add footer content (filter)
beans_add_smart_action( 'beans_footer_credit_right_text_output', 'jenkins_footer' );

function jenkins_footer() { ?>

  <a href="http://www.themebutler.com/themes/jenkins/" target="_blank" title="Jenkins theme for WordPress">Jenkins</a> theme for <a href="http://wordpress.org" target="_blank">WordPress</a>. Built-with <a href="http://www.getbeans.io/" title="Beans Framework for WordPress" target="_blank">Beans</a>.

<?php }
