<?php
/**
 * Author: VCU Libraries Digital Engagement
 * URL: https://library.vcu.edu
 *
 * @package VCU_Libraries_WP
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

        <div class="img-portal">

            <h4>More</h4>
            <p>Explore historical materials related to the history of social reform at 
VCU Libraries’ Image Portal.</p>
            <a href="http://images.socialwelfare.library.vcu.edu/" class="no-border"><?php get_template_part( 'library/images/img-gallery-logo.svg' ); ?></a>
        </div>

        <div class="footer-creds">
            <a href="https://library.vcu.edu/" class="no-border"><?php get_template_part( 'library/images/vcu-footer-logo.svg' ); ?></a>
        
            <p class="source-org copyright">&copy; <?php echo esc_html( date( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>.</p>
            <p class="last-modified"><small>Last modified: <?php the_modified_time( 'F j, Y' ); ?></small></p>

            <p class="editor-login"><a href="<?php echo esc_url( admin_url() ); ?>">Editor Login</a></p>
        </div>
   </div>

</footer>

</div>

<?php wp_footer(); ?>

</body>

</html> <!-- end of site. what a ride! -->
