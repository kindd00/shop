<?php
  if(isset($_POST['disp'])&&isset($_POST['staffcode'])){
    $staff_code=$_POST['staffcode'];
    header('Location:staff_disp.php?staffcode='.$staff_code);
    exit();
  }
  if(isset($_POST['add'])){
    header('Location:staff_add.php');
    exit();
  }
  if(!isset($_POST['staffcode'])){
    header('Location:staff_ng.php');
    exit();
  }
  if(isset($_POST['edit'])){
    $staff_code=$_POST['staffcode'];
    header('Location:staff_edit.php?staffcode='.$staff_code);
    exit();
  }
  if(isset($_POST['delete'])){
    $staff_code=$_POST['staffcode'];
    header('Location:staff_delete.php?staffcode='.$staff_code);
    exit();
  }


?>
