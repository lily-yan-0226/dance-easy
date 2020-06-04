<?php
    require_once("connect_db.inc.php");
    header("Content-type: text/html; charset=utf-8");
    $link = create_connection();

    if(isset($_COOKIE["passed"]) != "TRUE"){
        $passed = " ";
        $sid = " ";
    }
    else{
        $passed = $_COOKIE["passed"];
        $sid = $_COOKIE["SId"];
    }

    $Times=$_GET["Times"];

    $sql = "DELETE FROM `comments` WHERE sid='$sid' AND Times='$Times'";
    $result = execute_sql($link, "group_project", $sql);

    if(mysqli_query($link, $sql )){
        echo '<script language="javascript">';
        echo 'alert("評論刪除成功！");';
        echo "window.location.href='comment.php'";
        echo '</script>'; 
    }
?>