<?php
//POSTデータ
if(isset($_POST["Tname"])){
  $user=$_POST["username"];
  $pass=$_POST["password"];
  $Dname = $_POST["Dname"];
  $Tname = $_POST["Tname"];
}
//MySqlサーバ接続
$db_link = mysqli_connect
("localhost",$user,$pass);


//charset指定
mysqli_set_charset($db_link,"utf8");

//データベース接続
$db_flg = mysqli_select_db($db_link,$Dname);
//テーブルのライン削除
?>
<h1>テーブル画面</h1>
<!-- 見えやすくするためにテーブルを作る -->
  <table border="1">
    <tr><!--テーブル名の行はここから -->
      <?php
      //SQL文の作成　テーブル名
      $strSQL  = "desc ".$Tname;
      //SQL文を実行する。
      $db_result = mysqli_query($db_link,$strSQL);
      $id;
      $cnt=0;
      while($db_row = mysqli_fetch_array($db_result)){
      if ($cnt==0) {
          $id=$db_row["Field"];
        $cnt++;
      }
        ?>
        <!-- ここからは列の始まり -->
        <td><?php print $db_row["Field"];?></td>
          <!-- 列の終わり -->
          <?php
        }
        ?>
        <td> 編集・削除</td>
    </tr><!-- //デーブル名　行の終わり -->
    <tr> <!-- //データ　行の始まり -->
      <?php
      // SQL作成　データ
      $strSQL  = "select * from ".$Tname;
      // SQL文を実行する。
      $db_result = mysqli_query($db_link,$strSQL);
      $val;
      while ($row = $db_result->fetch_assoc()) {
        foreach($row as $ind => $val){
          // データ　列の始まり

          echo "<td>  $val 　 </td>";
          //データ　列の終わり

        }
        ?>
         <td>
        <button type='button' onclick="edit('<?php echo $Tname?>','<?php echo $Dname?>','<?php echo $user?>','<?php echo $pass?>','<?php echo $id?>',<?php echo $row[$id]?>)" name='button'>編集</button>
        <button type='button' onclick="del('<?php echo $Tname?>','<?php echo $Dname?>','<?php echo $user?>','<?php echo $pass?>','<?php echo $id?>',<?php echo $row[$id]?>)" name='button'>削除</button>
        </td>
        <?php
        //rowごとに行を閉じてそして新しく開く
        echo "  </tr><tr>";
      }
      mysqli_close($db_link);
      ?>
    </tr> <!-- 行の終わり -->
  </table>
  <br>
<br>
<input type="button" onclick="backTlist('<?php echo $Tname?>','<?php echo $Dname?>','<?php echo $user?>','<?php echo $pass?>')" value="テーブル一覧に戻る">
<script src="js/index.js"></script>
