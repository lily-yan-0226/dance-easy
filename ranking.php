<!DOCTYPE html>
<?php
    if(isset($_COOKIE["passed"]) != "TRUE"){
        $passed = " ";
        $sid = " ";
    }
    else{
        $passed = $_COOKIE["passed"];
        $sid = $_COOKIE["SId"];
    }

    require_once("connect_db.inc.php");
    header("Content-type: text/html; charset=utf-8");
    $link = create_connection();
    $sql = "SELECT * FROM member WHERE SId = '$sid' ";
    $sql2 = "SELECT * FROM member WHERE SId = '$sid' ";
    $result = execute_sql($link, "group_project", $sql);
    $result2 = execute_sql($link, "group_project", $sql2);
?>
<html>
<head>
    <meta charset="UTF-8">
    <title>吱吱課評網 - 排行榜</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+TC:wght@100;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/e3962a2758.js" crossorigin="anonymous"></script>
    <script defer src="/fontawesome-free-5.13.0-web/js/all.js"></script>
    <script src="http://code.jquery.com/jquery-3.2.0.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" type="text/css" href="notify.css">
    <script type="text/javascript" src="utility.js"></script>
    <script type="text/javascript" src="bell.js"></script>
    <script type="text/javascript" src="Notification.js"> </script>

    <script type="text/javascript">
        function check_data()
        {
            if (document.myForm.name.value.length == 0)
                alert("本名不可以空白哦！");
            else 
                myForm.submit();
        }
        function check_password()
        {
            if (document.myForm2.password.value != document.myForm2.re_password.value)
			{
				alert("「密碼確認」欄位與「密碼」欄位一定要相同...");
				return false;
			}
            myForm2.submit();
        }
    </script>

</head>
<body class='font'>
    <section>
        <nav class="navbar navbar-expand-lg navbar-light bg-light navbar-bg fixed-top">
            <a class="navbar-brand" href="homepage.php"><img src="logo_black.png" width="110" height="35" loading="lazy"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="course.php">課程列表</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="ranking.php">排行榜</a>
                </li>

                <?php
                    if($passed != " "){
                    $member_name = mysqli_fetch_object($result)->NickName;
                ?>
                    <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php echo "嗨！".$member_name;?>
                    </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="alter_account.php">編輯個人資料</a>
                            <a class="dropdown-item" href="friend.php">好友列表</a>
                            <a class="dropdown-item" href="users_save_course.php">我的收藏</a>
                            <form method="post" action="logout.php">
                                <button class="dropdown-item" name='logout'>登出</button>
                            </form>
                        </div>
                    </li>

                    <li class="nav-item dropdown" >
                  <a class="nav-link" href="#" id="notice_dropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-bell"></i>
                  </a>
                    <ul class="dropdown-menu myDropDown" id="notice">
                      <li class="head text-light bg-dark">
                        <div class="row">
                          <div class="col-lg-12 col-sm-12 col-12">
                            <span id="span_news"></span>
                            <button onclick="startRequest_bell()" class="float-right text-light btn" style='padding:0px;'>Delete all</button>
                          </div>
                          </div>
                     </li>
                          <div class="notification-box" id="new_notice"></div>
                        

                    </ul>
                </li>
                <?php    
                    }
                ?>
                

                </ul>
                <?php
                    if($passed == " "){
                ?>
                        <button type="button" class="btn btn2 btn-primary" onclick="window.location.href='login.html'">login<i class="fas fa-arrow-right arrow"></i></button>
                <?php
                    }
                ?>  
            </div>
        </nav>
    </section>
    <section id='alter-page'>
        <div class="jumbotron alter-page-header">
            <div class="container-md">
                <div class="row align-items-center">
                    <div class="col">

                        <!-- Heading -->
                        <h1 class="font-weight-bold text-white mb-2">
                        排行榜
                        </h1>
                    
                    </div>
                </div> <!-- / .row -->
            </div> <!-- / .container -->
        </div>

        <main class="pb-8 pb-md-11 mt-md-n6 alter-page-main">
            <div class="container-md">
                <div class="row">
                    <div class="col-md-3 alter-page-list">
                        
                            <div class="list-group" id="list-tab" role="tablist">
                                <a class="list-group-item list-group-item-action active" id="list-sweet-list" data-toggle="list" href="#list-sweet" role="tab" aria-controls="sweet">甜度排名</a>
                                <a class="list-group-item list-group-item-action" id="list-prac-list" data-toggle="list" href="#list-prac" role="tab" aria-controls="prac">實用度排名</a>
                                <a class="list-group-item list-group-item-action" id="list-hard-list" data-toggle="list" href="#list-hard" role="tab" aria-controls="hard">難度排名</a>
                                <a class="list-group-item list-group-item-action" id="list-save-list" data-toggle="list" href="#list-save" role="tab" aria-controls="save">收藏數排名</a>
                            </div>
                        
                    </div>    
          
                    <div class="col-md-9">

                        <div class="tab-content" id="nav-tabContent">   
                            <div class="tab-pane fade show active" id="list-sweet" role="tabpanel" aria-labelledby="list-sweet-list">
                                <!-- Card -->
                                <div class="card alter-page-card-big">
                                    <div class="card-header alter-page-card-small">
                                        <div class = "row">
                                            <div class = "col-md-1">排名</div>
                                            <div class = "col-md-2">課程代號</div>
                                            <div class = "col-md-2">開課系所</div>  
                                            <div class = "col-md-4">課程名稱</div>
                                            <div class = "col-md-3">授課老師</div>                                     
                                        </div>
                                    </div>
                                    <div class="card-body alter-page-card-small">
                                        <div class="row">
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
                                                $sql = "SELECT A.Cname, AVG(B.Score) AS AVERAGER, A.CId, A.Category, T.trName
                                                FROM course AS A LEFT JOIN comments AS B ON B.CId = A.CId LEFT JOIN teacher AS T ON A.CId = T.CId
                                                GROUP BY A.CId
                                                ORDER BY AVG(B.Score) DESC, A.CId LIMIT 10";
                                                mysqli_query($con, "SET CHARACTER SET utf8");
                                                mysqli_query($con,  "SET collation_connection = 'utf8_general_ci'");
                                                $result = mysqli_query($con, $sql);
                                                $ID = array();
                                                $categorys = array();
                                                $names = array();
                                                $teachers = array();
                                                $i = 1;

                                                if (!$result) {
                                                    echo ("錯誤：" . mysqli_error($con));
                                                    exit();
                                                }

                                                while ($row = mysqli_fetch_array($result)) {
                                                    $ID[$i] = $row['CId'];
                                                    $categorys[$i] = $row['Category'];
                                                    $names[$i] = $row['Cname'];
                                                    $teachers[$i] = $row['trName'];
                                                    $i++;
                                                }



                                                mysqli_close($con); // 連線結束
                                                for($i = 1; $i < 11; $i++){
                                            ?>
                                                <div class = "col-md-12 hover-color"> <?php echo"<a href='comment.php? CId=" . 
                                                    $ID[$i] . "&Cname=" . urlencode($names[$i]) . 
                                                    "&Category=" . $categorys[$i]."' style='text-decoration:none; color:black; background-color: #ffff99' >"; ?>
                                                    <div class = "row">
                                                        <div class="col-md-1"><?php echo $i; ?></div>
                                                        <div class="col-md-2"><?php echo $ID[$i]; ?></div>
                                                        <div class="col-md-2"><?php echo $categorys[$i]; ?></div>
                                                        <div class="col-md-4"><?php echo $names[$i]; ?></div>
                                                        <div class="col-md-3"><?php echo $teachers[$i];  ?></div>
                                                    </div>
                                                    </a>
                                                </div>
                                                <hr>
                                                <?php  } ?>
                                        </div>    
                                    </div>  
                                </div>  
                            </div>                     
                            <div class="tab-pane fade" id="list-prac" role="tabpanel" aria-labelledby="list-prac-list">
                                  <!-- Card -->
                                <div class="card alter-page-card-big">
                                    <div class="card-header alter-page-card-small">                                     
                                        <div class = "row">
                                            <div class = "col-md-1">排名</div>
                                            <div class = "col-md-2">課程代號</div>
                                            <div class = "col-md-2">開課系所</div>  
                                            <div class = "col-md-4">課程名稱</div>
                                            <div class = "col-md-3">授課老師</div>                                     
                                        </div>
                                    </div>
                                    <div class="card-body alter-page-card-small">
                                        <div class="row">
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
                                                $sql = "SELECT A.Cname, AVG(B.Practicality) AS AVERAGER, A.CId, A.Category, T.trName
                                                FROM course AS A LEFT JOIN comments AS B ON B.CId = A.CId LEFT JOIN teacher AS T ON A.CId = T.CId
                                                GROUP BY A.CId
                                                ORDER BY AVG(B.Practicality) DESC, A.CId LIMIT 10";
                                                mysqli_query($con, "SET CHARACTER SET utf8");
                                                mysqli_query($con,  "SET collation_connection = 'utf8_general_ci'");
                                                $result = mysqli_query($con, $sql);
                                                $ID = array();
                                                $categorys = array();
                                                $names = array();
                                                $teachers = array();
                                                $i = 1;

                                                if (!$result) {
                                                    echo ("錯誤：" . mysqli_error($con));
                                                    exit();
                                                }

                                                while ($row = mysqli_fetch_array($result)) {
                                                    $ID[$i] = $row['CId'];
                                                    $categorys[$i] = $row['Category'];
                                                    $names[$i] = $row['Cname'];
                                                    $teachers[$i] = $row['trName'];
                                                    $i++;
                                                }



                                                mysqli_close($con); // 連線結束
                                                for($i = 1; $i < 11; $i++){
                                            ?>
                                                <div class = "col-md-12 hover-color"> <?php echo"<a href='comment.php? CId=" . 
                                                    $ID[$i] . "&Cname=" . urlencode($names[$i]) . 
                                                    "&Category=" . $categorys[$i]."' style='text-decoration:none; color:black;' >"; ?>
                                                    <div class = "row">
                                                        <div class="col-md-1"><?php echo $i; ?></div>
                                                        <div class="col-md-2"><?php echo $ID[$i]; ?></div>
                                                        <div class="col-md-2"><?php echo $categorys[$i]; ?></div>
                                                        <div class="col-md-4"><?php echo $names[$i]; ?></div>
                                                        <div class="col-md-3"><?php echo $teachers[$i];  ?></div>
                                                    </div>
                                                    </a>
                                                </div>
                                                <hr>
                                                <?php } ?>
  
                                        </div>
                                    </div>  
                                </div>
                            </div>
                            <div class="tab-pane fade" id="list-hard" role="tabpanel" aria-labelledby="list-hard-list">
                                <!-- Card -->
                                <div class="card alter-page-card-big">
                                    <div class="card-header alter-page-card-small">
                                        <div class = "row">
                                            <div class = "col-md-1">排名</div>
                                            <div class = "col-md-2">課程代號</div>
                                            <div class = "col-md-2">開課系所</div>  
                                            <div class = "col-md-4">課程名稱</div>
                                            <div class = "col-md-3">授課老師</div>                                     
                                        </div>
                                    </div>
                                    <div class="card-body alter-page-card-small">
                                        <div class="row">
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
                                                $sql = "SELECT A.Cname, AVG(B.Qhard) AS AVERAGER, A.CId, A.Category, T.trName
                                                FROM course AS A LEFT JOIN comments AS B ON B.CId = A.CId LEFT JOIN teacher AS T ON A.CId = T.CId
                                                GROUP BY A.CId
                                                ORDER BY AVG(B.Qhard) DESC, A.CId LIMIT 10";
                                                mysqli_query($con, "SET CHARACTER SET utf8");
                                                mysqli_query($con,  "SET collation_connection = 'utf8_general_ci'");
                                                $result = mysqli_query($con, $sql);
                                                $ID = array();
                                                $categorys = array();
                                                $names = array();
                                                $teachers = array();
                                                $i = 1;

                                                if (!$result) {
                                                    echo ("錯誤：" . mysqli_error($con));
                                                    exit();
                                                }

                                                while ($row = mysqli_fetch_array($result)) {
                                                    $ID[$i] = $row['CId'];
                                                    $categorys[$i] = $row['Category'];
                                                    $names[$i] = $row['Cname'];
                                                    $teachers[$i] = $row['trName'];
                                                    $i++;
                                                }



                                                mysqli_close($con); // 連線結束
                                                for($i = 1; $i < 11; $i++){
                                            ?>
                                                <div class = "col-md-12 hover-color"> <?php echo"<a href='comment.php? CId=" . 
                                                    $ID[$i] . "&Cname=" . urlencode($names[$i]) . 
                                                    "&Category=" . $categorys[$i]."' style='text-decoration:none; color:black;' >"; ?>
                                                    <div class = "row">
                                                        <div class="col-md-1"><?php echo $i; ?></div>
                                                        <div class="col-md-2"><?php echo $ID[$i]; ?></div>
                                                        <div class="col-md-2"><?php echo $categorys[$i]; ?></div>
                                                        <div class="col-md-4"><?php echo $names[$i]; ?></div>
                                                        <div class="col-md-3"><?php echo $teachers[$i];  ?></div>
                                                    </div>
                                                    </a>
                                                </div>
                                                <hr>
                                                <?php } ?>
  
                                        </div>
                                    </div>  
                                </div>  
                            </div>
                            <div class="tab-pane fade" id="list-save" role="tabpanel" aria-labelledby="list-save-list">
                                <!-- Card -->
                                <div class="card alter-page-card-big">
                                    <div class="card-header alter-page-card-small">
                                        <div class = "row">
                                            <div class = "col-md-1">排名</div>
                                            <div class = "col-md-2">課程代號</div>
                                            <div class = "col-md-2">開課系所</div>  
                                            <div class = "col-md-4">課程名稱</div>
                                            <div class = "col-md-3">授課老師</div>                                     
                                        </div>
                                    </div>
                                    <div class="card-body alter-page-card-small">
                                        <div class="row">
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
                                                $sql = "SELECT A.Cname, COUNT(B.CId) AS COUNTER, A.CId, A.Category, T.trName
                                                FROM course AS A LEFT JOIN comments AS B ON B.CId = A.CId LEFT JOIN teacher AS T ON A.CId = T.CId
                                                GROUP BY A.CId
                                                ORDER BY COUNT(B.CId) DESC, A.CId LIMIT 10";
                                                mysqli_query($con, "SET CHARACTER SET utf8");
                                                mysqli_query($con,  "SET collation_connection = 'utf8_general_ci'");
                                                $result = mysqli_query($con, $sql);
                                                $ID = array();
                                                $categorys = array();
                                                $names = array();
                                                $teachers = array();
                                                $i = 1;

                                                if (!$result) {
                                                    echo ("錯誤：" . mysqli_error($con));
                                                    exit();
                                                }

                                                while ($row = mysqli_fetch_array($result)) {
                                                    $ID[$i] = $row['CId'];
                                                    $categorys[$i] = $row['Category'];
                                                    $names[$i] = $row['Cname'];
                                                    $teachers[$i] = $row['trName'];
                                                    $i++;
                                                }



                                                mysqli_close($con); // 連線結束
                                                for($i = 1; $i < 11; $i++){
                                            ?>
                                               <div class = "col-md-12 hover-color"> <?php echo"<a href='comment.php? CId=" . 
                                                    $ID[$i] . "&Cname=" . urlencode($names[$i]) . 
                                                    "&Category=" . $categorys[$i]."' style='text-decoration:none; color:black;' >"; ?>
                                                    <div class = "row">
                                                        <div class="col-md-1"><?php echo $i; ?></div>
                                                        <div class="col-md-2"><?php echo $ID[$i]; ?></div>
                                                        <div class="col-md-2"><?php echo $categorys[$i]; ?></div>
                                                        <div class="col-md-4"><?php echo $names[$i]; ?></div>
                                                        <div class="col-md-3"><?php echo $teachers[$i];  ?></div>
                                                    </div>
                                                    </a>
                                                </div>
                                                <hr>
                                                <?php } ?>
  
                                        </div>
                                    </div>  
                                </div>  
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </main>
    </section>

    
    <section id='homepage-footer'>
        <div class='container'>
            <div class='row'>
                <div class='col-md-4'>
                    <img src="logo_white.png" width="130" height="40" class='footer-logo'><br><br>
                    <span class='footer-content'><i class="fas fa-map-marker-alt footer-icon"></i>804高雄市鼓山區蓮海路70號</span><br>
                    <span class='footer-content'><i class="fas fa-location-arrow footer-icon"></i>國立中山大學 資訊管理學系</span><br>
                    <span class='footer-content'><i class="fas fa-phone-alt footer-icon"></i>0907299297</span><br>
                </div>
            </div>
            <div class='row'>
                <div class='col-md-12'>
                    <p class='footer-content creative-right text-cn'>©DBMS team number 7 final project. All rights reserved.</p>
                </div>
            </div>
        </div>

    </section>
</body>
</html>