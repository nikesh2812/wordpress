<?php
/**
 *
 * Gap and Space Shortcode
 * @since 1.0.0
 * @version 1.1.0
 *
 */
if( ! function_exists( 'cs_space' ) ) {
  function cs_space( $atts, $content = '', $key = '' ) {

    extract( shortcode_atts( array(
      'id'    => '',
      'class' => '',
      'size'  => '',
    ), $atts ) );

    $id    = ( $id ) ? ' id="'. $id .'"' : '';
    $class = ( $class ) ? ' '. $class : '';
    $size  = ( $size ) ? ' style="margin-top:'. cs_validpx( $size ) .'"' : '';

    return '<hr'. $id .' class="cs-space'. $class .'"'. $size .'>';
  }
  add_shortcode( 'cs_space', 'cs_space' );
  add_shortcode( 'cs_gap', 'cs_space' );
}