<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="<?php echo str_replace('_', '-', osc_current_user_locale()); ?>">
  <head>
    <?php osc_current_web_theme_path('head.php') ; ?>
    <meta name="robots" content="noindex, nofollow" />
    <meta name="googlebot" content="noindex, nofollow" />
    <script type="text/javascript" src="<?php echo osc_current_web_theme_js_url('jquery.validate.min.js') ; ?>"></script>
  </head>

  <body id="body-404">
    <?php osc_current_web_theme_path('header.php') ; ?>
    <div class="content error err400">
      <div class="wrap">
        <img class="err-img" src="<?php echo osc_base_url(); ?>oc-content/themes/stela/images/error404.png" alt="<?php _e('Error 404', 'stela'); ?>"/>

        <h1><?php _e('404', 'stela'); ?></h1>

        <div class="reason"><?php _e('Whooops, page not found!', 'stela'); ?></div>
        <div class="reason"><?php _e('We are sorry, but this link is not valid anymore.', 'stela'); ?></div>

        <div class="link-wrap">
          <a class="tr1 btn btn-secondary" href="<?php echo osc_base_url();?>"><?php _e('Home', 'stela'); ?></a>
          <a class="tr1 btn btn-secondary" href="<?php echo osc_search_url(array('page' => 'search')); ?>"><?php _e('Search', 'stela'); ?></a>

          <?php if(osc_is_web_user_logged_in()) { ?>
            <a class="tr1 btn btn-secondary" href="<?php echo osc_user_dashboard_url(); ?>"><?php _e('My account', 'stela'); ?></a>
          <?php } else { ?>
            <a class="tr1 btn btn-secondary" href="<?php echo osc_register_account_url(); ?>"><?php _e('Sign in', 'stela'); ?></a>
          <?php } ?>
        </div>
      </div>
    </div>

    <?php osc_current_web_theme_path('footer.php') ; ?>
  </body>
</html>