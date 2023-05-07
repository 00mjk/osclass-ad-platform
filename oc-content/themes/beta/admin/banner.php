<?php
  require_once 'functions.php';


  // Create menu
  $title = __('Advertisement', 'beta');
  bet_menu($title);


  // GET & UPDATE PARAMETERS
  // $variable = bet_param_update( 'param_name', 'form_name', 'input_type', 'plugin_var_name' );
  // input_type: check, value or code

  $banners = bet_param_update('banners', 'theme_action', 'check', 'theme-beta');
 
  foreach(bet_banner_list() as $b) {
    bet_param_update($b['id'], 'theme_action', 'code', 'theme-beta');
  }


  if(Params::getParam('theme_action') == 'done') {
    message_ok( __('Settings were successfully saved', 'beta') );
  }
?>


<div class="mb-body">

 
  <!-- BANNER SECTION -->
  <div class="mb-box">
    <div class="mb-head"><i class="fa fa-clone"></i> <?php _e('Advertisement', 'beta'); ?></div>

    <div class="mb-inside mb-minify">
      <form action="<?php echo osc_admin_render_theme_url('oc-content/themes/beta/admin/banner.php'); ?>" method="POST">
        <input type="hidden" name="theme_action" value="done" />

        <div class="mb-row">
          <label for="banners" class="h1"><span><?php _e('Enable Theme Banners', 'beta'); ?></span></label> 
          <input name="banners" id="banners" class="element-slide" type="checkbox" <?php echo (bet_param('banners') == 1 ? 'checked' : ''); ?> />

          <div class="mb-explain"><?php _e('When enabled, bellow banners will be shown in front page.', 'beta'); ?></div>
        </div>
        
        <?php foreach(bet_banner_list() as $b) { ?>
          <div class="mb-row">
            <label for="<?php echo $b['id']; ?>" class="h29"><span><?php echo ucwords(str_replace('_', ' ', $b['id'])); ?></span></label> 
            <textarea class="mb-textarea mb-textarea-large" name="<?php echo $b['id']; ?>" placeholder="<?php echo osc_esc_html(__('Will be shown', 'beta')); ?>: <?php echo $b['position']; ?>"><?php echo stripslashes(bet_param($b['id']) ); ?></textarea>
          </div>
        <?php } ?>



        <div class="mb-row">&nbsp;</div>

        <div class="mb-foot">
          <button type="submit" class="mb-button"><?php _e('Save', 'beta');?></button>
        </div>
      </form>
    </div>
  </div>

</div>


<?php echo bet_footer(); ?>