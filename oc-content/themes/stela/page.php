<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="<?php echo str_replace('_', '-', osc_current_user_locale()); ?>">
  <head>
    <?php osc_current_web_theme_path('head.php') ; ?>
  </head>
  <body id="body-page">
    <?php osc_current_web_theme_path('header.php') ; ?>
    <?php $current_id = osc_static_page_id(); ?>
    <?php osc_reset_static_pages(); ?>

    <div class="page">
      <div class="page-wrap">
        <div class="page-menu">
          <div class="leader"><?php _e('Navigation', 'stela'); ?></div>
          <?php osc_reset_static_pages(); ?>
          <?php while(osc_has_static_pages()) { ?>
            <a <?php if($current_id == osc_static_page_id()) { ?>class="active" onclick="return false;"<?php } ?> href="<?php echo osc_static_page_url(); ?>"><?php echo osc_static_page_title(); ?></a>
          <?php } ?>
        </div>


        <div class="inside round5">
          <?php osc_reset_static_pages(); ?>

          <h1><?php echo osc_static_page_title(); ?></h1>
          <div><?php echo osc_static_page_text(); ?></div>
        </div>
      </div>
    </div>
    <?php osc_current_web_theme_path('footer.php') ; ?>
  </body>
</html>