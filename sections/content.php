<article id="post-<?php the_ID(); ?>" <?php post_class( 'smr-post' ); ?>>

	<div class="entry-header-wrapper">

		<?php $format = get_post_format(); ?>

		<?php if ( empty( $format ) && shamrock_get_option( 'show_fimg' ) && ( has_post_thumbnail() || shamrock_get_option( 'default_fimg' ) ) ) : ?>
			<figure class="post-thumbnail">
				<a href="<?php echo esc_url( get_permalink() ); ?>"><?php echo shamrock_get_featured_image(); ?></a>
			</figure>
		<?php endif; ?>

		<?php if ( !empty( $format ) ) : ?>
			<?php if ( $media = shamrock_get_post_media( $format ) ) : ?>
				<div class="meta-media"><?php echo $media; ?></div>
			<?php endif; ?>
		<?php endif; ?>


		<header class="entry-header">

			<?php if ( shamrock_get_option( 'show_cat' ) ) : ?>
				<?php the_category(); ?>
			<?php endif; ?>

			<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

			<?php if ( $meta = shamrock_get_meta_data() ) : ?>
				<div class="entry-meta">
					<?php echo $meta; ?>
				</div>
			<?php endif;?>

		</header>

	</div>

	<div class="entry-content">
		<?php if ( shamrock_get_option( 'content_type' ) == 'content' ) : ?>
			<?php the_content( __('Continue reading', 'shamrock') ); ?>
		<?php else : ?>
			<p><?php echo shamrock_get_excerpt(); ?></p>
			<p><a href="<?php echo esc_url( get_permalink() ); ?>" class="more-link"><?php _e('Continue reading', 'shamrock'); ?></a></p>
		<?php endif; ?>
	</div>
</article>
