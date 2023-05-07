<?php
  $locales = __get('locales');
  $user = osc_user();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="<?php echo str_replace('_', '-', osc_current_user_locale()); ?>">
<head>
  <?php osc_current_web_theme_path('head.php') ; ?>
  <meta name="robots" content="noindex, nofollow" />
  <meta name="googlebot" content="noindex, nofollow" />
</head>
<body id="body-user-custom">
  <?php osc_current_web_theme_path('header.php') ; ?>
  <div class="content user_account">
    <div id="sidebar" class="sc-block">
      <?php echo stela_user_menu(); ?>
      <?php   
   $servername = "localhost";
$username = "zzbeng_osclass";
$password = "_15o+CQU;D0N";
$dbname = "zzbeng_osclass";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$uid=osc_user_id();
$sql = "SELECT s_secret FROM oc_t_user WHERE pk_i_id='$uid'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
      
      $secret=$row["s_secret"];
    ?>  
<a class="btn-remove-account btn" style="width:100%;" href="<?php echo osc_base_url(true).'?page=user&action=delete&id='.osc_user_id().'&secret='.$secret; ?>" onclick="return confirm('<?php echo osc_esc_js(__('Esti sigur ca doresti sa stergi contul? ', 'stela')); ?>?')"><span><i class="fa fa-times"></i> <?php _e('Sterge contul', 'stela'); ?></span></a>
 
    </div>

    <div id="main" class="user-custom-maim">
      <div class="inside">
        <?php osc_render_file(); ?>
      </div>
    </div>
  </div>

  <?php osc_current_web_theme_path('footer.php') ; ?>
  
    
    <?php }
} else {
  echo "0 results";
}
$conn->close();

?>
</body>
</html>