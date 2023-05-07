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
<body id="body-user-items" class="body-ua">
  <?php osc_current_web_theme_path('header.php') ; ?>
  <div class="content user_account">
    <div id="sidebar" class="sc-block">
      <?php echo stela_user_menu(); ?>
      <a class="btn-remove-account btn" style="width:100%;" href="<?php echo osc_base_url(true).'?page=user&action=delete&id='.osc_user_id().'&secret='.$user['s_secret']; ?>" onclick="return confirm('<?php echo osc_esc_js(__('Esti sigur ca doresti sa stergi contul? ', 'stela')); ?>?')"><span><i class="fa fa-times"></i> <?php _e('Sterge contul', 'stela'); ?></span></a>
    </div>


    <?php
      $item_type = Params::getParam('itemType');

      if($item_type == 'active') {
        $title = __('Active listings', 'stela');
        $status = __('Active', 'stela');
      } else if ($item_type == 'pending_validate') {
        $title = __('Not validated listings', 'stela');
        $status = __('Not validated', 'stela');
      } else if ($item_type == 'expired') {
        $title = __('Expired listings', 'stela');
        $status = __('Expired', 'stela');
      } else {
        $title = __('Your listings', 'stela');
        $status = '';
      }


      // IN CASE ITEMS ARE NOT PROPERLY SHOWN, USE THIS FUNCTION BLOCK 
      // $active_items = Item::newInstance()->findItemTypesByUserID(osc_logged_user_id(), 0,null, $item_type); 
      // View::newInstance()->_exportVariableToView('items', $active_items); 
    ?>




    <div id="main" class="items">
      <div class="inside">
        <?php if(osc_count_items() > 0) { ?>
          <?php while(osc_has_items()) { ?>
            <div class="us-item round3 tr1">
              <?php
                $item_extra = stela_item_extra( osc_item_id() );

                if($item_type == '') {
                  if(osc_item_is_expired()) {
                    $type = __('Expired', 'stela');
                    $type_raw = 'expired';
                  } else if (osc_item_is_inactive()) {
                    $type = __('Not validated', 'stela');
                    $type_raw = 'pending_validate';
                  } else if (osc_item_is_active()) {
                    $type = __('Active', 'stela');
                    $type_raw = 'active';
                  } else {
                    $type = '';
                    $type_raw = '';
                  }
                } else {
                  $type = '';
                }
              ?>

              <?php if(osc_images_enabled_at_items()) { ?>
                <a href="<?php echo osc_item_url(); ?>" class="image tr1<?php echo (osc_count_item_resources() <= 0 ? ' no-img' : ''); ?> ?>">
                  <span class="image-count"><i class="fa fa-camera"></i> <?php echo osc_count_item_resources(); ?>x</span>

                  <?php if(osc_count_item_resources() > 0) { ?>
                    <img src="<?php echo osc_resource_thumbnail_url(); ?>" title="<?php echo osc_esc_html(osc_item_title()); ?>" alt="<?php echo osc_esc_html(osc_item_title()); ?>" class="tr1" />
                  <?php } else { ?>
                    <img src="<?php echo osc_current_web_theme_url('images/no-image.png'); ?>" title="<?php echo osc_esc_html(osc_item_title()); ?>" alt="<?php echo osc_esc_html(osc_item_title()); ?>" class="tr1" />
                  <?php } ?>

                  <?php if($item_type == '') { ?>
                    <div class="type <?php echo $type_raw; ?>"><span class="round2"><?php echo $type; ?></span></div>
                  <?php } ?>

                  <?php if(osc_item_is_premium()) { ?>
                    <div class="premium"><?php _e('Premium', 'stela'); ?></div>
                  <?php } ?>
                </a>
              <?php } ?>

              <div class="right">
                <a href="<?php echo osc_item_url(); ?>" class="title"><?php echo osc_highlight(osc_item_title(), 80); ?></a>

                <div class="buttons">
                  <a class="view round2 tr1" href="<?php echo osc_item_url(); ?>"><?php _e('Arata anuntul', 'stela'); ?></a>
                  <a class="edit round2 tr1" href="<?php echo osc_item_edit_url(); ?>" rel="nofollow"><?php _e('Editare', 'stela'); ?></a>

                  <?php if(osc_item_is_inactive()) {?>
                    <a class="activate round2 tr1" href="<?php echo osc_item_activate_url(); ?>"><?php _e('Validate', 'stela'); ?></a>
                  <?php } else { ?>
                    <?php 
                      if (osc_rewrite_enabled()) { 
                        if( $item_extra['i_sold'] == 0 ) {
                          $sold_url = '?itemId=' . osc_item_id() . '&markSold=1&secret=' . osc_item_field('s_secret') . '&itemType=' . $item_type;
                          $reserved_url = '?itemId=' . osc_item_id() . '&markSold=2&secret=' . osc_item_field('s_secret') . '&itemType=' . $item_type;
                        } else {
                          $sold_url = '?itemId=' . osc_item_id() . '&markSold=0&secret=' . osc_item_field('s_secret') . '&itemType=' . $item_type;
                          $reserved_url = '?itemId=' . osc_item_id() . '&markSold=0&secret=' . osc_item_field('s_secret') . '&itemType=' . $item_type;
                        }
                      } else {
                        if( $item_extra['i_sold'] == 0 ) {
                          $sold_url = '&itemId=' . osc_item_id() . '&markSold=1&secret=' . osc_item_field('s_secret') . '&itemType=' . $item_type;
                          $reserved_url = '&itemId=' . osc_item_id() . '&markSold=2&secret=' . osc_item_field('s_secret') . '&itemType=' . $item_type;
                        } else {
                          $sold_url = '&itemId=' . osc_item_id() . '&markSold=0&secret=' . osc_item_field('s_secret') . '&itemType=' . $item_type;
                          $reserved_url = '&itemId=' . osc_item_id() . '&markSold=0&secret=' . osc_item_field('s_secret') . '&itemType=' . $item_type;
                        }
                      }
                    ?>

                    <?php if(!in_array(osc_item_category_id(), stela_extra_fields_hide())) { ?>
                      <a class="sold round2 tr1" href="<?php echo osc_user_list_items_url() . $sold_url; ?>"><?php echo ($item_extra['i_sold'] == 1 ? __('Debifeaza "Vandut"', 'stela') : __('Marcheaza ca vandut', 'stela')); ?></a>
                      <a class="reserved round2 tr1" href="<?php echo osc_user_list_items_url() . $reserved_url; ?>"><?php echo ($item_extra['i_sold'] == 2 ? __('Anuleaza rezervarea', 'stela') : __('Rezervat', 'stela')); ?></a>
                    <?php } ?>                  

                  <?php } ?>

                  <?php if(function_exists('republish_link_raw') && republish_link_raw(osc_item_id())) { ?>
                    <a class="republish round2 tr1" href="<?php echo republish_link_raw(osc_item_id()); ?>" rel="nofollow"><?php _e('Republicare', 'stela'); ?></a>
                  <?php } ?>
                    
                <?php if(osc_current_user_locale()=="ro_RO"){?>
                
                <a class="delete round2 tr1" onclick="return confirm('<?php echo osc_esc_js(__('Sigur doriți să ștergeți această înregistrare? Această acțiune nu poate fi anulată.', 'stela')); ?>')" href="<?php echo osc_item_delete_url(); ?>" rel="nofollow"><?php _e('Sterge', 'stela'); ?></a>
                
                <?php }else{?>
                <a class="delete round2 tr1" onclick="return confirm('<?php echo osc_esc_js(__('Are you sure you want to delete this listing? This action cannot be undone.', 'stela')); ?>')" href="<?php echo osc_item_delete_url(); ?>" rel="nofollow"><?php _e('Sterge', 'stela'); ?></a>
                <?php } ?>
                  
                </div>


                <div class="middle">
                  <?php if( osc_price_enabled_at_items() ) { ?>
                    <div class="price"><?php echo osc_item_formated_price(); ?></div>
                  <?php } ?>

                  <div class="category round2"><i class="fa fa-cog"></i> <?php echo osc_item_category(); ?></div>

                  <?php if($item_extra['i_sold'] == 1) { ?>
                    <div><?php _e('Vandut!', 'stela'); ?></div>
                  <?php } else if($item_extra['i_sold'] == 2) { ?>
                    <div><?php _e('Anunt rezervat!!', 'stela'); ?></div>
                  <?php } ?>

                  <?php if(!in_array(osc_item_category_id(), stela_extra_fields_hide())) { ?>
                    <?php if(stela_condition_name($item_extra['i_condition'])) { ?>
                      <div class="condition has-tooltip" title="<?php echo osc_esc_html(__('Condition', 'stela')); ?>"><span><?php echo stela_condition_name($item_extra['i_condition']); ?></span></div>
                    <?php } ?>

                    <?php if(stela_transaction_name($item_extra['i_transaction'])) { ?>
                      <div class="transaction has-tooltip" title="<?php echo osc_esc_html(__('Transaction', 'stela')); ?>"><span><?php echo stela_transaction_name($item_extra['i_transaction']); ?></span></div>
                    <?php } ?>
                  <?php } ?>
                </div>


                <div class="dates">
                  <span><span class="label"><?php _e('Expira', 'stela'); ?>:</span> <?php echo (date('Y', strtotime(osc_item_field('dt_expiration'))) > 3000 ? __('Niciodata', 'stela') : date('Y/m/d', strtotime(osc_item_field('dt_expiration')))); ?></span>
                  <span><span class="label"><?php _e('Published', 'stela'); ?>:</span> <?php echo date('Y/m/d', strtotime(osc_item_pub_date())); ?></span>
                  <span>
                    <?php if(osc_item_mod_date() <> '') { ?>
                      <span class="label"><?php _e('Modified', 'stela'); ?>:</span> <?php echo date('Y/m/d', strtotime(osc_item_mod_date())); ?>
                    <?php } ?>
                  </span>
                </div>


                <div class="stats">
                  <?php
                    $db_prefix = DB_TABLE_PREFIX;
                    $query = "SELECT sum(s.i_num_views) as views, sum(s.i_num_premium_views) as premium_views, sum(coalesce(e.i_num_phone_clicks, 0)) as phone_clicks FROM {$db_prefix}t_item_stats s LEFT OUTER JOIN {$db_prefix}t_item_stats_stela e ON (s.fk_i_item_id = e.fk_i_item_id AND s.dt_date = e.dt_date) WHERE s.fk_i_item_id = " . osc_item_id() . ";";
                    $result = ItemStats::newInstance()->dao->query( $query );

                    if( !$result ) { 
                      $stats = array(); 
                    } else {
                      $stats = $result->row();
                    }
                  ?>

                  <div>/ <?php echo $stats['views'] <> '' ? $stats['views'] : 0; ?>x <?php _e('vizualizari normale', 'stela'); ?></div>
                  <div>/ <?php echo $stats['premium_views'] <> '' ? $stats['premium_views'] : 0; ?>x <?php _e('vizualizari premium', 'stela'); ?></div>
                  <div>/ <?php echo $stats['phone_clicks'] <> '' ? $stats['phone_clicks'] : 0; ?>x <?php _e('nr. telefon', 'stela'); ?></div>
                </div>
              </div>
            </div>
          <?php } ?>
        <?php } else { ?>
          <div class="ua-items-empty"><span><?php echo sprintf(__('Anunturi negasite', 'stela'), $status); ?></span></div>
        <?php } ?>

        <?php if(osc_list_total_pages() > 1)  { ?>
          <div class="paginate">
            <?php for($i = 0 ; $i < osc_list_total_pages() ; $i++) { ?>
              <a class="<?php if($i == osc_list_page()) { ?>searchPaginationSelected<?php } else { ?>searchPaginationNonSelected<?php } ?>" href="<?php echo osc_user_list_items_url($i + 1) . '&itemType=' . $item_type; ?>"><?php echo ($i + 1); ?></a>
            <?php } ?>
          </div>
        <?php } ?>

      </div>
    </div>
  </div>

  <?php osc_current_web_theme_path('footer.php') ; ?>
</body>
</html>