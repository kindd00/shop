<?php
session_start();
$_SESSION=array();
if(isset($_COOKIE[session_name()])){
  setcookie(session_name(),'',time()-42000,'/');
}
session_destroy();;
 ?>
 <!DOCTYPE html>
 <html>
 <head>
 <meta charset="utf-8">
 <title>ろくまる農園</title>
 </head>
 <body>
   ログアウトしました。
 </body>
 </html>
