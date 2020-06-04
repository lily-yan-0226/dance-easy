<?php
  require_once("connect_db.inc.php");
  date_default_timezone_set("Asia/Taipei");
		
  $SId = $_COOKIE{"SId"};
  $friend =$_COOKIE{"friend"};
  $current_time = date("Y-m-d H:i:s");

  if($friend==null){
    echo "<script>alert('沒這個人喔!!?!');location.href='friend.php';</script>";
    exit();
  }
  if($friend==$SId){
    setcookie("friend", null);
    echo "<script>alert('不可以加自己為好友!!?!');location.href='friend.php';</script>";
    exit();
  }

  $link = create_connection();
  
  $sql = "INSERT INTO `friendship`(`SId`, `friend`, `if_friend`, `time`) 
    VALUES ('$SId','$friend',1,'$current_time')";
  $result = execute_sql($link, "group_project", $sql);
  

  $sql2="REPLACE INTO `notice`(`SId`, `title`, `content`,  `time`, `herf`) 
    VALUES ('$friend','好友邀請','$SId','$current_time','friend.php')";
  $result2 = execute_sql($link, "group_project", $sql2);

  $sql3="INSERT INTO `notification`(`SId`, `title`) VALUES ('$friend','好友邀請')";
  $result3 = execute_sql($link, "group_project", $sql3);

  


  
  

  

  
  setcookie("friend", null);


  mysqli_close($link);
  header("location:friend.php");
  exit();
 ?>
