<style>
    
    #lb-content span {display: block;width: 100%;height: auto;color:#000;background-position: center;background-repeat: no-repeat;background-size: contain;background-color:transparent;text-align:left;padding:10px;}
#lb-content {display: none;position: fixed;z-index: 999;top: 0;left: 0;right: 0;bottom: 0;padding: 1em;background: rgba(0, 0, 0, 0.8);}
#lb-close{display:block;color:#156756;width:20px;height:20px;cursor:pointer;}
</style>

<div id="lb-content">
    
    <span>
        
        <div class="listing-share">
            <div id="lb-close" onclick="closesharebut()"><i class="fa fa-times" style="font-size:20px;"></i></div><br/>
            
            <div style="font-size:16px;">On Social Media</div>
              <?php osc_reset_resources(); ?>
              <a class="single single-facebook has-tooltip" title="<?php echo osc_esc_html(__('Share on Facebook', 'stela')); ?>" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(osc_item_url()); ?>"><i class="fa fa-facebook-square"></i></a> 
              <a class="single single-google-plus has-tooltip" title="<?php echo osc_esc_html(__('Share on Google Plus', 'stela')); ?>" target="_blank" href="https://plus.google.com/share?url=<?php echo urlencode(osc_item_url()); ?>"><i class="fa fa-google-plus-square"></i></a> 
              <a class="single single-twitter has-tooltip" title="<?php echo osc_esc_html(__('Share on Twitter', 'stela')); ?>" target="_blank" href="https://twitter.com/home?status=<?php echo urlencode(osc_item_title()); ?>"><i class="fa fa-twitter-square"></i></a> 
              <a class="single single-pinterest has-tooltip" title="<?php echo osc_esc_html(__('Share on Pinterest', 'stela')); ?>" target="_blank" href="https://pinterest.com/pin/create/button/?url=<?php echo urlencode(osc_item_url()); ?>&media=<?php echo osc_resource_url(); ?>&description=<?php echo urlencode(osc_item_title()); ?>"><i class="fa fa-pinterest-square"></i></a> 
            </div>
        
    </span>
</div>
    <?php
      osc_show_widgets('footer');
      $sQuery = __('Search in', 'stela') . ' ' . osc_total_active_items() . ' ' .  __('listings', 'stela');
    ?>
  </div>
</div>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-151187330-2"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-151187330-2');
</script>

<?php osc_run_hook('footer') ; ?>

<?php if ( stela_is_demo() ) { ?>
  <div id="piracy" class="noselect" title="Click to hide this box">This theme is ownership of MB Themes and can be bought only on <a href="https://osclasspoint.com/graphic-themes/general/stela-osclass-theme_i63">OsclassPoint.com</a>. When bought on other site, there is no support and updates provided. Do not support stealers, support developer!</div>
  <script>$(document).ready(function(){ $('#piracy').click(function(){ $(this).fadeOut(200); }); });</script>
<?php } ?>


<?php if(osc_is_home_page() || osc_is_search_page()) { ?>
  <a class="mobile-post2 is767" href="<?php echo osc_item_post_url(); ?>"><i class="fa fa-plus"></i></a>
  <br/><br/>
 
  
<?php } ?>

<?php if(osc_is_ad_page()) { ?>
   <div class="mobile-post is767" id='share-button' style="cursor:pointer;"><i class="fa fa-share-alt"></i></div>
  <br/><br/>
  <a class="mobile-post2 is767" href="https://zzbeng.ro/favorite-lists/0/0/0/0/0"><i class="fa fa-heart"></i></a>
<?php } ?>


 



<div id="pre-footer">
  <div class="inside">
      
      <a href="http://www.anpc.gov.ro/">ANPC</a>  <i class="fa fa-circle"></i>
      <a href="https://zzbeng.ro/user/dashboard">Contul meu</a> <i class="fa fa-circle"></i>
      <a href="https://zzbeng.ro/item/new">Adauga un anunt</a> <i class="fa fa-circle"></i>
      
     
      
      
    <?php $c = 0; ?>
    <?php osc_reset_static_pages(); ?>
    <?php while(osc_has_static_pages()) { ?>
      <?php if($c > 0) { ?>
        <i class="fa fa-circle"></i>
      <?php } ?>

      <a href="<?php echo osc_static_page_url(); ?>" title="<?php echo osc_esc_html(osc_static_page_title()); ?>"><?php echo ucfirst(osc_static_page_title());?></a>
      <?php $c++; ?>
    <?php } ?>
  </div>
</div>




 
 <div class="t-footer" style="font-weight:600; padding:15px 15px 15px 15px; background:#076d57; 
 font-size:12px; color:#ffffff;"><center>
      <div class="inside" style="max-width:1160px;">
        

     
      </div>
      </center>
   </div>
 

<div id="footer">
  <div class="inside">
     
      
      <div class="get_the_app">
          <div style="font-size:18px;font-weight:bold;margin-bottom:5px;">Descarca Aplicatia</div>
         <a href="https://play.google.com/store/apps/details?id=com.application.zbeng"> <img style="border:1px solid #fff;margin-bottom:10px;" src="https://zzbeng.ro/oc-content/themes/stela/images/android.png" /><img style="display:none;border:1px solid #fff;" src="https://zzbeng.ro/oc-content/themes/stela/images/ios.png" /></a>
          
      </div>
    <div class="line">
      <span class="copy">&copy; <?php echo date("Y"); ?> <?php echo osc_esc_html( osc_get_preference('website_name', 'stela_theme') ); ?></span>

      <i class="fa fa-circle"></i>
      <a class="box-contact" href="<?php echo osc_contact_url(); ?>"><?php _e('Contact', 'stela'); ?></a>

      <?php if(osc_get_preference('footer_link', 'stela_theme')) { ?>
        <i class="fa fa-circle"></i>
        <a href="https://osclasspoint.com/">Osclass Themes and Plugins</a>
      <?php } ?>

      <?php if(osc_get_preference('footer_email', 'stela_theme') <> '') { ?>
        <i class="fa fa-circle"></i>
        <a href="mailto:<?php echo osc_esc_html(osc_get_preference('footer_email', 'stela_theme')); ?>"><?php echo osc_get_preference('footer_email', 'stela_theme'); ?></a>
      <?php } ?>

      <?php if(osc_get_preference('phone', 'stela_theme') <> '') { ?>
        <i class="fa fa-circle"></i>
        <a href="tel:<?php echo osc_esc_html(osc_get_preference('phone', 'stela_theme')); ?>"><?php echo osc_get_preference('phone', 'stela_theme'); ?></a>
      <?php } ?>
      
    </div>

    <?php if(osc_get_preference('site_info', 'stela_theme') <> '') { ?>
      <div class="line">
        <?php echo osc_get_preference('site_info', 'stela_theme'); ?>
      </div>
    <?php } ?>

    
    
    
  </div>
</div>

<!-- FANCY HELP STATUS BOXES -->
<div class="box-help" style="display:none;">
  <div class="loading">
    <div class="icon"><img src="<?php echo osc_current_web_theme_url('images/ajax_loading.gif'); ?>"/></div>
    <div class="title"><?php _e('Loading...', 'stela'); ?></div>
    <div class="message">&nbsp;</div>
    <div class="close exit"><?php _e('Cancel', 'stela'); ?></div>
  </div>

  <div class="success">
    <div class="icon"><i class="fa fa-check-circle"></i></div>
    <div class="title"><?php _e('Successful', 'stela'); ?></div>
    <div class="message"></div>
    <div class="close exit"><?php _e('Close', 'stela'); ?></div>
  </div>


  <div class="error">
    <div class="icon"><i class="fa fa-times-circle"></i></div>
    <div class="title"><?php _e('Error', 'stela'); ?></div>
    <div class="message"></div>
    <div class="close repeat"><?php _e('Try again', 'stela'); ?></div>
  </div>
</div>


<!-- MOBILE BLOCKS -->
<div id="menu-cover"></div>


<div id="menu-user" class="header-slide closed non-resp is767">
  <div class="body">

  </div>
</div>

<div id="menu-options" class="header-slide closed non-resp is767">
  <div class="body">
    <div class="close-mobile-menu"><i class="fa fa-times"></i></div>

    <div class="top-block <?php if(osc_is_web_user_logged_in()) { ?>logged<?php } ?>">
      <?php if(!osc_is_web_user_logged_in()) { ?>
        <div class="img"><img src="<?php echo osc_current_web_theme_url('images/no-user-mobile.png'); ?>"/></div>
        <span class="top empt">&nbsp;</span>
        <span class="bot empt">&nbsp;</span>
      <?php } else { ?>
        <div class="img"><?php echo show_avatar(osc_logged_user_id()); ?>
</div>
        <span class="top"><a href="<?php echo osc_user_dashboard_url(); ?>"><?php echo osc_logged_user_name(); ?></a></span>
        <span class="bot"><a href="<?php echo osc_user_logout_url(); ?>"><?php echo __('Logout', 'stela'); ?></a></span>
      <?php } ?>
    </div>

    <a href="<?php echo osc_item_post_url(); ?>"><?php _e('Add a new listing', 'stela'); ?></a>

    <?php if( !osc_is_web_user_logged_in() ) { ?>
      <a href="<?php echo osc_user_login_url(); ?>"><?php _e('Log in', 'stela'); ?></a>

     

      <a href="<?php echo osc_register_account_url() . $reg_url; ?>"><?php _e('Register a new account', 'stela'); ?></a>
    <?php } else { ?>
      <?php stela_user_menu(); ?>
    <?php } ?>

    <a href="<?php echo osc_contact_url(); ?>"><?php _e('Contact Zzbeng.ro', 'stela'); ?></a> 


 
    <?php osc_reset_static_pages(); ?>
    <?php while(osc_has_static_pages()) { ?>
      <a class="gray" href="<?php echo osc_static_page_url(); ?>" title="<?php echo osc_esc_html(osc_static_page_title()); ?>"><?php echo ucfirst(osc_static_page_title());?></a>
    <?php } ?>



    <?php if ( osc_count_web_enabled_locales() > 1) { ?>
      <?php $current_locale = mb_get_current_user_locale(); ?>

      <?php osc_goto_first_locale(); ?>

      <div class="elem gray">
        <div class="lang">
          <?php while ( osc_has_web_enabled_locales() ) { ?>
            <a id="<?php echo osc_locale_code() ; ?>" href="<?php echo osc_change_language_url ( osc_locale_code() ) ; ?>" <?php if (osc_locale_code() == $current_locale['pk_c_code'] ) { ?>class="current"<?php } ?>>
              <span><?php echo osc_locale_field('s_short_name'); ?></span>
              <?php if (osc_locale_code() == $current_locale['pk_c_code']) { ?>
                <i class="fa fa-check"></i>
              <?php } ?>
            </a>
          <?php } ?>
        </div>
      </div>
    <?php } ?>

  </div>
</div>



<script>
  $(document).ready(function(){

    // JAVASCRIPT AJAX LOADER FOR LOCATIONS 
    var termClicked = false;
    var currentCountry = "<?php echo stela_ajax_country(); ?>";
    var currentRegion = "<?php echo stela_ajax_region(); ?>";
    var currentCity = "<?php echo stela_ajax_city(); ?>";
    var termOld = '';

    // On first click initiate loading
    $('body').on('click', '#location-picker .term', function() {

      if($(this).val() != termOld) {
        termOld = $(this).val();
        termClicked = false;
      }

      if( !termClicked ) {
        $(this).keyup();
      }

      termClicked = true;
    });


    // Create delay
    var delay = (function(){
      var timer = 0;
      return function(callback, ms){
        clearTimeout (timer);
        timer = setTimeout(callback, ms);
      };
    })();


    //$(document).ajaxStart(function() { 
      //$("#location-picker, .location-picker").addClass('searching');
    //});

    $(document).ajaxSend(function(evt, request, settings) {
      var url = settings.url;

      if (url.indexOf("ajaxLoc") >= 0) {
        $("#location-picker, .location-picker").addClass('searching');
      }
    });

    $(document).ajaxStop(function() {
      $("#location-picker, .location-picker").removeClass('searching');
    });



    $('body').on('keyup', '#location-picker .term', function(e) {
      if($(this).val().length > 0) {
        var delayTime = 500;
      } else {
        var delayTime = 0;
      }


      delay(function(){
        var min_length = 0;
        var elem = $(e.target);
        var term = decodeURIComponent(elem.val());

        // If comma entered, remove characters after comma including
        if(term.indexOf(',') > 1) {
          term = term.substr(0, term.indexOf(','));
        }


        // If comma entered, remove characters after - including (because city is shown in format City - Region)
        if(term.indexOf(', ') > 1) {
          term = term.substr(0, term.indexOf(', '));
        }

        var block = elem.closest("#location-picker");
        var shower = elem.closest("#location-picker").find(".shower");

        shower.html('');

        if(1==1 || term != '' && term.length >= min_length) {
          // Combined ajax for country, region & city
          $.ajax({
            type: "POST",
            url: baseAjaxUrl + "&ajaxLoc=1&term=" + term,
            dataType: 'json',
            success: function(data) {
              var length = data.length;
              var result = '';
              var result_first = '';
              var countCountry = 0;
              var countRegion = 0;
              var countCity = 0;


              if(shower.find('.service.min-char').length <= 0) {
                for(key in data) {

                  // Prepare location IDs
                  var id = '';
                  var country_code = '';
                  if( data[key].country_code ) {
                    country_code = data[key].country_code;
                    id = country_code;
                  }

                  var region_id = '';
                  if( data[key].region_id ) {
                    region_id = data[key].region_id;
                    id = region_id;
                  }

                  var city_id = '';
                  if( data[key].city_id ) {
                    city_id = data[key].city_id;
                    id = city_id;
                  }
                    

                  // Count cities, regions & countries
                  if (data[key].type == 'city') {
                    countCity = countCity + 1;
                  } else if (data[key].type == 'region') {
                    countRegion = countRegion + 1;
                  } else if (data[key].type == 'country') {
                    countCountry = countCountry + 1;
                  }


                  // Find currently selected element
                  var selectedClass = '';
                  if( 
                    data[key].type == 'country' && parseInt(currentCountry) == parseInt(data[key].country_code) 
                    || data[key].type == 'region' && parseInt(currentRegion) == parseInt(data[key].region_id) 
                    || data[key].type == 'city' && parseInt(currentCity) == parseInt(data[key].city_id) 
                  ) { 
                    selectedClass = ' selected'; 
                  }


                  // For cities, get region name
                  var nameTop = '';
                  if(data[key].name_top ) {
                    nameTop = ', <span>' + data[key].name_top + '</span>';
                  }


                  if(data[key].type != 'city_more') {

                    // When classic city, region or country in loop and same does not already exists
                    if(shower.find('div[data-code="' + data[key].type + data[key].id + '"]').length <= 0) {
                      result += '<div class="option ' + data[key].type + selectedClass + '" data-country="' + country_code + '" data-region="' + region_id + '" data-city="' + city_id + '" data-code="' + data[key].type + id + '" id="' + id + '">' + data[key].name + nameTop + '</div>';
                    }

                  } else {

                    // When city counter and there is more than 12 cities for search
                    if(shower.find('.more-city').length <= 0) {
                      if( parseInt(data[key].name) > 0 ) {
                        result += '<div class="option service more-pick more-city city">... ' + (data[key].name) + ' <?php echo osc_esc_js(__('more cities', 'stela')); ?></div>';
                      }
                    }
                  }
                }


                // No city, region or country found
                /*
                if( countCountry == 0 && shower.find('.empty-country').length <= 0 && shower.find('.service.min-char').length <= 0) {
                  shower.find('.option.country').remove();
                  result_first += '<div class="option service empty-pick empty-country country"><?php echo osc_esc_js(__('No country match to your criteria', 'stela')); ?></div>';
                }

                if( countRegion == 0 && shower.find('.empty-region').length <= 0 && shower.find('.service.min-char').length <= 0) {
                  shower.find('.option.region').remove();
                  result_first += '<div class="option service empty-pick empty-region region"><?php echo osc_esc_js(__('No region match to your criteria', 'stela')); ?></div>';
                }

                if( countCity == 0 && shower.find('.empty-city').length <= 0 && shower.find('.service.min-char').length <= 0) {
                  shower.find('.option.city').remove();
                  result_first += '<div class="option service empty-pick empty-city city"><?php echo osc_esc_js(__('No city match to your criteria', 'stela')); ?></div>';
                }
                */

                if(countCountry == 0 && countRegion == 0 && countCity == 0) {
                  shower.find('.option.country, .option.region, .option.city').remove();
                  result_first += '<div class="option service empty-pick"><?php echo osc_esc_js(__('No location found', 'stela')); ?></div>';
                }
                
              }

              shower.html(result_first + result);
            }
          });

        } else {
          // Term is not length enough
          shower.html('<div class="option service min-char"><?php echo osc_esc_js(__('Enter at least', 'stela')); ?> ' + (min_length - term.length) + ' <?php echo osc_esc_js(__('more letter(s)', 'stela')); ?></div>');
        }
      }, delayTime );
    });




    <?php if(osc_get_preference('item_ajax', 'stela_theme') == 1) { ?>
      // JAVASCRIPT AJAX LOADER FOR ITEMS AUTOCOMPLETE
      var patternClicked = false;

      // On first click initiate loading
      $('body').on('click', '#item-picker .pattern', function() {
        if( !patternClicked ) {
          $(this).keyup();
        }

        patternClicked = true;
      });


      // Create delay
      var delay2 = (function(){
        var timer2 = 0;
        return function(callback, ms){
          clearTimeout (timer2);
          timer2 = setTimeout(callback, ms);
        };
      })();


      //$(document).ajaxStart(function() { 
        //$("#item-picker, .item-picker").addClass('searching');
      //});

      $(document).ajaxSend(function(evt, request, settings) {
        var url = settings.url;

        if (url.indexOf("ajaxItem") >= 0) {
          $("#item-picker, .item-picker").addClass('searching');
        }
      });

      $(document).ajaxStop(function() {
        $("#item-picker, .item-picker").removeClass('searching');
      });


      $('body').on('keyup', '#item-picker .pattern', function(e) {
        if($(this).val().length > 0) {
          var delayTime = 500;
        } else {
          var delayTime = 0;
        }

        delay(function(){
          var min_length = 0;
          var elem = $(e.target);
          var pattern = elem.val();

          var block = elem.closest("#item-picker");
          var shower = elem.closest("#item-picker").find(".shower");

          shower.html('');

          if(pattern != '' && pattern.length >= min_length || 1==1) {
            // Combined ajax for country, region & city

            $.ajax({
              type: "POST",
              url: baseAjaxUrl + "&ajaxItem=1&pattern=" + pattern,
              dataType: 'json',
              success: function(data) { 
                var length = data.length;
                var result = '';

                if(shower.find('.service.min-char').length <= 0) {
                  for(key in data) {
                    // When item already is not in shower
                    if(data[key].type == 'item') {
                      if(shower.find('div[data-item-id="' + data[key].pk_i_id + '"]').length <= 0) {
                        result += '<a class="option" data-item-id="' + data[key].pk_i_id + '" href="' + data[key].item_url + '" title="<?php echo osc_esc_js(__('Click to open listing', 'stela')); ?>">';
                        result += '<div class="left"><img src="' + data[key].image_url + '"/></div>';
                        result += '<div class="right">';
                        result += '<div class="top">' + data[key].s_title + '</div>';
                        result += '<div class="bottom">' + data[key].i_price + '</div>';
                        result += '</div>';
                        result += '</a>';
                      }
                    } else if(data[key].type == 'category') {
                      if(shower.find('div[data-city-id="' + data[key].pk_i_id + '"]').length <= 0) {
                        result += '<a class="option category" data-category-id="' + data[key].pk_i_id + '" href="' + data[key].category_url + '">';
                        result += data[key].s_title;
                        result += '</a>';
                      }
                    }
                  }


                  // No city, region or country found
                  if( length <= 0) {
                    shower.find('.option').remove();
                    result = '<div class="option service empty-pick"><?php echo osc_esc_js(__('No match found', 'stela')); ?></div>';
                  }
                }

                shower.html(result);
              }
            });

          } else {
            // Term is not length enough
            shower.html('<div class="option service min-char"><?php echo osc_esc_js(__('Enter at least', 'stela')); ?> ' + (min_length - pattern.length) + ' <?php echo osc_esc_js(__('more letter(s)', 'stela')); ?></div>');
          }
        }, delayTime );
      });
    <?php } ?>
  });
  
  function sharebut(){
    
document.getElementById("lb-content").style.display = "block"
}

function closesharebut(){
document.getElementById("lb-content").style.display = "none"
}
</script>

<script>
    $('#share-button').on('click', () => {
  if (navigator.share) {
    navigator.share({
        title: 'Web Share',
        text: 'Fi atent la anuntul asta!',
        url: '<?php echo urlencode(osc_item_url()); ?>',
      })
      .then(() => console.log('Successful share'))
      .catch((error) => console.log('Error sharing', error));
  } else {
    console.log('Share not supported on this browser, do it the old way.');
  }
});
</script>

<?php if (1==2) { 
  $cat = osc_search_category_id();
  $cat = $cat[0];

  echo 'Page: ' . Params::getParam('page') . '<br />';
  echo 'Param Country: ' . Params::getParam('sCountry') . '<br />';
  echo 'Param Region: ' . Params::getParam('sRegion') . '<br />';
  echo 'Param City: ' . Params::getParam('sCity') . '<br />';
  echo 'Param Locator: ' . Params::getParam('sLocator') . '<br />';
  echo 'Param Category: ' . Params::getParam('sCategory') . '<br />';
  echo 'Search Region: ' . osc_search_region() . '<br />';
  echo 'Search City: ' . osc_search_city() . '<br />';
  echo 'Search Category: ' . $cat . '<br />';
  echo 'Param Locator: ' . Params::getParam('sLocator') . '<br />';
  echo '<br/> ------------------------------------------------- </br>';
  echo 'Cookie Category: ' . mb_get_cookie('stela-sCategory') . '<br />';
  echo 'Cookie Country: ' . mb_get_cookie('stela-sCountry') . '<br />';
  echo 'Cookie Region: ' . mb_get_cookie('stela-sRegion') . '<br />';
  echo 'Cookie City: ' . mb_get_cookie('stela-sCity') . '<br />';
  echo '<br/> ------------------------------------------------- </br>';

  echo '<br/>';
  echo '<br/>';
  echo 'end<br/>';

}
?>	