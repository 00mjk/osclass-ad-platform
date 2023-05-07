<script type="text/javascript">
$(document).ready(function(){
  var alert_close_btn = true;

  $('body').on('click', '.sub_button', function(e){
    $.post('<?php echo osc_base_url(true); ?>', {email:$("#alert_email").val(), userid:$("#alert_userId").val(), alert:$("#alert").val(), page:"ajax", action:"alerts"}, 
      function(data){
        if(data==1) { 
          if (!!$.prototype.fancybox) {
            $.fancybox({
              'padding':  0,
              'width':    480,
              'height':   480,
              'autoSize': false,
              'autoDimensions': false,
              'closeBtn' : alert_close_btn,
              'wrapCSS':  'alert-func',
              'content':  '<div id="alert-ok" class="fw-box alert-messages">' + $('.fw-box#alert-ok').html() + '</div>'
            });
          }
        } else if(data==-1) { 
          if (!!$.prototype.fancybox) {
            $.fancybox({
              'padding':  0,
              'width':    480,
              'height':   480,
              'autoSize': false,
              'autoDimensions': false,
              'closeBtn' : alert_close_btn,
              'wrapCSS':  'alert-func',
              'content':  '<div id="alert-email" class="fw-box alert-messages">' + $('.fw-box#alert-email').html() + '</div>'
            });
          }
        } else { 
          if (!!$.prototype.fancybox) {
            $.fancybox({
              'padding':  0,
              'width':    480,
              'height':   480,
              'autoSize': false,
              'autoDimensions': false,
              'closeBtn' : alert_close_btn,
              'wrapCSS':  'alert-func',
              'content':  '<div id="alert-ok" class="fw-box alert-messages">' + $('.fw-box#alert-ok').html() + '</div>'
            });
          }
        };
    });
    return false;
  });
});
</script>

<div id="n-block" class="block <?php if(osc_is_web_user_logged_in()) { ?>logged_user<?php } else { ?>unlogged_user<?php } ?>">
  <div class="n-wrap">
    <form action="<?php echo osc_base_url(true); ?>" method="post" name="sub_alert" id="sub_alert" class="<?php if(osc_is_web_user_logged_in()) { ?>logged<?php } ?>">
      <?php AlertForm::page_hidden(); ?>
      <?php AlertForm::alert_hidden(); ?>
      <?php AlertForm::user_id_hidden(); ?>

      <?php if(osc_is_web_user_logged_in()) { ?>

        <?php AlertForm::email_hidden(); ?>

      <?php } else { ?>

        <div class="bot" style="display:none;">
          <?php AlertForm::email_text(); ?>
          <button type="button" class="btn btn-secondary alert-notify"><i class="fa fa-check"></i></button>
        </div>
      <?php } ?>
    </form>
  </div>
</div>



<!-- ALERT MESSAGES -->
<div class="alert-fancy-boxes">
  <div id="alert-ok" class="fw-box">
    <div class="head">
      <h2><?php _e('Subscribe search', 'stela'); ?></h2>
    </div>

    <div class="middle">
      <div class="a-message">
        <div class="icon good"><i class="fa fa-check-circle"></i></div>
        <span class="title"><?php _e('You have successfully subscribed this search!', 'stela'); ?></span>
        <span class="message"><?php _e('You will recieve notification to your email once there is new listing that match your search criteria.', 'stela'); ?></span>
      </div>
    </div>
  </div>

  <div id="alert-email" class="fw-box">
    <div class="head">
      <h2><?php _e('Subscribe search', 'stela'); ?></h2>
    </div>

    <div class="middle">
      <div class="a-message">
        <div class="icon bad"><i class="fa fa-times-circle"></i></div>
        <span class="title"><?php _e('There was error during subscription process!', 'stela'); ?></span>

        <?php if(!osc_is_web_user_logged_in()) { ?>
          <span class="message"><?php _e('You must be logged in.', 'stela'); ?></span>
        <?php } else { ?>
          <span class="message"><?php _e('You have entered email address in incorrect format or you did not entered email address.', 'stela'); ?></span>
        <?php } ?>
      </div>
    </div>
  </div>

  <div id="alert-error" class="fw-box">
    <div class="head">
      <h2><?php _e('Subscribe search', 'stela'); ?></h2>
    </div>

    <div class="middle">
      <div class="a-message">
        <div class="icon good"><i class="fa fa-check-circle"></i></div>
        <span class="title"><?php _e('You have already subscribed to this search.', 'stela'); ?></span>
        <span class="message"><?php _e('You can find alerts you have subscribed for in your account.', 'stela'); ?></span>
      </div>
    </div>
  </div>
</div>