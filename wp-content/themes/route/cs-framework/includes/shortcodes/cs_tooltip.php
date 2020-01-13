<?php
/**
 *
 * ToolTip Shortcode
 * @since 1.0.0
 * @version 1.1.0
 *
 */
if( ! function_exists( 'cs_tooltip' ) ) {
  function cs_tooltip( $atts, $content = '', $key = '' ) {

    extract( shortcode_atts( array(
      'selector'  => '',
      'placement' => 'top',
      'trigger'   => 'hover',
    ), $atts ) );

    $placement = ( $placement ) ? ' data-placement="'. $placement .'"': '';
    $trigger   = ( $trigger ) ? ' data-trigger="'. $trigger .'"': '';

    // begin output
    $output  = '<div class="cs-tooltip-trigger cs-hide" data-selector=".'. $selector .'"'. $placement . $trigger .'>';
    $output .= do_shortcode( $content );
    $output .= '</div>';
    // end output

    return $output;
  }
  add_shortcode( 'cs_tooltip', 'cs_tooltip' );
}