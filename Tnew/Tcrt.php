<?php


//データベースの情報
$Dname=$_POST["Dname"];
$Tname=$_POST["table"];
$data[]=$_POST["2data"];
$type[]=$_POST["dat2"];
$data[]=$_POST["3data"];
$type[]=$_POST["dat3"];
$data[]=$_POST["4data"];
$type[]=$_POST["dat4"];
$data[]=$_POST["5data"];
$type[]=$_POST["dat5"];
$data[]=$_POST["6data"];
$type[]=$_POST["dat6"];
$data[]=$_POST["7data"];
$type[]=$_POST["dat7"];
$data[]=$_POST["8data"];
$type[]=$_POST["dat8"];
$data[]=$_POST["9data"];
$type[]=$_POST["dat9"];
$data[]=$_POST["10data"];
$type[]=$_POST["dat0"];
include("../db_ini.php");
//前処理（ここは知らなかったら触らないこと）

//数字型か文字型の処理
//1か２の数字が来ますそれを確認してarrayのMS[]に結果を保存する
for ($n=0; $n <9; $n++) {
  if ($type[$n]==1) {
    $MS[$n]="int(100) not null";
  }else{
    $MS[$n]="varchar(100) not null";
  }
}
//テーブル判断
//emptyのままならスキップする(continue)
$x=-1;
for ($i=0; $i <9; $i++) {
  if ($data[$i]=="empty") {
    continue;
  }else{
    $dt[]=$data[$i]." ".$MS[$i];//文字型か数字型とテーブルとテーブル名を組み合わせSQLのクエリーを作る
    $x++;
  }
}
$Dt= implode(",", $dt);//全部の組み合わせたクエリーをカンマで分ける


//MySqlサーバ接続
$db_link = mysqli_connect
            ($host,$user,$pass);
//接続確認
if($db_link == false){
    print "MySqlサーバー接続に失敗しました。";
    exit;
}
//charset指定
mysqli_set_charset($db_link,"utf8");


//データベースに入る
$Indatabase="use $Dname";
$SQL=mysqli_query($db_link,$Indatabase);


//テーブルの作成
$CreateTable= "create table $Tname(
id int(10) AUTO_INCREMENT,
$Dt ,
PRIMARY KEY(id)
);";
$SQL= mysqli_query($db_link,$CreateTable);




mysqli_close($db_link);



?>







<!DOCTYPE html>

<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>データベース画面</title>
  </head>

    <center><body>
      <?php
        include("../.DTBS/.DTBS.php");
      ?>
    </body></center>

</html>
