<?php
/**
 *
 * Popover Shortcode
 * @since 1.0.0
 * @version 1.1.0
 *
 */
if( ! function_exists( 'cs_popover' ) ) {
  function cs_popover( $atts, $content = '', $key = '' ) {

    extract( shortcode_atts( array(
      'selector'  => '',
      'placement' => 'top',
      'trigger'   => 'hover',
      'title'     => '',
    ), $atts ) );

    $placement  = ( $placement ) ? ' data-placement="'. $placement .'"': '';
    $trigger    = ( $trigger ) ? ' data-trigger="'. $trigger .'"': '';
    $title      = ( $title ) ? ' data-title="'. $title .'"': '';

    // begin output
    $output    = '<div class="cs-popover-trigger cs-hide" data-selector=".'. $selector .'"'. $title . $placement . $trigger .'>';
    $output   .= do_shortcode( $content );
    $output   .= '</div>';
    // end output

    return $output;
  }
  add_shortcode( 'cs_popover', 'cs_popover' );
}