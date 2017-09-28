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

<section class="featured-items">
    <?php

    $terms = get_field( 'cat_featured', 'options' );
    $posts = get_field( 'post_feature', 'options' ); // TODO: Figure this out, need to display both
    $terms_posts = array_merge( $terms, $posts );

    if ( $terms_posts ) :
    ?>

        <?php
        foreach ( $terms_posts as $terms_post ) :
            $feat_img = get_field( 'cat_img', $terms_post );
        ?>

            <div class="featured-item">
                <a href="<?php if ( key($terms_post) == 'term_id' ) { echo get_term_link( $terms_post ); } else { echo get_permalink( $terms_post ); } ?>"><img alt="" src="<?php if ( key($terms_post) == 'term_id' ) { echo $feat_img['sizes']['medium']; } else { echo get_the_post_thumbnail_url( $terms_post, 'medium' ); } ?>"></a>
                <a href="<?php if ( key($terms_post) == 'term_id' ) { echo get_term_link( $terms_post ); } else { echo get_permalink( $terms_post ); } ?>"><?php if ( key($terms_post) == 'term_id' ) { echo $terms_post->name; } else { echo $terms_post->post_title; } ?></a>
            </div>
        <?php endforeach; ?>

    <?php endif; ?>
</section>
