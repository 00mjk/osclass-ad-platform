<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="<?php echo str_replace('_', '-', osc_current_user_locale()); ?>">
<head>
  <?php osc_current_web_theme_path('head.php') ; ?>
  <?php if( osc_count_items() == 0 || Params::getParam('iPage') > 0 || stripos($_SERVER['REQUEST_URI'], 'search') )  { ?>
    <meta name="robots" content="noindex, nofollow" />
    <meta name="googlebot" content="noindex, nofollow" />
  <?php } else { ?>
    <meta name="robots" content="index, follow" />
    <meta name="googlebot" content="index, follow" />
  <?php } ?>
</head>

<?php 
  if(function_exists('radius_map_items')) { 
    $radius = 'radius';
  } else {
    $radius = '';
  }

  if(Params::getParam('iExtra') <> 1) {
    $side = 'side-hide';
  } else {
    $side = 'side-hide open';
  }
?>


<body id="body-search" class="<?php echo $radius; ?>">
     <div id="warning-box">
                <div class="inside">
                    <div class="icon"><img
                            src="<?php echo osc_base_url(); ?>oc-content/themes/stela/images/warning.png" /></div>
                    <div class="top"><?php echo ('Atentionare'); ?></div>
                    <div class="sub"><?php echo ('Aceasta categorie este pentru adulti!'); ?></div>
                    <div class="action">
                        <div class="box">
                            <a href="#" id='submit'>
                                <span>Am 18 ani</span>
                                <strong>INTRA</strong> </a>
                        </div>
                    </div>
                </div>
            </div>
  </div>
  </div>
<?php osc_current_web_theme_path('header.php') ; ?>

<?php
  $search_cat_id = osc_search_category_id();
  $search_cat_id = isset($search_cat_id[0]) ? $search_cat_id[0] : '';
  $search_category = Params::getParam('sCategory');

  $def_cur = osc_get_preference('def_cur', 'stela_theme');

  $max = stela_max_price($search_cat_id, Params::getParam('sCountry'), Params::getParam('sRegion'), Params::getParam('sCity'));
  $max_price = ceil($max['max_price']/50)*50;
  $max_currency = $max['max_currency'];

?>
<script>
  cat_id = '<?php echo $search_category; ?>';
      cat = ['anunturi-matrimoniale'];
if (cat.includes(cat_id)){
 $('#warning-box').fadeIn();
}else{
  console.log(cat_id)
}

$("#submit").click(function () {
        $("#warning-box").hide("slow");
    });
    </script>
<div class="content list">
  <div class="content-wrap">

    <!-- SEARCH SIDEBAR -->
    <div id="sidebar" class="noselect">
      <div id="sidebar-search" class="round3">
        <div class="form-wrap">
          <form action="<?php echo osc_base_url(true); ?>" method="get" onsubmit="" class="search-side-form nocsrf">
            <input type="hidden" name="page" value="search" />
            <input type="hidden" name="ajaxRun" value="" />
            <input type="hidden" name="cookieAction" id="cookieAction" value="" />
            <input type="hidden" name="sOrder" value="<?php echo osc_search_order(); ?>" />
            <input type="hidden" name="iOrderType" value="<?php $allowedTypesForSorting = Search::getAllowedTypesForSorting() ; echo isset($allowedTypesForSorting[osc_search_order_type()]) ? $allowedTypesForSorting[osc_search_order_type()] : ''; ?>" />
            <input type="hidden" name="sCompany" class="sCompany" id="sCompany" value="<?php echo Params::getParam('sCompany');?>" />
            <input type="hidden" name="sCountry" class="sCountry" value="<?php echo Params::getParam('sCountry'); ?>"/>
            <input type="hidden" name="sRegion" class="sRegion" value="<?php echo Params::getParam('sRegion'); ?>"/>
            <input type="hidden" name="sCity" class="sCity" value="<?php echo Params::getParam('sCity'); ?>"/>
            <input type="hidden" name="iPage" id="iPage" value="<?php echo Params::getParam('iPage'); ?>"/>
            <input type="hidden" name="sShowAs" id="sShowAs" value="<?php echo Params::getParam('sShowAs'); ?>"/>
            <input type="hidden" name="iExtra" id="iExtra" value="<?php echo Params::getParam('iExtra'); ?>"/>

            <?php foreach(osc_search_user() as $userId) { ?>
              <input type="hidden" name="sUser[]" value="<?php echo $userId; ?>" />
            <?php } ?>


            <div class="wrap">
              <div class="search-wrap">
                <fieldset class="box primary">
                  <div class="row">
                    <h4><?php _e('Keyword', 'stela') ; ?></h4>                            
                    <div class="input-box">
                      <input type="text" name="sPattern" id="query" value="<?php echo osc_esc_html(osc_search_pattern()); ?>" placeholder="<?php echo osc_esc_html(__('Keyword', 'stela')); ?>" />
                    </div>
                  </div>


                  <div class="row">
                    <h4><?php _e('Category', 'stela') ; ?></h4>                            
                    <div class="input-box">
                      <?php echo stela_simple_category(); ?>
                    </div>
                  </div>


                  <div class="row">
                    <h4><?php _e('Location', 'stela') ; ?></h4>                            
                    <div class="box">
                      <div id="location-picker">
                        <input type="text" name="term" id="term" class="term" placeholder="<?php _e('Location', 'stela'); ?>" value="<?php echo stela_get_term(Params::getParam('term'), Params::getParam('sCountry'), Params::getParam('sRegion'), Params::getParam('sCity')); ?>" autocomplete="off" title="<?php echo osc_esc_js(__('City, Region or Country', 'stela')); ?>"/>
                        <div class="shower-wrap">
                          <div class="shower" id="shower">
                            <div class="option service min-char"><?php _e('Type country, region or city', 'stela'); ?></div>
                          </div>
                        </div>

                        <div class="loader"></div>
                      </div>

                    </div>
                  </div>


                  <div class="button-wrap tablet not767">
                    <button type="submit" class="btn btn-secondary" id="search-button">
                      <span><?php _e('Search', 'stela'); ?></span>
                      <i class="fa <?php if(Params::getParam('iExtra') == 1) { ?>fa-angle-up<?php } else { ?>fa-angle-down<?php } ?> more-filters has-tooltip-right no-loader" title="<?php echo osc_esc_js(__('Show more filters', 'stela')); ?>"></i>
                    </button>
                  </div>
                </fieldset>

                <div class="button-wrap">
                  <button type="submit" class="btn btn-secondary" id="search-button">
                    <span><?php _e('Search', 'stela'); ?></span>
                    <i class="fa <?php if(Params::getParam('iExtra') == 1) { ?>fa-angle-up<?php } else { ?>fa-angle-down<?php } ?> more-filters has-tooltip-right no-loader" title="<?php echo osc_esc_js(__('Show more filters', 'stela')); ?>"></i>
                  </button>
                </div>
<?php if(function_exists('osm_radius_select')) { echo osm_radius_select(); } ?>

        <div class="sort-it">
          <div class="sort-title">
            <div class="title-keep noselect">
              <?php $orders = osc_list_orders(); ?>
              <?php $current_order = osc_search_order(); ?>
              <?php foreach($orders as $label => $params) { ?>
                <?php $orderType = ($params['iOrderType'] == 'asc') ? '0' : '1'; ?>
                <?php if(osc_search_order() == $params['sOrder'] && osc_search_order_type() == $orderType) { ?>
                  <span>
                    <i class="fa fa-angle-down"></i> <span><?php echo $label; ?></span>
                  </span>
                <?php } ?>
              <?php } ?>
            </div>

            <div id="sort-wrap">
              <div class="sort-content">
                <div class="info"><?php _e('Select sorting', 'stela'); ?></div>
                <?php $i = 0; ?>
                <?php foreach($orders as $label => $params) { ?>
                  <?php $orderType = ($params['iOrderType'] == 'asc') ? '0' : '1'; ?>
                  <?php if(osc_search_order() == $params['sOrder'] && osc_search_order_type() == $orderType) { ?>
                    <a class="current" href="<?php echo osc_update_search_url($params) ; ?>"><span><?php echo $label; ?></span></a>
                  <?php } else { ?>
                    <a href="<?php echo osc_update_search_url($params) ; ?>"><span><?php echo $label; ?></span></a>
                  <?php } ?>
                  <?php $i++; ?>
                <?php } ?>
              </div>
            </div>
          </div>
        </div>

                <fieldset class="box secondary <?php echo $side; ?>">                  
                  <?php if( stela_check_category_price($search_cat_id) ) { ?>
                    <div class="row price">
                      <h5>  Pret:</h5>
                    
                      <div class="input-box">
                        <input type="number" class="priceMin" name="sPriceMin" value="<?php echo osc_esc_html(Params::getParam('sPriceMin')); ?>" size="8" maxlength="8" placeholder="<?php echo osc_esc_js(__('Min', 'stela')); ?>"/>
                       
                      </div>

                      <div class="input-box">
                        <input type="number" class="priceMax" name="sPriceMax" value="<?php echo osc_esc_html(Params::getParam('sPriceMax')); ?>" size="6" maxlength="6" placeholder="<?php echo osc_esc_js(__('Max', 'stela')); ?>"/>                      
                      </div>
                    </div>
                  <?php } ?>
                </fieldset>

                <div class="button-wrap <?php echo $side; ?>">              
                  <a href="<?php echo osc_search_url(array('page' => 'search', 'clearCookieAll' => 'done'));?>" class="clear-search <?php echo $side; ?>"><b><?php _e('Reset filter', 'stela'); ?></b></a>
                </div>

                <div class="sidebar-hooks <?php echo $side; ?>">
                  <?php 
                    GLOBAL $search_hooks;
                    ob_start(); // SAVE HTML
                    if(osc_search_category_id()) { 
                      osc_run_hook('search_form', osc_search_category_id());
                    } else { 
                      osc_run_hook('search_form');
                    }
                    //echo $search_hooks;
                    $search_hooks = ob_get_contents();   // CAPTURE HTML OF SIDEBAR HOOKS FOR FOOTER (MOBILE VIEW)
                  ?>
                </div>
                <button type="submit" class="btn btn-secondary is767" id="search-button-mobile"><?php _e('Search', 'stela'); ?></button>
              </div>
            </div>
          </form>
        </div>

        <?php osc_alert_form(); ?>
      </div>

      <div class="clear"></div>
      <?php echo stela_banner('search_sidebar'); ?>
    </div>


    <div class="search-title">

      <!-- TOP SEARCH TITLE -->
      <h2 class="h2-search">
        <div class="text"><?php echo osc_search_total_items(); ?> <?php echo (osc_search_total_items() == 1 ? __('result', 'stela') : __('results', 'stela')); ?></div>

        <div class="list-grid">
          <?php $def_view = osc_get_preference('def_view', 'stela_theme') == 0 ? 'gallery' : 'list'; ?>
          <?php $show = Params::getParam('sShowAs') == '' ? $def_view : Params::getParam('sShowAs'); ?>
          <a href="#" title="<?php echo osc_esc_html(__('Switch to list view', 'stela')); ?>" <?php echo ($show == 'list' ? 'class="active"' : ''); ?> data-view="list"><i class="fa fa-list-ul"></i></a>
          <a href="#" title="<?php echo osc_esc_html(__('Switch to grid view', 'stela')); ?>" <?php echo ($show == 'gallery' ? 'class="active"' : ''); ?> data-view="gallery"><i class="fa fa-th-large"></i></a>
        </div>

        <div class="sort-it">
          <div class="sort-title">
            <div class="title-keep noselect">
              <?php $orders = osc_list_orders(); ?>
              <?php $current_order = osc_search_order(); ?>
              <?php foreach($orders as $label => $params) { ?>
                <?php $orderType = ($params['iOrderType'] == 'asc') ? '0' : '1'; ?>
                <?php if(osc_search_order() == $params['sOrder'] && osc_search_order_type() == $orderType) { ?>
                  <span>
                    <i class="fa fa-sort"></i> <span><?php echo $label; ?></span>
                  </span>
                <?php } ?>
              <?php } ?>
            </div>

            <div id="sort-wrap">
              <div class="sort-content">
                <div class="info"><?php _e('Select sorting', 'stela'); ?></div>

                <?php $i = 0; ?>
                <?php foreach($orders as $label => $params) { ?>
                  <?php $orderType = ($params['iOrderType'] == 'asc') ? '0' : '1'; ?>
                  <?php if(osc_search_order() == $params['sOrder'] && osc_search_order_type() == $orderType) { ?>
                    <a class="current" href="<?php echo osc_update_search_url($params) ; ?>"><span><?php echo $label; ?></span></a>
                  <?php } else { ?>
                    <a href="<?php echo osc_update_search_url($params) ; ?>"><span><?php echo $label; ?></span></a>
                  <?php } ?>
                  <?php $i++; ?>
                <?php } ?>
              </div>
            </div>
          </div>
        </div>
      </h2>

      <a class="btn btn-secondary round3 tr1 search-mobile-filters is767" href="#"><?php _e('Filters', 'stela'); ?></a>
    </div>


    <div id="main" class="search">

      <!-- HELPERS FORS AJAX SEARCH -->
      <div id="ajax-help" style="display:none;">
        <input type="hidden" name="ajax-last-page-id" value="<?php echo ceil( osc_search_total_items() / osc_default_results_per_page_at_search() ); ?>" />

      </div>


      <div id="search-items" data-loading="<?php _e('Loading listings...', 'stela'); ?>">                    
        <?php if(osc_count_items() == 0) { ?>
          <div class="list-empty round3" >
            <div>
              <span class="top"><?php _e('Whooops', 'stela'); ?></span>
              <span class="bot">
                <?php _e('No results found for your search.', 'stela'); ?>
                <a href="<?php echo osc_search_url(array('page' => 'search'));?>" class="clear-search clear-cookie "><?php _e('Reset filter', 'stela'); ?></a>.
              </span>
            </div>
          </div>
        <?php } else { ?>
          <?php echo stela_banner('search_top'); ?>

          <div class="white <?php echo $show; ?>">
            <?php require('search_gallery.php') ; ?>
          </div>
        <?php } ?>
      <?php echo infinite(); ?>
        <div class="paginate">
          <?php echo osc_search_pagination(); ?>
        </div>

        <?php echo stela_banner('search_bottom'); ?>
      </div>
    </div>
    
  


  <!-- MAP -->
  <?php if(function_exists('radius_map_items')) { radius_map_items(); } ?>
</div>

<?php osc_current_web_theme_path('footer.php') ; ?>

</body>
</html>