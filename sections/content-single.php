
<article id="post-<?php the_ID(); ?>" <?php post_class( 'smr-post' ); ?>>

	<div class="entry-header-wrapper">

		<?php $format = get_post_format(); ?>

		<?php if ( empty( $format ) && shamrock_get_option( 'single_show_fimg' ) && has_post_thumbnail() ) : ?>
			<figure class="post-thumbnail">
				<?php echo shamrock_get_featured_image(); ?>
				<?php if ( $caption = get_post( get_post_thumbnail_id() )->post_excerpt ) : ?>
					<div class="smr-photo-caption"><?php echo $caption;  ?></div>
				<?php endif; ?>
			</figure>
		<?php endif; ?>

		<?php if ( !empty( $format ) ) : ?>
			<?php if ( $media = shamrock_get_post_media( $format ) ) : ?>
				<div class="meta-media"><?php echo $media; ?></div>
			<?php endif; ?>
		<?php endif; ?>

		<header class="entry-header">

			<?php if ( shamrock_get_option( 'single_show_cat' ) ) : ?>
				<?php the_category(); ?>
			<?php endif; ?>

			<?php the_title( sprintf( '<h1 class="entry-title">', esc_url( get_permalink() ) ), '</h1>' ); ?>

			<?php if ( $meta = shamrock_get_meta_data() ) : ?>
				<div class="entry-meta">
					<?php echo $meta; ?>
				</div>
			<?php endif;?>

		</header>

	</div>

	<?php if(shamrock_is_paginated_post()) : ?>
		<?php get_template_part('sections/pagelinks-nav'); ?>
	<?php endif; ?>

	<div class="entry-content">
		<?php the_content(); ?>
	</div>

</article>
