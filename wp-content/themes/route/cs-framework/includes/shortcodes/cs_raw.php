<?php
/**
 *
 * RAW HTML Shortcode
 * @since 1.0.0
 * @version 1.1.0
 *
 */
if( ! function_exists( 'cs_raw' ) ) {
  function cs_raw( $atts, $content = '', $key = '' ) {
    return rawurldecode( base64_decode( strip_tags( $content ) ) );
  }
  add_shortcode( 'cs_raw_html', 'cs_raw' );
  add_shortcode( 'cs_raw_js', 'cs_raw' );
}