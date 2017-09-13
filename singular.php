<?php
/**
 * Author: VCUarts
 * URL: http://arts.vcu.edu
 *
 * @package VCUarts_Bones_WP
 */

get_template_part( 'library/templates/the-header' );

if ( ! have_posts() ) :
    get_template_part( 'library/templates/not-found' );
endif;

while ( have_posts() ) : the_post(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <?php if ( ! is_front_page() ) : ?>
        <header class="article-header entry-header">
            <h1 class="entry-title single-title"><?php the_title(); ?></h1>
        </header>
    <?php endif; ?>

    <section class="entry-content">
        <?php the_content(); ?>

        <?php
            // check if the flexible content field has rows of data
        if( have_rows('flexible_content') ):
            while ( have_rows('flexible_content') ) : the_row();
        get_template_part('library/flex-content-loop');
        endwhile;
        endif;
        ?>
    </section>

</article> <?php // end article ?>

<?php endwhile; ?>

<?php get_template_part( 'library/templates/the-footer' );
