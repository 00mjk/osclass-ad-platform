<?php
  $address = '';
  if(osc_user_address()!='') {
    $address = osc_user_address();
  }

  $location = stela_get_full_loc(osc_user_field('fk_c_country_code'), osc_user_region_id(), osc_user_city_id());

  if(osc_user_zip() <> '') {
    $location .= ' ' . osc_user_zip();
  }

  $user_keep = osc_user();
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
  <?php View::newInstance()->_exportVariableToView('user', $user_keep); ?>
  <?php osc_current_web_theme_path('header.php') ; ?>

  <div class="content user_public_profile">

    <h1><?php echo sprintf(__('Latest %s\'s listings', 'stela'), osc_user_name()); ?></h1>

    <!-- Item Banner #1 -->
    <?php echo stela_banner('public', 1); ?>


    <!-- LISTINGS OF SELLER -->
    <div id="public-items" class="white">
      <?php if( osc_count_items() > 0) { ?>
        <div class="block">
          <div class="wrap">
            <?php $c = 1; ?>
            <?php while( osc_has_items() ) { ?>
              <?php stela_draw_item($c, 'gallery'); ?>
        
              <?php $c++; ?>
            <?php } ?>
          </div>
        </div>
      <?php } else { ?>
        <div class="empty"><?php _e('Nu ai niciun anunt.', 'stela'); ?></div>
      <?php } ?>
    </div>


    <!-- SELLER INFORMATION -->
    <div id="side-right" class="pp-seller">
      <div id="seller" class="round3 i-shadow">
        <div class="body">
          <div class="inside">
            <?php if(function_exists('profile_picture_show')) { ?>
              <div class="side-prof">
                <?php profile_picture_show(null, 'item', 200); ?>
              </div>
            <?php } ?>

            <div class="name">
                <?php echo show_avatar(osc_user_id()); ?>
              <?php echo osc_user_name(); ?>
            </div>
          </div>


          <!-- LISTING SHARE LINKS -->
          <div class="listing-share">
            <?php osc_reset_resources(); ?>
            <a class="single single-facebook" title="<?php echo osc_esc_html(__('Share on Facebook', 'stela')); ?>" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(osc_user_public_profile_url(osc_user_id())); ?>"><i class="fa fa-facebook-square"></i></a> 
            <a class="single single-google-plus" title="<?php echo osc_esc_html(__('Share on Google Plus', 'stela')); ?>" target="_blank" href="https://plus.google.com/share?url=<?php echo urlencode(osc_user_public_profile_url(osc_user_id())); ?>"><i class="fa fa-google-plus-square"></i></a> 
            <a class="single single-twitter" title="<?php echo osc_esc_html(__('Share on Twitter', 'stela')); ?>" target="_blank" href="https://twitter.com/home?status=<?php echo urlencode(osc_user_public_profile_url(osc_user_id())); ?>"><i class="fa fa-twitter-square"></i></a> 
            <a class="single single-pinterest" title="<?php echo osc_esc_html(__('Share on Pinterest', 'stela')); ?>" target="_blank" href="https://pinterest.com/pin/create/button/?url=<?php echo urlencode(osc_user_public_profile_url(osc_user_id())); ?>&media=<?php echo osc_resource_url(); ?>&description=<?php echo urlencode(sprintf(__('%s\' listings', 'stela'), osc_user_name())); ?>"><i class="fa fa-pinterest-square"></i></a> 
          </div>


          <!-- ITEM BUTTONS -->
          <div id="item-buttons">

            <?php if(function_exists('show_feedback_overall')) { ?>
              <div class="elem feedback"><?php echo show_feedback_overall(); ?></div>
            <?php } ?>

            <?php if(function_exists('seller_post')) { ?>
              <div class="elem dash">
                <i class="fa fa-dashboard"></i>
                <?php seller_post(osc_user_id()); ?>
              </div>
            <?php } ?>



            <div class="elem type">
              <?php $user = User::newInstance()->findByPrimaryKey( osc_user_id() ); ?>
              <?php if($user['b_company'] == 1) { ?>
                <i class="fa fa-briefcase"></i> <?php _e('Firma', 'stela'); ?>
              <?php } else { ?>
                <i class="fa fa-user-o"></i> <?php _e('Persoana fizica', 'stela'); ?>
              <?php } ?>
            </div>


            <div class="elem regdate">
              <i class="fa fa-calendar"></i>
              <?php $get_user = User::newInstance()->findByPrimaryKey( osc_user_id() ); ?>

              <?php if(isset($get_user['dt_reg_date']) AND $get_user['dt_reg_date'] <> '') { ?>
                <?php echo __('Inregistrat pe', 'stela') . ' ' . osc_format_date( $get_user['dt_reg_date'] ); ?>
              <?php } else { ?>
                <?php echo __('Unknown registration date', 'stela'); ?>
              <?php } ?>
            </div>
          </div>
        </div>
      </div>


      <!-- CONTACT SELLER BLOCK -->
      <div class="pub-contact-wrap">
        <div class="ins">
          <?php if(osc_user_id() == osc_logged_user_id()) { ?>
            <div class="empty"><?php _e('Acesta este profilul tau public', 'stela'); ?></div>
          <?php } else { ?>
            <?php if(osc_reg_user_can_contact() && osc_is_web_user_logged_in() || !osc_reg_user_can_contact() ) { ?>
              <a id="pub-contact" href="<?php echo osc_item_send_friend_url(); ?>" class="btn btn-secondary" rel="<?php echo osc_user_id(); ?>"><?php _e('Contact seller', 'stela'); ?></a>
            <?php } ?>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>


  <?php osc_current_web_theme_path('footer.php') ; ?>
</body>
</html>