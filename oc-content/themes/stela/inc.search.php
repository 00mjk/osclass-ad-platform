<div class="home-search-wrap">
  <div class="home-titles">


    
  </div>

  <div id="home-search">
    <div class="hs-box">
      <form action="<?php echo osc_base_url(true); ?>" method="get" class="search nocsrf" >
        <input type="hidden" name="page" value="search" />
        <input type="hidden" name="cookieAction" id="cookieAction" value="" />
        <input type="hidden" name="sCountry" class="sCountry" value="<?php echo Params::getParam('sCountry'); ?>"/>
        <input type="hidden" name="sRegion"  class="sRegion" value="<?php echo Params::getParam('sRegion'); ?>"/>
        <input type="hidden" name="sCity"  class="sCity" value="<?php echo Params::getParam('sCity'); ?>"/>

        <div class="b0">
          <div class="b1 i-box">
                        <?php if(osc_current_user_locale()=="ro_RO"){ ?>
            <label for="sPattern"><?php _e('Cauta....zzbeng!', 'stela'); ?></label>
            <?php }else{ ?> 
            <label for="sPattern"><?php _e('What are you looking for?', 'stela'); ?></label>
            <?php } ?>
            <div class="box">
              <?php if (osc_get_preference('item_ajax', 'stela_theme') == 1) { ?>
                <div id="item-picker">
                  <input type="text" name="sPattern" id="sPattern" class="pattern" onkeyup="btnDisabled()" placeholder="<?php _e('Ex: car, phone, house', 'stela'); ?>" value="<?php echo Params::getParam('sPattern'); ?>" autocomplete="off"/>

                  <div class="shower-wrap">
                    <div class="shower" id="shower">
                      <div class="option service min-char"><?php _e('Type keyword', 'stela'); ?></div>
                    </div>
                  </div>

                  <div class="loader"></div>
                </div>
              <?php } else { ?>
                <input type="text" name="sPattern" placeholder="<?php _e('Ex: car, phone, house', 'stela'); ?>" value="<?php echo Params::getParam('sPattern'); ?>" autocomplete="off"/>
              <?php } ?>
            </div>
          </div>

          <div class="b2 i-box">
            <label for="term"><?php _e('Where?', 'stela'); ?></label>
            <div class="box">
              <div id="location-picker">
                <?php if($location_closest <> '') { ?>
                  <i class="fa fa-crosshairs locate-me" title="<?php echo osc_esc_js(__('Get my location', 'stela')); ?>" data-location="<?php echo $location_closest; ?>"></i>
                <?php } ?>
                <input type="text" name="term" id="term" class="term" placeholder="<?php _e('Your city...', 'stela'); ?>" value="<?php echo stela_get_term(Params::getParam('term'), Params::getParam('sCountry'), Params::getParam('sRegion'), Params::getParam('sCity')); ?>" autocomplete="off"/>
                <div class="shower-wrap">
                  <div class="shower" id="shower">
                    <div class="option service min-char"><?php _e('Type country, region or city', 'stela'); ?></div>
                  </div>
                </div>

                <div class="loader"></div>
              </div>
            </div>
          </div>
        </div>

        <div class="b3">
            <?php if(osc_current_user_locale()=="ro_RO"){ ?>
          <button type="submit" id='home-button' class="round3 tr1" disabled><i class="fa fa-search"></i><span><?php _e('Cauta....zzbeng!', 'stela'); ?></span></button>
          <?php }else{ ?>
          <button type="submit" id='home-button' class="round3 tr1" disabled><i class="fa fa-search"></i><span><?php _e('Search', 'stela'); ?></span></button>
          <?php } ?>
          
        </div>
      </form>
    </div>
  </div>





  <?php osc_current_web_theme_path('inc.category.php'); ?>
  


</div>