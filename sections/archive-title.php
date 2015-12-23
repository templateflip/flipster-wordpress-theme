<?php

	/* Detect Archive */
	if ( is_category() ) {
		$archive_title = __('Category - ', 'shamrock').single_cat_title( '', false );
		$description = category_description();
		if ( !empty( $description ) ) {
			$archive_desc = $description;
		}
	} else if ( is_author() ) {
		$curauth = ( isset( $_GET['author_name'] ) ) ? get_user_by( 'slug', $author_name ) : get_userdata( intval( $author ) );
		$archive_title = __('Author - ', 'shamrock').$curauth->display_name;
	} else if ( is_tax() ) {
		$archive_title = single_term_title( '', false );
	} else if ( is_home() && ( $posts_page = get_option( 'page_for_posts' ) ) ) {
		$archive_title = get_the_title( $posts_page );
	} else if ( is_search() ) {
		$archive_title = __('Search Results For - ', 'shamrock').get_search_query();
	} else if ( is_tag() ) {
		$archive_title = __('Tag - ', 'shamrock').single_tag_title( '', false );
		$description = tag_description();
		if ( !empty( $description ) ) {
			$archive_desc = $description;
		}
	} else if ( is_day() ) {
		$archive_title = __('Archive - ', 'shamrock').get_the_date();
	} else if ( is_month() ) {
		$archive_title = __('Archive - ', 'shamrock').get_the_date( 'F Y' );
	} else if ( is_year() ) {
		$archive_title = __('Archive - ', 'shamrock').get_the_date( 'Y' );
	} else {
		$archive_title = false;
		$archive_desc = false;
	}

?>

<?php if ( !empty( $archive_title ) ) : ?>
	<div class="archive-head">
		<h1 class="archive-title"><?php echo $archive_title; ?></h1>
		<?php if ( !empty( $archive_desc ) ) : ?>
			<span class="archive-description"><?php echo $archive_desc; ?></span>
		<?php endif; ?>
	</div>
<?php endif; ?>