<div class="search-items-wrap">
  <div class="block">
    <div class="wrap">
      <?php osc_get_premiums(bet_param('premium_search_count')); ?>

      <?php if(osc_count_premiums() > 0 && bet_param('premium_search') == 1) { ?>
        <div class="premiums-block <?php echo (osc_count_premiums() % 2 == 1 ? 'odd' : 'even'); ?>">
          <?php 
            // PREMIUM ITEMS
            $c = 1;
  
            echo '<h3>' . __('Top offer', 'beta') . '</h3>';

            while(osc_has_premiums()) {
              bet_draw_item($c, true, 'premium-loop');
              $c++;
            }
          ?>
        </div>
      <?php } ?>

      <?php echo bet_banner('search_top'); ?>


      <?php 
        $c = 1; 
        while( osc_has_items() ) {
          bet_draw_item($c);

          if($c == 3 && osc_count_items() > 3) {
            echo bet_banner('search_middle');
          }

          $c++;
        } 
      ?>

    </div>
  </div>
 
  <?php View::newInstance()->_erase('items') ; ?>
</div>