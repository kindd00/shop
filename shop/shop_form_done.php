<?php
session_start();
session_regenerate_id(true);
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>ろくまる農園</title>
</head>
<body>
<?php

try{
  require_once('../common/common.php');

  $post=sanitize($_POST);

  $onamae=$post['onamae'];
  $email=$post['email'];
  $postal1=$post['postal1'];
  $postal2=$post['postal2'];
  $address=$post['address'];
  $tel=$post['tel'];

  print $onamae.'様<br>';
  print 'ご注文いただきありがとうございました。';
  print $email.'にメールを送信いたしましたのでご確認ください。<br>';
  print '商品は以下の住所に発送させていただきます。<br>';
  print $postal1.'-'.$postal2.'<br>';
  print $address.'<br>';
  print $tel.'<br>';

  $cart=$_SESSION['cart'];
  $kazu=$_SESSION['kazu'];
  $max=count($cart);

  $honbun=mk_mail($onamae,$cart,$kazu,$max);
  print '<br>';
  print nl2br($honbun);

}catch (Exception $e){
    print 'ただいま障害により大変ご迷惑をお掛けしております。';
    exit();
}
?>
</body>
</html>
