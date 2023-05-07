<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="<?php echo str_replace('_', '-', osc_current_user_locale()); ?>">
<head>

  <?php osc_current_web_theme_path('head.php');?>

<style>

    .osp-promote-form{display:none;}
</style>

  <?php
// GET IF PAGE IS LOADED VIA QUICK VIEW
$content_only = (Params::getParam('contentOnly') == 1 ? 1 : 0);
    $VIN = VinCheck();
    $pint_cat = [124,122,120];
    $credius =[121,123,125,128,231,103,106,107,108,109,110,151,152,153,156,157,154,155,158,159,215,111,112,113,114,115,116,117,251,242,214,151,160,161,162,163,164,165,238,173,172,239,166,167,168,169,171,180,181,204,174,175,176,177,178,179,240,247,232,233,234,235,182,160,168,180,174,183,183,223,224,184,185,186,187,213,];

// FORMAT PRICE FOR SOCIAL TAGS
if (osc_item_price() == '') {
    $og_price = __('Check with seller', 'stela');
} else if (osc_item_price() == 0) {
    $og_price = __('Free', 'stela');
} else {
    $og_price = osc_item_price();

}

// GET ITEM EXTRA
$item_extra = stela_item_extra(osc_item_id());
$item_detail = stela_item_detail();

// GET IF BROWSER IS IOS
$ios = false;
if (strstr($_SERVER['HTTP_USER_AGENT'], 'iPhone') || strstr($_SERVER['HTTP_USER_AGENT'], 'iPod')) {
    $ios = true;
}

// GET LOCATION
$location_array = array(osc_item_country(), osc_item_region(), osc_item_city(), osc_item_address());
$location_array = array_filter($location_array);
$item_loc = implode(', ', $location_array);

// GET USER ARRAY
if (osc_item_user_id() != 0) {
    $item_user = User::newInstance()->findByPrimaryKey(osc_item_user_id());
}

// LINK SHOW TO PAY
 $item_id =  osc_item_id();
    $type = OSP_TYPE_LINK;
    $link_show_paid = false;
    $link_show = ModelOSP::newInstance()->feeIsPaid($type, $item_id);

if( $link_show == true){
  $link_show_paid = true;
}

// MOBILE NUMBER
$mobile_found = true;
$mobile = $item_extra['s_phone'];

if ($mobile == '' && osc_item_user_id() != 0) {$mobile = $item_user['s_phone_mobile'];}
if ($mobile == '' && osc_item_user_id() != 0) {$mobile = $item_user['s_phone_land'];}

if (trim($mobile) == '' || strlen(trim($mobile)) < 4) {
    $mobile = __('No phone number', 'stela');
    $mobile_found = false;
}

// CATEGORY ICON
$root = stela_category_root(osc_item_category_id());
$cat_icon = stela_get_cat_icon($root['pk_i_id'], true);
if ($cat_icon != '') {
    $icon = $cat_icon;
} else {
    $def_icons = array(1 => 'fa-gavel', 2 => 'fa-car', 3 => 'fa-book', 4 => 'fa-home', 5 => 'fa-wrench', 6 => 'fa-music', 7 => 'fa-heart', 8 => 'fa-briefcase', 999 => 'fa-soccer-ball-o');
    $icon = $def_icons[$root['pk_i_id']];
}


$make_offer_enabled = false;
if(function_exists('mo_call_after_install')) {
  $setting = ModelMO::newInstance()->getOfferSettingByItemId(osc_item_id());
    if((isset($setting['i_enabled']) && $setting['i_enabled'] == 1) || ((!isset($setting['i_enabled']) || $setting['i_enabled'] == '') && $history == 1)) {
      $make_offer_enabled = true;
    }
}

?>


  <?php if ($content_only == 0) {?>

    <!-- FACEBOOK OPEN GRAPH TAGS -->
    <?php osc_get_item_resources();?>
    <meta property="og:title" content="<?php echo osc_esc_html(osc_item_title()); ?>" />
    <?php if (osc_count_item_resources() > 0) {?><meta property="og:image" content="<?php echo osc_resource_url(); ?>" /><?php }?>
    <meta property="og:site_name" content="<?php echo osc_esc_html(osc_page_title()); ?>"/>
    <meta property="og:url" content="<?php echo osc_item_url(); ?>" />
    <meta property="og:description" content="<?php echo osc_esc_html(osc_highlight(osc_item_description(), 500)); ?>" />
    <meta property="og:type" content="article" />
    <meta property="og:locale" content="<?php echo osc_current_user_locale(); ?>" />
    <meta property="product:retailer_item_id" content="<?php echo osc_item_id(); ?>" />
    <meta property="product:price:amount" content="<?php echo $og_price; ?>" />
    <?php if (osc_item_price() != '' and osc_item_price() != 0) {?><meta property="product:price:currency" content="<?php echo osc_item_currency(); ?>" /><?php }?>

    <!-- GOOGLE RICH SNIPPETS -->
    <span itemscope itemtype="http://schema.org/Product">
      <meta itemprop="name" content="<?php echo osc_esc_html(osc_item_title()); ?>" />
      <meta itemprop="description" content="<?php echo osc_esc_html(osc_highlight(osc_item_description(), 500)); ?>" />
      <?php if (osc_count_item_resources() > 0) {?><meta itemprop="image" content="<?php echo osc_resource_url(); ?>" /><?php }?>
    </span>
  <?php }?>
  
  
  
  
</head>


<body id="body-item" class="page-body<?php if ($content_only == 1) {?> content_only<?php }?><?php if ($ios) {?> ios<?php }?>">
  <?php if ($content_only == 0) {?>
    <?php osc_current_web_theme_path('header.php');?>
    <?php if (osc_item_is_expired()) {?>
      <div class="exp-box">
        <div class="exp-mes round3"><?php _e('This listing is expired.', 'stela');?></div>
      </div>
    <?php }?>
  <?php }?>





  <div id="listing" class="content list">

 <div class="ad-box">
  <a href="https://www.helpnhome.ro"><img class="ad-data" alt="ads" src="<?php echo osc_current_web_theme_url('images/red.png'); ?>"></img>
        </div>


    


    <?php if ($content_only == 0) {?>
      <div class="flash-wrap">
        <?php osc_show_flash_message();?>
      </div>

      <?php echo stela_banner('item_top'); ?>

      <?php
osc_show_widgets('header');
    $breadcrumb = osc_breadcrumb('<span class="bread-arrow">/</span>', false);
    $breadcrumb = str_replace('<span itemprop="title">' . osc_page_title() . '</span>', '', $breadcrumb);
    ?>

      <div class="item-first">
        <?php if ($breadcrumb != '') {?>
          <div class="breadcrumb">
            <font color="#000"><b><?php echo $breadcrumb; ?></b></font>
          </div>



        <?php }?>








        <h1 class="item-title" style="color:#262626;"><?php echo osc_item_title(); ?></h1>
      </div>



    <?php }?>





    <!-- LISTING BODY -->
    <div id="main">


      <!-- Image Block -->
      <div id="left" class="round3 i-shadow">






        <?php if ($content_only == 0) {?>
          <div id="price">


              <?php

    echo osc_item_formated_price();

    ?>



             <?php

    $servername = "localhost";
    $username = "zzbeng_osclass";
    $password = "_15o+CQU;D0N";
    $dbname = "zzbeng_osclass";
    $iid = osc_item_id();

// Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT fk_i_item_id, fk_i_attribute_value_id, fk_i_attribute_id FROM oc_t_item_attribute";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {

            if ($row["fk_i_item_id"] == "$iid") {

                if ($row["fk_i_attribute_id"] == "11") {

                    if (osc_item_formated_price() == 0) {
                        if ($row["fk_i_attribute_value_id"] == "61") {echo " ";}
                        if ($row["fk_i_attribute_value_id"] == "58") {echo " ";}
                        if ($row["fk_i_attribute_value_id"] == "59") {echo " ";}

                    } else if (osc_item_formated_price() == null) {

                        if ($row["fk_i_attribute_value_id"] == "61") {echo " ";}
                        if ($row["fk_i_attribute_value_id"] == "58") {echo " ";}
                        if ($row["fk_i_attribute_value_id"] == "59") {echo " ";}

                    } else {

                        if (osc_current_user_locale() == "ro_RO") {if ($row["fk_i_attribute_value_id"] == "58") {echo " ( Pret Fix )";}
                        } else {
                            if ($row["fk_i_attribute_value_id"] == "58") {echo " ( Fixed Price )";}
                        }

                        if (osc_current_user_locale() == "ro_RO") {if ($row["fk_i_attribute_value_id"] == "59") {echo " ( Negociabil )";}
                        } else {
                            if ($row["fk_i_attribute_value_id"] == "59") {echo " ( Negotiable )";}
                        }

                        if (osc_current_user_locale() == "ro_RO") {if ($row["fk_i_attribute_value_id"] == "61") {echo " ( Negociabil )";}
                        } else {
                            if ($row["fk_i_attribute_value_id"] == "61") {echo " ( Negotiable )";}
                        }

                    }
                }

            }

        }
    } else {

    }
    $conn->close();

    ?>




          </div>


          <div class="labels">
            <?php if ($item_extra['i_sold'] == 1) {?>
              <div class="elem sold"><i class="fa fa-gavel"></i> <?php _e('Sold', 'stela');?></div>
            <?php } else if ($item_extra['i_sold'] == 2) {?>
              <div class="elem reserved"><i class="fa fa-flag"></i> <?php _e('Reserved', 'stela');?></div>
            <?php }?>

            <?php if (osc_item_is_premium()) {?>
              <div class="elem premium"><i class="fa fa-star"></i> <?php _e('Premium', 'stela');?></div>
            <?php }?>


            <?php if (!in_array(osc_item_category_id(), stela_extra_fields_hide())) {?>
              <?php if (stela_condition_name($item_extra['i_condition'])) {?>
                <div class="elem condition"><?php _e('Condition', 'stela');?>: <span><?php echo stela_condition_name($item_extra['i_condition']); ?></span></div>
              <?php }?>

              <?php if (stela_transaction_name($item_extra['i_transaction'])) {?>
                <div class="elem transaction"><?php _e('Transaction', 'stela');?>: <span><?php echo stela_transaction_name($item_extra['i_transaction']); ?></span></div>
              <?php }?>
            <?php }?>
          </div>


        <?php }?>


  <div id="images">
          <?php if (osc_images_enabled_at_items()) { ?>
            <?php osc_get_item_resources(); ?>
            <?php osc_reset_resources(); ?>
            <?php if (osc_count_item_resources() > 0) { ?>
              <div class="swiper-container<?php if (osc_count_item_resources() <= 1) { ?> hide-buttons<?php } ?>">
                <div class="swiper-wrapper">
                  <?php for ($i = 0; osc_has_item_resources(); $i++) { ?>
                    <li class="swiper-slide ratio">
                      <a href="<?php echo osc_resource_url(); ?>">
                        <img src="<?php echo osc_resource_url(); ?>" alt="<?php echo osc_esc_html(osc_item_title()); ?> - <?php echo $i + 1; ?>" />
                      </a>
                    </li>
                  <?php } ?>
                </div>
                <div class="swiper-button swiper-next"><i class="fa fa-caret-right"></i></div>
                <div class="swiper-button swiper-prev"><i class="fa fa-caret-left"></i></div>
              </div>
            <?php } ?>
          <?php } ?>
        </div>
 
 
 
<?php if (osc_category_id() == 101) {?>
<div class='desc-bottom'>
      <div>
          <img style="width:120px;height:auto;margin-bottom:10px;" src="https://zzbeng.ro/oc-content/themes/stela/images/cv.png" /><br/>
          <a style="font-weight:bold;font-size:16px;" href="https://www.carvertical.com/ro/landing/aff/moto?a=zzbeng&b=fdde094b">Verificati istoricul</a>
         </div>
          </div>
    <?php }?>      
<?php if (osc_category_id() == 100) {?>
 <?php if (!empty($VIN)) { ?>
<div class='desc-bottom'>
      <div>
          <img style="width:120px;height:auto;margin-bottom:10px;" src="https://zzbeng.ro/oc-content/themes/stela/images/cv.png" /><br/>
          <a style="font-weight:bold;font-size:16px;" href="https://www.carvertical.com/ro/verificare-prealabila?a=zzbeng&b=e4434505&vin=<?php echo $VIN ?>">Verificati istoricul</a></div>
      <div>
          <img style="width:65px;height:auto;" src="https://zzbeng.ro/oc-content/themes/stela/images/pint.png" /><br/>
          <a style="font-weight:bold;font-size:16px;" href="https://event.2performant.com/events/click?ad_type=quicklink&aff_code=6d3bbfe20&unique=4ae47c7ef&redirect_to=https%253A//www.pint.ro">Calculeaza RCA</a></div>
          </div>
          <?php
} else {{?>
<div class='desc-bottom'>
      <div>
          <img style="width:120px;height:auto;margin-bottom:10px;" src="https://zzbeng.ro/oc-content/themes/stela/images/cv.png" /><br/>
          <a style="font-weight:bold;font-size:16px;" href="https://www.carvertical.com/ro/landing/v3?utm_source=aff&a=zzbeng&b=0eb206ae">Verificati istoricul</a></div>
      <div>
          <img style="width:65px;height:auto;" src="https://zzbeng.ro/oc-content/themes/stela/images/pint.png" /><br/>
          <a style="font-weight:bold;font-size:16px;" href="https://event.2performant.com/events/click?ad_type=quicklink&aff_code=6d3bbfe20&unique=4ae47c7ef&redirect_to=https%253A//www.pint.ro">Calculeaza RCA</a></div>
          </div>

<?php }?>
<?php }?>
  <?php } ?>
<?php if(in_array(osc_category_id(), $pint_cat)){ ?>
<div class='desc-bottom'>
         <div>
          <img style="width:65px;height:auto;" src="https://zzbeng.ro/oc-content/themes/stela/images/pint.png" /><br/>
          <a style="font-weight:bold;font-size:16px;" href="https://event.2performant.com/events/click?ad_type=quicklink&aff_code=6d3bbfe20&unique=4ae47c7ef&redirect_to=https%253A//www.pint.ro">Asigura locuinta</a></div>
          </div>
<?php } ?>

<?php if (osc_category_id() == 203) {?>
<div class='desc-bottom'>
      <div>
          <img style="width:120px;height:auto;" src="https://zzbeng.ro/oc-content/themes/stela/images/erotic24.png" /><br/>
          <a style="font-weight:bold;font-size:16px;text-decoration: none;" href="https://event.2performant.com/events/click?ad_type=quicklink&aff_code=6d3bbfe20&unique=60b800055&redirect_to=https%253A//www.erotic24.ro/">Cumpara accesorii</a></div>
           </div>
<?php }?>

<?php if(in_array(osc_category_id(), $credius)){ ?>
<div class='desc-bottom'>
         <div>
          <img style="width:65px;height:auto;" src="https://zzbeng.ro/oc-content/themes/stela/images/credius.png" /><br/>
          <a style="font-weight:bold;font-size:16px;text-decoration: none;" href="https://event.2performant.com/events/click?ad_type=quicklink&aff_code=6d3bbfe20&unique=bdff35483&redirect_to=https%253A//www.credius.ro">Acceseaza credit</a></div>
          </div>
<?php } ?>

<div class="item-desc">



<br>
            <div class="text">



             <?php echo links_clickable(osc_item_description()); ?>


<br>
<br>




            </div>
          </div>



<div id="cv" class="not767">

            <?php if(function_exists('atr_show_attribute')) { echo atr_show_attribute(15); } ?>
            

        <?php if(function_exists('atr_show_attribute') && $link_show == true) { echo atr_show_attribute( 20 ); } ?>
        
        <?php if(function_exists('atr_show_attribute') && $link_show == true) { echo atr_show_attribute( 21 ); } ?>

 </div>



        <div id="spec-block" class="is767">



                   <br>

      <div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/ro_RO/sdk.js#xfbml=1&version=v7.0&appId=643832216017902&autoLogAppEvents=1"></script>




          <div class="title"><?php echo osc_item_title(); ?></div>

          <div class="labs">
            <div class="price"><?php echo osc_item_formated_price(); ?>


             <?php

$servername = "localhost";
$username = "zzbeng_osclass";
$password = "_15o+CQU;D0N";
$dbname = "zzbeng_osclass";
$iid = osc_item_id();

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT fk_i_item_id, fk_i_attribute_value_id, fk_i_attribute_id FROM oc_t_item_attribute";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {

        if ($row["fk_i_item_id"] == "$iid") {

            if ($row["fk_i_attribute_id"] == "11") {

                if (osc_item_formated_price() == 0) {
                    if ($row["fk_i_attribute_value_id"] == "61") {echo " ";}
                    if ($row["fk_i_attribute_value_id"] == "58") {echo " ";}
                    if ($row["fk_i_attribute_value_id"] == "59") {echo " ";}

                } else if (osc_item_formated_price() == null) {

                    if ($row["fk_i_attribute_value_id"] == "61") {echo " ";}
                    if ($row["fk_i_attribute_value_id"] == "58") {echo " ";}
                    if ($row["fk_i_attribute_value_id"] == "59") {echo " ";}

                } else {

                    if (osc_current_user_locale() == "ro_RO") {if ($row["fk_i_attribute_value_id"] == "58") {echo " ( Pret Fix )";}
                    } else {
                        if ($row["fk_i_attribute_value_id"] == "58") {echo " ( Fixed Price )";}
                    }

                    if (osc_current_user_locale() == "ro_RO") {if ($row["fk_i_attribute_value_id"] == "59") {echo " ( Negociabil )";}
                    } else {
                        if ($row["fk_i_attribute_value_id"] == "59") {echo " ( Negotiable )";}
                    }

                    if (osc_current_user_locale() == "ro_RO") {if ($row["fk_i_attribute_value_id"] == "61") {echo " ( Negociabil )";}
                    } else {
                        if ($row["fk_i_attribute_value_id"] == "61") {echo " ( Negotiable )";}
                    }

                }
            }

        }

    }
} else {

}
$conn->close();

?>

</div>
</div>


            <div class="labs">

            <div class="category"><a target="_top" href="<?php echo osc_search_url(array('sCategory' => osc_item_category_id())); ?>"><i class="fa <?php echo $icon; ?>"></i><span><?php echo osc_item_category(); ?></span></a></div>

            <?php if (!in_array(osc_item_category_id(), stela_extra_fields_hide())) {?>
             

              <?php if (stela_transaction_name($item_extra['i_transaction'])) {?>
                <div class="transaction"><span><?php echo stela_transaction_name($item_extra['i_transaction']); ?></span></div>
              <?php }?>
              
               <?php if (stela_condition_name($item_extra['i_condition'])) {?>
                <div class="condition"><span><?php echo stela_condition_name($item_extra['i_condition']); ?></span></div>
              <?php }?>
            <?php }?>
          </div>

          <div class="viewer-desc">
            <?php echo links_clickable(osc_item_description()); ?>
          </div>
          
          
        <div id="cv">

            <?php if(function_exists('atr_show_attribute')) { echo atr_show_attribute(15); } ?>
            

        <?php if(function_exists('atr_show_attribute') && $link_show == true) { echo atr_show_attribute( 20 ); } ?>
        
        <?php if(function_exists('atr_show_attribute') && $link_show == true) { echo atr_show_attribute( 21 ); } ?>

 </div>  
          
        </div>


        <?php if ($content_only == 0) {?>
          <div class="item-stats">
            <span class='not767' title="<?php echo osc_format_date(osc_item_pub_date()); ?>"><?php _e('Published', 'stela');?> <?php echo stela_smart_date(osc_item_pub_date()); ?></span>

            <?php if (osc_item_mod_date() != '') {?>
              <span class='not767' title="<?php echo osc_format_date(osc_item_pub_date()); ?>"><?php _e('Modified', 'stela');?> <?php echo stela_smart_date(osc_item_mod_date()); ?></span>
            <?php }?>

            <span class='not767'><?php echo osc_item_views(); ?> <?php _e('views', 'stela');?></span>
            <span class='not767'><?php echo stela_phone_clicks(osc_item_id()); ?> <?php _e('calls', 'stela');?></span>
          </div>
        <?php }?>
      </div>


      <?php if ((osc_count_item_meta() > 0 || $item_detail) && $content_only == 0) {?>
        <div class="details">
          <h3 class="def-h"><?php _e('Additional information', 'stela');?></h3>

          <?php $has_custom = false;?>
          <?php if (osc_count_item_meta() >= 1) {?>
            <div id="custom_fields">

              <div class="meta_list">
                <?php $class = 'odd';?>
                <?php while (osc_has_item_meta()) {?>
                  <?php if (osc_item_meta_value() != '') {?>
                    <?php $has_custom = true;?>
                    <div class="meta <?php echo $class; ?>">
                      <div class="ins">
                        <span><?php echo osc_item_meta_name(); ?>:</span> <?php echo osc_item_meta_value(); ?>
                      </div>
                    </div>
                  <?php }?>

                  <?php $class = ($class == 'even') ? 'odd' : 'even';?>
                <?php }?>
              </div>

            </div>
          <?php }?>

          <div id="plugin-details">
            <?php echo $item_detail; ?>
          </div>
        </div>
      <?php }?>





      <?php
     if(osc_category_id()!=203){
    
    echo stela_banner('item_description'); }?>


      <?php if ($content_only == 0 && osc_comments_enabled()) {?>

        <!-- Comments-->
        <div id="more-info" class="comments round3 i-shadow">
          <?php if (osc_count_item_comments() == 1) {?>
            <h2 class="comment-h"><?php echo sprintf(__('%d review for %s', 'stela'), osc_count_item_comments(), ucfirst(osc_highlight(osc_item_title(), 50))); ?></h2>
          <?php } else if (osc_count_item_comments() > 1) {?>
            <h2 class="comment-h"><?php echo sprintf(__('%d reviews for %s', 'stela'), osc_count_item_comments(), ucfirst(osc_highlight(osc_item_title(), 50))); ?></h2>
          <?php } else {?>
            <h2 class="comment-h"><?php echo sprintf(__('No reviews for %s', 'stela'), ucfirst(osc_highlight(osc_item_title(), 50))); ?></h2>
          <?php }?>

          <div class="item-comments">

            <!-- LIST OF COMMENTS -->
            <div id="comments" class="sc-block">
              <div class="comments_list">

                <?php $class = 'even';?>
                <?php $i = 1;?>

                <?php if (osc_count_item_comments() == 0) {?>
                  <div class="no-comment"><?php _e('This listing has not been reviewed yet, be first!', 'stela');?></div>
                <?php }?>

                <?php while (osc_has_item_comments()) {?>
                  <div class="comment-wrap <?php echo $class; ?>">
                    <div class="ins">
                      <div class="comment-image">
                        <?php if (function_exists('profile_picture_show')) {?>
                          <?php profile_picture_show(100, 'comment', 100, $i);?>
                        <?php } else {?>
                          <img src="<?php echo osc_current_web_theme_url(); ?>images/profile-u<?php echo $i; ?>.png"/>
                        <?php }?>
                      </div>

                      <div class="comment">
                        <h4><?php echo osc_comment_title() != '' ? osc_comment_title() : __('Review', 'stela'); ?></h4>
                        <div class="line author"><strong><?php echo osc_comment_author_name() != '' ? osc_comment_author_name() : __('Anonymous', 'stela'); ?></strong> <em><?php _e('on', 'stela');?> <?php echo osc_comment_pub_date(); ?></em></div>
                        <div class="line body"><?php echo osc_comment_body(); ?></div>

                        <?php if (osc_comment_user_id() && (osc_comment_user_id() == osc_logged_user_id())) {?>
                          <a rel="nofollow" class="remove-comment" href="<?php echo osc_delete_comment_url(); ?>" title="<?php echo osc_esc_html(__('Delete your comment', 'stela')); ?>">
                            <i class="fa fa-times"></i> <?php _e('Delete this comment', 'stela');?>
                          </a>
                        <?php }?>
                      </div>
                    </div>
                  </div>

                  <div class="clear"></div>
                  <?php $class = ($class == 'even') ? 'odd' : 'even';?>

                  <?php
$i++;
    $i = $i % 3 + 1;
    ?>
                <?php }?>

                <div class="paginate"><?php echo osc_comments_pagination(); ?></div>
              </div>
            </div>


            <?php if (osc_reg_user_post_comments() && osc_is_web_user_logged_in() || !osc_reg_user_post_comments()) {?>
              <a class="add-com btn btn-primary tr1 round3" href="<?php echo osc_item_send_friend_url(); ?>"><?php _e('Add new comment', 'stela');?></a>
            <?php }?>
          </div>
        </div>
      <?php }?>

      <?php if ($content_only == 0) {?>
        <?php echo stela_banner('item_bottom'); ?>
      <?php }?>
    </div>


    <!-- RIGHT SIDEBAR -->
    <div id="side-right" class="<?php if ($item_loc == '') {?>loc-empty<?php }?>">
      <?php if ($content_only != 0) {?>
        <div class="open-list">
          <a target="_top" class="btn btn-primary tr1" href="<?php echo osc_item_url(); ?>"><?php _e('Open listing', 'stela');?></a>
        </div>
      <?php }?>

      <!-- ITEM LOCATION -->
      <div id="location" class="round3 i-shadow">
        <?php if ($item_loc != '') {?>
          <div class="map">
            <?php osc_run_hook('location');?>

            <?php if ($content_only == 0) {?>
              <div class="direction">
                <a class="btn btn-primary tr1 round3" target="_blank" href="https://www.google.com/maps?daddr=<?php echo urlencode($item_loc); ?>"><?php _e('Vezi Pe Harta', 'stela');?></a>
              </div>
            <?php }?>
          </div>
        <?php }?>

        <?php if ($content_only == 0) {?>
          <div class="body">
               <div class="name-box">
             <div class="name">
                  <?php if (function_exists('profile_picture_show')) {?>
                <?php if (osc_item_user_id() != 0 and osc_item_user_id() != '') {?>
                  <a class="side-prof" href="<?php echo osc_user_public_profile_url(osc_item_user_id()); ?>" title="<?php echo osc_esc_html(__('Check profile of this user', 'stela')); ?>">
                    <?php profile_picture_show(null, 'item', 200);?>
                  </a>
                <?php } else {?>
                  <div class="side-prof">
                    <?php profile_picture_show(null, 'item', 200);?>
                  </div>
                <?php }?>
              <?php }?>
                  <?php
$c_name = '';
    if (osc_item_contact_name() != '' and osc_item_contact_name() != __('Anonymous', 'stela')) {
        $c_name = osc_item_contact_name();
    }

    if ($c_name == '' and $item_user['s_name'] != '') {
        $c_name = $item_user['s_name'];
    }

    if ($c_name == '') {
        $c_name = __('Anonymous', 'stela');
    }
    ?>

                  <?php if (osc_item_user_id() != 0 and osc_item_user_id() != '') {?>
                    <a href="<?php echo osc_user_public_profile_url(osc_item_user_id()); ?>" title="<?php echo osc_esc_html(__('Check profile of this user', 'stela')); ?>">

                      <?php 
                      if (strlen($c_name) > 20)
             $c_name = substr($c_name, 0, 20) . '';
                      echo $c_name; ?>
                    </a>
                  <?php } else {?>
                    <?php 
                    if (strlen($c_name) > 20)
             $c_name = substr($c_name, 0, 20) . '';
                    echo $c_name; ?>
                  <?php }?>
                  
                  
                  <?php if(function_exists('ur_button_stars')) { echo ur_button_stars($user_id = osc_item_user_id(), $user_email = osc_item_contact_email(), $item_id = osc_item_id()); } ?>
                  
                  
                  
                </div>

              
          </div>
            <?php if ($item_loc != '') {?>
              <div class="row"><i class="fa fa-map-pin"></i> <?php echo $item_loc; ?></div>
            <?php }?>


 <div class="row">
      <i class="fa fa-star"></i>
       <?php if(function_exists('ur_button_add_mobile')) { echo ur_button_add_mobile($user_id = osc_item_user_id(), $item_id = osc_item_id()); } ?>

     </div>

            <?php if ($mobile_found) {?>
              <div class="row phone not767">
                <i class="fa fa-phone"></i>

                <a href="#" class="phone-block has-tooltip" data-item-id="<?php echo osc_item_id(); ?>" data-item-user-id="<?php echo osc_item_user_id(); ?>" title="<?php echo osc_esc_js(__('Vezi numarul de telefon', 'stela')); ?>">
                  <span>
                    <?php
if (strlen($mobile) >= 4 && $mobile != __('No phone number', 'stela')) {
        echo substr($mobile, 0, strlen($mobile) - 4) . 'xxxx';

    } else {
        echo $mobile;

    }
        ?>
                  </span>
                </a>
              </div>
            <?php }?>


            <?php if (osc_item_show_email()) {?>
              <div class="row">
                <i class="fa fa-at"></i>

                <?php
$mail = osc_item_contact_email();
        $mail_start = substr($mail, 0, 3);
        ?>

                <a href="#" class="mail-block has-tooltip" rel="<?php echo substr($mail, 3); ?>" title="<?php echo osc_esc_js(__('Click to show email address', 'stela')); ?>">
                  <span>
                    <?php echo $mail_start . 'xxxx@xxxx.xxxx'; ?>
                  </span>
                </a>
              </div>
            <?php }?>

            <?php if (function_exists('fi_save_favorite')) {?>
              <div class="row favorite">
                <?php echo fi_save_favorite(); ?>
              </div>
            <?php }?>

            <?php if (function_exists('mo_hook_button') && (osc_item_price() != 0)) {?>
              <?php
$hook = osc_get_preference('add_hook', 'plugin-make_offer');
        $hook = ($hook != '' ? $hook : 1);
        ?>

               <?php if ($hook == 1 && $make_offer_enabled == 1) {?>
                <div class="row make-offer">
                  <i class="fa fa-gavel"></i>
                  <?php echo mo_show_offer_link(); ?>
                </div>
              <?php }?>
            <?php }?>


    <!-- ITEM BUTTONS -->
    <div id="item-buttons">
              
                 <?php if (osc_is_web_user_logged_in()) {?>
                    <div class="elem">
                <?php if (function_exists('im_manage_contact_seller') && osc_get_preference('contact_seller', 'plugin-instant_messenger') == 1) {?>
                  <i class="fa fa-paper-plane-o"></i>
                  <a class="send-message" href="<?php echo osc_route_url('im-create-thread', array('item-id' => osc_item_id())); ?>"><?php _e('Send message', 'stela');?></a>

                  <?php } else {?>
                  <i class="fa fa-envelope-o"></i>
                  <a class="item-contact" href="<?php echo osc_item_send_friend_url(); ?>"><?php _e('Contact seller', 'stela');?></a>
                <?php }?>
              </div>

              <?php } else {?>
                <div class="elem">
                   <i class="fa fa-paper-plane-o"></i>
                   <a href="#" class="login-chat"><span><?php _e('Trimite mesaj privat', 'stela'); ?></span></a>
              </div>
                    <?php }?>


              <?php if (function_exists('show_feedback_overall') && osc_item_user_id() > 0) {?>
                <div class="elem feedback">
                  <i class="fa fa-thumbs-o-up"></i>
                  <?php echo show_feedback_overall(); ?>
                  <?php echo leave_feedback(); ?>
                </div>
              <?php }?>

            

              <?php if (osc_item_user_id() != 0) {?>
                <div class="elem dash">
                  <i class="fa fa-dashboard"></i>

                 
                    <a href="<?php echo osc_user_public_profile_url(osc_item_user_id()); ?>"><?php _e('Anunturile utilizatorului', 'stela');?></a>
                
                </div>
              <?php }?>


             

              <div class='elem report'>
                  <i class="fas fa-flag"></i>
                    <div id="report-box" class="noselect tr1 is767">
                         
                <a href="#" class="report-button">
                 
                  <span><?php _e('Raporteaza', 'stela'); ?></span>
                </a>
              </div>
              </div>
              
            </div>
            
            
             
          </div>

        <?php }?>
        
        
      </div>


      <?php if (function_exists('sp_buttons') && $content_only == 0) {?>
        <div class="sms-payments">
          <?php echo sp_buttons(osc_item_id()); ?>
        </div>
      <?php }?>


      <?php if ($content_only == 0) {?>



        <!- SELLER INFO -->
        <div id="seller" class="round3 i-shadow not767<?php if (osc_item_user_id() == 0) {?> unreg<?php }?>">
            
          

          <div class="sc-block body">
            <div class="inside">

               <?php echo show_avatar(osc_item_user_id()); ?>

              <div class="name">

                <?php
$c_name = '';
    if (osc_item_contact_name() != '' and osc_item_contact_name() != __('Anonymous', 'stela')) {
        $c_name = osc_item_contact_name();
    }

    if ($c_name == '' and $item_user['s_name'] != '') {
        $c_name = $item_user['s_name'];
    }

    if ($c_name == '') {
        $c_name = __('Anonymous', 'stela');
    }
    ?>

                <?php if (osc_item_user_id() != 0 and osc_item_user_id() != '') {?>
                  <a href="<?php echo osc_user_public_profile_url(osc_item_user_id()); ?>" title="<?php echo osc_esc_html(__('Check profile of this user', 'stela')); ?>">
                     
                    <?php echo $c_name; ?>
                  </a>
                <?php } else {?>
                  <?php echo $c_name; ?>
                <?php }?>
             
              
              
            
              
               </div>
               
                <?php if(function_exists('ur_button_stars')) { echo ur_button_stars($user_id = osc_item_user_id(), $user_email = osc_item_contact_email(), $item_id = osc_item_id()); } ?> 
            </div>


            <!-- IF USER OWN THIS LISTING, SHOW SELLER TOOLS -->
            <?php if (osc_is_web_user_logged_in() && osc_item_user_id() == osc_logged_user_id()) {?>
              <div id="s-tools">
                <a href="<?php echo osc_item_edit_url(); ?>" class="tr1 round2"><i class="fa fa-edit tr1"></i><span><?php _e('Edit', 'stela');?></span></a>
                <a href="<?php echo osc_item_delete_url(); ?>" class="tr1 round2" onclick="return confirm('<?php _e('Are you sure you want to delete this listing? This action cannot be undone.', 'stela');?>?')"><i class="fa fa-trash-o tr1"></i><span><?php _e('Remove', 'stela');?></span></a>

                <?php
if (osc_rewrite_enabled()) {
        if ($item_extra['i_sold'] == 0) {
            $sold_url = '?itemId=' . osc_item_id() . '&markSold=1&secret=' . osc_item_field('s_secret') . '&itemType=active';
            $reserved_url = '?itemId=' . osc_item_id() . '&markSold=2&secret=' . osc_item_field('s_secret') . '&itemType=active';
        } else {
            $sold_url = '?itemId=' . osc_item_id() . '&markSold=0&secret=' . osc_item_field('s_secret') . '&itemType=active';
            $reserved_url = '?itemId=' . osc_item_id() . '&markSold=0&secret=' . osc_item_field('s_secret') . '&itemType=active';
        }
    } else {
        if ($item_extra['i_sold'] == 0) {
            $sold_url = '&itemId=' . osc_item_id() . '&markSold=1&secret=' . osc_item_field('s_secret') . '&itemType=active';
            $reserved_url = '&itemId=' . osc_item_id() . '&markSold=2&secret=' . osc_item_field('s_secret') . '&itemType=active';
        } else {
            $sold_url = '&itemId=' . osc_item_id() . '&markSold=0&secret=' . osc_item_field('s_secret') . '&itemType=active';
            $reserved_url = '&itemId=' . osc_item_id() . '&markSold=0&secret=' . osc_item_field('s_secret') . '&itemType=active';
        }
    }
        ?>


                <?php if (!in_array(osc_item_category_id(), stela_extra_fields_hide())) {?>
                  <a target="_blank" class="tr1 round2 sold" href="<?php echo osc_user_list_items_url() . $sold_url; ?>"><i class="fa fa-gavel"></i> <span><?php echo ($item_extra['i_sold'] == 1 ? __('Not sold', 'stela') : __('Sold', 'stela')); ?></span></a>
                  <a target="_blank" class="tr1 round2 reserved" href="<?php echo osc_user_list_items_url() . $reserved_url; ?>"><i class="fa fa-flag-o"></i> <span><?php echo ($item_extra['i_sold'] == 2 ? __('Unreserve', 'stela') : __('Reserved', 'stela')); ?></span></a>
                <?php }?>
              </div>
            <?php }?>


            <!-- ITEM BUTTONS -->
            <div id="item-buttons">
                  <?php if (osc_is_web_user_logged_in()) {?>
                    <div class="elem">
                <?php if (function_exists('im_manage_contact_seller') && osc_get_preference('contact_seller', 'plugin-instant_messenger') == 1) {?>
                  <i class="fa fa-paper-plane-o"></i>
                  <a class="send-message" href="<?php echo osc_route_url('im-create-thread', array('item-id' => osc_item_id())); ?>"><?php _e('Send message', 'stela');?></a>

                  <?php } else {?>
                  <i class="fa fa-envelope-o"></i>
                  <a class="item-contact" href="<?php echo osc_item_send_friend_url(); ?>"><?php _e('Contact seller', 'stela');?></a>
                <?php }?>
              </div>

              <?php } else {?>
                <div class="elem">
                   <i class="fa fa-paper-plane-o"></i>
                   <a href="#" class="login-chat"><span><?php _e('Trimite mesaj privat', 'stela'); ?></span></a>
              </div>
                    <?php }?>


                <div class="elem">
                <i class="fa fa-heart"></i>
              <a class=" not767" href="https://zzbeng.ro/favorite-lists/0/0/0/0/0"><?php _e('Salveaza anuntul', 'stela'); ?></a>
              </div>
              
              <?php if (function_exists('im_manage_contact_seller')) {?>
                <?php if (osc_get_preference('contact_seller', 'plugin-instant_messenger') != 1) {?>
                    <?php if (function_exists('im_contact_button')) {im_contact_button();}?>
                <?php }?>
              <?php }?>

              <?php if (function_exists('show_feedback_overall') && osc_item_user_id() > 0) {?>
                <div class="elem feedback">
                  <i class="fa fa-thumbs-o-up"></i>
                  <?php echo show_feedback_overall(); ?>
                  <?php echo leave_feedback(); ?>
                </div>
              <?php }?>

              <?php if (function_exists('ur_hook_show_rating_stars') && osc_item_user_id() > 0) {?>
                <div class="elem user-rating">
                  <i class="fa fa-thumbs-o-up"></i>
                  <?php echo ur_show_rating_stars(); ?>
                  <?php echo ur_add_rating_link(); ?>
                </div>
              <?php }?>

              <?php if (osc_item_user_id() != 0) {?>
                <div class="elem dash">
                  <i class="fa fa-dashboard"></i>

                  
                    <a href="<?php echo osc_user_public_profile_url(osc_item_user_id()); ?>"><?php _e('Anunturile utilizatorului', 'stela');?></a>
                 
                </div>
              <?php }?>


              <?php if (osc_item_user_id() != 0) {?>
                <div class="elem type">
                  <?php $user = User::newInstance()->findByPrimaryKey(osc_item_user_id());?>
                  <?php if ($user['b_company'] == 1) {?>
                    <i class="fa fa-briefcase"></i> <?php _e('Firma', 'stela');?>
                  <?php } else {?>
                    <i class="fa fa-user-o"></i> <?php _e('Persoana fizica', 'stela');?>
                  <?php }?>
                </div>
              <?php }?>
 <!--<div class="share-box">-->
            <div class="elem feedback">
                 <i class="fas fa-flag"></i>
              <div id="report-box" class="noselect tr1 not767">
                <a href="#" class="report-button">
                 
                  <span><?php _e('Raporteaza', 'stela'); ?></span>
                </a>
              </div>

              <div class="login-wrap" style="display:none;">
                <div id="report">
              <div class="ur-status ur-info">
                <div class="ur-row"><i class="fa fa-exclamation-circle"></i></div>
                <div class="ur-row">
                  <?php _e('Trebuie sa fi logat sa poti trimite mesaje.', 'stela'); ?>
                </div>
              </div>
              </div>

              <div class="report-wrap" style="display:none;">
                <div id="report">
                  <?php if (osc_is_web_user_logged_in()) { ?>
                    <div class="header"><?php _e('Raporteaza', 'stela'); ?></div>

                    <div class="text">
                      <a href="<?php echo osc_item_link_spam(); ?>" rel="nofollow"><?php _e('Spam', 'stela'); ?></a>
                      <a href="<?php echo osc_item_link_bad_category(); ?>" rel="nofollow"><?php _e('Categorie gresita', 'stela'); ?></a>
                      <a href="<?php echo osc_item_link_repeated(); ?>" rel="nofollow"><?php _e('Duplicat', 'stela'); ?></a>
                      <a href="<?php echo osc_item_link_expired(); ?>" rel="nofollow"><?php _e('Expirat', 'stela'); ?></a>
                      <a href="<?php echo osc_item_link_offensive(); ?>" rel="nofollow"><?php _e('Ofensator', 'stela'); ?></a>
                    </div>
              
             <?php } else { ?>
              <div class="ur-status ur-info">
                <div class="ur-row"><i class="fa fa-exclamation-circle"></i></div>
                <div class="ur-row">
                  <?php _e('Trebuie sa fi logat pentru a raporta anuntul.', 'stela'); ?>
                </div>
              </div>
                
             <?php } ?>
       </div>
              </div>

              <!--<div class="elem regdate">-->
              <!--  <?php if (osc_item_user_id() != 0) {?>-->
              <!--    <i class="fa fa-calendar"></i>-->
              <!--    <?php $get_user = User::newInstance()->findByPrimaryKey(osc_item_user_id());?>-->

              <!--    <?php if (isset($get_user['dt_reg_date']) and $get_user['dt_reg_date'] != '') {?>-->
              <!--      <?php echo __('Inregistrat pe', 'stela') . ' ' . osc_format_date($get_user['dt_reg_date']); ?>-->
              <!--    <?php } else {?>-->
              <!--      <?php echo __('Unknown registration date', 'stela'); ?>-->
              <!--    <?php }?>-->

              <!--  <?php }?>-->
              <!--</div>-->
            </div>
          </div>
          </div>
          
      
        <?php } ?>

              </div>

    <?php echo stela_banner('item_sidebar'); ?>


    </div>

  </div>


  <?php if ($content_only == 0) {?>
    <div class="not767 related_ad">
    <?php
      echo stela_related_ad_web()
      ?>
    </div>
    </div>

    <div id="related-block" class="is767">
      <?php echo stela_related_ads() ?>
    </div>


    <script type="text/javascript">

      $(document).ready(function(){
        // SHOW PHONE NUMBER ON CLICK
        <?php if ($mobile != __('Fara numar de telefon', 'stela')) {?>
          $('.phone-show, .phone-block').click(function(e){
            e.preventDefault();
            var mobile = "<?php echo $mobile; ?>";

            if($('.phone-block').attr('href') == '#') {
              $('.phone-block, .phone-show').attr('href', 'tel:' + mobile).addClass('shown');
              $('.phone-block span').text(mobile).css('font-weight', 'bold');
              $('#side-right .btn.contact-button .bot').text(mobile);
              $('.phone-show').text('<?php echo osc_esc_js(__('Apeleaza', 'stela')); ?>');

              return false;
            }
          });
        <?php } else {?>
          $('.phone-show, .phone-block').click(function(){
            return false;
          });
        <?php }?>


        // SHOW EMAIL
        <?php if (osc_item_show_email()) {?>
          $('.mail-show, .mail-block').click(function(){
            var mail_start = $('.mail-block > span').text();
            mail_start = mail_start.trim();
            mail_start = mail_start.substring(0, 3);
            var mail_end = $('.mail-block').attr('rel');
            var mail = mail_start + mail_end;

            if($('.mail-block').attr('href') == '#') {
              $('.mail-block, .mail-show').attr('href', 'mailto:' + mail);
              $('.mail-block span').text(mail).css('font-weight', 'bold');
              $('.mail-show').text('<?php echo osc_esc_js(__('Click pentru e-mail', 'stela')); ?>');

              return false;
            }
          });
        <?php } else {?>
          $('.phone-show, .phone-block').click(function(){
            return false;
          });
        <?php }?>
      });


      $(document).ready(function(){
        $('.comment-wrap').hover(function(){
          $(this).find('.hide').fadeIn(200);},
          function(){
          $(this).find('.hide').fadeOut(200);
        });

        $('.comment-wrap .hide').click(function(){
          $(this).parent().fadeOut(200);
        });

        $('#but-con').click(function(){
          $(".inner-block").slideToggle();
          $("#rel_ads").slideToggle();
        });


        <?php if (!$has_custom) {echo '$("#custom_fields").hide();';}?>


        // CHECK IF PRICE IN THIS CATEGORY IS ENABLED -->
        var cat_id = <?php echo osc_item_category_id(); ?>;
        var catPriceEnabled = new Array();

        <?php
$categories = Category::newInstance()->listAll(false);
    foreach ($categories as $c) {
        if ($c['b_price_enabled'] != 1) {
            echo 'catPriceEnabled[ ' . $c['pk_i_id'] . ' ] = ' . $c['b_price_enabled'] . ';';
        }
    }
    ?>

        if(catPriceEnabled[cat_id] == 0) {
          $(".item-details .price.elem").hide(0);
        }
      });

//       Fancybox.bind('[data-fancybox="gallery"]', {
//   Image: {
//     zoom: false,
//   },
// });



    </script>

 <script type="text/javascript">
    $('a[href="#"]').live("click", function(e) {
         return false;
         e.preventDefault();
    });
</script>

  <?php }?>


  <?php if ($content_only == 0) {?>
  <a class="mobile-post4 is767" href='https://api.whatsapp.com/send?phone=+4<?php echo $mobile; ?>&text=Buna ziua,vreau sa aflu mai multe detalii despre anuntul pe care l-ai postat in zzbeng.ro: <?php echo osc_item_title(); ?>' ><i class="fa fa-whatsapp" style="font-size:25px;"></i></a>
   <a class="mobile-post3 is767" href='tel:<?php echo $mobile; ?>' ><i class="fa fa-phone" style="font-size:25px;"></i></a>
    <?php osc_current_web_theme_path('footer.php');?>
  <?php }?>
</body>
</html>