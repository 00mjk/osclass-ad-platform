<?php
  require_once 'functions.php';


  // Create menu
  $title = __('Plugins', 'beta');
  bet_menu($title);


  // GET & UPDATE PARAMETERS
  // $variable = bet_param_update( 'param_name', 'form_name', 'input_type', 'plugin_var_name' );
  // input_type: check, value or code

  $scrolltop = bet_param_update('scrolltop', 'theme_action', 'check', 'theme-beta');
  $related = bet_param_update('related', 'theme_action', 'check', 'theme-beta');
  $related_count = bet_param_update('related_count', 'theme_action', 'value', 'theme-beta');
 

  if(Params::getParam('theme_action') == 'done') {
    message_ok( __('Settings were successfully saved', 'beta') );
  }
?>


<div class="mb-body">

  <div class="mb-info-box" style="margin:5px 0 30px 0;">
    <div class="mb-line"><strong><?php _e('Plugins for this theme', 'beta'); ?></strong></div>
    <div class="mb-line"><?php _e('We have modified for you many plugins to fit theme design that will work without need of any modifications', 'beta'); ?>.</div>
    <div class="mb-line"><?php _e('Plugins are not delivered in theme package, must be downloaded separately', 'beta'); ?>.</div>
    <div class="mb-line" style="margin:10px 0;"><a href="https://osclasspoint.com/theme-plugins/beta_plugins_20190731_ax98zF.zip" target="_blank" class="mb-button-white"><i class="fa fa-download"></i> <?php _e('Download plugins', 'beta'); ?></a></div>
    <div class="mb-line" style="margin-top:15px;">- <?php _e('upload and extract downloaded file <strong>beta-plugins.zip</strong> into folder <strong>oc-content/plugins/</strong> on your hosting', 'beta'); ?>.</div>
    <div class="mb-line">- <?php _e('go to <strong>oc-admin > Plugins</strong> and install plugins you like', 'beta'); ?>.</div>
  </div>


 
  <!-- PLUGINS SECTION -->
  <div class="mb-box">
    <div class="mb-head"><i class="fa fa-puzzle-piece"></i> <?php _e('Plugin settings', 'beta'); ?></div>

    <div class="mb-inside mb-minify">
      <form action="<?php echo osc_admin_render_theme_url('oc-content/themes/beta/admin/plugins.php'); ?>" method="POST">
        <input type="hidden" name="theme_action" value="done" />

        <div class="mb-row">
          <label for="scrolltop" class="h1"><span><?php _e('Enable Scroll to Top', 'beta'); ?></span></label> 
          <input name="scrolltop" id="scrolltop" class="element-slide" type="checkbox" <?php echo (bet_param('scrolltop') == 1 ? 'checked' : ''); ?> />

          <div class="mb-explain"><?php _e('When enabled, button that enables scroll to top will be added.', 'beta'); ?></div>
        </div>

        <div class="mb-row">
          <label for="related" class="h2"><span><?php _e('Enable Related Listings', 'beta'); ?></span></label> 
          <input name="related" id="related" class="element-slide" type="checkbox" <?php echo (bet_param('related') == 1 ? 'checked' : ''); ?> />

          <div class="mb-explain"><?php _e('When enabled, related listings will be shown at listing page.', 'beta'); ?></div>
        </div>

        <div class="mb-row">
          <label for="related_count" class="h3"><span><?php _e('Number of Related Items', 'beta'); ?></span></label> 
          <input name="related_count" id="related_count" type="number" min="1" value="<?php echo bet_param('related_count'); ?>" />

          <div class="mb-explain"><?php _e('Enter how many related listings will be shown on item page.', 'beta'); ?></div>
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