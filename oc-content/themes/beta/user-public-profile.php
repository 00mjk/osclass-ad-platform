<?php
  $location_array = array(osc_user_city(), osc_user_region(), osc_user_country(), osc_item_address(), osc_item_zip());
  $location_array = array_filter($location_array);
  $location = implode(', ', $location_array);


  $user = osc_user();

  $mobile_found = true;

  $mobile = $user['s_phone_mobile'];
  if($mobile == '') { $mobile = $user['s_phone_land']; } 
 
  if(trim($mobile) == '' || strlen(trim($mobile)) < 4) { 
    $mobile = __('No phone number', 'beta');
    $mobile_found = false;
  }


  $reg_type = '';
  $reg_has_date = false;

  if($user && $user['dt_reg_date'] <> '') { 
    $reg_type = sprintf(__('Posting for %s', 'beta'), bet_smart_date2($user['dt_reg_date']));
    $reg_has_date = true;
  } else if ($user) { 
    $reg_type = __('Registered user', 'beta');
  } else {
    $reg_type = __('Unregistered user', 'beta');
  }

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="<?php echo str_replace('_', '-', osc_current_user_locale()); ?>">
<head>
  <?php osc_current_web_theme_path('head.php') ; ?>
  <meta name="robots" content="noindex, nofollow" />
  <meta name="googlebot" content="noindex, nofollow" />
  <script type="text/javascript" src="<?php echo osc_current_web_theme_js_url('jquery.validate.min.js') ; ?>"></script>
</head>

<body id="body-user-public-profile">
  <?php View::newInstance()->_exportVariableToView('user', $user); ?>
  <?php osc_current_web_theme_path('header.php') ; ?>

  <div class="inside user_public_profile" id="listing">

    <!-- LEFT BLOCK -->

    <div class="side">
      <div class="data">
        <div class="line line1">
          <div class="user-img">
            <img src="<?php echo bet_profile_picture(osc_user_id(), 'medium'); ?>" alt="<?php echo osc_item_contact_name(); ?>" />
          </div>

          <div class="user-name<?php if(function_exists('ur_show_rating_link') && osc_user_id() > 0) { ?> ur-active<?php } ?>">
            <strong>
              <?php if($user['b_company'] == 1) { ?>
                <span class="lab box-user" title="<?php echo osc_esc_html(__('Professional seller', 'beta')); ?>"><img src="<?php echo osc_current_web_theme_url('images/shop-small.png'); ?>"/></span>
              <?php } ?>

              <span><?php echo osc_user_name(); ?></span>
            </strong>

            <?php if(function_exists('show_feedback_overall') && osc_user_id() > 0) { ?>
              <span class="bo-fdb"><a href="#" id="leave_feedback"><?php echo show_feedback_overall(); ?></a></span>
            <?php } ?>

            <?php if(function_exists('ur_show_rating_link') && osc_user_id() > 0) { ?>
              <span class="ur-fdb">
                <span class="strs"><?php echo ur_show_rating_stars(); ?></span>
                <span class="lnk"><?php echo ur_add_rating_link(); ?></span>
              </span>
            <?php } ?>


            <span>
              <?php echo $reg_type; ?>
            </span>

            <?php if(osc_user_id() > 0) { ?>
              <span>
                <a href="<?php echo osc_search_url(array('page' => 'search', 'userId' => osc_user_id())); ?>"><?php _e('view all ads', 'beta'); ?></a>
              </span>
            <?php } ?>
          </div>
        </div>


        <div class="connect-pre">
          <?php if($mobile_found) { ?>
            <div class="row mob">
              <i class="fa fa-phone"></i>
              <a href="#" class="mobile" data-phone="<?php echo $mobile; ?>" title="<?php echo osc_esc_html(__('Click to show number', 'beta')); ?>"><?php echo substr($mobile, 0, strlen($mobile) - 4) . 'xxxx'; ?></a>
            </div>
          <?php } ?>


          <?php if(osc_reg_user_can_contact() && osc_is_web_user_logged_in() || !osc_reg_user_can_contact() ) { ?>
            <a href="<?php echo bet_fancy_url('contact_public', array('userId' => osc_user_id())); ?>" class="open-form contact_public btn mbBg" data-type="contact_public" data-user-id="<?php echo osc_user_id(); ?>"><i class="fa fa-envelope-o"></i> <?php _e('Message seller', 'beta'); ?></a>
          <?php } ?>
        </div>

        <div class="connect">

          <?php if ($location <> '') { ?><div class="ln loc"><i class="fa fa-map-marker"></i> <?php echo $location; ?></div><?php } ?>

          <?php if (osc_user_info() <> '') { ?><div class="ln desc"><?php echo osc_user_info(); ?></div><?php } ?>

          <?php if (osc_user_website() != '') { ?><div class="ln web"><a href="<?php echo osc_user_website(); ?>" target="_blank" rel="nofollow"><?php echo osc_user_website(); ?></a></div><?php } ?>


        </div>


        <div class="item-share">
          <?php osc_reset_resources(); ?>
          <a class="facebook" title="<?php echo osc_esc_html(__('Share on Facebook', 'beta')); ?>" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo osc_user_public_profile_url(osc_user_id()); ?>"><i class="fa fa-facebook"></i></a> 
          <a class="twitter" title="<?php echo osc_esc_html(__('Share on Twitter', 'beta')); ?>" target="_blank" href="https://twitter.com/intent/tweet?text=<?php echo urlencode(meta_title()); ?>&url=<?php echo urlencode(osc_user_public_profile_url(osc_user_id())); ?>"><i class="fa fa-twitter"></i></a> 
          <a class="pinterest" title="<?php echo osc_esc_html(__('Share on Pinterest', 'beta')); ?>" target="_blank" href="https://pinterest.com/pin/create/button/?url=<?php echo osc_user_public_profile_url(osc_user_id()); ?>&media=<?php echo osc_resource_url(); ?>&description=<?php echo htmlspecialchars(meta_title()); ?>"><i class="fa fa-pinterest"></i></a> 
        </div>
      </div>

      <?php echo bet_banner('public_profile_sidebar'); ?>
    </div>



    <!-- LISTINGS OF SELLER -->
    <div id="public-items" class="products grid">
      <h1><?php _e('Latest items of seller', 'beta'); ?></h1>

      <?php if(osc_count_items() > 0) { ?>
        <div class="block">
          <div class="wrap">
            <?php $c = 1; ?>
            <?php while( osc_has_items() ) { ?>
              <?php bet_draw_item($c); ?>
        
              <?php $c++; ?>
            <?php } ?>
          </div>
        </div>
      <?php } else { ?>
        <div class="ua-items-empty"><img src="<?php echo osc_current_web_theme_url('images/ua-empty.jpg'); ?>"/> <span><?php _e('This seller has no active listings', 'beta'); ?></span></div>
      <?php } ?>

      <?php echo bet_banner('public_profile_bottom'); ?>
    </div>
  </div>

  <script type="text/javascript">
    $(document).ready(function(){

      // SHOW PHONE NUMBER
      $('body').on('click', '.connect-pre .mobile', function(e) {
        if($(this).attr('href') == '#') {
          e.preventDefault()

          var phoneNumber = $(this).attr('data-phone');
          $(this).text(phoneNumber);
          $(this).attr('href', 'tel:' + phoneNumber);
          $(this).attr('title', '<?php echo osc_esc_js(__('Click to call', 'beta')); ?>');
        }        
      });


    });
  </script>


  <?php osc_current_web_theme_path('footer.php') ; ?>
</body>
</html>