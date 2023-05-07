<?php
  $locales = __get('locales');
  $user = osc_user();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="<?php echo str_replace('_', '-', osc_current_user_locale()); ?>">
<head>
  <?php osc_current_web_theme_path('head.php') ; ?>
  <meta name="robots" content="noindex, nofollow" />
  <meta name="googlebot" content="noindex, nofollow" />
</head>
<body id="body-user-alerts" class="body-ua">
  <?php osc_current_web_theme_path('header.php') ; ?>
  <div class="content user_account">
    <div id="sidebar" class="sc-block">
      <?php echo stela_user_menu(); ?>
      
<a class="btn-remove-account btn" style="width:100%;" href="<?php echo osc_base_url(true).'?page=user&action=delete&id='.osc_user_id().'&secret='.$user['s_secret']; ?>" onclick="return confirm('<?php echo osc_esc_js(__('Esti sigur ca doresti sa stergi contul? ', 'stela')); ?>?')"><span><i class="fa fa-times"></i> <?php _e('Sterge contul', 'stela'); ?></span></a>
    </div>

    <div id="main" class="alerts">
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

            <div class="userItem" >
              <div class="hed">
                <span><?php echo osc_count_items(); ?> <?php echo __('result(s)', 'stela'); ?></span>
                <a class="tr1 has-tooltip" onclick="javascript:return confirm('<?php echo osc_esc_js(__('This action can\'t be undone. Are you sure you want to continue?', 'stela')); ?>');" href="<?php echo osc_user_unsubscribe_alert_url(); ?>" title="<?php echo osc_esc_html(__('Unsubscribe', 'stela')); ?>"><i class="fa fa-unlink"></i></a>
              </div>

              <div class="hed-param">
                <div class="elem <?php if($alert_details['sPattern'] == '') { ?>no-entry<?php } ?>">
                  <div class="left"><?php _e('Cautare', 'stela'); ?>:</div>
                  <div class="right"><?php if($alert_details['sPattern'] == '') { _e('None', 'stela'); } else { echo $alert_details['sPattern']; } ?></div>
                </div>

                <div class="elem <?php if($alert_details['price_min'] == 0) { ?>no-entry<?php } ?>">
                  <div class="left"><?php _e('Min. price', 'stela'); ?>:</div>
                  <div class="right"><?php if($alert_details['price_min'] == 0) { _e('None', 'stela'); } else { echo $alert_details['price_min'] . osc_get_preference('def_cur', 'stela_theme'); } ?></div>
                </div>

                <div class="elem <?php if($alert_details['price_max'] == 0) { ?>no-entry<?php } ?>">
                  <div class="left"><?php _e('Max. price', 'stela'); ?>:</div>
                  <div class="right"><?php if($alert_details['price_max'] == 0) { _e('None', 'stela'); } else { echo $alert_details['price_max'] . osc_get_preference('def_cur', 'stela_theme'); } ?></div>
                </div>

                <div class="elem <?php if($alert_details['countries'] == '' or empty($c_prepare)) { ?>no-entry<?php } ?>">
                  <div class="left"><?php _e('Country', 'stela'); ?>:</div>
                  <div class="right">
                    <?php 
                      if($alert_details['countries'] == '' || empty($c_prepare)) { 
                        _e('All', 'stela');
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

                <div class="elem <?php if($alert_details['regions'] == '' or empty($r_prepare)) { ?>no-entry<?php } ?>">
                  <div class="left"><?php _e('Region', 'stela'); ?>:</div>
                  <div class="right">
                    <?php 
                      if($alert_details['regions'] == '' || empty($r_prepare)) { 
                        _e('All', 'stela');
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

                <div class="elem <?php if($alert_details['cities'] == '' or empty($t_prepare)) { ?>no-entry<?php } ?>">
                  <div class="left"><?php _e('City', 'stela'); ?>:</div>
                  <div class="right">
                    <?php 
                      if($alert_details['cities'] == '' || empty($t_prepare)) { 
                        _e('All', 'stela');
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

                <div class="elem <?php if($alert_details['aCategories'] == '' or empty($cat_prepare)) { ?>no-entry<?php } ?>">
                  <div class="left"><?php _e('Categories', 'stela'); ?>:</div>
                  <div class="right">
                    <?php 
                      if($alert_details['aCategories'] == '' || empty($cat_prepare)) { 
                        _e('All', 'stela');
                      } else { 
                        $i = 0;
                        foreach($cat_prepare as $category) {
                          echo $category['s_name'];

                          if($i < count($cat_prepare) - 1) {
                            echo ', ';
                          }

                          $i++;
                        }
                      } 
                    ?>
                  </div>
                </div>
              </div>

              <div id="alerts_list" >
              <?php while(osc_has_items()) { ?>
                <?php 
                  $item_extra = stela_item_extra( osc_item_id() ); 

                  $root = stela_category_root( osc_item_category_id() ); 
                  $cat_icon = stela_get_cat_icon( $root['pk_i_id'], true );
                  if( $cat_icon <> '' ) {
                    $icon = $cat_icon;
                  } else {
                    $def_icons = array(1 => 'fa-gavel', 2 => 'fa-car', 3 => 'fa-book', 4 => 'fa-home', 5 => 'fa-wrench', 6 => 'fa-music', 7 => 'fa-heart', 8 => 'fa-briefcase', 999 => 'fa-soccer-ball-o');
                    $icon = $def_icons[$root['pk_i_id']];
                  }

                  $location = array_filter(array(osc_item_city() <> '' ? osc_item_city() : osc_item_region() ,osc_item_country_code()));
                  $location = implode(', ', $location);
                ?>

                <div class="item-entry round3 tr1">
                  <?php if( osc_images_enabled_at_items() ) { ?>
                    <?php if(osc_count_item_resources()) { ?>
                      <a class="photo tr1" href="<?php echo osc_item_url(); ?>"><img class="tr1" src="<?php echo osc_resource_thumbnail_url(); ?>" width="150" height="125" title="<?php echo osc_esc_html(osc_item_title()); ?>" alt="<?php echo osc_esc_html(osc_item_title()); ?>" /></a>
                    <?php } else { ?>
                      <a class="photo tr1" href="<?php echo osc_item_url(); ?>"><img class="tr1" src="<?php echo osc_current_web_theme_url('images/no-image.png'); ?>" title="<?php echo osc_esc_html(__('No picture', 'stela')); ?>" alt="<?php echo osc_esc_html(__('No picture', 'stela')); ?>" width="150" height="125"/></a>
                    <?php } ?>
                  <?php } ?>

                  <div class="data-wrap">
                    <a class="title" href="<?php echo osc_item_url(); ?>"><?php echo osc_item_title(); ?></a>

                    <?php if( osc_price_enabled_at_items() ) { ?>
                      <div class="price"><span><?php echo osc_item_formated_price(); ?></span></div>
                    <?php } ?>

                    <div class="middle">
                      <?php if(osc_item_total_comments() > 0) { ?>
                        <?php if(osc_item_total_comments() == 1) { ?>
                          <div class="comment"><?php echo sprintf(__('%d review', 'stela'), osc_item_total_comments()); ?></div>
                        <?php } else { ?>
                          <div class="comment"><?php echo sprintf(__('%d reviews', 'stela'), osc_item_total_comments()); ?></div>
                        <?php } ?>
                      <?php } ?>

                      <div class="category"><a href="<?php echo osc_search_url(array('sCategory' => osc_item_category_id())); ?>"><i class="fa <?php echo $icon; ?>"></i><span><?php echo osc_item_category(); ?></span></a></div>

                      <?php if($location <> '') { ?>
                        <div class="location has-tooltip" title="<?php echo osc_esc_html(__('Location', 'stela')); ?>"><?php echo $location; ?></div>
                      <?php } ?>

                      <div class="published has-tooltip" title="<?php echo osc_esc_html(__('Publish date', 'stela')); ?>"><?php echo date('Y/m/d', strtotime(osc_item_pub_date())); ?></div>

                      <?php if(!in_array(osc_item_category_id(), stela_extra_fields_hide())) { ?>
                        <?php if(stela_condition_name($item_extra['i_condition'])) { ?>
                          <div class="condition has-tooltip" title="<?php echo osc_esc_html(__('Condition', 'stela')); ?>"><span><?php echo stela_condition_name($item_extra['i_condition']); ?></span></div>
                        <?php } ?>

                        <?php if(stela_transaction_name($item_extra['i_transaction'])) { ?>
                          <div class="transaction has-tooltip" title="<?php echo osc_esc_html(__('Transaction', 'stela')); ?>"><span><?php echo stela_transaction_name($item_extra['i_transaction']); ?></span></div>
                        <?php } ?>
                      <?php } ?>
                    </div>


                    <div class="description<?php if(osc_item_user_id() > 0) { ?> registered<?php } ?>">
                      <?php if(osc_item_user_id() > 0) { ?>
                        <div class="img">
                          <a href="<?php echo osc_user_public_profile_url(osc_item_user_id()); ?>">
                            <?php echo stela_profile_picture(); ?>
                          </a>
                        </div>
                      <?php } ?>

                      <div class="text"><?php echo osc_highlight(strip_tags(osc_item_description()), 100); ?></div>
                    </div>
                  </div>
                </div>
              <?php } ?>
              </div>
            </div>
            <?php $c++; ?>
          <?php } ?>

        <?php } else { ?>
          <div class="ua-items-empty ua-alerts-total">
            <span><?php _e('Nicio cautare salvata', 'stela'); ?></span>
            <span class="details"><?php echo sprintf(__('Pentru a salva cautarea click pe "Subscribe".', 'stela'), '<a href="' . osc_search_url(array('page' => 'search')) . '">' . __('Search', 'stela') . '</a>'); ?></span>
          </div>
        <?php  } ?>
      </div>
    </div>
  </div>

  <?php osc_current_web_theme_path('footer.php') ; ?>
</body>
</html>