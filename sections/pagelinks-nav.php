<div class="smr-pagelinks-nav">
		<?php global $page, $numpages; ?>

		<span class="smr-pagelinks-num"><?php printf( __('Page %s of %s', 'shamrock'), $page, $numpages ); ?></span>

		<?php if ( $page == 1 ) : ?>
			<?php echo _wp_link_page( $numpages ).'<i class="fa fa-chevron-circle-left"></i>'.__('Previous', 'shamrock').'</a>'; ?>
		<?php endif; ?>

		<?php wp_link_pages( array( 'before' => '', 'after' => '', 'next_or_number' => 'next', 'nextpagelink'     => __('Next', 'shamrock').'<i class="fa fa-chevron-circle-right"></i>',
		'previouspagelink' => '<i class="fa fa-chevron-circle-left"></i>'.__('Previous', 'shamrock') ) ); ?>


		<?php if ( $page == $numpages ) : ?>
			<?php echo _wp_link_page( 1 ).__('Next', 'shamrock').'<i class="fa fa-chevron-circle-right"></i></a>'; ?>
		<?php endif; ?>
</div>
