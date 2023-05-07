<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="<?php echo str_replace('_', '-', osc_current_user_locale()); ?>">
<head>
  <?php osc_current_web_theme_path('head.php') ; ?>
  <meta name="robots" content="noindex, nofollow" />
  <meta name="googlebot" content="noindex, nofollow" />
</head>


<body id="body-item-send-friend" class="fw-supporting <?php echo (osc_get_preference('forms_ajax', 'stela_theme') == 1 ? 'ajax-submit' : ''); ?>">
  <div style="display:none!important;"><?php osc_current_web_theme_path('header.php'); ?></div></div></div>
  <?php 
    $content_only = Params::getParam('contentOnly');
    $type = Params::getParam('type');
    $user_id = Params::getParam('userId'); 
  ?>

  <!-- ITEM PREVIEW (CONTENT ONLY) -->
  <?php if($content_only == 1) { ?>
    <?php 
      ob_get_clean();
      require_once osc_base_path().'oc-content/themes/stela/item.php'; 
      exit;
    ?>  

  <?php } else if($type == 'send_friend' || $type == '') { ?>
    <!-- SEND TO FRIEND FORM -->

    <div id="send-friend-form" class="fw-box" style="display:block;">
      <div class="head">
        <h2><?php _e('Send to friend', 'stela'); ?></h2>
      </div>

      <div class="middle">
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
                <label for="yourName"><span><?php _e('Your name', 'stela'); ?></span><div class="req">*</div></label> 
                <div class="input-box"><input id="yourName" type="text" name="yourName" required></div>

                <label for="yourEmail"><span><?php _e('Your e-mail address', 'stela'); ?></span><div class="req">*</div></label>
                <div class="input-box"><input id="yourEmail" type="text" name="yourEmail" required></div>
              </div>
            <?php } ?>

            <div class="row">
              <label for="friendName"><span><?php _e('Your friend\'s name', 'stela'); ?></span><div class="req">*</div></label>
              <div class="input-box"><input id="friendName" type="text" name="friendName" required></div>

              <label for="friendEmail"><span><?php _e('Your friend\'s e-mail address', 'stela'); ?></span><div class="req">*</div></label>
              <div class="input-box last"><input id="friendEmail" type="text" name="friendEmail" required></div>
            </div>
                  
            <div class="row last">    
              <label for="message"><span><?php _e('Message', 'stela'); ?></span><div class="req">*</div></label>
              <textarea id="message" name="message" rows="10" required></textarea>
            </div>

            <?php stela_show_recaptcha(); ?>

            <button type="submit" id="message-send"><?php _e('Send message', 'stela'); ?></button>
          </fieldset>
        </form>
      </div>
    </div>
  <?php } ?>


  <?php if($type == 'item_contact') { ?>
    <!-- ITEM CONTACT FORM -->
    <div id="item-contact-form" class="fw-box" style="display:block;">
      <div class="head">
        <h2><?php _e('Contact seller', 'stela'); ?></h2>
      </div>

      <div class="middle">
        <form action="<?php echo osc_base_url(true) ; ?>" method="post" target="_top" name="contact_form" <?php if(osc_contact_attachment()) { echo 'enctype="multipart/form-data"'; };?>>
          <input type="hidden" name="page" value="contact" />
          <input type="hidden" name="action" value="contact_post" />

          <?php if(osc_is_web_user_logged_in()) { ?>
            <input type="hidden" name="yourName" value="<?php echo osc_esc_html( osc_logged_user_name() ); ?>" />
            <input type="hidden" name="yourEmail" value="<?php echo osc_logged_user_email();?>" />
          <?php } else { ?>
            <div class="row">
              <label for="yourName"><span><?php _e('Your name', 'stela'); ?></span></label> 
              <span class="input-box"><input id="yourName" type="text" name="yourName" required></span>
            </div>

            <div class="row">
              <label for="yourEmail"><span><?php _e('Your e-mail address', 'stela'); ?></span><div class="req">*</div></label>
              <span class="input-box"><input id="yourEmail" type="email" name="yourEmail" required></span>
            </div>
          <?php } ?>

          <div class="row">
            <label for="subject"><span><?php _e("Subject", 'stela'); ?></span><div class="req">*</div></label>
            <span class="input-box"><input id="subject" type="text" name="subject" required></span>
          </div>

          <div class="row">
            <label for="message"><span><?php _e("Message", 'stela'); ?></span><div class="req">*</div></label>
            <span class="input-box last"><textarea id="message" name="message" rows="10" required></textarea></span>
          </div>

          <?php stela_show_recaptcha(); ?>

          <button type="submit" id="item-contact-submit"><?php _e('Send message', 'stela'); ?></button>
        </form>
      </div>
    </div>
  <?php } ?>

 

  <?php if($type == 'add_comment') { ?>
    <!-- NEW COMMENT FORM -->
    <?php if( osc_comments_enabled() && (osc_reg_user_post_comments () && osc_is_web_user_logged_in() || !osc_reg_user_post_comments()) ) { ?>
      <div id="item-add-comment" class="fw-box" style="display:block;">
        <form target="_top" action="<?php echo osc_base_url(true) ; ?>" method="post" name="comment_form" id="comment_form">
          <input type="hidden" name="action" value="add_comment" />
          <input type="hidden" name="page" value="item" />
          <input type="hidden" name="id" value="<?php echo osc_item_id() ; ?>" />

          <fieldset>
            <div class="head">
              <h2><?php _e('Add new comment', 'stela'); ?></h2>
            </div>

            <div class="middle">
              <?php if(osc_is_web_user_logged_in()) { ?>
                <input type="hidden" name="authorName" value="<?php echo osc_esc_html( osc_logged_user_name() ); ?>" />
                <input type="hidden" name="authorEmail" value="<?php echo osc_logged_user_email();?>" />
              <?php } else { ?>
                <div class="row">
                  <label for="authorName"><?php _e('Name', 'stela') ; ?></label> 
                  <div class="input-box"><input id="authorName" type="text" name="authorName"></div>
                </div>

                <div class="row">
                  <label for="authorEmail"><span><?php _e('E-mail', 'stela') ; ?></span><span class="req">*</span></label> 
                  <div class="input-box"><input id="authorEmail" type="email" name="authorEmail" required></div>
                </div>                  
              <?php } ?>

              <div class="row" id="last">
                <label for="title"><?php _e('Title', 'stela'); ?></label>
                <div class="input-box"><input id="title" type="text" name="title"></div>
              </div>
          
              <div class="row">
                <label for="title"><span><?php _e('Message', 'stela'); ?></span><span class="req">*</span></label>
                <textarea id="body" name="body" rows="10" required></textarea>
              </div>

              <button type="submit" id="comment-send"><?php _e('Send comment', 'stela') ; ?></button>
            </div>
          </fieldset>
        </form>
      </div>
    <?php } ?>
  <?php } ?>




  <?php if($type == 'public_contact') { ?>
    <!-- PUBLIC PROFILE CONTACT SELLER -->

    <?php if(osc_reg_user_can_contact() && osc_is_web_user_logged_in() || !osc_reg_user_can_contact() ) { ?>
      <div class="fw-box" style="display:block;">
        <form target="_top" action="<?php echo osc_base_url(true) ; ?>" method="post" name="contact_form" id="contact_form_public">
          <input type="hidden" name="action" value="contact_post" class="nocsrf" />
          <input type="hidden" name="page" value="user" />
          <input type="hidden" name="id" value="<?php echo $user_id; ?>" />

          <div class="head">
            <h2><?php _e('Contact seller', 'stela'); ?></h2>
          </div>

          <div class="middle">
            <fieldset>
              <?php if(osc_is_web_user_logged_in()) { ?>
                <input id="yourName" type="text" name="yourName" value="<?php echo osc_logged_user_name(); ?>">
                <input id="yourEmail" type="text" name="yourEmail" value="<?php echo osc_logged_user_email(); ?>">
              <?php } else { ?>
                <div class="row">
                  <label for="yourName"><?php _e('Name', 'stela'); ?></label> 
                  <div class="input-box"><input id="yourName" type="text" name="yourName" required></div>
                </div>

                <div class="row">
                  <label for="yourEmail"><span><?php _e('E-mail', 'stela') ; ?></span><span class="req">*</span></label> 
                  <div class="input-box"><input id="yourEmail" type="text" name="yourEmail" required></div>
                </div>
              <?php } ?>              

              <div class="row last">
                <label for="phoneNumber"><span><?php _e('Phone number', 'stela') ; ?></span></label>
                <div class="input-box"><input id="phoneNumber" type="text" name="phoneNumber"></div>
              </div>

              <div class="row">
                <label for="message"><span><?php _e('Message', 'stela') ; ?></span><span class="req">*</span></label>
                <textarea id="message" name="message" rows="10" required></textarea>
              </div>

              <?php stela_show_recaptcha(); ?>

              <button type="submit" id="public-message"><?php _e('Send message', 'stela') ; ?></button>
            </fieldset>
          </div>
        </form>
      </div>
    <?php } ?>
  <?php } ?>


  <?php if($type == 'alerts') { ?>
    <!-- HEADER NOTIFICATIONS -->

    <div id="header-alerts" class="fw-box stela-box" style="display:block;">
      <div class="head">
        <h2><?php _e('Notifications', 'stela'); ?></h2>
      </div>

      <div class="middle">
        <?php osc_run_hook('theme_notifications'); ?>

        <?php if(!stela_check_notifications()) { ?>
          <div class="notification-blank"><?php _e('No new notifications', 'stela'); ?></div>
        <?php } ?>
      </div>
    </div>
  <?php } ?>



  <script>
    $(document).ready(function(){
      $('.fw-box button').click(function(e){
        if (typeof grecaptcha !== 'undefined') {
          var recaptchaResponse = grecaptcha.getResponse();

          if(recaptchaResponse == ""){ 
            alert('<?php echo osc_esc_js(__('Error: Please fill recaptcha correctly!', 'stela')); ?>');
            //$(".g-recaptcha").addClass("error");
            return false;
          }
        }
      });
    }); 
  </script>


  <div style="display:none!important;"><div><div>
    <?php osc_current_web_theme_path('footer.php') ; ?>
  </div></div></div>
</body>
</html>