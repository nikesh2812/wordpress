<?php
/**
 *
 * The template for displaying archive pages.
 * @since 4.3.0
 * @version 1.0.0
 *
 */
get_header(); ?>
<section id="page-header">
  <div class="container">
    <div class="row">
      <div class="col-md-12 md-padding">
        <h1 class="page-title">
          <?php
            if ( is_day() ) {
              printf( __( 'Daily Archives: %s', 'route' ), get_the_date() );
            } elseif ( is_month() ) {
              printf( __( 'Monthly Archives: %s', 'route' ), get_the_date( 'F Y' ) );
            } elseif ( is_year() ) {
              printf( __( 'Yearly Archives: %s', 'route' ), get_the_date( 'Y' ) );
            } else {
              _e( 'Archives', 'route' );
            }
          ?>
        </h1>
        <?php echo cs_breadcrumb(); ?>
      </div>
    </div>
  </div>
</section><!-- /page-header -->
<?php
$page_id  = cs_get_option( 'portfolio_archives_layout' );

if( ! empty( $page_id ) ) {

  $get_page = get_page( $page_id );

  global $cs_has_section;

  $cs_post_meta    = get_post_meta( $page_id, '_custom_page_options', true );
  $cs_page_layout  = ( isset ( $cs_post_meta['sidebar'] ) ) ? $cs_post_meta['sidebar'] : 'full';
  $cs_page_column  = ( $cs_page_layout == 'full' ) ? '12' : '9';
  $vc_exclude      = cs_get_option( 'vc_exclude_shortcodes' );
  $vc_exclude      = ( is_array( $vc_exclude ) ) ? $vc_exclude : array();
  $cs_page_padding = ( ! in_array( 'vc_row', $vc_exclude ) ) ? 'md-padding ' : '';
  $cs_has_section  = isset( $cs_post_meta['section'] ) ? true : false;

  if( ( $cs_page_layout == 'fluid' || isset( $cs_post_meta['section'] ) ) && ! in_array( 'vc_row', $vc_exclude ) ) {

    echo do_shortcode( $get_page->post_content );

  } else {
  ?>
  <section class="main-content <?php echo $cs_page_padding; ?>page-layout-<?php echo $cs_page_layout; ?>">
    <div class="container">
      <div class="row">

        <?php cs_page_sidebar( 'left', $cs_page_layout ); ?>

        <div class="col-md-<?php echo $cs_page_column; ?>">
          <div class="page-content">
            <?php
              echo do_shortcode( $get_page->post_content );
            ?>
          </div>
        </div>

        <?php cs_page_sidebar( 'right', $cs_page_layout ); ?>

      </div>
    </div>
  </section>
  <?php
  }

} else {
  get_template_part( 'templates/page', 'loop' );
}
get_footer();