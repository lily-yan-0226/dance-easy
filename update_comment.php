<?php
    require_once("connect_db.inc.php");
    header("Content-type: text/html; charset=utf-8");
      
    //取得表單資料	

    $sid = $_COOKIE["SId"]; 
    $Score = $_POST["Srating"];
    $Qhard = $_POST["Hrating"];
    $Practicality = $_POST["Prating"];
    $Word = $_POST["Word"];
    $Times=$_COOKIE["Times"];
    //建立資料連接
    $link = create_connection();
                      
    //檢查評論是否正確
    $sql = "UPDATE `comments` SET `Score`='$Score',`Qhard`='$Qhard',`Practicality`='$Practicality',`Word`='$Word' 
            WHERE SId = '$sid' AND Times='$Times'";
    $result = execute_sql($link, "group_project", $sql);

    

    if(mysqli_query($link, $sql )){
        echo '<script language="javascript">';
        echo 'alert("評論更改成功！");';
        echo "window.location.href='comment.php'";
        echo '</script>'; 
    }
?>