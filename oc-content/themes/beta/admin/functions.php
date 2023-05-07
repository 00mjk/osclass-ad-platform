<?php

// ADMIN MENU
function bet_menu($title = NULL) {
  echo '<link href="' . osc_base_url() . 'oc-content/themes/beta/admin/css/admin.css?v=' . date('YmdHis') . '" rel="stylesheet" type="text/css" />';
  echo '<link href="' . osc_base_url() . 'oc-content/themes/beta/admin/css/bootstrap-switch.css" rel="stylesheet" type="text/css" />';
  echo '<link href="' . osc_base_url() . 'oc-content/themes/beta/admin/css/tipped.css" rel="stylesheet" type="text/css" />';
  echo '<link href="//fonts.googleapis.com/css?family=Open+Sans:300,600&amp;subset=latin,latin-ext" rel="stylesheet" type="text/css" />';
  echo '<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />';
  echo '<script src="' . osc_base_url() . 'oc-content/themes/beta/admin/js/admin.js?v=' . date('YmdHis') . '"></script>';
  echo '<script src="' . osc_base_url() . 'oc-content/themes/beta/admin/js/tipped.js"></script>';
  echo '<script src="' . osc_base_url() . 'oc-content/themes/beta/admin/js/bootstrap-switch.js"></script>';


  $current = basename(Params::getParam('file'));

  $links = array();
  $links[] = array('file' => 'configure.php', 'icon' => 'fa-wrench', 'title' => __('Configure', 'beta'));
  $links[] = array('file' => 'banner.php', 'icon' => 'fa-clone', 'title' => __('Advertisement', 'beta'));
  $links[] = array('file' => 'category.php', 'icon' => 'fa-cogs', 'title' => __('Category Icons', 'beta'));
  $links[] = array('file' => 'header.php', 'icon' => 'fa-desktop', 'title' => __('Header Logo', 'beta'));
  $links[] = array('file' => 'plugins.php', 'icon' => 'fa-puzzle-piece', 'title' => __('Plugins', 'beta'));

  if( $title == '') { $title = __('Configure', 'beta'); }

  $text  = '<div class="mb-head">';
  $text .= '<div class="mb-head-left">';
  $text .= '<h1>' . $title . '</h1>';
  $text .= '<h2>Beta Osclass Theme</h2>';
  $text .= '</div>';
  $text .= '<div class="mb-head-right">';
  $text .= '<ul class="mb-menu">';

  foreach($links as $l) {
    $text .= '<li><a href="' . osc_admin_base_url(true) . '?page=appearance&action=render&file=oc-content/themes/beta/admin/' . $l['file'] . '" class="' . ($l['file'] == $current ? 'active' : '') . '"><i class="fa ' . $l['icon'] . '"></i><span>' . $l['title'] . '</span></a></li>';
  }

  $text .= '</ul>';
  $text .= '</div>';
  $text .= '</div>';

  echo $text;
}


// ADMIN FOOTER
function bet_footer() {
  $theme_info = bet_theme_info();
  $text  = '<div class="mb-footer">';
  $text .= '<a target="_blank" class="mb-developer" href="https://osclasspoint.com"><img src="https://osclasspoint.com/favicon.ico" alt="OsclassPoint Market" /> OsclassPoint Market</a>';
  $text .= '<a target="_blank" href="' . $theme_info['support_uri'] . '"><i class="fa fa-bug"></i> ' . __('Report Bug', 'cdn') . '</a>';
  $text .= '<a target="_blank" href="https://forums.osclasspoint.com/"><i class="fa fa-handshake-o"></i> ' . __('Support Forums', 'cdn') . '</a>';
  $text .= '<a target="_blank" class="mb-last" href="mailto:info@osclasspoint.com"><i class="fa fa-envelope"></i> ' . __('Contact Us', 'cdn') . '</a>';
  $text .= '<span class="mb-version">v' . $theme_info['version'] . '</span>';
  $text .= '</div>';

  return $text;
}


if(!function_exists('message_ok')) {
  function message_ok( $text ) {
    $final  = '<div class="flashmessage flashmessage-ok flashmessage-inline">';
    $final .= $text;
    $final .= '</div>';
    echo $final;
  }
}


if(!function_exists('message_error')) {
  function message_error( $text ) {
    $final  = '<div class="flashmessage flashmessage-error flashmessage-inline">';
    $final .= $text;
    $final .= '</div>';
    echo $final;
  }
}


// List of categories
function bet_has_subcategories_special($categories, $deep = 0) {
  $upload_dir_small = osc_themes_path() . osc_current_web_theme() . '/images/small_cat/';
  $upload_dir_large = osc_themes_path() . osc_current_web_theme() . '/images/large_cat/';


  $i = 1;
  foreach($categories as $c) {
    $c_extra = bet_category_extra($c['pk_i_id']);

    echo '<div class="mb-table-row ' . ($deep == 0 ? 'parent' . ' o' . $i : '')  . '">';
    echo '<div class="mb-col-1_2 id">' . $c['pk_i_id'] . '</div>';
    echo '<div class="mb-col-2_1_2 mb-align-left sub' . $deep . ' name">' . $c['s_name'] . '</div>';

    if (file_exists(osc_themes_path() . osc_current_web_theme() . '/images/small_cat/' . $c['pk_i_id'] . '.png')) { 
      echo '<div class="mb-col-1_1_2 icon"><img src="' . osc_base_url() . 'oc-content/themes/' . osc_current_web_theme() . '/images/img_yes.png" alt="Has Image" /></div>';  
    } else {
      echo '<div class="mb-col-1_1_2 icon"><img src="' . osc_base_url() . 'oc-content/themes/' . osc_current_web_theme() . '/images/img_no.png" alt="Has not Image" rel="' . $upload_dir_large . $c['pk_i_id'] . '.png'. '" /></div>';  
    }

    echo '<div class="mb-col-1_1_2"><a class="add_img" id="small' . $c['pk_i_id'] . '" href="#">' . __('Add small image', 'beta') . '</a></div>';

    if (file_exists(osc_themes_path() . osc_current_web_theme() . '/images/large_cat/' . $c['pk_i_id'] . '.jpg')) { 
      echo '<div class="mb-col-1_1_2 icon"><img src="' . osc_base_url() . 'oc-content/themes/' . osc_current_web_theme() . '/images/img_yes.png" alt="Has Image" /></div>';  
    } else {
      echo '<div class="mb-col-1_1_2 icon"><img src="' . osc_base_url() . 'oc-content/themes/' . osc_current_web_theme() . '/images/img_no.png" alt="Has not Image" /></div>';  
    }

    echo '<div class="mb-col-1_1_2"><a class="add_img" id="large' . $c['pk_i_id'] . '" href="#">' . __('Add large image', 'beta') . '</a></div>';
    echo '<div class="mb-col-1_1_2 mb-align-left fa-icon"><a class="add_fa" id="fa-icon' . $c['pk_i_id'] . '" href="#" title="To remove icon click on link and leave input empty.">' . __('Add / remove icon', 'beta') . '</a>';
 
    if( ($c_extra['s_icon'] <> '' && !isset($_POST['fa-icon' . $c['pk_i_id']])) || (isset($_POST['fa-icon' . $c['pk_i_id']]) && $_POST['fa-icon' . $c['pk_i_id']] <> '') ) {
      if(isset($_POST['fa-icon' . $c['pk_i_id']]) && $_POST['fa-icon' . $c['pk_i_id']] <> '') {
        $ico = $_POST['fa-icon' . $c['pk_i_id']];
      } else {
        $ico = $c_extra['s_icon'];
      }

      echo '<span><i class="fa ' . $ico . '"></i></span>';
    }
    
    echo '</div>';

    echo '<div class="mb-col-1_1_2 mb-align-left color"><a class="add_color" id="color' . $c['pk_i_id'] . '" href="#" title="To remove color click on link and leave input empty.">';

    if(isset($_POST['color' . $c['pk_i_id']]) and $_POST['color' . $c['pk_i_id']] == '') { 
      echo  __('Add / remove color', 'beta');
    } else if (!isset($_POST['color' . $c['pk_i_id']]) && $c_extra['s_color'] == '') { 
      echo  __('Add / remove color', 'beta');
    } else {
      if( isset($_POST['color' . $c['pk_i_id']]) && $_POST['color' . $c['pk_i_id']] <> '' ) {
        $color = $_POST['color' . $c['pk_i_id']];
      } else {
        $color = $c_extra['s_color'];
      }

      echo __('Color', 'beta') . ': ' . $color . '<span class="show-color" style="background:' . $color . '"></span>';
    }

    echo '</a></div>';
    echo '</div>';

    if(isset($c['categories']) && is_array($c['categories']) && !empty($c['categories'])) {
      bet_has_subcategories_special($c['categories'], $deep+1);
    }   

    $i++;
  }
}

?>