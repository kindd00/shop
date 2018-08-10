<?php
session_start();
session_regenerate_id(true);
?>
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

  $post=sanitize($_POST);

  $onamae=$post['onamae'];
  $email=$post['email'];
  $postal1=$post['postal1'];
  $postal2=$post['postal2'];
  $address=$post['address'];
  $tel=$post['tel'];
  $chumon=$post['chumon'];
  $pass=$post['pass'];
  $danjo=$post['danjo'];
  $birth=$post['birth'];

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

  $lastmembercode=0;
  if($chumon=='chumontouroku'){
    $lastmembercode=addDataMember($pass,$onamae,$email,$postal1,$postal2,$address,$tel,$danjo,$birth);
  }

  //注文情報を注文テーブルに追加
  $lastcode=addDataSales($lastmembercode,$onamae,$email,$postal1,$postal2,$address,$tel,$max);

  for($i=0;$i<$max;$i++){
    $cart_i=$cart[$i];
    $kazu_i=$cart[$i];
    $r2=addDataSalesProduct($lastcode,$cart_i,$kazu_i);

  }


}catch (Exception $e){
    print '(ただいま障害により大変ご迷惑をお掛けしております。)';
    exit();
}
if($chumon=='chumontouroku'){
  print '会員登録が完了しました。<br>';
  print '次回からメールアドレスとパスワードでログインしてください。<br>';
  print 'ご注文が簡単にできるようになります。<br>';
  print '<br>';
}
?>
<br>
<a href="shop_list.php">商品画面へ</a>
</body>
</html>
