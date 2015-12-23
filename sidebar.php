<div id="sidebar" class="sidebar col-lg-3 widget-area col-md-4 col-sm-4 col-xs-12" role="complementary">
	
	<?php 
		if(is_front_page()){
			dynamic_sidebar( 'shamrock_home_sidebar' );
		} else if (is_single()) {
			dynamic_sidebar( 'shamrock_single_sidebar' );
		} else if (is_page()){
			dynamic_sidebar( 'shamrock_page_sidebar' );
		} else {
			dynamic_sidebar( 'shamrock_archive_sidebar' );
		}
	?>
</div>