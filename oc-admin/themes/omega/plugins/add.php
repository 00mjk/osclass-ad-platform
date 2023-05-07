<?php
if(!defined('ABS_PATH')) exit('ABS_PATH is not loaded. Direct access is not allowed.');
/*
 * Copyright 2014 Osclass
 * Copyright 2021 Osclass by OsclassPoint.com
 *
 * Osclass maintained & developed by OsclassPoint.com
 * You may not use this file except in compliance with the License.
 * You may download copy of Osclass at
 *
 *     https://osclass-classifieds.com/download
 *
 * Do not edit or add to this file if you wish to upgrade Osclass to newer
 * versions in the future. Software is distributed on an "AS IS" basis, without
 * warranties or conditions of any kind, either express or implied. Do not remove
 * this NOTICE section as it contains license information and copyrights.
 */


function addHelp() {
  echo '<p>' . __('Manually upload Osclass plugins in .zip format. If you prefer, you can manually upload the decompressed plugin to <em>oc-content/plugins</em>.') . '</p>';
}

osc_add_hook('help_box','addHelp');


function customPageHeader(){ 
  ?>
  <h1><?php _e('Plugins'); ?>
    <a href="#" class="btn ico ico-32 ico-help float-right"></a>
  </h1>
  <?php
}

osc_add_hook('admin_page_header','customPageHeader');


function customPageTitle($string) {
  return sprintf(__('Add plugin - %s'), $string);
}

osc_add_filter('admin_title', 'customPageTitle');


osc_current_admin_theme_path('parts/header.php'); 
?>

<div class="appearance">
  <h2 class="render-title"><?php _e('Add plugin'); ?></h2>
  <div id="upload-plugins">
    <div class="form-horizontal">
    <?php if( is_writable( osc_plugins_path() ) ) { ?>
      <div class="flashmessage flashmessage-info flashmessage-inline" style="display:block;">
        <p class="info"><?php printf( __('You can download and install new plugins directly in %s section.'), '<a href="' . osc_admin_base_url(true) . '?page=market&action=plugins" target="_blank">' . __('Market > Plugins') . '</a>'); ?></p>
      </div>
      <form class="" action="<?php echo osc_admin_base_url(true); ?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="action" value="add_post" />
        <input type="hidden" name="page" value="plugins" />

        <div class="form-row">
          <div class="form-label"><?php _e('Plugin package (.zip)'); ?></div>
          <div class="form-controls">
            <div class="form-label-checkbox"><input type="file" name="package" id="package" /></div>
          </div>
        </div>
        <div class="form-actions">
          <input type="submit" value="<?php echo osc_esc_html( __('Upload') ); ?>" class="btn btn-submit" />
        </div>
      </form>
    <?php } else { ?>
      <div class="flashmessage flashmessage-error">
        <a class="btn ico btn-mini ico-close" href="#">×</a>
        <p><?php _e('Cannot install new plugin'); ?></p>
      </div>
      <p class="text">
        <?php _e('The plugin folder is not writable on your server so you cannot upload plugins from the administration panel. Please make the folder writable and try again.'); ?>
      </p>
      <p class="text">
        <?php _e('To make the directory writable under UNIX execute this command from the shell:'); ?>
      </p>
      <pre>chmod a+w <?php echo osc_plugins_path(); ?></pre>
    <?php } ?>
    </div>
  </div>

  <div id="market_installer" class="has-form-actions hide">
    <form action="" method="post">
      <input type="hidden" name="market_code" id="market_code" value="" />
      <div class="osc-modal-content-market">
        <img src="" id="market_thumb" class="float-left"/>
        <table class="table" cellpadding="0" cellspacing="0">
          <tbody>
            <tr class="table-first-row">
              <td><?php _e('Name'); ?></td>
              <td><span id="market_name"><?php _e("Loading data"); ?></span></td>
            </tr>
            <tr class="even">
              <td><?php _e('Version'); ?></td>
              <td><span id="market_version"><?php _e("Loading data"); ?></span></td>
            </tr>
            <tr>
              <td><?php _e('Author'); ?></td>
              <td><span id="market_author"><?php _e("Loading data"); ?></span></td>
            </tr>
            <tr class="even">
              <td><?php _e('URL'); ?></td>
              <td><span id="market_url_span"><a id="market_url" href="#"><?php _e("Download manually"); ?></a></span></td>
            </tr>
          </tbody>
        </table>
        <div class="clear"></div>
      </div>
      <div class="form-actions">
        <div class="wrapper">
          <button id="market_cancel" class="btn btn-red" ><?php _e('Cancel'); ?></button>
          <button id="market_install" class="btn btn-submit" ><?php _e('Continue install'); ?></button>
        </div>
      </div>
    </form>
  </div>
</div>
<?php osc_current_admin_theme_path('parts/footer.php'); ?>