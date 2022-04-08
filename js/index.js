//load window
function open_windows(){
  load.style.display="block";
}
//close load window
function close_windows(){
  load.style.display="none";
}
//log in on mysql
function login(user,pass){
  //Login on MySql database
  open_windows();
  err_login.style.display="none";
  load_log.style.display="block";
  load_log.innerHTML="ログイン中... ";
  $.ajax({
        url: 'config/loginrequest.php',
        type: 'post',
        data: {username: user.value,password:pass.value},
        success: function(response){
        //Login Request
          if (response == "true") {
            //loading windows
            load_log.style.display="block";
            load_log.innerHTML="ログイン成功. データベース読み込み中... ";
            load_log.style.color="blue";
            //get databeses from the user
            $.post("DTBS/DTBS.php", { username: user.value,password:pass.value},
            function(data) {
              $('#main').html(data);
              close_windows();
            });
          }else{
            //failed to login
            err_login.style.display="block";
            err_login.innerHTML="ログイン失敗";
            err_login.style.color="red";
            load_log.style.display="none";
            setTimeout(function() { close_windows(); }, 1000);
          }
        }
      });
}

//create data base page functions//
function createdata(user,pass){
  open_windows();
  load_log.innerHTML="作成中。。。";
  $.post("Dnew/Dnew.php", {username: user,password:pass},
  function(data) {
    $('#main').html(data);
    close_windows();
  });
}

//createDB
function createDB(fieldname,optiondata,fieldlenght,user,pass){
  open_windows();
  load_log.innerHTML="作成中。。。";
  //database name
  dbname=databasename.value;
  //table name
  tablen=tablename.value;
  //table id
  tableid=tableId.value;
  //all field names
  let fieldn= $("."+fieldname).map(function(){
    return $(this).val();
  }).get();
  fieldn=fieldn.join(",");
  //all field type
  let optiond= $("."+optiondata).map(function(){
    return $(this).val();
  }).get();
  optiond=optiond.join(",");
  //all field type lenght
  let fieldl= $("."+fieldlenght).map(function(){
    return $(this).val();
  }).get();
  fieldl=fieldl.join(",");
  //send data to Dcrt page (Data create page)
  $.post("config/createDB&tbl.php", {DBname:dbname,tablename:tablen,tableid:tableid,fieldname:fieldn,optiondata:optiond,fieldlenght:fieldl,username: user,password:pass},
  function(data) {
    $('#main').html(data);
    load_log.innerHTML="データベースとテーブル作成されました。";
    setTimeout(function() { close_windows(); }, 1000);
  });

}

//create table page functions//
function createtable(user,pass){
  open_windows();
  load_log.innerHTML="作成中。。。";
  $.post("Tnew/Tnew.php", { username: user,password:pass},
  function(data) {
    $('#main').html(data);
    close_windows();
  });
}

//add field on table
let position=3;
function addfield(){
  // option data
  let array =["varchar","char","datetime","int","tinyint"];
  // create elements
  let input = document.createElement("input");
  let p = document.createElement("p");
  let select = document.createElement("select");
  let inputlength=document.createElement("input");
  //input setting
  input.type="input";
  input.className="fieldname";
  select.className ="datatype"
  //p tag setting
  p.innerHTML=position +"番目";
  // options setting
  inputlength.className="fieldlenght";
  inputlength.size=1;
  // set elements
  tablefields.appendChild(p);
  p.appendChild(input);
  p.appendChild(select);
  p.appendChild(inputlength);
  // set option inside select
  for(var i=0;i<array.length;i++){
    let option = document.createElement("option");
    option.value = array[i];
    option.text=array[i]
    select.appendChild(option);
  }
  position++;
}

//show database page functions//
function setdatabase(databasename,user,pass){
  open_windows();
  load_log.style.color="blue";
  load_log.innerHTML="ローディング中。。。";
  $.post("DTBS/DTB.php", {Dname:databasename, username: user,password:pass},
  function(data) {
    $('#main').html(data);
    close_windows();
  });
}

//delete database
function deleteDB(databasename,user,pass) {
  open_windows();
  load_log.style.color="red";
  load_log.innerHTML="削除中。。。";
  $.ajax({
      url: 'config/deletedb.php',
      type: 'post',
      data: {Dname:databasename ,username:user,password:pass},
      success: function(response){
      //delete DB Request
      if (response == "true") {
        //reload DB page
        $.post("DTBS/DTBS.php", { username: user,password:pass},
        function(data) {
          $('#main').html(data);
          load_log.innerHTML="削除完了。。。";
          setTimeout(function() { close_windows(); }, 1000);
        });
      }else{
        //failed to delete DB
        err_login.style.display="block";
        err_login.innerHTML="データベース削除を失敗しました。";
        err_login.style.color="red";
        setTimeout(function() { close_windows(); }, 1000);
      }
    }
  });
}

//show data inside tables
function settable(tablename,databasename,user,pass){
  open_windows();
  load_log.innerHTML="ローディング中。。。";
  $.post("DTBS/Tshow.php", {Tname:tablename,Dname:databasename, username: user,password:pass},
  function(data) {
    $('#main').html(data);
    close_windows();
  });
}

//delete table
function deleteTB(tablename,databasename,user,pass) {
  open_windows();
  load_log.style.color="red";
  load_log.innerHTML="削除中。。。";
  $.ajax({
      url: 'config/deletetb.php',
      type: 'post',
      data: {Dname:databasename ,Tname:tablename,username:user,password:pass},
      success: function(response){
      //delete table Request
      if (response == "true") {
        //reload table page
        $.post("DTBS/DTB.php", {Dname:databasename ,username:user,password:pass},
        function(data) {
          $('#main').html(data);
          load_log.innerHTML="削除完了。。。";
          setTimeout(function() { close_windows(); }, 1000);
        });
      }else{
        //failed to delete table　
        err_login.style.display="block";
        err_login.innerHTML="テーブルの削除を失敗しました。";
        err_login.style.color="red";
        setTimeout(function() { close_windows(); }, 1000);
      }
    }
  });
}

//back to databases list
function backlist(user,pass){
  open_windows();
  load_log.innerHTML="ローディング中。。。";
  $.post("DTBS/DTBS.php", {username: user,password:pass},
  function(data) {
    $('#main').html(data);
    close_windows();
  });
}

//back to tables list
function backTlist(tablename,databasename,user,pass){
  open_windows();
  load_log.style.color="blue";
  load_log.innerHTML="ローディング中。。。";
  $.post("DTBS/DTB.php", {Tname:tablename,Dname:databasename, username: user,password:pass},
  function(data) {
    $('#main').html(data);
    close_windows();
  });
}

//back to table Tshow
function backTshow(tablename,databasename,user,pass){
  open_windows();
  load_log.style.color="blue";
  load_log.innerHTML="ローディング中。。。";
  $.post("DTBS/Tshow.php", {Tname:tablename,Dname:databasename, username: user,password:pass},
  function(data) {
    $('#main').html(data);
    close_windows();
  });
}

//edit table line
function edit(tablename,databasename,user,pass,linename,lineid){
  open_windows();
  load_log.style.color="blue";
  load_log.innerHTML="ローディング中。。。";
  $.post("config/EditTable.php", {Tname:tablename,Dname:databasename, username: user,password:pass,linename:linename,lineid:lineid},
  function(data) {
    $('#main').html(data);
    close_windows();
  });
}

//delete table line
function del(tablename,databasename,user,pass,line,linename){
  open_windows();
  load_log.style.color="red";
  load_log.innerHTML="削除中。。。";
  $.ajax({
        url: 'config/Delline.php',
        type: 'post',
        data: {Tname:tablename,Dname:databasename, username: user,password:pass,Tid:linename,line:line},
        success: function(response){
          if (response == "true") {
            $.post("DTBS/Tshow.php", {Tname:tablename,Dname:databasename, username: user,password:pass},
            function(data) {
              $('#main').html(data);
              load_log.innerHTML="削除完了。。。";
              setTimeout(function() { close_windows(); }, 1000);
            });
          }else{
            //failed to delete table　line
            err_login.style.display="block";
            err_login.innerHTML="ラインの削除を失敗しました。";
            err_login.style.color="red";
            setTimeout(function() { close_windows(); }, 1000);
          }
        }
      });
    }
