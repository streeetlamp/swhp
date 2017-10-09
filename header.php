<?php
/**
 * Author: VCU Libraries Digital Engagement
 * URL: https://library.vcu.edu
 *
 * @package VCU_Libraries_WP
 */

?>

<!doctype html>
<!--
 ______  _________ _______ __________________ _______  _       
(  __  \ \__   __/(  ____ \\__   __/\__   __/(  ___  )( \      
| (  \  )   ) (   | (    \/   ) (      ) (   | (   ) || (      
| |   ) |   | |   | |         | |      | |   | (___) || |      
| |   | |   | |   | | ____    | |      | |   |  ___  || |      
| |   ) |   | |   | | \_  )   | |      | |   | (   ) || |      
| (__/  )___) (___| (___) |___) (___   | |   | )   ( || (____/\
(______/ \_______/(_______)\_______/   )_(   |/     \|(_______/
                                                               
 _______  _        _______  _______  _______  _______  _______  _______  _       _________
(  ____ \( (    /|(  ____ \(  ___  )(  ____ \(  ____ \(       )(  ____ \( (    /|\__   __/
| (    \/|  \  ( || (    \/| (   ) || (    \/| (    \/| () () || (    \/|  \  ( |   ) (   
| (__    |   \ | || |      | (___) || |      | (__    | || || || (__    |   \ | |   | |   
|  __)   | (\ \) || | ____ |  ___  || | ____ |  __)   | |(_)| ||  __)   | (\ \) |   | |   
| (      | | \   || | \_  )| (   ) || | \_  )| (      | |   | || (      | | \   |   | |   
| (____/\| )  \  || (___) || )   ( || (___) || (____/\| )   ( || (____/\| )  \  |   | |   
(_______/|/    )_)(_______)|/     \|(_______)(_______/|/     \|(_______/|/    )_)   )_(   
                                                                                       
-->
<!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->

  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?php wp_title( '' ); ?></title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- NEED A favicon made -->
    <link rel="icon" href="<?php echo esc_url( get_template_directory_uri() . '/favicon.png' ); ?>">
    <!--[if IE]>
      <link rel="shortcut icon" href="<?php echo esc_url( get_template_directory_uri() . '/favicon.ico' ); ?>">
    <![endif]-->

    <?php wp_head(); ?>

  </head>

  <body <?php body_class(); ?>>

    <div class="container">

      <header class="header">

        <div class="inner-header">

          <p id="logo"><a href="<?php echo esc_url( home_url() ); ?>" rel="nofollow"><?php get_template_part( 'library/images/logo.svg' ); ?></a></p>

          <?php get_search_form(); ?>

          <button class="js-mobile-nav-toggle"><i class="fa fa-bars" aria-hidden="true"></i> Menu</button>

          <nav class="nav">
            <?php
            wp_nav_menu(array(
                'container' => false,                           // remove nav container
                'container_class' => 'menu',                 // class of container (should you choose to use it)
                'menu' => __( 'The Main Menu', 'bonestheme' ),  // nav name
                'menu_class' => 'main-nav',               // adding custom nav class
                'theme_location' => 'main-nav',                 // where it's located in the theme
                'before' => '',                                 // before the menu
                'after' => '',                                  // after the menu
                'link_before' => '',                            // before each link
                'link_after' => '',                             // after each link
                'depth' => 0,                                   // limit the depth of the nav
            ));
            ?>
          </nav>

        </div>

      </header>
