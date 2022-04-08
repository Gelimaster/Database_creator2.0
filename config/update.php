<?php
//POST data
if(isset($_POST["Tname"])){
  $user=$_POST["username"];
  $pass=$_POST["password"];
  $Dname = $_POST["Dname"];
  $Tname = $_POST["Tname"];
  $linenames=$_POST["linenames"];
  $linevalues=$_POST["linevalues"];
  $Tid=$_POST["tid"];
  $id=$_POST["id"];
  $linetype=$_POST["linetype"];
  //MySql connector
  $db_link = mysqli_connect
  ("localhost",$user,$pass);
  $query = "use $Dname";
  $sql=mysqli_query($db_link,$query);

  //charset
  mysqli_set_charset($db_link,"utf8");
  //connect to DB
  $db_flg = mysqli_select_db($db_link,$Dname);
  //get collumns name and values
  $linenames=explode("|",$linenames);
  $linevalues=explode("|",$linevalues);
  $linetype=explode("|",$linetype);
  $set="";
  for ($i=0; $i <count($linenames); $i++) {
    //last line dont need ,
    if (($i)==count($linenames)-1) {
      //check what data type it is
      if (strpos($linetype[$i], 'char')) {
        $set.=$linenames[$i]."= '".$linevalues[$i]."'";
      }else{
        $set.=$linenames[$i]."= ".$linevalues[$i]."";
      }
    }else{
      if (strpos($linetype[$i], 'char')) {
        $set.=$linenames[$i]."= '".$linevalues[$i]."',";
      }else {
        $set.=$linenames[$i]."= ".$linevalues[$i].",";
      }
    }
  }
  $query="UPDATE $Tname SET $set  WHERE   $Tid = '$id'";
  $sql=mysqli_query($db_link,$query);
  if ($sql) {
    echo "true";
  }else{
    echo "false";
  }
}

?>
