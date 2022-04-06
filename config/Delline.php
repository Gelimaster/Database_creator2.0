<?php
//POSTデータ
if(isset($_POST["Tname"])){
  $user=$_POST["username"];
  $pass=$_POST["password"];
  $Dname = $_POST["Dname"];
  $Tname = $_POST["Tname"];
  $Tid=$_POST["line"];
  $id=$_POST["Tid"];
  //MySqlサーバ接続
  $db_link = mysqli_connect
  ("localhost",$user,$pass);
  //データベース接続
  $db_flg = mysqli_select_db($db_link,$Dname);

//test
// $db_link = mysqli_connect
//     ("localhost","kobayashi","kilo1302");
//   // テーブルのライン削除
//   // 削除query
//   $Tname="bbs_tbl";
//   $id="9";
//   $Tid="bbs_no";
//   $Dname="nhs90324db";
//   $query = "use $Dname";
//   $sql=mysqli_query($db_link,$query);
//   if ($sql) {
//     echo "true";
//   }else {
//     echo "false";
//   }
  //
  $query="DELETE FROM $Tname WHERE $Tid = '$id'";
  $sql=mysqli_query($db_link,$query);
  if ($sql) {
    echo "true";
  }else{
    echo "false";
  }
}

?>
