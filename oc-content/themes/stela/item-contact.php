<!-- CONTACT FORM -->
<div id="o-forms" class="item-contact olivia-box">
  <div id="item-contact" class="box">
    <div class="h2"><?php _e('Contact seller', 'stela'); ?></div>

    <form action="<?php echo osc_base_url(true) ; ?>" method="post" target="_top" name="contact_form" id="contact_form" <?php if(osc_item_attachment()) { echo 'enctype="multipart/form-data"'; };?>>
      <input type="hidden" name="action" value="contact_post" />
      <input type="hidden" name="page" value="item" />
      <input type="hidden" name="id" value="<?php echo osc_item_id(); ?>" />

      <?php osc_prepare_user_info() ; ?>


      <?php if( osc_item_is_expired () ) { ?>
        <div class="issue">
          <?php _e('This listing expired, you cannot contact seller.', 'stela') ; ?>
        </div>
      <?php } else if( (osc_logged_user_id() == osc_item_user_id()) && osc_logged_user_id() != 0 ) { ?>
        <div class="issue">
          <?php _e('It is your own listing, you cannot contact yourself.', 'stela') ; ?>
        </div>
      <?php } else if( osc_reg_user_can_contact() && !osc_is_web_user_logged_in() ) { ?>
        <div class="issue">
          <?php _e('You must log in or register a new account in order to contact the advertiser.', 'stela') ; ?>
        </div>
      <?php } else { ?> 
        <?php if(osc_is_web_user_logged_in()) { ?>
          <input type="hidden" name="yourName" value="<?php echo osc_esc_html( osc_logged_user_name() ); ?>" />
          <input type="hidden" name="yourEmail" value="<?php echo osc_logged_user_email();?>" />
        <?php } else { ?>

          <label for="yourName"><span><?php _e('Your name', 'stela'); ?></span><div class="req">*</div></label> 
          <span class="input-box"><input id="yourName" type="text" name="yourName" required></span>

          <label for="yourEmail"><span><?php _e('Your e-mail address', 'stela'); ?></span><div class="req">*</div></label>
          <span class="input-box"><input id="yourEmail" type="email" name="yourEmail" required></span>
        <?php } ?>

        <label for="phoneNumber"><span><?php _e('Your phone', 'stela'); ?></span></label>
        <span class="input-box"><input id="phoneNumber" type="text" name="phoneNumber"></span>

        <label for="message"><span><?php _e('Your message', 'stela'); ?></span></label>
        <span class="input-box"><textarea id="message" name="message" rows="10" required></textarea></span>

        <?php if(osc_contact_attachment()) { ?>
          <div class="attachment">
            <div class="att-box">
              <label class="status">
                <span class="wrap"><i class="fa fa-paperclip"></i> <span><?php _e('Upload file', 'stela'); ?></span></span>
                <?php ContactForm::your_attachment(); ?>
              </label>
            </div>
          </div>
        <?php } ?>

        <?php osc_run_hook('item_contact_form', osc_item_id()); ?>

        <?php stela_show_recaptcha(); ?>

        <button type="submit" id="contact-submit"><?php _e('Send message', 'stela'); ?></button>
      <?php } ?>
    </form>
  </div>
</div>

<script>
  $(document).ready(function(){
    $('button#contact-submit').click(function(e){
      var recaptchaResponse = grecaptcha.getResponse();

      if(recaptchaResponse == ""){ 
        alert('<?php echo osc_esc_js(__('Error: Please fill recaptcha correctly!', 'stela')); ?>');
        $(".g-recaptcha").addClass("error");
        return false;
      }
    });
  }); 
</script>