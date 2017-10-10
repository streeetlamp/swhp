<?php
/**
 * Author: VCU Libraries Digital Engagement
 * URL: https://library.vcu.edu
 *
 * @package VCU_Libraries_WP
 */

get_template_part( 'library/templates/the-header' );

	if ( ! have_posts() ) : ?>
	<header class="search-header">
        <section class="entry-content">
          <h1>Nothing Found</h1>
          <p>Sorry, but nothing matched your search terms. Please try again with some different keywords.</p>
          <?php get_search_form(); ?>
        </section>
    </header>

	<?php
    endif;

    if ( have_posts() ) :
    ?>
    <header class="search-header">
        <h1><?php echo 'Search Results for: ' . get_search_query(); ?></h1>
    </header>
    <?php
    endif;
    ?>
    <section class="search-results">

    <?php
	while ( have_posts() ) :
    the_post();
    ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

            <header class="article-header entry-header">
                <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
            </header>

			<section class="entry-content">
    			<?php
                the_excerpt();
                echo '<a class="excerpt-read-more small" href="' . get_permalink() . '" title="' . __( 'Read ', 'bonestheme' ) . esc_attr( get_the_title() ) . '">' . __( 'Continue Reading &raquo;', 'bonestheme' ) . '</a>';
                ?>
			</section>

		</article> 

	<?php endwhile; ?>

    </section>

	<?php bones_page_navi(); ?>

<?php
get_template_part( 'library/templates/the-footer' );
