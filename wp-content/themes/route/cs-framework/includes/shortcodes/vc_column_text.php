<?php
/**
 *
 * Column Text Shortcode
 * @since 1.0.0
 * @version 1.2.0
 *
 */
if( ! function_exists( 'vc_column_text' ) ) {
  function vc_column_text( $atts, $content = '', $key = '' ) {

    extract( shortcode_atts( array(
      'id'                  => '',
      'class'               => '',
      'in_style'            => '',
      'animation'           => '',
      'animation_delay'     => '',
      'animation_duration'  => '',
      'css'                 => '',
    ), $atts ) );

    $id         = ( $id ) ? ' id="'. $id .'"' : '';
    $class      = ( $class ) ? ' '. $class : '';
    $in_style   = ( $in_style ) ? ' style="'. $in_style .'"' : '';
    $custom_css = ( function_exists( 'vc_shortcode_custom_css_class' ) ) ? vc_shortcode_custom_css_class( $css, ' ' ) : '';

    // element animation
    $animation        = ( $animation ) ? ' cs-animation '. $animation : '';
    $animation_data   = ( $animation && $animation_delay ) ? ' data-delay="'. $animation_delay .'"' : '';
    $animation_data   = ( $animation && $animation_duration ) ? $animation_data . ' data-duration="'. $animation_duration .'"' : $animation_data;

    return '<div'. $id .' class="cs-column-text'. $animation . $class . $custom_css .'"'. $animation_data . $in_style .'>'. cs_set_wpautop( $content ) .'</div>';
  }
  add_shortcode( 'vc_column_text', 'vc_column_text' );
}