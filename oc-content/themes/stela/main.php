<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="<?php echo str_replace('_', '-', osc_current_user_locale()) ; ?>">
<head>
  <?php  osc_current_web_theme_path('head.php') ; ?>
  
  
 
</head>

<body id="body-home">
  <?php osc_current_web_theme_path('header.php') ; ?>
  <?php echo stela_banner('home_top'); ?>
  <div class="mob-banner">
      <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6670632475662042"
     crossorigin="anonymous"></script>
<ins class="adsbygoogle"
     style="display:block"
     data-ad-format="fluid"
     data-ad-layout-key="-gw-3+1f-3d+2z"
     data-ad-client="ca-pub-6670632475662042"
     data-ad-slot="5998128644"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>
      
  </div>


<center>
    <div style="width:100%; background: #F0F0F0;">
<div style="max-width:1160px; text-align:left; padding:10px;">
      <div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/ro_RO/sdk.js#xfbml=1&version=v7.0&appId=643832216017902&autoLogAppEvents=1"></script>


</center>

</div></div>


  <?php if(function_exists('osc_slider')) { ?>

    <!-- Slider Block -->
    <div class="home-container hc-slider">
      <div class="inner">
        <div id="home-slider">
          <?php osc_slider(); ?>
        </div>
      </div>
    </div>
  <?php } ?>



  <?php osc_get_premiums(osc_get_preference('premium_home_count', 'stela_theme')); ?>
  <?php if( osc_count_premiums() > 0 && osc_get_preference('premium_home', 'stela_theme') == 1) { ?>

 <?php osc_query_item(array(
    "category" => "107,198,118,131,151,160,168,180,174,183,188,206,216,",
    "premium" => "1"
));?>
    <!-- Extra Premiums Block -->
    <div class="home-container hc-premiums">
      <div class="inner">

        <div id="latest" class="white prem">
          <h2 class="home">
            <?php _e('Anunturi promovate', 'stela'); ?>
          </h2>

          <div class="block">
            <div class="wrap">
              <?php $c = 1; ?>
              <?php while ( osc_has_custom_items() ) { ?>

<?php stela_draw_item($c); ?>

<?php $c++; ?>
              <?php } ?>
            </div>
          </div>


          <?php //View::newInstance()->_erase('items') ; ?>
        </div>
      </div>
    </div>
  <?php } ?>



  <!-- Latest Listings Block -->
  <div class="home-container hc-latest">
    <div class="inner">

      <div id="latest" class="white">
        <h2 class="home">
         <i class="fa fa-check-square" style="color:#076E73"></i>  <?php _e('Cele mai noi anunturi', 'stela'); ?>
        </h2>
        
       
    <!--<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Vinde și cumpară rapid,postează anunțul tău acum fară sa iți creezi un cont.</strong> </p>-->
    <!--      <br>-->
        <?php View::newInstance()->_exportVariableToView('latestItems', stela_random_items()); ?>

        <?php if( osc_count_latest_items() > 0) { ?>
          <div class="block">
            <div class="wrap">
              <?php $c = 1; ?>
              <?php while( osc_has_latest_items() ) { ?>
                <?php stela_draw_item($c, 'gallery'); ?>
                
                
                 <?php if($c % 20 == 0) { ?>
                 
                <div style="margin-bottom:20px;"> <?php echo stela_banner('home_top'); ?> 
                
              <div class="banner-theme banner-item_description" style="margin-bottom:20px;">
                     
                     
                      <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6670632475662042"
     crossorigin="anonymous"></script>
<!-- zzbeng rectangle -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-6670632475662042"
     data-ad-slot="4364099883"
     data-ad-format="auto"
     data-full-width-responsive="true"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>

                 </div>
                
                
                
                </div>
                
               
		<?php } ?>
		
		
		
		
                <?php $c++; ?>
              <?php } ?>
            </div>
          </div>
        
          <div class="home-see-all non-resp">
            <a href="<?php echo osc_search_url(array('page' => 'search'));?>"><?php _e('See all offers', 'stela'); ?></a>
            <i class="fa fa-angle-down"></i>
          </div>
        <?php } else { ?>
          <div class="empty"><?php _e('No latest listings', 'stela'); ?></div>
        <?php } ?>

        <?php View::newInstance()->_erase('items') ; ?>
      </div>
    </div>
  </div>



  <?php echo stela_banner('home_bottom'); ?>




   

  <?php osc_current_web_theme_path('footer.php') ; ?>
  


  
</body>
</html>	