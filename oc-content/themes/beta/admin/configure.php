<?php
  require_once 'functions.php';


  // Create menu
  $title = __('Configure', 'beta');
  bet_menu($title);


  // GET & UPDATE PARAMETERS
  // $variable = bet_param_update( 'param_name', 'form_name', 'input_type', 'plugin_var_name' );
  // input_type: check, value or code

  $color = bet_param_update('color', 'theme_action', 'value', 'theme-beta');
  $publish_category = bet_param_update('publish_category', 'theme_action', 'value', 'theme-beta');
  $site_phone = bet_param_update('site_phone', 'theme_action', 'value', 'theme-beta');
  $website_name = bet_param_update('website_name', 'theme_action', 'value', 'theme-beta');
  $def_view = bet_param_update('def_view', 'theme_action', 'value', 'theme-beta');
  //$home_layout = bet_param_update('home_layout', 'theme_action', 'value', 'theme-beta');

  $favorite_home = bet_param_update('favorite_home', 'theme_action', 'check', 'theme-beta');
  $premium_home = bet_param_update('premium_home', 'theme_action', 'check', 'theme-beta');
  $blog_home = bet_param_update('blog_home', 'theme_action', 'check', 'theme-beta');
  $company_home = bet_param_update('company_home', 'theme_action', 'check', 'theme-beta');
  $company_home_count = bet_param_update('company_home_count', 'theme_action', 'value', 'theme-beta');
  $promote_home = bet_param_update('promote_home', 'theme_action', 'check', 'theme-beta');
  $stats_home = bet_param_update('stats_home', 'theme_action', 'check', 'theme-beta');

  $premium_home_count = bet_param_update('premium_home_count', 'theme_action', 'value', 'theme-beta');
  $premium_search = bet_param_update('premium_search', 'theme_action', 'check', 'theme-beta');
  $premium_search_count = bet_param_update('premium_search_count', 'theme_action', 'value', 'theme-beta');
  $footer_link = bet_param_update('footer_link', 'theme_action', 'check', 'theme-beta');
  $default_logo = bet_param_update('default_logo', 'theme_action', 'check', 'theme-beta');
  $def_cur = bet_param_update('def_cur', 'theme_action', 'value', 'theme-beta');
  $latest_random = bet_param_update('latest_random', 'theme_action', 'check', 'theme-beta');
  $latest_picture = bet_param_update('latest_picture', 'theme_action', 'check', 'theme-beta');
  $latest_premium = bet_param_update('latest_premium', 'theme_action', 'check', 'theme-beta');
  $latest_category = bet_param_update('latest_category', 'theme_action', 'value', 'theme-beta');
  $search_ajax = bet_param_update('search_ajax', 'theme_action', 'check', 'theme-beta');
  $forms_ajax = bet_param_update('forms_ajax', 'theme_action', 'check', 'theme-beta');
  $post_required = bet_param_update('post_required', 'theme_action', 'value', 'theme-beta');
  $post_extra_exclude = bet_param_update('post_extra_exclude', 'theme_action', 'value', 'theme-beta');

  $lazy_load = bet_param_update('lazy_load', 'theme_action', 'check', 'theme-beta');
  $location_pick = bet_param_update('location_pick', 'theme_action', 'check', 'theme-beta');
  $public_items = bet_param_update('public_items', 'theme_action', 'value', 'theme-beta');
  $preview = bet_param_update('preview', 'theme_action', 'check', 'theme-beta');
  $def_locations = bet_param_update('def_locations', 'theme_action', 'value', 'theme-beta');

  $loc_one_row = bet_param_update('loc_one_row', 'theme_action', 'check', 'theme-beta');
  $cat_one_row = bet_param_update('cat_one_row', 'theme_action', 'check', 'theme-beta');


  if(Params::getParam('theme_action') == 'done') {
    message_ok( __('Settings were successfully saved', 'beta') );
  }


  $post_extra_exclude_array = explode(',', $post_extra_exclude);
  $post_required_array = explode(',', $post_required);

?>


<div class="mb-body">

 
  <!-- CONFIGURE SECTION -->
  <div class="mb-box">
    <div class="mb-head"><i class="fa fa-wrench"></i> <?php _e('Configure', 'beta'); ?></div>

    <div class="mb-inside mb-minify">
      <form action="<?php echo osc_admin_render_theme_url('oc-content/themes/beta/admin/configure.php'); ?>" method="POST">
        <input type="hidden" name="theme_action" value="done" />

        <div class="mb-row">
          <label for="color" class="h1"><span><?php _e('Theme color', 'beta'); ?></span></label> 
      
          <input name="color" id="color" size="20" type="text" value="<?php echo osc_esc_html(bet_param('color')); ?>" />
          <span class="color-wrap">
            <input name="color-picker" id="" type="color" value="<?php echo osc_esc_html(bet_param('color')); ?>" />
          </span>
          <div class="mb-explain"><?php _e('Enter color in HEX format or select color with picker. Theme will use this color for buttons, borders, ... Example: #f29c12', 'beta'); ?></div>
        </div>

        <div class="mb-row">
          <label for="site_phone" class="h3"><span><?php _e('Site Phone Number', 'beta'); ?></span></label> 
          <input size="40" name="site_phone" id="site_phone" type="text" value="<?php echo osc_esc_html(bet_param('site_phone')); ?>" placeholder="<?php echo osc_esc_html(__('Site Phone Number', 'beta')); ?>" />

          <div class="mb-explain"><?php _e('Leave blank to disable, will be shown in footer', 'beta'); ?></div>
        </div>

        <div class="mb-row">
          <label for="website_name" class="h4"><span><?php _e('Website Name', 'beta'); ?></span></label> 
          <input size="40" name="website_name" id="website_name" type="text" value="<?php echo osc_esc_html(bet_param('website_name')); ?>" placeholder="<?php echo osc_esc_html(__('Website Name', 'beta')); ?>" />

          <div class="mb-explain"><?php _e('Enter shortcut or short name of your website that will be used in footer', 'beta'); ?></div>
        </div>
        
        <div class="mb-row">
          <label for="lazy_load" class=""><span><?php _e('Lazy Load', 'beta'); ?></span></label> 
          <input name="lazy_load" id="lazy_load" class="element-slide" type="checkbox" <?php echo (bet_param('lazy_load') == 1 ? 'checked' : ''); ?> />

          <div class="mb-explain"><?php _e('Enable to deffer images loading. Images will be loaded when get into viewable area. This may rapidly improve seo rating of your site.', 'beta'); ?></div>
        </div>

        <div class="mb-row">
          <label for="def_locations" class="h30"><span><?php _e('Location Box Content', 'beta'); ?></span></label> 
          <select name="def_locations" id="def_locations">
            <option value="region" <?php echo (bet_param('def_locations') == "region" ? 'selected="selected"' : ''); ?>><?php _e('Regions', 'beta'); ?></option>
            <option value="city" <?php echo (bet_param('def_locations') == "city" ? 'selected="selected"' : ''); ?>><?php _e('Cities', 'beta'); ?></option>
          </select>

          <div class="mb-explain"><?php _e('Select default content for location box. For cities only first 200 values will be included in list. Valid only for "small" location box.', 'beta'); ?></div>
        </div>





        <div class="mb-row"><h3 class="sec"><?php _e('Home page settings', 'beta'); ?></h3></div>

        <!--
        <div class="mb-row">
          <label for="home_layout" class="h6"><span><?php _e('Home Page Layout', 'beta'); ?></span></label> 
          <select name="home_layout" id="home_layout">
            <option value="t" <?php echo (bet_param('home_layout') == "t" ? 'selected="selected"' : ''); ?>><?php _e('Tabbed view', 'beta'); ?></option>
            <option value="h" <?php echo (bet_param('home_layout') == "h" ? 'selected="selected"' : ''); ?>><?php _e('Horizontal view', 'beta'); ?></option>
          </select>

          <div class="mb-explain"><?php _e('Select what layout you want to use for home page. Tabbed view will create tabs and only 1 box is shown at same time. Horizontal view will show all boxes at once (latest, premiums, favorite, ...).', 'beta'); ?></div>
        </div>
        -->


        <div class="mb-row">
          <label for="premium_home" class="h7"><span><?php _e('Show Premiums Block on Home', 'beta'); ?></span></label> 
          <input name="premium_home" id="premium_home" class="element-slide" type="checkbox" <?php echo (bet_param('premium_home') == 1 ? 'checked' : ''); ?> />

          <div class="mb-explain"><?php _e('Show premium listings block on home page.', 'beta'); ?></div>
        </div>

        <div class="mb-row">
          <label for="favorite_home" class="h8"><span><?php _e('Show Favorite Items on Home', 'beta'); ?></span></label> 
          <input name="favorite_home" id="favorite_home" class="element-slide" type="checkbox" <?php echo (bet_param('favorite_home') == 1 ? 'checked' : ''); ?> />

          <div class="mb-explain"><?php _e('Show premium listings block on home page. Favorite items plugin must be installed.', 'beta'); ?></div>
        </div>

        <div class="mb-row">
          <label for="blog_home" class="h9"><span><?php _e('Show Blog Widget on Home', 'beta'); ?></span></label> 
          <input name="blog_home" id="blog_home" class="element-slide" type="checkbox" <?php echo (bet_param('blog_home') == 1 ? 'checked' : ''); ?> />

          <div class="mb-explain"><?php _e('Show blog articles widget on home page. Blog plugin must be installed', 'beta'); ?></div>
        </div>

        <div class="mb-row">
          <label for="company_home" class="h10"><span><?php _e('Show Companies on Home', 'beta'); ?></span></label> 
          <input name="company_home" id="company_home" class="element-slide" type="checkbox" <?php echo (bet_param('company_home') == 1 ? 'checked' : ''); ?> />

          <div class="mb-explain"><?php _e('Show companies block on home page. Business profile plugin must be installed', 'beta'); ?></div>
        </div>

        <div class="mb-row">
          <label for="company_home_count" class="h11"><span><?php _e('Number of Companies on Home', 'beta'); ?></span></label> 
          <input size="8" name="company_home_count" id="company_home_count" type="number" value="<?php echo $company_home_count; ?>" />

          <div class="mb-explain"><?php _e('How many companies will be shown on home page.', 'beta'); ?></div>
        </div>

        <div class="mb-row">
          <label for="promote_home" class="h10"><span><?php _e('Show Promote Block on Home', 'beta'); ?></span></label> 
          <input name="promote_home" id="promote_home" class="element-slide" type="checkbox" <?php echo (bet_param('promote_home') == 1 ? 'checked' : ''); ?> />

          <div class="mb-explain"><?php _e('Show promote block on home page (Want to sell quickly?)', 'beta'); ?></div>
        </div>

        <div class="mb-row">
          <label for="stats_home" class="h10"><span><?php _e('Show Stats Block on Home', 'beta'); ?></span></label> 
          <input name="stats_home" id="stats_home" class="element-slide" type="checkbox" <?php echo (bet_param('stats_home') == 1 ? 'checked' : ''); ?> />

          <div class="mb-explain"><?php _e('Show stats block on home page (We are best thanks to you!)', 'beta'); ?></div>
        </div>

        <div class="mb-row">
          <label for="premium_home_count" class="h11"><span><?php _e('Number of Premiums on Home', 'beta'); ?></span></label> 
          <input size="8" name="premium_home_count" id="premium_home_count" type="number" value="<?php echo osc_esc_html(bet_param('premium_home_count')); ?>" />

          <div class="mb-explain"><?php _e('How many premium listings will be shown on home page.', 'beta'); ?></div>
        </div>

        <div class="mb-row">
          <label for="latest_random" class="h19"><span><?php _e('Show Latest Items in Random Order', 'beta'); ?></span></label> 
          <input name="latest_random" id="latest_random" class="element-slide" type="checkbox" <?php echo (bet_param('latest_random') == 1 ? 'checked' : ''); ?> />

          <div class="mb-explain"><?php _e('Enable to show latest items in ranodm order each time page is refreshed.', 'beta'); ?></div>
        </div>

        <div class="mb-row">
          <label for="latest_picture" class="h20"><span><?php _e('Latest Items Picture Only', 'beta'); ?></span></label> 
          <input name="latest_picture" id="latest_picture" class="element-slide" type="checkbox" <?php echo (bet_param('latest_picture') == 1 ? 'checked' : ''); ?> />

          <div class="mb-explain"><?php _e('Enable to show in latest section on home page only listings those has at least 1 picture.', 'beta'); ?></div>
        </div>

        <div class="mb-row">
          <label for="latest_premium" class="h21"><span><?php _e('Latest Premium Items', 'beta'); ?></span></label> 
          <input name="latest_premium" id="latest_premium" class="element-slide" type="checkbox" <?php echo (bet_param('latest_premium') == 1 ? 'checked' : ''); ?> />

          <div class="mb-explain"><?php _e('Enable to show in latest section on home page only listings those are premium.', 'beta'); ?></div>
        </div>

        <div class="mb-row">
          <label for="latest_category" class="h22"><span><?php _e('Category for Latest Items', 'beta'); ?></span></label> 
          <select name="latest_category" id="latest_category">
            <option value="" <?php echo (bet_param('latest_category') == '' ? 'selected="selected"' : ''); ?>><?php _e('All categories', 'beta'); ?></option>

            <?php while(osc_has_categories()) { ?>
              <option value="<?php echo osc_category_id(); ?>" <?php echo (bet_param('latest_category') == osc_category_id() ? 'selected="selected"' : ''); ?>><?php echo osc_category_name(); ?></option>
            <?php } ?>
          </select>

          <div class="mb-explain"><?php _e('Select category that will be used to feed listings into latest items section on home page.', 'beta'); ?></div>
        </div>





        <div class="mb-row"><h3 class="sec"><?php _e('Search page settings', 'beta'); ?></h3></div>

        <div class="mb-row">
          <label for="def_view" class="h5"><span><?php _e('Default View on Search Page', 'beta'); ?></span></label> 
          <select name="def_view" id="def_view">
            <option value="0" <?php echo (bet_param('def_view') == 0 ? 'selected="selected"' : ''); ?>><?php _e('Gallery view', 'beta'); ?></option>
            <option value="1" <?php echo (bet_param('def_view') == 1 ? 'selected="selected"' : ''); ?>><?php _e('List view', 'beta'); ?></option>
          </select>
        </div>

        <div class="mb-row">
          <label for="premium_search" class="h14"><span><?php _e('Show Premiums Block on Search', 'beta'); ?></span></label> 
          <input name="premium_search" id="premium_search" class="element-slide" type="checkbox" <?php echo (bet_param('premium_search') == 1 ? 'checked' : ''); ?> />

          <div class="mb-explain"><?php _e('Show Premium Listings block on Search Page.', 'beta'); ?></div>
        </div>

        <div class="mb-row">
          <label for="premium_search_count" class="h15"><span><?php _e('Number of Premiums on Search', 'beta'); ?></span></label> 
          <input size="8" name="premium_search_count" id="premium_search_count" type="number" value="<?php echo osc_esc_html(bet_param('premium_search_count') ); ?>" />

          <div class="mb-explain"><?php _e('How many premium listings will be shown on Search page.', 'beta'); ?></div>
        </div>

        <div class="mb-row">
          <label for="def_cur" class="h18"><span><?php _e('Currency in Search Box', 'beta'); ?></span></label> 
          <select name="def_cur" id="def_cur">
            <?php foreach(osc_get_currencies() as $c) { ?>
              <option value="<?php echo $c['s_description']; ?>" <?php echo (bet_param('def_cur') == $c['s_description'] ? 'selected="selected"' : ''); ?>><?php echo $c['s_description']; ?></option>
            <?php } ?>
          </select>

          <div class="mb-explain"><?php _e('Select currency symbol that will be used on search page for min & max price fields.', 'beta'); ?></div>
        </div>

        <div class="mb-row">
          <label for="search_ajax" class="h23"><span><?php _e('Live Search using Ajax', 'beta'); ?></span></label> 
          <input name="search_ajax" id="search_ajax" class="element-slide" type="checkbox" <?php echo (bet_param('search_ajax') == 1 ? 'checked' : ''); ?> />

          <div class="mb-explain"><?php _e('Enable live realtime search without reloading of search page.', 'beta'); ?></div>
        </div>




        <div class="mb-row"><h3 class="sec"><?php _e('Publish listing settings', 'beta'); ?></h3></div>

        <div class="mb-row">
          <label for="publish_category" class="h2"><span><?php _e('Category box on Publish page', 'beta'); ?></span></label> 
          <select name="publish_category" id="publish_category">
            <option value="1" <?php echo (bet_param('publish_category') == 1 ? 'selected="selected"' : ''); ?>><?php _e('Fancy box', 'beta'); ?></option>
            <option value="2" <?php echo (bet_param('publish_category') == 2 ? 'selected="selected"' : ''); ?>><?php _e('Cascading drop-downs', 'beta'); ?></option>
            <option value="3" <?php echo (bet_param('publish_category') == 3 ? 'selected="selected"' : ''); ?>><?php _e('One select box', 'beta'); ?></option>
            <option value="4" <?php echo (bet_param('publish_category') == 4 ? 'selected="selected"' : ''); ?>><?php _e('Interactive select box', 'beta'); ?></option>
          </select>

          <div class="mb-explain"><?php _e('Select what type of category selection (box) will be used on publish/edit page.', 'beta'); ?></div>
        </div>

        <div class="mb-row mb-row-select-multiple">
          <label for="post_required" class="h25"><span><?php _e('Required Fields on Publish', 'beta'); ?></span></label> 

          <input type="hidden" name="post_required" id="post_required" value="<?php echo $post_required; ?>"/>
          <select id="post_required_multiple" name="post_required_multiple" multiple>
            <option value="" <?php if($post_required == '') { ?>selected="selected"<?php } ?>><?php _e('None', 'beta'); ?></option>
            <option value="location" <?php if(in_array('location', $post_required_array)) { ?>selected="selected"<?php } ?>><?php _e('Location', 'beta'); ?></option>
            <option value="country" <?php if(in_array('country', $post_required_array)) { ?>selected="selected"<?php } ?>><?php _e('Country', 'beta'); ?></option>
            <option value="region" <?php if(in_array('region', $post_required_array)) { ?>selected="selected"<?php } ?>><?php _e('Region', 'beta'); ?></option>
            <option value="city" <?php if(in_array('city', $post_required_array)) { ?>selected="selected"<?php } ?>><?php _e('City', 'beta'); ?></option>
            <option value="name" <?php if(in_array('name', $post_required_array)) { ?>selected="selected"<?php } ?>><?php _e('Contact Name', 'beta'); ?></option>
            <option value="phone" <?php if(in_array('phone', $post_required_array)) { ?>selected="selected"<?php } ?>><?php _e('Phone', 'beta'); ?></option>
          </select>

          <div class="mb-explain"><?php _e('If you select Location as required, it means that one of following fields must be filled: Country, Region or City', 'beta'); ?></div>
        </div>

        <div class="mb-row mb-row-select-multiple">
          <label for="post_extra_exclude" class="h26"><span><?php _e('Extra Fields exclude Categories', 'beta'); ?></span></label> 
  
          <input type="hidden" name="post_extra_exclude" id="post_extra_exclude" value="<?php echo $post_extra_exclude; ?>"/>
          <select id="post_extra_exclude_multiple" name="post_extra_exclude_multiple" multiple>
            <?php echo bet_cat_list($post_extra_exclude_array); ?>
          </select>

          <div class="mb-explain"><?php _e('Select categories where you do not want to show Transaction and Condition on listing publish/edit page', 'beta'); ?></div>
        </div>




        <div class="mb-row"><h3 class="sec"><?php _e('Other settings', 'beta'); ?></h3></div>

        <div class="mb-row">
          <label for="footer_link" class="h16"><span><?php _e('Footer Link', 'beta'); ?></span></label> 
          <input name="footer_link" id="footer_link" class="element-slide" type="checkbox" <?php echo (bet_param('footer_link') == 1 ? 'checked' : ''); ?> />

          <div class="mb-explain"><?php _e('Link to OsclassPoint will be shown in footer to support our project.', 'beta'); ?></div>
        </div>
        
        <div class="mb-row">
          <label for="default_logo" class="h17"><span><?php _e('Use Default Logo', 'beta'); ?></span></label> 
          <input name="default_logo" id="default_logo" class="element-slide" type="checkbox" <?php echo (bet_param('default_logo') == 1 ? 'checked' : ''); ?> />

          <div class="mb-explain"><?php _e('If you did not upload any logo yet, osclass default logo will be used.', 'beta'); ?></div>
        </div>
       
        <div class="mb-row">
          <label for="forms_ajax" class="h24"><span><?php _e('Form submit without reload (Ajax)', 'beta'); ?></span></label> 
          <input name="forms_ajax" id="forms_ajax" class="element-slide" type="checkbox" <?php echo (bet_param('forms_ajax') == 1 ? 'checked' : ''); ?> />

          <div class="mb-explain"><?php _e('Contact seller, Add new comment & Send to friend forms will be submitted without page reload.', 'beta'); ?></div>
        </div>

        <!--
        <div class="mb-row">
          <label for="location_pick" class="h25"><span><?php _e('Improve Location Pick', 'beta'); ?></span></label> 
          <input name="location_pick" id="location_pick" class="element-slide" type="checkbox" <?php echo (bet_param('location_pick') == 1 ? 'checked' : ''); ?> />

          <div class="mb-explain"><?php _e('When user enter term into location picker (like city), there are results for this query and user does not select anything, theme will pick first entry when form is submitted. Works on home & search page.', 'beta'); ?></div>
        </div>
        -->

        <div class="mb-row">
          <label for="loc_one_row" class="h25"><span><?php _e('Countries In One Row', 'beta'); ?></span></label> 
          <input name="loc_one_row" id="loc_one_row" class="element-slide" type="checkbox" <?php echo (bet_param('loc_one_row') == 1 ? 'checked' : ''); ?> />

          <div class="mb-explain"><?php _e('When enabled, in location picker countries are shown in one row (instead of multiple rows) with horizontal scroll. It is not recommended to use if you have less than 7 countries.', 'beta'); ?></div>
        </div>

        <div class="mb-row">
          <label for="cat_one_row" class="h25"><span><?php _e('Main Categories In One Row', 'beta'); ?></span></label> 
          <input name="cat_one_row" id="cat_one_row" class="element-slide" type="checkbox" <?php echo (bet_param('cat_one_row') == 1 ? 'checked' : ''); ?> />

          <div class="mb-explain"><?php _e('When enabled, in category picker main categories are shown in one row (instead of multiple rows) with horizontal scroll. It is not recommended to use if you have less than 10 main (root) categories.', 'beta'); ?></div>
        </div>

        <div class="mb-row">
          <label for="preview" class="h27"><span><?php _e('Enable Listing Preview', 'beta'); ?></span></label> 
          <input name="preview" id="preview" class="element-slide" type="checkbox" <?php echo (bet_param('preview') == 1 ? 'checked' : ''); ?> />

          <div class="mb-explain"><?php _e('When enabled, preview button is added into items list and visitor can preview listing without opening it in window.', 'beta'); ?></div>
        </div>

        <div class="mb-row">
          <label for="public_items" class="h26"><span><?php _e('Number of Items on Public Profile', 'beta'); ?></span></label> 
          <input size="8" name="public_items" id="public_items" type="number" value="<?php echo bet_param('public_items'); ?>" />

          <div class="mb-explain"><?php _e('How many listings will be shown on user public profile. Keep in mind that pagination is not available on public profile.', 'beta'); ?></div>
        </div>


        <div class="mb-row">&nbsp;</div>

        <div class="mb-foot">
          <button type="submit" class="mb-button"><?php _e('Save', 'beta');?></button>
        </div>
      </form>
    </div>
  </div>

</div>


<?php echo bet_footer(); ?>	