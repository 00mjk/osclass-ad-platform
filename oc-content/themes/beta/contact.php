<?php 
  // INTERNAL USE FOR AJAX. IF NO AJAX, SHOW CONTACT PAGE
  if(isset($_GET['ajaxRequest']) && $_GET['ajaxRequest'] == '1') {
    error_reporting(0);
    ob_clean();
    osc_current_web_theme_path('ajax.php');
    exit;
  }
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="<?php echo str_replace('_', '-', osc_current_user_locale()); ?>">
<head>
  <?php osc_current_web_theme_path('head.php') ; ?>
  <meta name="robots" content="noindex, nofollow" />
  <meta name="googlebot" content="noindex, nofollow" />
  <script type="text/javascript" src="<?php echo osc_current_web_theme_js_url('jquery.validate.min.js') ; ?>"></script>
</head>

<body id="body-contact">
  <?php osc_current_web_theme_path('header.php') ; ?>

  <div id="i-forms" class="content contact">

    <!-- LOGIN FORM -->
    <div id="contact" class="box">
      <div class="wrap">
        <h1><?php _e('Contact us', 'beta'); ?></h1>

        <div class="user_forms login">
          <div class="inner">
            <form action="<?php echo osc_base_url(true) ; ?>" method="post" name="contact_form" id="contact" <?php if(osc_contact_attachment()) { ?>enctype="multipart/form-data"<?php } ?>>
              <input type="hidden" name="page" value="contact" />
              <input type="hidden" name="action" value="contact_post" />

              <ul id="error_list"></ul>

              <label for="yourName"><span><?php _e('Your name', 'beta'); ?></span><span class="req">*</span></label> 
              <div class="input-box">
                <input type="text" name="yourName" <?php if(osc_is_web_user_logged_in()) { ?>readonly<?php } ?> required value="<?php echo osc_esc_html( osc_logged_user_name() ); ?>" />
              </div>

              <label for="yourName"><span><?php _e('Email', 'beta'); ?></span><span class="req">*</span></label> 
              <div class="input-box">
                <input type="email" name="yourEmail" <?php if(osc_is_web_user_logged_in()) { ?>readonly<?php } ?> required value="<?php echo osc_logged_user_email();?>" />
              </div>

   
              <label for="subject"><span><?php _e('Subject', 'beta'); ?></span><span class="req">*</span></label>
              <span class="input-box"><?php ContactForm::the_subject(); ?></span>

              <label for="message"><span><?php _e('Message', 'beta'); ?></span><span class="req">*</span></label>
              <span class="input-box last"><?php ContactForm::your_message(); ?></span>


              <?php if(osc_contact_attachment()) { ?>
                <div class="attachment att-box">
                  <div class="att-wrap">
                    <label class="att-label">
                      <span class="att-btn"><?php _e('Choose a file', 'beta'); ?></span>
                      <span class="att-text"><?php _e('No file selected', 'beta'); ?></span>
                      <?php ContactForm::your_attachment(); ?>
                    </label>
                  </div>
                </div>
              <?php } ?>

              <?php osc_run_hook('contact_form'); ?>
              <?php bet_show_recaptcha(); ?>

              <button type="submit" class="btn mbBg"><?php _e('Send', 'beta'); ?></button>

              <?php osc_run_hook('admin_contact_form'); ?>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php ContactForm::js_validation() ; ?>
  <?php osc_current_web_theme_path('footer.php') ; ?>
</body>
</html>