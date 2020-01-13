<?php
/**
 *
 * Column and Columns Shortcode
 * @since 1.0.0
 * @version 1.2.0
 *
 */
if( ! function_exists( 'cs_column' ) ) {
  function cs_column( $atts, $content = '', $key = '' ) {

    extract( shortcode_atts( array(
      'id'                 => '',
      'class'              => '',
      'in_style'           => '',
      'css'                => '',

      // background
      'bgcolor'            => '',
      'background'         => '',
      'repeat'             => '',
      'position'           => '',
      'size'               => '',
      'cover'              => 0,

      // equal height
      'mobile_bg_height'   => '',

      // overlay
      'overlay'            => 0,
      'overlay_color'      => '#000',
      'overlay_opacity'    => 0.5,

      'width'              => '1/1',
      'offset'             => '',
      'animation'          => '',
      'animation_delay'    => '',
      'animation_duration' => '',
    ), $atts ) );

    $id         = ( $id ) ? ' id="'. $id .'"' : '';
    $class      = ( $class ) ? ' '. $class : '';
    $offset     = ( $offset ) ? ' '. str_replace( 'vc_', '', $offset ) : '';
    $custom_css = ( function_exists( 'vc_shortcode_custom_css_class' ) ) ? vc_shortcode_custom_css_class( $css, ' ' ) : '';

    // column background
    $background_image    = ( $background ) ? ' background-image: url(' . $background . ');' : '';
    $background_repeat   = ( $background && ! empty( $repeat ) ) ? ' background-repeat: ' . $repeat . ';' : '';
    $background_position = ( $background && ! empty( $position ) ) ? ' background-position: ' . $position . ';' : '';
    $background_size     = ( $background && ! empty( $size ) ) ? ' background-size: ' . $size . ';' : '';
    $background_color    = ( $bgcolor ) ? ' background-color: ' . $bgcolor . ';' : '';
    $background_style    = ( $background ) ? $background_image . $background_repeat . $background_position . $background_size : '';
    $has_background      = ( $background || $bgcolor ) ? true : false;
    $overlay_div         = ( $overlay ) ? '<div class="cs-column-overlay" style="background-color:'. cs_hex2rgba($overlay_color, $overlay_opacity) . ';"></div>' : '';
    $bg_class            = ( $has_background ) ? ' cs-column-background' : '';
    $mobile_bg_height    = ( $background && ! empty( $mobile_bg_height ) ) ? ' min-height: ' . $mobile_bg_height . ';' : '';

    if( $in_style || $background_style || $mobile_bg_height ) {
      $in_style = ' style="'. $in_style . $background_style . $background_color . $mobile_bg_height .'"';
    }

    // element animation
    $animation        = ( $animation ) ? ' cs-animation '. $animation : '';
    $animation_data   = ( $animation && $animation_delay ) ? ' data-delay="'. $animation_delay .'"' : '';
    $animation_data   = ( $animation && $animation_duration ) ? $animation_data . ' data-duration="'. $animation_duration .'"' : $animation_data;

    $output  = '';
    $output .= '<div'. $id .' class="col-md-'. cs_get_bootstrap_col( $width ) . $offset . $animation . $class . $bg_class . $custom_css .'"'. $animation_data . $in_style .'>';
    $output .= $overlay_div;
    $output .= '<div class="cs-column-inner">';
    $output .= do_shortcode( $content );
    $output .= '</div>';
    $output .= '</div>';

    return $output;
  }
  add_shortcode( 'vc_column', 'cs_column' );
  add_shortcode( 'vc_column_inner', 'cs_column' );
}