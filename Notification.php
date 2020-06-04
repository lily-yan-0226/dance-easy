<?php
      $sid = $_COOKIE{"SId"};

      require_once("connect_db.inc.php");
      $link = create_connection();
					
      //執行SQL查詢
      $sql = "SELECT * FROM `notification` WHERE`SId`='$sid'";
      $result = execute_sql($link, "group_project", $sql);

      $sql2 ="DELETE FROM `notification` WHERE `SId`='$sid'";
      $result2 = execute_sql($link, "group_project", $sql2);


      $dataarr = array();
      while($row = mysqli_fetch_array($result)){
        array_push($dataarr, $row);
      }

      mysqli_close($link);
      echo json_encode($dataarr);


      



    
?> 		
