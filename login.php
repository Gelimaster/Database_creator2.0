<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/index.css">
    <title>MySql データベース</title>
  </head>
  <body>
    <div id="load" name="loading">
      <p id="err_login"></p>
      <p id="load_log"></p>
    </div>
    <div id="main">
      <h1>Mysql ログイン</h1>
      <p>ユーザ名：<input id="username" type="text"  value=""></p>
      <p>パスワード： <input id="password" type="password"  value=""></p><br>
      <button type="button" onclick="login(username,password)" name="button">ログイン</button>
    </div>
    <script src="js/jquery-1.10.2.min.js"></script>
    <script src="js/index.js"></script>
  </body>
</html>
