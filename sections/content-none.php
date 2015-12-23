<section class="no-results not-found">
	<?php if(is_singular()): ?>
		<header class="page-header">
			<h1 class="page-title"><?php _e('Nothing found', 'shamrock'); ?></h1>
		</header>
	<?php endif; ?>

	<div class="page-content">

		<?php if ( is_search() ) : ?>

		<p><?php _e('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'shamrock'); ?></p>
		<?php get_search_form(); ?>

		<?php else : ?>

		<p><?php _e('It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'shamrock'); ?></p>
		<?php get_search_form(); ?>

		<?php endif; ?>
	</div>
</section>