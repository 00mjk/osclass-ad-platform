<div id="home-search">
  <div class="inside">
    <div class="cover"></div>
    <div class="slide-wrap">
      <div class="slide"></div>
    </div>


    <div class="box">
      <h2><?php _e('Search, Sell & Buy', 'beta'); ?></h2>
      <h3><span><?php _e('Best classifieds', 'beta'); ?></span> <?php _e('for you', 'beta'); ?> </h3>
      <h4><?php _e('We are no. 1 online classifieds platform, our is all about you. Our aim is to empower every person in the country to independently connect with buyers and sellers online. ', 'beta'); ?></h4>

      <div class="wrap">
        <form action="<?php echo osc_base_url(true); ?>" method="GET" class="nocsrf" id="home-form" >
          <input type="hidden" name="page" value="search" />
          <input type="hidden" name="sCountry" id="sCountry" value="<?php echo Params::getParam('sCountry'); ?>"/>
          <input type="hidden" name="sRegion" id="sRegion" value="<?php echo Params::getParam('sRegion'); ?>"/>
          <input type="hidden" name="sCity" id="sCity" value="<?php echo Params::getParam('sCity'); ?>"/>

          <div class="line1">
            <div class="col1">
              <div class="box">
                <div id="query-picker" class="query-picker">
                  <input type="text" name="sPattern" class="pattern" placeholder="<?php _e('What are you looking for?', 'beta'); ?>" value="<?php echo Params::getParam('sPattern'); ?>" autocomplete="off"/>

                  <div class="shower-wrap">
                    <div class="shower"></div>
                  </div>

                  <div class="loader"></div>
                </div>
              </div>
            </div>


            <div class="col2">
              <div class="box">
                <div id="location-picker" class="loc-picker ctr-<?php echo (bet_count_countries() == 1 ? 'one' : 'more'); ?>">
                  <div class="mini-box">
                    <input type="text" id="term2" class="term2" placeholder="<?php _e('Location', 'beta'); ?>" value="<?php echo bet_get_term(Params::getParam('term'), Params::getParam('sCountry'), Params::getParam('sRegion'), Params::getParam('sCity')); ?>" autocomplete="off" readonly/>
                    <i class="fa fa-angle-down"></i>
                  </div>

                  <div class="shower-wrap">
                    <div class="shower" id="shower">
                      <?php echo bet_locbox_short(); ?>
                    </div>
                  </div>

                  <div class="loader"></div>
                </div>
              </div>
            </div>


            <div class="col4">
              <div class="box"><button type="submit" class="btn mbBg"><?php _e('Search', 'beta'); ?></button></div>
            </div>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>



