<?php
/**
 * Author: VCUarts
 * URL: http://arts.vcu.edu
 *
 * @package VCUarts_Bones_WP
 */

?>

<footer class="footer">

    <div class="inner-footer">

        <nav class="footer-nav">
          <?php wp_nav_menu(array(
            'container' => false,                           // remove nav container
            'container_class' => 'menu',                 // class of container (should you choose to use it)
            'menu' => __( 'The Footer Menu', 'bonestheme' ),  // nav name
            'menu_class' => 'footer-nav',               // adding custom nav class
            'theme_location' => 'footer-nav',                 // where it's located in the theme
            'before' => '',                                 // before the menu
            'after' => '',                                  // after the menu
            'link_before' => '',                            // before each link
            'link_after' => '',                             // after each link
            'depth' => 1,                                   // limit the depth of the nav
          )); ?>
        </nav>


       <p class="source-org copyright">&copy; <?php echo esc_html( date( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>.</p>
       <p class="last-modified">Last modified: <?php the_modified_time( 'F j, Y' ); ?></p>
   </div>

</footer>

</div>

<?php wp_footer(); ?>

</body>

</html> <!-- end of site. what a ride! -->
