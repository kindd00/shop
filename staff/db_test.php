<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>ろくまる農園</title>
</head>
<body>
  <?php
  try{
    $dsn='mysql:dbname=shop;host=localhost;charset=utf8';
    $user='root';
    $password='';
    $dbh=new PDO($dsn,$user,$password);
    $dbh=null;

    print 'test';

  }catch(Exception $e){
    print 'ただいま障害により大変ご迷惑をお掛けしております。';
    exit();
  }
  ?>
</body>
</html>
