<!DOCTYPE html>
<html lang="zh-TW">

<head>

    <meta charset="UTF-8">
    <script type="text/javascript">
        $(document).ready(function($) {
            $(".table-row").click(function() {
                window.document.location = $(this).data("href");
            });
        });
    </script>

</head>

<body>

<table class="table text-cn table-hover">
<thead>
<tr>
<th scope="col-md-3">課程代號</th>
<th scope="col-md-3">開課系所</th>
<th scope="col-md-3">課程名稱</th>
<th scope="col-md-3">授課老師</th>
</tr>
</thead>
<tbody>

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
    $sql = "SELECT * FROM course NATURAL JOIN teacher WHERE Category LIKE '%" . $s . "%' OR Cname LIKE '%" . $s . "%' 
            OR trName LIKE '%" . $s . "%' OR CID LIKE '%" . $s . "%'";
    $result = mysqli_query($con, $sql);

    // SQL 搜尋錯誤訊息
    if (!$result) {
        echo ("錯誤：" . mysqli_error($con));
        exit();
    }

    // 搜尋無資料時顯示「查無資料」
    if (mysqli_num_rows($result) <= 0) {
        echo "<tr><td colspan='4'>查無資料</td></tr>";
    }

    // 搜尋有資料時顯示搜尋結果
    while ($row = mysqli_fetch_array($result)) {
        echo "<tr class='table-row' style='cursor: pointer;' data-href='comment.php? CId=" . 
            $row["CId"] . "&Cname=" . urlencode($row["Cname"]) . 
            "&Category=" . $row["Category"]."' >";
        echo "<td>".$row["CId"]."</td>";
        echo "<td>".$row["Category"]."</td>";
        echo "<td>".$row["Cname"]."</td>";
        echo "<td>".$row["trName"]."</td>";
        echo "</tr>";

    }

} else { // 如果沒有搜尋文字顯示所有資料

    $sql = "SELECT * FROM course NATURAL JOIN teacher";
    $result = mysqli_query($con, $sql);

    if (!$result) {
        echo ("錯誤：" . mysqli_error($con));
        exit();
    }

    while ($row = mysqli_fetch_array($result)) {
        echo "<tr class='table-row' style='cursor: pointer;' data-href='comment.php? CId=" . 
            $row["CId"] . "&Cname=" . urlencode($row["Cname"]) . 
            "&Category=" . $row["Category"]."' >";
        echo "<td>".$row["CId"]."</td>";
        echo "<td>".$row["Category"]."</td>";
        echo "<td>".$row["Cname"]."</td>";
        echo "<td>".$row["trName"]."</td>";
        echo "</tr>";
    }

}

echo "</tbody></table>";

mysqli_close($con); // 連線結束

?>

</body>

</html>