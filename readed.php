<?php
      $sid = $_COOKIE{"SId"};

      require_once("connect_db.inc.php");
      $link = create_connection();
      $content=$_POST['new_content'];
      $href=$_POST['new_href'];
					
      //執行SQL查詢
      $sql = "UPDATE `notice` SET `if_read`=1 WHERE `content`='$content' AND `SId`='$sid'";
      $result = execute_sql($link, "group_project", $sql);
    //   setcookie("total_new","0");
    
      
      mysqli_close($link);
      header("location:"."$href");
      exit();
    
?> 		