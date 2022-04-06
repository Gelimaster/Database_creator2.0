//log in on mysql
function login(user,pass){
  //Login on MySql database
  $.ajax({
        url: 'config/loginrequest.php',
        type: 'post',
        data: {username: user.value,password:pass.value},
        success: function(response){
        //Login Request
          if (response == "true") {
            load_log.style.display="block";
            load_log.innerHTML="ログイン成功. データベース読み込み中... ";
            load_log.style.color="blue";
            //success
            err_login.style.display="none";
            //get databeses from the user
            $.post("DTBS/DTBS.php", { username: user.value,password:pass.value},
            function(data) {
              $('#main').html(data);
            });
          }else{
            //failed to login
            err_login.style.display="block";
            err_login.innerHTML="ログイン失敗";
            err_login.style.color="red";
          }
        }
      });
}

//create data base page functions//
function createdata(user,pass){
  $.post("Dnew/Dnew.php", {username: user,password:pass},
  function(data) {
    $('#main').html(data);
  });
}

//createDB
function createDB(fieldname,optiondata,fieldlenght,user,pass){
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
  });

}

//create table page functions//
function createtable(user,pass){
  $.post("Tnew/Tnew.php", { username: user,password:pass},
  function(data) {
    $('#main').html(data);
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

//show tables page functions//
function setdatabase(databasename,user,pass){
  $.post("DTBS/DTB.php", {Dname:databasename, username: user,password:pass},
  function(data) {
    $('#main').html(data);
  });
}

//show data inside tables
function settable(tablename,databasename,user,pass){
  $.post("DTBS/Tshow.php", {Tname:tablename,Dname:databasename, username: user,password:pass},
  function(data) {
    $('#main').html(data);
  });
}

//back to databases list
function backlist(user,pass){
  $.post("DTBS/DTBS.php", {username: user,password:pass},
  function(data) {
    $('#main').html(data);
  });
}

//back to tables list
function backTlist(tablename,databasename,user,pass){
  $.post("DTBS/DTB.php", {Tname:tablename,Dname:databasename, username: user,password:pass},
  function(data) {
    $('#main').html(data);
  });
}

//back to table Tshow
function backTshow(tablename,databasename,user,pass){
  $.post("DTBS/Tshow.php", {Tname:tablename,Dname:databasename, username: user,password:pass},
  function(data) {
    $('#main').html(data);
  });
}

//edit table line
function edit(tablename,databasename,user,pass,linename,lineid){
  $.post("config/EditTable.php", {Tname:tablename,Dname:databasename, username: user,password:pass,linename:linename,lineid:lineid},
  function(data) {
    $('#main').html(data);
  });
}



//delete table line
function del(tablename,databasename,user,pass,line,linename){
  $.ajax({
        url: 'config/Delline.php',
        type: 'post',
        data: {Tname:tablename,Dname:databasename, username: user,password:pass,Tid:linename,line:line},
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
