<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>ABC商店</title>
</head>
<body>
  お客様情報を入力してください。<br>
  <form action="shop_form_check.php" method="post">
    お名前<br>
    <input type="text" name="onamae" style="width:200px"><br>
    メールアドレス<br>
    <input type="text" name="email" style="width:200px"><br>
    郵便番号<br>
    <input type="text" name="postal1" style="width:50px">-
    <input type="text" name="postal2" style="width:80px"><br>
    住所<br>
    <input type="text" name="address" style="width:500px"><br>
    電話番号<br>
    <input type="text" name="tel" style="width:150px"><br>
    <br>
    <input type="radio" name="chumon" value="chumonkonkai" checked>今回だけの注文<br>
    <input type="radio" name="chumon" value="chumontouroku" checked>会員登録しての注文<br>
    <br>
    ※会員登録する方は以下の項目も入力してください。<br>
    パスワードを入力してください。<br>
    <input type="password" name="pass" style="width:100px"><br>
    パスワードをもう一度入力してください。<br>
    <input type="password" name="pass2" style="width:100px"><br>
    性別<br>
    <input type="radio" name="danjo" value="dan" checked>男性<br>
    <input type="radio" name="danjo" value="jo" checked>女性<br>
    生まれ年<br>
    <select name="birth">
      <?php
       $max_year=date("Y");
       $min_year=date("Y",strtotime("-110 year"));
       $def_year=1980;
      for($i=$min_year;$i<=$max_year;$i++){
        if($i==$def_year){
          print '<option value="'.$i.'" selected>'.$i.'年</option>';
        }else{
          print '<option value="'.$i.'">'.$i.'年</option>';
        }
      }
      ?>
    </select><br>
    <br>
    <input type="button" onclick="history.back()" value="戻る">
    <input type="submit" value="OK">
  </form>

</body>
</html>
