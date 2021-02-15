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
if (post_password_required()) {
	return;
}
?>

<div id="comments" class="comments-area">

		<h3 class="comments-title">
			<?php
			$comments_number = get_comments_number();
			if ('1' === $comments_number) {
				/* translators: %s: post title */
				printf(_x('One Reply to &ldquo;%s&rdquo;', 'comments title', 'bonestheme'), get_the_title());
			} else {
				printf(
					/* translators: 1: number of comments, 2: post title */
					_nx(
						'',
						'%1$s Replies to &ldquo;%2$s&rdquo;',
						$comments_number,
						'comments title',
						'bonestheme'
					),
					number_format_i18n($comments_number),
					get_the_title()
				);
			}
			?>
		</h3>

		<ol class="commentlist">
			<?php
			wp_list_comments();
			?>
		</ol>

		<p style="text-align:center;" class="no-comments"><?php _e('<a href="/contact/">Comments for this site have been disabled. Please use our contact form for any research questions.</a>', 'bonestheme'); ?></p>

	<?php
		the_comments_pagination(array(
			'prev_text' => '<span class="screen-reader-text">' . __('Previous', 'bonestheme') . '</span>',
			'next_text' => '<span class="screen-reader-text">' . __('Next', 'bonestheme') . '</span>',
		));




	// comment_form();
	?>

</div><!-- #comments -->
