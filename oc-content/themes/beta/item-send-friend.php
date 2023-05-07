<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="<?php echo str_replace('_', '-', osc_current_user_locale()); ?>">
<head>
  <?php osc_current_web_theme_path('head.php') ; ?>
  <meta name="robots" content="noindex, nofollow" />
  <meta name="googlebot" content="noindex, nofollow" />
  <script type="text/javascript" src="<?php echo osc_current_web_theme_js_url('jquery.validate.min.js') ; ?>"></script>
</head>

<?php 
  $type = (Params::getParam('type') == '' ? 'send_friend' : Params::getParam('type')); 
  $user_id = Params::getParam('userId');
?>

<?php 
  if($type == 'itemviewer') {
    ob_get_clean();
    Params::setParam('itemviewer', 1);
    require_once osc_base_path().'oc-content/themes/beta/item.php'; 
    exit;
  }
?>  


<body id="body-item-forms" class="fw-supporting">
  <?php osc_current_web_theme_path('header.php'); ?></div>


  <?php if($type == 'friend') { ?>

    <!-- SEND TO FRIEND FORM -->
    <div id="send-friend-form" class="fw-box" style="display:block;">
      <div class="head">
        <h1><?php _e('Send to friend', 'beta'); ?></h1>
      </div>

      <div class="middle">
        <ul id="error_list"></ul>

        <form target="_top" id="sendfriend" name="sendfriend" action="<?php echo osc_base_url(true); ?>" method="post">
          <fieldset>
            <input type="hidden" name="action" value="send_friend_post" />
            <input type="hidden" name="page" value="item" />
            <input type="hidden" name="id" value="<?php echo osc_item_id(); ?>" />

            <?php if(osc_is_web_user_logged_in()) { ?>
              <input type="hidden" name="yourName" value="<?php echo osc_esc_html( osc_logged_user_name() ); ?>" />
              <input type="hidden" name="yourEmail" value="<?php echo osc_logged_user_email();?>" />
            <?php } else { ?>
              <div class="row">
                <label for="yourName"><span><?php _e('Your name', 'beta'); ?></span><span class="req">*</span></label> 
                <div class="input-box"><?php SendFriendForm::your_name(); ?></div>

                <label for="yourEmail"><span><?php _e('Your e-mail address', 'beta'); ?></span><span class="req">*</span></label>
                <div class="input-box"><?php SendFriendForm::your_email(); ?></div>
              </div>
            <?php } ?>

            <div class="row">
              <label for="friendName"><span><?php _e("Your friend's name", 'beta'); ?></span><span class="req">*</span></label>
              <div class="input-box"><?php SendFriendForm::friend_name(); ?></div>

              <label for="friendEmail"><span><?php _e("Your friend's e-mail address", 'beta'); ?></span><span class="req">*</span></label>
              <div class="input-box last"><?php SendFriendForm::friend_email(); ?></div>
            </div>
                  
            <div class="row last">
              <label for="message"><span><?php _e('Message', 'beta'); ?></span><span class="req">*</span></label>
              <?php SendFriendForm::your_message(); ?>
            </div>

            <?php bet_show_recaptcha(); ?>

            <button type="<?php echo (bet_param('forms_ajax') == 1 ? 'button' : 'submit'); ?>" id="send-message" class="mbBg item-form-submit" data-type="friend"><?php _e('Send message', 'beta'); ?></button>
          </fieldset>
        </form>

        <?php SendFriendForm::js_validation(); ?>
      </div>
    </div>
  <?php } ?>

 

  <?php if($type == 'comment') { ?>

    <!-- NEW COMMENT FORM -->
    <?php if( osc_comments_enabled() && (osc_reg_user_post_comments () && osc_is_web_user_logged_in() || !osc_reg_user_post_comments()) ) { ?>
      <form target="_top" action="<?php echo osc_base_url(true) ; ?>" method="post" name="comment_form" id="comment_form" class="fw-box" style="display:block;">
        <input type="hidden" name="action" value="add_comment" />
        <input type="hidden" name="page" value="item" />
        <input type="hidden" name="id" value="<?php echo osc_item_id() ; ?>" />

        <fieldset>
          <div class="head">
            <h1><?php _e('Add a new comment', 'beta'); ?></h1>
          </div>

          <div class="middle">
            <?php CommentForm::js_validation(); ?>
            <ul id="comment_error_list"></ul>

            <?php if(osc_is_web_user_logged_in()) { ?>
              <input type="hidden" name="authorName" value="<?php echo osc_esc_html( osc_logged_user_name() ); ?>" />
              <input type="hidden" name="authorEmail" value="<?php echo osc_logged_user_email();?>" />
            <?php } else { ?>
              <div class="row">
                <label for="authorName"><?php _e('Name', 'beta') ; ?></label> 
                <div class="input-box"><?php CommentForm::author_input_text(); ?></div>
              </div>

              <div class="row">
                <label for="authorEmail"><span><?php _e('E-mail', 'beta') ; ?></span><span class="req">*</span></label> 
                <div class="input-box"><?php CommentForm::email_input_text(); ?></div>
              </div>                  
            <?php } ?>

            <div class="row" id="last">
              <label for="title"><?php _e('Title', 'beta') ; ?></label>
              <div class="input-box"><?php CommentForm::title_input_text(); ?></div>
            </div>
        
            <div class="row">
              <label for="body"><span><?php _e('Message', 'beta'); ?></span><span class="req">*</span></label>
              <?php CommentForm::body_input_textarea(); ?>
            </div>

            <?php bet_show_recaptcha(); ?>

            <button type="<?php echo (bet_param('forms_ajax') == 1 ? 'button' : 'submit'); ?>" id="send-comment" class="mbBg item-form-submit" data-type="comment"><?php _e('Submit comment', 'beta') ; ?></button>
          </div>
        </fieldset>
      </form>
    <?php } ?>
  <?php } ?>


  <?php if($type == 'contact') { ?>

    <!-- ITEM CONTACT FORM -->
    <form target="_top" action="<?php echo osc_base_url(true) ; ?>" method="post" name="contact_form" id="contact_form" class="fw-box" style="display:block;">
      <input type="hidden" name="action" value="contact_post" />
      <input type="hidden" name="page" value="item" />
      <input type="hidden" name="id" value="<?php echo osc_item_id() ; ?>" />

      <?php osc_prepare_user_info() ; ?>

      <fieldset>
        <div class="head">
          <h1><?php _e('Contact seller', 'beta'); ?></h1>
        </div>

        <div class="middle">
          <?php ContactForm::js_validation(); ?>
          <ul id="error_list"></ul>

          <?php if( osc_item_is_expired () ) { ?>
            <div class="problem">
              <?php _e('This listing expired, you cannot contact seller.', 'beta') ; ?>
            </div>
          <?php } else if( (osc_logged_user_id() == osc_item_user_id()) && osc_logged_user_id() != 0 ) { ?>
            <div class="problem">
              <?php _e('It is your own listing, you cannot contact yourself.', 'beta') ; ?>
            </div>
          <?php } else if( osc_reg_user_can_contact() && !osc_is_web_user_logged_in() ) { ?>
            <div class="problem">
              <?php _e('You must log in or register a new account in order to contact the advertiser.', 'beta') ; ?>
            </div>
          <?php } else { ?> 

            <?php if(osc_is_web_user_logged_in()) { ?>
              <input type="hidden" name="yourName" value="<?php echo osc_esc_html( osc_logged_user_name() ); ?>" />
              <input type="hidden" name="yourEmail" value="<?php echo osc_logged_user_email();?>" />
            <?php } else { ?>
              <div class="row">
                <label for="yourName"><?php _e('Name', 'beta') ; ?><span class="req">*</span></label> 
                <div class="input-box"><?php ContactForm::your_name(); ?></div>
              </div>

              <div class="row">
                <label for="yourEmail"><span><?php _e('E-mail', 'beta') ; ?></span><span class="req">*</span></label> 
                <div class="input-box"><?php ContactForm::your_email(); ?></div>
              </div>       
            <?php } ?>
       

            <div class="row">
              <label for="phoneNumber"><span><?php _e('Phone', 'beta') ; ?></span></label> 
              <div class="input-box"><?php ContactForm::your_phone_number(); ?></div>
            </div>          
      
            <div class="row">
              <label for="message"><span><?php _e('Message', 'beta'); ?></span><span class="req">*</span></label>
              <?php ContactForm::your_message(); ?>
            </div>

            <?php bet_show_recaptcha(); ?>

            <button type="<?php echo (bet_param('forms_ajax') == 1 ? 'button' : 'submit'); ?>" id="send-message" class="mbBg item-form-submit" data-type="contact"><?php _e('Send message', 'beta') ; ?></button>
          <?php } ?>
        </div>
      </fieldset>
    </form>
  <?php } ?>



  <?php if($type == 'contact_public') { ?>

    <!-- PUBLIC PROFILE CONTACT SELLER -->
    <?php if(osc_reg_user_can_contact() && osc_is_web_user_logged_in() || !osc_reg_user_can_contact() ) { ?>
      <form target="_top" action="<?php echo osc_base_url(true) ; ?>" method="post" name="contact_form" id="contact_form_public" class="fw-box" style="display:block;">
        <input type="hidden" name="action" value="contact_post" class="nocsrf" />
        <input type="hidden" name="page" value="user" />
        <input type="hidden" name="id" value="<?php echo $user_id; ?>" />
        <?php if(osc_is_web_user_logged_in()) { ?>
        <input type="hidden" id="yourName" name="yourName" value="<?php echo osc_logged_user_name(); ?>">
        <input type="hidden" id="yourEmail" name="yourEmail" value="<?php echo osc_logged_user_email(); ?>">
        <?php } ?>

        <div class="head">
          <h1><?php _e('Contact seller', 'beta'); ?></h1>
        </div>

        <div class="middle">
          <fieldset>
            <?php ContactForm::js_validation(); ?>
            <ul id="error_list"></ul>

            <?php if($user_id == osc_logged_user_id() && osc_is_web_user_logged_in()) { ?>
              <div class="problem"><?php _e('This is your own profile!', 'beta'); ?></div>
            <?php } else { ?>
              <?php if(!osc_is_web_user_logged_in()) { ?>
                <div class="row">
                  <label for="yourName"><?php _e('Name', 'beta'); ?></label> 
                  <div class="input-box"><?php ContactForm::your_name(); ?></div>
                </div>

                <div class="row">
                  <label for="yourEmail"><span><?php _e('E-mail', 'beta') ; ?></span><span class="req">*</span></label> 
                  <div class="input-box"><?php ContactForm::your_email(); ?></div>
                </div>
              <?php } ?>              

              <div class="row last">
                <label for="phoneNumber"><span><?php _e('Phone number', 'beta') ; ?></span></label>
                <div class="input-box"><?php ContactForm::your_phone_number(); ?></div>
              </div>

              <div class="row">
                <label for="message"><span><?php _e('Message', 'beta'); ?></span><span class="req">*</span></label>
                <?php ContactForm::your_message(); ?>
              </div>

              <?php bet_show_recaptcha(); ?>

              <button type="<?php echo (bet_param('forms_ajax') == 1 ? 'button' : 'submit'); ?>" id="send-public-message" class="mbBg item-form-submit" data-type="contact_public"><?php _e('Send message', 'beta') ; ?></button>
            <?php } ?>
          </fieldset>
        </div>
      </form>
    <?php } ?>
  <?php } ?>

  <script>
    $('#sendfriend #yourName, #sendfriend #yourEmail, #sendfriend #friendName, #sendfriend #friendEmail, #sendfriend #yourName, #sendfriend #message').prop('required', true);
    $('#comment_form #body, #comment_form #yourName').prop('required', true);
    $('#contact_form #yourName, #contact_form #yourEmail, #contact_form #message').prop('required', true);
  </script>

  <?php osc_current_web_theme_path('footer.php') ; ?>
</body>
</html>