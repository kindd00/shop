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
 <title>ABC商店</title>
 </head>
 <body>
   カートを空にしました。<br>

 </body>
 </html>
