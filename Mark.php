<?php
      $sid = $_COOKIE{"SId"};

      require_once("connect_db.inc.php");
      $link = create_connection();
					
      //執行SQL查詢
      $sql = "DELETE FROM `notice` WHERE  `SId`='$sid'";
      $result = execute_sql($link, "group_project", $sql);
    //   setcookie("total_new","0");    
      
      mysqli_close($link);
    
?> 		