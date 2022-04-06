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
//connect to database
$db_flg = mysqli_select_db($db_link,$Dname);
?>



<h1>テーブルを選択してください</h1>
<form method="post" action="Tshow.php">
  <?php

// execute show tables
$res = mysqli_query($db_link,"SHOW TABLES");
//table names
while ($row = mysqli_fetch_assoc($res)) {
     ?><input type="button" onclick="settable('<?php echo $row["Tables_in_$Dname"]?>','<?php echo $Dname?>','<?php echo $user?>','<?php echo $pass?>')" name="Tname" value="<?php echo $row["Tables_in_$Dname"]?>"><br>
<?php
  }
mysqli_close($db_link);
  ?>
</form>
  <br>
  <input type="button" onclick="backlist('<?php echo $user?>','<?php echo $pass?>')" value="データベース一覧に戻る">
  <script src="js/index.js"></script>
