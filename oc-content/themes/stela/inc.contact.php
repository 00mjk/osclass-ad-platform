<!-- CONTACT FORM -->
<div id="o-forms" class="contact stela-box <?php echo (osc_get_preference('forms_ajax', 'stela_theme') == 1 ? 'ajax-submit' : ''); ?>">
  <div id="contact" class="box">
    <div class="h2"><?php _e('Contact Zzbeng', 'stela'); ?></div>

    <form action="<?php echo osc_base_url(true) ; ?>" method="post" target="_top" name="contact_form" <?php if(osc_contact_attachment()) { echo 'enctype="multipart/form-data"'; };?>>
      <input type="hidden" name="page" value="contact" />
      <input type="hidden" name="action" value="contact_post" />

      <?php if(osc_is_web_user_logged_in()) { ?>
        <input type="hidden" name="yourName" value="<?php echo osc_esc_html( osc_logged_user_name() ); ?>" />
        <input type="hidden" name="yourEmail" value="<?php echo osc_logged_user_email();?>" />
      <?php } else { ?>

        <label for="yourName"><span><?php _e('Your name', 'stela'); ?></span></label> 
        <span class="input-box"><input id="yourName" type="text" name="yourName" required></span>

        <label for="yourEmail"><span><?php _e('Your e-mail address', 'stela'); ?></span><div class="req">*</div></label>
        <span class="input-box"><input id="yourEmail" type="email" name="yourEmail" required></span>
      <?php } ?>

      <label for="subject"><span><?php _e("Subject", 'stela'); ?></span><div class="req">*</div></label>
      <span class="input-box"><input id="subject" type="text" name="subject" required></span>

      <label for="message"><span><?php _e("Message", 'stela'); ?></span><div class="req">*</div></label>
      <span class="input-box last"><textarea id="message" name="message" rows="10" required></textarea></span>

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


      <?php stela_show_recaptcha(); ?>

      <button type="submit" id="contact-submit"><?php _e('Send message', 'stela'); ?></button>
    </form>
  </div>
</div>

<div style="display:none!important;"><div><div>
  <?php osc_current_web_theme_path('footer.php') ; ?>
</div></div></div>


<script>
  $(document).ready(function(){
    $('#o-forms button').click(function(e){
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