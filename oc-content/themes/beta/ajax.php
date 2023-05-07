<?php
// GET LOCATIONS SMART SELECT
if(@$_GET['ajaxLoc2'] == '1') {

  $level = 'all';
  $level = ($_GET['country'] <> '' ? 'region' : $level);
  $level = ($_GET['region'] <> '' ? 'city' : $level);
 
  echo bet_locbox_short($_GET['country'], $_GET['region'], $_GET['city'], $level);
  exit;
}



// GET LOCATIONS FOR LOCATION PICKER VIA AJAX
if(@$_GET['ajaxLoc'] == '1' && @$_GET['term'] <> '') {
  $term = $_GET['term'];
  $max = 50;

  $sql = '
    (SELECT "country" as type, s_name as name, null as name_top, null as city_id, null as region_id, pk_c_code as country_code  FROM ' . DB_TABLE_PREFIX . 't_country WHERE s_name like "' . $term . '%")
    UNION ALL
    (SELECT "region" as type, r.s_name as name, c.s_name as name_top, null as city_id, r.pk_i_id  as region_id, r.fk_c_country_code as country_code  FROM ' . DB_TABLE_PREFIX . 't_region r, ' . DB_TABLE_PREFIX . 't_country c WHERE r.fk_c_country_code = c.pk_c_code AND r.s_name like "' . $term . '%")
    UNION ALL
    (SELECT "city" as type, c.s_name as name, concat(r.s_name, concat(", ", upper(c.fk_c_country_code))) as name_top, c.pk_i_id as city_id, c.fk_i_region_id as region_id, c.fk_c_country_code as country_code  FROM ' . DB_TABLE_PREFIX . 't_city c, ' . DB_TABLE_PREFIX . 't_region r WHERE c.s_name like "' . $term . '%" AND c.fk_i_region_id = r.pk_i_id limit ' . $max . ')
  ';

  $result = City::newInstance()->dao->query($sql);

  if( !$result ) { 
    $prepare = array(); 
  } else {
    $prepare = $result->result();
  }

  echo json_encode($prepare);
  exit;
}


// GET LATEST SEARCH MATCHING
if(@$_GET['ajaxQuery'] == '1' && isset($_GET['pattern'])) {
  $max = 8;
  $db_prefix = DB_TABLE_PREFIX;
  $pattern = strtolower($_GET['pattern']);

  if($_GET['pattern'] <> '') {
    $sql = "SELECT DISTINCT lower(s_search) as s_search FROM {$db_prefix}t_latest_searches WHERE lower(s_search) LIKE '%" . $pattern . "%' AND length(s_search) < 50 ORDER BY d_date DESC LIMIT {$max}";
  } else {
    $sql = "SELECT DISTINCT lower(s_search) as s_search FROM {$db_prefix}t_latest_searches WHERE length(s_search) < 50 ORDER BY d_date DESC LIMIT {$max}";
  }
  
  $result = City::newInstance()->dao->query($sql);

  $prepare = array(); 

  if($result) { 
    $data = $result->result();
    $prepare = array();

    foreach($data as $d) {
      $row = array(
        'string' => osc_esc_html($d['s_search']),
        'string_hash' => md5($d['s_search']),
        'string_format' => str_ireplace($pattern, '<b>' . $pattern . '</b>', $d['s_search'])
      );

      $prepare[] = $row;
    }
  }

  echo json_encode($prepare);
  exit;
}


// GET ITEMS FOR AUTOCOMPLETE VIA AJAX
if(@$_GET['ajaxItem'] == '1' && @$_GET['sPattern'] <> '') {
  $pattern = $_GET['sPattern'];
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

    WHERE d.fk_c_locale_code = '" . osc_current_user_locale() . "' AND (s_title LIKE '%" . $pattern . "%' OR s_description LIKE '%" . $pattern . "%') AND b_active = 1 AND b_enabled = 1 AND b_spam = 0
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
    $prepare[$i]['i_price'] = bet_ajax_item_format_price($prepare[$i]['i_price'], $prepare[$i]['fk_c_currency_code']);
    $prepare[$i]['item_url'] = osc_item_url_ns($prepare[$i]['pk_i_id']);
    if($prepare[$i]['image_url'] <> '') {
      $prepare[$i]['image_url'] = osc_base_url() . $prepare[$i]['image_url'];
    } else {
      $prepare[$i]['image_url'] = osc_current_web_theme_url('images/no-image.png');
    }
  }

  echo json_encode($prepare);
  exit;
}



// INCREASE CLICK COUNT ON PHONE NUMBER
if(@$_GET['ajaxPhoneClick'] == '1' && @$_GET['itemId'] > 0) {
  bet_increase_clicks($_GET['itemId'], $_GET['itemUserId']);
  echo 1;
  exit;
}

?>