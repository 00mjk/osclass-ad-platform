<?php
define('STELA_THEME_VERSION', '1.0.11');


// REMOVE PLUGINS ITEM_DETAIL DATA
function stela_remove_item_detail_hook() {
  osc_remove_hook('item_detail', 'mo_hook_button');
  osc_remove_hook('item_detail', 'ur_hook_add_rating_link');
  osc_remove_hook('item_detail', 'ur_hook_show_rating_link');
  osc_remove_hook('item_detail', 'ur_hook_show_rating_stars');
  osc_remove_hook('item_detail', 'im_contact_button');
}

osc_apply_filter('pre_item_add_error', $flash_error, $aItem);

osc_add_hook('init', 'stela_remove_item_detail_hook');

function infinite() {
    require_once osc_base_path() . 'oc-content/themes/stela/infinite-search.php';
  
}
// DISABLE ERROR404 ON SEARCH PAGE WHEN NO ITEMS FOUND
function stela_disable_404() {
  if(osc_is_search_page() && osc_count_items() <= 0) {
    if(http_response_code() == 404) {
      http_response_code(200);
    }
  }
}

osc_add_hook('header', 'stela_disable_404');


function stela_theme_info() {
  return array(
    'name'    => 'OSClass Stela Premium Theme',
    'version'   => '1.1.10',
    'description' => 'Most powerful theme for classifieds',
    'author_name' => 'MB Themes',
    'author_url'  => 'http://mb-themes.com',
    'support_uri'  => 'http://forums.mb-themes.com/stela-osclass-responsive-theme/',
    'locations'   => array('header', 'footer')
  );
}


// GET TRANSACTION NAME
function stela_transaction_name($id = '') {
  $transaction = false;

  if ($id == '') {
    return false;
  } else if ($id == 1) {
    $transaction = __('Sell', 'stela');
  } else if ($id == 2) {
    $transaction = __('Buy', 'stela');
  } else if ($id == 3) {
    $transaction = __('Rent', 'stela');
  } else if ($id == 4) {
    $transaction = __('Vand-Schimb', 'stela');
  }

  return $transaction;
}

// GET CONDITION NAME
function stela_condition_name($id = '') {
  $condition = false;

  if ($id == '') {
    return false;
  } else if ($id == 1) {
    $condition = __('New', 'stela');
  } else if ($id == 2) {
    $condition = __('Used', 'stela');
  }

  return $condition;
}


// NOTIFICATIONS IN HEADER
function stela_notifications() {
  $notif = '';

  $alerts = count(Alerts::newInstance()->findByUser(osc_logged_user_id()));
  if($alerts > 0) {
    $notif .= '<a href="' . osc_user_alerts_url() . '" target="_top">' . sprintf(__('You have %d subscriptions', 'stela'), $alerts) . '</a>';
  }

  if(function_exists('im_messages')) {
    $messages = ModelIM::newInstance()->countMessagesByUserId( osc_logged_user_id() );
    $messages = $count['i_count'];

    if($messages > 0) {
      $notif .= '<a href="' . osc_route_url('im-threads') . '" target="_top">' . sprintf(__('You have %d new messages', 'stela'), $messages) . '</a>';
    }
  }

  if(function_exists('osp_cart_add')) {
    $cart = ModelOSP::newInstance()->getCart(osc_logged_user_id());
    $cart = count(array_filter(explode('|', $cart)));

    if($cart > 0) {
      $notif .= '<a href="' . osc_route_url('osp-cart') . '" target="_top">' . sprintf(__('You have %d item(s) in your cart', 'stela'), $cart) . '</a>';
    }
  }

  if(function_exists('fi_list_items')) {
    $list = ModelFI::newInstance()->getCurrentFavoriteListByUserId(osc_logged_user_id());
    $favorite = 0;

    if(isset($list['list_id'])) {
      $iSearch = new Search();
      $iSearch->addConditions(sprintf("%st_favorite_items.list_id = %d", DB_TABLE_PREFIX, $list['list_id']));
      $iSearch->addConditions(sprintf("%st_favorite_items.item_id = %st_item.pk_i_id", DB_TABLE_PREFIX, DB_TABLE_PREFIX));
      $iSearch->addTable(sprintf("%st_favorite_items", DB_TABLE_PREFIX));
      $favorite = $iSearch->doSearch();

      $favorite = count($favorite);
    }

    if($favorite > 0) {
      $notif .= '<a href="' . osc_route_url('favorite-lists', array('list-id' => '0', 'current-update' => '0', 'notification-update' => '0', 'list-remove' => '0', 'iPage' => '0')) . '" target="_top">' . sprintf(__('You have %d saved item(s)', 'stela'), $favorite) . '</a>';
    }
  }

  if(function_exists('mo_show_offer_link')) {
    $your_items = ModelMO::newInstance()->getItemsWithOffersByUserId(osc_logged_user_id());
    $my_offers = ModelMO::newInstance()->getYourOffersByUserId(osc_logged_user_id());

    if(count($your_items) > 0) {
      $notif .= '<a href="' . osc_route_url('mo-offers') . '" target="_top">' . sprintf(__('You have %d offer(s) on your items', 'stela'), count($your_items)) . '</a>';
    }

    if(count($my_offers) > 0) {
      $notif .= '<a href="' . osc_route_url('mo-offers') . '" target="_top">' . sprintf(__('You have placed %d offer(s)', 'stela'), count($my_offers)) . '</a>';
    }
  }


  echo $notif;
}

osc_add_hook('theme_notifications', 'stela_notifications');


// CHECK IF NOTIFICATION HOOK IS EMPTY OR NOT
function stela_check_notifications() {
  ob_start(); 
  osc_run_hook('theme_notifications');
  $output = ob_get_contents();
  ob_end_clean();

  if($output <> '') {
    return true;
  }

  return false;
}


// CHECK IF ITEM_DETAIL HOOK IS EMPTY OR NOT
function stela_item_detail() {
  ob_start(); 
  osc_run_hook('item_detail',  osc_item());
  $output = ob_get_contents();
  ob_end_clean();

  if($output <> '') {
    return $output;
  }

  return false;
}


// GET PROPER PROFILE IMAGE
function stela_profile_picture($is_mobile = false) {
  if(function_exists('profile_picture_show')) {
    if(osc_item_user_id() > 0 || osc_premium_user_id() > 0) {
      return profile_picture_show(null, 'item', 200, null, (osc_item_user_id() > 0 ? osc_item_user_id() : osc_premium_user_id()));
    } 
  }

  if(!is_mobile) {
    return '<img src="' . osc_current_web_theme_url('images/profile-default.png') . '"/>';
  } else {
    return '<img src="' . osc_current_web_theme_url('images/no-user-mobile.png') . '"/>';
  }
}

// CHECK IF PRICE ENABLED ON CATEGORY
function stela_check_category_price($id) {
  if(!osc_price_enabled_at_items()) {
    return false;
  } else if(!isset($id) || $id == '' || $id <= 0) {
    return true;
  } else {
    $category = Category::newInstance()->findByPrimaryKey($id);
    return ($category['b_price_enabled'] == 1 ? true : false);
  }
}


// RTL LANGUAGE SUPPORT
function stela_is_rtl() {
  $current_lang = strtolower(osc_current_user_locale());

  if(in_array($current_lang, stela_rtl_languages())) {
    return true;
  } else {
    return false;
  }
}


function stela_rtl_languages() {
  $langs = array('ar_DZ','ar_BH','ar_EG','ar_IQ','ar_JO','ar_KW','ar_LY','ar_MA','ar_OM','ar_SA','ar_SY','ar_TN','ar_AE','ar_YE','ar_TD','ar_CO','ar_DJ','ar_ER','ar_MR','ar_SD');
  return array_map('strtolower', $langs);
}


// FLAT CATEGORIES CONTENT (Publish)
function stela_flat_categories() {
  return '<div id="flat-cat-fancy" style="display:none;overflow:hidden;">' . stela_category_loop() . '</div>';
}


// SMART DATE
function stela_smart_date( $time ) {
  $time_diff = round(abs(time() - strtotime( $time )) / 60);
  $time_diff_h = floor($time_diff/60);
  $time_diff_d = floor($time_diff/1440);
  $time_diff_w = floor($time_diff/10080);
  $time_diff_m = floor($time_diff/43200);
  $time_diff_y = floor($time_diff/518400);


  if($time_diff < 2) {
    $time_diff_name = __('minute ago', 'stela');
  } else if ($time_diff < 60) {
    $time_diff_name = sprintf(__('%d minutes ago', 'stela'), $time_diff);
  } else if ($time_diff < 120) {
    $time_diff_name = sprintf(__('%d hour ago', 'stela'), $time_diff_h);
  } else if ($time_diff < 1440) {
    $time_diff_name = sprintf(__('%d hours ago', 'stela'), $time_diff_h);
  } else if ($time_diff < 2880) {
    $time_diff_name = sprintf(__('%d day ago', 'stela'), $time_diff_d);
  } else if ($time_diff < 10080) {
    $time_diff_name = sprintf(__('%d days ago', 'stela'), $time_diff_d);
  } else if ($time_diff < 20160) {
    $time_diff_name = sprintf(__('%d week ago', 'stela'), $time_diff_w);
  } else if ($time_diff < 43200) {
    $time_diff_name = sprintf(__('%d weeks ago', 'stela'), $time_diff_w);
  } else if ($time_diff < 86400) {
    $time_diff_name = sprintf(__('%d month ago', 'stela'), $time_diff_m);
  } else if ($time_diff < 518400) {
    $time_diff_name = sprintf(__('%d months ago', 'stela'), $time_diff_m);
  } else if ($time_diff < 1036800) {
    $time_diff_name = sprintf(__('%d year ago', 'stela'), $time_diff_y);
  } else {
    $time_diff_name = sprintf(__('%d years ago', 'stela'), $time_diff_y);
  }

  return $time_diff_name;
}



// CHECK IF ITEM MARKED AS SOLD-UNSOLD
function stela_check_sold(){
  $conn = DBConnectionClass::newInstance();
  $data = $conn->getOsclassDb();
  $comm = new DBCommandClass($data);

  $status = Params::getParam('markSold');
  $id = Params::getParam('itemId');
  $secret = Params::getParam('secret');
  $item_type = Params::getParam('itemType');

  if($status <> '' && $id <> '' && $id > 0) {
    $item = Item::newInstance()->findByPrimaryKey($id);

    if( $secret == $item['s_secret'] ) {
      //Item::newInstance()->dao->update(DB_TABLE_PREFIX.'t_item_stela', array('i_sold' => $status), array('fk_i_item_id' => $item['pk_i_id']));
      $comm->update(DB_TABLE_PREFIX.'t_item_stela', array('i_sold' => $status), array('fk_i_item_id' => $item['pk_i_id']));
 
      if (osc_rewrite_enabled()) {
        $item_type_url = '?itemType=' . $item_type;
      } else {
        $item_type_url = '&itemType=' . $item_type;
      }

      header('Location: ' . osc_user_list_items_url() . $item_type_url);
    }
  }
}

osc_add_hook('header', 'stela_check_sold');



// HELP FUNCTION TO GET CATEGORIES
function stela_category_loop( $parent_id = NULL, $parent_color = NULL ) {
  $parent_color = isset($parent_color) ? $parent_color : NULL;

  if(Params::getParam('sCategory') <> '') {
    $id = Params::getParam('sCategory');
  } else if (stela_get_session('sCategory') <> '' && (osc_is_publish_page() || osc_is_edit_page())) {
    $id = stela_get_session('sCategory');
  } else if (osc_item_category_id() <> '') {
    $id = osc_item_category_id();
  } else {
    $id = '';
  }


  if($parent_id <> '' && $parent_id > 0) {
    $categories = Category::newInstance()->findSubcategoriesEnabled( $parent_id );
  } else {
    $parent_id = 0;
    $categories = Category::newInstance()->findRootCategoriesEnabled();
  }

  $html = '<div class="flat-wrap' . ($parent_id == 0 ? ' root' : '') . '" data-parent-id="' . $parent_id . '">';
  $html .= '<div class="single info">' . __('Select category', 'stela') . ' ' . ($parent_id <> 0 ? '<span class="back tr1 round2"><i class="fa fa-angle-left"></i> ' . __('Back', 'stela') . '</span>' : '') . '</div>';

  foreach( $categories as $c ) {
    if( $parent_id == 0) {
      $parent_color = stela_get_cat_color( $c['pk_i_id'] );
      $icon = '<div class="parent-icon" style="background:' . stela_get_cat_color( $c['pk_i_id'] ) . ';">' . stela_get_cat_icon( $c['pk_i_id'] ) . '</div>';
    } else {
      $icon = '<div class="parent-icon children" style="background: ' . $parent_color . '">' . stela_get_cat_icon( $c['pk_i_id'] ) . '</div>';
    }
    
    $html .= '<div class="single tr1' . ($c['pk_i_id'] == $id ? ' selected' : '') . '" data-id="' . $c['pk_i_id'] . '"><span>' . $icon . $c['s_name'] . '</span></div>';

    $subcategories = Category::newInstance()->findSubcategoriesEnabled( $c['pk_i_id'] );
    if(isset($subcategories[0])) {
      $html .= stela_category_loop( $c['pk_i_id'], $parent_color );
    }
  }
  
  $html .= '</div>';
  return $html;
}



// FLAT CATEGORIES SELECT (Publish)
function stela_flat_category_select(){  
  $html = '<div class="category-box tr1"><div class="option tr1">' . __('Select category', 'stela') . '</div></div>';

  return $html;
}



// GET CITY, REGION, COUNTRY FOR AJAX LOADER
function stela_ajax_city() {
  $user = osc_user();
  $item = osc_item();

  if(Params::getParam('sCity') <> '') {
    return Params::getParam('sCity');
  } else if (isset($item['fk_i_city_id']) && $item['fk_i_city_id'] <> '') {
    return $item['fk_i_city_id'];
  } else if (isset($user['fk_i_city_id']) && $user['fk_i_city_id'] <> '') {
    return $user['fk_i_city_id'];
  }
}


function stela_ajax_region() {
  $user = osc_user();
  $item = osc_item();

  if(Params::getParam('sRegion') <> '') {
    return Params::getParam('sRegion');
  } else if (isset($item['fk_i_region_id']) && $item['fk_i_region_id'] <> '') {
    return $item['fk_i_region_id'];
  } else if (isset($user['fk_i_region_id']) && $user['fk_i_region_id'] <> '') {
    return $user['fk_i_region_id'];
  }
}


function stela_ajax_country() {
  $user = osc_user();
  $item = osc_item();

  if(Params::getParam('sCountry') <> '') {
    return Params::getParam('sCountry');
  } else if (isset($item['fk_c_country_code']) && $item['fk_c_country_code'] <> '') {
    return $item['fk_c_country_code'];
  } else if (isset($user['fk_c_country_code']) && $user['fk_c_country_code'] <> '') {
    return $user['fk_c_country_code'];
  }
}




// USER ACCOUNT - MENU ELEMENTS
function stela_user_menu() {
  $sections = array('items', 'profile', 'logout');


  $user = User::newInstance()->findByPrimaryKey(osc_logged_user_id());
  View::newInstance()->_exportVariableToView('user', $user);


  $c_active = Item::newInstance()->countItemTypesByUserID(osc_logged_user_id(), 'active');
  $c_pending = Item::newInstance()->countItemTypesByUserID(osc_logged_user_id(), 'pending_validate');
  $c_expired = Item::newInstance()->countItemTypesByUserID(osc_logged_user_id(), 'expired');

  if (osc_rewrite_enabled()) {
    $s_active = '?itemType=active';
    $s_pending = '?itemType=pending_validate';
    $s_expired = '?itemType=expired';
  } else {
    $s_active = '&itemType=active';
    $s_pending = '&itemType=pending_validate';
    $s_expired = '&itemType=expired';
  }

  if(isset($_SERVER['HTTPS'])) {
    $protocol = $_SERVER['HTTPS'] == 'on' ? 'https' : 'http';
  } else {
    $protocol = 'http';
  }

  $current_url =  $protocol.'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

  $yes_active = 0;
  $yes_pending = 0;
  $yes_expired = 0;

  if (strpos($current_url, 'itemType=active') !== false) {
    $yes_active = 1;
  } else if (strpos($current_url, 'itemType=pending_validate') !== false) {
    $yes_pending = 1;
  } else if (strpos($current_url, 'itemType=expired') !== false) {
    $yes_expired = 1;
  }


  $options = array();
  $options[] = array('name' => __('Active', 'stela'), 'url' => osc_user_list_items_url() . $s_active, 'class' => 'opt_active_items', 'icon' => 'fa-check-square-o', 'section' => 1, 'count' => $c_active, 'is_active' => $yes_active);
  $options[] = array('name' => __('Not Validated', 'stela'), 'url' => osc_user_list_items_url() . $s_pending, 'class' => 'opt_not_validated_items', 'icon' => 'fa-stack-overflow', 'section' => 1, 'count' => $c_pending, 'is_active' => $yes_pending);
  $options[] = array('name' => __('Expired', 'stela'), 'url' => osc_user_list_items_url() . $s_expired, 'class' => 'opt_expired_items', 'icon' => 'fa-times-circle', 'section' => 1, 'count' => $c_expired, 'is_active' => $yes_expired);
  $options[] = array('name' => __('Dashboard', 'stela'), 'url' => osc_user_dashboard_url(), 'class' => 'opt_dashboard', 'icon' => 'fa-dashboard', 'section' => 2);
//   $options[] = array('name' => __('Alerts', 'stela'), 'url' => osc_user_alerts_url(), 'class' => 'opt_alerts', 'icon' => 'fa-bullhorn', 'section' => 2);
  $options[] = array('name' => __('Livrare Cargus', 'stela'), 'url' => "https://mycargus.cargus.ro/", 'class' => 'opt_alerts', 'icon' => 'fa-bullhorn', 'section' => 2);
  $options[] = array('name' => __('My profile', 'stela'), 'url' => osc_user_profile_url(), 'class' => 'opt_account', 'icon' => 'fa-file-text-o', 'section' => 2);
  $options[] = array('name' => __('Public Profile', 'stela'), 'url' => osc_user_public_profile_url(), 'class' => 'opt_publicprofile', 'icon' => 'fa-picture-o', 'section' => 2);
  $options[] = array('name' => __('Logout', 'stela'), 'url' => osc_user_logout_url(), 'class' => 'opt_logout', 'icon' => 'fa-sign-out', 'section' => 3);
  

  $options = osc_apply_filter('user_menu_filter', $options);


  // SECTION 1 - LISTINGS
  echo '<div class="um s1">';
  echo '<div class="user-menu-header">' . __('My listings', 'stela') . '</div>';
  echo '<ul class="user_menu">';

  foreach($options as $o) {
    if($o['section'] == 1) {
      if( isset($o['is_active']) && $o['is_active'] == 1 || $current_url == $o['url'] ) {
        $active_class =  ' active';
      } else {
        $active_class = '';
      }

      echo '<li class="' . $o['class'] . $active_class . '" ><a href="' . $o['url'] . '" >' . $o['name'] . '</a>' . (isset($o['count']) ? ' <span class="count">' . $o['count'] . '</span>' : '') . '</li>';
    }
  }

  osc_run_hook('user_menu_items');

  echo '</ul>';
  echo '</div>';


  // SECTION 2 - PROFILE & USER
  echo '<div class="um s2">';
  echo '<div class="user-menu-header"></i> ' . __('My account', 'stela') . '</div>';
  echo '<ul class="user_menu">';

  foreach($options as $o) {
    if($o['section'] == 2) {
      $active_class = ($current_url == $o['url'] ? ' active' : '');
      echo '<li class="' . $o['class'] . $active_class . '" ><a href="' . $o['url'] . '" >' . $o['name'] . '</a></li>';
    }
  }

  echo '<div class="hook-options">';
    osc_run_hook('user_menu');
  echo '</div>';

  echo '</ul>';
  echo '</div>';

  

  // SECTION 3 - LOGOUT
  echo '<div class="um s3 logout">';
  echo '<ul class="user_menu">';

  foreach($options as $o) {
    if($o['section'] == 3) {
      echo '<li class="' . $o['class'] . '" ><a href="' . $o['url'] . '" >' . $o['name'] . '</a></li>';
    }
  }

  echo '</ul>';
  echo '</div>';
}



// GET TERM NAME BASED ON COUNTRY, REGION & CITY
function stela_get_term($term = '', $country = '', $region = '', $city = ''){
  if( $term == '') {
    if( $city <> '' && is_numeric($city) ) {
      $city_info = City::newInstance()->findByPrimaryKey( $city );
      $region_info = Region::newInstance()->findByPrimaryKey( $city_info['fk_i_region_id'] );
      $loc = array_filter(array(@$city_info['s_name'], @$region_info['s_name'], strtoupper(@$region_info['fk_c_country_code'])));
      return implode(', ', $loc);
    }
 
    if( $region <> '' && is_numeric($region) ) {
      $region_info = Region::newInstance()->findByPrimaryKey( $region );
      $loc = array_filter(array(@$region_info['s_name'], strtoupper(@$region_info['fk_c_country_code'])));
      return implode(', ', $loc);
    }

    if( $region <> '') {
      $loc = array();

      if( $city <> '' ) {
        $loc[] = $city;
      }

      $loc[] = $region;


      if( $country <> '') {
        if(strlen($country) == 2) {
          $country_info = Country::newInstance()->findByCode( $country );
          $loc[] = strtoupper($country_info['pk_c_code']);
        } else {
          $loc[] = $country;
        }
      }

      return implode(', ', $loc);
    }

    if( $country <> '' && strlen($country) == 2 ) {
      $country_info = Country::newInstance()->findByCode( $country );
      return $country_info['s_name'];
    }

  } else {
    return $term;
  }
}


// GET LOCATION FULL NAME BASED ON COUNTRY, REGION & CITY
function stela_get_full_loc($country = '', $region = '', $city = ''){
  if( $city <> '' && is_numeric($city) ) {
    $city_info = City::newInstance()->findByPrimaryKey( $city );
    $region_info = Region::newInstance()->findByPrimaryKey( $city_info['fk_i_region_id'] );
    $country_info = Country::newInstance()->findByCode( $city_info['fk_c_country_code'] );
    return $city_info['s_name'] . ', ' . $region_info['s_name'] . ', ' . $country_info['s_name'];
  }

  if( $region <> '' && is_numeric($region) ) {
    $region_info = Region::newInstance()->findByPrimaryKey( $region );
    $country_info = Country::newInstance()->findByCode( $region_info['fk_c_country_code'] );

    return $region_info['s_name'] . ', ' . $country_info['s_name'];
  }

  if( $country <> '' && strlen($country) == 2 ) {
    $country_info = Country::newInstance()->findByCode( $country );
    return $country_info['s_name'];
  }

  return '';
}



// ADD TRANSACTION AND CONDITION TO OC-ADMIN EDIT ITEM
function stela_extra_add_admin( $catId = null, $item_id = null ){
  $current_url = ($_SERVER['HTTPS'] == 'on' ? 'https' : 'http').'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
  $admin_url = osc_admin_base_url();

  if (strpos($current_url, $admin_url) !== false) {
    if($item_id > 0) {
      $item = Item::newInstance()->findByPrimaryKey( $item_id );
      $item_extra = stela_item_extra( $item_id );

      echo '<div class="control-group">';
      echo '<label class="control-label" for="sTransaction">' . __('Transaction', 'stela') . '</label>';
      echo '<div class="controls">' . stela_simple_transaction(true, $item_id <> '' ? $item_id : false) . '</div>';
      echo '</div>';

      echo '<div class="control-group">';
      echo '<label class="control-label" for="sCondition">' . __('Condition', 'stela') . '</label>';
      echo '<div class="controls">' . stela_simple_condition(true, $item_id <> '' ? $item_id : false) . '</div>';
      echo '</div>';

      echo '<div class="control-group">';
      echo '<label class="control-label" for="sPhone">' . __('Phone', 'stela') . '</label>';
      echo '<div class="controls"><input type="text" name="sPhone" id="sPhone" value="' . $item_extra['s_phone'] . '" /></div>';
      echo '</div>';

      echo '<div class="control-group">';
      echo '<label class="control-label" for="sSold">' . __('Item Sold', 'stela') . '</label>';
      echo '<div class="controls"><input type="checkbox" name="sSold" id="sSold" ' . ($item_extra['i_sold'] == 1 ? 'checked' : '') . ' /></div>';
      echo '</div>';
    }
  }
}

osc_add_hook('item_form', 'stela_extra_add_admin');
osc_add_hook('item_edit', 'stela_extra_add_admin');



function stela_extra_edit( $item ) {
  $item['pk_i_id'] = isset($item['pk_i_id']) ? $item['pk_i_id'] : 0;
  $detail = ModelAisItem::newInstance()->findByItemId( $item['pk_i_id'] );

  if( isset($detail['fk_i_item_id']) ) {
    ModelAisItem::newInstance()->updateItemMeta( $item['pk_i_id'], Params::getParam('ais_meta_title'), Params::getParam('ais_meta_description') );
  } else {
    ModelAisItem::newInstance()->insertItemMeta( $item['pk_i_id'], Params::getParam('ais_meta_title'), Params::getParam('ais_meta_description') );
  } 
}


// SIMPLE SEARCH SORT
function stela_simple_sort() {
  $type = Params::getParam('sOrder');           // date - price
  $order = Params::getParam('iOrderType');      // asc - desc

  $orders = osc_list_orders();


  //$html  = '<input type="hidden" name="sOrder" id="sOrder" val="' . $type . '"/>';
  //$html  = '<input type="hidden" name="iOrderType" id="iOrderType" val="' . $order . '"/>';

  $html  = '<select class="orderSelect" id="orderSelect" name="orderSelect">';
  
  foreach($orders as $label => $spec) {

    $selected = '';
    if( $spec['sOrder'] == $type && $spec['iOrderType'] == $order ) {
      $selected = ' selected="selected"';
    }
 
    $html .= '<option' . $selected . ' data-type="' . $spec['sOrder'] . '" data-order="' . $spec['iOrderType'] . '">' . $label . '</option>';
  }

  $html .= '</select>';

  return $html;
}


// SIMPLE CATEGORY SELECT
function stela_simple_category( $select = false ) {
  $search_cat_id = osc_search_category_id();
  $current_id = isset($search_cat_id[0]) ? $search_cat_id[0] : Params::getParam('sCategory');

  $categories = Category::newInstance()->toTree();
  $current = Category::newInstance()->findByPrimaryKey( $current_id );
  $root = Category::newInstance()->toRootTree( $current_id );
  $root_ids = array_column($root, 'pk_i_id');

  $root = isset($root[0]) ? $root[0] : array('pk_i_id' => $current_id, 's_name' => (isset($current['s_name']) ? $current['s_name'] : ''));



  if(!$select) {

    $html  = '<div class="simple-cat simple-select">';
    $html .= '<input type="hidden" name="sCategory" id="sCategory" class="input-hidden sCategory" value="' . $current_id . '"/>';
    $html .= '<span class="text round3 tr1"><span>' . ($current['s_name'] <> '' ? $current['s_name'] : __('Category', 'stela')) . '</span> <i class="fa fa-angle-down"></i></span>';
    $html .= '<div class="list">';
    $html .= '<div class="option info">' . __('Choose one category', 'stela') . '</div>';
    $html .= '<div class="option bold' . (!isset($root['pk_i_id']) ? ' selected' : '') . '" data-id="">' . __('All categories', 'stela') . '</div>';

    foreach($categories as $c) {
      $html .= '<div class="option' . ($c['pk_i_id'] == $current['pk_i_id'] ? ' selected' : '') . (in_array($c['pk_i_id'], $root_ids) ? ' parent' : '') . '" data-id="' . $c['pk_i_id'] . '">' . $c['s_name'] . '</span></div>';

      if(count($c['categories']) > 0 && in_array($c['pk_i_id'], $root_ids)) { 
        foreach($c['categories'] as $d) {
          $html .= '<div class="option' . ($d['pk_i_id'] == $current['pk_i_id'] ? ' selected' : '') . (in_array($d['pk_i_id'], $root_ids) ? ' parent' : '') . '" data-id="' . $d['pk_i_id'] . '">&nbsp;&nbsp;' . $d['s_name'] . '</span></div>';

          if(count($d['categories']) > 0 && in_array($d['pk_i_id'], $root_ids)) { 
            foreach($d['categories'] as $e) {
              $html .= '<div class="option' . ($e['pk_i_id'] == $current['pk_i_id'] ? ' selected' : '')  . (in_array($e['pk_i_id'], $root_ids) ? ' parent' : '') . '" data-id="' . $e['pk_i_id'] . '">&nbsp;&nbsp;&nbsp;&nbsp;' . $e['s_name'] . '</span></div>';

              if(count($e['categories']) > 0 && in_array($e['pk_i_id'], $root_ids)) { 
                foreach($e['categories'] as $f) {
                  $html .= '<div class="option' . ($f['pk_i_id'] == $current['pk_i_id'] ? ' selected' : '') . '" data-id="' . $f['pk_i_id'] . '">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $f['s_name'] . '</span></div>';
                }
              }
            }
          }
        }
      }
    }

    $html .= '</div>';
    $html .= '</div>';

    return $html;

  } else {
    $html  = '<select class="sCategory" id="sCategory" name="sCategory">';
    $html .= '<option value="" ' . (!isset($root['pk_i_id']) ? ' selected="selected"' : '') . '>' . __('All categories', 'stela') . '</option>';

    foreach($categories as $c) {
      $html .= '<option ' . ($current['pk_i_id'] == $c['pk_i_id'] ? ' selected="selected"' : '') . ' value="' . $c['pk_i_id'] . '">' . $c['s_name'] . '</option>';

      if(count($c['categories']) > 0 && in_array($c['pk_i_id'], $root_ids)) { 
        foreach($c['categories'] as $d) {
          $html .= '<option ' . ($current['pk_i_id'] == $d['pk_i_id'] ? ' selected="selected"' : '') . ' value="' . $d['pk_i_id'] . '">&nbsp;&nbsp;&nbsp;' . $d['s_name'] . '</option>';
        }
      }
    }

    $html .= '</select>';

    return $html;

  }
}



// SIMPLE SELLER TYPE SELECT
function stela_simple_seller( $select = false ) {
  $id = Params::getParam('sCompany');

  if($id == "") {
    $name = __('Seller type', 'stela');
  } else if ($id == "0") {
    $name = __('Personal', 'stela');
  } else if ($id == "1") {
    $name = __('Business', 'stela');
  } else {
    $name = __('Seller type', 'stela');
  }


  if( !$select ) {
    $html  = '<div class="simple-seller simple-select">';
    $html .= '<input type="hidden" name="sCompany" class="input-hidden" value="' . Params::getParam('sCompany') . '"/>';
    $html .= '<span class="text round3 tr1"><span>' . $name . '</span> <i class="fa fa-angle-down"></i></span>';
    $html .= '<div class="list">';
    $html .= '<div class="option info">' . __('Seller type', 'stela') . '</div>';
    $html .= '<div class="option bold' . ($id == "" ? ' selected' : '') . '" data-id="">' . __('All types', 'stela') . '</div>';

    $html .= '<div class="option' . ($id == "0" ? ' selected' : '') . '" data-id="0">' . __('Personal', 'stela') . '</span></div>';
    $html .= '<div class="option' . ($id == "1" ? ' selected' : '') . '" data-id="1">' . __('Business', 'stela') . '</span></div>';

    $html .= '</div>';
    $html .= '</div>';

    return $html;

  } else {

    $html  = '<select class="sCompany" id="sCompany" name="sCompany">';
    $html .= '<option value="" ' . ($id == "" ? ' selected="selected"' : '') . '>' . __('Seller type', 'stela') . '</option>';
    $html .= '<option value="0" ' . ($id == "0" ? ' selected="selected"' : '') . '>' . __('Personal', 'stela') . '</option>';
    $html .= '<option value="1" ' . ($id == "1" ? ' selected="selected"' : '') . '>' . __('Business', 'stela') . '</option>';
    $html .= '</select>';

    return $html;

  }
}



// SIMPLE TRANSACTION TYPE SELECT
function stela_simple_transaction( $select = false, $item_id = false ) {
  if((osc_is_publish_page() || osc_is_edit_page()) && stela_get_session('sTransaction') <> '') {
    $id = stela_get_session('sTransaction');
  } else {
    $id = Params::getParam('sTransaction');
  }

  if( $item_id == '' ) {
    $item_id = osc_item_id();
  }

  if( $item_id > 0 ) {
    //$item = Item::newInstance()->findByPrimaryKey( $item_id );
    //$id = $item['i_transaction'];

    $id = stela_item_extra( $item_id );
    $id = $id['i_transaction'];
  }

  // $id = $id <> '' ? $id : osc_item_field('i_transaction');

  if($id == "") {
    $name = __('Transaction', 'stela');
  } else if ($id == 1) {
    $name = __('Sell', 'stela');
  } else if ($id == 2) {
    $name = __('Buy', 'stela');
  } else if ($id == 3) {
    $name = __('Rent', 'stela');
  } else if ($id == 4) {
    $name = __('Vand-Schimb', 'stela');
  }


  if( !$select ) {
    $html  = '<div class="simple-transaction simple-select">';
    $html .= '<input type="hidden" name="sTransaction" class="input-hidden" value="' . $id . '"/>';
    $html .= '<span class="text round3 tr1"><span>' . $name . '</span> <i class="fa fa-angle-down"></i></span>';
    $html .= '<div class="list">';
    $html .= '<div class="option info">' . __('Choose transaction type', 'stela') . '</div>';
    $html .= '<div class="option bold' . ($id == "" ? ' selected' : '') . '" data-id="">' . __('All transactions', 'stela') . '</div>';

    $html .= '<div class="option' . ($id == "1" ? ' selected' : '') . '" data-id="1">' . __('Sell', 'stela') . '</span></div>';
    $html .= '<div class="option' . ($id == "2" ? ' selected' : '') . '" data-id="2">' . __('Buy', 'stela') . '</span></div>';
    $html .= '<div class="option' . ($id == "3" ? ' selected' : '') . '" data-id="3">' . __('Rent', 'stela') . '</span></div>';
    $html .= '<div class="option' . ($id == "4" ? ' selected' : '') . '" data-id="4">' . __('Vand-Schimb', 'stela') . '</span></div>';

    $html .= '</div>';
    $html .= '</div>';

    return $html;

  } else {

    $html  = '<select class="sTransaction" id="sTransaction" name="sTransaction">';
    $html .= '<option value="" ' . ($id == "" ? ' selected="selected"' : '') . '>' . __('All transactions', 'stela') . '</option>';
    $html .= '<option value="1" ' . ($id == "1" ? ' selected="selected"' : '') . '>' . __('Sell', 'stela') . '</option>';
    $html .= '<option value="2" ' . ($id == "2" ? ' selected="selected"' : '') . '>' . __('Buy', 'stela') . '</option>';
    $html .= '<option value="3" ' . ($id == "3" ? ' selected="selected"' : '') . '>' . __('Rent', 'stela') . '</option>';
    $html .= '<option value="4" ' . ($id == "4" ? ' selected="selected"' : '') . '>' . __('Vand-Schimb', 'stela') . '</option>';
    $html .= '</select>';

    return $html;

  }
}



// SIMPLE OFFER TYPE SELECT
function stela_simple_condition( $select = false, $item_id = false ) {
  if((osc_is_publish_page() || osc_is_edit_page()) && stela_get_session('sCondition') <> '') {
    $id = stela_get_session('sCondition');
  } else {
    $id = Params::getParam('sCondition');
  }

  if( $item_id == '' ) {
    $item_id = osc_item_id();
  }

  if( $item_id > 0 ) {
    //$item = Item::newInstance()->findByPrimaryKey( $item_id );
    //$id = $item['i_condition'];

    $id = stela_item_extra( $item_id );
    $id = $id['i_condition'];
  }

  //$id = $id <> '' ? $id : osc_item_field('i_condition');

  if($id == "") {
    $name = __('Condition', 'stela');
  } else if ($id == 1) {
    $name = __('New', 'stela');
  } else if ($id == 2) {
    $name = __('Used', 'stela');
  }


  if( !$select ) {
    $html  = '<div class="simple-condition simple-select">';
    $html .= '<input type="hidden" name="sCondition" class="input-hidden" value="' . $id . '"/>';
    $html .= '<span class="text round3 tr1"><span>' . $name . '</span> <i class="fa fa-angle-down"></i></span>';
    $html .= '<div class="list">';
    $html .= '<div class="option info">' . __('Choose condition of item', 'stela') . '</div>';
    $html .= '<div class="option bold' . ($id == "" ? ' selected' : '') . '" data-id="">' . __('All conditions', 'stela') . '</div>';

    $html .= '<div class="option' . ($id == "1" ? ' selected' : '') . '" data-id="1">' . __('New', 'stela') . '</span></div>';
    $html .= '<div class="option' . ($id == "2" ? ' selected' : '') . '" data-id="2">' . __('Used', 'stela') . '</span></div>';

    $html .= '</div>';
    $html .= '</div>';

    return $html;

  } else {

    $html  = '<select class="sCondition" id="sCondition" name="sCondition">';
    $html .= '<option value="" ' . ($id == "" ? ' selected="selected"' : '') . '>' . __('All conditions', 'stela') . '</option>';
    $html .= '<option value="1" ' . ($id == "1" ? ' selected="selected"' : '') . '>' . __('New', 'stela') . '</option>';
    $html .= '<option value="2" ' . ($id == "2" ? ' selected="selected"' : '') . '>' . __('Used', 'stela') . '</option>';
    $html .= '</select>';

    return $html;

  }
}



// SIMPLE CURRENCY SELECT (publish)
function stela_simple_currency() {
  $currencies = osc_get_currencies();
  $item = osc_item(); 

  if((osc_is_publish_page() || osc_is_edit_page()) && stela_get_session('currency') <> '') {
    $id = stela_get_session('currency');
  } else {
    $id = Params::getParam('currency');
  }

  $currency = $id <> '' ? $id : osc_get_preference('currency');

  if( isset($item['fk_c_currency_code']) ) {
    $default_key = $item['fk_c_currency_code'];
  } elseif( isset( $currency ) && $currency <> '' ) {
    $default_key = $currency;
  } else {
    $default_key = $currencies[0]['pk_c_code'];
  }

  if($default_key <> '') {
    $default_currency = Currency::newInstance()->findByPrimaryKey($default_key);
  } else {
    $default_currency = array('pk_c_code' => '', 's_description' => '');
  }

  if(osc_is_edit_page() && osc_item_price() <= 0) {
    $disable = ' disabled';
  } else {
    $disable = '';
  }

  $html  = '<div class="simple-currency simple-select' . $disable . '">';
  $html .= '<input type="hidden" name="currency" id="currency" class="input-hidden" value="' . $default_currency['pk_c_code'] . '"/>';
  $html .= '<span class="text round3 tr1"><span>' . $default_currency['pk_c_code'] . ' (' . $default_currency['s_description'] . ')</span> <i class="fa fa-angle-down"></i></span>';
  $html .= '<div class="list">';
  $html .= '<div class="option info">' . __('Currency', 'stela') . '</div>';

  foreach($currencies as $c) {
    $html .= '<div class="option' . ($c['pk_c_code'] == $default_key ? ' selected' : '') . '" data-id="' . $c['pk_c_code'] . '">' . $c['pk_c_code'] . ' (' . $c['s_description'] . ')</span></div>';
  }

  $html .= '</div>';
  $html .= '</div>';

  return $html;
}



// SIMPLE PRICE TYPE SELECT (publish)
function stela_simple_price_type() {
  $item = osc_item(); 

  // Item edit
  if( isset($item['pk_i_id']) ) {
    if( $item['i_price'] > 0 ) {
      $default_key = 0;
      $default_name = '<i class="fa fa-pencil help"></i> ' . __('Fixed price', 'stela');
    } else if( $item['i_price'] === null) {
      $default_key = 2;
      $default_name = '<i class="fa fa-phone help"></i> ' . __('Check with seller', 'stela');
    } else {
      $default_key = 1;
      $default_name = '<i class="fa fa-cut help"></i> ' . __('Free', 'stela');
    }
  
  // Item publish
  } else {
    $default_key = 0;
    $default_name = '<i class="fa fa-pencil help"></i> ' . __('Fixed price', 'stela');
  }


  $html  = '<div class="simple-price-type simple-select">';
  
  $html .= '<span class="text round3 tr1"><span>' . $default_name . '</span> <i class="fa fa-angle-down"></i></span>';
  $html .= '<div class="list">';
  
  $html .= '<div class="option info">' . __('Choose price type', 'stela') . '</div>';
  
  $html .= '<div class="option' . ($default_key == 0 ? ' selected' : '') . '" data-id="0"><i class="fa fa-pencil help"></i> ' . __('Fixed price', 'stela') . '</span></div>';
  $html .= '<div class="option' . ($default_key == 1 ? ' selected' : '') . '" data-id="1"><i class="fa fa-cut help"></i> ' . __('Free', 'stela') . '</span></div>';
  $html .= '<div class="option' . ($default_key == 2 ? ' selected' : '') . '" data-id="2"><i class="fa fa-phone help"></i> ' . __('Check with seller', 'stela') . '</span></div>';
 
  $html .= '</div>';
  $html .= '</div>';

  return $html;
}


// SIMPLE PERIOD SELECT (search only)
function stela_simple_period( $select = false ) {
  $id = Params::getParam('sPeriod');

  if($id == "") {
    $name = __('Period', 'stela');
  } else if ($id == 1) {
    $name = __('1 day old', 'stela');
  } else if ($id == 2) {
    $name = __('2 days old', 'stela');
  } else if ($id == 7) {
    $name = __('1 week old', 'stela');
  } else if ($id == 14) {
    $name = __('2 weeks old', 'stela');
  } else if ($id == 31) {
    $name = __('1 month old', 'stela');
  } else {
    $name = __('Other age', 'stela');
  }


  if( !$select ) {
    $html  = '<div class="simple-period simple-select">';
    $html .= '<input type="hidden" name="sPeriod" class="input-hidden" value="' . $id . '"/>';
    $html .= '<span class="text round3 tr1"><span>' . $name . '</span> <i class="fa fa-angle-down"></i></span>';
    $html .= '<div class="list">';
    $html .= '<div class="option info">' . __('Choose period', 'stela') . '</div>';
    $html .= '<div class="option bold' . ($id == "" ? ' selected' : '') . '" data-id="">' . __('All listings', 'stela') . '</div>';

    $html .= '<div class="option' . ($id == "1" ? ' selected' : '') . '" data-id="1">' . __('1 day old', 'stela') . '</span></div>';
    $html .= '<div class="option' . ($id == "2" ? ' selected' : '') . '" data-id="2">' . __('2 days old', 'stela') . '</span></div>';
    $html .= '<div class="option' . ($id == "7" ? ' selected' : '') . '" data-id="7">' . __('1 week old', 'stela') . '</span></div>';
    $html .= '<div class="option' . ($id == "14" ? ' selected' : '') . '" data-id="14">' . __('2 weeks old', 'stela') . '</span></div>';
    $html .= '<div class="option' . ($id == "31" ? ' selected' : '') . '" data-id="31">' . __('1 month old', 'stela') . '</span></div>';

    $html .= '</div>';
    $html .= '</div>';

    return $html;

  } else {

    $html  = '<select class="sPeriod" id="sPeriod" name="sPeriod">';
    $html .= '<option value="" ' . ($id == "" ? ' selected="selected"' : '') . '>' . __('All listings', 'stela') . '</option>';
    $html .= '<option value="1" ' . ($id == "1" ? ' selected="selected"' : '') . '>' . __('1 day old', 'stela') . '</option>';
    $html .= '<option value="2" ' . ($id == "2" ? ' selected="selected"' : '') . '>' . __('2 days old', 'stela') . '</option>';
    $html .= '<option value="3" ' . ($id == "7" ? ' selected="selected"' : '') . '>' . __('1 week old', 'stela') . '</option>';
    $html .= '<option value="4" ' . ($id == "14" ? ' selected="selected"' : '') . '>' . __('2 weeks old', 'stela') . '</option>';
    $html .= '<option value="4" ' . ($id == "31" ? ' selected="selected"' : '') . '>' . __('1 month old', 'stela') . '</option>';
    $html .= '</select>';

    return $html;

  }
}


// Cookies work
if(!function_exists('mb_set_cookie')) {
  function mb_set_cookie($name, $val) {
    Cookie::newInstance()->set_expires( 86400 * 30 );
    Cookie::newInstance()->push($name, $val);
    Cookie::newInstance()->set();
  }
}

if(!function_exists('mb_get_cookie')) {
  function mb_get_cookie($name) {
    return Cookie::newInstance()->get_value($name);
  }
}

if(!function_exists('mb_drop_cookie')) {
  function mb_drop_cookie($name) {
    Cookie::newInstance()->pop($name);
  }
}

// Ajax clear cookies
if(isset($_GET['clearCookieSearch']) && $_GET['clearCookieSearch'] == 'done') {
  mb_drop_cookie('stela-sCategory');
  //mb_drop_cookie('stela-sPattern');
  mb_drop_cookie('stela-sPriceMin');
  mb_drop_cookie('stela-sPriceMax');
}




// FIND ROOT CATEGORY OF SELECTED
function stela_category_root( $category_id ) {
  $category = Category::newInstance()->findRootCategory( $category_id );
  return $category;
}


// CHECK IF THEME IS DEMO
function stela_is_demo() {
  if(isset($_SERVER['HTTP_HOST']) && (strpos($_SERVER['HTTP_HOST'],'mb-themes') !== false || strpos($_SERVER['HTTP_HOST'],'abprofitrade') !== false)) {
    return true;
  } else {
    return false;
  }
}

// CREATE ITEM (in loop)
function stela_draw_item($c = NULL, $view = 'gallery', $premium = false, $class = false) {
  $filename = 'loop-single';

  if($premium){
    $filename .='-premium';
  }

  require WebThemes::newInstance()->getCurrentThemePath() . $filename . '.php';
}



// RANDOM LATEST ITEMS ON HOME PAGE
function stela_random_items($numItems = 10, $category = array(), $withPicture = false) {
  $excluded_categories = array(201,203,205);
  $max_items = osc_get_preference('maxLatestItems@home', 'osclass');
 
  if($max_items == '' or $max_items == 0) {
    $max_items = 24;
  }

  $numItems = $max_items;

  $withPicture = osc_get_preference('latest_picture', 'stela_theme');
  $randomOrder = osc_get_preference('latest_random', 'stela_theme');
  $premiums = osc_get_preference('latest_premium', 'stela_theme');
  $category = osc_get_preference('latest_category', 'stela_theme');



  $randSearch = Search::newInstance();
  $randSearch->dao->select(DB_TABLE_PREFIX.'t_item.* ');
  $randSearch->dao->from( DB_TABLE_PREFIX.'t_item use index (PRIMARY)' );

  // where
  $whe  = DB_TABLE_PREFIX.'t_item.b_active = 1 AND ';
  $whe .= DB_TABLE_PREFIX.'t_item.b_enabled = 1 AND ';
  $whe .= DB_TABLE_PREFIX.'t_item.b_spam = 0 AND ';

  if($premiums == 1) {
    $whe .= DB_TABLE_PREFIX.'t_item.b_premium = 1 AND ';
  }

  $whe .= '('.DB_TABLE_PREFIX.'t_item.b_premium = 1 || '.DB_TABLE_PREFIX.'t_item.dt_expiration >= \''. date('Y-m-d H:i:s').'\') ';

  if( $category <> '' and $category > 0 ) {
    $subcat_list = Category::newInstance()->findSubcategories( $category );
    $subcat_id = array();
    $subcat_id[] = $category;

    foreach( $subcat_list as $s) {
      $subcat_id[] = $s['pk_i_id'];
    }

    $listCategories = implode(', ', $subcat_id);

    $whe .= ' AND '.DB_TABLE_PREFIX.'t_item.fk_i_category_id IN ('.$listCategories.') ';
  }

if(!empty($excluded_categories)) {
      $excluded_categories_str = implode(', ', $excluded_categories);
      $whe .= ' AND '.DB_TABLE_PREFIX.'t_item.fk_i_category_id NOT IN ('.$excluded_categories_str.') ';
  }

  if($withPicture) {
    $prem_where = ' AND ' . $whe;
      

    $randSearch->dao->from( '(' . sprintf("select %st_item.pk_i_id FROM %st_item, %st_item_resource WHERE %st_item_resource.s_content_type LIKE '%%image%%' AND %st_item.pk_i_id = %st_item_resource.fk_i_item_id %s GROUP BY %st_item.pk_i_id ORDER BY %st_item.dt_pub_date DESC LIMIT %s", DB_TABLE_PREFIX, DB_TABLE_PREFIX, DB_TABLE_PREFIX, DB_TABLE_PREFIX, DB_TABLE_PREFIX, DB_TABLE_PREFIX, $prem_where, DB_TABLE_PREFIX, DB_TABLE_PREFIX, $numItems) . ') AS LIM' );
  } else {
    $prem_where = ' WHERE ' . $whe;

    $randSearch->dao->from( '(' . sprintf("select %st_item.pk_i_id FROM %st_item %s ORDER BY %st_item.dt_pub_date DESC LIMIT %s", DB_TABLE_PREFIX, DB_TABLE_PREFIX, $prem_where, DB_TABLE_PREFIX, $numItems) . ') AS LIM' );
  }

  $randSearch->dao->where(DB_TABLE_PREFIX.'t_item.pk_i_id = LIM.pk_i_id');
  

  // group by & order & limit
  $randSearch->dao->groupBy(DB_TABLE_PREFIX.'t_item.pk_i_id');

  if(!$randomOrder) {
    $randSearch->dao->orderBy(DB_TABLE_PREFIX.'t_item.dt_pub_date DESC');
  } else {
    $randSearch->dao->orderBy('RAND()');
  }

  $randSearch->dao->limit($numItems);

  $rs = $randSearch->dao->get();

  if($rs === false){
    return array();
  }
  if( $rs->numRows() == 0 ) {
    return array();
  }

  $items = $rs->result();
  return Item::newInstance()->extendData($items);
}


function stela_manage_cookies() { 
  if(Params::getParam('page') == 'search') { $reset = true; } else { $reset = false; }
  if($reset) {
    if(Params::getParam('sCountry') <> '' or Params::getParam('cookieAction') == 'done' or Params::getParam('cookieActionMobile') == 'done') {
      mb_set_cookie('stela-sCountry', Params::getParam('sCountry')); 
      mb_set_cookie('stela-sRegion', ''); 
      mb_set_cookie('stela-sCity', ''); 
    }

    if(Params::getParam('sRegion') <> '' or Params::getParam('cookieAction') == 'done'or Params::getParam('cookieActionMobile') == 'done') {
      if(is_numeric(Params::getParam('sRegion'))) {
        $reg = Region::newInstance()->findByPrimaryKey(Params::getParam('sRegion'));
      
        mb_set_cookie('stela-sCountry', strtoupper($reg['fk_c_country_code'])); 
        mb_set_cookie('stela-sRegion', $reg['s_name']); 
        mb_set_cookie('stela-sCity', ''); 
      } else {
        mb_set_cookie('stela-sRegion', Params::getParam('sRegion')); 
        mb_set_cookie('stela-sCity', ''); 
      }
    }

    if(Params::getParam('sCity') <> '' or Params::getParam('cookieAction') == 'done' or Params::getParam('cookieActionMobile') == 'done') {
      if(is_numeric(Params::getParam('sCity'))) {
        $city = City::newInstance()->findByPrimaryKey(Params::getParam('sCity'));
        $reg = Region::newInstance()->findByPrimaryKey($city['fk_i_region_id']);
        
        mb_set_cookie('stela-sCountry', strtoupper($city['fk_c_country_code'])); 
        mb_set_cookie('stela-sRegion', $reg['s_name']); 
        mb_set_cookie('stela-sCity', $city['s_name']); 
      } else {
        mb_set_cookie('stela-sCity', Params::getParam('sCity')); 
      }
    }


    if(Params::getParam('sCategory') <> '' and Params::getParam('sCategory') <> 0 or Params::getParam('cookieAction') == 'done' or Params::getParam('cookieActionMobile') == 'done') { mb_set_cookie('stela-sCategory', Params::getParam('sCategory')); }
    if(Params::getParam('sCategory') == 0 and osc_is_search_page()) { mb_set_cookie('stela-sCategory', ''); }
    //if(Params::getParam('sPattern') <> '' or Params::getParam('cookieAction') == 'done' or Params::getParam('cookieActionMobile') == 'done') { mb_set_cookie('stela-sPattern', Params::getParam('sPattern')); }
    //if(Params::getParam('sPriceMin') <> '' or Params::getParam('cookieAction') == 'done' or Params::getParam('cookieActionMobile') == 'done') { mb_set_cookie('stela-sPriceMin', Params::getParam('sPriceMin')); }
    //if(Params::getParam('sPriceMax') <> '' or Params::getParam('cookieAction') == 'done' or Params::getParam('cookieActionMobile') == 'done') { mb_set_cookie('stela-sPriceMax', Params::getParam('sPriceMax')); }
    //if(Params::getParam('sCompany') <> '' or Params::getParam('cookieAction') == 'done' or Params::getParam('cookieActionMobile') == 'done' or isset($_GET['sCompany'])) { mb_set_cookie('stela-sCompany', Params::getParam('sCompany')); }
    if(Params::getParam('sShowAs') <> '' or Params::getParam('cookieAction') == 'done' or Params::getParam('cookieActionMobile') == 'done') { mb_set_cookie('stela-sShowAs', Params::getParam('sShowAs')); }
  }

  $cat = osc_search_category_id();
  $cat = isset($cat[0]) ? $cat[0] : '';

  $reg = osc_search_region();
  $cit = osc_search_city();

  if($cat <> '' and $cat <> 0 or Params::getParam('cookieAction') == 'done' or Params::getParam('cookieActionMobile') == 'done') { mb_set_cookie('stela-sCategory', $cat); }
  if($reg <> '' or Params::getParam('cookieAction') == 'done' or Params::getParam('cookieActionMobile') == 'done') { mb_set_cookie('stela-sRegion', $reg); }
  if($cit <> '' or Params::getParam('cookieAction') == 'done' or Params::getParam('cookieActionMobile') == 'done') { mb_set_cookie('stela-sCity', $cit); }

  Params::setParam('sCountry', mb_get_cookie('stela-sCountry'));
  Params::setParam('sRegion', mb_get_cookie('stela-sRegion'));
  Params::setParam('sCity', mb_get_cookie('stela-sCity'));
  Params::setParam('sCategory', mb_get_cookie('stela-sCategory'));
  //Params::setParam('sPattern', mb_get_cookie('stela-sPattern'));
  //Params::setParam('sPriceMin', mb_get_cookie('stela-sPriceMin'));
  //Params::setParam('sPriceMax', mb_get_cookie('stela-sPriceMax'));
  //Params::setParam('sCompany', mb_get_cookie('stela-sCompany'));
  Params::setParam('sShowAs', mb_get_cookie('stela-sShowAs'));
}



// LOCATION FORMATER - USED ON SEARCH LIST
function stela_location_format($country = null, $region = null, $city = null) { 
  if($country <> '') {
    if(strlen($country) == 2) {
      $country_full = Country::newInstance()->findByCode($country);
    } else {
      $country_full = Country::newInstance()->findByName($country);
    }

    if($region <> '') {
      if($city <> '') {
        return $city . ' ' . __('in', 'stela') . ' ' . $region . ($country_full['s_name'] <> '' ? ' (' . $country_full['s_name'] . ')' : '');
      } else {
        return $region . ' (' . $country_full['s_name'] . ')';
      }
    } else { 
      if($city <> '') {
        return $city . ' ' . __('in', 'stela') . ' ' . $country_full['s_name'];
      } else {
        return $country_full['s_name'];
      }
    }
  } else {
    if($region <> '') {
      if($city <> '') {
        return $city . ' ' . __('in', 'stela') . ' ' . $region;
      } else {
        return $region;
      }
    } else { 
      if($city <> '') {
        return $city;
      } else {
        return __('Location not entered', 'stela');
      }
    }
  }
}



function mb_filter_extend() {
    $categories = array(201);
    
  // THEME EXTRA DATA
  Search::newInstance()->addJoinTable( DB_TABLE_PREFIX.'t_item_stela.fk_i_item_id', DB_TABLE_PREFIX.'t_item_stela', DB_TABLE_PREFIX.'t_item.pk_i_id = '.DB_TABLE_PREFIX.'t_item_stela.fk_i_item_id', 'LEFT OUTER' ) ; // Mod


  // SEARCH - TRANSACTION
  if(Params::getParam('sTransaction') <> '') {
    Search::newInstance()->addConditions(sprintf("%st_item_stela.i_transaction = %d", DB_TABLE_PREFIX, Params::getParam('sTransaction')));
  }


  // SEARCH - CONDITION
  if(Params::getParam('sCondition') <> '') {
    Search::newInstance()->addConditions(sprintf("%st_item_stela.i_condition = %d", DB_TABLE_PREFIX, Params::getParam('sCondition')));
  }
  
  if(Params::getParam('sCategory') == '' and Params::getParam('sCategory') == null) {
    $excluded = implode(', ', $categories);
    Search::newInstance()->addConditions(sprintf("%st_item.fk_i_category_id NOT IN (201,203,205)", DB_TABLE_PREFIX));
  }


  // SEARCH - PERIOD
  if(Params::getParam('sPeriod') <> '') {
    $date_from = date('Y-m-d', strtotime(' -' . Params::getParam('sPeriod') . ' day', time()));
    Search::newInstance()->addConditions(sprintf('cast(%st_item.dt_pub_date as date) > "%s"', DB_TABLE_PREFIX, $date_from));
  }


  // SEARCH - COMPANY
  if(Params::getParam('sCompany') <> '' and Params::getParam('sCompany') <> null) {
    Search::newInstance()->addJoinTable( DB_TABLE_PREFIX.'t_user.pk_i_id', DB_TABLE_PREFIX.'t_user', DB_TABLE_PREFIX.'t_item.fk_i_user_id = '.DB_TABLE_PREFIX.'t_user.pk_i_id', 'LEFT OUTER' ) ; // Mod

    if(Params::getParam('sCompany') == 1) {
      Search::newInstance()->addConditions(sprintf("%st_user.b_company = 1", DB_TABLE_PREFIX));
    } else {
      Search::newInstance()->addConditions(sprintf("coalesce(%st_user.b_company, 0) <> 1", DB_TABLE_PREFIX));
    }
  }
}

osc_add_hook('search_conditions', 'mb_filter_extend');



// GET ALL SEARCH PARAMETERS
function stela_search_params() {
 return array(
   'sCategory' => Params::getParam('sCategory'),
   'sCountry' => Params::getParam('sCountry'),
   'sRegion' => Params::getParam('sRegion'),
   'sCity' => Params::getParam('sCity'),
   //'sPriceMin' => Params::getParam('sPriceMin'),
   //'sPriceMin' => Params::getParam('sPriceMax'),
   'sCompany' => Params::getParam('sCompany'),
   'sShowAs' => Params::getParam('sShowAs'),
   'sOrder' => Params::getParam('sOrder'),
   'iOrderType' => Params::getParam('iOrderType')
  );
}



// FIND MAXIMUM PRICE
function stela_max_price($cat_id = null, $country_code = null, $region_id = null, $city_id = null) {
  // Search by all parameters
  $allSearch = new Search();
  $allSearch->addCategory($cat_id);
  $allSearch->addCountry($country_code);
  $allSearch->addRegion($region_id);
  $allSearch->addCity($city_id);
  $allSearch->order('i_price', 'DESC');
  $allSearch->limit(0, 1);

  $result = $allSearch->doSearch();
  $result = $result[0];

  $max_price = isset($result['i_price']) ? $result['i_price'] : 0;


  // FOLLOWING BLOCK LOOKS FOR MAX-PRICE IF IT IS 0
  // City is set, find max price by Region
  if($max_price <= 0 && isset($city_id) && $city_id <> '') {
    $regSearch = new Search();
    $regSearch->addCategory($cat_id);
    $regSearch->addCountry($country_code);
    $regSearch->addRegion($region_id);
    $regSearch->order('i_price', 'DESC');
    $regSearch->limit(0, 1);

    $result = $regSearch->doSearch();
    $result = $result[0];

    $max_price = isset($result['i_price']) ? $result['i_price'] : 0;
  }


  // Region is set, find max price by Country
  if($max_price <= 0 && isset($region_id) && $region_id <> '') {
    $regSearch = new Search();
    $regSearch->addCategory($cat_id);
    $regSearch->addCountry($country_code);
    $regSearch->order('i_price', 'DESC');
    $regSearch->limit(0, 1);

    $result = $regSearch->doSearch();
    $result = $result[0];

    $max_price = isset($result['i_price']) ? $result['i_price'] : 0;
  }


  // Country is set, find max price WorldWide
  if($max_price <= 0 && isset($country_code) && $country_code <> '') {
    $regSearch = new Search();
    $regSearch->addCategory($cat_id);
    $regSearch->order('i_price', 'DESC');
    $regSearch->limit(0, 1);

    $result = $regSearch->doSearch();
    $result = $result[0];

    $max_price = isset($result['i_price']) ? $result['i_price'] : 0;
  }


  // Category is set, find max price in all Categories
  if($max_price <= 0 && isset($region_id) && $region_id <> '') {
    $regSearch = new Search();
    $regSearch->addCategory($cat_id);
    $regSearch->order('i_price', 'DESC');
    $regSearch->limit(0, 1);

    $result = $regSearch->doSearch();
    $result = $result[0];

    $max_price = isset($result['i_price']) ? $result['i_price'] : 0;
  }


  // If max_price is still 0, set it to 1 to avoid slider defect
  if($max_price <= 0) {
    $max_price = 1000000;
  }


  return array(
    'max_price' => $max_price/1000000,
    'max_currency' => osc_get_preference('def_cur', 'stela_theme')
  );
}


// CHECK IF AJAX IMAGE UPLOAD ON PUBLISH-EDIT PAGE CAN BE USED (from osclass 3.3)
function stela_ajax_image_upload() {
  if(class_exists('Scripts')) {
    return Scripts::newInstance()->registered['jquery-fineuploader'] && method_exists('ItemForm', 'ajax_photos');
  }
}


// CLOSE BUTTON RETRO-COMPATIBILITY
if( !OC_ADMIN ) {
  if( !function_exists('add_close_button_action') ) {
    function add_close_button_action(){
      echo '<script type="text/javascript">';
      echo '$(".flashmessage .ico-close").click(function(){';
      echo '$(this).parent().hide();';
      echo '});';
      echo '</script>';
    }
    osc_add_hook('footer', 'add_close_button_action') ;
  }
}


if(!function_exists('message_ok')) {
  function message_ok( $text ) {
    $final  = '<div style="padding: 1%;width: 98%;margin-bottom: 15px;" class="flashmessage flashmessage-ok flashmessage-inline">';
    $final .= $text;
    $final .= '</div>';
    echo $final;
  }
}


if(!function_exists('message_error')) {
  function message_error( $text ) {
    $final  = '<div style="padding: 1%;width: 98%;margin-bottom: 15px;" class="flashmessage flashmessage-error flashmessage-inline">';
    $final .= $text;
    $final .= '</div>';
    echo $final;
  }
}


// RETRO COMPATIBILITY IF FUNCTION DOES NOT EXIST
if(!function_exists('osc_count_countries')) {
  function osc_count_countries() {
    if ( !View::newInstance()->_exists('contries') ) {
      View::newInstance()->_exportVariableToView('countries', Search::newInstance()->listCountries( ">=", "country_name ASC" ) );
    }
    return View::newInstance()->_count('countries');
  }
}


// GET CURRENT LANGUAGE OF USER
function mb_get_current_user_locale() {
  return OSCLocale::newInstance()->findByPrimaryKey(osc_current_user_locale());
}



// FIX PRICE FORMAT OF PREMIUM ITEMS
function stela_premium_formated_price($price = null) {
  if($price == '') {
    $price = osc_premium_price();
  }

  return (string) stela_premium_format_price($price);
}

function stela_premium_format_price($price, $symbol = null) {
  if ($price === null) return osc_apply_filter ('item_price_null', __('Check with seller', 'stela') );
  if ($price == 0) return osc_apply_filter ('item_price_zero', __('Free', 'stela') );

  if($symbol==null) { $symbol = osc_premium_currency_symbol(); }

  $price = $price/1000000;

  $currencyFormat = osc_locale_currency_format();
  $currencyFormat = str_replace('{NUMBER}', number_format($price, osc_locale_num_dec(), osc_locale_dec_point(), osc_locale_thousands_sep()), $currencyFormat);
  $currencyFormat = str_replace('{CURRENCY}', $symbol, $currencyFormat);
  return osc_apply_filter('premium_price', $currencyFormat );
}


function stela_ajax_item_format_price($price, $symbol_code) {
  if ($price === null) return __('Check with seller', 'stela');
  if ($price == 0) return __('Free', 'stela');
  return round($price/1000000, 2) . ' ' . $symbol_code;
}





// THEME FUNCTIONS
function theme_stela_actions_admin() {
  if( Params::getParam('file') == 'oc-content/themes/' . osc_current_web_theme() . '/admin/settings.php' ) {
    if( Params::getParam('donation') == 'successful' ) {
      osc_set_preference('donation', '1', 'stela_theme');
      osc_reset_preferences();
    }
  }


  if( Params::getParam('stela_general') == 'done' ) {
    $cat_icons = Params::getParam('cat_icons');
    $footerLink  = Params::getParam('footer_link');
    $defaultLogo = Params::getParam('default_logo');
    $def_view = Params::getParam('def_view');
    $latest_picture = Params::getParam('latest_picture');
    $latest_random = Params::getParam('latest_random');
    $latest_premium = Params::getParam('latest_premium');
    $premium_home = Params::getParam('premium_home');
    $premium_search_list = Params::getParam('premium_search_list');
    $premium_search_gallery = Params::getParam('premium_search_gallery');
    $search_cookies = Params::getParam('search_cookies');
    $stick_item = Params::getParam('stick_item');
    $item_ajax = Params::getParam('item_ajax');
    $search_ajax = Params::getParam('search_ajax');
    $forms_ajax = Params::getParam('forms_ajax');

    osc_set_preference('phone', Params::getParam('phone'), 'stela_theme');
    osc_set_preference('logo_text', Params::getParam('logo_text'), 'stela_theme');
    osc_set_preference('site_info', Params::getParam('site_info'), 'stela_theme');
    osc_set_preference('cat_icons', ($cat_icons ? '1' : '0'), 'stela_theme');
    osc_set_preference('footer_link', ($footerLink ? '1' : '0'), 'stela_theme');
    osc_set_preference('default_logo', ($defaultLogo ? '1' : '0'), 'stela_theme');
    osc_set_preference('latest_picture', ($latest_picture ? '1' : '0'), 'stela_theme');
    osc_set_preference('latest_random', ($latest_random ? '1' : '0'), 'stela_theme');
    osc_set_preference('latest_premium', ($latest_premium ? '1' : '0'), 'stela_theme');
    osc_set_preference('latest_category', Params::getParam('latest_category'), 'stela_theme');
    osc_set_preference('def_cur', Params::getParam('def_cur'), 'stela_theme');
    osc_set_preference('publish_category', Params::getParam('publish_category'), 'stela_theme');
    osc_set_preference('def_view', Params::getParam('def_view'), 'stela_theme');
    osc_set_preference('premium_home', ($premium_home ? '1' : '0'), 'stela_theme');
    osc_set_preference('premium_search_list', ($premium_search_list ? '1' : '0'), 'stela_theme');
    osc_set_preference('premium_search_gallery', ($premium_search_gallery ? '1' : '0'), 'stela_theme');
    osc_set_preference('premium_home_count', Params::getParam('premium_home_count'), 'stela_theme');
    osc_set_preference('premium_search_list_count', Params::getParam('premium_search_list_count'), 'stela_theme');
    osc_set_preference('premium_search_gallery_count', Params::getParam('premium_search_gallery_count'), 'stela_theme');
    osc_set_preference('search_cookies', ($search_cookies ? '1' : '0'), 'stela_theme');
    osc_set_preference('stick_item', ($stick_item ? '1' : '0'), 'stela_theme');
    osc_set_preference('item_ajax', ($item_ajax ? '1' : '0'), 'stela_theme');
    osc_set_preference('search_ajax', ($search_ajax ? '1' : '0'), 'stela_theme');
    osc_set_preference('forms_ajax', ($forms_ajax ? '1' : '0'), 'stela_theme');
    osc_set_preference('post_required', Params::getParam('post_required'), 'stela_theme');
    osc_set_preference('post_extra_exclude', Params::getParam('post_extra_exclude'), 'stela_theme');
    osc_set_preference('website_name', Params::getParam('website_name'), 'stela_theme');
    osc_set_preference('footer_email', Params::getParam('footer_email'), 'stela_theme');

    osc_add_flash_ok_message(__('Theme settings updated correctly', 'stela'), 'admin');
    header('Location: ' . osc_admin_render_theme_url('oc-content/themes/' . osc_current_web_theme() . '/admin/settings.php')); exit;
  }


  if( Params::getParam('stela_banner') == 'done' ) {
    $theme_adsense = Params::getParam('theme_adsense');

    osc_set_preference('theme_adsense', ($theme_adsense ? '1' : '0'), 'stela_theme');

    foreach(stela_banner_list() as $b) {
      osc_set_preference($b['id'], stripslashes(Params::getParam($b['id'], false, false)), 'stela_theme');
    }

    osc_add_flash_ok_message(__('Banner settings updated correctly', 'stela'), 'admin');
    header('Location: ' . osc_admin_render_theme_url('oc-content/themes/' . osc_current_web_theme() . '/admin/settings.php')); exit;
  }


  switch( Params::getParam('action_specific') ) {
    case('upload_logo'):
      $package = Params::getFiles('logo');
      if( $package['error'] == UPLOAD_ERR_OK ) {
        if( move_uploaded_file($package['tmp_name'], WebThemes::newInstance()->getCurrentThemePath() . "images/logo.jpg" ) ) {
          osc_add_flash_ok_message(__('The logo image has been uploaded correctly', 'stela'), 'admin');
        } else {
          osc_add_flash_error_message(__("An error has occurred, please try again", 'stela'), 'admin');
        }
      } else {
        osc_add_flash_error_message(__("An error has occurred, please try again", 'stela'), 'admin');
      }
      header('Location: ' . osc_admin_render_theme_url('oc-content/themes/' . osc_current_web_theme() . '/admin/header.php')); exit;
      break;

    case('remove'):
      if(file_exists( WebThemes::newInstance()->getCurrentThemePath() . "images/logo.jpg" ) ) {
        @unlink( WebThemes::newInstance()->getCurrentThemePath() . "images/logo.jpg" );
        osc_add_flash_ok_message(__('The logo image has been removed', 'stela'), 'admin');
      } else {
        osc_add_flash_error_message(__("Image not found", 'stela'), 'admin');
      }
      header('Location: ' . osc_admin_render_theme_url('oc-content/themes/' . osc_current_web_theme() . '/admin/header.php')); exit;
      break;
  }
}

osc_add_hook('init_admin', 'theme_stela_actions_admin');
//osc_admin_menu_appearance(__('Header logo', 'stela'), osc_admin_render_theme_url('oc-content/themes/stela/admin/header.php'), 'header_stela');
//osc_admin_menu_appearance(__('Theme settings', 'stela'), osc_admin_render_theme_url('oc-content/themes/stela/admin/settings.php'), 'settings_stela');
AdminMenu::newInstance()->add_menu(__('Theme Setting', 'stela'), osc_admin_render_theme_url('oc-content/themes/' . osc_current_web_theme() . '/admin/header.php'), 'stela_menu');
AdminMenu::newInstance()->add_submenu_divider( 'stela_menu', __('Theme Settings', 'stela'), 'stela_submenu');
AdminMenu::newInstance()->add_submenu( 'stela_menu', __('Header logo', 'stela'), osc_admin_render_theme_url('oc-content/themes/' . osc_current_web_theme() . '/admin/header.php'), 'header_stela', 'administrator');
AdminMenu::newInstance()->add_submenu( 'stela_menu', __('Theme settings', 'stela'), osc_admin_render_theme_url('oc-content/themes/' . osc_current_web_theme() . '/admin/settings.php'), 'settings_stela');


if( !function_exists('logo_header') ) {
  function logo_header() {
    $html = '<img border="0" alt="' . osc_esc_html(osc_page_title()) . '" src="' . osc_current_web_theme_url('images/logo.jpg') . '" />';
    if( file_exists( WebThemes::newInstance()->getCurrentThemePath() . "images/logo.jpg" ) ) {
      return $html;
    } else if( osc_get_preference('default_logo', 'stela_theme') && (file_exists( WebThemes::newInstance()->getCurrentThemePath() . "images/default-logo.jpg")) ) {
      return '<img border="0" alt="' . osc_esc_html(osc_page_title()) . '" src="' . osc_current_web_theme_url('images/default-logo.jpg') . '" />';
    } else {
      return osc_page_title();
    }
  }
}


// INSTALL & UPDATE OPTIONS
if( !function_exists('stela_theme_install') ) {
  $themeInfo = stela_theme_info();

  function stela_theme_install() {
    osc_set_preference('version', STELA_THEME_VERSION, 'stela_theme');
    osc_set_preference('phone', __('+1 (800) 228-5651', 'stela'), 'stela_theme');
    osc_set_preference('logo_text', 'mySite.com', 'stela_theme');
    osc_set_preference('site_info', __('Widely known as Worlds no. 1 online classifieds platform, our is all about you. Our aim is to empower every person in the country to independently connect with buyers and sellers online. We care about you ďż˝ and the transactions that bring you closer to your dreams. Want to buy your first car? We are here for you. Want to sell commercial property to buy your dream home? We are here for you. Whatever job you have got, we promise to get it done.', 'stela'), 'stela_theme');
    osc_set_preference('date_format', 'mm/dd', 'stela_theme');
    osc_set_preference('cat_icons', '1', 'stela_theme');
    osc_set_preference('footer_link', '1', 'stela_theme');
    osc_set_preference('donation', '0', 'stela_theme');
    osc_set_preference('default_logo', '1', 'stela_theme');
    osc_set_preference('theme_adsense', '1', 'stela_theme');
    osc_set_preference('def_cur', '', 'stela_theme');
    osc_set_preference('def_view', '0', 'stela_theme');
    osc_set_preference('footer_email', '', 'stela_theme');
    osc_set_preference('website_name', 'myWebsite.com', 'stela_theme');
    osc_set_preference('latest_picture', '0', 'stela_theme');
    osc_set_preference('latest_random', '1', 'stela_theme');
    osc_set_preference('latest_premium', '0', 'stela_theme');
    osc_set_preference('latest_category', '', 'stela_theme');
    osc_set_preference('publish_category', '1', 'stela_theme');
    osc_set_preference('premium_home', '1', 'stela_theme');
    osc_set_preference('premium_search_list', '0', 'stela_theme');
    osc_set_preference('premium_search_gallery', '0', 'stela_theme');
    osc_set_preference('premium_home_count', '5', 'stela_theme');
    osc_set_preference('premium_search_list_count', '5', 'stela_theme');
    osc_set_preference('premium_search_gallery_count', '5', 'stela_theme');
    osc_set_preference('search_cookies', '0', 'stela_theme');
    osc_set_preference('stick_item', '1', 'stela_theme');
    osc_set_preference('item_ajax', '1', 'stela_theme');
    osc_set_preference('search_ajax', '1', 'stela_theme');
    osc_set_preference('forms_ajax', '1', 'stela_theme');
    osc_set_preference('post_required', 'country,region,name,phone', 'stela_theme');
    osc_set_preference('post_extra_exclude', '', 'stela_theme');


    /* Banners */
    if(function_exists('stela_banner_list')) {
      foreach(stela_banner_list() as $b) {
        osc_set_preference($b['id'], '', 'stela_theme');
      }
    }

    osc_reset_preferences();

    stela_add_item_fields();  // add s_phone column to database if does not exists
  }
}


if(!function_exists('check_install_stela_theme')) {
  function check_install_stela_theme() {
    $current_version = osc_get_preference('version', 'stela_theme');
    //check if current version is installed or need an update<
    if( !$current_version ) {
      stela_theme_install();
    }
  }
}

check_install_stela_theme();



// WHEN NEW LISTING IS CREATED, ADD IT TO STELA EXTRA TABLE
function stela_new_item_extra($item) {
  $conn = DBConnectionClass::newInstance();
  $data = $conn->getOsclassDb();
  $comm = new DBCommandClass($data);
  $db_prefix = DB_TABLE_PREFIX;

  $query = "INSERT INTO {$db_prefix}t_item_stela (fk_i_item_id) VALUES ({$item['pk_i_id']})";
  $result = $comm->query($query);
}

osc_add_hook('posted_item', 'stela_new_item_extra');


// WHEN NEW CATEGORY IS CREATED, ADD IT TO STELA EXTRA TABLE
function stela_new_category_extra() {

  $conn = DBConnectionClass::newInstance();
  $data = $conn->getOsclassDb();
  $comm = new DBCommandClass($data);
  $db_prefix = DB_TABLE_PREFIX;

  $query = "INSERT INTO {$db_prefix}t_category_stela (fk_i_category_id) 
            SELECT c.pk_i_id FROM {$db_prefix}t_category c WHERE c.pk_i_id NOT IN (SELECT d.fk_i_category_id FROM {$db_prefix}t_category_stela d)";
  $result = $comm->query($query);
}

osc_add_hook('footer', 'stela_new_category_extra');



// USER MENU FIX
function stela_user_menu_fix() {
  $user = User::newInstance()->findByPrimaryKey( osc_logged_user_id() );
  View::newInstance()->_exportVariableToView('user', $user);
}

osc_add_hook('header', 'stela_user_menu_fix');


// ADD COLOR COLUMN INTO CATEGORY TABLE
// NOT USED ANYMORE
//function stela_add_color_col() {
//  $conn = DBConnectionClass::newInstance();
//  $data = $conn->getOsclassDb();
//  $comm = new DBCommandClass($data);
//  $db_prefix = DB_TABLE_PREFIX;

//  $query = "ALTER TABLE {$db_prefix}t_category ADD s_color VARCHAR(50);";
//  $result = $comm->query($query);
//}


// ADD THEME COLUMNS INTO ITEM TABLE
function stela_add_item_fields() {
  $conn = DBConnectionClass::newInstance();
  $data = $conn->getOsclassDb();
  $comm = new DBCommandClass($data);
  $db_prefix = DB_TABLE_PREFIX;
  $struct = osc_base_path() . 'oc-content/themes/stela/model/struct.sql';
  $sql = file_get_contents($struct);


  //$query = "ALTER TABLE {$db_prefix}t_item ADD s_phone VARCHAR(100);";
  //$result = $comm->query($query);

  //$query = "ALTER TABLE {$db_prefix}t_item ADD i_condition VARCHAR(100);";
  //$result = $comm->query($query);

  //$query = "ALTER TABLE {$db_prefix}t_item ADD i_transaction VARCHAR(100);";
  //$result = $comm->query($query);

  //$query = "ALTER TABLE {$db_prefix}t_item ADD i_sold VARCHAR(100);";
  //$result = $comm->query($query);

  //$query = "ALTER TABLE {$db_prefix}t_item_stats ADD i_num_phone_clicks INT(10) DEFAULT 0;";
  //$result = $comm->query($query);


  // CREATE NEW TABLES IF DOES NOT EXISTS
  if(!$comm->importSQL($sql)){ 
    throw new Exception(__('Error creating tables for Stela theme. Check if these tables exists, if yes, drop them: t_item_stela, t_category_stela, t_item_stats_stela.', 'stela'));
  }

  // CREATE INDEXES MANUALLY, IF THERE IS PROBLEM
  /*
  $query = "ALTER TABLE {$db_prefix}t_item_stela ADD FOREIGN KEY (fk_i_item_id) REFERENCES {$db_prefix}t_item (pk_i_id) ON DELETE CASCADE ON UPDATE CASCADE";
  $result = $comm->query($query);

  $query = "ALTER TABLE {$db_prefix}t_item_stats_stela ADD FOREIGN KEY (fk_i_item_id) REFERENCES {$db_prefix}t_item (pk_i_id) ON DELETE CASCADE ON UPDATE CASCADE";
  $result = $comm->query($query);

  $query = "ALTER TABLE {$db_prefix}t_category_stela ADD FOREIGN KEY (fk_i_category_id) REFERENCES {$db_prefix}t_category (pk_i_id) ON DELETE CASCADE ON UPDATE CASCADE";
  $result = $comm->query($query);
  */
}



// UPDATE THEME COLS ON ITEM POST-EDIT
function stela_update_fields( $item ) {
  //$sql = sprintf("UPDATE %s SET s_phone = '%s'  WHERE pk_i_id = %d", DB_TABLE_PREFIX.'t_item', '1234', 1);
  //Item::newInstance()->dao->query($sql);

  if(Params::existParam('sSold')) {
    $fields = array(
      's_phone' => Params::getParam('sPhone'),
      'i_condition' => Params::getParam('sCondition'),
      'i_transaction' => Params::getParam('sTransaction'),
      'i_sold' => (Params::getParam('sSold') == 'on' ? 1 : Params::getParam('sSold'))
    );
  } else {
    $fields = array(
      's_phone' => Params::getParam('sPhone'),
      'i_condition' => Params::getParam('sCondition'),
      'i_transaction' => Params::getParam('sTransaction')
    );
  }

  //Item::newInstance()->dao->update(DB_TABLE_PREFIX.'t_item', $fields, array('pk_i_id' => $item['pk_i_id']));
  Item::newInstance()->dao->update(DB_TABLE_PREFIX.'t_item_stela', $fields, array('fk_i_item_id' => $item['pk_i_id']));
}

osc_add_hook('posted_item', 'stela_update_fields');
osc_add_hook('edited_item', 'stela_update_fields');


// GET STELA ITEM EXTRA VALUES
function stela_item_extra($item_id) {
  if($item_id > 0) {
    $db_prefix = DB_TABLE_PREFIX;

    $query = "SELECT * FROM {$db_prefix}t_item_stela s WHERE fk_i_item_id = " . $item_id . ";";
    $result = Item::newInstance()->dao->query( $query );
    if( !$result ) { 
      $prepare = array();
      return false;
    } else {
      $prepare = $result->row();
      return $prepare;
    }
  }
}


// GET STELA CATEGORY EXTRA VALUES
function stela_category_extra($category_id) {
  if($category_id > 0) {
    $db_prefix = DB_TABLE_PREFIX;

    $query = "SELECT * FROM {$db_prefix}t_category_stela s WHERE fk_i_category_id = " . $category_id . ";";
    $result = Category::newInstance()->dao->query( $query );
    if( !$result ) { 
      $prepare = array();
      return false;
    } else {
      $prepare = $result->row();
      return $prepare;
    }
  }
}



// KEEP VALUES OF INPUTS ON RELOAD
function stela_post_preserve() {
  Session::newInstance()->_setForm('sPhone', Params::getParam('sPhone'));
  Session::newInstance()->_setForm('term', Params::getParam('term'));
  Session::newInstance()->_setForm('zip', Params::getParam('zip'));
  Session::newInstance()->_setForm('sCondition', Params::getParam('sCondition'));
  Session::newInstance()->_setForm('sTransaction', Params::getParam('sTransaction'));

  Session::newInstance()->_keepForm('sPhone');
  Session::newInstance()->_keepForm('term');
  Session::newInstance()->_keepForm('zip');
  Session::newInstance()->_keepForm('sCondition');
  Session::newInstance()->_keepForm('sTransaction');
}

osc_add_hook('pre_item_post', 'stela_post_preserve');


// DROP VALUES OF INPUTS ON SUCCESSFUL PUBLISH
function stela_post_drop() {
  Session::newInstance()->_dropKeepForm('sPhone');
  Session::newInstance()->_dropKeepForm('term');
  Session::newInstance()->_dropKeepForm('zip');
  Session::newInstance()->_dropKeepForm('sCondition');
  Session::newInstance()->_dropKeepForm('sTransaction');

  Session::newInstance()->_clearVariables();
}

osc_add_hook('posted_item', 'stela_post_drop');



// GET VALUES FROM SESSION ON PUBLISH PAGE
function stela_get_session( $param ) {
  return Session::newInstance()->_getForm($param);
}


// COMPATIBILITY FUNCTIONS
if(!function_exists('osc_is_register_page')) {
  function osc_is_register_page() {
    return osc_is_current_page("register", "register");
  }
}

if(!function_exists('osc_is_edit_page')) {
  function osc_is_edit_page() {
    return osc_is_current_page('item', 'item_edit');
  }
}


// DEFAULT ICONS ARRAY
function stela_default_icons() {
  $icons = array(
    1 => 'fa-newspaper-o', 2 => 'fa-motorcycle', 3 => 'fa-graduation-cap', 4 => 'fa-home', 5 => 'fa-wrench', 6 => 'fa-users', 7 => 'fa-venus-mars', 8 => 'fa-briefcase', 9 => 'fa-paw', 
    10 => 'fa-paint-brush', 11 => 'fa-exchange', 12 => 'fa-newspaper-o', 13 => 'fa-camera', 14 => 'fa-tablet', 15 => 'fa-mobile', 16 => 'fa-shopping-bag', 
    17 => 'fa-laptop', 18 => 'fa-mobile', 19 => 'fa-lightbulb-o', 20 => 'fa-soccer-ball-o', 21 => 'fa-s15', 22 => 'fa-medkit', 23 => 'fa-home', 24 => 'fa-clock-o', 
    25 => 'fa-microphone', 26 => 'fa-bicycle', 27 => 'fa-ticket', 28 => 'fa-plane', 29 => 'fa-television', 30 => 'fa-ellipsis-h', 31 => 'fa-car', 32 => 'fa-gears', 
    33 => 'fa-motorcycle', 34 => 'fa-ship', 35 => 'fa-bus', 36 => 'fa-truck', 37 => 'fa-ellipsis-h', 38 => 'fa-laptop', 39 => 'fa-language', 40 => 'fa-microphone', 
    41 => 'fa-graduation-cap', 42 => 'fa-ellipsis-h', 43 => 'fa-building-o', 44 => 'fa-building', 45 => 'fa-refresh', 46 => 'fa-exchange', 47 => 'fa-plane', 48 => 'fa-car', 
    49 => 'fa-window-minimize', 50 => 'fa-suitcase', 51 => 'fa-shopping-basket', 52 => 'fa-child', 53 => 'fa-microphone', 54 => 'fa-laptop', 55 => 'fa-music', 
    56 => 'fa-stethoscope', 57 => 'fa-star', 58 => 'fa-home', 59 => 'fa-truck', 60 => 'fa-wrench', 61 => 'fa-pencil', 62 => 'fa-ellipsis-h', 63 => 'fa-refresh', 
    64 => 'fa-sun-o', 65 => 'fa-star', 66 => 'fa-music', 67 => 'fa-wheelchair', 68 => 'fa-key', 69 => 'fa-venus', 70 => 'fa-mars', 71 => 'fa-mars-double', 
    72 => 'fa-venus-double', 73 => 'fa-genderless', 74 => 'fa-phone', 75 => 'fa-money', 76 => 'fa-television', 77 => 'fa-paint-brush', 78 => 'fa-book', 79 => 'fa-headphones', 
    80 => 'fa-graduation-cap', 81 => 'fa-paper-plane-o', 82 => 'fa-medkit', 83 => 'fa-users', 84 => 'fa-internet-explorer', 85 => 'fa-gavel', 86 => 'fa-wrench', 
    87 => 'fa-industry', 88 => 'fa-newspaper-o', 89 => 'fa-wheelchair', 90 => 'fa-home', 91 => 'fa-spoon', 92 => 'fa-exchange', 93 => 'fa-gavel', 94 => 'fa-microchip', 
    95 => 'fa-ellipsis-h', 999 => 'fa-newspaper-o'
  );

  return $icons;
}


function stela_default_colors() {
  $colors = array(1 => '#F44336', 2 => '#00BCD4', 3 => '#009688', 4 => '#FDE74C', 5 => '#8BC34A', 6 => '#D32F2F', 7 => '#2196F3', 8 => '#777', 999 => '#F44336');
  return $colors;
}


function stela_get_cat_icon( $id, $string = false ) {
  $category = Category::newInstance()->findByPrimaryKey( $id );
  $category_extra = stela_category_extra($id);
  $default_icons = stela_default_icons();

  if(osc_get_preference('cat_icons', 'stela_theme') == 1) { 
    if($category_extra['s_icon'] <> '') {
      $icon_code = $category_extra['s_icon'];
    } else {
      if(isset($default_icons[$category['pk_i_id']]) && $default_icons[$category['pk_i_id']] <> '') {
        $icon_code = $default_icons[$category['pk_i_id']];
      } else {
         $icon_code = $default_icons[999];
      }
    }

    if($string) {
      return $icon_code;
    } else {
      return '<i class="fa ' . $icon_code . '"></i>';
    }
  } else {
    if($string) {
      return osc_current_web_theme_url() . 'images/small_cat/' . $category['pk_i_id'] . '.png';
    } else {
      return '<img src="' . osc_current_web_theme_url() . 'images/small_cat/' . $category['pk_i_id'] . '.png" />';
    }
  }

  if($string) {
    
  } else {
    return $icon;
  }
}


function stela_get_cat_color( $id, $section = '' ) {
  if($section == 'home') {
    return '';
  }

  $category = Category::newInstance()->findByPrimaryKey( $id );
  $category_extra = stela_category_extra($id);
  $default_colors = stela_default_colors();

  if($category_extra['s_color'] <> '') {
    $color_code = $category_extra['s_color'];                        
  } else {
    if(isset($default_colors[$category['pk_i_id']]) && $default_colors[$category['pk_i_id']] <> '') {
      $color_code = $default_colors[$category['pk_i_id']];
    } else {
      $color_code = $default_colors[999];
    }
  }

  return $color_code;
}



// INCREASE PHONE CLICK VIEWS
function stela_increase_clicks($itemId, $itemUserId = NULL) {
  if($itemId > 0) {
    if($itemUserId == '' || $itemUserId == 0 || ($itemUserId <> '' && $itemUserId > 0 && $itemUserId <> osc_logged_user_id())) {
      $db_prefix = DB_TABLE_PREFIX;
      //$query = "INSERT INTO {$db_prefix}t_item_stats_stela (fk_i_item_id, dt_date, i_num_phone_clicks) VALUES ({$itemId}, \"{date('Y-m-d')}\", 1) ON DUPLICATE KEY UPDATE  i_num_phone_clicks = i_num_phone_clicks + 1";
      $query = 'INSERT INTO ' . $db_prefix . 't_item_stats_stela (fk_i_item_id, dt_date, i_num_phone_clicks) VALUES (' . $itemId . ', "' . date('Y-m-d') . '", 1) ON DUPLICATE KEY UPDATE  i_num_phone_clicks = i_num_phone_clicks + 1';
      return ItemStats::newInstance()->dao->query($query);
    }
  }
}


// FIX ADMIN MENU LIST WITH THEME OPTIONS
function stela_admin_menu_fix(){
  echo '<style>' . PHP_EOL;
  echo 'body.compact #stela_menu .ico-stela_menu {bottom:-6px!important;width:50px!important;height:50px!important;margin:0!important;background:#fff url(' . osc_base_url() . 'oc-content/themes/stela/images/favicons/favicon-32x32.png) no-repeat center center !important;}' . PHP_EOL;
  echo 'body.compact #stela_menu .ico-stela_menu:hover {background-color:rgba(255,255,255,0.95)!important;}' . PHP_EOL;
  echo 'body.compact #menu_stela_menu > h3 {bottom:0!important;}' . PHP_EOL;
  echo 'body.compact #menu_stela_menu > ul {border-top-left-radius:0px!important;margin-top:1px!important;}' . PHP_EOL;
  echo 'body.compact #menu_stela_menu.current:after {content:"";display:block;width:6px;height:6px;border-radius:10px;box-shadow:1px 1px 3px rgba(0,0,0,0.1);position:absolute;left:3px;bottom:3px;background:#03a9f4}' . PHP_EOL;
  echo 'body:not(.compact) #stela_menu .ico-stela_menu {background:transparent url(' . osc_base_url() . 'oc-content/themes/stela/images/favicons/favicon-32x32.png) no-repeat center center !important;}' . PHP_EOL;
  echo '</style>' . PHP_EOL;
}

osc_add_hook('admin_header', 'stela_admin_menu_fix');



// BACKWARD COMPATIBILITY FUNCTIONS
if(!function_exists('osc_is_current_page')){
  function osc_is_current_page($location, $section) {
    if( osc_get_osclass_location() === $location && osc_get_osclass_section() === $section ) {
      return true;
    }

    return false;
  }
}


// CREATE URL FOR THEME AJAX REQUESTS
function zara_ajax_url() {
  $url = osc_contact_url();

  if (osc_rewrite_enabled()) {
    $url .= '?ajaxRequest=1';
  } else {
    $url .= '&ajaxRequest=1';
  }

  return $url;
}


// COUNT PHONE CLICKS ON ITEM
function stela_phone_clicks( $item_id ) {
  if( $item_id <> '' ) {
    $db_prefix = DB_TABLE_PREFIX;

    $query = "SELECT sum(coalesce(i_num_phone_clicks, 0)) as phone_clicks FROM {$db_prefix}t_item_stats_stela s WHERE fk_i_item_id = " . $item_id . ";";
    $result = ItemStats::newInstance()->dao->query( $query );
    if( !$result ) { 
      $prepare = array();
      return '0';
    } else {
      $prepare = $result->row();

      if($prepare['phone_clicks'] <> '') {
        return $prepare['phone_clicks'];
      } else {
        return '0';
      }
    }
  }
}


// NO CAPTCHA RECAPTCHA CHECK
function stela_show_recaptcha( $section = '' ){
  if(function_exists('anr_get_option')) {
    if(anr_get_option('site_key') <> '') { 
      osc_run_hook("anr_captcha_form_field");
    }
  } else {
    if(osc_recaptcha_public_key() <> '') {
      if( ((osc_is_publish_page() || osc_is_edit_page()) && osc_recaptcha_items_enabled()) || (!osc_is_publish_page() && !osc_is_edit_page()) ) {
        osc_show_recaptcha($section);
      }
    }
  }
}


// SHOW BANNER
function stela_banner( $location ) {
  $html = '';

  if(osc_get_preference('theme_adsense', 'stela_theme') == 1) {
    if( stela_is_demo() ) {
      $class = ' is-demo';
    } else {
      $class = '';
    }

    if(osc_get_preference('banner_' . $location, 'stela_theme') == '') {
      $blank = ' blank';
    } else {
      $blank = '';
    }

    if( stela_is_demo() && osc_get_preference('banner_' . $location, 'stela_theme') == '' ) {
      $title = ' title="' . __('You can define your own banner code from theme settings', 'stela') . '"';
    } else {
      $title = '';
    }

    $html .= '<div class="banner-theme banner-' . $location . ' not767' . $class . $blank . '"' . $title . '><div>';
    $html .= osc_get_preference('banner_' . $location, 'stela_theme');

    if( stela_is_demo() && osc_get_preference('banner_' . $location, 'stela_theme') == '' ) {
      $html .= __('Banner space', 'stela') . ': <u>' . $location . '</u>';
    }

    $html .= '</div></div>';

    return $html;
  } else {
    return false;
  }
}


function stela_banner_list() {
  $list = array(
    array('id' => 'banner_home_top', 'position' => __('Top of home page', 'stela')),
    array('id' => 'banner_home_bottom', 'position' => __('Bottom of home page', 'stela')),
    array('id' => 'banner_search_sidebar', 'position' => __('Bottom of search sidebar', 'stela')),
    array('id' => 'banner_search_top', 'position' => __('Top of search page', 'stela')),
    array('id' => 'banner_search_bottom', 'position' => __('Bottom of search page', 'stela')),
    array('id' => 'banner_search_list', 'position' => __('On third position between search listings (list view)', 'stela')),
    array('id' => 'banner_item_top', 'position' => __('Top of item page', 'stela')),
    array('id' => 'banner_item_bottom', 'position' => __('Bottom of item page', 'stela')),
    array('id' => 'banner_item_sidebar', 'position' => __('Bottom of item sidebar', 'stela')),
    array('id' => 'banner_item_description', 'position' => __('Under item description', 'stela'))
  );

  return $list;
}


function stela_extra_fields_hide() {
  $list = trim(osc_get_preference('post_extra_exclude', 'stela_theme'));
  $array = explode(',', $list);
  $array = array_map('trim', $array);
  $array = array_filter($array);

  if(!empty($array) && count($array) > 0) {
    return $array;
  } else {
    return array();
  }
}

function stela_Stare_hide() {
  $list = '118,167,247,120,121,122,123,124,125,126,127,128,129,131,249';
  $array = explode(',', $list);
  $array = array_map('trim', $array);
  $array = array_filter($array);

  if(!empty($array) && count($array) > 0) {
    return $array;
  } else {
    return array();
  }
}

if(!function_exists("array_column")){
  function array_column($array,$column_name){
    return array_map(function($element) use($column_name){return $element[$column_name];}, $array);
  }
}


function stela_item_send_friend_url($item_id = -1) {
  if($item_id == -1) {
    $item_id = osc_item_id();
  }
 
  if (osc_rewrite_enabled()) {
    return osc_base_url() . osc_get_preference('rewrite_item_send_friend') . '/' . $item_id;
  } else {
    return osc_base_url(true).'?page=item&action=send_friend&id='.$item_id;
  }
}
function links_clickable($text){
  return preg_replace('!(((f|ht)tp(s)?://)[-a-zA-Zа-яА-Я()0-9@:%_+.~#?&;//=]+)!i', '<a href="$0" target="_blank" href="$1">$1</a>', $text);
}


function stela_related_ad_web() {

  $limit = (5);

  $mSearch = new Search();
  $mSearch->addCategory(osc_item_category_id());
  //$mSearch->withPicture(true);
  $mSearch->limit(1, $limit);
  $mSearch->addItemConditions(sprintf("%st_item.pk_i_id <> %d", DB_TABLE_PREFIX, osc_item_id()));

  $aItems = $mSearch->doSearch();


  GLOBAL $global_items;
  $global_items = View::newInstance()->_get('items');
  View::newInstance()->_exportVariableToView('items', $aItems);

  if(osc_count_items() > 0) {
    ?>
    <div id="related">

  <h2><?php _e('Anunturi asemanatoare', 'related_ads'); ?></h2>
    <ul class="products white slide ">
      <?php $c = 1; ?>
      <?php while( osc_has_items() ) { ?>
        <?php stela_draw_item($c, 'gallery'); ?>

        <?php $c++; ?>
      <?php } ?>
      </ul>

    <?php
    }

  GLOBAL $stored_items;
  View::newInstance()->_exportVariableToView('items', $global_items);
}


// RELATED ADS
function stela_related_ads() {
  
    $limit = (12);

    $mSearch = new Search();
    $mSearch->addCategory(osc_item_category_id());
    //$mSearch->withPicture(true); 
    $mSearch->limit(1, $limit);
    $mSearch->addItemConditions(sprintf("%st_item.pk_i_id <> %d", DB_TABLE_PREFIX, osc_item_id()));

    $aItems = $mSearch->doSearch(); 


    GLOBAL $global_items;
    $global_items = View::newInstance()->_get('items');
    View::newInstance()->_exportVariableToView('items', $aItems); 

    if(osc_count_items() > 0) {
      ?>
      <div id="related">
    <h2><?php _e('Anunturi asemanatoare', 'related_ads'); ?></h2>
      <ul class="products white slide">
        <?php $c = 1; ?>
        <?php while( osc_has_items() ) { ?>
          <?php stela_draw_item($c, 'gallery'); ?>
          
          <?php $c++; ?>
        <?php } ?>
        </ul>
  </div>
      <?php
      }

    GLOBAL $stored_items;
    View::newInstance()->_exportVariableToView('items', $global_items);
  }

function VinCheck (){
  while( osc_has_item_meta() ){
  if (osc_item_meta_name() == 'Serie sasiu(VIN)'){
   return osc_item_meta_value();
} else {
  return osc_item_meta_name();
}}}
?>