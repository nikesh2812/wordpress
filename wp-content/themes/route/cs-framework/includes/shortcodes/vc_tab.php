<?php
/**
 *
 * VC Tabs Shortcode
 *
 * @since 1.0.0
 * @version 4.1.0
 *
 */
if( function_exists( 'cs_tabs' ) ) {
  add_shortcode( 'vc_tabs', 'cs_tabs' );
  add_shortcode( 'vc_tab', 'cs_tab' );
}