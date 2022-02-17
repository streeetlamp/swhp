<?php
/**
 * Author: VCU Libraries Digital Engagement
 * URL: https://library.vcu.edu
 *
 * @package VCU_Libraries_WP
 */

?>

<header class="featured-header">
	<h3>Featured</h3>
</header>

<section class="featured-items" aria-label="featured items">
	<?php
	$feat_posts = get_field( 'post_feature', 'options' );

	if ( $feat_posts ) :
		foreach ( $feat_posts as $feat_post ) :
			$feat_post_title = get_field( 'featured_post_title', $feat_post );
			if  ( $feat_post_title ) :
				$feat_title = $feat_post_title;
			else :
				$feat_title = $feat_post->post_title;
			endif;
			?>
			<div class="featured-item">
				<a href="<?php echo get_permalink( $feat_post ); ?>"><img alt="<?php the_post_thumbnail_alt( $feat_post ); ?>" src="<?php echo get_the_post_thumbnail_url( $feat_post, 'medium' ); ?>"><?php echo $feat_title; ?></a>
			</div>
		<?php endforeach; ?>

	<?php endif; ?>
</section>
