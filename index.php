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

	while ( have_posts() ) :
    the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

            <?php if ( ! is_front_page() ) : ?>
                <header class="article-header entry-header">
                    <span class="author vcard">Posted by: <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php the_author(); ?></a></span>
                </header>
            <?php endif; ?>

			<section class="entry-content">
			<?php the_content(); ?>

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

	<?php bones_page_navi(); ?>

<?php
get_template_part( 'library/templates/the-footer' );
