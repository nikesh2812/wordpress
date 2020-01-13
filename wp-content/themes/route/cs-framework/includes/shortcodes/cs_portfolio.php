<?php
/**
 *
 * Portfolio Shortcode
 * @since 1.0.0
 * @version 1.6.0
 *
 */
if( ! function_exists( 'cs_portfolio' ) ) {
  function cs_portfolio( $atts, $content = '', $key = '' ) {

    global $wp_query, $paged, $post;

    $defaults = array(
      'id'                  => '',
      'class'               => '',
      'cats'                => 0,
      'style'               => 'default',
      'columns'             => 3,
      'layout'              => 'masonry',
      'no_love'             => '',
      'limit'               => 9,
      'nav'                 => 'paging',
      'model'               => 'default',
      'size'                => 'large',
      'no_filter'           => '',
      'filter_align'        => 'center',
      'filter_shape'        => 'pill',
      'filter_color'        => '',
      'filter_hover_color'  => '',
      'filter_border_width' => '',
    );

    extract( shortcode_atts( $defaults, $atts ) );

    $id    = ( $id ) ? ' id="'. $id .'"' : '';
    $class = ( $class ) ? ' '. $class : '';

    if( is_tax( 'portfolio-category' ) && is_archive( 'portfolio' ) && ! is_single() && ! is_page() ) {
      $cats      = get_queried_object_id();
      $limit     = get_option( 'posts_per_page' );
      $no_filter = true;
    }


    $is_row = ( $style == 'default' ) ? ' row' : '';
    $love   = ( $no_love ) ? false : true;

    if( is_front_page() || is_home() ) {
      $paged = ( get_query_var('paged') ) ? intval( get_query_var('paged') ) : intval( get_query_var('page') );
    } else {
      $paged = intval( get_query_var('paged') );
    }


    // Query
    $args = array(
      'posts_per_page'  => $limit,
      'post_type'       => 'portfolio',
      'paged'           => $paged,
      'post_status'     => 'publish',
    );

    if( $cats ) {
      $args['tax_query'] = array(
        array(
          'taxonomy'  => 'portfolio-category',
          'field'     => 'id',
          'terms'     => explode( ',', $cats )
        )
      );
    }

    if( is_tax( 'portfolio-tag' ) && is_archive( 'portfolio' ) && ! is_single() && ! is_page() ) {

      $no_filter = true;
      $term_id = get_queried_object_id();
      $args['posts_per_page'] = get_option( 'posts_per_page' );

      $args['tax_query'] = array(
        array(
          'taxonomy'  => 'portfolio-tag',
          'field'     => 'id',
          'terms'     => explode( ',', $term_id )
        )
      );

    }

    $tmp_query  = $wp_query;
    $wp_query   = new WP_Query( $args );

    ob_start();
    if( have_posts() ) :

      echo '<div'. $id .' class="portfolio-loop portfolio-'. $style .' portfolio-model-'. $model . $class .'">';

      // custom colors
      $portfolio_class  = '';
      $loader_class     = '';
      if ( $filter_color || $filter_hover_color || $filter_border_width ) {

        $custom_style     = '';
        $portfolio_uniqid = uniqid();

        if ( $filter_hover_color ) {
          $custom_style .= '.portfolio-'. $portfolio_uniqid .' a:hover,';
          $custom_style .= '.portfolio-'. $portfolio_uniqid .' a.active{';
          $custom_style .= 'color:'. $filter_hover_color .'!important;';
          $custom_style .= 'border-color:'. $filter_hover_color .'!important;';
          $custom_style .= '}';
        }

        if ( $filter_color || $filter_border_width ) {
          $custom_style .= '.portfolio-'. $portfolio_uniqid .' a{';
          $custom_style .= ( $filter_color ) ? 'color:'. $filter_color .'!important;border-color:'. $filter_color .'!important;' : '';
          $custom_style .= ( $filter_border_width ) ? 'border-width:'. cs_esc_string( $filter_border_width ) .'px!important;' : '';
          $custom_style .= '}';

          if( $model == 'ajax' ) {
            $custom_style .= '.loader-'. $portfolio_uniqid .'{';
            $custom_style .= ( $filter_color ) ? 'background-color:'. $filter_color .'!important;' : '';
            $custom_style .= '}';
          }
        }

        // add inline style
        cs_add_inline_style( $custom_style );

        $portfolio_class = ' portfolio-'. $portfolio_uniqid;
        $loader_class    = ' loader-'. $portfolio_uniqid;

      }

      // isotope-container
      echo '<div class="isotope-container">';
      echo '<div class="isotope-loading cs-loader'. $loader_class .'"></div>';

        if( $model == 'ajax' ) {

          // enqueue styles
          wp_enqueue_style( 'cs-royalslider' );
          wp_enqueue_script( 'cs-royalslider' );

          echo '<div class="ajax-portfolio-container">';
            echo '<div class="ajax-portfolio-wrapper">';
              echo '<div class="ajax-control'. $portfolio_class .'"><a href="#" class="ajax-close fa fa-times"></a></div>';
              echo '<div class="container ajax-content"></div>';
            echo '</div>';
          echo '</div>';
        }

        // isotope-wrapper
        echo '<div class="isotope-wrapper">';

        // isotope-filter
        if ( ! $no_filter ) {

          $order = array();
          $categories = get_terms( 'portfolio-category' );

          foreach( $categories as $key => $value ) {
            $order[$value->slug] = $key;
          }

          $item_cats = array();

          while( have_posts() ) : the_post();

            $item_terms = get_the_terms( get_the_ID(), 'portfolio-category' );

            if( ! empty( $item_terms ) ) {
              foreach ( $item_terms as $item_term ) {
                if( is_integer( $order[$item_term->slug] ) ) {
                  $item_cats[$order[$item_term->slug]] = array( 'slug' => $item_term->slug, 'name' => $item_term->name );
                }
              }
            }

          endwhile;

          sort( $item_cats );

          if( ! empty( $item_cats ) ) {

            echo '<div class="container">';
            echo '<div class="isotope-filter isotope-filter-'. $filter_shape .' text-'. $filter_align . $portfolio_class .'">';
            echo '<a href="#" data-filter="*" class="active">'. __( 'All', 'route' ) .'</a>';

            foreach( $item_cats as $v ) {
              echo '<a href="#" data-filter=".'. $v['slug'] .'">'. $v['name'] .'</a>';
            }

            echo '</div>';
            echo '</div>';

          }

        }

        // isotope-portfolio
        echo '<div class="isotope-portfolio isotope-loop'. $is_row .'" data-layout="'. $layout .'">';

          while( have_posts() ) : the_post();

            $item_args = array(
              'columns' => $columns,
              'model'   => $model,
              'love'    => $love,
              'size'    => $size,
            );
            cs_portfolio_item( $item_args );

          endwhile;

        echo '</div>'; // isotope-portfolio

        // portfolio-pagination
        if( $nav != 'hide' ) {
          $nav_args = array(
            'isotope'         => 1,
            'post_type'       => 'portfolio',
            'nav'             => $nav,
            'posts_per_page'  => $limit,
            'columns'         => $columns,
            'model'           => $model,
            'love'            => $love,
            'size'            => $size,
            'cats'            => $cats,
          );
          cs_paging_nav( $nav_args );
        }

        echo '<div class="clear"></div>'; // isotope-wrapper
        echo '</div>'; // isotope-wrapper

      echo '</div>'; // isotope-container
    echo '</div>';

    else:
      echo '<span class="fa fa-warning-sign"></span> nothing any portfolio item.';
    endif;

    $output = ob_get_clean();

    wp_reset_query();
    wp_reset_postdata();
    $wp_query = $tmp_query;

    return $output;

  }
  add_shortcode( 'cs_portfolio', 'cs_portfolio' );
  add_shortcode( 'vc_portfolio', 'cs_portfolio' );
}