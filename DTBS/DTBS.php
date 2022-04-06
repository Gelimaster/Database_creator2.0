<?php
//Post data
if(isset($_POST["username"])){
  $user=$_POST["username"];
  $pass=$_POST["password"];

}
//Mysql connection
$db_link = mysqli_connect
            ("localhost",$user,$pass);

//charset
mysqli_set_charset($db_link,"utf8");
?>
<h1>データベースを選択してください</h1>
<button type="button" onclick="createdata('<?php echo $user?>','<?php echo $pass?>')" name="button">データベースとテーブル作成</button>
<button type="button" onclick="createtable('<?php echo $user?>','<?php echo $pass?>')" name="button">存在しているデータベースにテーブル作成</button>
<br>
<br>
<?php
//Show databases

//show database query
$res = mysqli_query($db_link,"SHOW DATABASES");
//databases loop
while ($row = mysqli_fetch_assoc($res)) {
  //skip information_schema
  if ($row['Database']=="information_schema") {
    continue;
  }else{
     ?><input type="button"  onclick="setdatabase('<?php echo $row['Database']?>','<?php echo $user?>','<?php echo $pass?>')"  value="<?php echo $row['Database']?>"><br>
<?php
  }
}
//close mysqli
mysqli_close($db_link);
  ?>
<script src="js/index.js"></script>
<a href="login.php">ログアウト</a>
