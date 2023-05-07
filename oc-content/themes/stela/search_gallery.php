<?php
  GLOBAL $search_items;
  $search_items = View::newInstance()->_get('items');
?>

<div class="search-items-wrap">
  <div class="block">
  <?php  if ( osc_category_id() !=203 ) { ?>
    <div class="wrap">
    
    
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
<?php  } ?>
      <?php 
        // PREMIUM ITEMS
        osc_get_premiums(osc_get_preference('premium_search_gallery_count', 'stela_theme'));
        $c = 1;

        if(osc_count_premiums() > 0 && osc_get_preference('premium_search_gallery', 'stela_theme') == 1) {
          while(osc_has_premiums()) {
            stela_draw_item($c, 'gallery', true, 'premium-loop');
            $c++;
          }
        }
      ?>
      
      </div>
      </div>
      </div>
<div class="search-items-wrap">
  <div class="block">
    <div class="wrap">

      <?php $c = 1; ?>
      <?php while( osc_has_items() ) { ?>
        <?php stela_draw_item($c, 'gallery'); ?>
         <?php if($c % 20 == 0) {  if ( osc_category_id() !=203 ) { ?>
                 <div class="banner-theme banner-item_description" style="margin-bottom:20px;">
                     
                     
                     <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6670632475662042"
     crossorigin="anonymous"></script>
<ins class="adsbygoogle"
     style="display:block; text-align:center;"
     data-ad-layout="in-article"
     data-ad-format="fluid"
     data-ad-client="ca-pub-6670632475662042"
     data-ad-slot="6600763873"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>

                 </div>
               
		<?php } }?>
        <?php $c++; ?>
      <?php }  ?>

    </div>
  </div>
 
  <?php View::newInstance()->_erase('items') ; ?>
</div>