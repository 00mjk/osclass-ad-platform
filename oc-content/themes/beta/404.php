<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="<?php echo str_replace('_', '-', osc_current_user_locale()); ?>">
  <head>
    <?php osc_current_web_theme_path('head.php') ; ?>
    <meta name="robots" content="noindex, nofollow" />
    <meta name="googlebot" content="noindex, nofollow" />
    <script type="text/javascript" src="<?php echo osc_current_web_theme_js_url('jquery.validate.min.js') ; ?>"></script>
  </head>

  <body>
    <?php osc_current_web_theme_path('header.php') ; ?>

    <div class="inside">
      <div class="error404">

        <h1 class="mbCl"><?php _e('404', 'beta'); ?></h1>
        <h2><?php _e('OOPS! Page Not Found!', 'beta'); ?></h2>
        <h3><?php _e('Either something get wrong or the page doesn\'t exist anymore.', 'beta'); ?></h3>

        <a href="<?php echo osc_base_url(); ?>" class="btn mbBg"><?php _e('Take me home', 'beta'); ?> <i class="fa fa-angle-right"></i></a>
      </div>
    </div>

    <?php osc_current_web_theme_path('footer.php') ; ?>
  </body>
</html>