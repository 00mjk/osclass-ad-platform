<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="<?php echo str_replace('_', '-', osc_current_user_locale()); ?>">
  <head>
    <?php osc_current_web_theme_path('head.php') ; ?>
  </head>
  <body id="body-page">
    <?php osc_current_web_theme_path('header.php') ; ?>
    <?php osc_reset_static_pages(); ?>

    <div class="page">
      <div class="inside round5">
        <h1 class="main-hdr"><?php echo osc_static_page_title(); ?></h1>
        <div class="page-body"><?php echo osc_static_page_text(); ?></div>
      </div>
    </div>
    <?php osc_current_web_theme_path('footer.php') ; ?>
  </body>
</html>