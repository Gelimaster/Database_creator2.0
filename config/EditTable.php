<?php
//POST data
if(isset($_POST["Tname"])){
  $user=$_POST["username"];
  $pass=$_POST["password"];
  $Dname = $_POST["Dname"];
  $Tname = $_POST["Tname"];
  $linename=$_POST["linename"];
  $lineid=$_POST["lineid"];
  //MySql connector
  $db_link = mysqli_connect
  ("localhost",$user,$pass);
  $query = "use $Dname";
  $sql=mysqli_query($db_link,$query);

  //charset指定
  mysqli_set_charset($db_link,"utf8");
  //データベース接続
  $db_flg = mysqli_select_db($db_link,$Dname);
}

?>
<h1>テーブル編集画面</h1>
<!-- 見えやすくするためにテーブルを作る -->
  <table border="1">
    <tr><!--テーブル名の行はここから -->
      <?php
      //SQL文の作成　テーブル名
      $strSQL  = "desc ".$Tname;
      //SQL文を実行する。
      $db_result = mysqli_query($db_link,$strSQL);
      $cnt=0;
      $fields[]="";
      $type[]="";
      while($db_row = mysqli_fetch_array($db_result)){
        ?>
        <!-- ここからは列の始まり -->
        <td><?php print $db_row["Field"];?></td>
          <!-- 列の終わり -->
          <?php
          $fields[$cnt]=$db_row["Field"];
          $type[$cnt]=$db_row["Type"];
          $cnt++;
        }
        ?>
    </tr><!-- //デーブル名　行の終わり -->
    <tr> <!-- //データ　行の始まり -->
      <?php
      // SQL作成　データ
      $sql  = "select * from ".$Tname." where ".$linename." = '".$lineid."'";
      // SQL文を実行する。
      $result = $db_link->query($sql);
      while ($row = $result->fetch_assoc()) {
        for ($i=0; $i <$cnt ; $i++) {
          ?>
           <td><input type="text" class="updatedata"  value="<?php echo $row[$fields[$i]]; ?>" placeholder="<?php echo $row[$fields[$i]]; ?>"></td>
           <?php
        }
        //rowごとに行を閉じてそして新しく開く
        echo "  </tr><tr>";
      }
      mysqli_close($db_link);
      ?>
    </tr> <!-- 行の終わり -->

  </table>
  <br>
  <input type="button" onclick="updateline('<?php echo $Tname?>','<?php echo $Dname?>','<?php echo $user?>','<?php echo $pass?>','updatedata','<?php echo $linename?>','<?php echo $lineid?>')" value="アップデート">
  <br>
  <input type="button" onclick="backTshow('<?php echo $Tname?>','<?php echo $Dname?>','<?php echo $user?>','<?php echo $pass?>')" value="テーブルに戻る">
  <script type="text/javascript">
  //comfirm Edit
  function updateline(tablename,databasename,user,pass,values,linename,lineid) {
    //get line names
    let linenames =  <?php echo json_encode($fields); ?>;
    //get line type
    let linetype =  <?php echo json_encode($type); ?>;
    //get line values from class
    let linevalues= $("."+values).map(function(){
      return $(this).val();
    }).get();
      linevalues=linevalues.join("|");
      linenames=linenames.join("|");
      linetype=linetype.join("|");
    $.ajax({
          url: 'config/update.php',
          type: 'post',
          data: {Tname:tablename,Dname:databasename, username: user,password:pass,linenames:linenames,linevalues:linevalues,tid:linename,id:lineid,linetype:linetype},
          success: function(response){
            if (response == "true") {
              $.post("DTBS/Tshow.php", {Tname:tablename,Dname:databasename, username: user,password:pass},
              function(data) {
                $('#main').html(data);
              });
            }else{
              //failed to login
            console.log("error responde false =" + response);
            }
          }
        });
  }
  </script>
