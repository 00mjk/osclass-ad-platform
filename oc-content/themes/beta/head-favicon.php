<?php
  if (!defined('ABS_PATH')) {
    define('ABS_PATH', dirname(dirname(dirname(dirname(__FILE__)))) . '/');
  }

  require_once ABS_PATH . 'oc-load.php';
  require_once ABS_PATH . 'oc-content/themes/beta/functions.php';

  $path = osc_base_path() . 'oc-content/themes/beta/images/favicons/';
  $url = osc_base_url() . 'oc-content/themes/beta/images/favicons/';
?>
<?php if(file_exists($path . 'favicon.ico')) { ?>
<link rel="shortcut icon" type="image/x-icon" href="<?php echo $url; ?>favicon.ico" />
<?php } ?>
<?php if(file_exists($path . 'favicon-16x16.png')) { ?>
<link rel="icon" href="<?php echo $url; ?>favicon-16x16.png" sizes="16x16" type="image/png" />
<?php } ?>
<?php if(file_exists($path . 'favicon-32x32.png')) { ?>
<link rel="icon" href="<?php echo $url; ?>favicon-32x32.png" sizes="32x32" type="image/png" />
<?php } ?>
<?php if(file_exists($path . 'apple-touch-icon.png')) { ?>
<link rel="apple-touch-icon" sizes="180x180" href="<?php echo $url; ?>apple-touch-icon.png">
<?php } ?>
<?php if(file_exists($path . 'manifest.json')) { ?>
<link rel="manifest" href="<?php echo $url; ?>manifest.json">
<?php } ?>
<?php if(file_exists($path . 'safari-pinned-tab.svg')) { ?>
<!--<link rel="mask-icon" href="<?php echo $url; ?>safari-pinned-tab.svg" color="#8bc72a">-->
<?php } ?>
<!--<meta name="theme-color" content="#8bc72a">-->