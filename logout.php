<?php
    if(isset($_POST["logout"])){
        setcookie("SId", " ");
        setcookie("passed", " ");
        header("location:homepage.php");
}
?>