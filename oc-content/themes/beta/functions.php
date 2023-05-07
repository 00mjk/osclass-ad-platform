<?php
define('BETA_THEME_VERSION', '1.0.8');

require_once osc_base_path() . 'oc-content/themes/beta/model/ModelBET.php';


function bet_theme_info() {
  return array(
    'name' => 'Beta Osclass Theme',
    'version' => '1.0.8',
    'description' => 'Responsive fast and clean premium osclass theme',
    'author_name' => 'MB Themes',
    'author_url' => 'https://osclasspoint.com',
    'support_uri' => 'https://forums.osclasspoint.com/beta-osclass-theme/',
    'locations' => array('header', 'footer')
  );
}

define('USER_MENU_ICONS', 1);


// ONLINE CHAT
function bet_chat_button($user_id = '') {
  if(function_exists('oc_chat_button')) {
    $html = '';
    $user_name = '';
    $text = '';
    $title = '';

    if((osc_is_ad_page() || osc_is_search_page()) && $user_id == '') {
      $user_id = osc_item_user_id();
      $user_name = osc_item_contact_name();
    }

    if($user_id <> '' && $user_id > 0) {
      $registered = 1;
      $last_active = ModelOC::newInstance()->getUserLastActive($user_id);
      $user = User::newInstance()->findByPrimaryKey($user_id);
      $user_name = @$user['s_name'];

      $active_limit = osc_get_preference('refresh_user', 'plugin-online_chat');
      $active_limit = ($active_limit > 0 ? $active_limit : 120);
      $active_limit = $active_limit + 10;

      $limit_datetime = date('Y-m-d H:i:s', strtotime(' -' . $active_limit . ' seconds', time()));
    } else {
      $registered = 0;
    }

    if($registered == 1 && $user_id <> osc_logged_user_id() && !oc_check_bans($user_id)) {
      $class = ' oc-active';
    } else {
      $class = ' oc-disabled';
    }

    if(isset($limit_datetime) && $limit_datetime <> '' && $last_active >= $limit_datetime) {
      $class .= ' oc-online';
    } else {
      $class .= ' oc-offline';
    }


    $html .= '<div class="row mob oc-chat-box' . $class . '" data-user-id="' . $user_id . '">';
    $html .= '<i class="fa fa-comment"></i>';



    if($registered == 0) {
      $text .=  __('Chat unavailable', 'beta');
      $title .= __('User is not registered', 'beta');
    } else {
      if($user_id == osc_logged_user_id()) {
        $text .= __('Chat unavailable', 'beta');
        $title .= __('It is your listing', 'beta');
      } else if (oc_check_bans($user_id)) {
        $text .= __('Chat unavailable', 'beta');
        $title .= __('User has blocked you', 'beta');
      } else {
        $text .= '<span class="oc-user-top oc-status-offline">' . __('Chat unavailable (offline)', 'beta') . '</span>';
        //$title .= __('User is offline', 'beta');

        $text .= '<span class="oc-user-top oc-status-online">' . __('Start chat (online)', 'beta') . '</span>';
        //$title .= __('User is online', 'beta');
      }
    }

    $html .= '<a href="#" class="oc-start-chat' . $class . '" data-to-user-id="' . $user_id . '" data-to-user-name="' . osc_esc_html($user_name) . '" data-to-user-image="' . oc_get_picture( $user_id ) . '" title="' . osc_esc_html($title) . '">' . $text . '</a>';

    $html .= '</div>';

    return $html;
  } else {
    return false;
  }
}


// IDENTIFY DEVICE TYPE
function bet_device() {
  $iPod    = stripos($_SERVER['HTTP_USER_AGENT'],"iPod");
  $iPhone  = stripos($_SERVER['HTTP_USER_AGENT'],"iPhone");
  $iPad    = stripos($_SERVER['HTTP_USER_AGENT'],"iPad");
  $Android = stripos($_SERVER['HTTP_USER_AGENT'],"Android");
  $webOS   = stripos($_SERVER['HTTP_USER_AGENT'],"webOS");

  //do something with this information
  if($iPod || $iPhone || $iPad) {
    return 'ios';
  } else if($Android) {
    return 'android';
  } else if($webOS) {
    return 'webos';
  }
}


// MASK EMAIL
function bet_mask_email($email) {
  $em = explode("@",$email);
  $name = implode(array_slice($em, 0, count($em)-1), '@');
  $domain = end($em);


  $len_name = strlen($name)-2;
  $mask_name = substr($name,0, strlen($name) - $len_name) . str_repeat('*', $len_name);
 
  $len_domain = strlen($domain) - 4;
  $mask_domain = str_repeat('*', $len_domain) . substr($domain, $len_domain, strlen($domain));


  return  $mask_name . '@' . $mask_domain;   
}


// PUBLIC PROFILE ITEMS
function bet_public_profile_items() {
  $section = osc_get_osclass_section();  
  if(osc_get_osclass_location() == 'user' && ($section == 'items' || $section == 'pub_profile')) {
    Params::setParam('itemsPerPage', bet_param('public_items'));
  }
}

osc_add_hook('init', 'bet_public_profile_items');


// CHECK IF LAZY LOAD ENABLED
function bet_is_lazy() {
  if(bet_param('lazy_load') == 1 && osc_get_preference('force_aspect_image', 'osclass') == 0) {
    return true;
  }

  return false;
}


// GET NO IMAGE LINK
function bet_get_noimage() {
  $dim = osc_get_preference('dimThumbnail', 'osclass'); 

  if(file_exists(WebThemes::newInstance()->getCurrentThemePath() . 'images/no-image-' . $dim . '.png')) {
    return osc_current_web_theme_url('images/no-image-' . $dim . '.png');
  }

  return osc_current_web_theme_url('images/no-image.png');
}


// RELATED ADS
function bet_related_ads() {
  if(bet_param('related') == 1) {
    $limit = (bet_param('related_count') > 0 ? bet_param('related_count') : 3);

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
      echo '<div class="related products grid">';
      echo '<h3>' . __('You may also like ...', 'beta') . '</h3>';
      echo '<div class="block"><div class="wrap">';

      $c = 1;
      while(osc_has_items()) {
        bet_draw_item($c);
        $c++;
      }

      echo '</div></div></div>';
    }

    GLOBAL $stored_items;
    View::newInstance()->_exportVariableToView('items', $global_items);
  }
}


// GET LOCALE SELECT FOR PUBLISH PAGE
function bet_locale_post_links() {
  $c = osc_current_user_locale();

  $html = '';
  $locales = osc_get_locales();

  if(count($locales) > 0) {
    $html .= '<div class="locale-links">';

    foreach($locales as $l) {
      $html .= '<a href="#" data-locale="' . $l['pk_c_code'] . '" data-name="' . $l['s_name'] . '" class="mbBgActive' . ($c == $l['pk_c_code'] ? ' active' : '') . '">' . $l['s_short_name'] . '</a>';
    }

    $html .= '</div>';
  }

  return $html;
}


// GET PROPER PROFILE IMAGE
function bet_profile_picture($user_id = '', $size = 'small') {
  $user_id = ($user_id > 0 ? $user_id : osc_item_user_id());
  $user_id = ($user_id > 0 ? $user_id : osc_premium_user_id());
  //$user_id = ($user_id > 0 ? $user_id : osc_logged_user_id());

  if($size == 'small') {
    $dimension = 36;
  } else if ($size == 'medium') {
    $dimension = 128;
  } else {
    $dimension = 256;
  }

  $img = '';


  if(function_exists('profile_picture_show')) {
    $conn = getConnection();
    $result = $conn->osc_dbFetchResult("SELECT user_id, pic_ext FROM %st_profile_picture WHERE user_id = '%d' ", DB_TABLE_PREFIX, $user_id);


    if($result > 0) { 
      $path = osc_plugins_path().'profile_picture/images/';

      if(file_exists($path . 'profile' . $user_id . $result['pic_ext'])) { 
        $img = osc_base_url() . 'oc-content/plugins/profile_picture/images/' . 'profile' . $user_id . $result['pic_ext'];
      }
    }
  }

  if($img == '') {
    //$img = osc_current_web_theme_url('images/profile-' . $dimension . '.png');
    $img = osc_current_web_theme_url('images/user.png');
  }

  return $img;
}



// GET SEARCH PARAMS FOR REMOVE
function bet_search_param_remove() {
  $params = Params::getParamsAsArray();
  $output = array();

  foreach($params as $n => $v) {
    if(!in_array($n, array('page')) && ($v > 0 || $v <> '')) {
      $output[$n] = array(
        'value' => $v, 
        'param' => $n,
        'title' => bet_param_name($n),
        'name' => bet_remove_value_name($v, $n)
      );
    }
  }

  return $output;
}


// GET NAME FOR REMOVE PARAMETER
function bet_remove_value_name($value, $type) {
  $def_cur = (bet_param('def_cur') <> '' ? bet_param('def_cur') : '$');

  if($type == 'sPeriod') {  
    return bet_get_simple_name($value, 'period');

  } else if($type == 'sTransaction') {  
    return bet_get_simple_name($value, 'transaction');

  } else if($type == 'sCondition') {  
    return bet_get_simple_name($value, 'condition');

  } else if ($type == 'sCategory' || $type == 'category') {
    if(@osc_search_category_id()[0] > 0) {
      $category = Category::newInstance()->findByPrimaryKey(osc_search_category_id()[0]);
      return $category['s_name'];
    }

  } else if ($type == 'sCountry' || $type == 'country') {
    return osc_search_country();

  } else if ($type == 'sRegion' || $type == 'region') {
    return osc_search_region();

  } else if ($type == 'sCity' || $type == 'city') {
    return osc_search_city();
  
  } else if ($type == 'sPriceMin' || $type == 'sPriceMax') {
    return $value . ' ' . $def_cur;

  } else if ($type == 'sPattern') {
    return $value;

  }  else if ($type == 'user' || $type == 'sUser' || $type == 'userId') {
    if(is_numeric($value)) {
      $usr = User::newInstance()->findByPrimaryKey($value);
      return (@$usr['s_name'] <> '' ? @$usr['s_name'] : $value);
    } else {
      return $value;
    }

  }  else if ($type == 'bPic') {
    return ($value == 1 ? __('Yes', 'beta') : __('No', 'beta'));

  }
}


// GET PARAMETER NICE NAME
function bet_param_name($param) {
  if($param == 'sTransaction') {
    return __('Transaction', 'beta');

  } else if($param == 'sCondition') {
    return __('Condition', 'beta');

  } else if($param == 'user' || $param == 'sUser' || $param == 'userId') {
    return __('User', 'beta');

  } else if($param == 'sCategory' || $param == 'category') {
    return __('Category', 'beta');

  } else if($param == 'sPeriod') {
    return __('Age', 'beta');

  } else if($param == 'sCountry' || $param == 'country') {
    return __('Country', 'beta');

  } else if($param == 'sRegion' || $param == 'region') {
    return __('Region', 'beta');

  } else if($param == 'sCity' || $param == 'city') {
    return __('City', 'beta');

  } else if($param == 'bPic') {
    return __('Picture', 'beta');

  } else if($param == 'sPriceMin') {
    return __('Min', 'beta');

  } else if($param == 'sPriceMax') {
    return __('Max', 'beta');

  } else if($param == 'sPattern') {
    return __('Keyword', 'beta');

  } 

  return '';
}


// LIST AVAILABLE OPTIONS
function bet_list_options($type) {
  $opt = array();

  if($type == 'condition') {
    $opt[0] = __('All', 'beta');
    $opt[1] = __('New', 'beta');
    $opt[2] = __('Used', 'beta');

  } else if($type == 'transaction') {
    $opt[0] = __('All', 'beta');
    $opt[1] = __('Sell', 'beta');
    $opt[2] = __('Buy', 'beta');
    $opt[3] = __('Rent', 'beta');
    $opt[4] = __('Exchange', 'beta');

  } else if ($type == 'period') {
    $opt[0] = __('All', 'beta');
    $opt[1] = __('Yesterday', 'beta');
    $opt[7] = __('Last week', 'beta');
    $opt[14] = __('Last 2 weeks', 'beta');
    $opt[31] = __('Last month', 'beta');
    $opt[365] = __('Last year', 'beta');

  } else if ($type == 'seller_type') {
    $opt[0] = __('All', 'beta');
    $opt[1] = __('Personal', 'beta');
    $opt[2] = __('Company', 'beta');
  }

  return $opt;
}


// GET SIMPLE OPTION NAME
function bet_get_simple_name($id, $type) {
  $options = bet_list_options($type);
  return @$options[$id];
}


// DEFAULT LOCATION PICKER CONTENT
function bet_def_location() {
  $html = '';

  $type = (bet_param('def_locations') == '' ? 'region' : bet_param('def_locations'));

  $countries = Country::newInstance()->listAll();
  $limit = 500;
  $city_not_empty = 0;   // set to 0 to include also cities with no listings

  if($type == 'region') {
    $regions_cities = Region::newInstance()->listAll();
  }

  $type_name = ($type == 'region' ? __('region', 'beta') : __('city', 'beta'));


  foreach($countries as $c) {
    $html .= '<div class="option country init" data-country="' . $c['pk_c_code'] . '" data-region="" data-city="" data-code="country' . $c['pk_c_code'] . '" id="' . $c['pk_c_code'] . '"><strong>' . $c['s_name'] . '</strong></div>';

    if($type == 'city') {
      $regions_cities = ModelBET::newInstance()->getCities($c['pk_c_code'], $limit, $city_not_empty);
    }

    $counter = 0;
    foreach($regions_cities as $r) {
      if($counter < $limit) {
        if(strtoupper($r['fk_c_country_code']) == strtoupper($c['pk_c_code'])) {
          if($type == 'region') {
            $html .= '<div class="option region init" data-country="' . $r['fk_c_country_code'] . '" data-region="' . $r['pk_i_id'] . '" data-city="" data-code="region' . $r['pk_i_id'] . '" id="' . $r['pk_i_id'] . '"><strong>' . $r['s_name'] . '</strong><span>' . $c['s_name'] . '</span></div>';
          } else { 
            $html .= '<div class="option region init" data-country="' . $r['fk_c_country_code'] . '" data-region="' . $r['fk_i_region_id'] . '" data-city="' . $r['pk_i_id'] . '" data-code="city' . $r['pk_i_id'] . '" id="' . $r['pk_i_id'] . '"><strong>' . $r['s_name'] . '</strong><span>' . $r['s_region_name'] . '</span></div>';
          }
        }
      }

      $counter++;
    }

    if($counter == $limit*count($countries)) {
      $html .= '<div class="option service empty-pick default" data-country="" data-region="" data-city="" data-code="" id=""><em>' . sprintf(__('... and %d more %s, enter your %s name to refine results', 'beta'), $limit, $type_name, $type_name) . '</em></div>';
    }
  }

  echo $html;
}


// DEFAULT LOCATION PICKER CONTENT
function bet_locbox_short($country = '', $region = '', $city = '', $level = 'all') {
  $html = '';


  $countries = Country::newInstance()->listAll();
  $box_width = 140;

  // COUNTRIES
  if(count($countries) > 1 && ($level == 'all' || $level == 'country')) {
    $html .= '<div class="loc-tab country-tab count' . count($countries) . (bet_param('loc_one_row') == 1 ? ' one-row' : '') . '">';
    $html .= '<div class="loc-in" style="' . (bet_param('loc_one_row') == 1 ? 'width:' . count($countries)*$box_width . 'px;' : '') . '">';

    foreach($countries as $c) {
      $html .= '<div class="elem country ' . (strtoupper($c['pk_c_code']) == strtoupper($country) ? 'active' : '') . '" data-country="' . $c['pk_c_code'] . '" data-region="" data-city="" style="' . (bet_param('loc_one_row') == 1 ? 'width:' . ($box_width + 1) . 'px;'  : '') . '"><img src="' . osc_current_web_theme_url() . 'images/country_flags/large/' . strtolower($c['pk_c_code']) . '.png"/><strong>' . $c['s_name'] . '</strong></div>';
    }

    $html .= '</div>';
    $html .= '</div>';
  } 

  
  // REGIONS
  if($level == 'all' || $level == 'region') {
    $html .= '<div class="loc-tab region-tab">';
    
    if(count($countries) <= 1 || $country <> '') {
      if($country <> '') {
        $regions = Region::newInstance()->findByCountry($country);
      } else {
        $regions = Region::newInstance()->listAll();
      }

      if(count($regions) > 0) {
        foreach($regions as $r) {
          $html .= '<div class="elem region ' . ($r['pk_i_id'] == $region ? 'active' : '') . '" data-country="' . $r['fk_c_country_code'] . '" data-region="' . $r['pk_i_id'] . '" data-city="">' . $r['s_name'] . ' <i class="fa fa-angle-right"></i></div>';
        }
      }
    }

    $html .= '</div>';
  }


  // CITIES
  if($level == 'all' || $level == 'city') {
    $html .= '<div class="loc-tab city-tab">';
    
    if($region <> '') {
      $cities = City::newInstance()->findByRegion($region);

      if(count($cities) > 0) {
        foreach($cities as $ct) {
          $html .= '<div class="elem city ' . ($ct['pk_i_id'] == $city ? 'active' : '') . '" data-country="' . $ct['fk_c_country_code'] . '" data-region="' . $ct['fk_i_region_id'] . '" data-city="' . $ct['pk_i_id'] . '">' . $ct['s_name'] . ' <i class="fa fa-angle-right"></i></div>';
        }
      }
    }

    $html .= '</div>';
  }


  echo $html;
}


// DEFAULT LOCATION PICKER CONTENT
function bet_catbox_short($cat_id = '') {
  $html = '';
  $level = 1;

  $hierarchy = Category::newInstance()->hierarchy($cat_id);
  $hierarchy = array_column($hierarchy, 'pk_i_id');

  $hierarchy_last_subs = Category::newInstance()->findSubcategoriesEnabled($hierarchy[0]);

  if(count($hierarchy_last_subs) > 0) {
    $hierarchy[] = -1;   // add one fake id to increase number of columns shown
  }

  $categories = Category::newInstance()->toTree();

  bet_catbox_loop($categories, $hierarchy, $level);


  echo $html;
}


function bet_catbox_loop($categories, $hierarchy, $level) {
  $html = '';

  if(count($categories) > 0) {
    $one_row = false;

    if($categories[0]['fk_i_parent_id'] <= 0 && bet_param('cat_one_row') == 1) {
      $one_row = true;
    }

    $box_width = 140;


    $html .= '<div class="cat-tab ' . ($categories[0]['fk_i_parent_id'] <= 0 ? 'root ' . (empty($hierarchy) ? 'active' : '') : 'sub') . ' ' . (in_array($categories[0]['fk_i_parent_id'], $hierarchy) ? 'active' : '') . ($one_row === true ? 'one-row' : '') . '" data-parent="' . $categories[0]['fk_i_parent_id'] . '" data-level="' . $level . '">';
    $html .= '<div class="cat-in" style="' . ($one_row === true ? 'width:' . count($categories)*$box_width . 'px;' : '') . '">';

    foreach($categories as $c) {
      $html .= '<div class="elem category ' . (in_array($c['pk_i_id'], $hierarchy) ? 'active' : '') . ' ' . (count($c['categories']) > 0 ? 'has' : 'blank') . '" data-category="' . $c['pk_i_id'] . '" style="' . ($one_row === true ? 'width:' . ($box_width + 1) . 'px;'  : '') . '">';

      if($c['fk_i_parent_id'] <= 0) {
        $html .= '<div class="img">' . bet_get_cat_icon( $c['pk_i_id'] ) . '</div> <strong>' . $c['s_name'] . '</strong>';
      } else {
        $html .= $c['s_name'] . '<i class="fa fa-angle-right"></i>';
      }


      $html .= '</div>';
    }

    $html .= '</div>';
    $html .= '</div>';

    echo $html;

    if($level == 1) {
      echo '<div class="wrapper" data-columns="' . max(count($hierarchy) - 1, 0) . '">';
    }

    // loop for children separately
    foreach($categories as $c) {
      if(count($c['categories']) > 0) {                // && $level + 1 <= 4
        bet_catbox_loop($c['categories'], $hierarchy, $level + 1);
      }
    }

    if($level == 1) {
      echo '</div>';  // end wrapper
    }
  }



}



// COUNT COUNTRIES
function bet_count_countries() {
  $countries = Country::newInstance()->listAll();
  return count($countries);
}


// GET CORRECT FANCYBOX URL
function bet_fancy_url($type, $params = array()) {
  if(osc_rewrite_enabled()) {
    $url = '?type=' . $type;
  } else {
    $url = '&type=' . $type;
  }

  $extra = '';

  if(!empty($params) && is_array($params)) {
    foreach($params as $n => $v) {
      $extra .= '&' . $n . '=' . $v;
    }
  }

  return bet_item_send_friend_url() . $url . $extra;
}


// CUSTOM SEND FRIEND URL
function bet_item_send_friend_url($item_id = '') {
  if($item_id <= 0) {
    $item_id = (osc_item_id() > 0 ? osc_item_id() : osc_premium_id());
  }

  if(osc_rewrite_enabled()) {
    return osc_base_url() . osc_get_preference('rewrite_item_send_friend') . '/' . $item_id;
  } else {
    return osc_base_url(true)."?page=item&action=send_friend&id=" . $item_id;
  }
}


// GET CORRECT BLOCK ON REGISTER PAGE
function bet_reg_url($type) {
  if(osc_rewrite_enabled()) {
    $reg_url = '?move=' . $type;
  } else {
    $reg_url = '&move=' . $type;
  }

 return osc_register_account_url() . $reg_url;
}


// UPDATE PAGINATION ARROWS
function bet_fix_arrow($data) {
  $data = str_replace('&lt;', '<i class="fa fa-angle-left"></i>', $data);
  $data = str_replace('&gt;', '<i class="fa fa-angle-right"></i>', $data);
  $data = str_replace('&laquo;', '<i class="fa fa-angle-double-left"></i>', $data);
  $data = str_replace('&raquo;', '<i class="fa fa-angle-double-right"></i>', $data);

  return $data;
}


// GET THEME PARAM
function bet_param($name) {
  return osc_get_preference($name, 'theme-beta');
}


// CHECK IF PRICE ENABLED ON CATEGORY
function bet_check_category_price($id) {
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
function bet_is_rtl() {
  $current_lang = strtolower(osc_current_user_locale());

  if(in_array($current_lang, bet_rtl_languages())) {
    return true;
  } else {
    return false;
  }
}


function bet_rtl_languages() {
  $langs = array('ar_DZ','ar_BH','ar_EG','ar_IQ','ar_JO','ar_KW','ar_LY','ar_MA','ar_OM','ar_SA','ar_SY','fa_IR','ar_TN','ar_AE','ar_YE','ar_TD','ar_CO','ar_DJ','ar_ER','ar_MR','ar_SD');
  return array_map('strtolower', $langs);
}


// FLAT CATEGORIES CONTENT (Publish)
function bet_flat_categories() {
  return '<div id="flat-cat-fancy" style="display:none;overflow:hidden;">' . bet_category_loop() . '</div>';
}


// SMART DATE
function bet_smart_date( $time ) {
  $time_diff = round(abs(time() - strtotime( $time )) / 60);
  $time_diff_h = floor($time_diff/60);
  $time_diff_d = floor($time_diff/1440);
  $time_diff_w = floor($time_diff/10080);
  $time_diff_m = floor($time_diff/43200);
  $time_diff_y = floor($time_diff/518400);


  if($time_diff < 2) {
    $time_diff_name = __('minute ago', 'beta');
  } else if ($time_diff < 60) {
    $time_diff_name = sprintf(__('%d minutes ago', 'beta'), $time_diff);
  } else if ($time_diff < 120) {
    $time_diff_name = sprintf(__('%d hour ago', 'beta'), $time_diff_h);
  } else if ($time_diff < 1440) {
    $time_diff_name = sprintf(__('%d hours ago', 'beta'), $time_diff_h);
  } else if ($time_diff < 2880) {
    $time_diff_name = sprintf(__('%d day ago', 'beta'), $time_diff_d);
  } else if ($time_diff < 10080) {
    $time_diff_name = sprintf(__('%d days ago', 'beta'), $time_diff_d);
  } else if ($time_diff < 20160) {
    $time_diff_name = sprintf(__('%d week ago', 'beta'), $time_diff_w);
  } else if ($time_diff < 43200) {
    $time_diff_name = sprintf(__('%d weeks ago', 'beta'), $time_diff_w);
  } else if ($time_diff < 86400) {
    $time_diff_name = sprintf(__('%d month ago', 'beta'), $time_diff_m);
  } else if ($time_diff < 518400) {
    $time_diff_name = sprintf(__('%d months ago', 'beta'), $time_diff_m);
  } else if ($time_diff < 1036800) {
    $time_diff_name = sprintf(__('%d year ago', 'beta'), $time_diff_y);
  } else {
    $time_diff_name = sprintf(__('%d years ago', 'beta'), $time_diff_y);
  }

  return $time_diff_name;
}


// SMART DATE2
function bet_smart_date2( $time ) {
  $time_diff = round(abs(time() - strtotime( $time )) / 60);
  $time_diff_h = floor($time_diff/60);
  $time_diff_d = floor($time_diff/1440);
  $time_diff_w = floor($time_diff/10080);
  $time_diff_m = floor($time_diff/43200);
  $time_diff_y = floor($time_diff/518400);


  if ($time_diff < 10080) {
    $time_diff_name = sprintf(__('%d+ days', 'beta'), $time_diff_d);
  } else if ($time_diff < 20160) {
    $time_diff_name = sprintf(__('%d+ week', 'beta'), $time_diff_w);
  } else if ($time_diff < 43200) {
    $time_diff_name = sprintf(__('%d+ weeks', 'beta'), $time_diff_w);
  } else if ($time_diff < 86400) {
    $time_diff_name = sprintf(__('%d+ month', 'beta'), $time_diff_m);
  } else if ($time_diff < 518400) {
    $time_diff_name = sprintf(__('%d+ months', 'beta'), $time_diff_m);
  } else if ($time_diff < 1036800) {
    $time_diff_name = sprintf(__('%d+ year', 'beta'), $time_diff_y);
  } else {
    $time_diff_name = sprintf(__('%d+ years', 'beta'), $time_diff_y);
  }

  return $time_diff_name;
}




// CHECK IF ITEM MARKED AS SOLD-UNSOLD
function bet_check_sold(){
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
      //Item::newInstance()->dao->update(DB_TABLE_PREFIX.'t_item_beta', array('i_sold' => $status), array('fk_i_item_id' => $item['pk_i_id']));
      $comm->update(DB_TABLE_PREFIX.'t_item_beta', array('i_sold' => $status), array('fk_i_item_id' => $item['pk_i_id']));
 
      if (osc_rewrite_enabled()) {
        $item_type_url = '?itemType=' . $item_type;
      } else {
        $item_type_url = '&itemType=' . $item_type;
      }

      header('Location: ' . osc_user_list_items_url() . $item_type_url);
    }
  }
}

osc_add_hook('header', 'bet_check_sold');



// HELP FUNCTION TO GET CATEGORIES
function bet_category_loop( $parent_id = NULL, $parent_color = NULL ) {
  $parent_color = isset($parent_color) ? $parent_color : NULL;

  if(Params::getParam('sCategory') <> '') {
    $id = Params::getParam('sCategory');
  } else if (bet_get_session('sCategory') <> '' && (osc_is_publish_page() || osc_is_edit_page())) {
    $id = bet_get_session('sCategory');
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
  $html .= '<div class="single info">' . __('Select category', 'beta') . ' ' . ($parent_id <> 0 ? '<span class="back tr1 round2"><i class="fa fa-angle-left"></i> ' . __('Back', 'beta') . '</span>' : '') . '</div>';

  foreach( $categories as $c ) {
    if( $parent_id == 0) {
      $parent_color = bet_get_cat_color( $c['pk_i_id'] );
      $icon = '<div class="parent-icon" style="background:' . bet_get_cat_color( $c['pk_i_id'] ) . ';">' . bet_get_cat_icon( $c['pk_i_id'] ) . '</div>';
    } else {
      $icon = '<div class="parent-icon children" style="background: ' . $parent_color . '">' . bet_get_cat_icon( $c['pk_i_id'] ) . '</div>';
    }
    
    $html .= '<div class="single tr1' . ($c['pk_i_id'] == $id ? ' selected' : '') . '" data-id="' . $c['pk_i_id'] . '"><span>' . $icon . $c['s_name'] . '</span></div>';

    $subcategories = Category::newInstance()->findSubcategoriesEnabled( $c['pk_i_id'] );
    if(isset($subcategories[0])) {
      $html .= bet_category_loop( $c['pk_i_id'], $parent_color );
    }
  }
  
  $html .= '</div>';
  return $html;
}



// FLAT CATEGORIES SELECT (Publish)
function bet_flat_category_select(){  
  $root = Category::newInstance()->findRootCategoriesEnabled();

  $html = '<div class="category-box tr1">';
  foreach( $root as $c ) {
    $html .= '<div class="option tr1" style="background:' . bet_get_cat_color( $c['pk_i_id'] ) . ';">' . bet_get_cat_icon( $c['pk_i_id'] ) . '</div>';
  }
 
  $html .= '</div>';
  return $html;
}



// GET CITY, REGION, COUNTRY FOR AJAX LOADER
function bet_ajax_city() {
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


function bet_ajax_region() {
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


function bet_ajax_country() {
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
function bet_user_menu() {
  $sections = array('items', 'profile', 'logout');

  if(isset($_SERVER['HTTPS'])) {
    $protocol = $_SERVER['HTTPS'] == 'on' ? 'https' : 'http';
  } else {
    $protocol = 'http';
  }

  $current_url =  $protocol.'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];



  $options = array();
  $options[] = array('name' => __('My listings', 'beta'), 'url' => osc_user_list_items_url(), 'class' => 'opt_items', 'icon' => 'fa-folder-o', 'section' => 1, 'count' => 0);
  //$options[] = array('name' => __('Active', 'beta'), 'url' => osc_user_list_items_url() . $s_active, 'class' => 'opt_active_items', 'icon' => 'fa-check-square-o', 'section' => 1, 'count' => $c_active, 'is_active' => $yes_active);
  //$options[] = array('name' => __('Not Validated', 'beta'), 'url' => osc_user_list_items_url() . $s_pending, 'class' => 'opt_not_validated_items', 'icon' => 'fa-stack-overflow', 'section' => 1, 'count' => $c_pending, 'is_active' => $yes_pending);
  //$options[] = array('name' => __('Expired', 'beta'), 'url' => osc_user_list_items_url() . $s_expired, 'class' => 'opt_expired_items', 'icon' => 'fa-times-circle', 'section' => 1, 'count' => $c_expired, 'is_active' => $yes_expired);
  //$options[] = array('name' => __('Dashboard', 'beta'), 'url' => osc_user_dashboard_url(), 'class' => 'opt_dashboard', 'icon' => 'fa-dashboard', 'section' => 2);
  $options[] = array('name' => __('Alerts', 'beta'), 'url' => osc_user_alerts_url(), 'class' => 'opt_alerts', 'icon' => 'fa-bullhorn', 'section' => 2);
  $options[] = array('name' => __('My profile', 'beta'), 'url' => osc_user_profile_url(), 'class' => 'opt_account', 'icon' => 'fa-file-text-o', 'section' => 2);
  $options[] = array('name' => __('Public profile', 'beta'), 'url' => osc_user_public_profile_url(), 'class' => 'opt_publicprofile', 'icon' => 'fa-picture-o', 'section' => 2);
  $options[] = array('name' => __('Logout', 'beta'), 'url' => osc_user_logout_url(), 'class' => 'opt_logout', 'icon' => 'fa-sign-out', 'section' => 3);

  $options = osc_apply_filter('user_menu_filter', $options);


  // SECTION 1 - LISTINGS
  echo '<div class="wrap">';

  echo '<div class="img">';
  echo '<div class="box"><img src="' . bet_profile_picture(osc_logged_user_id(), 'large') . '"/></div><strong>' . sprintf(__('Hi %s!', 'beta'), osc_logged_user_name()) . '</strong>';

  if(function_exists('profile_picture_show')) { 
    echo '<a href="#" class="update-avatar"><i class="fa fa-upload"></i>' . __('Update', 'beta') . '</a>';
  }

  echo '</div>';

  echo '<div class="um s1">';
  echo '<div class="user-menu-header">' . __('My listings', 'beta') . '</div>';
  echo '<ul class="user_menu">';

  foreach($options as $o) {
    if($o['section'] == 1) {
      $o['icon'] = isset($o['icon']) ? ($o['icon'] <> '' ? $o['icon'] : 'fa-dot-circle-o') : 'fa-dot-circle-o';

      if( isset($o['is_active']) && $o['is_active'] == 1 || $current_url == $o['url'] ) {
        $active_class =  ' active';
      } else {
        $active_class = '';
      }

      echo '<li class="' . $o['class'] . $active_class . '" ><a href="' . $o['url'] . '" ><i class="fa ' . $o['icon'] . '"></i>' . $o['name'] . '</a></li>';
    }
  }

  osc_run_hook('user_menu_items');

  echo '</ul>';
  echo '</div>';


  // SECTION 2 - PROFILE & USER
  echo '<div class="um s2">';
  echo '<div class="user-menu-header">' . __('My account', 'beta') . '</div>';
  echo '<ul class="user_menu">';

  foreach($options as $o) {
    if($o['section'] == 2) {
      $active_class = ($current_url == $o['url'] ? ' active' : '');
      $o['icon'] = isset($o['icon']) ? ($o['icon'] <> '' ? $o['icon'] : 'fa-dot-circle-o') : 'fa-dot-circle-o';
      echo '<li class="' . $o['class'] . $active_class . '" ><a href="' . $o['url'] . '" ><i class="fa ' . $o['icon'] . '"></i>' . $o['name'] . '</a></li>';
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
      $o['icon'] = isset($o['icon']) ? ($o['icon'] <> '' ? $o['icon'] : 'fa-dot-circle-o') : 'fa-dot-circle-o';
      echo '<li class="' . $o['class'] . '" ><a href="' . $o['url'] . '" ><i class="fa ' . $o['icon'] . '"></i>' . $o['name'] . '</a></li>';
    }
  }

  echo '</ul>';
  echo '</div>';
  echo '</div>';
}



// GET TERM NAME BASED ON COUNTRY, REGION & CITY
function bet_get_term($term = '', $country = '', $region = '', $city = ''){
  if( $term == '') {
    if( $city <> '' && is_numeric($city) ) {
      $city_info = City::newInstance()->findByPrimaryKey( $city );
      return (isset($city_info['s_name']) ? $city_info['s_name'] : $city);
    }
 
    if( $region <> '' && is_numeric($region) ) {
      $region_info = Region::newInstance()->findByPrimaryKey( $region );
      return (isset($region_info['s_name']) ? $region_info['s_name'] : $region);
    }

    if( $country <> '' && strlen($country) == 2 ) {
      $country_info = Country::newInstance()->findByCode( $country );
      return (isset($country_info['s_name']) ? $country_info['s_name'] : $country);
    }

    $array = array_filter(array($city, $region, $country));
    return @$array[0]; // if all fail, return first non-empty

  } else {
    return $term;
  }
}


// GET LOCATION FULL NAME BASED ON COUNTRY, REGION & CITY
function bet_get_full_loc($country = '', $region = '', $city = ''){
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
function bet_extra_add_admin( $catId = null, $item_id = null ){
  $current_url = ($_SERVER['HTTPS'] == 'on' ? 'https' : 'http').'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
  $admin_url = osc_admin_base_url();

  if (strpos($current_url, $admin_url) !== false) {
    if($item_id > 0) {
      $item = Item::newInstance()->findByPrimaryKey( $item_id );
      $item_extra = bet_item_extra( $item_id );

      echo '<div class="control-group">';
      echo '<label class="control-label" for="sTransaction">' . __('Transaction', 'beta') . '</label>';
      echo '<div class="controls">' . bet_simple_transaction(true, $item_id <> '' ? $item_id : false) . '</div>';
      echo '</div>';

      echo '<div class="control-group">';
      echo '<label class="control-label" for="sCondition">' . __('Condition', 'beta') . '</label>';
      echo '<div class="controls">' . bet_simple_condition(true, $item_id <> '' ? $item_id : false) . '</div>';
      echo '</div>';

      echo '<div class="control-group">';
      echo '<label class="control-label" for="sPhone">' . __('Phone', 'beta') . '</label>';
      echo '<div class="controls"><input type="text" name="sPhone" id="sPhone" value="' . $item_extra['s_phone'] . '" /></div>';
      echo '</div>';

      echo '<div class="control-group">';
      echo '<label class="control-label" for="sSold">' . __('Item Sold', 'beta') . '</label>';
      echo '<div class="controls"><input type="checkbox" name="sSold" id="sSold" ' . ($item_extra['i_sold'] == 1 ? 'checked' : '') . ' /></div>';
      echo '</div>';
    }
  }
}

osc_add_hook('item_form', 'bet_extra_add_admin');
osc_add_hook('item_edit', 'bet_extra_add_admin');



function bet_extra_edit( $item ) {
  $item['pk_i_id'] = isset($item['pk_i_id']) ? $item['pk_i_id'] : 0;
  $detail = ModelAisItem::newInstance()->findByItemId( $item['pk_i_id'] );

  if( isset($detail['fk_i_item_id']) ) {
    ModelAisItem::newInstance()->updateItemMeta( $item['pk_i_id'], Params::getParam('ais_meta_title'), Params::getParam('ais_meta_description') );
  } else {
    ModelAisItem::newInstance()->insertItemMeta( $item['pk_i_id'], Params::getParam('ais_meta_title'), Params::getParam('ais_meta_description') );
  } 
}


// SIMPLE SEARCH SORT
function bet_simple_sort() {
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
function bet_simple_category($select = false, $level = 3, $id = 'sCategory') {
  $categories = Category::newInstance()->toTree();
  $current = @osc_search_category_id()[0];
  $allow_parent = ($id == 'catId' ? osc_get_preference('selectable_parent_categories', 'osclass') : 1);

  if($id == 'catId') {   // publish-edit listing page
    $current = osc_item_category_id();
  }

  $c_category = Category::newInstance()->findByPrimaryKey($current);
  $root = Category::newInstance()->toRootTree($current);
  $root = isset($root[0]) ? $root[0] : array('pk_i_id' => $current, 's_name' => (isset($c_category['s_name']) ? $c_category['s_name'] : ''));


  if(!$select) {

    $html  = '<div class="simple-cat simple-select level' . $level . '">';
    $html .= '<input type="hidden" id="' . $id . '" name="' . $id . '" class="input-hidden ' . $id . '" value="' . $current . '"/>';
    $html .= '<span class="text round3 tr1"><span>' . ($c_category['s_name'] <> '' ? $c_category['s_name'] : __('Category', 'beta')) . '</span> <i class="fa fa-angle-down"></i></span>';
    $html .= '<div class="list">';
    $html .= '<div class="option info">' . __('Choose one category', 'beta') . '</div>';

    if($id <> 'catId') {
      $html .= '<div class="option bold' . ($root['pk_i_id'] == "" ? ' selected' : '') . '" data-id="">' . __('All', 'beta') . '</div>';
    }

    // Root cat
    foreach($categories as $c) {
      $disable = false;
      if($allow_parent == 0 && count(@$c['categories']) > 0) { $disable = true; }

      $html .= '<div class="option ' . ($disable ? 'nonclickable' : '') . ' root' . ($root['pk_i_id'] == $c['pk_i_id'] ? ' selected' : '') . '" data-id="' . $c['pk_i_id'] . '">' . $c['s_name'] . '</span></div>';

      // Sub cat level 1
      if(count(@$c['categories']) > 0 && $level >= 1) { 
        foreach($c['categories'] as $s1) {
          $disable = false;
          if($allow_parent == 0 && count($s1['categories']) > 0) { $disable = true; }

          $html .= '<div class="option ' . ($disable ? 'nonclickable' : '') . ' sub1' . ($current == $s1['pk_i_id'] ? ' selected' : '') . '" data-id="' . $s1['pk_i_id'] . '">' . $s1['s_name'] . '</span></div>';

          // Sub cat level 2
          if(count($s1['categories']) > 0 && $level >= 2) { 
            foreach($s1['categories'] as $s2) {
              $disable = false;
              if($allow_parent == 0 && count($s2['categories']) > 0) { $disable = true; }

              $html .= '<div class="option ' . ($disable ? 'nonclickable' : '') . ' sub2' . ($current == $s2['pk_i_id'] ? ' selected' : '') . '" data-id="' . $s2['pk_i_id'] . '">' . $s2['s_name'] . '</span></div>';

              // Sub cat level 3
              if(count($s2['categories']) > 0 && $level >= 3) { 
                foreach($s2['categories'] as $s3) {
                  $html .= '<div class="option sub3' . ($current == $s3['pk_i_id'] ? ' selected' : '') . '" data-id="' . $s3['pk_i_id'] . '">' . $s3['s_name'] . '</span></div>';
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
    $html  = '<select class="' . $id . '" id="' . $id . '" name="' . $id . '">';
    $html .= '<option value="" ' . ($root['pk_i_id'] == "" ? ' selected="selected"' : '') . '>' . __('All categories', 'beta') . '</option>';

    foreach($categories as $c) {
      $html .= '<option ' . ($root['pk_i_id'] == $c['pk_i_id'] ? ' selected="selected"' : '') . ' value="' . $c['pk_i_id'] . '">' . $c['s_name'] . '</option>';

      // Sub cat level 1
      if(count(@$c['categories']) > 0 && $level >= 1) { 
        foreach($c['categories'] as $s1) {
          $html .= '<option ' . ($current == $s1['pk_i_id'] ? ' selected="selected"' : '') . ' value="' . $s1['pk_i_id'] . '">- ' . $s1['s_name'] . '</option>';

          // Sub cat level 2
          if(count($s1['categories']) > 0 && $level >= 2) { 
            foreach($s1['categories'] as $s2) {
              $html .= '<option ' . ($current == $s2['pk_i_id'] ? ' selected="selected"' : '') . ' value="' . $s2['pk_i_id'] . '">-- ' . $s2['s_name'] . '</option>';

              // Sub cat level 3
              if(count($s2['categories']) > 0 && $level >= 3) { 
                foreach($s2['categories'] as $s3) {
                  $html .= '<option ' . ($current == $s3['pk_i_id'] ? ' selected="selected"' : '') . ' value="' . $s3['pk_i_id'] . '">--- ' . $s3['s_name'] . '</option>';
                }
              }

            }
          }
        }
      }
    }

    $html .= '</select>';

    return $html;

  }
}



// SIMPLE SELLER TYPE SELECT
function bet_simple_seller( $select = false ) {
  $id = Params::getParam('sCompany');

  if($id !== '' && $id !== null) {
    $id_mod = $id + 1;
  } else {
    $id_mod = 0;
  }

  $name = bet_get_simple_name($id_mod, 'seller_type');
  $name = ($name == '' ? __('Seller type', 'beta') : $name);


  if( !$select ) {
    $html  = '<div class="simple-seller simple-select">';
    $html .= '<input type="hidden" name="sCompany" class="input-hidden" value="' . Params::getParam('sCompany') . '"/>';
    $html .= '<span class="text round3 tr1"><span>' . $name . '</span> <i class="fa fa-angle-down"></i></span>';
    $html .= '<div class="list">';
    $html .= '<div class="option info">' . __('Choose seller type', 'beta') . '</div>';
    $html .= '<div class="option bold' . ($id_mod == 0 ? ' selected' : '') . '" data-id="">' . __('All', 'beta') . '</div>';

    $html .= '<div class="option' . ($id_mod == "1" ? ' selected' : '') . '" data-id="0">' . __('Personal', 'beta') . '</span></div>';
    $html .= '<div class="option' . ($id_mod == "2" ? ' selected' : '') . '" data-id="1">' . __('Company', 'beta') . '</span></div>';

    $html .= '</div>';
    $html .= '</div>';

    return $html;

  } else {

    $html  = '<select class="sCompany" id="sCompany" name="sCompany">';
    $html .= '<option value="" ' . ($id_mod == "0" ? ' selected="selected"' : '') . '>' . __('All sellers', 'beta') . '</option>';
    $html .= '<option value="0" ' . ($id_mod == "1" ? ' selected="selected"' : '') . '>' . __('Personal', 'beta') . '</option>';
    $html .= '<option value="1" ' . ($id_mod == "2" ? ' selected="selected"' : '') . '>' . __('Company', 'beta') . '</option>';
    $html .= '</select>';

    return $html;

  }
}



// SIMPLE TRANSACTION TYPE SELECT
function bet_simple_transaction( $select = false, $item_id = false ) {
  if((osc_is_publish_page() || osc_is_edit_page()) && bet_get_session('sTransaction') <> '') {
    $id = bet_get_session('sTransaction');
  } else {
    $id = Params::getParam('sTransaction');
  }

  if( $item_id == '' ) {
    $item_id = osc_item_id();
  }

  if( $item_id > 0 ) {
    $id = bet_item_extra( $item_id );
    $id = $id['i_transaction'];
  }

  $name = bet_get_simple_name($id, 'transaction');
  $name = ($name == '' ? __('Transaction', 'beta') : $name);

  $options =  bet_list_options('transaction');


  if( !$select ) {
    $html  = '<div class="simple-transaction simple-select">';
    $html .= '<input type="hidden" name="sTransaction" class="input-hidden" value="' . $id . '"/>';
    $html .= '<span class="text round3 tr1"><span>' . $name . '</span> <i class="fa fa-angle-down"></i></span>';
    $html .= '<div class="list">';
    $html .= '<div class="option info">' . __('Choose transaction type', 'beta') . '</div>';

    foreach($options as $n => $v) {
      $html .= '<div class="option ' . ($n == 0 ? 'bold' : '') . ($id == $n ? ' selected' : '') . '" data-id="' . $n . '">' . $v . '</span></div>';
    }

    $html .= '</div>';
    $html .= '</div>';

    return $html;

  } else {

    $html  = '<select class="sTransaction" id="sTransaction" name="sTransaction">';

    foreach($options as $n => $v) {
      $html .= '<option value="' . $n . '" ' . ($id == $n ? ' selected="selected"' : '') . '>' . $v . '</option>';
    }

    $html .= '</select>';

    return $html;

  }
}



// SIMPLE OFFER TYPE SELECT
function bet_simple_condition( $select = false, $item_id = false ) {
  if((osc_is_publish_page() || osc_is_edit_page()) && bet_get_session('sCondition') <> '') {
    $id = bet_get_session('sCondition');
  } else {
    $id = Params::getParam('sCondition');
  }

  if( $item_id == '' ) {
    $item_id = osc_item_id();
  }

  if( $item_id > 0 ) {
    $id = bet_item_extra( $item_id );
    $id = $id['i_condition'];
  }

  $name = bet_get_simple_name($id, 'condition');
  $name = ($name == '' ? __('Condition', 'beta') : $name);

  $options =  bet_list_options('condition');


  if( !$select ) {
    $html  = '<div class="simple-condition simple-select">';
    $html .= '<input type="hidden" name="sCondition" class="input-hidden" value="' . $id . '"/>';
    $html .= '<span class="text round3 tr1"><span>' . $name . '</span> <i class="fa fa-angle-down"></i></span>';
    $html .= '<div class="list">';
    $html .= '<div class="option info">' . __('Choose condition of item', 'beta') . '</div>';

    foreach($options as $n => $v) {
      $html .= '<div class="option ' . ($n == 0 ? 'bold' : '') . ($id == $n ? ' selected' : '') . '" data-id="' . $n . '">' . $v . '</span></div>';
    }

    $html .= '</div>';
    $html .= '</div>';

    return $html;

  } else {

    $html  = '<select class="sCondition" id="sCondition" name="sCondition">';

    foreach($options as $n => $v) {
      $html .= '<option value="' . $n . '" ' . ($id == $n ? ' selected="selected"' : '') . '>' . $v . '</option>';
    }

    $html .= '</select>';

    return $html;

  }
}



// SIMPLE CURRENCY SELECT (publish)
function bet_simple_currency() {
  $currencies = osc_get_currencies();
  $item = osc_item(); 

  if((osc_is_publish_page() || osc_is_edit_page()) && bet_get_session('currency') <> '') {
    $id = bet_get_session('currency');
  } else {
    $id = Params::getParam('currency');
  }

  $currency = $id <> '' ? $id : osc_get_preference('currency', 'osclass');

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

  $html  = '<div class="simple-currency simple-select">';
  $html .= '<input type="hidden" name="currency" id="currency" class="input-hidden" value="' . $default_currency['pk_c_code'] . '"/>';
  $html .= '<span class="text round3 tr1"><span>' . $default_currency['pk_c_code'] . ' (' . $default_currency['s_description'] . ')</span> <i class="fa fa-angle-down"></i></span>';
  $html .= '<div class="list">';
  $html .= '<div class="option info">' . __('Currency', 'beta') . '</div>';

  foreach($currencies as $c) {
    $html .= '<div class="option' . ($c['pk_c_code'] == $default_key ? ' selected' : '') . '" data-id="' . $c['pk_c_code'] . '">' . $c['pk_c_code'] . ' (' . $c['s_description'] . ')</span></div>';
  }

  $html .= '</div>';
  $html .= '</div>';

  return $html;
}



// SIMPLE PRICE TYPE SELECT (publish)
function bet_simple_price_type() {
  $item = osc_item(); 

  // Item edit
  if( isset($item['i_price']) ) {
    if( $item['i_price'] > 0 ) {
      $default_key = 0;
      $default_name = '<i class="fa fa-pencil help"></i> ' . __('Enter price', 'beta');
    } else if( $item['i_price'] == 0 ) {
      $default_key = 1;
      $default_name = '<i class="fa fa-cut help"></i> ' . __('Free', 'beta');
    } else if( $item['i_price'] == '' ) {
      $default_key = 2;
      $default_name = '<i class="fa fa-phone help"></i> ' . __('Check with seller', 'beta');
    } 
  
  // Item publish
  } else {
    $default_key = 0;
    $default_name = '<i class="fa fa-pencil help"></i> ' . __('Enter price', 'beta');
  }


  $html  = '<div class="simple-price-type simple-select">';
  $html .= '<span class="text round3 tr1"><span>' . $default_name . '</span> <i class="fa fa-angle-down"></i></span>';
  $html .= '<div class="list">';
  $html .= '<div class="option info">' . __('Choose price type', 'beta') . '</div>';

  $html .= '<div class="option' . ($default_key == 0 ? ' selected' : '') . '" data-id="0"><i class="fa fa-pencil help"></i> ' . __('Enter price', 'beta') . '</span></div>';
  $html .= '<div class="option' . ($default_key == 1 ? ' selected' : '') . '" data-id="1"><i class="fa fa-cut help"></i> ' . __('Free', 'beta') . '</span></div>';
  $html .= '<div class="option' . ($default_key == 2 ? ' selected' : '') . '" data-id="2"><i class="fa fa-phone help"></i> ' . __('Check with seller', 'beta') . '</span></div>';

  $html .= '</div>';
  $html .= '</div>';

  return $html;
}


// SIMPLE PERIOD SELECT (search only)
function bet_simple_period( $select = false ) {
  $id = Params::getParam('sPeriod');

  $name = bet_get_simple_name($id, 'period');
  $name = ($name == '' ? __('Age', 'beta') : $name);

  $options =  bet_list_options('period');


  if( !$select ) {
    $html  = '<div class="simple-period simple-select">';
    $html .= '<input type="hidden" name="sPeriod" class="input-hidden" value="' . $id . '"/>';
    $html .= '<span class="text round3 tr1"><span>' . $name . '</span> <i class="fa fa-angle-down"></i></span>';
    $html .= '<div class="list">';
    $html .= '<div class="option info">' . __('Choose period', 'beta') . '</div>';

    foreach($options as $n => $v) {
      $html .= '<div class="option ' . ($n == 0 ? 'bold' : '') . ($id == $n ? ' selected' : '') . '" data-id="' . $n . '">' . $v . '</span></div>';
    }

    $html .= '</div>';
    $html .= '</div>';

    return $html;

  } else {

    $html  = '<select class="sPeriod" id="sPeriod" name="sPeriod">';

    foreach($options as $n => $v) {
      $html .= '<option value="" ' . ($id == $n ? ' selected="selected"' : '') . '>' . $v . '</option>';
    }

    $html .= '</select>';

    return $html;

  }
}


// SIMPLE PERIOD LIST
function bet_simple_period_list() {
  $id = Params::getParam('sPeriod');

  $name = bet_get_simple_name($id, 'period');
  $name = ($name == '' ? __('Age', 'beta') : $name);

  $options =  bet_list_options('period');
  $params = bet_search_params_all();


  $html  = '<div class="simple-period simple-list">';
  $html .= '<input type="hidden" name="sPeriod" class="input-hidden" value="' . $id . '"/>';

  $html .= '<div class="list link-check-box">';

  foreach($options as $n => $v) {
    $params['sPeriod'] = $n;
    $html .= '<a href="' . osc_search_url($params) . '" ' . ($id == $n ? 'class="active"' : '') . ' data-name="sPeriod" data-val="' . $n . '">' . $v . '</a>';
  }

  $html .= '</div>';
  $html .= '</div>';

  return $html;
}


// SIMPLE TRANSACTION LIST
function bet_simple_transaction_list() {
  $id = Params::getParam('sTransaction');

  $name = bet_get_simple_name($id, 'transaction');
  $name = ($name == '' ? __('Transaction', 'beta') : $name);

  $options =  bet_list_options('transaction');
  $params = bet_search_params_all();


  $html  = '<div class="simple-transaction simple-list">';
  $html .= '<input type="hidden" name="sTransaction" class="input-hidden" value="' . $id . '"/>';

  $html .= '<div class="list link-check-box">';

  foreach($options as $n => $v) {
    $params['sTransaction'] = $n;
    $html .= '<a href="' . osc_search_url($params) . '" ' . ($id == $n ? 'class="active"' : '') . ' data-name="sTransaction" data-val="' . $n . '">' . $v . '</a>';
  }

  $html .= '</div>';
  $html .= '</div>';

  return $html;
}


// SIMPLE CONDITION LIST
function bet_simple_condition_list() {
  $id = Params::getParam('sCondition');

  $name = bet_get_simple_name($id, 'condition');
  $name = ($name == '' ? __('Condition', 'beta') : $name);

  $options =  bet_list_options('condition');
  $params = bet_search_params_all();


  $html  = '<div class="simple-condition simple-list">';
  $html .= '<input type="hidden" name="sCondition" class="input-hidden" value="' . $id . '"/>';

  $html .= '<div class="list link-check-box">';

  foreach($options as $n => $v) {
    $params['sCondition'] = $n;
    $html .= '<a href="' . osc_search_url($params) . '" ' . ($id == $n ? 'class="active"' : '') . ' data-name="sCondition" data-val="' . $n . '">' . $v . '</a>';
  }

  $html .= '</div>';
  $html .= '</div>';

  return $html;
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


// FIND ROOT CATEGORY OF SELECTED
function bet_category_root( $category_id ) {
  $category = Category::newInstance()->findRootCategory( $category_id );
  return $category;
}


// CHECK IF THEME IS DEMO
function bet_is_demo() {
  if(isset($_SERVER['HTTP_HOST']) && (strpos($_SERVER['HTTP_HOST'],'mb-themes') !== false || strpos($_SERVER['HTTP_HOST'],'abprofitrade') !== false)) {
    return true;
  } else {
    return false;
  }
}

// CREATE ITEM (in loop)
function bet_draw_item($c = NULL, $premium = false, $class = false) {
  if($premium){
    $filename ='loop-single-premium';
  } else {
    $filename = 'loop-single';
  }

  require WebThemes::newInstance()->getCurrentThemePath() . $filename . '.php';
}



// RANDOM LATEST ITEMS ON HOME PAGE
function bet_random_items($numItems = 10, $category = array(), $withPicture = false) {
  $max_items = osc_get_preference('maxLatestItems@home', 'osclass');

  if($max_items == '' or $max_items == 0) {
    $max_items = 24;
  }

  $numItems = $max_items;

  $withPicture = bet_param('latest_picture');
  $randomOrder = bet_param('latest_random');
  $premiums = bet_param('latest_premium');
  $category = bet_param('latest_category');



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



// ITEM LOOP FORMAT LOCATION
function bet_item_location($premium = false) {
  if(!$premium) {
    $loc = array_filter(array(osc_item_city(), (osc_item_city() == '' ? osc_item_region() : ''), osc_item_country_code()));
  } else {
    $loc = array_filter(array(osc_premium_city(), (osc_premium_city() == '' ? osc_premium_region() : ''), osc_premium_country_code()));
  }

  return implode(', ', $loc);
}


// LOCATION FORMATER - USED ON SEARCH LIST
function bet_location_format($country = null, $region = null, $city = null) { 
  if($country <> '') {
    if(strlen($country) == 2) {
      $country_full = Country::newInstance()->findByCode($country);
    } else {
      $country_full = Country::newInstance()->findByName($country);
    }

    if($region <> '') {
      if($city <> '') {
        return $city . ' ' . __('in', 'beta') . ' ' . $region . ($country_full['s_name'] <> '' ? ' (' . $country_full['s_name'] . ')' : '');
      } else {
        return $region . ' (' . $country_full['s_name'] . ')';
      }
    } else { 
      if($city <> '') {
        return $city . ' ' . __('in', 'beta') . ' ' . $country_full['s_name'];
      } else {
        return $country_full['s_name'];
      }
    }
  } else {
    if($region <> '') {
      if($city <> '') {
        return $city . ' ' . __('in', 'beta') . ' ' . $region;
      } else {
        return $region;
      }
    } else { 
      if($city <> '') {
        return $city;
      } else {
        return __('Location not entered', 'beta');
      }
    }
  }
}



function mb_filter_extend() {
  // SEARCH - ALL - INDIVIDUAL - COMPANY TYPE
  Search::newInstance()->addJoinTable( DB_TABLE_PREFIX.'t_item_beta.fk_i_item_id', DB_TABLE_PREFIX.'t_item_beta', DB_TABLE_PREFIX.'t_item.pk_i_id = '.DB_TABLE_PREFIX.'t_item_beta.fk_i_item_id', 'LEFT OUTER' ) ; // Mod


  // SEARCH - TRANSACTION
  if(Params::getParam('sTransaction') > 0) {
    Search::newInstance()->addConditions(sprintf("%st_item_beta.i_transaction = %d", DB_TABLE_PREFIX, Params::getParam('sTransaction')));
  }


  // SEARCH - CONDITION
  if(Params::getParam('sCondition') > 0) {
    Search::newInstance()->addConditions(sprintf("%st_item_beta.i_condition = %d", DB_TABLE_PREFIX, Params::getParam('sCondition')));
  }


  // SEARCH - PERIOD
  if(Params::getParam('sPeriod') > 0) {
    $date_from = date('Y-m-d', strtotime(' -' . Params::getParam('sPeriod') . ' day', time()));
    Search::newInstance()->addConditions(sprintf('cast(%st_item.dt_pub_date as date) > "%s"', DB_TABLE_PREFIX, $date_from));
  }

  // SEARCH - USER ID
  if(Params::getParam('userId') > 0) {
    Search::newInstance()->addConditions(sprintf("%st_item.fk_i_user_id = %d", DB_TABLE_PREFIX, Params::getParam('userId')));
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



// GET SELECTED SEARCH PARAMETERS
function bet_search_params() {
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


// GET ALL PARAMS
function bet_search_params_all() {
  $params = Params::getParamsAsArray();
  unset($params['iPage']);
  return $params;
}


// FIND MAXIMUM PRICE
function bet_max_price($cat_id = null, $country_code = null, $region_id = null, $city_id = null) {
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
    'max_currency' => bet_param('def_cur')
  );
}


// CHECK IF AJAX IMAGE UPLOAD ON PUBLISH-EDIT PAGE CAN BE USED (from osclass 3.3)
function bet_ajax_image_upload() {
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
function bet_premium_formated_price($price = null) {
  if($price == '') {
    $price = osc_premium_price();
  }

  return (string) bet_premium_format_price($price);
}

function bet_premium_format_price($price, $symbol = null) {
  if ($price === null) return osc_apply_filter ('item_price_null', __('Check with seller', 'beta') );
  if ($price == 0) return osc_apply_filter ('item_price_zero', __('Free', 'beta') );

  if($symbol==null) { $symbol = osc_premium_currency_symbol(); }

  $price = $price/1000000;

  $currencyFormat = osc_locale_currency_format();
  $currencyFormat = str_replace('{NUMBER}', number_format($price, osc_locale_num_dec(), osc_locale_dec_point(), osc_locale_thousands_sep()), $currencyFormat);
  $currencyFormat = str_replace('{CURRENCY}', $symbol, $currencyFormat);
  return osc_apply_filter('premium_price', $currencyFormat );
}


function bet_ajax_item_format_price($price, $symbol_code) {
  if ($price === null) return __('Check with seller', 'beta');
  if ($price == 0) return __('Free', 'beta');
  return round($price/1000000, 2) . ' ' . $symbol_code;
}



AdminMenu::newInstance()->add_menu(__('Theme Setting', 'beta'), osc_admin_render_theme_url('oc-content/themes/beta/admin/header.php'), 'beta_menu');
AdminMenu::newInstance()->add_submenu_divider('beta_menu', __('Theme Settings', 'beta'), 'beta_submenu');
AdminMenu::newInstance()->add_submenu('beta_menu', __('Configure', 'beta'), osc_admin_render_theme_url('oc-content/themes/beta/admin/configure.php'), 'settings_beta1');
AdminMenu::newInstance()->add_submenu('beta_menu', __('Advertisement', 'beta'), osc_admin_render_theme_url('oc-content/themes/beta/admin/banner.php'), 'settings_beta2');
AdminMenu::newInstance()->add_submenu('beta_menu', __('Category Icons', 'beta'), osc_admin_render_theme_url('oc-content/themes/beta/admin/category.php'), 'settings_beta3');
AdminMenu::newInstance()->add_submenu('beta_menu', __('Logo', 'beta'), osc_admin_render_theme_url('oc-content/themes/beta/admin/header.php'), 'settings_beta4');
AdminMenu::newInstance()->add_submenu('beta_menu', __('Plugins', 'beta'), osc_admin_render_theme_url('oc-content/themes/beta/admin/plugins.php'), 'settings_beta5');


if( !function_exists('logo_header') ) {
  function logo_header() {
    $html = '<img border="0" alt="' . osc_esc_html(osc_page_title()) . '" src="' . osc_current_web_theme_url('images/logo.jpg') . '" />';
    if(file_exists(WebThemes::newInstance()->getCurrentThemePath() . 'images/logo.jpg')) {
      return $html;
    } else if( bet_param('default_logo') && (file_exists( WebThemes::newInstance()->getCurrentThemePath() . 'images/default-logo.jpg')) ) {
      return '<img border="0" alt="' . osc_esc_html(osc_page_title()) . '" src="' . osc_current_web_theme_url('images/default-logo.jpg') . '" />';
    } else {
      return osc_page_title();
    }
  }
}


// INSTALL & UPDATE OPTIONS
if(!function_exists('bet_theme_install')) {
  $themeInfo = bet_theme_info();

  function bet_theme_install() {
    osc_set_preference('version', BETA_THEME_VERSION, 'theme-beta');
    osc_set_preference('color', '#e74c3c', 'theme-beta');
    osc_set_preference('site_phone', '+1 (800) 228-5651', 'theme-beta');
    osc_set_preference('date_format', 'mm/dd', 'theme-beta');
    osc_set_preference('cat_icons', '0', 'theme-beta');
    osc_set_preference('footer_link', '1', 'theme-beta');
    osc_set_preference('default_logo', '1', 'theme-beta');
    osc_set_preference('def_cur', '$', 'theme-beta');
    osc_set_preference('def_view', '0', 'theme-beta');
    osc_set_preference('website_name', 'BetaTheme', 'theme-beta');
    osc_set_preference('latest_picture', '0', 'theme-beta');
    osc_set_preference('latest_random', '1', 'theme-beta');
    osc_set_preference('latest_premium', '0', 'theme-beta');
    osc_set_preference('latest_category', '', 'theme-beta');
    osc_set_preference('publish_category', '4', 'theme-beta');
    osc_set_preference('premium_home', '1', 'theme-beta');
    osc_set_preference('premium_search', '1', 'theme-beta');
    osc_set_preference('premium_home_count', '12', 'theme-beta');
    osc_set_preference('premium_search_count', '3', 'theme-beta');
    osc_set_preference('search_ajax', '1', 'theme-beta');
    osc_set_preference('forms_ajax', '1', 'theme-beta');
    osc_set_preference('post_required', '', 'theme-beta');
    osc_set_preference('post_extra_exclude', '', 'theme-beta');
    osc_set_preference('home_layout', 't', 'theme-beta');
    osc_set_preference('favorite_home', '1', 'theme-beta');
    osc_set_preference('blog_home', '1', 'theme-beta');
    osc_set_preference('company_home', '1', 'theme-beta');
    osc_set_preference('company_home_count', '8', 'theme-beta');
    osc_set_preference('banners', '0', 'theme-beta');
    osc_set_preference('lazy_load', '0', 'theme-beta');
    osc_set_preference('public_items', '24', 'theme-beta');
    osc_set_preference('preview', '1', 'theme-beta');
    osc_set_preference('related', '1', 'theme-beta');
    osc_set_preference('related_count', '6', 'theme-beta');
    osc_set_preference('def_locations', 'region', 'theme-beta');
    osc_set_preference('promote_home', 1, 'theme-beta');
    osc_set_preference('stats_home', 1, 'theme-beta');


    /* Banners */
    if(function_exists('beta_banner_list')) {
      foreach(bet_banner_list() as $b) {
        osc_set_preference($b['id'], '', 'theme-beta');
      }
    }

    osc_reset_preferences();

    bet_add_item_fields();  // add extra item fiels into database
  }
}


if(!function_exists('check_install_bet_theme')) {
  function check_install_bet_theme() {
    $current_version = bet_param('version');

    if( !$current_version ) {
      bet_theme_install();
    }
  }
}

check_install_bet_theme();


// WHEN NEW LISTING IS CREATED, ADD IT TO BETA EXTRA TABLE
function bet_new_item_extra($item) {
  $conn = DBConnectionClass::newInstance();
  $data = $conn->getOsclassDb();
  $comm = new DBCommandClass($data);
  $db_prefix = DB_TABLE_PREFIX;

  $query = "INSERT INTO {$db_prefix}t_item_beta (fk_i_item_id) VALUES ({$item['pk_i_id']})";
  $result = $comm->query($query);
}

osc_add_hook('posted_item', 'bet_new_item_extra', 1);


// WHEN NEW CATEGORY IS CREATED, ADD IT TO BETA EXTRA TABLE
function bet_new_category_extra() {

  $conn = DBConnectionClass::newInstance();
  $data = $conn->getOsclassDb();
  $comm = new DBCommandClass($data);
  $db_prefix = DB_TABLE_PREFIX;

  $query = "INSERT INTO {$db_prefix}t_category_beta (fk_i_category_id) 
            SELECT c.pk_i_id FROM {$db_prefix}t_category c WHERE c.pk_i_id NOT IN (SELECT d.fk_i_category_id FROM {$db_prefix}t_category_beta d)";
  $result = $comm->query($query);
}

osc_add_hook('footer', 'bet_new_category_extra');



// USER MENU FIX
function bet_user_menu_fix() {
  $user = User::newInstance()->findByPrimaryKey(osc_logged_user_id());
  View::newInstance()->_exportVariableToView('user', $user);
}

osc_add_hook('header', 'bet_user_menu_fix');



// ADD THEME COLUMNS INTO ITEM TABLE
function bet_add_item_fields() {
  ModelBET::newInstance()->install();
}



// UPDATE THEME COLS ON ITEM POST-EDIT
function bet_update_fields($item) {
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

  Item::newInstance()->dao->update(DB_TABLE_PREFIX.'t_item_beta', $fields, array('fk_i_item_id' => $item['pk_i_id']));
}

osc_add_hook('posted_item', 'bet_update_fields', 1);
osc_add_hook('edited_item', 'bet_update_fields', 1);


// GET BETA ITEM EXTRA VALUES
function bet_item_extra($item_id) {
  if($item_id > 0) {
    $db_prefix = DB_TABLE_PREFIX;

    $query = "SELECT * FROM {$db_prefix}t_item_beta s WHERE fk_i_item_id = " . $item_id . ";";
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


// GET BETA CATEGORY EXTRA VALUES
function bet_category_extra($category_id) {
  if($category_id > 0) {
    $db_prefix = DB_TABLE_PREFIX;

    $query = "SELECT * FROM {$db_prefix}t_category_beta s WHERE fk_i_category_id = " . $category_id . ";";
    $result = Category::newInstance()->dao->query($query);
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
function bet_post_preserve() {
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

osc_add_hook('pre_item_post', 'bet_post_preserve');


// DROP VALUES OF INPUTS ON SUCCESSFUL PUBLISH
function bet_post_drop() {
  Session::newInstance()->_dropKeepForm('sPhone');
  Session::newInstance()->_dropKeepForm('term');
  Session::newInstance()->_dropKeepForm('zip');
  Session::newInstance()->_dropKeepForm('sCondition');
  Session::newInstance()->_dropKeepForm('sTransaction');

  Session::newInstance()->_clearVariables();
}

osc_add_hook('posted_item', 'bet_post_drop');



// GET VALUES FROM SESSION ON PUBLISH PAGE
function bet_get_session( $param ) {
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
function bet_default_icons() {
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


function bet_default_colors() {
  $colors = array(1 => '#F44336', 2 => '#00BCD4', 3 => '#009688', 4 => '#FDE74C', 5 => '#8BC34A', 6 => '#D32F2F', 7 => '#2196F3', 8 => '#777', 999 => '#F44336');
  return $colors;
}


function bet_get_cat_icon( $id, $string = false ) {
  $category = Category::newInstance()->findByPrimaryKey( $id );
  $category_extra = bet_category_extra($id);
  $default_icons = bet_default_icons();

  if(bet_param('cat_icons') == 1) { 
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
      if(file_exists(osc_base_path() . 'oc-content/themes/beta/images/small_cat/' . $category['pk_i_id'] . '.png')) {
        return '<img src="' . osc_current_web_theme_url() . 'images/small_cat/' . $category['pk_i_id'] . '.png" />';
      } else {
        return '<img src="' . osc_current_web_theme_url() . 'images/small_cat/default.png" />';
      }
    }
  }

  if($string) {
    
  } else {
    return $icon;
  }
}


function bet_get_cat_color( $id ) {
  $category = Category::newInstance()->findByPrimaryKey( $id );
  $category_extra = bet_category_extra($id);
  $default_colors = bet_default_colors();

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
function bet_increase_clicks($itemId, $itemUserId = NULL) {
  if($itemId > 0) {
    if($itemUserId == '' || $itemUserId == 0 || ($itemUserId <> '' && $itemUserId > 0 && $itemUserId <> osc_logged_user_id())) {
      $db_prefix = DB_TABLE_PREFIX;
      $query = 'INSERT INTO ' . $db_prefix . 't_item_stats_beta (fk_i_item_id, dt_date, i_num_phone_clicks) VALUES (' . $itemId . ', "' . date('Y-m-d') . '", 1) ON DUPLICATE KEY UPDATE  i_num_phone_clicks = i_num_phone_clicks + 1';
      return ItemStats::newInstance()->dao->query($query);
    }
  }
}


// FIX ADMIN MENU LIST WITH THEME OPTIONS
function bet_admin_menu_fix(){
  echo '<style>' . PHP_EOL;
  echo 'body.compact #beta_menu .ico-beta_menu {bottom:-6px!important;width:50px!important;height:50px!important;margin:0!important;background:#fff url(' . osc_base_url() . 'oc-content/themes/beta/images/favicons/favicon-32x32.png) no-repeat center center !important;}' . PHP_EOL;
  echo 'body.compact #beta_menu .ico-beta_menu:hover {background-color:rgba(255,255,255,0.95)!important;}' . PHP_EOL;
  echo 'body.compact #menu_beta_menu > h3 {bottom:0!important;}' . PHP_EOL;
  echo 'body.compact #menu_beta_menu > ul {border-top-left-radius:0px!important;margin-top:1px!important;}' . PHP_EOL;
  echo 'body.compact #menu_beta_menu.current:after {content:"";display:block;width:6px;height:6px;border-radius:10px;box-shadow:1px 1px 3px rgba(0,0,0,0.1);position:absolute;left:3px;bottom:3px;background:#03a9f4}' . PHP_EOL;
  echo 'body:not(.compact) #beta_menu .ico-beta_menu {background:transparent url(' . osc_base_url() . 'oc-content/themes/beta/images/favicons/favicon-32x32.png) no-repeat center center !important;}' . PHP_EOL;
  echo '</style>' . PHP_EOL;
}

osc_add_hook('admin_header', 'bet_admin_menu_fix');



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
function bet_ajax_url() {
  $url = osc_contact_url();

  if (osc_rewrite_enabled()) {
    $url .= '?ajaxRequest=1';
  } else {
    $url .= '&ajaxRequest=1';
  }

  return $url;
}


// COUNT PHONE CLICKS ON ITEM
function bet_phone_clicks( $item_id ) {
  if( $item_id <> '' ) {
    $db_prefix = DB_TABLE_PREFIX;

    $query = "SELECT sum(coalesce(i_num_phone_clicks, 0)) as phone_clicks FROM {$db_prefix}t_item_stats_beta s WHERE fk_i_item_id = " . $item_id . ";";
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
function bet_show_recaptcha( $section = '' ){
  if(function_exists('anr_get_option')) {
    if(anr_get_option('site_key') <> '') {
      if($section <> 'login') {
        osc_run_hook("anr_captcha_form_field");
      } else {
        // plugin sections are: login, registration, new, contact, contact_listing, send_friend, comment
        if($section == 'login' && anr_get_option('login') == "1") {
          osc_run_hook("anr_captcha_form_field");
        }
      }
    }
  } else {
    if(osc_recaptcha_public_key() <> '') {
      if(((osc_is_publish_page() || osc_is_edit_page()) && osc_recaptcha_items_enabled()) || (!osc_is_publish_page() && !osc_is_edit_page()) ) {
        osc_show_recaptcha($section);
      }
    }
  }
}


// SHOW BANNER
function bet_banner( $location ) {
  $html = '';

  if(bet_param('banners') == 1) {
    if( bet_is_demo() ) {
      $class = ' is-demo';
    } else {
      $class = '';
    }

    if(bet_param('banner_' . $location) == '') {
      $blank = ' blank';
    } else {
      $blank = '';
    }

    if( bet_is_demo() && bet_param('banner_' . $location) == '' ) {
      $title = ' title="' . __('You can define your own banner code from theme settings', 'beta') . '"';
    } else {
      $title = '';
    }

    $html .= '<div id="banner-theme" class="banner-theme banner-' . $location . ' not767' . $class . $blank . '"' . $title . '><div>';
    $html .= bet_param('banner_' . $location);

    if( bet_is_demo() && bet_param('banner_' . $location) == '' ) {
      $html .= __('Advertisement space', 'beta') . ' &lt;' . $location . '&gt;&#x200E;';
    }

    $html .= '</div></div>';

    return $html;
  } else {
    return false;
  }
}


function bet_banner_list() {
  $list = array(
    array('id' => 'banner_home_top', 'position' => __('Top of home page', 'beta')),
    array('id' => 'banner_home_bottom', 'position' => __('Bottom of home page', 'beta')),
    array('id' => 'banner_search_sidebar', 'position' => __('Bottom of search sidebar', 'beta')),
    array('id' => 'banner_search_top', 'position' => __('Top of search page', 'beta')),
    array('id' => 'banner_search_bottom', 'position' => __('Bottom of search page', 'beta')),
    array('id' => 'banner_search_middle', 'position' => __('Between listings', 'beta')),
    array('id' => 'banner_item_top', 'position' => __('Top of item page', 'beta')),
    array('id' => 'banner_item_bottom', 'position' => __('Bottom of item page', 'beta')),
    array('id' => 'banner_item_sidebar', 'position' => __('Middle of item sidebar', 'beta')),
    array('id' => 'banner_item_sidebar_bottom', 'position' => __('Bottom of item sidebar', 'beta')),
    array('id' => 'banner_item_description', 'position' => __('Under item description', 'beta')),
    array('id' => 'public_profile_sidebar', 'position' => __('Public profile sidebar', 'beta')),
    array('id' => 'public_profile_bottom', 'position' => __('Public profile under items', 'beta'))


  );

  return $list;
}


function bet_extra_fields_hide() {
  $list = trim(bet_param('post_extra_exclude'));
  $array = explode(',', $list);
  $array = array_map('trim', $array);
  $array = array_filter($array);

  if(!empty($array) && count($array) > 0) {
    return $array;
  } else {
    return array();
  }
}


// DISABLE ERROR404 ON SEARCH PAGE WHEN NO ITEMS FOUND
function bet_disable_404() {
  if(osc_is_search_page() && osc_count_items() <= 0) {
    if(http_response_code() == 404) {
      http_response_code(200);
    }
  }
}

osc_add_hook('header', 'bet_disable_404');


// THEME PARAMS UPDATE
if(!function_exists('bet_param_update')) {
  function bet_param_update( $param_name, $update_param_name, $type = NULL, $plugin_var_name ) {
  
    $val = '';
    if( $type == 'check') {

      // Checkbox input
      if( Params::getParam( $param_name ) == 'on' ) {
        $val = 1;
      } else {
        if( Params::getParam( $update_param_name ) == 'done' ) {
          $val = 0;
        } else {
          $val = ( osc_get_preference( $param_name, $plugin_var_name ) != '' ) ? osc_get_preference( $param_name, $plugin_var_name ) : '';
        }
      }

    } else if ($type == 'code') {

      if( Params::getParam( $update_param_name ) == 'done' && Params::existParam($param_name)) {
        $val = stripslashes(Params::getParam( $param_name, false, false ));
      } else {
        $val = ( osc_get_preference( $param_name, $plugin_var_name) != '' ) ? stripslashes(osc_get_preference( $param_name, $plugin_var_name )) : '';
      }

    } else {

      // Other inputs (text, password, ...)
      if( Params::getParam( $update_param_name ) == 'done' && Params::existParam($param_name)) {
        $val = Params::getParam( $param_name );
      } else {
        $val = ( osc_get_preference( $param_name, $plugin_var_name) != '' ) ? osc_get_preference( $param_name, $plugin_var_name ) : '';
      }
    }


    // If save button was pressed, update param
    if( Params::getParam( $update_param_name ) == 'done' ) {

      if(osc_get_preference( $param_name, $plugin_var_name ) == '') {
        osc_set_preference( $param_name, $val, $plugin_var_name, 'STRING');  
      } else {
        $dao_preference = new Preference();
        $dao_preference->update( array( "s_value" => $val ), array( "s_section" => $plugin_var_name, "s_name" => $param_name ));
        osc_reset_preferences();
        unset($dao_preference);
      }
    }

    return $val;
  }
}



// MULTI-LEVEL CATEGORIES SELECT
function bet_cat_tree() {
  $array = array();
  $root = Category::newInstance()->findRootCategoriesEnabled();

  $i = 0;
  foreach($root as $c) {
    $array[$i] = array('pk_i_id' => $c['pk_i_id'], 's_name' => $c['s_name']);
    $array[$i]['sub'] = bet_cat_sub($c['pk_i_id']);
    $i++;
  }

  return $array;
}


function bet_cat_sub($id) {
  $array = array();
  $cats = Category::newInstance()->findSubcategories($id);

  if($cats && count($cats) > 0) {
    $i = 0;
    foreach($cats as $c) {
      $array[$i] = array('pk_i_id' => $c['pk_i_id'], 's_name' => $c['s_name']);
      $array[$i]['sub'] = bet_cat_sub($c['pk_i_id']);
      $i++;
    }
  }
      
  return $array;
}


function bet_cat_list($selected = array(), $categories = '', $level = 0) {
  if($categories == '') {
    $categories = bet_cat_tree();
  }

  foreach($categories as $c) {
    echo '<option value="' . $c['pk_i_id'] . '" ' . (in_array($c['pk_i_id'], $selected) ? 'selected="selected"' : '') . '>' . str_repeat('-', $level) . ($level > 0 ? ' ' : '') . $c['s_name'] . '</option>';

    if(isset($c['sub']) && count($c['sub']) > 0) {
      bet_cat_list($selected, $c['sub'], $level + 1);
    }
  }
}


if (!function_exists('array_column')) {
  function array_column(array $input, $columnKey, $indexKey = null) {
    $array = array();
    foreach ($input as $value) {
      if ( !array_key_exists($columnKey, $value)) {
        trigger_error("Key \"$columnKey\" does not exist in array");
        return false;
      }
      if (is_null($indexKey)) {
        $array[] = $value[$columnKey];
      }
      else {
        if ( !array_key_exists($indexKey, $value)) {
          trigger_error("Key \"$indexKey\" does not exist in array");
          return false;
        }
        if ( ! is_scalar($value[$indexKey])) {
          trigger_error("Key \"$indexKey\" does not contain scalar value");
          return false;
        }
        $array[$value[$indexKey]] = $value[$columnKey];
      }
    }
    return $array;
  }
}


if (!function_exists('osc_count_cities')) {
  function osc_count_cities($region = '%%%%') {
    if ( !View::newInstance()->_exists('cities') ) {
      View::newInstance()->_exportVariableToView('cities', Search::newInstance()->listCities($region, ">=", "city_name ASC" ) ) ;
    }

    return View::newInstance()->_count('cities') ;
  }
}

?>