<?php
if(isset($_POST['upl_files'])){
  echo '<div id="unCenter"><div class="Marged"><div class="Table">
        <div>Uploaded Files:<br></div>';
  //print_r($_FILES['file_n']);
  $up_mas = $_FILES['file_n'];
  $mas_name = array();
  $mas_tmp = array();
  for($i=0; $i<3; $i++){
    if(!empty($up_mas['name'][$i])){
      $j = count($mas_name);
      $mas_name[$j] = $up_mas['name'][$i];
      $mas_tmp[$j] = $up_mas['tmp_name'][$i];
      }
    }
  for($i=0; $i<count($mas_name); $i++){
    $upl_file = './'.$mas_name[$i];
    if(move_uploaded_file($mas_tmp[$i], $upl_file)){
      echo '<a href="'.$mas_name[$i].'">'.$mas_name[$i].'</a>,&nbsp';
      }
    }
  }
?>
            <center>
            <form enctype="multipart/form-data" method="post" action="">
            <?php
          for($i=0; $i<3; $i++){
            echo '<div><input class="Input" type="file" name="file_n[]"></div>';
            } ?>
            <div><input type="reset" name="reset" value="Reset">&nbsp;<input type="submit" name="upl_files" value="upload"></div>
            </center>