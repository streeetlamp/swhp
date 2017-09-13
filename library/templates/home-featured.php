<?php
/**
 * Author: VCUarts
 * URL: http://arts.vcu.edu
 *
 * @package VCUarts_Bones_WP
 */

?>

<header class="featured-header">
    <h3>Featured</h3>
</header>

<section class="featured-items">
    <?php 

    $terms = get_field( 'featured', 'options' );

    if( $terms ): ?>

        <?php foreach( $terms as $term ) :
            $feat_img = get_field( 'cat_img', $term ); ?>

            <div class="featured-item">
                <a href="<?php echo get_term_link( $term ); ?>"><img alt="" src="<?php echo $feat_img['sizes']['medium']; ?>"></a>
                <a href="<?php echo get_term_link( $term ); ?>"><?php echo $term->name; ?></a>
            </div>
        <?php endforeach; ?>

    <?php endif; ?>
</section>
