<?php
/*
 * FileName : logout.php
 * Author   : Onogaki, Kaichi
 * Date     : 2016/12/16
 */

if (isset($_SERVER['HTTP_COOKIE'])) {
 $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
 foreach($cookies as $cookie) {
   $parts = explode('=', $cookie);
   $name = trim($parts[0]);
  //  setcookie($name, '', time()-1000);
   setcookie($name, '', time()-1000, '/');
 }
 echo ("<script type='text/javascript'>window.location.href = '/'</script>");
}
