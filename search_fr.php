<!DOCTYPE html>
<html lang="zh-TW">

<head>

    <meta charset="UTF-8">

</head>

<body>
<?php

// 定義資料庫資訊
$DB_NAME = "group_project";
$DB_USER = "mis";
$DB_PASS = "416";
$DB_HOST = "localhost";

// 連接 MySQL 資料庫伺服器
$con = mysqli_connect($DB_HOST, $DB_USER, $DB_PASS);
if (empty($con)) {
    print mysqli_error($con);
    die("資料庫連接失敗！");
    exit;
}

// 選取資料庫
if (!mysqli_select_db($con, $DB_NAME)) {
    die("選取資料庫失敗！");
}

// 設定連線編碼
mysqli_query($con, "SET NAMES 'UTF-8'");

if (isset($_GET['s'])) { // 如果有搜尋文字顯示搜尋結果

    $s = mysqli_real_escape_string($con, $_GET['s']);
    $sql = "SELECT * FROM member WHERE SId='$s'";
    $result = mysqli_query($con, $sql);

    // SQL 搜尋錯誤訊息
    if (!$result) {
        echo ("錯誤：" . mysqli_error($con));
        exit();
    }

    // 搜尋無資料時顯示「查無此人」
    if (mysqli_num_rows($result) <= 0) {
        echo "查無此人";
        setcookie("friend",null);
    }

    // 搜尋有資料時顯示搜尋結果
    while ($row = mysqli_fetch_array($result)) {
    
        echo "確認向： ";
        echo $row['SId']." ";
        echo $row['NickName']." ";
        echo "寄送邀請嗎?";

        setcookie("friend",$row['SId']);

    }

} else { // 如果沒有搜尋文字顯示所有資料

    echo "查無此人";
    setcookie("friend",null);

}



mysqli_close($con); // 連線結束



?>

</body>

</html>