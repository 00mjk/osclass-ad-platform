<?php
  $color = '.mbCl,footer .cl .lnk:hover,header .right a:hover, header .right a.publish:hover, body a, body a:hover';
  $background = '.mbBg,.paginate ul li span,#listing .data .connect-after a:hover,.paginate ul li a:hover,.blg-btn.blg-btn-primary,.bpr-prof .bpr-btn, #fi_user_new_list button, .post-edit .price-wrap .selection a.active,.tabbernav li.tabberactive a';
  $background_after = '.mbBgAf:after';
  $background_active = '.mbBgActive.active';
  $background_color = 'body .fancybox-close';
  $border_color = '.mbBr,header .right a.publish:hover';
  $border_background = '.input-box-check input[type="checkbox"]:checked + label:before,#atr-search .atr-input-box input[type="checkbox"]:checked + label:before, #atr-search .atr-input-box input[type="radio"]:checked + label:before,#atr-form .atr-input-box input[type="checkbox"]:checked + label:before, #atr-form .atr-input-box input[type="radio"]:checked + label:before,.bpr-box-check input[type="checkbox"]:checked + label:before, #gdpr-check.styled .input-box-check input[type="checkbox"]:checked + label:before, .pol-input-box input[type="checkbox"]:checked + label:before, .pol-values:not(.pol-nm-star) .pol-input-box input[type="radio"]:checked + label:before';
  $border_bottom = '#search-sort .user-type a.active, #search-sort .user-type a:hover';
?>

<style>
  <?php echo $color; ?> {color:<?php echo bet_param('color'); ?>;}
  <?php echo $background; ?> {background:<?php echo bet_param('color'); ?>!important;color:#fff!important;}
  <?php echo $background_after; ?> {background:<?php echo bet_param('color'); ?>!important;}
  <?php echo $background_active; ?> {background:<?php echo bet_param('color'); ?>!important;}
  <?php echo $background_color; ?> {background-color:<?php echo bet_param('color'); ?>!important;}
  <?php echo $border_color; ?> {border-color:<?php echo bet_param('color'); ?>!important;}
  <?php echo $border_background; ?> {border-color:<?php echo bet_param('color'); ?>!important;background-color:<?php echo bet_param('color'); ?>!important;}
  <?php echo $border_bottom; ?> {border-bottom-color:<?php echo bet_param('color'); ?>!important;}
</style>

<script>
  var mbCl = '<?php echo $color; ?>';
  var mbBg = '<?php echo $background; ?>';
  var mbBgAf= '<?php echo $background_after; ?>';
  var mbBgAc= '<?php echo $background_active; ?>';
  var mbBr= '<?php echo $border_color; ?>';
  var mbBrBg= '<?php echo $border_background; ?>';
  var mbBrBt= '<?php echo $border_bottom; ?>';
</script>
