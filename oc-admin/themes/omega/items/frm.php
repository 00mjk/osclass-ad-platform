<?php
if(!defined('ABS_PATH')) exit('ABS_PATH is not loaded. Direct access is not allowed.');
/*
 * Copyright 2014 Osclass
 * Copyright 2021 Osclass by OsclassPoint.com
 *
 * Osclass maintained & developed by OsclassPoint.com
 * You may not use this file except in compliance with the License.
 * You may download copy of Osclass at
 *
 *     https://osclass-classifieds.com/download
 *
 * Do not edit or add to this file if you wish to upgrade Osclass to newer
 * versions in the future. Software is distributed on an "AS IS" basis, without
 * warranties or conditions of any kind, either express or implied. Do not remove
 * this NOTICE section as it contains license information and copyrights.
 */


osc_enqueue_script('jquery-validate');
osc_enqueue_script('php-date');

if(osc_tinymce_items_enabled() == '1') {
  osc_enqueue_script('tiny_mce');
}

// cateogry js
$categories = Category::newInstance()->toTree();

$new_item = __get('new_item');
function customText($return = 'title'){
  $new_item = __get('new_item');
  $text = array();
  if( $new_item ) {
    $text['title']  = __('Listing');
    $text['subtitle'] = __('Add listing');
    $text['button']   = __('Add listing');
  } else {
    $text['title']  = __('Listing');
    $text['subtitle'] = __('Edit listing');
    $text['button']   = __('Update listing');
  }
  return $text[$return];
}

if($new_item) {
  $options = array(0,1,3,5,7,10,15,30);
} else {
  $options = array(-1,0,1,3,5,7,10,15,30);
}

function customPageHeader() { 
  ?>
  <h1><?php echo customText('title'); ?></h1>
  <?php
}

osc_add_hook('admin_page_header', 'customPageHeader');


function customPageTitle($string) {
  return sprintf('%s - %s', customText('subtitle'), $string);
}

osc_add_filter('admin_title', 'customPageTitle');


//customize Head
function customHead() {
?>
  <script type="text/javascript">

    document.write('<style type="text/css"> .tabber{ display:none; } </style>');
    $(document).ready(function(){
      $('input[name="user"]').attr( "autocomplete", "off" );
      $('#user,#fUser').autocomplete({
        source: "<?php echo osc_admin_base_url(true); ?>?page=ajax&action=userajax",
        minLength: 0,
        select: function( event, ui ) {
          if(ui.item.id=='') {
            $("#contact_info").show();
            return false;
          }
          $('#userId').val(ui.item.id);
          $('#fUserId').val(ui.item.id);
          $("#contact_info").hide();
        }
      });

      $('.ui-autocomplete').css('zIndex', 10000);

      <?php if(osc_locale_thousands_sep()!='' || osc_locale_dec_point() != '') { ?>
      $("#price").on("blur", function(event) {
        var price = $("#price").prop("value");
        <?php if(osc_locale_thousands_sep()!='') { ?>
        while(price.indexOf('<?php echo osc_esc_js(osc_locale_thousands_sep());  ?>')!=-1) {
          price = price.replace('<?php echo osc_esc_js(osc_locale_thousands_sep());  ?>', '');
        }
        <?php }; ?>
        <?php if(osc_locale_dec_point()!='') { ?>
        var tmp = price.split('<?php echo osc_esc_js(osc_locale_dec_point())?>');
        if(tmp.length>2) {
          price = tmp[0]+'<?php echo osc_esc_js(osc_locale_dec_point())?>'+tmp[1];
        }
        <?php }; ?>
        $("#price").prop("value", price);

      });
      <?php } ?>

      $('body').on('change', '#update_expiration', function() {
        if($(this).is(":checked")) {
          $('#dt_expiration').prop('value', '');
          $('div.update_expiration').show(0);
        } else {
          $('#dt_expiration').prop('value', '-1');
          $('div.update_expiration').hide(0);
        }
      });

      // $('body').on("created", '[name^="select_"]',function(evt) {
        // selectUi($(this));
      // });

    });
  </script>
  <?php ItemForm::location_javascript('admin'); ?>
  <?php if( osc_images_enabled_at_items() ) ItemForm::photos_javascript(); ?>
  <?php
}

osc_add_hook('admin_header','customHead', 10);


function customHead2() {
  if(osc_tinymce_items_enabled() == '1') { ?>
  <script type="text/javascript">
    tinyMCE.init({
      mode : "textareas",
      width: "100%",
      height: "560px",
      language: 'en',
      content_style: "body {font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Oxygen-Sans,Ubuntu,Cantarell,'Helvetica Neue',sans-serif;}",
      theme_advanced_toolbar_align : "left",
      theme_advanced_toolbar_location : "top",
      plugins : [
        "advlist autolink lists link image charmap preview anchor",
        "searchreplace visualblocks code fullscreen",
        "insertdatetime media table paste autoresize"
      ],
      min_height: 560,
      max_height: 720,
      entity_encoding : "raw",
      theme_advanced_buttons1_add : "forecolorpicker,fontsizeselect",
      theme_advanced_buttons2_add: "media",
      theme_advanced_buttons3: "",
      theme_advanced_disable : "styleselect,anchor",
      relative_urls : false,
      remove_script_host : false,
      convert_urls : false
    });
  </script>
  <?php
  }
}

osc_add_hook('admin_header','customHead2', 10);


$new_item   = __get('new_item');
$actions  = __get('actions');

function render_offset(){
  return 'row-offset';
}

osc_add_filter('render-wrapper','render_offset');


osc_current_admin_theme_path( 'parts/header.php' ); 
?>

<div id="pretty-form">
<div class="grid-row no-bottom-margin">
  <div class="row-wrapper">
    <h2 class="render-title">
      <?php echo customText('subtitle'); ?>
      
       <?php if(osc_item_id() > 0) { ?>
        #<?php echo osc_item_id(); ?>
      <?php } ?>
      
      <span class="front-link"><a href="<?php echo osc_item_url(); ?>"><?php _e('View listing on front'); ?> <i class="fa fa-external-link"></i></a></span>
    </h2>
    
    <?php osc_run_hook('admin_items_header'); ?>
  </div>
</div>

<div class="grid-row no-bottom-margin float-right">
  <div class="row-wrapper">
    <?php if( !$new_item ) { ?>
    <ul id="item-action-list">
      <?php osc_run_hook('admin_items_actions'); ?>
    
      <?php foreach($actions as $aux) { ?>
        <li><?php echo $aux; ?></li>
      <?php } ?>
    </ul>
    <div class="clear"></div>
    <?php } ?>
  </div>
</div>

<div class="grid-row grid-100">
  <div class="row-wrapper">
    <div id="item-form">
        <ul id="error_list"></ul>
        <?php printLocaleTabs(); ?>
        <form action="<?php echo osc_admin_base_url(true); ?>" method="post" enctype="multipart/form-data" name="item">
          <input type="hidden" name="page" value="items" />
          <?php if($new_item) { ?>
            <input type="hidden" name="action" value="post_item" />
          <?php } else { ?>
            <input type="hidden" name="action" value="item_edit_post" />
            <input type="hidden" name="id" value="<?php echo osc_item_id(); ?>" />
            <input type="hidden" name="secret" value="<?php echo osc_item_secret(); ?>" />
          <?php } ?>
          
          <div id="left-side">
            <?php osc_run_hook('admin_items_form_left_top'); ?>
            
            <?php printLocaleTitle(osc_get_locales()); ?>
            <div class="category">
              <label><?php _e('Category'); ?></label>
              <?php ItemForm::category_multiple_selects(); ?>
            </div>
            
            <div class="input-description-wide">
              <?php printLocaleDescription(osc_get_locales()); ?>
            </div>
            
            <?php if(osc_price_enabled_at_items()) { ?>
              <div>
                <label><?php _e('Price'); ?></label>
                <?php ItemForm::price_input_text(); ?>
                <span class="input-currency"><?php ItemForm::currency_select(); ?></span>
              </div>
            <?php } ?>

            <?php if( osc_images_enabled_at_items() ) { ?>
              <div class="photo_container">
                <label><?php _e('Photos'); ?></label>
                <?php ItemForm::photos(); ?>
                <div id="photos">
                  <?php if( osc_max_images_per_item() == 0 || ( osc_max_images_per_item() != 0 && osc_count_item_resources() < osc_max_images_per_item() ) ) { ?>
                  <div>
                    <input type="file" name="photos[]" /> (<?php _e('optional'); ?>)
                  </div>
                  <?php } ?>
                </div>
                
                <p><a href="#" onclick="addNewPhoto(); return false;" class="add-new-photo"><?php _e('Add new photo'); ?></a></p>
              </div>
            <?php } ?>
            
            <?php osc_run_hook('admin_items_form_left_middle'); ?>
            
            <?php if($new_item) { ItemForm::plugin_post_item(); } else { ItemForm::plugin_edit_item(); } ?>
          </div>
          
          <div id="right-side">
            <?php osc_run_hook('admin_items_form_right_top'); ?>
          
            <div class="well ui-rounded-corners">
              <h3 class="label"><?php _e('User information'); ?></h3>
              
              <?php if(osc_item_user_id() > 0) { ?>
                <div id="contact_edit">
                  <a href="<?php echo osc_admin_base_url(true); ?>?page=users&action=edit&id=<?php echo osc_item_user_id(); ?>"><?php echo sprintf(__('Edit %s\'s profile'), osc_item_contact_name()); ?></a>
                </div>
              <?php } ?>
              
              <div id="contact_info">
                <?php if(osc_item_user_id() && osc_profile_img_users_enabled()) { ?>
                  <p class="item-user-img">
                    <img src="<?php echo osc_user_profile_img_url(osc_item_user_id()); ?>" alt="<?php echo osc_esc_html(osc_item_contact_name()); ?>"/>
                  </p>
                <?php } ?>
      
                <div class="input-has-placeholder input-separate-top">
                  <label><?php _e('Name'); ?></label>
                  <?php ItemForm::contact_name_text(); ?>
                </div>
                <div class="input-has-placeholder input-separate-top">
                  <label><?php _e('E-mail'); ?></label>
                  <?php ItemForm::contact_email_text(); ?>
                </div>

                <div class="input-has-placeholder input-separate-top">
                  <label><?php _e('Phone'); ?></label>
                  <?php ItemForm::contact_phone_text(); ?>
                </div>

                <div class="input-has-placeholder input-separate-top">
                  <label><?php _e('Other contact'); ?></label>
                  <?php ItemForm::contact_other_text(); ?>
                </div>

                <?php if(!$new_item) { ?>
                <div class="input-has-placeholder input-separate-top">
                  <label><?php _e('Ip Address'); ?></label>
                  <input id="ipAddress" type="text" name="ipAddress" value="<?php echo osc_item_ip(); ?>" class="valid" readonly="readonly">
                </div>
                <?php } ?>
                
                <div class="input-separate-top">
                  <label><?php ItemForm::show_email_checkbox(); ?><span><?php _e('Show e-mail'); ?></span></label>
                </div>

                <div class="input-separate-top">
                  <label><?php ItemForm::show_phone_checkbox(); ?><span><?php _e('Show phone'); ?></span></label>
                </div>
              </div>
            </div>

            <div class="well ui-rounded-corners input-separate-top">
              <h3 class="label"><?php _e('Item location'); ?></h3>
              <div class="input-has-placeholder input-separate-top">
                <label><?php _e('Country'); ?></label>
                <?php ItemForm::country_select(); ?>
              </div>
              <div class="input-has-placeholder input-separate-top">
                <label><?php _e('Region'); ?></label>
                <?php ItemForm::region_select(); ?>
              </div>
              <div class="input-has-placeholder input-separate-top">
                <label><?php _e('City'); ?></label>
                <?php ItemForm::city_select(); ?>
              </div>
              <div class="input-has-placeholder input-separate-top">
                <label><?php _e('City area'); ?></label>
                <?php ItemForm::city_area_text(); ?>
              </div>
              <div class="input-has-placeholder input-separate-top">
                <label><?php _e('Zip code'); ?></label>
                <?php ItemForm::zip_text(); ?>
              </div>
              <div class="input-has-placeholder input-separate-top">
                <label><?php _e('Address'); ?></label>
                <?php ItemForm::address_text(); ?>
              </div>
            </div>

            <div class="well ui-rounded-corners input-separate-top">
              <h3 class="label"><?php _e('Expiration'); ?></h3>
              <?php if( $new_item ) { ?>
                <div class="input-has-placeholder input-separate-top">
                  <?php ItemForm::expiration_input('add'); ?>
                </div>
                <label class="exp-date-help"><?php _e('It could be an integer (days from original publishing date it will be expired, 0 to never expire) or a date in the format "yyyy-mm-dd hh:mm:ss"'); ?></label>
              <?php } else if( !$new_item ) { ?>
                <div class="input-separate-top">
                  <label><input type="checkbox" id="update_expiration" name="update_expiration"/> <span><?php _e('Update expiration?'); ?></span></label>
                  <div class="hide update_expiration">
                    <div class="input-has-placeholder input-separate-top">
                      <?php ItemForm::expiration_input('edit'); ?>
                    </div>
                    <label><?php _e('It could be an integer (days from original publishing date it will be expired, 0 to never expire) or a date in the format "yyyy-mm-dd hh:mm:ss"'); ?></label>
                  </div>
                </div>
              <?php } ?>
            </div>

          </div>
          <div class="clear"></div>
          <div class="form-actions">
            <?php if( !$new_item ) { ?>
            <a href="javascript:history.go(-1)" class="btn"><?php _e('Cancel'); ?></a>
            <?php } ?>
            <input type="submit" value="<?php echo osc_esc_html(customText('button')); ?>" class="btn btn-submit" />
          </div>
        </form>
    </div>
  </div>
</div>
</div>
<?php osc_current_admin_theme_path( 'parts/footer.php' ); ?>