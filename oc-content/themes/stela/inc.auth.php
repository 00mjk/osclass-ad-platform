<!-- LOGIN & REGISTER FORMS -->
<div id="o-forms" class="auth stela-box">
  <div id="login" class="box">
    <div class="h2"><?php _e('Sign in', 'stela'); ?></div>

<center><a href="https://zbeng.ro/usl-auth?&l=Facebook" target="_parent"><img src="https://zbeng.ro/conectare.png" border="0"></a>
</center>



    <form action="<?php echo osc_base_url(true); ?>" method="post" target="_top">
      <input type="hidden" name="page" value="login" />
      <input type="hidden" name="action" value="login_post" />
      <input type="hidden" name="type" value="box" />
      
      <label for="email"><span><?php _e('E-mail', 'stela'); ?></span></label> 
      <span class="input-box"><input id="email" type="text" name="email" required></span>

      <label for="password"><span><?php _e('Password', 'stela'); ?></span></label> 
      <span class="input-box"><input id="password" type="password" name="password" autocomplete="off" required></span>

      <div class="login-line">
        <div class="input-box-check">
          <?php UserForm::rememberme_login_checkbox();?>
          <label for="remember"><?php _e('Keep me signed in', 'stela'); ?></label>
        </div>
      </div>

      <button type="submit"><?php _e('Sign in', 'stela');?></button>

      <div class="swap">
        <a href="#" class="swap-box-auth to-reg"><?php _e('No account?', 'stela'); ?> <?php _e('Sign up', 'stela'); ?></a>
        <a href="#" class="more-login swap-box-auth to-lost"><?php _e('Lost password?', 'stela'); ?></a>
      </div>



      <?php if(class_exists('OSCFacebook')) { ?>
        <?php 
          $user = OSCFacebook::newInstance()->getUser();
          if( !$user or !osc_is_web_user_logged_in() ) {
        ?>
          <a class="external-log fb btn round3 tr1" target="_top" href="<?php echo OSCFacebook::newInstance()->loginUrl(); ?>"><i class="fa fa-facebook"></i><?php _e('Facebook', 'stela'); ?></a>
        <?php } ?>
      <?php } ?>

      <?php if(function_exists('gc_login_button')) { ?>
        <a class="external-log gc btn round3 tr1" target="_top" href="<?php gc_login_button('link-only'); ?>"><i class="fa fa-google"></i><?php _e('Google', 'stela'); ?></a>
      <?php } ?>
    </form>
  </div>



  <div id="register" class="box">
    <div class="h2"><?php _e('Sign up', 'stela'); ?></div>

    <form name="register" action="<?php echo osc_base_url(true); ?>" method="post" target="_top">
      <input type="hidden" name="page" value="register" />
      <input type="hidden" name="action" value="register_post" />
      <input type="hidden" name="type" value="box" />

      <h1></h1>
      <ul id="error_list"></ul>

      <label for="name"><span><?php _e('Name', 'stela'); ?></span><span class="req">*</span></label> 
      <span class="input-box"><input id="s_name" type="text" name="s_name" required></span>

      <label for="email"><span><?php _e('E-mail', 'stela'); ?></span><span class="req">*</span></label> 
      <span class="input-box"><input id="s_email" type="email" name="s_email" required></span>

      <label for="password"><span><?php _e('Password', 'stela'); ?></span><span class="req">*</span></label> 
      <span class="input-box"><input id="s_password" type="password" name="s_password" autocomplete="off" required></span>

      <label for="password"><span><?php _e('Re-type password', 'stela'); ?></span><span class="req">*</span></label> 
      <span class="input-box"><input id="s_password2" type="password" name="s_password2" autocomplete="off" required></span>


      <?php osc_run_hook('user_register_form'); ?>

      <?php stela_show_recaptcha('register'); ?>

      <button type="submit" id="reg-button"><?php _e('Create account', 'stela'); ?></button>

      <div class="swap">
        <a href="#" class="swap-box-auth to-log"><?php _e('Already registered?', 'stela'); ?> <?php _e('Sign in', 'stela'); ?></a>
      </div>
    </form>
  </div>


  <div id="lost" class="box">
    <div class="h2"><?php _e('Recover password', 'stela'); ?></div>

    <form action="<?php echo osc_base_url(true) ; ?>" method="post" target="_top">
      <input type="hidden" name="page" value="login" />
      <input type="hidden" name="action" value="recover_post" />

      <label for="email"><span><?php _e('E-mail', 'stela'); ?></span></label> 
      <span class="input-box"><input id="s_email" type="email" name="s_email" required></span>


      <button type="submit" id="blue"><?php _e('Send a new password', 'stela') ; ?></button>

      <div class="swap">
        <a href="#" class="swap-box-auth to-log"><?php _e('Already registered?', 'stela'); ?> <?php _e('Sign in', 'stela'); ?></a>
      </div>
    </form>
  </div>
</div>


<script>
  // PASSWORD MATCH
  var password = document.getElementById("s_password")
  var confirm_password = document.getElementById("s_password2");

  function validatePassword(){
    if(password.value != confirm_password.value) {
      confirm_password.setCustomValidity("Passwords Don't Match");
    } else {
      confirm_password.setCustomValidity('');
    }
  }

  password.onchange = validatePassword;
  confirm_password.onkeyup = validatePassword;
</script>


<script>
  $(document).ready(function(){
    $('button#reg-button').click(function(e){
      var recaptchaResponse = grecaptcha.getResponse();

      if(recaptchaResponse == ""){ 
        alert('<?php echo osc_esc_js(__('Error: Please fill recaptcha correctly!', 'stela')); ?>');
        $(".g-recaptcha").addClass("error");
        return false;
      }
    });
  }); 
</script>