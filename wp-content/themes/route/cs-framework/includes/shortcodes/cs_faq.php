<?php
/**
 *
 * FAQ Shortcode
 * @since 1.0.0
 * @version 1.3.0
 *
 *
 */
if( ! function_exists( 'cs_faq' ) ) {
  function cs_faq( $atts, $content = '', $key = '' ) {

    global $cs_faqs;
    $cs_faqs = array();

    extract( shortcode_atts( array(
      'id'        => '',
      'class'     => '',
      'in_style'  => '',
    ), $atts ) );

    do_shortcode( $content );

    // is not empty clients
    if( empty( $cs_faqs ) ) { return; }

    $id         = ( $id ) ? ' id="'. $id .'"' : '';
    $class      = ( $class ) ? ' '. $class : '';
    $in_style   = ( $in_style ) ? ' style="'. $in_style .'"' : '';
    $active     = ( isset( $_REQUEST['faq'] ) ) ? $_REQUEST['faq'] : false;
    $active_all = ( ! isset( $_REQUEST['faq'] ) ) ? ' class="active"': '';
    $uniqid     = uniqid();

    // begin output
    $output   = '<div'. $id .' class="cs-faq'. $class .'"'. $in_style .'>';

    // filter
    $output  .= '<div class="cs-faq-filter">';
    $output  .= '<a href="#" data-filter="*"'. $active_all .'>'. __( 'All', 'route' ) .'</a>';
    foreach ( $cs_faqs as $key => $faq ) {
      $active_nav = ( ( $key + 1 ) == $active ) ? ' class="active"' : '';
      $output  .= ( ! empty( $faq['atts']['title'] ) ) ? '<a href="#" data-filter=".'. $uniqid .'-'. $key .'"'. $active_nav .'>'. $faq['atts']['title'] .'</a>' : '';
    }
    $output  .= '</div>';

    // list
    $output  .= '<div class="cs-faq-isotope">';
    foreach ( $cs_faqs as $key => $faq ) {
      $active_content  = ( ( $key + 1 ) != $active && $active ) ? ' cs-faq-hidden' : '';
      $output  .= '<div class="cs-faq-item '. $uniqid .'-'. $key . $active_content .'">';
      $output  .= do_shortcode( $faq['content'] );
      $output  .= '</div>';
    }

    $output  .= '</div>';
    $output  .= '</div>';
    // end output

    return $output;
  }
  add_shortcode( 'cs_faq', 'cs_faq' );
}


/**
 *
 * Tab Shortcode
 * @version 1.0.0
 * @since 1.1.0
 *
 */
if( ! function_exists( 'cs_faq_block' ) ) {
  function cs_faq_block( $atts, $content = '', $key = '' ) {
    global $cs_faqs;
    $cs_faqs[]  = array( 'atts' => $atts, 'content' => $content );
    return;
  }
  add_shortcode( 'cs_faq_block', 'cs_faq_block' );
}