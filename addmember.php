<?php
  require_once("connect_db.inc.php");
  header("Content-type: text/html; charset=utf-8");

  //取得表單資料
  $sid = $_POST["sid"];
  $password = $_POST["password"]; 
  $name = $_POST["name"];
  $nickname = $_POST["nickname"]; 
  $email = $_POST["email"]; 
 

  //建立資料連接
  $link = create_connection();
			
  //檢查帳號是否有人申請
  $sql = "SELECT * FROM member Where Sid = '$sid'";
  $result = execute_sql($link, "group_project", $sql);

  //如果帳號已經有人使用
  if (mysqli_num_rows($result) != 0)
  {
    //釋放 $result 佔用的記憶體
    mysqli_free_result($result);
		
    //顯示訊息要求使用者更換帳號名稱
    echo "<script type='text/javascript'>";
    echo "alert('您所指定的帳號已經有人使用，請使用其它帳號');";
    echo "history.back();";
    echo "</script>";
  }
	
  //如果帳號沒人使用
  else
  {
    //釋放 $result 佔用的記憶體	
    mysqli_free_result($result);
		
    //執行 SQL 命令，新增此帳號
    $sql = "INSERT INTO member (`SId`, `Name`, `NickName`, `Password`,'email') VALUES ('$sid', '$name', 
            '$nickname', '$password','$email')";

    $result = execute_sql($link, "group_project", $sql);

    echo '<script language="javascript">';
    echo 'alert("會員註冊成功！");';
    echo "window.location.href='login.html'";
    echo '</script>'; 
  }
	
  //關閉資料連接	
  mysqli_close($link);
?>
