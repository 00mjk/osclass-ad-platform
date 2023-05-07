<style>
   
   div.scrollmenu {
  background-color: #fff;
  overflow: auto;
  white-space: nowrap;
}

div.scrollmenu a {
  display: inline-block;
  color: #000;
  text-align: center;
  padding: 14px;
  text-decoration: none;
  vertical-align: top;
  min-height:125px;
}

div.scrollmenu a:hover {
  background-color: #e1e1e1;
} 

::-webkit-scrollbar {
  width: 10px !important;
  height:2px;
}

/* Track */
::-webkit-scrollbar-track {
  background: #fff; 
}
 
/* Handle */
::-webkit-scrollbar-thumb {
  background: #009273; 
}

</style>
<?php $search_params = stela_search_params(); ?>
<?php $search_params['sPriceMin'] = ''; ?>
<?php $search_params['sPriceMax'] = ''; ?>

<?php
  // CURRENT CATEGORY
  $search_cat_id = osc_search_category_id();
  $search_cat_id = isset($search_cat_id[0]) ? $search_cat_id[0] : 0;
  $search_cat_full = Category::newInstance()->findByPrimaryKey($search_cat_id);

  // ROOT CATEGORY
  $root_cat_id = Category::newInstance()->findRootCategory($search_cat_id);
  $root_cat_id = $root_cat_id['pk_i_id'];
   
  // HIERARCHY OF SEARCH CATEGORY
  $hierarchy = Category::newInstance()->toRootTree($search_cat_id);

  // SUBCATEGORIES OF SEARCH CATEGORY
  $subcats = Category::newInstance()->findSubcategoriesEnabled($search_cat_id);

  if(empty($subcats)) {
    $is_subcat = false;
    $subcats = Category::newInstance()->findSubcategoriesEnabled($search_cat_full['fk_i_parent_id']);
  } else {
    $is_subcat = true;
  }
?>

  

<div class="center" id="content">
    
    
    <div class="scrollmenu">
  
      <a href="https://zzbeng.ro/search" > <i style="font-size:55px;color:#009273;" class="fa fa-list"></i>
           <div class="cat-box-new-text"> Toate<br/>Anunturile </div></a>
  
     <a href="https://zzbeng.ro/auto-moto" > <i style="font-size:55px;color:#009273;" class="fa fa-car"></i>
           <div class="cat-box-new-text"> Auto / Moto</div></a>
           
     <a href="https://zzbeng.ro/electronice-electrocasnice"> <i style="font-size:55px;color:#009273;" class="fa fa-tv"></i>
           <div class="cat-box-new-text"> Electronice /<br/>Electrocasnice </div></a>
           
     <a href="https://zzbeng.ro/imobiliare"> <i style="font-size:55px;color:#009273;" class="fa fa-home"></i>
           <div class="cat-box-new-text"> Imobiliare </div></a>
           
     
     <a href="https://zzbeng.ro/locuri-de-munca"> <i style="font-size:55px;color:#009273;" class="fa fa-briefcase"></i>
           <div class="cat-box-new-text"> Locuri de Munca </div></a>
           
     
     <a href="https://zzbeng.ro/moda-frumusete"> <i style="font-size:55px;color:#009273;" class="fa fa-star"></i>
           <div class="cat-box-new-text"> Moda /<br/>Frumusete </div></a>      
     
     <a href="https://zzbeng.ro/casa-si-gradina"> <i style="font-size:55px;color:#009273;" class="fa fa-bed"></i>
           <div class="cat-box-new-text"> Casa si gradina </div></a>
           
     <a href="https://zzbeng.ro/mama-si-copilul"> <i style="font-size:55px;color:#009273;" class="fa fa-child"></i>
           <div class="cat-box-new-text"> Mama si Copilul </div></a>
           
     <a href="https://zzbeng.ro/lumea-animalelor"> <i style="font-size:55px;color:#009273;" class="fa fa-paw"></i>
           <div class="cat-box-new-text"> Lumea<br/>Animalelor </div></a>
           
      <a href="https://zzbeng.ro/sport-timp-liber"> <i style="font-size:55px;color:#009273;" class="fa fa-bicycle"></i>
           <div class="cat-box-new-text"> Sport /<br/>Timp liber </div></a>
           
      <a href="https://zzbeng.ro/agro-industrie"> <i style="font-size:55px;color:#009273;" class="fa fa-adn"></i>
           <div class="cat-box-new-text"> Agro si Industrie </div></a>
           
     <a href="https://zzbeng.ro/servicii-afaceri"> <i style="font-size:55px;color:#009273;" class="fa fa-users"></i>
           <div class="cat-box-new-text"> Servicii /<br/>Afaceri </div></a>
           
     
     <a href="https://zzbeng.ro/pierdut-gasit"> <i style="font-size:55px;color:#009273;" class="fa fa-eye"></i>
           <div class="cat-box-new-text"> Pierdut / Gasit </div></a> 
           
     <a href="https://zzbeng.ro/licitatii-somatii"> <i style="font-size:55px;color:#009273;" class="fa fa-envelope"></i>
           <div class="cat-box-new-text"> Licitatii /<br/>Somatii </div></a>
           
 <a href="https://zzbeng.ro/anunturi-matrimoniale"> <i style="font-size:55px;color:#009273;" class="fa fa-heart"></i>
           <div class="cat-box-new-text"> Anunturi<br/>Matrimoniale </div></a>
     
 <a href="https://www.facebook.com/groups/zzbeng.ro"> <i style="font-size:55px;color:#009273;" class="fa fa-facebook-f"></i>
 <div class="cat-box-new-text">Anunturi<br/> Facebook </div></a>
     
</div>

    
    
      
      
    </div>
    


<div id="category-navigation">





  <?php if(osc_is_search_page()) { ?>
    <div class="top-cat-head sc-click non-resp is767">
      <i class="fa fa-ellipsis-h"></i> 
      <span>
        <?php if(osc_is_search_page() && $search_cat_id <> 0 && $search_cat_id <> '') { ?>
          <?php _e('Subcategories', 'stela'); ?>
        <?php } else { ?>
          <?php _e('Categories', 'stela'); ?>
        <?php } ?>
      </span>
    </div>
  <?php } ?>

  <div class="top-cat-wrap sc-block<?php if(osc_get_preference('search_box_home', 'stela_theme') <> '1') { ?> border-top<?php } ?>">

    <?php if((osc_is_search_page() && ($search_cat_id <= 0 || $search_cat_id == '')) || !osc_is_search_page()) { ?>
      <div id="top-cat">
        <div class="cat-inside">
          <div class="top-cat-ul-wrap">
            <div class="ul-box">
              <ul <?php if(osc_is_search_page()) { ?>class="ul-search"<?php } ?>>
                <?php while ( osc_has_categories() ) { ?>
                  <?php $search_params['sCategory'] = osc_category_id(); ?>
                  <?php 
                    if($root_cat_id <> '' and $root_cat_id <> 0) {
                      if($root_cat_id <> osc_category_id()) { 
                        $cat_class = 'cat-gray';
                      } else {
                        $cat_class = 'cat-highlight';
                      }
                    } else {
                      $cat_class = '';
                    }

                    $color = stela_get_cat_color(osc_category_id(), (osc_is_home_page() ? 'home' : ''));
                  ?>

                  <li <?php if($cat_class <> '') { echo 'class="' . $cat_class . '"'; } ?>>

                    <?php ob_start(); // SAVE HTML OF ACTIVE CATEGORY ?>

                    <a id="cat-link" href="<?php echo osc_search_url(array('page' => 'search', 'sCategory' => osc_category_id())); ?>">
                      <div class="img<?php if($color == '') { ?> no-color<?php } ?> tr3" <?php if($color <> '') { ?>style="background:<?php echo $color; ?>;"<?php } ?>>
                        <span class="tr3"></span>

                        <?php if(osc_get_preference('cat_icons', 'stela_theme') == 1) { ?>
                          <i class="fa <?php echo stela_get_cat_icon( osc_category_id(), true ); ?>"></i>
                        <?php } else { ?>
                          <img src="<?php echo osc_current_web_theme_url();?>images/small_cat/<?php echo osc_category_id();?>.png" />
                        <?php } ?>

                        <div class="name"><?php echo osc_category_name(); ?></div>
                      </div>
                    </a>

                    <?php $contents = ob_get_contents(); // GET HTML OF ACTIVE CATEGORY ?>
                  </li>

                  <?php if($cat_class == 'cat-highlight') { ?>
                    <?php $h_contents = $contents; ?>
                  <?php } ?>
                <?php } ?>

                <?php if(isset($h_contents) && $h_contents <> '') { ?>
                  <li class="cat-highlight resp is767">
                    <?php echo $h_contents; ?>
                    
                 
                    
                  </li>
                <?php } ?>

              </ul>
            </div>
          </div>
        </div>
      </div>
    <?php } ?>

<?php if(1==2) { ?>
    <div 
      id="top-subcat"
      <?php if(!osc_is_home_page() && (!osc_is_search_page() || $search_cat_id == 0 || $search_cat_id == '')) { ?>style="display:none;"<?php } ?>
      <?php if(osc_is_search_page() && $search_cat_id <> 0 && $search_cat_id <> '') { ?>class="has-sub"<?php } ?>
    >
      <div class="subcat-inside">

        <?php if(osc_is_home_page()){ ?>
          <!-- HOME PAGE SUBCATEGORIES LIST -->

          <div>
            <?php osc_goto_first_category(); ?>
            <?php $search_params = stela_search_params(); ?>
            <?php $search_params['sPriceMin'] = ''; ?>
            <?php $search_params['sPriceMax'] = ''; ?>

            <div id="home-cat" class="home-cat">
              <?php osc_goto_first_category(); ?>
              <?php while( osc_has_categories() ) { ?>
                <?php $search_params['sCategory'] = osc_category_id(); ?>

                <div id="ct<?php echo osc_category_id(); ?>" class="cat-tab">
                  <?php $cat_id = osc_category_id(); ?>

                  <div class="head">
                    <a href="<?php echo osc_search_url($search_params); ?>"><h2><?php echo osc_category_name(); ?></h2></a>

                    <span>
                      <?php if(osc_category_total_items() == '' or osc_category_total_items() == 0) { ?>
                         <?php _e('there are no listings yet', 'stela'); ?>
                      <?php } else { ?>
                        <?php _e('browse in', 'stela'); ?> <?php echo osc_category_total_items(); ?> <?php _e('listings', 'stela'); ?>
                      <?php } ?>
                    </span>

                    <div class="add"><a href="<?php echo osc_item_post_url_in_category(); ?>"><?php _e('Add listings', 'stela'); ?></a></div>
                  </div>

                  <div class="middle">
                    <?php while(osc_has_subcategories()) { ?>
                      <?php $search_params['sCategory'] = osc_category_id(); ?>
               
                      <a href="<?php echo osc_search_url($search_params); ?>">
                        <span>
                          <span class="icon"><?php echo stela_get_cat_icon( osc_category_id()); ?></span>
                          <span class="name"><?php echo osc_category_name(); ?></span>
                        </span>
                      </a>
                    <?php } ?>
                  </div>
                </div>
              <?php } ?>
            </div>
          </div>
        <?php } ?>


        <?php if(osc_is_search_page() && $search_cat_id <> 0 && $search_cat_id <> '') { ?>
          <! -- SEARCH PAGE SUBCATEGORIES LIST -->

          <div>
            <?php osc_goto_first_category(); ?>
            <?php $search_params = stela_search_params(); ?>
            <?php $search_params['sPriceMin'] = ''; ?>
            <?php $search_params['sPriceMax'] = ''; ?>

            <div class="cat-navigation">
              <?php
                unset($search_params['sCategory']);
                echo '<a id="cat-link" href="' . osc_search_url($search_params) . '">' . __('All categories', 'stela') . '</a>';

                foreach($hierarchy as $h) {
                  $search_params['sCategory'] = $h['pk_i_id'];
                  echo '<a id="cat-link" href="' . osc_search_url($search_params) . '">' . $h['s_name'] . '</a>';
                }
              ?>
            </div>


            <div id="search-cat" class="search-cat">
              <div class="cat-tab">
                <?php $cat_id = osc_category_id(); ?>

                <?php if(!empty($subcats)) { ?>
                  <?php foreach($subcats as $s) { ?>
                    <?php $search_params['sCategory'] = $s['pk_i_id']; ?>

                    <div class="link-wrap">
                      <a href="<?php echo osc_search_url($search_params); ?>" id="cat-link" <?php echo ($s['pk_i_id'] == $search_cat_id ? 'class="bold"' : ''); ?>">
                        <span>
                          <span class="icon"><?php echo stela_get_cat_icon($s['pk_i_id']); ?></span>
                          <span class="name"><?php echo $s['s_name']; ?> <strong><?php echo $s['i_num_items']; ?></strong></span>
                        </span>
                      </a>
                    </div>
                  <?php } ?>
                <?php } ?>
              </div>
            </div>
          </div>
        <?php } ?>

      </div>
    </div>

<?php } ?>

  </div>
</div>



<script>
$('.horizon-prev').click(function() {
  event.preventDefault();
  $('#content').animate({
    scrollLeft: "-=150px"
  }, "slow");
});

 $('.horizon-next').click(function() {
  event.preventDefault();
  $('#content').animate({
   scrollLeft: "+=150px"
  }, "slow");
});
</script>
