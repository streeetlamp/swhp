<?php
/**
 * Author: VCU Libraries Digital Engagement
 * URL: https://library.vcu.edu.
 */

// LOAD BONES CORE (if you remove this, the theme will break)
require_once 'library/bones.php';

// Google Analytics
require_once 'library/inc/google-analytics.php';

// Disables trackbacks/pingbacks
require_once 'library/inc/disable-trackbacks.php';

/**
 * LAUNCH BONES.
 */
function bones_ahoy()
{
    @ini_set('upload_max_size', '64M');
    @ini_set('display_errors', '0');
    /* Allow editor style.
    * add_editor_style( get_stylesheet_directory_uri() . '/library/css/editor-style.css' );
    */

    // launching operation cleanup
    add_action('init', 'bones_head_cleanup');
    // A better title
    add_filter('wp_title', 'rw_title', 10, 3);
    // remove WP version from RSS
    add_filter('the_generator', 'bones_rss_version');
    // clean up gallery output in wp
    add_filter('gallery_style', 'bones_gallery_style');
    // enqueue base scripts and styles
    add_action('wp_enqueue_scripts', 'bones_scripts_and_styles', 999);

    // let's get language support going
    load_theme_textdomain('bonestheme', get_template_directory().'/library/translation');

    // launching this stuff after theme setup
    bones_theme_support();

    // cleaning up random code around images
    add_filter('the_content', 'bones_filter_ptags_on_images');
    // cleaning up excerpt
    add_filter('excerpt_more', 'bones_excerpt_more');
} /* end bones ahoy */

// let's get this party started
add_action('after_setup_theme', 'bones_ahoy');

/************* OEMBED SIZE OPTIONS *************/

if (!isset($content_width)) {
    $content_width = 1240;
}

/**
 * THEME CUSTOMIZE.
 */
function bones_theme_customizer($wp_customize)
{
    $wp_customize->remove_section('colors');
    $wp_customize->remove_section('background_image');
}

add_action('customize_register', 'bones_theme_customizer');

/**
 * Testing our environment.
 *
 * @returns true if on production server false if not
 */
function we_are_live()
{
    $host = home_url();

    if (preg_match('/\.local/', $host)) {
        return false;
    }

    return true;
}

// Enable support for HTML5 markup.
add_theme_support(
    'html5', array(
        'caption',
        'search-form',
        'comment-list',
        'comment-form',
        'gallery',
    )
);

  if (!function_exists('the_field')) {
      add_action('admin_notices', 'bones_acf_notice');
  }

/**
 * ACF Bones Notice.
 */
function bones_acf_notice()
{
    ?>
	<div class="update-nag notice" style="display:block; margin:20px 0;">
	<h3><?php echo  'Install Advanced Custom Fields Pro please or nothing will work probably!'; ?></h3>
	</div>
	<?php
}

/*
* ACF options page
*/
if (function_exists('acf_add_options_page')) {
    acf_add_options_page(
          array(
              'page_title' => 'Site Options',
              'menu_title' => 'Site Options',
              'menu_slug' => 'options',
              'capability' => 'edit_posts',
              'redirect' => false,
          )
              );
}

//since WP wont just give a alt tag
function get_the_post_thumbnail_alt($post_id)
{
    return get_post_meta(get_post_thumbnail_id($post_id), '_wp_attachment_image_alt', true);
}

function the_post_thumbnail_alt($post_id)
{
    echo get_the_post_thumbnail_alt($post_id);
}

/*
SiteImprove would much prefer strong over b so we will do that.
*/
// function change_b_to_strong($content)
// {
//     str_replace('<b>', '<strong>', $content);
//     str_replace('</b>', '</strong>', $content);

//     return $content;
// }
// add_filter('the_content', 'change_b_to_strong');

// Hide ACF from admin menu if live
// if (we_are_live()) {
//     add_filter('acf/settings/show_admin', '__return_false');
// }
