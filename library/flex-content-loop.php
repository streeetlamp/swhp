<?php
/**
 * Author: VCU Libraries Digital Engagement
 * URL: https://library.vcu.edu
 *
 * @package VCU_Libraries_WP
 */

  if ( get_row_layout() === '1_column' ) :
    get_template_part( 'library/flexible-content/one', 'column' );

  // check current row layout
  elseif ( get_row_layout() === '2_column' ) :
    get_template_part( 'library/flexible-content/two', 'column' );

  // check current row layout
  elseif ( get_row_layout() === '3_column' ) :
    get_template_part( 'library/flexible-content/three', 'column' );

  // check current row layout
  elseif ( get_row_layout() === '4_column' ) :
    get_template_part( 'library/flexible-content/four', 'column' );

    // check current row layout
  elseif ( get_row_layout() === '1_to_3_column' ) :
    get_template_part( 'library/flexible-content/one-to-three', 'column' );

  // check current row layout
  elseif ( get_row_layout() === '3_to_1_column' ) :
    get_template_part( 'library/flexible-content/three-to-one', 'column' );

  // check current row layout
  elseif ( get_row_layout() === 'slider' ) :
    get_template_part( 'library/flexible-content/slider' );

  endif;
