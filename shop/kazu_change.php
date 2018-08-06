<?php
session_start();
session_regenerate_id(true);

require_once('../common/common.php');

$post=sanitize($_POST);
$max=$_POST['max'];
for($i=0;$i<$max;$i++){
  if(!preg_match("/\A[0-9]+\z/",$post['kazu'.$i])){
    print '数量に誤りがあります。';
    print '<a href="shop_list.php">商品一覧に戻る</a>';
    exit();
  }
  if($post['kazu'.$i]<1||10<$post['kazu'.$i]){
    print '数量は必ず1個～10個までとしてください。';
    print '<a href="shop_list.php">商品一覧に戻る</a>';
    exit();
  }
  $kazu[]=$post['kazu'.$i];
}
$cart=$_SESSION['cart'];
for($i=$max;$i>=0;$i--){
  if(isset($_POST['sakujo'.$i])==true){
    array_splice($cart,$i,1);
    array_splice($kazu,$i,1);
  }
}
$_SESSION['cart']=$cart;
$_SESSION['kazu']=$kazu;

header('Location:shop_cartlook.php');
exit();
?>
