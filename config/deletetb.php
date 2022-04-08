<?php
//POST
if(isset($_POST["Dname"])){
  $user=$_POST["username"];
  $pass=$_POST["password"];
  $Dname = $_POST["Dname"];
  $Tname =$_POST["Tname"];
}
//MySql connection
$db_link = mysqli_connect
            ("localhost",$user,$pass);
//charset
mysqli_set_charset($db_link,"utf8");
//データベース接続
$db_flg = mysqli_select_db($db_link,$Dname);

$query="drop table $Tname";
$sql=mysqli_query($db_link,$query);
if ($sql) {
  echo "true";
}else{
  echo "false";
}
?>
