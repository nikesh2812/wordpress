<?php
/**
 *
 * Border Shortcode
 * @since 1.0.0
 * @version 1.1.0
 *
 */
if( ! function_exists( 'cs_border' ) ) {
  function cs_border( $atts, $content = '', $key = '' ) {

    extract( shortcode_atts( array(
      'id'    => '',
      'class' => '',
    ), $atts ) );

    $id    = ( $id ) ? ' id="'. $id .'"' : '';
    $class = ( $class ) ? ' '. $class : '';

    return '<div'. $id .' class="cs-fluid-border'. $class .'">' . $content . '</div>';
  }
  add_shortcode( 'cs_border', 'cs_border' );
}