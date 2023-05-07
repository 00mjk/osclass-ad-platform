<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="<?php echo str_replace('_', '-', osc_current_user_locale()); ?>">
<head>
  <?php osc_current_web_theme_path('head.php') ; ?>
  <meta name="robots" content="noindex, nofollow" />
  <meta name="googlebot" content="noindex, nofollow" />
</head>
<body id="body-user-items" class="body-ua">
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

    <div id="main" class="items">
      <h1><?php _e('My listings', 'beta'); ?></h1>

      <div class="inside">
        <?php if(osc_count_items() > 0) { ?>
          <?php while(osc_has_items()) { ?>
            <div class="uitem lazy<?php if(osc_item_is_inactive()) { ?> inactive<?php } ?><?php if(osc_item_is_expired()) { ?> expired<?php } ?>">
              <?php if(osc_images_enabled_at_items()) { ?>
                <div class="image">
                  <a href="<?php echo osc_item_url(); ?>">
                    <?php if(osc_count_item_resources() > 0) { ?>
                      <img src="<?php echo osc_resource_thumbnail_url(); ?>" title="<?php echo osc_esc_html(osc_item_title()); ?>" alt="<?php echo osc_esc_html(osc_item_title()); ?>" />
                    <?php } else { ?>
                      <img src="<?php echo bet_get_noimage(); ?>" title="<?php echo osc_esc_html(osc_item_title()); ?>" alt="<?php echo osc_esc_html(osc_item_title()); ?>" />
                    <?php } ?>

                    <div class="stats mbBg">
                      <span><?php echo osc_item_views(); ?> <?php echo (osc_item_views() == 1 ? __('hit', 'beta') : __('hits', 'beta')); ?></span>
                    </div>

                    <?php if(osc_item_is_inactive()) { ?>
                      <div class="status-box inactive"><span><?php _e('Inactive', 'beta'); ?></span></div>
                    <?php } else if(osc_item_is_expired()) { ?>
                      <div class="status-box expired"><span><?php _e('Expired', 'beta'); ?></span></div>
                    <?php } ?>
                  </a>
                </div>
              <?php } ?>

              <div class="body">
                <?php if(osc_item_is_premium()) { ?>
                  <div class="ua-premium" title="<?php _e('This listing is premium', 'beta'); ?>"><i class="fa fa-star"></i> <?php _e('Premium', 'beta'); ?></div>
                <?php } ?>


                <div class="title">
                  <a href="<?php echo osc_item_url(); ?>"><?php echo osc_item_title(); ?></a>

                  <?php if( osc_price_enabled_at_items() ) { ?>
                    <span class="price"><?php echo osc_item_formated_price(); ?></span>
                  <?php } ?>
                </div>

                <div class="location">
                  <i class="fa fa-map-marker"></i>

                  <?php
                    $location_array = array(osc_item_city(), osc_item_region(), osc_item_country_code(), osc_item_address(), osc_item_zip());
                    $location_array = array_filter($location_array);
                    $location = implode(', ', $location_array);
                 
                    if($location <> '') {
                      echo $location;
                    } else {
                      echo __('Location missing', 'beta');
                    }
                 ?>
                </div>


           
                <div class="dates">
                  <span><?php echo sprintf(__('Published on %s', 'beta'), osc_format_date(osc_item_pub_date())); ?>, </span>

                  <span><?php echo (date('Y', strtotime(osc_item_field('dt_expiration'))) > 3000 ? __('Never expire', 'beta') : __('Expire on', 'beta') . ' ' . date('Y/m/d', strtotime(osc_item_field('dt_expiration')))); ?></span>
                </div>

                <div class="buttons">
                  <a class="delete" onclick="return confirm('<?php echo osc_esc_js(__('Are you sure you want to delete this listing? This action cannot be undone.', 'beta')); ?>')" href="<?php echo osc_item_delete_url(); ?>" rel="nofollow"><?php _e('Delete', 'beta'); ?></a>

                  <a class="edit" target="_blank" href="<?php echo osc_item_edit_url(); ?>" rel="nofollow"><?php _e('Edit', 'beta'); ?></a>

                  <?php if(osc_item_is_inactive() && (function_exists('iv_call_after_install') && osc_get_preference('enable', 'plugin-item_validation') <> 1 || !function_exists('iv_call_after_install'))) { ?>
                    <a class="activate" target="_blank" href="<?php echo osc_item_activate_url(); ?>"><?php _e('Validate', 'beta'); ?></a>
                  <?php } else { ?>
                    <?php $item_extra = bet_item_extra(osc_item_id()); ?>
                    <?php 
                      if (osc_rewrite_enabled()) { 
                        if( $item_extra['i_sold'] == 0 ) {
                          $sold_url = '?itemId=' . osc_item_id() . '&markSold=1&secret=' . osc_item_field('s_secret');
                          $reserved_url = '?itemId=' . osc_item_id() . '&markSold=2&secret=' . osc_item_field('s_secret');
                        } else {
                          $sold_url = '?itemId=' . osc_item_id() . '&markSold=0&secret=' . osc_item_field('s_secret');
                          $reserved_url = '?itemId=' . osc_item_id() . '&markSold=0&secret=' . osc_item_field('s_secret');
                        }
                      } else {
                        if( $item_extra['i_sold'] == 0 ) {
                          $sold_url = '&itemId=' . osc_item_id() . '&markSold=1&secret=' . osc_item_field('s_secret');
                          $reserved_url = '&itemId=' . osc_item_id() . '&markSold=2&secret=' . osc_item_field('s_secret');
                        } else {
                          $sold_url = '&itemId=' . osc_item_id() . '&markSold=0&secret=' . osc_item_field('s_secret');
                          $reserved_url = '&itemId=' . osc_item_id() . '&markSold=0&secret=' . osc_item_field('s_secret');
                        }
                      }
                    ?>

                    <?php if(!in_array(osc_item_category_id(), bet_extra_fields_hide())) { ?>
                      <a class="sold round2 tr1" href="<?php echo osc_user_list_items_url() . $sold_url; ?>"><?php echo ($item_extra['i_sold'] == 1 ? __('Not sold', 'beta') : __('Sold', 'beta')); ?></a>
                      <a class="reserved" href="<?php echo osc_user_list_items_url() . $reserved_url; ?>"><?php echo ($item_extra['i_sold'] == 2 ? __('Not reserved', 'beta') : __('Reserve', 'beta')); ?></a>
                    <?php } ?>                  

                  <?php } ?>

                  <?php if(function_exists('republish_link_raw') && republish_link_raw(osc_item_id())) { ?>
                    <a class="republish" href="<?php echo republish_link_raw(osc_item_id()); ?>" rel="nofollow"><?php _e('Republish', 'beta'); ?></a>
                  <?php } ?>

                </div>
              </div>
            </div>
          <?php } ?>
        <?php } else { ?>
          <div class="ua-items-empty"><img src="<?php echo osc_current_web_theme_url('images/ua-empty.jpg'); ?>"/> <span><?php _e('You have no listings yet', 'beta'); ?></span></div>
        <?php } ?>


        <div class="paginate">
          <?php echo osc_pagination_items(); ?>
        </div>
      </div>

    </div>
  </div>

  <?php osc_current_web_theme_path('footer.php') ; ?>
</body>
</html>