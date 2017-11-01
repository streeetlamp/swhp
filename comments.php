<?php
/**
 * Author: VCU Libraries Digital Engagement
 * URL: https://library.vcu.edu
 *
 * @package VCU_Libraries_WP
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
    return;
}
?>

<div id="comments" class="comments-area">

    <?php
    if ( have_comments() ) :
    ?>
        <h3 class="comments-title">
            <?php
                $comments_number = get_comments_number();
                if ( '1' === $comments_number ) {
                    /* translators: %s: post title */
                    printf( _x( 'One Reply to &ldquo;%s&rdquo;', 'comments title', 'bonestheme' ), get_the_title() );
                } else {
                    printf(
                        /* translators: 1: number of comments, 2: post title */
                        _nx(
                            '%1$s Reply to &ldquo;%2$s&rdquo;',
                            '%1$s Replies to &ldquo;%2$s&rdquo;',
                            $comments_number,
                            'comments title',
                            'bonestheme'
                        ),
                        number_format_i18n( $comments_number ),
                        get_the_title()
                    );
                }
            ?>
        </h3>

        <ol class="commentlist">
            <?php
                wp_list_comments( array(
                    'avatar_size' => 100,
                    'style'       => 'ol',
                    'short_ping'  => true,
                ) );
            ?>
        </ol>

        <?php
        the_comments_pagination( array(
            'prev_text' => '<span class="screen-reader-text">' . __( 'Previous', 'bonestheme' ) . '</span>',
            'next_text' => '<span class="screen-reader-text">' . __( 'Next', 'bonestheme' ) . '</span>',
        ) );

    endif; // Check for have_comments().

    // If comments are closed and there are comments, let's leave a little note, shall we?
    if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
        ?>

        <p class="no-comments"><?php _e( 'Comments are closed.', 'bonestheme' ); ?></p>
    <?php
    endif;

    comment_form();
    ?>

</div><!-- #comments -->
