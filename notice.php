<?php
      $sid = $_COOKIE{"SId"};

      require_once("connect_db.inc.php");
      $link = create_connection();
					
      //執行SQL查詢
      $sql = "SELECT * FROM `notice` WHERE`SId`='$sid' ORDER BY `time` DESC";
      $result = execute_sql($link, "group_project", $sql);

      $dataarr = array();
      while($row = mysqli_fetch_array($result)){
        array_push($dataarr, $row);
      }
      
      mysqli_close($link);
      echo json_encode($dataarr);

    
?> 		
