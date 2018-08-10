<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>ABC商店</title>
</head>
<body>
<?php
try{
  require_once('../common/common.php');
  $code=0;
  $rec=addDataSales(0,"1","1","1","1","1","1");
}catch (Exception $e){
    print '(ただいま障害により大変ご迷惑をお掛けしております。)';
    exit();
}


   ?>
</body>
</html>
