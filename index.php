<?php
// Setup flipster
beans_add_smart_action( 'beans_before_load_document', 'flipster_index_setup_document' );

function flipster_index_setup_document() {

	// Posts grid
	beans_add_attribute( 'beans_content', 'class', 'tm-posts-grid uk-grid uk-grid-width-small-1-2 uk-grid-width-medium-1-2' );
	beans_add_attribute( 'beans_content', 'data-uk-grid-margin', '' );
	beans_add_attribute( 'beans_content', 'data-uk-grid-match', "{target:'.uk-panel'}" );
	beans_wrap_inner_markup( 'beans_post', 'flipster_post_panel', 'div', array(
	  'class' => 'uk-panel uk-panel-box'
	) );

	// Post content
	beans_remove_attribute( 'beans_content', 'class', 'tm-centered-content' );

	// Post article
	beans_remove_attribute( 'beans_post', 'class', 'uk-article' );

	// Post meta

	// Post image
	beans_modify_action( 'beans_post_image', 'beans_post_header_before_markup', 'beans_post_image' );

	// Post title
	beans_add_attribute( 'beans_post_title', 'class', 'uk-margin-small-top uk-h3' );

	// Post more link
	beans_add_attribute( 'beans_post_more_link', 'class', 'uk-button uk-button-primary uk-button-small' );

	// Posts pagination
	beans_modify_action_hook( 'beans_posts_pagination', 'beans_content_after_markup' );

}

// Content styling
beans_add_smart_action( 'the_content', 'flipster_index_content' );
function flipster_index_content( $content ) {
    $output = beans_open_markup( 'flipster_index_content', 'p' );
    	$output .= beans_output( 'flipster_index_post_content', substr( strip_tags( $content ), 0, 150 ) . ' ...' );
   	$output .= beans_close_markup( 'flipster_index_content', 'p' );
   	return $output;
}


// Resize post image (filter)
beans_add_smart_action( 'beans_edit_post_image_args', 'flipster_index_post_image_args' );

function flipster_index_post_image_args( $args ) {

	$args['resize'] = array( 430, 250, true ); //430, 250

	return $args;

}


// Load beans document
beans_load_document();
