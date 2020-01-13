<?php
/**
 *
 * Visual Composer Plugin before init
 *
 */
if( ! function_exists( 'cs_vc_before_init' ) ) {
  function cs_vc_before_init() {

    vc_set_as_theme(true);
    vc_set_default_editor_post_types( array( 'page', 'post', 'portfolio' ) );
    include_once( FRAMEWORK_PLUGIN_DIR . '/js-composer-init/includes/map.php' );

  }
  add_action( 'vc_before_init', 'cs_vc_before_init' );
}

/**
 *
 * Visual Composer Plugin after init
 *
 */
if( ! function_exists( 'cs_vc_after_init' ) ) {
  function cs_vc_after_init() {

    if( ! vc_license()->isActivated() ) {

      remove_action( 'upgrader_pre_download', array( vc_updater(), 'preUpgradeFilter' ) );

      if( method_exists( vc_updater(),'updateManager') ) {
        remove_action( 'pre_set_site_transient_update_plugins', array( vc_updater()->updateManager(), 'check_update' ) );
      }

    }

  }
  add_action( 'vc_after_init', 'cs_vc_after_init' );
}


function edit_vc_front_render_shortcodes( $output ) {
  $output = str_replace( 'vc_col-sm-6', 'col-md-6', $output );
  return $output;
}
add_filter('vc_front_render_shortcodes', 'edit_vc_front_render_shortcodes', 10, 2);