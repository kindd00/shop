<?php

function sanitize($before){
  foreach($before as $key=>$value){
    $after[$key]=htmlspecialchars($value,ENT_QUOTES,'UTF-8');
  }
  return $after;
}

function mk_mail($onamae,$cart,$kazu,$max){
  try{
    $honbun='';
    $honbun.=$onamae."様\n\n この度はご注文ありがとうございました。\n";
    $honbun.="\n";
    $honbun.="ご注文商品\n";
    $honbun.="--------------------------\n";

    $dsn='mysql:dbname=shop;host=localhost;charset=utf8';
    $user='root';
    $password='';
    $dbh=new PDO($dsn,$user,$password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    $goukei=0;
    for($i=0;$i<$max;$i++){
      $sql='SELECT name,price FROM mst_product WHERE code=?';
      $stmt=$dbh->prepare($sql);
      $data[0]=$cart[$i];

      $stmt->execute($data);
      $rec=$stmt->fetch(PDO::FETCH_ASSOC);

      $name=$rec['name'];
      $price=$rec['price'];
      $suryo=$kazu[$i];
      $shokei=$price*$suryo;
      $goukei+=$shokei;


      $honbun.=$name.' ';
      $honbun.=$price.'円　X ';
      $honbun.=$suryo.'個　= ';
      $honbun.=$shokei."円 \n";
    }
    $dbh=null;
    $honbun.="合計 ";
    $honbun.=$goukei."円 \n";
    $honbun.="送料は無料です。\n";
    $honbun.="\n";
    $honbun.="代金は以下にお振込みください。\n";
    $honbun.="〇〇銀行　△△支店　普通口座　1234567\n";
    $honbun.="入金確認が取れ次第、発送させていただきます。\n";

    return $honbun;

  }
  catch (Exception $e){
     $honbun='err';
     return $honbun;
  }
}
 ?>
