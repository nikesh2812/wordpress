<?php
/**
 *
 * Columns Shortcode
 * @since 1.0.0
 * @version 1.1.0
 *
 */
if( ! function_exists( 'cs_shortcode_column' ) ) {
  function cs_shortcode_column( $atts, $content = '', $key = '' ) {
    return '<div class="cs-'. str_replace( '_', '-', $key ) .'">'. do_shortcode( $content ) .'</div>';
  }
  add_shortcode('one_half',     'cs_shortcode_column');
  add_shortcode('one_third',    'cs_shortcode_column');
  add_shortcode('one_fourth',   'cs_shortcode_column');
  add_shortcode('one_fifth',    'cs_shortcode_column');
  add_shortcode('one_sixth',    'cs_shortcode_column');
  add_shortcode('two_third',    'cs_shortcode_column');
  add_shortcode('two_fifth',    'cs_shortcode_column');
  add_shortcode('three_fifth',  'cs_shortcode_column');
  add_shortcode('three_fourth', 'cs_shortcode_column');
  add_shortcode('four_fifth',   'cs_shortcode_column');
  add_shortcode('five_sixth',   'cs_shortcode_column');
}

/**
 *
 * Columns Last Shortcode
 * @since 1.0.0
 * @version 1.1.0
 *
 */
if( ! function_exists( 'cs_shortcode_column_last' ) ) {
  function cs_shortcode_column_last( $atts, $content = '', $key = '' ) {
    return '<div class="'. str_replace( array( '_last', '_' ), array( '', '-' ), $key ) .' cs-last-column">'. do_shortcode( $content ) .'</div><div class="clear"></div>';
  }
  add_shortcode('one_half_last',     'cs_shortcode_column_last');
  add_shortcode('one_third_last',    'cs_shortcode_column_last');
  add_shortcode('one_fourth_last',   'cs_shortcode_column_last');
  add_shortcode('one_fifth_last',    'cs_shortcode_column_last');
  add_shortcode('one_sixth_last',    'cs_shortcode_column_last');
  add_shortcode('two_third_last',    'cs_shortcode_column_last');
  add_shortcode('two_fifth_last',    'cs_shortcode_column_last');
  add_shortcode('three_fifth_last',  'cs_shortcode_column_last');
  add_shortcode('three_fourth_last', 'cs_shortcode_column_last');
  add_shortcode('four_fifth_last',   'cs_shortcode_column_last');
  add_shortcode('five_sixth_last',   'cs_shortcode_column_last');
}
