<?php

// Include Beans
require_once( get_template_directory() . '/lib/init.php' );


// Remove Beans Default Styling
remove_theme_support( 'beans-default-styling' );


// Enqueue uikit assets
beans_add_smart_action( 'beans_uikit_enqueue_scripts', 'flipster_enqueue_uikit_assets', 5 );

function flipster_enqueue_uikit_assets() {

	// Enqueue uikit overwrite theme folder
	beans_uikit_enqueue_theme( 'flipster', get_stylesheet_directory_uri() . '/assets/less/uikit' );

	// Add the theme style as a uikit fragment to have access to all the variables
	beans_compiler_add_fragment( 'uikit', get_stylesheet_directory_uri() . '/assets/less/style.less', 'less' );

}

//Setup Theme
beans_add_smart_action( 'init', 'flipster_init' );

function flipster_init() {

	// Remove page post type comment support
	remove_post_type_support( 'page', 'comments' );
	// Register additional menus, we already have a Primary menu registered
	register_nav_menu('footer-menu', __( 'Footer Menu', 'flipster'));
}


// Setup document fragements, markups and attributes
beans_add_smart_action( 'wp', 'flipster_setup_document' );

function flipster_setup_document() {

	// Header and Primary Menu
	beans_remove_attribute( 'beans_site_branding', 'class', 'uk-float-left' );
	beans_remove_attribute( 'beans_primary_menu', 'class', 'uk-float-right' );

	// Breadcrumb
	if(!is_archive())
		beans_remove_action( 'beans_breadcrumb' );

	// Navigation
	beans_add_attribute( 'beans_sub_menu_wrap', 'class', 'uk-dropdown-center' );
	beans_remove_attribute( 'beans_menu_item_child_indicator', 'class', 'uk-margin-small-left' );

	// Post content
	beans_add_attribute( 'beans_post_content', 'class', 'uk-text-large' );

	// Post meta
	beans_remove_action( 'beans_post_meta_categories' );
	beans_remove_output( 'beans_post_meta_categories_prefix' );
	beans_remove_output( 'beans_post_meta_date_prefix' );
	beans_add_attribute( 'beans_post_meta_date', 'class', 'uk-text-muted' );

	// Post embed
	beans_add_attribute( 'beans_embed_oembed', 'class', 'tm-cover-article' );

	// Comment form
	beans_add_attribute( 'beans_comment_form_wrap', 'class', 'tm-cover-article' );
	beans_add_attribute( 'beans_comment_fields_inner_wrap', 'class', 'uk-grid-small' );
	beans_add_attribute( 'beans_comment_form_submit', 'class', 'uk-button-large' );

	if ( !is_user_logged_in() )
		beans_replace_attribute( 'beans_comment_form_comment', 'class', 'uk-width-medium-1-1', 'uk-width-medium-6-10' );

	// Only applies to singular and not pages
 	if ( is_singular() && !is_page() ) {
 		//remove featured image
 		beans_remove_action( 'beans_post_image' );
 		// Post title
 		beans_add_attribute( 'beans_post_title', 'class', 'uk-margin-bottom' );
 		// Post author profile
 		add_action( 'beans_comments_before_markup', 'flipster_author_profile' );
 	}

	// Search
	if ( is_search() )
		beans_remove_action( 'beans_post_image' );

}

// Author profile in posts
function flipster_author_profile() {
	echo beans_open_markup( 'flipster_author_profile', 'div',  array( 'class' => 'uk-panel' ) );
	echo '<h3 class="uk-panel-title">'.__('About the author', 'flipster').'</h3>';
	echo '<div class="uk-clearfix">';
	  echo '<div class="uk-align-left">'.get_avatar( get_the_author_meta('ID'), 96 ).'</div>';
   	echo '<div class="uk-text-large uk-text-bold">'.get_the_author_meta('display_name').'</div>';
		echo wpautop(get_the_author_meta('description'));
	echo '</div>';
	echo beans_close_markup( 'flipster_author_profile', 'div' );
}


// Modify beans layout (filter)
beans_add_smart_action( 'beans_layout_grid_settings', 'flipster_layout_grid_settings' );

function flipster_layout_grid_settings( $layouts ) {

	return array_merge( $layouts, array(
		'grid' => 10,
		'sidebar_primary' => 3,
		'sidebar_secondary' => 3,
	) );

}

// Modify beans post meta items (filter)
beans_add_smart_action( 'beans_post_meta_items', 'flipster_post_meta_items' );

function flipster_post_meta_items( $items ) {

	// Remove author meta
	unset( $items['author'] );
	unset( $items['comments']);

	// Add categories meta
	$items['categories'] = 20;

	return $items;

}

// Remove comment after note (filter)
beans_add_smart_action( 'comment_form_defaults', 'flipster_comment_form_defaults' );

function flipster_comment_form_defaults( $args ) {

	$args['comment_notes_after'] = '';

	return $args;

}


// Add avatar uikit circle class (filter)
beans_add_smart_action( 'get_avatar', 'flipster_avatar' );

function flipster_avatar( $output ) {

	return str_replace( "class='avatar", "class='avatar uk-border-circle", $output ) ;

}


// Modify the tags cloud widget
beans_add_smart_action( 'wp_generate_tag_cloud', 'flipster_widget_tags_cloud' );

function flipster_widget_tags_cloud( $output ) {

	return preg_replace( "#style='font-size:.+pt;'#", '', $output );

}


// Add the footer menu
beans_add_smart_action( 'beans_footer_prepend_markup', 'flipster_footer_menu' );

function flipster_footer_menu() {

	wp_nav_menu( array( 'theme_location' => 'footer-menu',
											'container' => 'nav',
	 										'container_class' => 'tm-footer-menu uk-navbar uk-margin-bottom',
											'menu_class' => 'uk-navbar-nav uk-text-small'
										));

}

// Add footer content (filter)
beans_add_smart_action( 'beans_footer_credit_right_text_output', 'flipster_footer' );

function flipster_footer() { ?>

  <a href="http://themes.kanishkkunal.in/flipster/" target="_blank" title="Flipster theme for WordPress">Flipster</a> theme for <a href="http://wordpress.org" target="_blank">WordPress</a>. Built-with <a href="http://www.getbeans.io/" title="Beans Framework for WordPress" target="_blank">Beans</a>.

<?php }
