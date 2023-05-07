<?php 
  // INTERNAL USE FOR AJAX. IF NO AJAX, REDIRECT USER TO REGISTER PAGE - AUTHENTIFICATION CENTRAL
  if(isset($_GET['ajaxRequest']) && $_GET['ajaxRequest'] == '1') {

    // GET LOCATIONS FOR LOCATION PICKER VIA AJAX
    //if(isset($_GET['ajaxLoc']) && $_GET['ajaxLoc'] == '1' && isset($_GET['term']) && $_GET['term'] <> '') {
    if(isset($_GET['ajaxLoc']) && $_GET['ajaxLoc'] == '1') {
      $term = trim($_GET['term']);
      $max = 12;

      if($term == '') {
        $sql = 'SELECT "city" as type, c.s_name as name, concat(r.s_name, ", ", upper(c.fk_c_country_code)) as name_top, c.pk_i_id as city_id, c.fk_i_region_id as region_id, c.fk_c_country_code as country_code  FROM ' . DB_TABLE_PREFIX . 't_city c, ' . DB_TABLE_PREFIX . 't_region r, ' . DB_TABLE_PREFIX . 't_city_stats s WHERE c.fk_i_region_id = r.pk_i_id AND c.pk_i_id = s.fk_i_city_id order by s.i_num_items DESC limit ' . $max;
      } else {
        $sql = '
          (SELECT "country" as type, s_name as name, null as name_top, null as city_id, null as region_id, pk_c_code as country_code  FROM ' . DB_TABLE_PREFIX . 't_country WHERE s_name like "' . $term . '%")
          UNION ALL
          (SELECT "region" as type, s_name as name, upper(fk_c_country_code) as name_top, null as city_id, pk_i_id  as region_id, fk_c_country_code as country_code  FROM ' . DB_TABLE_PREFIX . 't_region WHERE s_name like "' . $term . '%")
          UNION ALL
          (SELECT "city" as type, c.s_name as name, concat(r.s_name, ", ", upper(c.fk_c_country_code)) as name_top, c.pk_i_id as city_id, c.fk_i_region_id as region_id, c.fk_c_country_code as country_code  FROM ' . DB_TABLE_PREFIX . 't_city c, ' . DB_TABLE_PREFIX . 't_region r WHERE c.s_name like "' . $term . '%" AND c.fk_i_region_id = r.pk_i_id limit ' . $max . ')
          UNION ALL
          (SELECT "city_more" as type, count(pk_i_id) - ' . $max . ' as name, null as name_top, null as city_id, null as region_id, null as country_code  FROM ' . DB_TABLE_PREFIX . 't_city WHERE s_name like "' . $term . '%")
        ';
      }

      $result = City::newInstance()->dao->query($sql);

      if( !$result ) { 
        $prepare = array(); 
      } else {
        $prepare = $result->result();
      }

      echo json_encode($prepare);
      exit;
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
      exit;
    }



    // GET ITEMS FOR AUTOCOMPLETE VIA AJAX
    //if(isset($_GET['ajaxItem']) && $_GET['ajaxItem'] == '1' && isset($_GET['pattern']) && $_GET['pattern'] <> '') {
    if(isset($_GET['ajaxItem']) && $_GET['ajaxItem'] == '1') {
      $pattern = trim($_GET['pattern']);
      $max = 8;

      $db_prefix = DB_TABLE_PREFIX;

      if($pattern == '') {
        $sql = 'SELECT "category" as type, c.pk_i_id, d.s_name as s_title FROM ' . DB_TABLE_PREFIX . 't_category c, ' . DB_TABLE_PREFIX . 't_category_description d, ' . DB_TABLE_PREFIX . 't_category_stats s WHERE c.pk_i_id = s.fk_i_category_id AND d.fk_c_locale_code = "' . osc_current_user_locale() . '" AND c.pk_i_id = d.fk_i_category_id order by s.i_num_items DESC limit ' . $max;
      } else {
        $sql = "
          (SELECT 'category' as type, c.pk_i_id, d.s_name as s_title, '' as i_price, '' as fk_c_currency_code, '' as image_url from {$db_prefix}t_category as c, {$db_prefix}t_category_description as d WHERE c.pk_i_id = d.fk_i_category_id AND d.fk_c_locale_code = '" . osc_current_user_locale() . "' AND d.s_name LIKE '%" . $pattern . "%' LIMIT " . $max . ")

          UNION ALL

          (
          SELECT 'item' as type, i.pk_i_id, d.s_title, i.i_price, i.fk_c_currency_code, CONCAT(r.s_path, r.pk_i_id,'_thumbnail.',r.s_extension) as image_url
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
          LIMIT " . $max . "
          )
        ";

      }


      $result = Item::newInstance()->dao->query($sql);

      if( !$result ) { 
        $prepare = array(); 
      } else {
        $prepare = $result->result();
      }

      foreach( $prepare as $i => $p ) {
        $prepare[$i]['s_title'] = str_ireplace($pattern, '<b>' . $pattern . '</b>', $prepare[$i]['s_title']);

        if($prepare[$i]['type'] == 'category') {
          $prepare[$i]['s_title'] = stela_get_cat_icon($prepare[$i]['pk_i_id']) . ' ' . $prepare[$i]['s_title'];
          $prepare[$i]['category_url'] = osc_search_url(array('page' => 'search', 'sCategory' => $prepare[$i]['pk_i_id']));
        }

        if($prepare[$i]['type'] == 'item') {
          $prepare[$i]['i_price'] = stela_ajax_item_format_price($prepare[$i]['i_price'], $prepare[$i]['fk_c_currency_code']);
          $prepare[$i]['item_url'] = osc_item_url_ns($prepare[$i]['pk_i_id']);
          if($prepare[$i]['image_url'] <> '') {
            $prepare[$i]['image_url'] = osc_base_url() . $prepare[$i]['image_url'];
          } else {
            $prepare[$i]['image_url'] = osc_current_web_theme_url('images/no-image.png');
          }
        }
      }

      echo json_encode($prepare);
      exit;
    }



    // INCREASE CLICK COUNT ON PHONE NUMBER
    if(isset($_GET['ajaxPhoneClick']) && $_GET['ajaxPhoneClick'] == '1' && isset($_GET['itemId']) && $_GET['itemId'] > 0) {
      stela_increase_clicks($_GET['itemId'], $_GET['itemUserId']);
      echo 1;
      exit;
    }

 } else {
    // No ajax requested, show contact page
?>


  <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
  <html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="<?php echo str_replace('_', '-', osc_current_user_locale()); ?>">
  <head>
    <?php osc_current_web_theme_path('head.php') ; ?>
    <meta name="robots" content="noindex, nofollow" />
    <meta name="googlebot" content="noindex, nofollow" />
    <script type="text/javascript" src="<?php echo osc_current_web_theme_js_url('jquery.validate.min.js') ; ?>"></script>
  </head>

  <?php
    $type = Params::getParam('type');

    if($type == 'box') {
      osc_current_web_theme_path('inc.contact.php');

      echo '<div style="display:none;">';
      osc_run_hook('footer');
      echo '</div>';

      exit;
    }
  ?>

  <body id="body-contact">
    <?php osc_current_web_theme_path('header.php') ; ?>
    <div id="contact-wrap" class="content cont_us">
      <h1>&nbsp;</h1>



      <div id="contact-ins" class="inner round3">
        <h2 class="contact"><?php _e("Contact Zzbeng.ro", 'stela'); ?></h2>

        <div class="clear"></div>

        <ul id="error_list"></ul>
        <form action="<?php echo osc_base_url(true) ; ?>" method="post" name="contact_form" id="contact" <?php if(osc_contact_attachment()) { echo 'enctype="multipart/form-data"'; };?>>
          <input type="hidden" name="page" value="contact" />
          <input type="hidden" name="action" value="contact_post" />

          <?php if(osc_is_web_user_logged_in()) { ?>
            <input type="hidden" name="yourName" value="<?php echo osc_esc_html( osc_logged_user_name() ); ?>" />
            <input type="hidden" name="yourEmail" value="<?php echo osc_logged_user_email();?>" />
          <?php } else { ?>
            <label for="yourName"><span><?php _e('Your name', 'stela'); ?></span></label> 
            <span class="input-box"><?php ContactForm::your_name(); ?></span>

            <label for="yourEmail"><span><?php _e('Your e-mail address', 'stela'); ?></span><div class="req">*</div></label>
            <span class="input-box"><?php ContactForm::your_email(); ?></span>
          <?php } ?>

          <label for="subject"><span><?php _e("Subject", 'stela'); ?></span><div class="req">*</div></label>
          <span class="input-box"><?php ContactForm::the_subject(); ?></span>

          <label for="message"><span><?php _e("Message", 'stela'); ?></span><div class="req">*</div></label>
          <span class="input-box last"><?php ContactForm::your_message(); ?></span>


          <?php if(osc_contact_attachment()) { ?>
            <div class="attachment">
              <div class="att-box">
                <label class="status">
                  <span class="wrap"><i class="fa fa-paperclip"></i> <span><?php _e('Upload file', 'stela'); ?></span></span>
                  <?php ContactForm::your_attachment(); ?>
                </label>
              </div>
            </div>
          <?php } ?>

          <div class="req-what"><div class="req">*</div><div class="small-info"><?php _e('This field is required', 'stela'); ?></div></div>

          <?php stela_show_recaptcha(); ?>

          <button type="submit" id="blue"><?php _e('Send message', 'stela'); ?></button>
        </fieldset>
        </form>
      </div>
    </div>


    <?php ContactForm::js_validation() ; ?>
    <?php osc_current_web_theme_path('footer.php') ; ?>
  </body>
  </html>

<?php } ?>