<div id="header-logo">
  <div class="container">
    <div class="row">
      <div class="col-md-4">
        <div id="header-logo-wrap">
          <?php echo cs_site_logo(); ?><h2 class="site-description" style="margin-top: 30px;font-size: 20px;"><?php echo bloginfo( 'description' ); ?></h2><!-- /site-logo -->
          <?php if ( is_active_sidebar('cs-logo-right') ) { ?><div id="site-logo-right"><div id="site-logo-right-content"><?php dynamic_sidebar( 'cs-logo-right' )?></div></div><!-- /site-logo-right --><?php } ?>
          <?php echo cs_mobile_icon(); ?><!-- /mobile-icon -->
        </div>
      </div>
      <div class="col-md-4">
        <div class="custom-search-header">
          <div class="cs-search-form">
            <form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">
              <input type="text" name="s" class="cs-search" placeholder="What can help you find ?" />
              <button type="submit" class="fa fa-search"></button>
              <?php do_action( 'cs_search_hidden_fields' ); ?>
            </form>
          </div>
        </div>
      </div>
      <div class="col-md-4 right-site-logo">
        <div id="site-logo-right site-logo-right1">
            <img src="<?=do_shortcode('[right-logo]') ?>" class="img img-responsive" style="float: right;">
        </div>
      </div>
    </div>
  </div>
</div><!-- /header-logo -->

<header id="masthead" role="banner">
      <div class="container">
        <div class="cs-inner">
          <?php echo cs_site_menu(); ?><!-- /site-nav -->
        </div>
      </div>
  <div id="site-header-shadow"></div>
</header><!-- /header -->