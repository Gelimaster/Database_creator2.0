<?php
//POST data
if(isset($_POST["username"])){
  $user=$_POST["username"];
  $pass=$_POST["password"];
}
//MySql connection
$db_link = mysqli_connect
            ("localhost",$user,$pass);
//charset
mysqli_set_charset($db_link,"utf8");
?>

<h1>存在しているデータベースから新規テーブルを作成</h1>
<h2>データベースを選択してください</h2>
<select id="databasename">
<?php
//show databases
$res = mysqli_query($db_link,"SHOW DATABASES");
while ($row = mysqli_fetch_assoc($res)) {
  if ($row['Database']=="information_schema") {
    continue;
  }else{
    ?>
    <option  value="<?php echo $row['Database']?>"><?php echo $row['Database']?></option><br>
    <?php
  }
}
?>
</select>
<h3>テーブルの名前を記入してください</h3>
<p>テーブル名<input type="input" id="tablename" name="table"></p>
<p>1番目（主キー）<input type="text" id="tableId" placeholder="主キー名を決めてください"></p>
<p>2番目
  <input type="input" class="fieldname"  value="" placeholder="フィールド名を入力してください">
        <select class="datatype"  >
          <option value="varchar">varchar</option>
          <option value="char">char</option>
          <option value="datetime">datetime</option>
          <option value="int">int</option>
          <option value="tinyint">tinyint</option>
        </select>
  <input type="text" class="fieldlenght" value=""  size="1">
</p>
<div id="tablefields"></div>
<button type="button" onclick="addfield()" name="button">+</button>
<br>
<br>
<button type="button"
        onclick="createDB('fieldname','datatype','fieldlenght','<?php echo $user?>','<?php echo $pass?>')"
        name="button">作成</button>
<br>
<button type="button" onclick="backlist('<?php echo $user;?>','<?php echo $pass;?>')" name="button">データベース一覧に戻る</button>
<script src="js/index.js"></script>
