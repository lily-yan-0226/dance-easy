<?php
  require_once("connect_db.inc.php");
  date_default_timezone_set("Asia/Taipei");
  $SId = $_COOKIE{"SId"};
  
  $CId = $_COOKIE{"CId"};
  $Cname = $_COOKIE["Cname"];
  $Category = $_COOKIE["Category"];
  
  $Score = $_POST["Srating"];
  $Hard = $_POST["Hrating"];
  $pr = $_POST["Prating"];
  $content = $_POST["content"];
  $current_time = date("Y-m-d H:i:s");

  //建立資料連接
  $link = create_connection();

  //執行SQL查詢
  $sql = "INSERT INTO `comments`(`SId`, `Times`, `CId`, `Score`, `Qhard`, `Practicality`, `Word`) 
          VALUES('$SId', '$current_time','$CId', '$Score','$Hard','$pr', '$content')";
  $result = execute_sql($link, "group_project", $sql);

  $sql3="SELECT SId FROM savecourse WHERE `CId`='$CId'";
  $result2 = execute_sql($link, "group_project", $sql3);
  $total_records3 = mysqli_num_rows($result2); 
  for ($i = 0; $i <$total_records3; $i++){

    $row = mysqli_fetch_assoc($result2);
    
    $s=$row['SId'];

    if($s==$SId){
      continue;
    }

    $sql2 = "REPLACE INTO `notice`(`SId`, `title`,  `content`, `time`, `herf`) 
          VALUES ('$s','有新留言了','$Cname','$current_time','comment.php?CId=$CId&Cname=$Cname&Category=$Category')";
    $result3 = execute_sql($link, "group_project", $sql2);

    $sql4="INSERT INTO `notification`(`SId`, `title`) VALUES ('$s','有新留言了')";
    $result4 = execute_sql($link, "group_project", $sql4);

  }



  

        

  //關閉資料連接
  mysqli_close($link);
  header("location:comment.php");
  exit();
  
 
 
?>
