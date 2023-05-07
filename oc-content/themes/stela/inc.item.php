<?php if( osc_images_enabled_at_items() ) { ?> 
  <?php osc_get_item_resources(); ?>

  <?php if( osc_count_item_resources() > 0 ) { ?>  

    <div id="top-gallery">
      <ul class="item-bxslider">
        <?php osc_reset_resources(); ?>
        <?php for( $i = 0; osc_has_item_resources(); $i++ ) { ?>
          <li>
            <?php if($content_only == 0) { ?>
              <a rel="image_group" href="<?php echo osc_resource_url(); ?>">
                <img src="<?php echo osc_resource_url(); ?>" alt="<?php echo osc_esc_html(osc_item_title()); ?> - <?php echo $i+1;?>/<?php echo osc_count_item_resources();?>"/>
              </a>
            <?php } else { ?>
              <img src="<?php echo osc_resource_url(); ?>" alt="<?php echo osc_esc_html(osc_item_title()); ?> - <?php echo $i+1;?>/<?php echo osc_count_item_resources();?>"/>
            <?php } ?>
          </li>
        <?php } ?>
      </ul>
    </div>
  <?php } ?>
<?php } ?>