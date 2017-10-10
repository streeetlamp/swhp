<?php
/**
 * Author: VCU Libraries Digital Engagement
 * URL: https://library.vcu.edu
 *
 * @package VCU_Libraries_WP
 */

/**
 * WP_HEAD GOODNESS
 */
function bones_head_cleanup() {
	// category feeds
	remove_action( 'wp_head', 'feed_links_extra', 3 );
	// post and comment feeds
	remove_action( 'wp_head', 'feed_links', 2 );
	// EditURI link
	remove_action( 'wp_head', 'rsd_link' );
	// windows live writer
	remove_action( 'wp_head', 'wlwmanifest_link' );
	// previous link
	remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
	// start link
	remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
	// links for adjacent posts
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
	// WP version
	remove_action( 'wp_head', 'wp_generator' );
	// remove WP version from css
	add_filter( 'style_loader_src', 'bones_remove_wp_ver_css_js', 9999 );
	// remove Wp version from scripts
	add_filter( 'script_loader_src', 'bones_remove_wp_ver_css_js', 9999 );
    // emoji's actually suck
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
} /* end bones head cleanup */


/**
 * A better title
 * http://www.deluxeblogtips.com/2012/03/better-title-meta-tag.html
 */
function rw_title( $title, $sep, $seplocation ) {
  global $page, $paged;

  // Don't affect in feeds.
  if ( is_feed() ) {
		return $title;
}

  // Add the blog's name
if ( 'right' === $seplocation ) {
		$title .= get_bloginfo( 'name' );
} else {
		$title = get_bloginfo( 'name' ) . $title;
}

  // Add the blog description for the home/front page.
$site_description = get_bloginfo( 'description', 'display' );

if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title .= " {$sep} {$site_description}";
}

  // Add a page number if necessary:
if ( $paged >= 2 || $page >= 2 ) {
	$title .= " {$sep} " . sprintf( __( 'Page %s', 'dbt' ), max( $paged, $page ) );
}

return $title;

} // end better title


/**
 * Remove WP version from RSS
 */
function bones_rss_version() {
  return '';
}

/**
 * Remove WP version from scripts
 */
function bones_remove_wp_ver_css_js( $src ) {
  if ( strpos( $src, 'ver=' ) ) {
		$src = remove_query_arg( 'ver', $src );
}
return $src;
}

/**
 * Remove injected CSS from gallery
 */
function bones_gallery_style( $css ) {
  return preg_replace( "!<style type='text/css'>(.*?)</style>!s", '', $css );
}


/**
 * SCRIPTS & ENQUEUEING
 */
function bones_scripts_and_styles() {

      global $wp_scripts;

      if ( ! is_admin() ) {

    	// register main stylesheet
       wp_register_style( 'bones-stylesheet', get_stylesheet_directory_uri() . '/library/css/main.css', array(), '', 'all' );
       wp_register_style( 'bones-stylesheet-min', get_stylesheet_directory_uri() . '/library/css/main.min.css', array(), '', 'all' );

    	// adding scripts file in the footer
       wp_register_script( 'bones-js', get_stylesheet_directory_uri() . '/library/js/dist/main.js', array( 'jquery' ), '', true );
       wp_register_script( 'bones-js-min', get_stylesheet_directory_uri() . '/library/js/dist/main.min.js', array( 'jquery' ), '', true );
       wp_register_script( 'branding-bar', '//branding.vcu.edu/bar/academic/latest.js', array(), '', true );

        // livereload for development
       wp_register_script( 'bones-livereload', '//localhost:35729/livereload.js', array(), '', true );
        // html5 shiv
       wp_register_script( 'bones-html5-shiv', '//html5shiv.googlecode.com/svn/trunk/html5.js', array(), '' );
        // font awesome
       wp_register_style( 'bones-font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', array(), '' );

        // check environment before outputting appropriate stylesheet
       if ( we_are_live() ) {
			wp_enqueue_style( 'bones-stylesheet-min' );
			wp_enqueue_script( 'bones-js-min' );
      } else {
			wp_enqueue_style( 'bones-stylesheet' );
			wp_enqueue_script( 'bones-js' );
			wp_enqueue_script( 'bones-livereload' );
      }

      wp_enqueue_style( 'bones-font-awesome' );
      wp_enqueue_script( 'jquery' );
      wp_enqueue_script( 'branding-bar' );

        // add conditional wrapper around html5 shiv
      $wp_scripts->add_data( 'bones-html5-shiv', 'conditional', 'lt IE 9' );
      wp_enqueue_script( 'bones-html5-shiv' );
    }
}

/**
 * THEME SUPPORT
 */
function bones_theme_support() {

	// wp thumbnails (sizes handled in functions.php)
	add_theme_support( 'post-thumbnails' );

	// default thumb size
	set_post_thumbnail_size( 600, 600, true );

	// rss thingy
	add_theme_support( 'automatic-feed-links' );

	// wp menus
	add_theme_support( 'menus' );

	// registering wp3+ menus
	register_nav_menus(
		array(
            'main-nav' => __( 'The Main Menu', 'bonestheme' ),
			'footer-nav' => __( 'The Footer Menu', 'bonestheme' ),
		)
       );
} /* end bones theme support */


/**
 * PAGE NAVI
 */
function bones_page_navi() {
  global $wp_query;
  $bignum = 999999999;
  if ( $wp_query->max_num_pages <= 1 ) {
		return;
}
echo '<nav class="pagination">';
  echo paginate_links(
       array( // xss ok
    'base'         => str_replace( $bignum, '%#%', esc_url( get_pagenum_link( $bignum ) ) ),
    'format'       => '',
    'current'      => max( 1, get_query_var( 'paged' ) ),
    'total'        => $wp_query->max_num_pages,
    'prev_text'    => '&larr;',
    'next_text'    => '&rarr;',
    'type'         => 'list',
    'end_size'     => 3,
    'mid_size'     => 3,
	   )
      );
  echo '</nav>';
} /* end page navi */


/**
 * RANDOM CLEANUP ITEMS
 */

/** Remove the p from around imgs (http://css-tricks.com/snippets/wordpress/remove-paragraph-tags-from-around-images/) */
function bones_filter_ptags_on_images( $content ) {
	return preg_replace( '/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content );
}

/** This removes the annoying […] to a Read More link */
function bones_excerpt_more( $more ) {
	global $post;
	// edit here if you like
	return '... ';
}

/** Customize menu thing is annoying */
function bones_before_admin_bar_render() {
  global $wp_admin_bar;
  $wp_admin_bar->remove_menu( 'customize' );
}
add_action( 'wp_before_admin_bar_render', 'bones_before_admin_bar_render' );
