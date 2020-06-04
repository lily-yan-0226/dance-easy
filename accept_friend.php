<?php
  require_once("connect_db.inc.php");
		
  $SId = $_COOKIE{"SId"};
  $friend =$_GET{"friend"};
  $current_time = date("Y-m-d H:i:s");

  $link = create_connection();
  
  $sql = "INSERT INTO `friendship`(`SId`, `friend`, `if_friend`, `time`) VALUES ('$SId','$friend',true,'$current_time')";
  $result = execute_sql($link, "group_project", $sql);



  mysqli_close($link);
  header("location:friend.php");
  exit();
  
 

 

?>