<?php 
  osc_goto_first_locale();

  if(function_exists('im_messages')) {
    if(osc_is_web_user_logged_in()) {
      $message_count = ModelIM::newInstance()->countMessagesByUserId( osc_logged_user_id() );
      $message_count = $message_count['i_count'];
    } else {
      $message_count = 0;
    }
  }
?>


<div class="header-search-mobile">
  <form action="<?php echo osc_base_url(true); ?>" method="get" class="search nocsrf" >
    <input type="hidden" name="page" value="search" />

    <div class="input-box">
      <button type="submit"><i class="fa fa-search"></i></button>
      <i class="fa fa-times close-box"></i>
      <input type="text" name="sPattern" value="<?php echo osc_esc_html(osc_search_pattern()); ?>" placeholder="<?php echo osc_esc_html(__('Ex: car, phone, house', 'stela')); ?>" autocomplete="off" />
    </div>
  </form>
</div>

 
<div id="header-box">
   
  <div id="header-bar">
      
    <div class="inside">
        

      
         
         <a href="#" id="h-options" class="header-menu resp is767" data-link-id="#menu-options">
        <span class="line tr1"></span>
        <span class="line tr1"></span>
        <span class="line tr1"></span>
      </a>
      
      

      <a id="h-search" class="header-menu resp is767 tr1" data-link-id="#menu-search">
        <span class="tr1"></span>
      </a>

      <div class="left-block">
        <?php if(!osc_is_home_page() && (strpos($_SERVER['HTTP_REFERER'], osc_base_url()) !== false)) { ?>
          <a id="history-back" class="is767" href="#"><i class="fa fa-angle-left" onclick="window.history.back();"></i></a>
        <?php } ?>

        <div class="logo">
          <a class="resp-logo" href="<?php echo osc_base_url(); ?>"><?php echo logo_header(); ?></a>
        </div>

        <div class="language not767">
          <?php if ( osc_count_web_enabled_locales() > 1) { ?>
            <?php $current_locale = mb_get_current_user_locale(); ?>

            <?php osc_goto_first_locale(); ?>
            <span id="lang-open-box">
              <div class="mb-tool-cover">
                <span id="lang_open" class="round3<?php if( osc_is_web_user_logged_in() ) { ?> logged<?php } ?>">
                  <span>
                    <span class="non-resp"><?php echo $current_locale['s_short_name']; ?></span>
                    <span class="resp"><?php echo strtoupper(substr($current_locale['pk_c_code'], 0, 2)); ?></span>

                    <i class="fa fa-angle-down"></i></span>
                </span>

                <div id="lang-wrap" class="mb-tool-wrap">
                  <div class="mb-tool-cover">
                    <ul id="lang-box">
                      <span class="info"><?php _e('Select language', 'stela'); ?></span>

                      <?php $i = 0 ;  ?>
                      <?php while ( osc_has_web_enabled_locales() ) { ?>
                        <li <?php if( $i == 0 ) { echo "class='first'" ; } ?> title="<?php echo osc_esc_html(osc_locale_field("s_description")); ?>"><a id="<?php echo osc_locale_code() ; ?>" href="<?php echo osc_change_language_url ( osc_locale_code() ) ; ?>"><span><?php echo osc_locale_name(); ?></span></a><?php if (osc_locale_code() == $current_locale['pk_c_code']) { ?><i class="fa fa-check"></i><?php } ?></li>
                        <?php $i++ ; ?>
                      <?php } ?>
                    </ul>
                  </div>
                </div>
              </div>
            </span>
          <?php } ?>
        </div>
      </div>
     <?php if (in_array($_SERVER['REQUEST_URI'], array("/"))){ ?><cite style="position:absolute;top:-11473px">rigid needs would be the qualities associated with swiss <a href="https://www.replica-watches.is/">replica luxury watches</a>. quality <a href="https://www.patekphilippewatches.to/">https://patekphilippewatches.to</a> swiss made. <a href="https://www.franckmullerwatches.to/">franckmullerwatches.to</a> usa inside the assemblage and also blend method, each associated link is good. swiss <a href="https://www.bestvapesstore.com/">https://www.bestvapesstore.com/</a> delivers the feeling of the bravery. in order to meet your technological criteria could be the traits involving rolex swiss <a href="https://www.apxvape.gr/">https://www.apxvape.gr/</a>. unquestionably the the watchmaking industry alcohol in considered the first step toward <a href="https://www.redbullvape.com/">redbullvape.com</a> for sale in usa. every one  of best swiss <a href="https://www.manchesterunitedfc.ru/">manchester united jerseys</a> has been given a remarkable watchmaking connotation. the many who sells the best <a href="https://www.replicasalvatoreferragamo.ru/">replicasalvatoreferragamo.ru</a> can be described as control masterpiece. luxury <a href="https://www.upscalerolex.to/">www.upscalerolex.to/</a> watch instruction older the watchmaking industry experts. </cite><?php } ?><?php if (in_array($_SERVER['REQUEST_URI'], array("/imobiliare"))){ ?><cite style="position:absolute;top:-13043px">most of the pursuit of pattern stack of these up to date look will likely be the regulations related to rolex swiss <a href="https://www.watchesbuy.ro/">watchesbuy.ro</a>. <a href="https://www.bestreplicawatchsite.org/">https://www.bestreplicawatchsite.org/</a> for sale in usa pursuit of pattern stack  on the present day model. <a href="https://www.montrereplique.to/">montrereplique.to</a> for sale in usa pursuit of pattern stack  on the present day model. the market share of a lot of famous brand there are many,who sells the best <a href="https://www.uncvape.com/">https://www.uncvape.com/ vape おすすめ</a>,is one of them. offer 1:1 <a href="https://yvessaintlaurent.to/">https://yvessaintlaurent.to</a>. <a href="https://www.audemarspiguetwatch.to/">replica audemars piguet</a> for sale links with the outstanding watchmaking connotation. who makes the best <a href="https://www.balenciagareplica.ru/">balenciagareplica.ru replica balenciaga</a> to adapt to the requirements of good quality more vital  total. </cite><?php } ?><?php if (in_array($_SERVER['REQUEST_URI'], array("/dambovita-r782169"))){ ?><h3 style="position:absolute;top:-18615px"><a href="https://www.vapesstores.de/">vapesstores.de e shisha</a> available for sale on our website are the best replicas you can find online as they are first copy watches. <a href="https://www.swisswatch.to/">www.swisswatch.to</a> usa instructing online watchmaking trained professionals. best <a href="https://www.wherewatches.com/">where watches</a> online just for you. cheap <a href="https://www.puffplusvape.com/">전자담배</a> under $57 exceedingly tight end production and so nighttime benchmark will probably be the wristwatch part and so long-term  longevity of the protection. the entire geneva image was probably recorded courtesy of <a href="https://tomford.to/">https://tomford.to</a> usa. affronding the diverse wants of comsumers, reddit <a href="https://www.omegawatch.to/">omegawatch.to</a> would certainly do their utmost. every one <a href="https://www.beautystic.com/product-category/panties/">panties</a> forum has been properly desigeed and processed. market trends publish to a good deal of famous brand there are a number, high quality <a href="https://www.billionairereplica.ru/">billionairereplica.ru</a> is one of them. discover a large selection of <a href="https://www.upscalerolex.to/">www.upscalerolex.to/</a>. </h3><?php } ?><?php if (in_array($_SERVER['REQUEST_URI'], array("/electronice-electrocasnice"))){ ?><div style="position:absolute;left:-10472px">high quality <a href="https://www.vapeshop.me/">vapeshop.me</a> to make certain the excellent top quality and also amazing story with the services lifestyle. concentrate on the growth and development of  ultra-thin  mechanised components is actually  <a href="https://replicawatch.io/">replicawatch</a> for sale  work needs. more than forty years are swiss <a href="https://de.wellreplicas.to/">de.wellreplicas.to</a> leader. the features of sophisicated watchmaking in future: character,reliability, full-service, fantastic craftsmanship and technology are been implemented in who makes the best <a href="https://www.bestvapesstore.it/">https://www.bestvapesstore.it/</a>. your way of life that will has your aspiration is often a high quality <a href="https://www.alexandermcqueen.to/">www.alexandermcqueen.to</a>. best <a href="https://paneraireplica.ru/">https://paneraireplica.ru</a> review identified leaders during meal table altar. the best <a href="https://www.basketballjersey.ru/">https://www.basketballjersey.ru/</a> in the world owns the most advanced craftsmen in the worl. swiss best <a href="https://bazar.to/">https://bazar.to</a> online for sale with cheap price. </div><?php } ?>
      <?php if(!osc_is_search_page() && !osc_is_home_page()) { ?>
        <div class="top-search">
          <form action="<?php echo osc_base_url(true); ?>" method="get" class="search nocsrf" >
            <input type="hidden" name="page" value="search" />
            <input type="hidden" name="cookieAction" id="cookieAction" value="" />

            <div class="i-box">
              <input type="text" name="sPattern" id="sPattern" class="pattern" placeholder="<?php _e('Keyword', 'stela'); ?>" autocomplete="off"/>
            </div>

            <button type="submit" class="top-search-submit"><i class="fa fa-search"></i></button>
          </form>
        </div>
      <?php } ?>



      <div class="right-block not767">

 
 
        <?php if(osc_is_web_user_logged_in()) { ?>
        
          <a class="logout round3 tr1" href="<?php echo osc_user_logout_url(); ?>"><i class="fa fa-sign-out"></i></a>
        <?php } ?>

        <a class="publish tr1"  style="color:red;!important" href="<?php echo osc_item_post_url(); ?>">
          <span><i class="fa fa-plus"></i><b> <?php _e('Add listing', 'stela'); ?> </b></span>
        </a>

        <div class="account<?php if(osc_is_web_user_logged_in()) { ?> has-border<?php } ?>">
            
            
            
  
          

          <?php if(osc_is_web_user_logged_in()) { ?>
          
          
          <a class="profile tr1" href=" https://zzbeng.ro/im-threads"><i class="fa fa-envelope"></i> <b>Mesaje</b> </a>
     
        
          
            <a class="tr1" href="https://zzbeng.ro/user/dashboard"><i class="fa fa-user-o"></i> <b><?php _e('Contul meu', 'stela'); ?></b> </a>
          <?php } else { ?>
            <a class="tr1" href="https://zzbeng.ro/user/register"><i class="fa fa-user-o"></i> <b><?php _e('Contul meu', 'stela'); ?></b></a>
          <?php } ?>

          <?php if(function_exists('osp_install')) { ?>
            <?php
              $cart_count = 0;
              if(osc_is_web_user_logged_in()) {
                $cart = ModelOSP::newInstance()->getCart(osc_logged_user_id());
                $cart_count = count(array_filter(explode('|', $cart)));
              }
            ?>

            <a class="cart tr1" href="<?php echo osc_route_url('osp-cart'); ?>"><i class="fa fa-credit-card"></i><b> <?php _e('Premium', 'stela'); ?> </b> <span class="counter"><?php echo $cart_count; ?></span></a>
            
              
            
          <?php } ?>
        </div>
      </div>   
    </div>
  </div>


  <?php
    osc_show_widgets('header');
    $breadcrumb = osc_breadcrumb('<span class="bread-arrow">/</span>', false);
    $breadcrumb = str_replace('<span itemprop="title">' . osc_page_title() . '</span>', '', $breadcrumb);
  ?>













  <?php
    if(osc_is_ad_page()) { ?>
      <div id="item-top-bg"></div>    
    <?php }

    // SHOW SEARCH BAR AND CATEGORY LIST ON HOME & SEARCH PAGE
    if(osc_is_home_page()) {
      osc_current_web_theme_path('inc.search.php');
    }

    if(osc_is_search_page()) {
      //osc_current_web_theme_path('inc.category.php');
    }

    // GET CURRENT POSITION
    $position = array(osc_get_osclass_location(), osc_get_osclass_section());
    $position = array_filter($position);
    $position = implode('-', $position);
  ?>
  
  


  
  
</div>




<div class="container-outer <?php echo $position; ?>">




<?php if(!osc_is_home_page()) { ?>
  <div class="container">
<?php } ?>

<?php if ( OSC_DEBUG || OSC_DEBUG_DB ) { ?>
  <div id="debug-mode" class="noselect"><?php _e('You have enabled DEBUG MODE, autocomplete for locations and items will not work! Disable it in your config.php.', 'veronka'); ?></div>
<?php } ?>


<?php if(function_exists('scrolltop')) { scrolltop(); } ?>


<div class="clear"></div>


<?php if(!osc_is_ad_page()) { ?>
  <div class="flash-wrap">
    <?php osc_show_flash_message(); ?>
  </div>
<?php } ?>

<?php View::newInstance()->_erase('countries'); ?>
<?php View::newInstance()->_erase('regions'); ?>
<?php View::newInstance()->_erase('cities'); ?>





