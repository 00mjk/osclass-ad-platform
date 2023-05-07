<?php
  $locales = __get('locales');
  $user = osc_user();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="<?php echo str_replace('_', '-', osc_current_user_locale()); ?>">
<head>
  <?php osc_current_web_theme_path('head.php') ; ?>
  <meta name="robots" content="noindex, nofollow" />
  <meta name="googlebot" content="noindex, nofollow" />
</head>
<body id="body-user-profile" class="body-ua">
  <?php osc_current_web_theme_path('header.php') ; ?>
  <div class="content user_account">
    <div id="sidebar" class="sc-block">
      <?php echo stela_user_menu(); ?>
      <a class="btn-remove-account btn" style="width:100%;" href="<?php echo osc_base_url(true).'?page=user&action=delete&id='.osc_user_id().'&secret='.$user['s_secret']; ?>" onclick="return confirm('<?php echo osc_esc_js(__('Esti sigur ca doresti sa stergi contul? ', 'stela')); ?>?')"><span><i class="fa fa-times"></i> <?php _e('Sterge contul', 'stela'); ?></span></a>
    </div>

    <div id="main" class="modify_profile">
      <div class="inside">

        <form action="<?php echo osc_base_url(true); ?>" method="post">
          <input type="hidden" name="page" value="user" />
          <input type="hidden" name="action" value="profile_post" />

          <div id="left-user" class="box">
            <h3 class="title_block"><?php _e('Informatii personale', 'stela'); ?></h3>
            <div class="row">
              <label for="s_name"><span><?php _e('Name', 'stela'); ?></span><span class="req">*</span></label>
              <div class="input-box"><?php UserForm::name_text(osc_user()); ?></div>
            </div>

            
             
            

            <div class="row">
              <label for="email"><span><?php _e('E-mail', 'stela'); ?></span><span class="req">*</span></label>
              <span class="update current_email">
                <span><?php echo osc_user_email(); ?></span>
              </span>
            </div>

            <div class="row">
              <label for="s_phone_mobile"><span><?php _e('Telefon', 'stela'); ?></span><span class="req">*</span></label>
              <div class="input-box"><?php UserForm::mobile_text(osc_user()); ?></div>
            </div>

            <div class="row">
              <label for="s_phone_land"><?php _e('Fix/Fax', 'stela'); ?></label>
              <div class="input-box"><?php UserForm::phone_land_text(osc_user()); ?></div>
            </div>                        

            <div class="row">
              <label for="s_info"><?php _e('Despre tine', 'stela'); ?></label>
              <?php UserForm::multilanguage_info($locales, osc_user()); ?>
            </div>

            <div class="row user-buttons">
              <button type="submit" class="btn btn-primary"><?php _e('Actualizeaza', 'stela'); ?></button>
            </div>
          </div>

          <div id="right-user" class="box">
            <h3 class="title_block"><?php _e('Locatie / Afacere', 'stela'); ?></h3>

            <div class="row">
              <input type="hidden" name="countryId" id="countryId" class="sCountry" value="<?php echo $user['fk_c_country_code']; ?>"/>
              <input type="hidden" name="regionId" id="regionId" class="sRegion" value="<?php echo $user['fk_i_region_id']; ?>"/>
              <input type="hidden" name="cityId" id="cityId" class="sCity" value="<?php echo $user['fk_i_city_id']; ?>"/>

              <label for="term"><?php _e('Location', 'stela'); ?></label>

              <div id="location-picker">
                <input type="text" name="term" id="term" class="term" placeholder="<?php _e('Country, Region or City', 'stela'); ?>" value="<?php echo stela_get_term(Params::getParam('term'), stela_ajax_country(), stela_ajax_region(), stela_ajax_city()); ?>" autocomplete="off"/>
                <div class="shower-wrap">
                  <div class="shower" id="shower">
                    <div class="option service min-char"><?php _e('Type country, region or city', 'stela'); ?></div>
                  </div>
                </div>

                <div class="loader"></div>
              </div>
            </div>

            <div class="row">
              <label for="cityArea"><?php _e('Adresa', 'stela'); ?></label>
              <div class="input-box"><?php UserForm::city_area_text(osc_user()); ?></div>
            </div>

            <div class="row">
              <label for="address"><?php _e('Strada', 'stela'); ?></label>
              <div class="input-box"><?php UserForm::address_text(osc_user()); ?></div>
            </div>

            <div class="row">
              <label for="zip"><?php _e('ZIP', 'stela'); ?></label>
              <div class="input-box"><?php UserForm::zip_text(osc_user()); ?></div>
            </div>

            <div class="row">
              <label for="b_company"><?php _e('Tip utilizator', 'stela'); ?></label>
              <div class="input-box"><?php UserForm::is_company_select(osc_user()); ?></div>
            </div>

            <div class="row">
              <label for="s_website"><?php _e('Site web', 'stela'); ?></label>
              <div class="input-box"><?php UserForm::website_text(osc_user()); ?></div>
            </div>

            <?php osc_run_hook('user_form'); ?>

            <div class="row user-buttons">
              <button type="submit" class="btn btn-primary"><?php _e('Actualizeaza', 'stela'); ?></button>
            </div>
          </div>
        </form>


        <!-- CHANGE EMAIL FORM -->
        <div class="box change-email">
          <h3 class="title_block"><?php _e('Schimba adresa de e-mail', 'stela'); ?> <i class="fa fa-angle-down block-show"></i></h3>

          <form action="<?php echo osc_base_url(true); ?>" method="post" id="user_email_change" class="user-change">
            <input type="hidden" name="page" value="user" />
            <input type="hidden" name="action" value="change_email_post" />
      
            <div class="row">
              <label for="email"><?php _e('Adresa curenta e-mail', 'stela'); ?></label>
              <span class="bold current_email"><?php echo osc_logged_user_email(); ?></span>
            </div>

            <div class="row">
              <label for="new_email"><?php _e('Adresa noua e-mail', 'stela'); ?> <span class="req">*</span></label>
              <div class="input-box"><input type="text" name="new_email" id="new_email" value="" /></div>
            </div>

            <div class="row user-buttons">
              <button type="submit" class="btn btn-primary"><?php _e('Actualizeaza', 'stela'); ?></button>
            </div>
          </form>
        </div>


        <!-- CHANGE PASSWORD FORM -->
        <div class="box change-pass last">
          <h3 class="title_block"><?php _e('Schimba parola', 'stela'); ?> <i class="fa fa-angle-down block-show"></i></h3>

          <form action="<?php echo osc_base_url(true); ?>" method="post" id="user_password_change" class="user-change">
            <input type="hidden" name="page" value="user" />
            <input type="hidden" name="action" value="change_password_post" />
      
            <div class="row">
              <label for="password"><?php _e('Parola veche', 'stela'); ?> <span class="req">*</span></label>
              <div class="input-box"><input type="password" name="password" id="password" value="" /></div>
            </div>

            <div class="row">
              <label for="new_password"><?php _e('Parola noua', 'stela'); ?> <span class="req">*</span></label>
              <div class="input-box"><input type="password" name="new_password" id="new_password" value="" /></div>
            </div>

            <div class="row">
              <label for="new_password2"><?php _e('Repeta noua parola', 'stela'); ?> <span class="req">*</span></label>
              <div class="input-box"><input type="password" name="new_password2" id="new_password2" value="" /></div>
            </div>


            <div class="row user-buttons">
              <button type="submit" class="btn btn-primary"><?php _e('Actualizeaza', 'stela'); ?></button>
            </div>
          </form>
        </div>
      </div>

      <a class="btn-remove-account btn" href="<?php echo osc_base_url(true).'?page=user&action=delete&id='.osc_user_id().'&secret='.$user['s_secret']; ?>" onclick="return confirm('<?php echo osc_esc_js(__('Esti sigur ca doresti sa stergi contul? ', 'stela')); ?>?')"><span><i class="fa fa-times"></i> <?php _e('Sterge contul', 'stela'); ?></span></a>

    </div>
  </div>

  <?php if(function_exists('profile_picture_upload')) { profile_picture_upload(); } ?>
  <?php osc_current_web_theme_path('footer.php'); ?>
</body>
</html>