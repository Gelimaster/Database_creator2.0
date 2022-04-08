<?php
//POST
if(isset($_POST["Dname"])){
  $user=$_POST["username"];
  $pass=$_POST["password"];
  $Dname = $_POST["Dname"];
}
//MySql connection
$db_link = mysqli_connect
            ("localhost",$user,$pass);
//charset
mysqli_set_charset($db_link,"utf8");
$query="drop database $Dname";
$sql=mysqli_query($db_link,$query);
if ($sql) {
  echo "true";
}else{
  echo "false";
}
?>
