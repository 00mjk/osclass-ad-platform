<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="<?php echo str_replace('_', '-', osc_current_user_locale()) ; ?>">
<head>
  <?php osc_current_web_theme_path('head.php') ; ?>
</head>

<body id="body-home" class="layout-<?php echo bet_param('home_layout'); ?>">
  <?php osc_current_web_theme_path('header.php') ; ?>

  <?php if(bet_banner('home_top') !== false) { ?>
    <div class="home-container banner-box"><div class="inside"><?php echo bet_banner('home_top'); ?></div></div>
  <?php } ?>

  <?php osc_get_premiums(bet_param('premium_home_count')); ?>

  <?php if(bet_param('premium_home') == 1 && osc_count_premiums() > 0) { ?>
    <div class="home-container premium">
      <div class="inner">

        <!-- PREMIUMS BLOCK -->
        <div id="premium" class="products grid">
          <h2><?php _e('Featured listings', 'beta'); ?></h2>

          <div class="block">
            <div class="prod-wrap">
              <?php $c = 1; ?>
              <?php while( osc_has_premiums() ) { ?>
                <?php bet_draw_item($c, true); ?>
                  
                <?php $c++; ?>
              <?php } ?>

              <?php if(osc_count_premiums() <= 0) { ?>
                <div class="home-empty">
                  <img src="<?php echo osc_current_web_theme_url('images/home-empty.png'); ?>" />
                  <strong><?php _e('No premium listing yet', 'beta'); ?></strong>
                </div>
              <?php } ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php } ?>


  <?php if(function_exists('osc_slider')) { ?>

    <!-- Slider Block -->
    <div class="home-container slider">
      <div class="inner">
        <div id="home-slider">
          <?php osc_slider(); ?>
        </div>
      </div>
    </div>
  <?php } ?>




  <?php if (bet_param('promote_home') == 1) { ?>
    <div class="home-container promote">
      <div class="inner">
        <div class="promote">
          <h2><?php _e('Want to sell quickly?', 'beta'); ?></h2>
          <h3><?php _e('Publish a listing, promote ad to make it more attractive and get more hits and sell item much faster', 'beta'); ?></h3>

         <div class="box">
          <div class="bl b1">
            <div class="img"><div><span><img src="<?php echo osc_current_web_theme_url('images/publish.svg'); ?>" alt="<?php echo osc_esc_html(__('Publish an ad', 'beta')); ?>"/></span></div></div>
            <strong><?php _e('Add a listing', 'beta'); ?></strong>
            <span><?php _e('It takes just 1 minute!', 'beta'); ?></span>
          </div>

          <div class="bl b2">
            <div class="img"><div><span><img src="<?php echo osc_current_web_theme_url('images/promote.svg'); ?>" alt="<?php echo osc_esc_html(__('Promote listing', 'beta')); ?>"/></span></div></div>
            <strong><?php _e('Promote it', 'beta'); ?></strong>
            <span><?php _e('To make it more attractive', 'beta'); ?></span>
          </div>


          <div class="bl b3">
            <div class="img"><div><span><img src="<?php echo osc_current_web_theme_url('images/sold.svg'); ?>" alt="<?php echo osc_esc_html(__('Listing sold', 'beta')); ?>"/></span></div></div>
            <strong><?php _e('Sold', 'beta'); ?></strong>
            <span><?php _e('Premium item sells 5x faster', 'beta'); ?></span>
          </div>

          <i class="fa fa-caret-right ar ar1 mbCl"></i>
          <i class="fa fa-caret-right ar ar2 mbCl"></i>

          </div>
        </div>
      </div>
    </div>
  <?php } ?>



  <div class="home-container latest">
    <div class="inner">

      <!-- LATEST LISTINGS BLOCK -->
      <div id="latest" class="products grid">
        <h2><?php _e('Lately added on our classifieds', 'beta'); ?></h2>

        <?php View::newInstance()->_exportVariableToView('latestItems', bet_random_items()); ?>

        <?php if( osc_count_latest_items() > 0) { ?>
          <div class="block">
            <div class="prod-wrap">
              <?php $c = 1; ?>
              <?php while( osc_has_latest_items() ) { ?>
                <?php bet_draw_item($c); ?>
                
                <?php $c++; ?>
              <?php } ?>
            </div>
          </div>
        
        <?php } else { ?>
          <div class="home-empty">
            <img src="<?php echo osc_current_web_theme_url('images/home-empty.png'); ?>" />
            <strong><?php _e('No latest listing yet', 'beta'); ?></strong>
          </div>
        <?php } ?>

        <?php View::newInstance()->_erase('items') ; ?>
      </div>
    </div>
  </div>



  <?php if (bet_param('stats_home') == 1) { ?>
    <div class="home-container stats">
      <div class="inner">
        <div class="stats">
          <h2><?php _e('We are best thanks to you!', 'beta'); ?></h2>
          <h3><?php _e('Our classifieds are constantly spreading into world, stats says it all', 'beta'); ?></h3>

          <div class="box">
            <div class="bl bl1">
              <div class="img"><img src="<?php echo osc_current_web_theme_url('images/listing.svg'); ?>" alt="<?php echo osc_esc_html(__('Active listings', 'beta')); ?>"/></div>
              <strong><?php echo osc_total_active_items(); ?></strong>
              <span><?php _e('Active ads', 'beta'); ?></span>
            </div>

            <div class="bl bl2">
              <div class="img"><img src="<?php echo osc_current_web_theme_url('images/category.svg'); ?>" alt="<?php echo osc_esc_html(__('Categories', 'beta')); ?>"/></div>
              <strong><?php echo osc_count_categories(); ?></strong>
              <span><?php _e('Categories', 'beta'); ?></span>
            </div>

            <div class="bl bl3">
              <div class="img"><img src="<?php echo osc_current_web_theme_url('images/region.svg'); ?>" alt="<?php echo osc_esc_html(__('Regions', 'beta')); ?>"/></div>
              <strong><?php echo osc_count_regions(); ?></strong>
              <span><?php _e('Regions', 'beta'); ?></span>
            </div>

            <div class="bl bl4">
              <div class="img"><img src="<?php echo osc_current_web_theme_url('images/city.svg'); ?>" alt="<?php echo osc_esc_html(__('Cities', 'beta')); ?>"/></div>
              <strong><?php echo osc_count_cities(); ?></strong>
              <span><?php _e('Cities', 'beta'); ?></span>
            </div>

            <div class="bl bl5">
              <div class="img"><img src="<?php echo osc_current_web_theme_url('images/user.svg'); ?>" alt="<?php echo osc_esc_html(__('Users registred', 'beta')); ?>"/></div>
              <strong><?php echo osc_total_users(); ?></strong>
              <span><?php _e('Users registered', 'beta'); ?></span>
            </div>

          </div>
        </div>
      </div>
    </div>
  <?php } ?>


  <?php if(function_exists('fi_most_favorited_items') && bet_param('favorite_home') == 1) { ?>
    <div class="home-container favorite">
      <div class="inner">

        <!-- MOST FAVORITED -->

        <?php
          $limit = (osc_get_preference('maxLatestItems@home', 'osclass') > 0 ? osc_get_preference('maxLatestItems@home', 'osclass') : 24);


          // SEARCH ITEMS IN LIST AND CREATE ITEM ARRAY
          $aSearch = new Search();
          $aSearch->addField(sprintf('count(%st_item.pk_i_id) as count_id', DB_TABLE_PREFIX) );
          $aSearch->addConditions(sprintf("%st_favorite_list.list_id = %st_favorite_items.list_id", DB_TABLE_PREFIX, DB_TABLE_PREFIX));
          $aSearch->addConditions(sprintf("%st_favorite_items.item_id = %st_item.pk_i_id", DB_TABLE_PREFIX, DB_TABLE_PREFIX));
          $aSearch->addConditions(sprintf("%st_favorite_list.user_id <> coalesce(%st_item.fk_i_user_id, 0)", DB_TABLE_PREFIX, DB_TABLE_PREFIX));
          $aSearch->addTable(sprintf("%st_favorite_items", DB_TABLE_PREFIX));
          $aSearch->addTable(sprintf("%st_favorite_list", DB_TABLE_PREFIX));
          $aSearch->addGroupBy(DB_TABLE_PREFIX.'t_item.pk_i_id');

          $aSearch->order('count(*)', 'DESC');

          $aSearch->limit(0, $limit);
          $list_items = $aSearch->doSearch();


          // EXPORT FAVORITE ITEMS TO VARIABLE
          GLOBAL $fi_global_items2;
          $fi_global_items2 = View::newInstance()->_get('items'); 
          View::newInstance()->_exportVariableToView('items', $list_items);
        ?>

        <?php if(osc_count_items() <= 0) { ?><style>.home-container.favorite {display:none!important;}</style><?php } ?>

        <div id="favorite" class="products grid">
          <h2><?php _e('Most favorited listings by users', 'beta'); ?></h2>

          <div class="block">
            <div class="prod-wrap">
              <?php $c = 1; ?>
              <?php while( osc_has_items() ) { ?>
                <?php bet_draw_item($c); ?>
                 
                <?php $c++; ?>
              <?php } ?>

              <?php if(osc_count_items() <= 0) { ?>
                <div class="home-empty">
                  <img src="<?php echo osc_current_web_theme_url('images/home-empty.png'); ?>" />
                  <strong><?php _e('No listing favorited yet', 'beta'); ?></strong>
                </div>
              <?php } ?>
            </div>
          </div>
        </div>

        <?php
          GLOBAL $fi_global_items2; 
          View::newInstance()->_exportVariableToView('items', $fi_global_items2);  
        ?>
      </div>
    </div>
  <?php } ?>



  <?php if(function_exists('blg_param') && bet_param('blog_home') == 1) { ?>
    <div class="home-container blog">
      <div class="inner">

        <!-- BLOG WIDGET -->
        <div id="blog" class="products grid">
          <a class="h2" href="<?php echo blg_home_link(); ?>"><?php _e('Latest articles on blog', 'beta'); ?></a>

          <?php osc_run_hook('blg_widget'); ?>
        </div>
      </div>
    </div>
  <?php } ?>


  <?php if(function_exists('bpr_companies_block') && bet_param('company_home') == 1 && count($sellers = ModelBPR::newInstance()->getSellers(1, -1, -1, 8, '', '', '', 'NEW')) > 0) { ?>
    <div class="home-container business">
      <div class="inner">

        <!-- BUSINESS PROFILE WIDGET -->
        <div id="company" class="products grid">
          <a class="h2" href="<?php echo bpr_companies_url(); ?>"><?php _e('Our partners', 'beta'); ?></a>

          <?php echo bpr_companies_block(bet_param('company_home_count'), 'NEW'); ?>
        </div>
      </div>
    </div>
  <?php } ?>


  <?php if(bet_banner('home_bottom') !== false) { ?>
    <div class="home-container banner-box"><div class="inside"><?php echo bet_banner('home_bottom'); ?></div></div>
  <?php } ?>

  <?php osc_current_web_theme_path('footer.php') ; ?>
</body>
</html>	