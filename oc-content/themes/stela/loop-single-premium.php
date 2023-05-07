<?php 
  $item_extra = stela_item_extra( osc_premium_id() ); 

  $root = stela_category_root( osc_premium_category_id() ); 
  $cat_icon = stela_get_cat_icon( $root['pk_i_id'], true );
  if( $cat_icon <> '' ) {
    $icon = $cat_icon;
  } else {
    $def_icons = array(1 => 'fa-gavel', 2 => 'fa-car', 3 => 'fa-book', 4 => 'fa-home', 5 => 'fa-wrench', 6 => 'fa-music', 7 => 'fa-heart', 8 => 'fa-briefcase', 999 => 'fa-soccer-ball-o');
    $icon = $def_icons[$root['pk_i_id']];
  }

  $location = array_filter(array(osc_premium_city() <> '' ? osc_premium_city() : osc_premium_region()));
  $location = implode(', ', $location);
?>


<div class="simple-prod o<?php echo $c; ?> is-premium<?php if($class <> '') { echo ' ' . $class; } ?> <?php osc_run_hook("highlight_class"); ?>">
  <div class="simple-wrap">
    <div class="item-img-wrap">

      <div class="labels">
        <?php if($item_extra['i_sold'] == 1) { ?>
          <a class="sold-label label" href="<?php echo osc_premium_url(); ?>">
            <span><?php _e('sold', 'stela'); ?></span>
          </a>
        <?php } else if($item_extra['i_sold'] == 2) { ?>
          <a class="reserved-label label" href="<?php echo osc_premium_url(); ?>">
            <span><?php _e('reserved', 'stela'); ?></span>
          </a>
        <?php } ?>

        <a class="premium-label label" href="<?php echo osc_premium_url(); ?>">
          <span><?php _e('Anunt promovat', 'stela'); ?></span>
        </a>
      </div>


      <?php if(osc_count_premium_resources()) { ?>
        <a class="img-link" href="<?php echo osc_premium_url(); ?>"><img src="<?php echo osc_resource_preview_url(); ?>" alt="<?php echo osc_esc_html(osc_premium_title()); ?>" /></a>
      <?php } else { ?>
      <?php if(osc_category_id()==131 || osc_category_id()==132 || osc_category_id()==133 || osc_category_id()==237 || osc_category_id()==246 || osc_category_id()==142 || osc_category_id()==245 || osc_category_id()==149 || osc_category_id()==134 || osc_category_id()==135 || osc_category_id()==236 || osc_category_id()==137 || osc_category_id()==136 || osc_category_id()==138 || osc_category_id()==144 || osc_category_id()==139 || osc_category_id()==140 || osc_category_id()==141 || osc_category_id()==145 || osc_category_id()==143 || osc_category_id()==146 || osc_category_id()==147 || osc_category_id()==148 || osc_category_id()==230 || osc_category_id()==150){ ?>
      
      <a class="img-link no-img" href="<?php echo osc_premium_url(); ?>"><img src="<?php echo osc_current_web_theme_url('images/1.png'); ?>" alt="<?php echo osc_esc_html(osc_premium_title()); ?>" /></a>
      <?php }else { ?>
        <a class="img-link no-img" href="<?php echo osc_premium_url(); ?>"><img src="<?php echo osc_current_web_theme_url('images/1.png'); ?>" alt="<?php echo osc_esc_html(osc_premium_title()); ?>" /></a>
      <?php } } ?>

      <div class="img-bottom">
          <?php echo fi_make_favorite(); ?>
        
        
        <?php if( osc_price_enabled_at_items() ) { ?>
        <div class="price"><span><?php echo stela_premium_format_price(osc_premium_price()); ?></span></div>
      <?php } ?>
      </div>
    </div>
          
    
    <a class="title" href="<?php echo osc_premium_url(); ?>"><?php echo osc_highlight(osc_premium_title(), 18); ?></a>

    <div class="middle">
      <?php if(osc_item_total_comments() > 0) { ?>
        <?php if(osc_premium_total_comments() == 1) { ?>
          <div class="comment"><?php echo sprintf(__('%d review', 'stela'), osc_item_total_comments()); ?></div>
        <?php } else { ?>
          <div class="comment"><?php echo sprintf(__('%d reviews', 'stela'), osc_item_total_comments()); ?></div>
        <?php } ?>
      <?php } ?>

      <div class="category"><a href="<?php echo osc_search_url(array('sCategory' => osc_premium_category_id())); ?>"><i class="fa <?php echo $icon; ?>"></i><span><?php echo osc_premium_category(); ?></span></a></div>

      <?php if(!in_array(osc_item_category_id(), stela_extra_fields_hide())) { ?>
        <?php if(stela_condition_name($item_extra['i_condition'])) { ?>
          <div class="condition" style="display:none;"><span><?php echo stela_condition_name($item_extra['i_condition']); ?></span></div>
        <?php } ?>

        <?php if(stela_transaction_name($item_extra['i_transaction'])) { ?>
          <div class="transaction" style="display:none;"><span><?php echo stela_transaction_name($item_extra['i_transaction']); ?></span></div>
        <?php } ?>
      <?php } ?>
    </div>

    <div class="description<?php if(osc_premium_user_id() > 0) { ?> registered<?php } ?>">
      <?php if(osc_premium_user_id() > 0) { ?>
        <div class="img">
          <a href="<?php echo osc_user_public_profile_url(osc_premium_user_id()); ?>">
            <?php echo stela_profile_picture(); ?>
          </a>
        </div>
      <?php } ?>

      <div class="text"><?php echo osc_highlight(strip_tags(osc_premium_description()), 27); ?></div>
    </div>


    <div class="bottom">
      <?php if($location <> '') { ?>
        <div class="location"><b><i class="fa fa-map-marker"></i><?php echo $location; ?></b></div>
      <?php } ?>

      
        <div class="price2"> 

<?php echo stela_smart_date(osc_premium_pub_date()); ?>
          </div>
     
    </div>
  </div>
</div>