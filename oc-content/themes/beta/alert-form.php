<script type="text/javascript">
$(document).ready(function(){
  <?php if(!osc_is_web_user_logged_in()) { ?>$('#alert_email').val('');<?php } ?>
  $('#alert_email').attr('placeholder', '<?php echo osc_esc_js(__('Email', 'beta')) ; ?>');

  $('body').on('click', 'button.alert-notify, button.alert-notify2', function(e){
    e.preventDefault();

    if($('#alert_email').val() == '' && $("#alert_userId").val() <= 0) {
      betAddFlash('<?php echo osc_esc_js(__('Please enter your email address!', 'beta')); ?>', 'error');
      return false;
    }


    $.post(
      '<?php echo osc_base_url(true); ?>', 
      {
        email: $("#alert_email").val(), 
        userid: $("#alert_userId").val(), 
        alert: $("#alert").val(), 
        page:"ajax", 
        action:"alerts"
      }, 
      function(data){
        if(data==1) {
          betAddFlash('<?php echo osc_esc_js(__('You have successfully subscribed to alert!', 'beta')); ?>', 'ok');

        } else if(data==-1) { 
          betAddFlash('<?php echo osc_esc_js(__('There was error during subscription process - incorrect email address format!', 'beta')); ?>', 'error');

        } else if(data==0) { 
          betAddFlash('<?php echo osc_esc_js(__('You have already subscribed to this search!', 'beta')); ?>', 'info');

        }
    });

    $('.alert-box').slideUp(200);
    return false;
  });
});
</script>

<div id="n-block" class="block <?php if(osc_is_web_user_logged_in()) { ?>is-logged<?php } else { ?>not-logged<?php } ?>">
  <div class="n-wrap">
    <form action="<?php echo osc_base_url(true); ?>" method="post" name="sub_alert" id="sub_alert" class="nocsrf">
      <?php AlertForm::page_hidden(); ?>
      <?php AlertForm::alert_hidden(); ?>
      <?php AlertForm::user_id_hidden(); ?>


      <?php if(osc_is_web_user_logged_in()) { ?>
        <?php AlertForm::email_hidden(); ?>
        <button type="button" class="alert-notify">
          <i class="fa fa-bell-o"></i> 
          <span class="isDesktop isTablet"><?php _e('Subscribe to this search', 'beta'); ?></span>
          <span class="isMobile"><?php _e('Subscribe', 'beta'); ?></span>
        </button>

      <?php } else { ?>
        <a href="#" class="alert-notify">
          <i class="fa fa-bell-o"></i>
          <span class="isDesktop isTablet"><?php _e('Subscribe to this search', 'beta'); ?></span>
          <span class="isMobile"><?php _e('Subscribe', 'beta'); ?></span>
        </a>

        <div class="alert-box">
          <?php AlertForm::email_text(); ?>
          <button type="button" class="btn btn-primary mbBg alert-notify2"><?php _e('Subscribe', 'beta'); ?></button>
        </div>
      <?php } ?>

    </form>
  </div>
</div>