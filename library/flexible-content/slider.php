<div class="slider slider-wrap slide-fade flex-row" data-autoplay="true" data-slidespeed="7500" data-slidedots="true">
  <div class="slider-list">

    <?php while( have_rows('slider') ): the_row(); 

      // vars
      $image = get_sub_field('image');
      ?>


      <div class="slide" style="background-image:url('<?php echo $image['sizes']['large']; ?>');"></div>

    <?php endwhile; ?>

  </div>  
</div>