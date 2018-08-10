<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>ろくまる農園</title>
</head>
<body>
<?php
  require_once('../common/common.php');
  $post=sanitize($POST);
  $staff_name=$_post['name'];
  $staff_pass=$_post['pass'];
  $staff_pass2=$_post['pass2'];

  if($staff_name==''){
    print 'スタッフ名が入力されていません。<br>';
  } else{
    print'スタッフ名:';
    print $staff_name;
    print'<br>';
  }
  if($staff_pass==''){
    print 'パスワードが入力されていません。<br>';
  }
  if($staff_pass!=$staff_pass2){
    print 'パスワードが一致しません。<br>';
  }
  if($staff_name==''||$staff_pass==''||$staff_pass2==''){
    print '<forrm>';
    print '<input type="button" onclick="history.back()" value="戻る ">';
    print '</form>';
  }else{
    $staff_pass=md5($staff_pass);
    print '<form method="post" action="staff_add_done.php">';
    print '<input type="hidden" name="name" value="'.$staff_name.'">';
    print '<input type="hidden" name="pass" value="'.$staff_pass.'">';
    print '';
    print '<input type="button" onclick="history.back()" value="戻る ">';
    print '<input type="submit" value="OK ">';
    print '</form>';
  }

?>
</html>
