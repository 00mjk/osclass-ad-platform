<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="<?php echo str_replace('_', '-', osc_current_user_locale()); ?>">
<head>
  <?php osc_current_web_theme_path('head.php') ; ?>
  <meta name="robots" content="noindex, nofollow" />
  <meta name="googlebot" content="noindex, nofollow" />
</head>
<body id="body-user-recover">
  <?php osc_current_web_theme_path('header.php') ; ?>
  <div class="clear"></div>
  <div id="i-forms" class="content recover">
    <div class="user_forms">
      <div class="inner">
        <h2><span><?php _e('Recover', 'stela'); ?></span> <?php _e('your password', 'stela'); ?></h2>

        <form action="<?php echo osc_base_url(true) ; ?>" method="post" >
          <input type="hidden" name="page" value="login" />
          <input type="hidden" name="action" value="recover_post" />
          <fieldset>
            <label for="email"><?php _e('E-mail', 'stela') ; ?></label> <?php UserForm::email_text() ; ?><br />
            <?php osc_show_recaptcha('recover_password'); ?>
            <button type="submit" id="blue"><?php _e('Send a new password', 'stela') ; ?></button>
          </fieldset>
        </form>
      </div>
    </div>
  </div>


  <?php osc_current_web_theme_path('footer.php') ; ?>
</body>
</html>