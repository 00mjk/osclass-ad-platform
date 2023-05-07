<?php
// ************************************************** //
// ** AJAX CALLS HAS BEEN MOVED TO USER LOGIN PAGE ** //
// ************************************************** //

define('ABS_PATH', dirname(dirname(dirname(dirname(__FILE__)))) . '/');
require_once ABS_PATH . 'oc-load.php';
require_once ABS_PATH . 'oc-content/themes/stela/functions.php';


// GET LOCATIONS FOR LOCATION PICKER VIA AJAX
if(isset($_GET['ajaxLoc']) && $_GET['ajaxLoc'] == '1' && isset($_GET['term']) && $_GET['term'] <> '') {
  $term = $_GET['term'];
  $max = 12;

  $sql = '
    (SELECT "country" as type, s_name as name, null as name_top, null as city_id, null as region_id, pk_c_code as country_code  FROM ' . DB_TABLE_PREFIX . 't_country WHERE s_name like "' . $term . '%")
    UNION ALL
    (SELECT "region" as type, s_name as name, null as name_top, null as city_id, pk_i_id  as region_id, fk_c_country_code as country_code  FROM ' . DB_TABLE_PREFIX . 't_region WHERE s_name like "' . $term . '%")
    UNION ALL
    (SELECT "city" as type, c.s_name as name, r.s_name as name_top, c.pk_i_id as city_id, c.fk_i_region_id as region_id, c.fk_c_country_code as country_code  FROM ' . DB_TABLE_PREFIX . 't_city c, ' . DB_TABLE_PREFIX . 't_region r WHERE c.s_name like "' . $term . '%" AND c.fk_i_region_id = r.pk_i_id limit ' . $max . ')
    UNION ALL
    (SELECT "city_more" as type, count(pk_i_id) - ' . $max . ' as name, null as name_top, null as city_id, null as region_id, null as country_code  FROM ' . DB_TABLE_PREFIX . 't_city WHERE s_name like "' . $term . '%")
  ';

  $result = City::newInstance()->dao->query($sql);

  if( !$result ) { 
    $prepare = array(); 
  } else {
    $prepare = $result->result();
  }

  echo json_encode($prepare);
}


// CLEAR COOKIES VIA AJAX
if(isset($_GET['clearCookieAll']) && $_GET['clearCookieAll'] == 'done') {
  mb_set_cookie('stela-sCategory', '');
  //mb_set_cookie('stela-sPattern', '');
  //mb_set_cookie('stela-sPriceMin', '');
  //mb_set_cookie('stela-sPriceMax', '');
  mb_set_cookie('stela-sCountry', '');
  mb_set_cookie('stela-sRegion', '');
  mb_set_cookie('stela-sCity', '');
}



// GET ITEMS FOR AUTOCOMPLETE VIA AJAX
if(isset($_GET['ajaxItem']) && $_GET['ajaxItem'] == '1' && isset($_GET['pattern']) && $_GET['pattern'] <> '') {
  $pattern = $_GET['pattern'];
  $max = 12;

  $db_prefix = DB_TABLE_PREFIX;
  $sql = "
    SELECT i.pk_i_id, d.s_title, i.i_price, i.fk_c_currency_code, CONCAT(r.s_path, r.pk_i_id,'_thumbnail.',r.s_extension) as image_url
    FROM {$db_prefix}t_item i
    INNER JOIN {$db_prefix}t_item_description d
    ON d.fk_i_item_id = i.pk_i_id
    LEFT OUTER JOIN {$db_prefix}t_item_resource r
    ON r.fk_i_item_id = i.pk_i_id AND r.pk_i_id = (
      SELECT rs.pk_i_id
      FROM {$db_prefix}t_item_resource rs
      WHERE i.pk_i_id = rs.fk_i_item_id
      LIMIT 1
    )

    WHERE d.fk_c_locale_code = '" . osc_current_user_locale() . "' AND (s_title LIKE '%" . $pattern . "%' OR s_description LIKE '%" . $pattern . "%') 
    ORDER BY dt_pub_date DESC
    LIMIT " . $max . ";
  ";

  $result = Item::newInstance()->dao->query($sql);

  if( !$result ) { 
    $prepare = array(); 
  } else {
    $prepare = $result->result();
  }

  foreach( $prepare as $i => $p ) {
    $prepare[$i]['s_title'] = str_ireplace($pattern, '<b>' . $pattern . '</b>', $prepare[$i]['s_title']);
    $prepare[$i]['i_price'] = stela_ajax_item_format_price($prepare[$i]['i_price'], $prepare[$i]['fk_c_currency_code']);
    $prepare[$i]['item_url'] = osc_item_url_ns($prepare[$i]['pk_i_id']);
    if($prepare[$i]['image_url'] <> '') {
      $prepare[$i]['image_url'] = osc_base_url() . $prepare[$i]['image_url'];
    } else {
      $prepare[$i]['image_url'] = osc_current_web_theme_url('images/no-image.png');
    }
  }

  echo json_encode($prepare);
}



// INCREASE CLICK COUNT ON PHONE NUMBER
if(isset($_GET['ajaxPhoneClick']) && $_GET['ajaxPhoneClick'] == '1' && isset($_GET['itemId']) && $_GET['itemId'] > 0) {
  stela_increase_clicks($_GET['itemId'], $_GET['itemUserId']);
  echo 1;
}


//echo 'test string';
?>