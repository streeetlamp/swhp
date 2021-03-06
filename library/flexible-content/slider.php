<?php
/**
 * Author: VCU Libraries Digital Engagement
 * URL: https://library.vcu.edu
 *
 * @package VCU_Libraries_WP
 */
?>

<div class="slider slider-wrap slide-fade flex-row" data-autoplay="true" data-slidespeed="7500" data-slidedots="true">
  <div class="slider-list">

    <?php
    while ( have_rows( 'slider' ) ) :
        the_row();

      // vars
      $image = get_sub_field( 'image' );
      $excerpt = get_sub_field( 'excerpt' );
      $headline = get_sub_field( 'headline' );
      $link = get_sub_field( 'link' );
      ?>

      <div class="slide" style="background-image:url('<?php echo $image['sizes']['large']; ?>');">
        <?php if ( $excerpt || $headline || $link ) : ?>
        <div class="slide-excerpt-wrap">
            <div class="slide-inner">
                <h2 class="slide-headline"><?php echo $headline; ?></h2>
                <div class="slide-excerpt"><?php echo $excerpt; ?></div><?php if ( $link ) : ?><div class="slide-button"><a href="<?php echo $link; ?>">Learn More</a></div><?php endif; ?>
            </div>
        </div>
        <?php endif; ?>
      </div>

    <?php endwhile; ?>

  </div>
</div>
