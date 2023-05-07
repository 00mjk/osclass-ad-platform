<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="<?php echo str_replace('_', '-', osc_current_user_locale()); ?>">
<head>
  <?php osc_current_web_theme_path('head.php'); ?>
  <link rel="stylesheet" media="print" href="<?php echo osc_current_web_theme_url('css/print.css?v=' . date('YmdHis')); ?>">


  <?php
    $itemviewer = (Params::getParam('itemviewer') == 1 ? 1 : 0);
    $item_extra = bet_item_extra(osc_item_id());

    $location_array = array(osc_item_city(), osc_item_region(), osc_item_country_code());
    $location_array = array_filter($location_array);
    $location = implode(', ', $location_array);

    $location2_array = array(osc_item_city(), osc_item_region(), osc_item_country_code(), osc_item_address(), osc_item_zip());
    $location2_array = array_filter($location_array);
    $location2 = implode(', ', $location_array);

    if(osc_item_user_id() <> 0) {
      $item_user = User::newInstance()->findByPrimaryKey(osc_item_user_id());
      View::newInstance()->_exportVariableToView('user', $item_user);
    } else {
      $item_user = false;
    }

    $user_location_array = array(osc_user_city(), osc_user_region(), osc_user_country(), (osc_user_address() <> '' ? '<br/>' . osc_user_address() : ''));
    $user_location_array = array_filter($user_location_array);
    $user_location = implode(', ', $user_location_array);


    $mobile_found = true;
    $mobile = $item_extra['s_phone'];

    if($mobile == '' && function_exists('bo_mgr_show_mobile')) { $mobile = bo_mgr_show_mobile(); }
    if($mobile == '' && osc_item_user_id() <> 0) { $mobile = $item_user['s_phone_mobile']; }      
    if($mobile == '' && osc_item_user_id() <> 0) { $mobile = $item_user['s_phone_land']; } 
   
    if(trim($mobile) == '' || strlen(trim($mobile)) < 4) { 
      $mobile = __('No phone number', 'beta');
      $mobile_found = false;
    }  


    $has_cf = false;
    while(osc_has_item_meta()) {
      if(osc_item_meta_value() != '') {
        $has_cf = true;
        break;
      }
    }

    View::newInstance()->_reset('metafields');


    // GET REGISTRATION DATE AND TYPE
    $reg_type = '';
    $reg_has_date = false;

    if($item_user && $item_user['dt_reg_date'] <> '') { 
      $reg_type = sprintf(__('Posting for %s', 'beta'), bet_smart_date2($item_user['dt_reg_date']));
      $reg_has_date = true;
    } else if ($item_user) { 
      $reg_type = __('Registered user', 'beta');
    } else {
      $reg_type = __('Unregistered user', 'beta');
    }
  ?>


  <!-- FACEBOOK OPEN GRAPH TAGS -->
  <?php osc_get_item_resources(); ?>
  <meta property="og:title" content="<?php echo osc_esc_html(osc_item_title()); ?>" />
  <?php if(osc_count_item_resources() > 0) { ?><meta property="og:image" content="<?php echo osc_resource_url(); ?>" /><?php } ?>
  <meta property="og:site_name" content="<?php echo osc_esc_html(osc_page_title()); ?>"/>
  <meta property="og:url" content="<?php echo osc_item_url(); ?>" />
  <meta property="og:description" content="<?php echo osc_esc_html(osc_highlight(osc_item_description(), 500)); ?>" />
  <meta property="og:type" content="article" />
  <meta property="og:locale" content="<?php echo osc_current_user_locale(); ?>" />
  <meta property="product:retailer_item_id" content="<?php echo osc_item_id(); ?>" /> 
  <meta property="product:price:amount" content="<?php echo strip_tags(osc_item_formated_price()); ?>" />
  <?php if(osc_item_price() <> '' and osc_item_price() <> 0) { ?><meta property="product:price:currency" content="<?php echo osc_item_currency(); ?>" /><?php } ?>


  <!-- GOOGLE RICH SNIPPETS -->
  <span itemscope itemtype="http://schema.org/Product">
    <meta itemprop="name" content="<?php echo osc_esc_html(osc_item_title()); ?>" />
    <meta itemprop="description" content="<?php echo osc_esc_html(osc_highlight(osc_item_description(), 500)); ?>" />
    <?php if(osc_count_item_resources() > 0) { ?><meta itemprop="image" content="<?php echo osc_resource_url(); ?>" /><?php } ?>
  </span>
</head>

<body id="body-item" class="page-body<?php if($itemviewer == 1) { ?> itemviewer<?php } ?><?php if(bet_device() <> '') { echo ' dvc-' . bet_device(); } ?>">
  <?php osc_current_web_theme_path('header.php') ; ?>

  <div id="listing" class="inside">
    <?php echo bet_banner('item_top'); ?>


    <!-- LISTING BODY - LEFT SIDE -->
    <div class="item">

      <!-- HEADER & BASIC DATA -->
      <div class="basic">
        <h1>
          <?php if(osc_item_is_premium()) { ?>
            <div class="item-prem-lab mbBg"><i class="fa fa-star"></i> <?php echo __('Premium', 'beta'); ?></div>
          <?php } ?>

          <?php echo osc_item_title(); ?>
        </h1>

        <h2>
          <span class="location"><?php echo ($location2 <> '' ? $location2 : __('Unkown location', 'beta')); ?></span>

          <span class="price p-<?php echo osc_item_price(); ?>x"><?php echo osc_item_formated_price(); ?></span>
        </h2>
      </div>


      <?php if(osc_item_is_expired()) { ?>
        <div class="sold-reserved expired">
          <span><?php _e('This listing is expired!', 'beta'); ?></span>
        </div>
      <?php } ?>

      <?php if($item_extra['i_sold'] > 0) { ?>
        <div class="sold-reserved<?php echo ($item_extra['i_sold'] == 1 ? ' sold' : ' reserved'); ?>">
          <span><?php echo ($item_extra['i_sold'] == 1 ? __('Seller has marked this listing as <strong>SOLD</strong>', 'beta') : __('Seller has marked this listing as <strong>RESERVED</strong>', 'beta')); ?></span>
        </div>
      <?php } ?>


      <!-- IMAGE BOX -->
      <div class="main-data">
        <div class="main-head">
           <?php if(osc_images_enabled_at_items()) { ?> <a href="#" class="active tab-img"><i class="fa fa-camera"></i> <span><?php _e('Images', 'beta'); ?></span></a><?php } ?>
           <a href="#" class="<?php if(!osc_images_enabled_at_items()) { ?>active<?php } ?> tab-loc"><i class="fa fa-map-marker"></i> <span><?php _e('Location', 'beta'); ?></span></a>
         </div>
           
        <?php if(osc_images_enabled_at_items()) { ?> 
          <div id="img" class="img">
            <?php osc_get_item_resources(); ?>
            <?php osc_reset_resources(); ?>

            <?php if(osc_count_item_resources() > 0 ) { ?>  
              <ul class="list bx-slider">
                <?php for($i = 0;osc_has_item_resources(); $i++) { ?>
                  <li>
                    <a href="<?php echo osc_resource_url(); ?>">
                      <img src="<?php echo osc_resource_url(); ?>" alt="<?php echo osc_esc_html(osc_item_title()); ?> - <?php echo $i+1;?>"/>
                    </a>
                  </li>
                <?php } ?>
              </ul>

              <?php if(osc_count_item_resources() > 1) { ?>
                <div class="item-bx-pager">
                  <?php osc_reset_resources(); ?>
                  <?php $c = 0; ?>

                  <?php for($i = 1;osc_has_item_resources();$i++) { ?>
                    <a data-slide-index="<?php echo $c; ?>" href="" class="navi<?php if($i == 0) { ?> first<?php } ?><?php if($i - 1 == osc_count_item_resources()) { ?> last<?php } ?>">
                      <img src="<?php echo osc_resource_thumbnail_url(); ?>" alt="<?php echo osc_esc_html(osc_item_title()); ?> - <?php _e('Image', 'beta'); ?> <?php echo $i; ?>"/>
                    </a>

                    <?php $c++; ?>
                  <?php } ?>
                </div>
              <?php } ?>

            <?php } else { ?>

              <div class="image-empty"><?php _e('Seller has not uploaded any pictures', 'beta'); ?></div>

            <?php } ?>
          </div>
        <?php } ?>
        
        <div class="loc" <?php if(osc_images_enabled_at_items()) { ?>style="display:none;"<?php } ?>>
          <strong><?php echo $location; ?> <?php echo osc_item_address(); ?> <?php echo osc_item_zip(); ?></strong>

          <div class="hook">
            <?php osc_run_hook('location'); ?>
          </div>

          <a target="_blank"  class="direction" href="https://www.google.com/maps?daddr=<?php echo urlencode($location); ?>"><?php _e('Get directions', 'beta'); ?> <i class="fa fa-angle-right"></i></a>
        </div>
        
      </div>

      <div class="stats">
        <span><?php echo bet_smart_date(osc_item_pub_date()); ?></span>

        <?php if(!in_array(osc_item_category_id(), bet_extra_fields_hide())) { ?>
          <?php if(bet_get_simple_name($item_extra['i_condition'], 'condition') <> '') { ?>
            <span class="condition" title="<?php echo osc_esc_html(__('Item condition', 'beta')); ?>"><?php echo bet_get_simple_name($item_extra['i_condition'], 'condition'); ?></span>
          <?php } ?>

          <?php if(bet_get_simple_name($item_extra['i_transaction'], 'transaction') <> '') { ?>
            <span class="transaction" title="<?php echo osc_esc_html(__('Transaction', 'beta')); ?>"><?php echo bet_get_simple_name($item_extra['i_transaction'], 'transaction'); ?></span>
          <?php } ?>
        <?php } ?>

        <span><?php echo osc_item_views(); ?> <?php echo (osc_item_views() == 1 ? __('hit', 'beta') : __('hits', 'beta')); ?></span>
        <span class="right"><?php _e('ID', 'beta'); ?> #<?php echo osc_item_id(); ?></span>
      </div>


      <!-- DESCRIPTION -->
      <div class="data">
        <div class="description">
          <h2><?php _e('Description', 'beta'); ?></h2>

          <div class="text">
            <?php if(function_exists('show_qrcode')) { ?>
              <div class="qr-code noselect">
                <?php show_qrcode(); ?>
              </div>
            <?php } ?>

            <?php echo osc_item_description(); ?>
          </div>

        </div>


        <!-- CUSTOM FIELDS -->
        <?php if($has_cf) { ?>
          <div class="custom-fields">
            <h2><?php _e('Attributes', 'beta'); ?></h2>

            <div class="list">
              <?php while(osc_has_item_meta()) { ?>
                <?php if(osc_item_meta_value() != '') { ?>
                  <div class="field name<?php echo osc_item_meta_name(); ?> value<?php echo osc_esc_html(osc_item_meta_value()); ?>">
                    <span class="name"><?php echo osc_item_meta_name(); ?></span> 
                    <span class="value"><?php echo osc_item_meta_value(); ?></span>
                  </div>
                <?php } ?>
              <?php } ?>
            </div>

          </div>
        <?php } ?>

   
        <!-- PLUGIN HOOK -->
        <div id="plugin-hook">
          <?php osc_run_hook('item_detail', osc_item()); ?>  
        </div>

        <?php if($itemviewer == 1) { ?>
          <div class="item-detail-wrap">
            <a href="<?php echo osc_item_url(); ?>" target="_top" class="mbBg btn btn-primary isMobile item-detail-btn"><?php _e('view all details', 'beta'); ?> <i class="fa fa-angle-double-right"></i></a>
          </div>
        <?php } ?>
      </div>



      <?php echo bet_banner('item_description'); ?>
    </div>



    <!-- SIDEBAR - RIGHT -->
    <div class="side">

      <?php if(function_exists('sp_buttons')) { ?>
        <div class="sms-payments">
          <?php echo sp_buttons(osc_item_id());?>
        </div>
      <?php } ?>


      <?php if(osc_is_web_user_logged_in() && osc_item_user_id() == osc_logged_user_id()) { ?>
        <div class="manage">
          <h2><i class="fa fa-wrench"></i> <?php _e('Manage item', 'beta'); ?></h2>
              
          <div class="tools">
            <a href="<?php echo osc_item_edit_url(); ?>"><span><?php _e('Edit', 'beta'); ?></span></a>
            <a href="<?php echo osc_item_delete_url(); ?>"" onclick="return confirm('<?php _e('Are you sure you want to delete this listing? This action cannot be undone.', 'beta'); ?>?')"><span><?php _e('Remove', 'beta'); ?></span></a>

            <?php if(osc_item_is_inactive()) { ?>
              <a class="activate" target="_blank" href="<?php echo osc_item_activate_url(); ?>"><?php _e('Validate', 'beta'); ?></a>
            <?php } ?>

          </div>
        </div>
      <?php } ?>


      <div class="data">
        <div class="line line1">
          <div class="user-img">
            <img src="<?php echo bet_profile_picture(osc_item_user_id(), 'medium'); ?>" alt="<?php echo osc_item_contact_name(); ?>" />
          </div>

          <div class="user-name<?php if(function_exists('ur_show_rating_link') && osc_item_user_id() > 0) { ?> ur-active<?php } ?>">
            <strong>
              <?php if($item_user['b_company'] == 1) { ?>
                <span class="lab box-user" title="<?php echo osc_esc_html(__('Professional seller', 'beta')); ?>"><img src="<?php echo osc_current_web_theme_url('images/shop-small.png'); ?>"/></span>
              <?php } ?>

              <span><?php echo osc_item_contact_name(); ?></span>
            </strong>
 
            <?php if(function_exists('show_feedback_overall') && osc_item_user_id() > 0) { ?>
              <span class="bo-fdb"><a href="#" id="leave_feedback"><?php echo show_feedback_overall(); ?></a></span>
            <?php } ?>

            <?php if(function_exists('ur_show_rating_link') && osc_item_user_id() > 0) { ?>
              <span class="ur-fdb">
                <span class="strs"><?php echo ur_show_rating_stars(); ?></span>
                <span class="lnk"><?php echo ur_add_rating_link(); ?></span>
              </span>
            <?php } ?>


            <span>
              <?php echo $reg_type; ?>
            </span>

            <?php if(osc_item_user_id() > 0) { ?>
              <span>
                <a href="<?php echo osc_user_public_profile_url(osc_item_user_id()); ?>"><?php _e('view profile', 'beta'); ?></a>
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


          <?php if(osc_item_show_email()) { ?>
            <div class="row mob">
              <i class="fa fa-email"></i>
              <a href="#" class="email" data-email="<?php echo osc_item_contact_email(); ?>" title="<?php echo osc_esc_html(__('Click to show email', 'beta')); ?>"><?php echo bet_mask_email(osc_item_contact_email()); ?></a>
            </div>
          <?php } ?>


          <?php if(bet_chat_button(osc_item_user_id())) { echo bet_chat_button(osc_item_user_id()); } ?>

          <a href="<?php echo bet_fancy_url('contact'); ?>" class="open-form contact btn mbBg" data-type="contact"><i class="fa fa-envelope-o"></i> <?php _e('Message seller', 'beta'); ?></a>
        </div>

        <div class="connect">
          <?php if(function_exists('vrt_download') && vrt_download(osc_item_id()) !== false) { ?>
            <?php echo vrt_download(osc_item_id()); ?>
          <?php } ?>


          <?php if(osc_item_user_id() > 0) { ?>
            <a href="<?php echo osc_search_url(array('page' => 'search', 'userId' => osc_item_user_id())); ?>"><?php _e('Browse all seller\'s ads', 'beta'); ?></a>
          <?php } ?>

          <?php if(function_exists('mo_ajax_url')) { ?>
            <a href="#" id="mk-offer" class="make-offer-link mbCl" data-item-id="<?php echo osc_item_id(); ?>" data-item-currency="<?php echo osc_item_currency(); ?>" data-ajax-url="<?php echo mo_ajax_url(); ?>&moAjaxOffer=1&itemId=<?php echo osc_item_id(); ?>"><?php _e('Make offer', 'beta'); ?></a>
          <?php } ?>

          <a href="#" class="print"><?php _e('Print listing', 'beta'); ?></a>

          <?php if(function_exists('seller_post')) { ?>
            <?php seller_post(); ?>
          <?php } ?>

          <?php if (function_exists('show_printpdf')) { ?>
            <a id="print_pdf" class="" target="_blank" href="<?php echo osc_base_url(); ?>oc-content/plugins/printpdf/download.php?item=<?php echo osc_item_id(); ?>"><?php echo osc_esc_html(__('Download in PDF', 'veronika')); ?></a>
          <?php } ?>

        </div>


        <div class="connect-after">
          <?php if(function_exists('fi_save_favorite')) { echo fi_save_favorite(); } ?>
          <a class="friend open-form" href="<?php echo bet_fancy_url('friend'); ?>" data-type="friend"><i class="fa fa-thumbs-o-up"></i><?php _e('Recommend', 'beta'); ?></a>
        </div>

        <div class="item-share">
          <?php osc_reset_resources(); ?>
          <a class="facebook" title="<?php echo osc_esc_html(__('Share on Facebook', 'beta')); ?>" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo osc_item_url(); ?>"><i class="fa fa-facebook"></i></a> 
          <a class="twitter" title="<?php echo osc_esc_html(__('Share on Twitter', 'beta')); ?>" target="_blank" href="https://twitter.com/intent/tweet?text=<?php echo urlencode(osc_item_title()); ?>&url=<?php echo urlencode(osc_item_url()); ?>"><i class="fa fa-twitter"></i></a> 
          <a class="pinterest" title="<?php echo osc_esc_html(__('Share on Pinterest', 'beta')); ?>" target="_blank" href="https://pinterest.com/pin/create/button/?url=<?php echo osc_item_url(); ?>&media=<?php echo osc_resource_url(); ?>&description=<?php echo htmlspecialchars(osc_item_title()); ?>"><i class="fa fa-pinterest"></i></a> 
        </div>
      </div>


      <?php echo bet_banner('item_sidebar'); ?>


      <!-- COMMENTS-->
      <?php if( osc_comments_enabled()) { ?>
        <div id="comment">
          <h2>
            <span><?php _e('Comments', 'beta'); ?></span>
            <span class="count mbCl"><i class="fa fa-comments"></i> <?php echo osc_item_total_comments(); ?></span>

          </h2>

          <div class="wrap">
            <?php if(osc_item_total_comments() > 0) { ?>
              <?php while(osc_has_item_comments()) { ?>
                <div class="comment">
                  <div class="image">
                    <img src="<?php echo bet_profile_picture(osc_comment_user_id(), 'medium'); ?>" />
                  </div>

                  <div class="info">
                    <h3>
                      <span class="title"><?php echo(osc_comment_title() == '' ? __('Comment', 'beta') : osc_comment_title()); ?> <?php _e('by', 'beta'); ?> <?php echo (osc_comment_author_name() == '' ? __('Anonymous', 'beta') : osc_comment_author_name()); ?></span>
                      <span class="date"><?php echo bet_smart_date(osc_comment_pub_date()); ?></span>
                    </h3>

                    <div class="body"><?php echo osc_comment_body(); ?></div>
 
                    <?php if(osc_comment_user_id() && (osc_comment_user_id() == osc_logged_user_id())) { ?>
                      <a rel="nofollow" class="remove" href="<?php echo osc_delete_comment_url(); ?>" title="<?php echo osc_esc_html(__('Delete your comment', 'beta')); ?>">
                        <i class="fa fa-trash-o"></i> <span class="isDesktop"><?php _e('Delete', 'beta'); ?></span>
                      </a>
                    <?php } ?>
                  </div>
                </div>
              <?php } ?>

              <span><div class="paginate comment-pagi"><?php echo osc_comments_pagination(); ?></div></span>

            <?php } else { ?>
              <div class="empty-comment"><?php _e('No comments has been added yet', 'beta'); ?></div>
            <?php } ?>
          </div>

          <div class="button-wrap">
            <?php if((osc_reg_user_post_comments() && osc_is_web_user_logged_in() || !osc_reg_user_post_comments()) && osc_logged_user_id() <> osc_item_user_id()) { ?>
              <a class="open-form new-comment btn mbBg" href="<?php echo bet_fancy_url('comment'); ?>" data-type="comment"><i class="fa fa-comment-o"></i> <?php _e('Add a new comment', 'beta'); ?></a>
            <?php } ?>
          </div>
        </div>
      <?php } ?>

      <?php echo bet_banner('item_sidebar_bottom'); ?>

    </div>


    <?php bet_related_ads(); ?>

    <?php echo bet_banner('item_bottom'); ?>

  </div>


  <?php if($mobile_found) { ?>
    <a href="#" class="mbBg mobile-item item-phone isMobile">
      <i class="fa fa-phone"></i>
    </a>
  <?php } ?>

  <a href="<?php echo bet_fancy_url('contact'); ?>" class="mobile-item item-contact open-form contact isMobile" data-type="contact">
    <i class="fa fa-envelope-o"></i>
  </a>

  <div class="mobile-item-data" style="display:none">
    <a href="tel:<?php echo $mobile; ?>"><?php echo sprintf(__('Call %s', 'beta'), $mobile); ?></a>
    <a href="sms:<?php echo $mobile; ?>"><?php echo __('Send SMS', 'beta'); ?></a>
    <a href="<?php echo $mobile; ?>" class="copy-number" data-done="<?php echo osc_esc_html(__('Copied to clipboard!', 'beta')); ?>"><?php echo __('Copy number', 'beta'); ?></a>
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


      // SHOW EMAIL
      $('body').on('click', '.email', function(e) {
        if($(this).attr('href') == '#') {
          e.preventDefault()

          var email = $(this).attr('data-email');
          $(this).text(email);
          $(this).attr('href', 'mailto:' + email);
          $(this).attr('title', '<?php echo osc_esc_js(__('Click to send mail', 'beta')); ?>');
        }        
      });


    });
  </script>

  <?php osc_current_web_theme_path('footer.php') ; ?>
</body>
</html>				