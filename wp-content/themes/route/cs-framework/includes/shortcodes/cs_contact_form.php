<?php
/**
 *
 * Contact Form 7 Shortcode
 * @since 1.0.0
 * @version 1.1.0
 *
 */
if( ! function_exists( 'cs_contact_form' ) ) {
  function cs_contact_form( $atts, $content = '', $key = '' ) {
    return do_shortcode( '[contact-form-7 id="'. $atts['id'] .'"]' );
  }
  add_shortcode( 'cs_contact_form', 'cs_contact_form' );
}