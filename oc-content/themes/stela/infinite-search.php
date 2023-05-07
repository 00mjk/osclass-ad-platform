<?php
  $content_block = '#main';
  $listings_parent_block = '#search-items .block > .wrap';
  $pagination_block = '.paginate';
  $pagination_next = 'a.searchPaginationNext';
  $loaded_listings_count = '';
//   $report_errors = htmlspecialchars_decode(inf_param('report_errors'));
?>

<style>
  <?php echo $pagination_block; ?> {display:none!important;}
  .inf-loader {display:none;width:100%;padding:25px 5px;margin:20px 0;background:#eee;border-radius:6px;color:#777;font-size:16px;text-align:center;line-height:20px;}
  .inf-loader > div {display:inline-block;width:auto;position:relative;padding-left:44px;}
  .inf-loader img {position:absolute;display:inline-block;top:-6px;left:0;width:32px;height:32px;max-height:32px;max-width:32px;}
  .inf-loader span {display:inline-block;font-weight:bold;line-height:20px;font-size:14px;}
  <?php echo $content_block; ?>.loading .inf-loader {display:inline-block;}
</style>

<script async type="text/javascript">
var infScollTimeout = '';
var currentPag = 1;
var isLoading = false;
var pagUrl = '';
var newUrl = '';
var oldUrl = '';
var loadingBlock = '<div class="inf-loader"><span><?php echo osc_esc_js(__('Asteapta...', 'infinite')); ?></span></div>';


$(document).ready(function() {
  // ADD LOADING BLOCK ABOVE PAGINATION
  $(window).scroll(function(e) {
    infScoll(e);
  });
});


function infScoll(e) {
  (typeof(infScollTimeout) !== undefined) ? clearTimeout(infScollTimeout) : '';  

  infScollTimeout = setTimeout(function() {
    var scroll = $(window).scrollTop();
    var threshold = $('<?php echo $content_block; ?>').position().top + $('<?php echo $content_block; ?>').innerHeight() - 100;
    var position = $(window).scrollTop() + $(window).innerHeight();

    if($('<?php echo $pagination_next; ?>').length) {
      pagUrl = $('<?php echo $pagination_next; ?>').attr('href');
    } else {
      pagUrl = '';  
    }

    //console.log(oldUrl + '--->' + pagUrl );

    // loading block add above pagination now
    if(!$('<?php echo $content_block; ?>').find('.inf-loader').length) {
      $(loadingBlock).insertBefore($('<?php echo $pagination_block; ?>'));
    }

    if(!$('<?php echo $content_block; ?>').length || !$('<?php echo $listings_parent_block; ?>').length || !$('<?php echo $pagination_block; ?>').length || !$('<?php echo $pagination_next; ?>').length) {
      infCheckBlocks();
     
    } else if(position > threshold && isLoading == false && pagUrl != oldUrl && pagUrl != '' && pagUrl != '#') {

      isLoading = true;
      $('<?php echo $content_block; ?>').addClass('loading');

      $.ajax({
        url: pagUrl,
        type: "GET",
        success: function(response){
          var length = response.length;
          var data = $(response).contents().find('<?php echo $listings_parent_block ; ?>').last().html();
          var pagBlock = $(response).contents().find('<?php echo $pagination_block; ?>');
          var currItemCount = $(response).contents().find('<?php echo $loaded_listings_count; ?>').text();

          oldUrl = pagUrl;

          $('<?php echo $pagination_block; ?>').html(pagBlock);
          $('<?php echo $listings_parent_block; ?>').last().append(data);
          $.getScript('//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js', function() {
        (adsbygoogle = window.adsbygoogle || []).push({});
 });
          if($('<?php echo $loaded_listings_count; ?>').length) {
            $('<?php echo $loaded_listings_count; ?>').text(currItemCount);
          }

          // lazy load if exists
          if(typeof $.fn.Lazy !== 'undefined') { 
            $('<?php echo $listings_parent_block; ?>').last().find('img.lazy').Lazy({
              appendScroll: window,
              scrollDirection: 'both',
              effect: 'fadeIn',
              effectTime: 300,
              afterLoad: function(element) {
                setTimeout(function() {
                  element.css('transition', '0.2s');
                }, 300);
              }
            });
          }

          isLoading = false;
          currentPag = currentPag + 1;
          $('<?php echo $content_block; ?>').removeClass('loading');
          
          $(window).scrollTop(scroll);
        }, 
        
        error: function(response){
          hasPag = false;
          $('<?php echo $content_block; ?>').removeClass('loading');

          response = response.responseText;

          console.log(response);
          console.log(data);
        }
      });
    }
  }, 500);
}
  
  
</script>