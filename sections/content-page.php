<article id="post-<?php the_ID(); ?>" <?php post_class('smr-page'); ?>>
	<?php if(has_post_thumbnail()) : ?>
			<div class="post-thumbnail">
				<?php $img_size = is_page_template('template-fullwidth.php') || is_page_template('template-nosidebar.php') ?  'smr-thumb-full' : 'smr-thumb'; ?>
				<?php the_post_thumbnail( $img_size ); ?>
			</div>
	<?php endif; ?>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header>

	<div class="entry-content">
		<?php the_content(); ?>
		<?php wp_link_pages(); ?>
	</div>

	<footer class="entry-footer">
	</footer>
</article>