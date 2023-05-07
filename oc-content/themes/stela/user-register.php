<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="<?php echo str_replace('_', '-', osc_current_user_locale()); ?>">
<head>
  <?php osc_current_web_theme_path('head.php'); ?>
  <meta name="robots" content="noindex, nofollow" />
  <meta name="googlebot" content="noindex, nofollow" />
  <script type="text/javascript" src="<?php echo osc_current_web_theme_js_url('jquery.validate.min.js'); ?>"></script>
</head>

<?php
  $type = Params::getParam('type');

  if($type == 'box') {
    osc_current_web_theme_path('inc.auth.php');

    echo '<div style="display:none;">';
    osc_run_hook('footer');
    echo '</div>';

    exit;
  }
?>


<body id="body-user-register">
  <?php UserForm::js_validation(); ?>
  <?php osc_current_web_theme_path('header.php'); ?>

  <div id="i-forms" class="content">
    <div id="login" class="box"<?php if(Params::getParam('move') == 'register') { ?> style="display:none"<?php } ?>>
      <div class="user_forms login round3">
        <div class="inner">



          <h2><?php _e('Sign in', 'stela'); ?></h2>



          <form action="<?php echo osc_base_url(true); ?>" method="post" >
          <input type="hidden" name="page" value="login" />
          <input type="hidden" name="action" value="login_post" />
          <fieldset>
            <label for="email"><span><?php _e('E-mail', 'stela'); ?></span></label> <span class="input-box"><?php UserForm::email_login_text(); ?></span>
            <label for="password"><span><?php _e('Password', 'stela'); ?></span></label> <span class="input-box"><?php UserForm::password_login_text(); ?></span>

            <div class="login-line">
              <div class="input-box-check">
                <?php UserForm::rememberme_login_checkbox();?>
                <label for="remember"><?php _e('Tine-ma minte', 'stela'); ?></label>
              </div>
            </div>

            <button type="submit" id="blue"><?php _e("Log in", 'stela');?></button>

            <div class="swap">
              <a href="#" class="swap-log-reg to-reg"><?php _e('No account?', 'stela'); ?> <?php _e('Sign up', 'stela'); ?></a>
              <a class="more-login tr1" href="<?php echo osc_recover_user_password_url(); ?>"><?php _e("Lost password?", 'stela'); ?></a>
            </div>


            <div class="fb-login">
             <?php if(function_exists('facebook_login')) { ?>
              <?php echo facebook_login(); ?>
              <?php } ?>

            <?php if(function_exists('gc_login_button')) { ?>
              <a class="external-log gc btn round3 tr1" target="_top" href="<?php gc_login_button('link-only'); ?>"><i class="fa fa-google"></i><?php _e('Google', 'stela'); ?></a>
            <?php } ?>
            </div>
          </fieldset>
          </form>
        </div>
      </div>
    </div>

    <div id="register" class="box" <?php if(Params::getParam('move') <> 'register') { ?> style="display:none"<?php } ?>>
      <div class="user_forms register round3">
        <div class="inner">  
          <h2><?php _e('Sign up', 'stela'); ?></h2>
        
          <form name="register" id="register" action="<?php echo osc_base_url(true); ?>" method="post" >
          <input type="hidden" name="page" value="register" />
          <input type="hidden" name="action" value="register_post" />
          <fieldset>
            <h1></h1>
            <ul id="error_list"></ul>

            <label for="name"><span><?php _e('Name', 'stela'); ?></span><span class="req">*</span></label> <span class="input-box"><?php UserForm::name_text(); ?></span>
            <label for="password"><span><?php _e('Password', 'stela'); ?></span><span class="req">*</span></label> <span class="input-box"><?php UserForm::password_text(); ?></span>
            <label for="password"><span><?php _e('Re-type password', 'stela'); ?></span><span class="req">*</span></label> <span class="input-box"><?php UserForm::check_password_text(); ?></span>
            <label for="email"><span><?php _e('E-mail', 'stela'); ?></span><span class="req">*</span></label> <span class="input-box"><?php UserForm::email_text(); ?></span>
            <label for="phone"><?php _e('Mobile Phone', 'stela'); ?></label> <span class="input-box last"><?php UserForm::mobile_text(osc_user()); ?></span>

            <?php osc_run_hook('user_register_form'); ?>

            <?php stela_show_recaptcha('register'); ?>

            <button type="submit" id="green"><?php _e('Create account', 'stela'); ?></button>

            <div class="swap">
              <a href="#" class="swap-log-reg to-log"><?php _e('Already registered?', 'stela'); ?> <?php _e('Sign in', 'stela'); ?></a>
            </div>
          </fieldset>
          </form>
        </div>
      </div>
    </div>
  </div>


  <?php osc_current_web_theme_path('footer.php'); ?>
</body>
</html>