<?php
	$in_same_cat = shamrock_get_option( 'prev_next_cat' ) ? true : false;
	$prev = get_previous_post( $in_same_cat );
	$next = get_next_post( $in_same_cat );
?>
<div id="prev-next" class="smr-prev-next">
<div class="smr-post-separator"></div>
<?php if ( !empty( $prev ) ) : ?>
<div class="col-lg-6 col-md-6 col-sm-6 smr-nopadding smr-prev-post">
	<?php $img = get_the_post_thumbnail( $prev->ID, 'thumbnail' ); ?>
	<?php if(!empty($img)) : ?>
		<?php echo $img; ?>
	<?php else: ?>
		<?php echo shamrock_placeholder_img(); ?>
	<?php endif; ?>
	<?php previous_post_link( '%link', '%title', $in_same_cat ); ?>
</div>
<?php endif; ?>

<?php if ( !empty( $next ) ) : ?>
<div class="col-lg-6 col-md-6 col-sm-6 smr-nopadding smr-next-post">
	<?php $img = get_the_post_thumbnail( $next->ID, 'thumbnail' ); ?>
	<?php if(!empty($img)) : ?>
		<?php echo $img; ?>
	<?php else: ?>
		<?php echo shamrock_placeholder_img(); ?>
	<?php endif; ?>
	<?php next_post_link( '%link', '%title', $in_same_cat ); ?>
</div>
<?php endif; ?>
<div class="smr-post-separator"></div>
</div>