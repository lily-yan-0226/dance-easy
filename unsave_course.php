<?php
  require_once("connect_db.inc.php");

  $SId = $_COOKIE{"SId"};
  $CId =  isset( $_GET["CId"]) ? $_GET["CId"]:$_COOKIE{"CId"};
  $Cname = isset( $_GET["Cname"]) ? $_GET["Cname"]:$_COOKIE{"Cname"};
  $Category = isset( $_GET["Category"]) ? $_GET["Category"]:$_COOKIE{"Category"};
  $current_time = date("Y-m-d H:i:s");
  
  $link = create_connection();
  
  $sql ="DELETE FROM `savecourse` WHERE SId='$SId' AND CId='$CId'";
  $result = execute_sql($link, "group_project", $sql);
  
  echo "&nbsp;&nbsp;&nbsp;&nbsp;已取消收藏~";


?>