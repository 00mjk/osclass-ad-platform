<?php
  require_once 'functions.php';


  // Create menu
  $title = __('Category', 'beta');
  bet_menu($title);


  // GET & UPDATE PARAMETERS
  // $variable = bet_param_update( 'param_name', 'form_name', 'input_type', 'plugin_var_name' );
  // input_type: check, value or code

  $cat_icons = bet_param_update('cat_icons', 'theme_action', 'check', 'theme-beta');
 

  // MANAGE IMAGES & ICONS
  if(Params::getParam('theme_action') == 'done') { 
    $upload_dir_small = osc_themes_path() . osc_current_web_theme() . '/images/small_cat/';
    $upload_dir_large = osc_themes_path() . osc_current_web_theme() . '/images/large_cat/';

    if (!file_exists($upload_dir_small)) { mkdir($upload_dir_small, 0777, true); }
    if (!file_exists($upload_dir_large)) { mkdir($upload_dir_large, 0777, true); }

    $count_real = 0;
    $conn = DBConnectionClass::newInstance();
    $data = $conn->getOsclassDb();
    $comm = new DBCommandClass($data);

    for ($i=1; $i<=2000; $i++) {
      if(isset($_POST['fa-icon' . $i])) {
        $fields = array('s_icon' => Params::getParam('fa-icon' . $i));
        $comm->update(DB_TABLE_PREFIX.'t_category_beta', $fields, array('fk_i_category_id' => $i));

        message_ok(__('Font Awesome icon successfully saved for category' . ' <strong>#' . $i . '</strong>', 'beta'));
      }

      if(isset($_POST['color' . $i])) {
        $fields = array('s_color' => Params::getParam('color' . $i));
        $comm->update(DB_TABLE_PREFIX.'t_category_beta', $fields, array('fk_i_category_id' => $i));

        message_ok(__('Color successfully saved for category' . ' <strong>#' . $i . '</strong>', 'beta'));
      }

      if(isset($_FILES['small' . $i]) and $_FILES['small' . $i]['name'] <> ''){

        $file_ext   = strtolower(end(explode('.', $_FILES['small' . $i]['name'])));
        $file_name  = $i . '.' . $file_ext;
        $file_tmp   = $_FILES['small' . $i]['tmp_name'];
        $file_type  = $_FILES['small' . $i]['type'];   
        $extensions = array("png");

        if(in_array($file_ext,$extensions )=== false) {
          $errors = __('extension not allowed, only allowed extension is .png!','beta');
        } 
          
        if(empty($errors)==true){
          move_uploaded_file($file_tmp, $upload_dir_small.$file_name);
          message_ok(__('Small image #','beta') . $i . __(' uploaded successfully.','beta'));
          $count_real++;
        } else {
          message_error(__('There was error when uploading small image #','beta') . $i . ': ' . $errors);
        }
      }
    }

    $count_real = 0;
    for ($i=1; $i<=2000; $i++) {
      if(isset($_FILES['large' . $i]) and $_FILES['large' . $i]['name'] <> ''){
        $file_ext   = strtolower(end(explode('.', $_FILES['large' . $i]['name'])));
        $file_name  = $i . '.' . $file_ext;
        $file_tmp   = $_FILES['large' . $i]['tmp_name'];
        $file_type  = $_FILES['large' . $i]['type'];   
        $extensions = array("jpg");

        if(in_array($file_ext,$extensions )=== false) {
          $errors = __('extension not allowed, only allowed extension for large images is .jpg!','beta');
        }
          
        if(empty($errors)==true){
          move_uploaded_file($file_tmp, $upload_dir_large.$file_name);
          message_ok(__('Large image #','beta') . $i . __(' uploaded successfully.','beta'));
          $count_real++;
        } else {
          message_error(__('There was error when uploading large image #','beta') . $i . ': ' . $errors);
        }
      }
    }
  }



  if(Params::getParam('theme_action') == 'done') {
    message_ok( __('Settings were successfully saved', 'beta') );
  }
?>


<div class="mb-body">

 
  <!-- CATEGORY SECTION -->
  <div class="mb-box">
    <div class="mb-head"><i class="fa fa-cogs"></i> <?php _e('Category', 'beta'); ?></div>

    <div class="mb-inside mb-minify">
      <form action="<?php echo osc_admin_render_theme_url('oc-content/themes/beta/admin/category.php'); ?>" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="theme_action" value="done" />

        <div class="mb-row">
          <label for="cat_icons" class="h1"><span><?php _e('Category Icons Type', 'beta'); ?></span></label> 
          <input name="cat_icons" id="cat_icons" class="element-slide" type="checkbox" <?php echo (bet_param('cat_icons') == 1 ? 'checked' : ''); ?> />

          <div class="mb-explain"><?php _e('Check to ON if you want to use Font-Awesome icons instead of Small images for categories.', 'beta'); ?></div>
        </div>



        <div class="mb-row"><h3 class="sec" style="padding-left:20px;"><?php _e('Setup category icons', 'beta'); ?></h3></div>

        <div class="mb-table">
          <div class="mb-table-head">
            <div class="mb-col-1_2 id"><?php _e('ID', 'beta'); ?></div>
            <div class="mb-col-2_1_2 mb-align-left name"><?php _e('Name', 'beta'); ?></div>
            <div class="mb-col-1_1_2 icon"><?php _e('Has small image', 'beta'); ?></div>
            <div class="mb-col-1_1_2"><?php _e('Small image (50x50px - png)', 'beta'); ?></div>
            <div class="mb-col-1_1_2 icon"><?php _e('Has large image', 'beta'); ?></div>
            <div class="mb-col-1_1_2"><?php _e('Large image (720x90px - jpg)', 'beta'); ?></div>
            <div class="mb-col-1_1_2 mb-align-left fa-icon"><a href="https://fontawesome.com/v4.7.0/icons/" target="_blank"><?php _e('Font-Awesome icon', 'beta'); ?></a></div>
            <div class="mb-col-1_1_2 mb-align-left color"><?php _e('Color', 'beta'); ?></div>
          </div>

          <?php bet_has_subcategories_special(Category::newInstance()->toTree(),  0); ?> 
        </div>


        <div class="mb-row">&nbsp;</div>

        <div class="mb-foot">
          <button type="submit" class="mb-button"><?php _e('Save', 'beta');?></button>
        </div>
      </form>
    </div>
  </div>

</div>


<?php echo bet_footer(); ?>