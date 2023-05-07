<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="<?php echo str_replace('_', '-', osc_current_user_locale()); ?>">
<head>
  <?php osc_current_web_theme_path('head.php') ; ?>
  <meta name="robots" content="noindex, nofollow" />
  <meta name="googlebot" content="noindex, nofollow" />
</head>

<body id="body-user-alerts" class="body-ua">
  <?php osc_current_web_theme_path('header.php') ; ?>
  <div class="inside user_account">
    <div class="user-menu-wrap">
      <div class="user-button isMobile">
        <div class="lns"><span class="ln ln1"></span><span class="ln ln2"></span><span class="ln ln3"></span></div>
        <span><?php _e('Menu', 'beta'); ?></span>
        <i class="fa fa-angle-down"></i>
      </div>

      <div id="user-menu" class="sc-block">
        <?php echo bet_user_menu(); ?>
        <?php if(function_exists('profile_picture_upload')) { profile_picture_upload(); } ?>
      </div>
    </div>

    <div id="main" class="alerts">
      <h1><?php _e('My alerts', 'beta'); ?></h1>

      <div class="inside">
        <?php if(osc_count_alerts() > 0) { ?>

          <?php $c = 1; ?>
          <?php while(osc_has_alerts()) { ?>
            <?php 
              // PARAMETERS IN ALERT: price_min, price_max, aCategories, city_areas, cities, regions, countries, sPattern
              $alert_details = View::newInstance()->_current('alerts');
              $alert_details = (array)json_decode($alert_details['s_search']);


              // CONNECTION & DB INFO
              $conn = DBConnectionClass::newInstance();
              $data = $conn->getOsclassDb();
              $comm = new DBCommandClass($data);
              $db_prefix = DB_TABLE_PREFIX;


              // COUNTRIES
              $c_filter = $alert_details['countries'];
              $c_filter = isset($c_filter[0]) ? $c_filter[0] : '';
              $c_filter = str_replace('item_location.fk_c_country_code', 'country.pk_c_code', $c_filter);

              $c_query = "SELECT * FROM {$db_prefix}t_country WHERE " . $c_filter;
              $c_result = $comm->query($c_query);

              if( !$c_result ) { 
                $c_prepare = array();
              } else {
                $c_prepare = $c_result->result();
              }
     

              // REGIONS
              $r_filter = $alert_details['regions'];
              $r_filter = isset($r_filter[0]) ? $r_filter[0] : '';
              $r_filter = str_replace('item_location.fk_i_region_id', 'region.pk_i_id', $r_filter);

              $r_query = "SELECT * FROM {$db_prefix}t_region WHERE " . $r_filter;
              $r_result = $comm->query($r_query);

              if( !$r_result ) { 
                $r_prepare = array();
              } else {
                $r_prepare = $r_result->result();
              }


              // CITIES
              $t_filter = $alert_details['cities'];
              $t_filter = isset($t_filter[0]) ? $t_filter[0] : '';
              $t_filter = str_replace('item_location.fk_i_city_id', 'city.pk_i_id', $t_filter);

              $t_query = "SELECT * FROM {$db_prefix}t_city WHERE " . $t_filter;
              $t_result = $comm->query($t_query);

              if( !$t_result ) { 
                $t_prepare = array();
              } else {
                $t_prepare = $t_result->result();
              }


              // CATEGORIES
              $cat_list = $alert_details['aCategories'];
              $cat_list = implode(', ', $cat_list);
              $locale = '"' . osc_current_user_locale() . '"';

              $cat_query = "SELECT * FROM {$db_prefix}t_category_description WHERE fk_i_category_id IN (" . $cat_list . ") AND fk_c_locale_code = " . $locale;
              $cat_result = $comm->query($cat_query);

              if( !$cat_result ) { 
                $cat_prepare = array();
              } else {
                $cat_prepare = $cat_result->result();
              }
            ?>

            <div class="alert" >
              <div class="top">
                <span class="menu">
                  <strong><?php echo __('Alert', 'beta') . ' #' . $c; ?></strong>
                  <span><?php echo osc_count_items(); ?> <?php echo (osc_count_items() == 1 ? __('item found', 'beta') : __('items found', 'beta')); ?></span>
                </span>
                <a class="btn mbBg" onclick="javascript:return confirm('<?php echo osc_esc_js(__('This action can\'t be undone. Are you sure you want to continue?', 'beta')); ?>');" href="<?php echo osc_user_unsubscribe_alert_url(); ?>"><span><?php _e('Unsubscribe', 'beta'); ?></span></a>
              </div>

              <div class="param">
                <div class="elem w33 <?php if($alert_details['sPattern'] == '') { ?>no-entry<?php } ?>">
                  <div class="left"><?php _e('Pattern', 'beta'); ?></div>
                  <div class="right"><?php if($alert_details['sPattern'] == '') { echo '--'; } else { echo $alert_details['sPattern']; } ?></div>
                </div>

                <div class="elem w33 <?php if($alert_details['price_min'] == 0) { ?>no-entry<?php } ?>">
                  <div class="left"><?php _e('Min. price', 'beta'); ?></div>
                  <div class="right"><?php if($alert_details['price_min'] == 0) { echo '--'; } else { echo $alert_details['price_min'] . bet_param('def_cur'); } ?></div>
                </div>

                <div class="elem w33 <?php if($alert_details['price_max'] == 0) { ?>no-entry<?php } ?>">
                  <div class="left"><?php _e('Max. price', 'beta'); ?></div>
                  <div class="right"><?php if($alert_details['price_max'] == 0) { echo '--'; } else { echo $alert_details['price_max'] . bet_param('def_cur'); } ?></div>
                </div>

                <div class="elem w33 <?php if($alert_details['countries'] == '' or empty($c_prepare)) { ?>no-entry<?php } ?>">
                  <div class="left"><?php _e('Country', 'beta'); ?></div>
                  <div class="right">
                    <?php 
                      if($alert_details['countries'] == '' or empty($c_prepare)) { 
                        echo '--'; 
                      } else { 
                        $i = 0;
                        foreach($c_prepare as $country) {
                          echo $country['s_name'];

                          if($i < count($c_prepare) - 1) {
                            echo ', ';
                          }

                          $i++;
                        }
                      } 
                    ?>
                  </div>
                </div>

                <div class="elem w33 <?php if($alert_details['regions'] == '' or empty($r_prepare)) { ?>no-entry<?php } ?>">
                  <div class="left"><?php _e('Region', 'beta'); ?></div>
                  <div class="right">
                    <?php 
                      if($alert_details['regions'] == '' or empty($r_prepare)) { 
                        echo '--'; 
                      } else { 
                        $i = 0;
                        foreach($r_prepare as $region) {
                          echo $region['s_name'];

                          if($i < count($r_prepare) - 1) {
                            echo ', ';
                          }

                          $i++;
                        }
                      } 
                    ?>
                  </div>
                </div>

                <div class="elem w33 <?php if($alert_details['cities'] == '' or empty($t_prepare)) { ?>no-entry<?php } ?>">
                  <div class="left"><?php _e('City', 'beta'); ?></div>
                  <div class="right">
                    <?php 
                      if($alert_details['cities'] == '' or empty($t_prepare)) { 
                        echo '--'; 
                      } else { 
                        $i = 0;
                        foreach($t_prepare as $city) {
                          echo $city['s_name'];

                          if($i < count($t_prepare) - 1) {
                            echo ', ';
                          }

                          $i++;
                        }
                      } 
                    ?>
                  </div>
                </div>

                <div class="elem w100 <?php if($alert_details['aCategories'] == '' or empty($cat_prepare)) { ?>no-entry<?php } ?>">
                  <div class="left"><?php _e('Categories', 'beta'); ?></div>
                  <div class="right">
                    <?php 
                      $cats = '';
                      if($alert_details['aCategories'] == '' or empty($cat_prepare)) { 
                        $cats .= '--'; 

                      } else { 
                        $i = 0;
                        foreach($cat_prepare as $category) {
                          $cats .= $category['s_name'];

                          if($i < count($cat_prepare) - 1) {
                            $cats .= ', ';
                          }

                          $i++;
                        }
                      } 
                    ?>

                    <span title="<?php echo $cats; ?>"><?php echo osc_highlight($cats, 80); ?></span>
                  </div>
                </div>

                <div class="elem warn"><?php _e('Note that not all conditions are listed, only base alert conditions are shown.', 'beta'); ?></div>
              </div>

              <div id="alert-items" class="products list">
              <?php while(osc_has_items()) { ?>
                <?php echo bet_draw_item(); ?> 
              <?php } ?>

              <?php if(osc_count_items() == 0) { ?>
                <div class="ua-alert-items-empty ua-alerts"><span><?php _e('No listings match to alert criteria.', 'beta'); ?></span></div>
              <?php } ?>
              </div>
            </div>
            <?php $c++; ?>
          <?php } ?>

        <?php } else { ?>
          <div class="ua-items-empty"><img src="<?php echo osc_current_web_theme_url('images/ua-empty.jpg'); ?>"/> <span><?php _e('You have no active alerts', 'beta'); ?></span></div>
        <?php  } ?>
      </div>
    </div>
  </div>

  <?php osc_current_web_theme_path('footer.php') ; ?>
</body>
</html>