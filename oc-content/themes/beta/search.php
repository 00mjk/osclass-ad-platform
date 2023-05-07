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

<body id="body-search">
<?php osc_current_web_theme_path('header.php') ; ?>

<?php 
  $params_spec = bet_search_params();
  $params_all = bet_search_params_all();

  $search_cat_id = osc_search_category_id();
  $search_cat_id = isset($search_cat_id[0]) ? $search_cat_id[0] : '';

  $category = Category::newInstance()->findByPrimaryKey($search_cat_id);

  $def_view = bet_param('def_view') == 0 ? 'grid' : 'list';
  $show = Params::getParam('sShowAs') == '' ? $def_view : Params::getParam('sShowAs');
  $show = ($show == 'gallery' ? 'grid' : $show);

  $def_cur = (bet_param('def_cur') <> '' ? bet_param('def_cur') : '$');

  $search_params_remove = bet_search_param_remove();

  $exclude_tr_con = explode(',', bet_param('post_extra_exclude'));

  // Get search hooks
  GLOBAL $search_hooks;
  ob_start(); 

  if(osc_search_category_id()) { 
    osc_run_hook('search_form', osc_search_category_id());
  } else { 
    osc_run_hook('search_form');
  }

  //$search_hooks = trim(ob_get_clean());
  //ob_end_flush();

  $search_hooks = trim(ob_get_contents());
  ob_end_clean();
?>


<div class="content">
  <div class="inside search">

    <div id="filter" class="filter">
      <div class="wrap">

        <form action="<?php echo osc_base_url(true); ?>" method="get" class="search-side-form nocsrf" id="search-form">
          <input type="hidden" name="page" value="search" />
          <input type="hidden" name="ajaxRun" value="" />
          <input type="hidden" name="sOrder" value="<?php echo osc_search_order(); ?>" />
          <input type="hidden" name="iOrderType" value="<?php $allowedTypesForSorting = Search::getAllowedTypesForSorting(); echo isset($allowedTypesForSorting[osc_search_order_type()]) ? $allowedTypesForSorting[osc_search_order_type()] : ''; ?>" />
          <input type="hidden" name="sCompany" class="sCompany" id="sCompany" value="<?php echo Params::getParam('sCompany');?>" />
          <input type="hidden" name="sCountry" id="sCountry" value="<?php echo Params::getParam('sCountry'); ?>"/>
          <input type="hidden" name="sRegion" id="sRegion" value="<?php echo Params::getParam('sRegion'); ?>"/>
          <input type="hidden" name="sCity" id="sCity" value="<?php echo Params::getParam('sCity'); ?>"/>
          <input type="hidden" name="iPage" id="iPage" value=""/>
          <input type="hidden" name="sShowAs" id="sShowAs" value="<?php echo Params::getParam('sShowAs'); ?>"/>
          <input type="hidden" name="showMore" id="showMore" value="<?php echo Params::getParam('showMore'); ?>"/>
          <input type="hidden" name="locUpdate"/>
          <input type="hidden" name="sCategory" value="<?php echo Params::getParam('sCategory'); ?>"/>
          <input type="hidden" name="userId" value="<?php echo Params::getParam('userId'); ?>"/>

          <div class="block">
            <div class="search-wrap">
 
              <!-- PATTERN AND LOCATION -->
              <div class="box">
                <h2><?php _e('Search', 'beta'); ?></h2>

                <div class="row">
                  <label class="isMobile"><?php _e('Keyword', 'beta'); ?></label>

                  <div class="input-box">
                    <input type="text" name="sPattern" placeholder="<?php _e('What are you looking for?', 'beta'); ?>" value="<?php echo Params::getParam('sPattern'); ?>" autocomplete="off"/>
                  </div>
                </div>


                <div class="row">
                  <label for="term2" class="isMobile"><span><?php _e('Location', 'beta'); ?></span></label>

                  <div id="location-picker" class="loc-picker picker-v2 ctr-<?php echo (bet_count_countries() == 1 ? 'one' : 'more'); ?>">

                    <div class="mini-box">
                      <input type="text" id="term2" class="term2" placeholder="<?php _e('City/Region', 'beta'); ?>" value="<?php echo bet_get_term('', Params::getParam('sCountry'), Params::getParam('sRegion'), Params::getParam('sCity')); ?>" autocomplete="off" readonly/>
                      <i class="fa fa-angle-down"></i>
                    </div>

                    <div class="shower-wrap">
                      <div class="shower" id="shower">
                        <?php echo bet_locbox_short(Params::getParam('sCountry'), Params::getParam('sRegion'), Params::getParam('sCity')); ?>
                        <a href="#" class="btn btn-primary mbBg loc-confirm isMobile"><i class="fa fa-check"></i></a>

                        <div class="button-wrap isTablet isDesktop">
                          <a href="#" class="btn btn-primary mbBg loc-confirm"><?php _e('Ok', 'beta'); ?></a>
                        </div>
                      </div>
                    </div>

                    <div class="loader"></div>
                  </div>
                </div>


                <div class="row isMobile">
                  <label for="term3"><span><?php _e('Category', 'beta'); ?></span></label>

                  <div id="category-picker" class="cat-picker picker-v2">
                    <div class="mini-box">
                      <input type="text" class="term3" id="term3" placeholder="<?php _e('Category', 'beta'); ?>"  autocomplete="off" value="<?php echo @$category['s_name']; ?>" readonly/>
                      <i class="fa fa-angle-down"></i>
                    </div>

                    <div class="shower-wrap">
                      <div class="shower" id="shower">
                        <?php echo bet_catbox_short($search_cat_id); ?>
                        <a href="#" class="btn btn-primary mbBg cat-confirm isMobile"><i class="fa fa-check"></i></a>

                        <div class="button-wrap isTablet isDesktop">
                          <a href="#" class="btn btn-primary mbBg cat-confirm"><?php _e('Continue', 'beta'); ?></a>
                        </div>
                      </div>
                    </div>

                    <div class="loader"></div>
                  </div>
                </div>
              </div>





              <!-- CATEGORIES -->
              <div class="box isDesktop isTablet">
                <div class="side-cat">
                  <?php
                    $search_params = $params_spec;
                    $only_root = false;

                    if($search_cat_id <= 0) {
                      $parent = false;
                      $categories = Category::newInstance()->findRootCategoriesEnabled();
                      $children = false;
                    } else {
                      $parent = Category::newInstance()->findByPrimaryKey($search_cat_id);
                      $categories = Category::newInstance()->findSubcategoriesEnabled($search_cat_id);

                      if(count($categories) <= 0) {
                        if($parent['fk_i_parent_id'] > 0) {
                          $parent = Category::newInstance()->findByPrimaryKey($parent['fk_i_parent_id']);
                          $categories = Category::newInstance()->findSubcategoriesEnabled($parent['pk_i_id']);

                        } else {  // only parent categories exists
                          $parent = false;
                          $categories = Category::newInstance()->findRootCategoriesEnabled();
                          $only_root = true;
                        }
                      }
                    }          
                  ?>


                  <h2>
                    <span><?php _e('Categories', 'beta'); ?></span>

                    <?php if($search_cat_id > 0 && !$only_root) { ?>
                      <?php $search_params['sCategory'] = @$parent['fk_i_parent_id']; ?>
                      <a href="<?php echo osc_search_url($search_params); ?>" class="gotop" data-name="sCategory" data-val="<?php echo $parent['fk_i_parent_id']; ?>"><i class="fa fa-level-up"></i></a>
                    <?php } ?>
                  </h2>

                  <div class="inside link-check-box<?php if($search_cat_id <= 0 || $only_root) { ?> root<?php } ?>">
                    <?php if($parent) { ?>
                      <?php $search_params['sCategory'] = $parent['pk_i_id']; ?>
                      <a href="<?php echo osc_search_url($search_params); ?>" class="parent active" data-name="sCategory" data-val="<?php echo $parent['pk_i_id']; ?>">
                        <span class="name"><?php echo $parent['s_name']; ?></span><em>(<?php echo ($parent['i_num_items'] == '' ? 0 : $parent['i_num_items']); ?>)</em>
                      </a>
                    <?php } ?>

                    <?php foreach($categories as $c) { ?>
                      <?php $search_params['sCategory'] = $c['pk_i_id']; ?>

                      <a href="<?php echo osc_search_url($search_params); ?>" class="child<?php if($c['pk_i_id'] == $search_cat_id) { ?> active<?php } ?>" data-name="sCategory" data-val="<?php echo $c['pk_i_id']; ?>">
                        <span class="name"><?php echo $c['s_name']; ?></span><em>(<?php echo ($c['i_num_items'] == '' ? 0 : $c['i_num_items']); ?>)</em>
                      </a>

                    <?php } ?>

                  </div>
                </div> 
              </div>








              <!-- PRICE -->
              <?php if( bet_check_category_price($search_cat_id) ) { ?>
                <div class="box price-box">
                  <h2><?php _e('Price', 'beta'); ?></h2>

                  <div class="row price">
                    <div class="input-box">
                      <input type="number" class="priceMin" name="sPriceMin" value="<?php echo osc_esc_html(Params::getParam('sPriceMin')); ?>" size="6" maxlength="6" placeholder="<?php echo osc_esc_js(__('Min', 'beta')); ?>"/>
                      <span><?php echo $def_cur; ?></span>
                    </div>

                    <div class="input-box">
                      <input type="number" class="priceMax" name="sPriceMax" value="<?php echo osc_esc_html(Params::getParam('sPriceMax')); ?>" size="6" maxlength="6" placeholder="<?php echo osc_esc_js(__('Max', 'beta')); ?>"/>
                      <span><?php echo $def_cur; ?></span>
                    </div>
                  </div>
                </div>
              <?php } ?>

 
              <!-- CONDITION --> 
              <?php if(@!in_array($search_cat_id, $exclude_tr_con)) { ?>
                <div class="box">
                  <h2><?php _e('Condition', 'beta'); ?></h2>

                  <div class="row">
                    <?php echo bet_simple_condition_list(); ?>
                  </div>
                </div>
              <?php } ?>

 
              <!-- TRANSACTION --> 
              <?php if(@!in_array($search_cat_id, $exclude_tr_con)) { ?>
                <div class="box">
                  <h2><?php _e('Transaction', 'beta'); ?></h2>

                  <div class="row">
                    <?php echo bet_simple_transaction_list(); ?>
                  </div>
                </div>
              <?php } ?>


              <!-- PERIOD--> 
              <div class="box">
                <h2><?php _e('Period', 'beta'); ?></h2>

                <div class="row">
                  <?php echo bet_simple_period_list(); ?>
                </div>
              </div>


              <?php if($search_hooks <> '') { ?>
                <div class="box sidehook">
                  <h2><?php _e('Additional parameters', 'beta'); ?></h2>

                  <div class="sidebar-hooks">
                    <?php echo $search_hooks; ?>
                  </div>
                </div>
              <?php } ?>
            </div>
          </div>

          <div class="button-wrap">
            <button type="submit" class="btn mbBg init-search" id="search-button"><?php _e('Search', 'beta') ; ?></button>
          </div>
        </form>
      </div>

      <?php echo bet_banner('search_sidebar'); ?>
    </div>


    <div id="main">
      <div class="titles-top">
        <h1>
          <?php 
            if(osc_search_total_items() > 0) { 
              echo sprintf(__('Showing %s - %s of %s results', 'beta'), osc_default_results_per_page_at_search()*(osc_search_page())+1, osc_default_results_per_page_at_search()*(osc_search_page()+1)+osc_count_items()-osc_default_results_per_page_at_search(), osc_search_total_items());
            } else {
              echo __('No listings found', 'beta');
            }
          ?>
        </h1>
      </div>

      <?php
        $p1 = $params_all; $p1['sCompany'] = null;
        $p2 = $params_all; $p2['sCompany'] = 0;
        $p3 = $params_all; $p3['sCompany'] = 1;

        $us_type = Params::getParam('sCompany');
        
      ?>


      <!-- SEARCH FILTERS - SORT / COMPANY / VIEW -->
      <div id="search-sort" class="">
        <div class="user-type">
          <a class="all<?php if(Params::getParam('sCompany') === '' || Params::getParam('sCompany') === null) { ?> active<?php } ?>" href="<?php echo osc_search_url($p1); ?>"><?php _e('All listings', 'beta'); ?></a>
          <a class="personal<?php if(Params::getParam('sCompany') === '0') { ?> active<?php } ?>" href="<?php echo osc_search_url($p2); ?>"><?php _e('Personal', 'beta'); ?></a>
          <a class="company<?php if(Params::getParam('sCompany') === '1') { ?> active<?php } ?>" href="<?php echo osc_search_url($p3); ?>"><?php _e('Company', 'beta'); ?></a>
        </div>

        <?php if(osc_count_items() > 0) { ?>
          <div class="list-grid">
            <?php $show = Params::getParam('sShowAs') == '' ? $def_view : Params::getParam('sShowAs'); ?>
            <a href="#" title="<?php echo osc_esc_html(__('List view', 'beta')); ?>" class="lg<?php echo ($show == 'list' ? ' active' : ''); ?>" data-view="list"><i class="fa fa-list-ul"></i></a>
            <a href="#" title="<?php echo osc_esc_html(__('Grid view', 'beta')); ?>" class="lg<?php echo ($show == 'grid' ? ' active' : ''); ?>" data-view="grid"><i class="fa fa-th-large"></i></a>
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
                      <span class=""><?php echo $label; ?></span>
                    </span>
                  <?php } ?>
                <?php } ?>
              </div>

              <div id="sort-wrap">
                <div class="sort-content">
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
        <?php } ?>
      </div>

      <div class="sub-line">

        <!-- SUBSCRIBE TO SEARCH -->
        <?php osc_alert_form(); ?>


        <?php if( osc_images_enabled_at_items() ) { ?>
          <div class="img-check">
            <div class="link-check-box">
              <?php 
                $img_params = $params_all; 
                $img_params['bPic'] = (osc_search_has_pic() ? 0 : 1);
              ?>

              <a href=<?php echo osc_search_url($img_params); ?> class="<?php echo (osc_search_has_pic() ? 'active' : ''); ?>">
                <span class="isDesktop isTablet"><?php _e('Only items with picture', 'beta'); ?></span>
                <span class="isMobile"><?php _e('With picture', 'beta'); ?></span>
              </a>
            </div>
          </div>
        <?php } ?>

      </div>



      <div id="search-items">     
        <!-- REMOVE FILTER SECTION -->
        <?php  
          // count usable params
          $filter_check = 0;
          if(count($search_params_remove) > 0) {
            foreach($search_params_remove as $n => $v) { 
              if($v['name'] <> '' && $v['title'] <> '') { 
                $filter_check++;
              }
            }
          }
        ?>

        <?php if($filter_check > 0) { ?>
          <div class="filter-remove">
            <?php foreach($search_params_remove as $n => $v) { ?>
              <?php if($v['name'] <> '' && $v['title'] <> '') { ?>
                <?php
                  $rem_param = $params_all;
                  unset($rem_param[$n]);
                ?>

                <a href="<?php echo osc_search_url($rem_param); ?>" data-param="<?php echo $v['param']; ?>"><?php echo $v['title'] . ': ' . $v['name']; ?></a>
              <?php } ?>
            <?php } ?>

            <a class="bold" href="<?php echo osc_search_url(array('page' => 'search')); ?>"><?php _e('Remove all', 'beta'); ?></a>
          </div>
        <?php } ?>
  
             
        <?php if(osc_count_items() == 0) { ?>
          <div class="list-empty round3" >
            <span class="titles"><?php _e('We could not find any results for your search...', 'beta'); ?></span>

            <div class="tips">
              <div class="row"><?php _e('Following tips might help you to get better results', 'beta'); ?></div>
              <div class="row"><i class="fa fa-circle"></i><?php _e('Use more general keywords', 'beta'); ?></div>
              <div class="row"><i class="fa fa-circle"></i><?php _e('Check spelling of position', 'beta'); ?></div>
              <div class="row"><i class="fa fa-circle"></i><?php _e('Reduce filters, use less of them', 'beta'); ?></div>
              <div class="row last"><a href="<?php echo osc_search_url(array('page' => 'search'));?>"><?php _e('Reset filter', 'beta'); ?></a></div>
            </div>
          </div>

        <?php } else { ?>

          <div class="products <?php echo $show; ?>">
            <?php require('search_gallery.php') ; ?>
          </div>
        <?php } ?>

        <div class="paginate"><?php echo bet_fix_arrow(osc_search_pagination()); ?></div>

        <?php echo bet_banner('search_bottom'); ?>
      </div>
    </div>

  </div>


  <a href="#" class="mbBg filter-button mobile-filter isMobile">
    <i class="fa fa-filter"></i>
  </a>


</div>

<?php osc_current_web_theme_path('footer.php') ; ?>

</body>
</html>