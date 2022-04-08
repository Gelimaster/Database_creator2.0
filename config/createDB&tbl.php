<?php
//Post data
if (isset($_POST["DBname"])) {
  $dbname=$_POST["DBname"];
  $tablename=$_POST["tablename"];
  $tableid=$_POST["tableid"];
  $fieldname=$_POST["fieldname"];
  $optiondata=$_POST["optiondata"];
  $fieldlenght=$_POST["fieldlenght"];
  $user=$_POST["username"];
  $pass=$_POST["password"];
  $fieldname= explode(",",$fieldname);
  $optiondata= explode(",",$optiondata);
  $fieldlenght= explode(",",$fieldlenght);
}

//create table query
$cnt = count($fieldname);
for ($i=0; $i <$cnt ; $i++) {
  // fieldname + datatype(lenght) + not null ,
  //ex. user_table varchar(3) not null ,
  $dt[]=$fieldname[$i]." ".$optiondata[$i]."($fieldlenght[$i]) not null";
}
//transform array to string
 $Dt = implode(",",$dt);

//MySql connection
$db_link = mysqli_connect
            ("localhost",$user,$pass);

//charset
mysqli_set_charset($db_link,"utf8");

//create database
 $CreatData="CREATE DATABASE $dbname CHARACTER set utf8";
// execute create databases query
$SQL =mysqli_query($db_link,$CreatData);

//use created database
$Indatabase="use $dbname";
$SQL=mysqli_query($db_link,$Indatabase);

//create table
$CreateTable= "create table $tablename(
$tableid int(10) AUTO_INCREMENT,
$Dt ,
PRIMARY KEY($tableid)
);";
$SQL= mysqli_query($db_link,$CreateTable);

mysqli_close($db_link);


include("../DTBS/DTBS.php");
?>
