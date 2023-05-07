<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="<?php echo str_replace('_', '-', osc_current_user_locale()); ?>">
  <head>
    <?php osc_current_web_theme_path('head.php') ; ?>
    <meta name="robots" content="index, follow" />
    <meta name="googlebot" content="index, follow" />
  </head>

  <body id="body-custom">
    <?php osc_current_web_theme_path('header.php') ; ?>
    <?php osc_render_file(); ?>
    <?php osc_current_web_theme_path('footer.php') ; ?>
  </body>
</html>