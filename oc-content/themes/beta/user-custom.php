<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="<?php echo str_replace('_', '-', osc_current_user_locale()); ?>">
<head>
  <?php osc_current_web_theme_path('head.php') ; ?>
  <meta name="robots" content="noindex, nofollow" />
  <meta name="googlebot" content="noindex, nofollow" />
</head>

<body id="body-user-custom" class="body-ua">
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

    <div id="main" class="ad_list">
      <div class="inside">
        <?php osc_render_file(); ?>
      </div>
    </div>
  </div>

  <?php osc_current_web_theme_path('footer.php') ; ?>
</body>
</html>