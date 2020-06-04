<?php 
        require_once("connect_db.inc.php");


        $SId = $_COOKIE{"SId"};
        $friend =$_GET{"friend"};
                
        $link = create_connection();

        $sql = "DELETE FROM `friendship` WHERE `SId`='$friend' AND `friend`='$SId'";
        $result = execute_sql($link, "group_project", $sql);

        $sql2 = "DELETE FROM `friendship` WHERE `SId`='$SId' AND `friend`='$friend'";
        $result2 = execute_sql($link, "group_project", $sql2);

        mysqli_close($link);
        header("location:friend.php");
        exit();
       
?>