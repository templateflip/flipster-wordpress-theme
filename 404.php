<?php get_header(); ?>

	<div id="primary" class="content-area col-lg-9 smr-page smr-no-sidebar col-md-8 col-sm-12">
		<main id="main" class="site-main" role="main">
		<article class="page">
			<header class="entry-header">
				<h2 class="entry-title"><?php _e('404 error: Page not found', 'shamrock'); ?></h2>			
			</header>
			
			<div class="entry-content">
				<p><?php _e('The page that you are looking for doesn&rsquo;t exist on this website. You may have accidentally mistype the page address, or followed an expired link. Anyway, we will help you get back on track. Why don&rsquo;t you try searching for an article?', 'shamrock'); ?></p>
				<?php get_search_form(); ?>
			</div>
		</article>

		</main>
	</div>

<?php get_footer(); ?>