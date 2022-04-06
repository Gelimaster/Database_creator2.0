<?php
if (isset($_POST["username"])) {
  $username=$_POST["username"];
  $password=$_POST["password"];
  if($username == "" || $username == "root"){
    echo "false";
  }
  //MySql Connect
  $db_link = mysqli_connect
              ("localhost",$username,$password);
  //Return the Connect result
  if($db_link == false){
    echo "false";
  }else{
    echo "true";
  }
  //close mysqli
  mysqli_close($db_link);

}
?>
