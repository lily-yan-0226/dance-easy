<?php
    require_once("connect_db.inc.php");
    header("Content-type: text/html; charset=utf-8");
      
    //取得表單資料
    $sid = $_POST["sid"]; 	
    $name = $_POST["name"];
    $nickname = $_POST["nickname"];
    $email = $_POST["email"]; 
  
    //建立資料連接
    $link = create_connection();
                      
    //檢查帳號密碼是否正確
    $sql = "SELECT * FROM member Where SId = '$sid' ";
    $result = execute_sql($link, "group_project", $sql);

    $detail = "UPDATE `member` SET `Name`='$name',`NickName`='$nickname',`email`='$email' WHERE SId = '$sid'";

    if(mysqli_query($link, $detail)){
        echo '<script language="javascript">';
        echo 'alert("會員資料更改成功！");';
        echo "window.location.href='alter_account.php'";
        echo '</script>'; 
    }
?>s