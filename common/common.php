<?php
function sanitize($before){
  foreach($before as $key=>$value){
    $after[$key]=htmlspecialchars($value,ENT_QUOTES,'UTF-8');
  }
  return $after;
}

function addDataSales($code,$onamae,$email,$postal1,$postal2,$address,$tel){
  try{
    $dsn='mysql:dbname=shop;host=localhost;charset=utf8';
    $user='root';
    $password='';
    $dbh=new PDO($dsn,$user,$password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    $sql='INSERT INTO dat_sales(code_member,name,email,postal1,postal2,address,tel) VALUES(?,?,?,?,?,?,?)';
    $stmt=$dbh->prepare($sql);
    $data=array();
    $data[]=0;
    $data[]=$onamae;
    $data[]=$email;
    $data[]=$postal1;
    $data[]=$postal2;
    $data[]=$address;
    $data[]=$tel;
    $stmt->execute($data);
    $sql='SELECT LAST_INSERT_ID()';
    $stmt=$dbh->prepare($sql);
    $stmt->execute();
    $rec=$stmt->fetch(PDO::FETCH_ASSOC);
    $dbh=null;
    $lastcode=$rec['LAST_INSERT_ID()'];
    return $lastcode;

  }catch(Exception $e){
    throw new Exception("エラー");
  }

}
function addDataMember($pass,$onamae,$email,$postal1,$postal2,$address,$tel,$danjo,$born){
  try{
    $dsn='mysql:dbname=shop;host=localhost;charset=utf8';
    $user='root';
    $password='';
    $dbh=new PDO($dsn,$user,$password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    $sql='INSERT INTO dat_member(password,name,email,postal1,postal2,address,tel,danjo,born) VALUES(?,?,?,?,?,?,?,?,?)';
    $stmt=$dbh->prepare($sql);
    $data=array();
    $data[]=md5($pass);
    $data[]=$onamae;
    $data[]=$email;
    $data[]=$postal1;
    $data[]=$postal2;
    $data[]=$address;
    $data[]=$tel;
    if($danjo=='dan'){
      $data[]=1;
    }else{
      $data[]=2;
    }
    $data[]=$born;
    $stmt->execute($data);
    $sql='SELECT LAST_INSERT_ID()';
    $stmt=$dbh->prepare($sql);
    $stmt->execute();
    $rec=$stmt->fetch(PDO::FETCH_ASSOC);
    $dbh=null;
    $lastmembercode=$rec['LAST_INSERT_ID()'];
    return $lastmembercode;

  }catch(Exception $e){
    throw new Exception("エラー");
  }

}

function addDataSalesProduct($lastcode,$cart,$kazu){
  try{
    $dsn='mysql:dbname=shop;host=localhost;charset=utf8';
    $user='root';
    $password='';
    $dbh=new PDO($dsn,$user,$password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $sql='INSERT INTO dat_sales_product(code_sales,code_product,price,quantity) SELECT ?,?,price,? FROM mst_product WHERE code=?';
    $stmt=$dbh->prepare($sql);
    $data=array();
    $data[]=$lastcode;
    $data[]=$cart;
    $data[]=$cart;
    $data[]=$kazu;
    $stmt->execute($data);

    $dbh=null;
    return 0;
  }catch(Exception $e){
    throw new Exception("エラー");
  }
}


//商品コードをもとに商品情報を取得
function getProInfobyCode($code){
  try{
    $dsn='mysql:dbname=shop;host=localhost;charset=utf8';
    $user='root';
    $password='';
    $dbh=new PDO($dsn,$user,$password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    $sql='SELECT name,price FROM mst_product WHERE code=?';
    $stmt=$dbh->prepare($sql);
    $data[0]=$code;

    $stmt->execute($data);
    $rec=$stmt->fetch(PDO::FETCH_ASSOC);

    return $rec;
  }
catch (Exception $e){
     throw new Exception("エラー");
}
}


function mk_mail($onamae,$cart,$kazu,$max){
  try{
    $honbun='';
    $honbun.=$onamae."様\n\n この度はご注文ありがとうございました。\n";
    $honbun.="\n";
    $honbun.="ご注文商品\n";
    $honbun.="--------------------------\n";

    $goukei=0;
    for($i=0;$i<$max;$i++){
      $code=$cart[$i];
      $rec=getProInfobyCode($code);
      $name=$rec['name'];
      $price=$rec['price'];
      $kakaku[]=$price;

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
     throw new Exception("エラー");
  }
}
 ?>
