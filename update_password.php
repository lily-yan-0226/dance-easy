<?php
    if(isset($_COOKIE["passed"]) != "TRUE"){
        $passed = " ";
        $sid = " ";
    }
    else{
        $passed = $_COOKIE["passed"];
        $sid = $_COOKIE["SId"];
    }

    require_once("connect_db.inc.php");
    header("Content-type: text/html; charset=utf-8");
      
    //取得表單資料
    $password = $_POST["password"];
  
    //建立資料連接
    $link = create_connection();
                      
    //檢查帳號密碼是否正確
    $sql = "SELECT * FROM member Where SId = '$sid' ";
    $result = execute_sql($link, "group_project", $sql);

    $detail = "UPDATE `member` SET `Password`='$password' WHERE SId = '$sid'";

    if(mysqli_query($link, $detail)){
        echo '<script language="javascript">';
        echo 'alert("密碼更改成功！");';
        echo "window.location.href='alter_account.php'";
        echo '</script>'; 
    }

  
?>