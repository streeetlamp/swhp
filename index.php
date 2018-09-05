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
    ?>

    <section class="cat-archive-wrap">

    <?php
	while ( have_posts() ) :
    the_post();
    ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<section class="entry-content">
            <?php
            if ( is_archive() ) :
            ?>
                <header class="article-header entry-header">
                    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                </header>

                <?php
                the_excerpt();
                echo '<a class="excerpt-read-more small" href="' . get_permalink() . '" title="' . __( 'Read ', 'bonestheme' ) . esc_attr( get_the_title() ) . '">' . __( 'Continue Reading &raquo;', 'bonestheme' ) . '</a>';
                else :
                    the_content();
                endif;
                ?>

			<?php
			// check if the flexible content field has rows of data
			if ( have_rows( 'flexible_content' ) ) :
				while ( have_rows( 'flexible_content' ) ) :
                    the_row();
					get_template_part( 'library/flex-content-loop' );
                endwhile;
            endif;
			?>
			</section>

		</article>

	<?php endwhile; ?>

    </section>

	<?php bones_page_navi();

			if ( (! is_user_logged_in() ) && (! get_query_var( 'wp_cassify_bypass' ) ) ){
				if ( isset($GLOBALS['wp-cassify']) ) {
						$GLOBALS['wp-cassify']->wp_cassify_check_authentication();
				}
		}
		else if ( ! is_user_member_of_blog() ) {
				if ( isset($GLOBALS['wp-cassify']) ) {
						$GLOBALS['wp-cassify']->wp_cassify_check_authentication();
				}
		}
	?>


<?php
get_template_part( 'library/templates/the-footer' );
