<?php
/**
 * Author: VCU Libraries Digital Engagement
 * URL: https://library.vcu.edu
 *
 * @package VCU_Libraries_WP
 */

get_template_part( 'library/templates/the-header' );

if ( ! have_posts() ) :
    get_template_part( 'library/templates/not-found' );
endif;

while (
    have_posts() ) :
    the_post(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <?php if ( ! is_front_page() && is_single() ) : ?>
        <header class="article-header entry-header">
            <h1 class="entry-title single-title"><?php the_title(); ?></h1>
            <?php
            if ( has_category() ) :
                echo "<div class='category-meta small'>";
                echo "<span class='in-cat'>in: </span>";
                the_category( ', ' );
                echo '</div>';
            endif;
            ?>
        </header>
    <?php endif; ?>

    <section class="entry-content" aria-label="content">
        <?php the_content(); ?>

        <?php
        // check if the flexible content field has rows of data
        if ( have_rows( 'flexible_content' ) ) :
            while (
                have_rows( 'flexible_content' ) ) :
                the_row();
        get_template_part( 'library/flex-content-loop' );
        endwhile;
        endif;

        if ( is_single() ) :
            comments_template();
        endif;
        ?>

        <?php if ( is_front_page() ) : ?>
            <section class="image-portal-banner" aria-label="image portal banner">
                <p>Explore historical materials related to social reform and social welfare through the Image Portal.</p>
                <a href="http://images.socialwelfare.library.vcu.edu">
                    <ul>
                        <li><?php get_template_part( 'library/images/img-gallery-logo.svg' ); ?></li>
                        <li>Image Portal</li>
                    </ul>
                </a>
            </section>

            <?php get_template_part( 'library/templates/home-featured' ); ?>
        <?php endif; ?>

    </section>

</article>

<?php endwhile; ?>

<?php
get_template_part( 'library/templates/the-footer' );
