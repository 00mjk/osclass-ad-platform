</section>

<?php if(osc_is_home_page()) { ?>
  <div class="mobile-post-wrap">
    <a class="mobile-post isMobile mbBg" href="<?php echo osc_item_post_url(); ?>"><i class="fa fa-plus-circle"></i><span><?php _e('Post an ad', 'beta'); ?></span></a>
  </div>
<?php } ?>



<footer>
  <div class="inside">
    <div class="cl cl1">

      <a class="lg" href="<?php echo osc_base_url(); ?>"><?php echo logo_header(); ?></a>

      <span class="txt"><?php _e('All rights reserved', 'beta'); ?></span>

      <?php if(bet_param('site_phone') <> '') { ?>
        <span class="txt"><?php echo bet_param('site_phone'); ?></span>
      <?php } ?>

      <div class="langs">
        <?php if ( osc_count_web_enabled_locales() > 1) { ?>
          <?php $current_locale = mb_get_current_user_locale(); ?>

          <?php osc_goto_first_locale(); ?>
          <?php while ( osc_has_web_enabled_locales() ) { ?>
            <a class="lnk lang <?php if (osc_locale_code() == $current_locale['pk_c_code']) { ?>active<?php } ?>" href="<?php echo osc_change_language_url(osc_locale_code()); ?>"><img src="<?php echo osc_current_web_theme_url();?>images/country_flags/large/<?php echo strtolower(substr(osc_locale_code(), 3)); ?>.png" alt="<?php _e('Country flag', 'beta');?>" /><span><?php echo osc_locale_name(); ?>&#x200E;</span></a>
          <?php } ?>
        <?php } ?>
      </div>

    </div>

    <div class="cl cl2">
      <div class="hd"><?php _e('Navigation', 'beta'); ?></div>


      <a class="lnk" href="<?php echo osc_base_url(); ?>"><?php _e('Home', 'beta'); ?></a>
      <a class="lnk" href="<?php echo osc_search_url(array('page' => 'search')); ?>"><?php _e('Search', 'beta'); ?></a>
      <a class="lnk" href="<?php echo osc_contact_url(); ?>"><?php _e('Contact', 'beta'); ?></a>
      <a class="lnk" href="<?php echo osc_user_dashboard_url(); ?>"><?php _e('My Account', 'beta'); ?></a>
      <a class="lnk" href="<?php echo osc_item_post_url(); ?>"><?php _e('Add a new listing', 'beta'); ?></a>

      <?php if(osc_get_preference('footer_link', 'beta_theme')) { ?>
        <a class="lnk" href="https://osclasspoint.com/">Osclass Themes</a>
      <?php } ?>
    </div>

    <div class="cl cl3">
      <div class="hd"><?php _e('Categories', 'beta'); ?></div>

      <?php osc_goto_first_category(); ?>
      <?php $i = 1; ?>
      <?php while(osc_has_categories()) { ?>
        <?php if($i <= 10) { ?>
          <a class="lnk" href="<?php echo osc_search_url(array('page' => 'search', 'category' => osc_category_id())); ?>"><?php echo osc_category_name();?></a>
        <?php } ?>

        <?php $i++; ?>
      <?php } ?>

    </div>

    <div class="cl cl4">
      <div class="hd"><?php _e('Locations', 'beta'); ?></div>

      <?php $regions = RegionStats::newInstance()->listRegions('%%%%', '>', 'i_num_items DESC'); ?>
      <?php $i = 1; ?>
      <?php foreach($regions as $r) { ?>
        <?php if($i <= 10) { ?>
          <a class="lnk" href="<?php echo osc_search_url(array('page' => 'search', 'sRegion' => $r['pk_i_id']));?>"><?php echo $r['s_name']; ?></a>
          <?php $i++; ?>
        <?php } ?>
      <?php } ?>


    </div>

    <div class="cl cl5">
      <div class="hd"><?php _e('Information', 'beta'); ?></div>

      <?php $pages = Page::newInstance()->listAll($indelible = 0, $b_link = null, $locale = null, $start = null, $limit = 10); ?>

      <?php foreach($pages as $p) { ?>
        <?php View::newInstance()->_exportVariableToView('page', $p); ?>
        <a class="lnk" href="<?php echo osc_static_page_url(); ?>"><?php echo osc_static_page_title();?></a>
      <?php } ?>
    </div>

    <div class="footer-hook"><?php osc_run_hook('footer'); ?></div>

    <div class="line2">
      <div class="left">
        &copy; <?php echo date("Y"); ?> <?php echo osc_esc_html(bet_param('website_name')); ?>.
      </div>

      <div class="share right">
        <?php
          osc_reset_resources();

          if(osc_is_ad_page()) {
            $share_url = osc_item_url();
          } else {
            $share_url = osc_base_url();
          }

          $share_url = urlencode($share_url);
        ?>

        <div class="cont">
          <?php if(osc_is_ad_page()) { ?>
            <span class="whatsapp"><a href="whatsapp://send?text=<?php echo $share_url; ?>" data-action="share/whatsapp/share"><i class="fa fa-whatsapp"></i></a></span>
          <?php } ?>

          <span class="facebook"><a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $share_url; ?>" title="<?php echo osc_esc_html(__('Share us on Facebook', 'beta')); ?>" target="_blank"><i class="fa fa-facebook-square"></i></a></span>
          <span class="pinterest"><a href="https://pinterest.com/pin/create/button/?url=<?php echo $share_url; ?>&media=<?php echo osc_base_url(); ?>oc-content/themes/<?php echo osc_current_web_theme(); ?>/images/logo.jpg&description=" title="<?php echo osc_esc_html(__('Share us on Pinterest', 'beta')); ?>" target="_blank"><i class="fa fa-pinterest"></i></a></span>
          <span class="twitter"><a href="https://twitter.com/home?status=<?php echo $share_url; ?>%20-%20<?php _e('your', 'beta'); ?>%20<?php _e('classifieds', 'beta'); ?>" title="<?php echo osc_esc_html(__('Tweet us', 'beta')); ?>" target="_blank"><i class="fa fa-twitter"></i></a></span>
        </div>
      </div>
    </div>
  </div>
</footer>


<?php if(bet_param('scrolltop') == 1) { ?>
  <a id="scroll-to-top"><img src="<?php echo osc_current_web_theme_url('images/scroll-to-top.png'); ?>"/></a>
<?php } ?>


<?php if ( OSC_DEBUG || OSC_DEBUG_DB ) { ?>
  <div id="debug-mode" class="noselect"><?php _e('You have enabled DEBUG MODE, autocomplete for locations and items will not work! Disable it in your config.php.', 'beta'); ?></div>
<?php } ?>


<!-- MOBILE BLOCKS -->
<div id="menu-cover" class="mobile-box"></div>


<div id="menu-options" class="mobile-box mbBg">
  <div class="body">
    <a href="<?php echo osc_base_url(); ?>"><i class="fa fa-home"></i> <?php _e('Home', 'beta'); ?></a>
    <a href="<?php echo osc_search_url(array('page' => 'search')); ?>"><i class="fa fa-search"></i> <?php _e('Search', 'beta'); ?></a>

    <a class="publish" href="<?php echo osc_item_post_url(); ?>"><i class="fa fa-plus-circle"></i> <?php _e('Add a new listing', 'beta'); ?></a>

    <?php if(!osc_is_web_user_logged_in()) { ?>
      <a href="<?php echo bet_reg_url('login'); ?>"><i class="fa fa-sign-in"></i> <?php _e('Log in', 'beta'); ?></a>
      <a href="<?php echo bet_reg_url('register'); ?>"><i class="fa fa-pencil-square-o"></i> <?php _e('Register a new account', 'beta'); ?></a>

    <?php } else { ?>
      <a href="<?php echo osc_user_list_items_url(); ?>"><i class="fa fa-folder-o"></i> <?php _e('My listings', 'beta'); ?></a>
      <a href="<?php echo osc_user_profile_url(); ?>"><i class="fa fa-user-o"></i> <?php _e('My profile', 'beta'); ?></a>
      <a href="<?php echo osc_user_alerts_url(); ?>"><i class="fa fa-bullhorn"></i> <?php _e('My alerts', 'beta'); ?></a>

    <?php } ?>

    <a href="<?php echo osc_contact_url(); ?>"><i class="fa fa-envelope-o"></i> <?php _e('Contact', 'beta'); ?></a>

    <?php if(osc_is_web_user_logged_in()) { ?>
      <a href="<?php echo osc_user_logout_url(); ?>"><i class="fa fa-sign-out"></i> <?php _e('Log out', 'beta'); ?></a>
    <?php } ?>

  </div>
</div>

<style>
.loc-picker .region-tab:empty:after {content:"<?php echo osc_esc_html(__('Select country first to get list of regions', 'beta')); ?>";}
.loc-picker .city-tab:empty:after {content:"<?php echo osc_esc_html(__('Select region first to get list of regions', 'beta')); ?>";}
.cat-picker .wrapper:after {content:"<?php echo osc_esc_html(__('Select main category first to get list of subcategories', 'beta')); ?>";}

</style>


<script>
  $(document).ready(function(){

    // JAVASCRIPT AJAX LOADER FOR LOCATIONS 
    var termClicked = false;
    var currentCountry = "<?php echo bet_ajax_country(); ?>";
    var currentRegion = "<?php echo bet_ajax_region(); ?>";
    var currentCity = "<?php echo bet_ajax_city(); ?>";
  

    // Create delay
    var delay = (function(){
      var timer = 0;
      return function(callback, ms){
        clearTimeout (timer);
        timer = setTimeout(callback, ms);
      };
    })();


    $(document).ajaxSend(function(evt, request, settings) {
      var url = settings.url;

      if (url.indexOf("ajaxLoc") >= 0) {
        $(".loc-picker, .location-picker").addClass('searching');
      }
    });

    $(document).ajaxStop(function() {
      $(".loc-picker, .location-picker").removeClass('searching');
    });



    $('body').on('keyup', '.loc-picker .term', function(e) {

      delay(function(){
        var min_length = 1;
        var elem = $(e.target);
        var term = encodeURIComponent(elem.val());

        // If comma entered, remove characters after comma including
        if(term.indexOf(',') > 1) {
          term = term.substr(0, term.indexOf(','));
        }

        // If comma entered, remove characters after - including (because city is shown in format City - Region)
        if(term.indexOf(' - ') > 1) {
          term = term.substr(0, term.indexOf(' - '));
        }

        var block = elem.closest('.loc-picker');
        var shower = elem.closest('.loc-picker').find('.shower');

        shower.html('');

        if(term != '' && term.length >= min_length) {
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
                    nameTop = ' <span>' + data[key].name_top + '</span>';
                  }


                  if(data[key].type != 'city_more') {

                    // When classic city, region or country in loop and same does not already exists
                    if(shower.find('div[data-code="' + data[key].type + data[key].id + '"]').length <= 0) {
                      result += '<div class="option ' + data[key].type + selectedClass + '" data-country="' + country_code + '" data-region="' + region_id + '" data-city="' + city_id + '" data-code="' + data[key].type + id + '" id="' + id + '"><strong>' + data[key].name + '</strong>' + nameTop + '</div>';
                    }
                  }
                }


                // No city, region or country found
                if( countCity == 0 && countRegion == 0 && countCountry == 0 && shower.find('.empty-loc').length <= 0 && shower.find('.service.min-char').length <= 0) {
                  shower.find('.option').remove();
                  result_first += '<div class="option service empty-pick empty-loc"><?php echo osc_esc_js(__('No location match to your criteria', 'beta')); ?></div>';
                }
              }

              shower.html(result_first + result);
            }
          });

        } else {
          // Term is not length enough, show default content
          //shower.html('<div class="option service min-char"><?php echo osc_esc_js(__('Enter at least', 'beta')); ?> ' + (min_length - term.length) + ' <?php echo osc_esc_js(__('more letter(s)', 'beta')); ?></div>');

          shower.html('<?php echo osc_esc_js(bet_def_location()); ?>');
        }
      }, 500 );
    });
  });
</script>