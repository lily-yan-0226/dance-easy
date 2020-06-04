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
    $result = execute_sql($link, "group_project", $sql);
?>
<html>
<head>
    <meta charset="UTF-8">
    <title>吱吱課評網</title>
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

    <section id='homepage-banner'>    
        <div class='jumbotron home-jumbotron'>
            <div class='container'>
                <div class='row'>
                    <div class='col-md-6'>
                        
                    </div>
                    <div class='col-md-6 top_text'>
                        <h1 class='homepage-jumbotron-topic'>Study With Me!</h1>
                        <p class='homepage-jumbotron-content'>專為中山人設計的課程評論網站<br>現在加入吱吱課評網，一起修好課！</p>
                        <?php
                            if($passed == " "){
                        ?>
                            <button type="button" class="btn btn1 btn-primary" onclick="window.location.href='login.html'">Get started</button>
                        <?php
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id='homepage-intro'>
        <div class='container'>
            <div class='row'>
                <div class='col-md-12'>
                    <h3 class='text-cn'>吱吱帶你修好課！</h3>
                </div>
            </div>
            <div class='row'>
                <div class='col-md-2 offset-md-2'>
                    <div class='text-cn'>
                        <img src="zhizhi.png" class='zhizhi-pic rounded-circle' alt="猴子頭像">
                        <h6>吱吱</h6>
                    </div>
                </div>
                <div class='col-md-6'>
                    <p>找不到理想的課程嗎？找吱吱就對了！吱吱課評網整理了中山大學的課程，並結合評論功能，包括甜度、實用度、輕鬆度評分，
                        讓同學來告訴你真實的課程狀況！</p>
                    <p>現在加入會員，你可以查看課程列表並瀏覽評論，還能收藏自己喜歡的課程、加好友並查看好友收藏的課程喔！</p>
                    
                </div>
        
            </div>
        </div>
    </section>
    
    <?php
        require_once("connect_db.inc.php");
        // header("Content-type: text/html; charset=utf-8");
        $link = create_connection();
        $sql = "SELECT A.CId, A.Category, COUNT(B.CId) AS COUNTER, A.Cname, C.trName
						FROM course AS A LEFT JOIN savecourse AS B ON B.CId = A.CId LEFT JOIN teacher AS C ON A.CId = C.CId
						WHERE 1 = 1
						GROUP BY A.CId
                        ORDER BY COUNT(B.CId) DESC, A.CId LIMIT 4";
        // $sql2 = "SELECT * FROM course";
        $result = execute_sql($link, "group_project", $sql);
        // $result1= execute_sql($link, "group_project", $sql1);

        $names = array();
		$counts = array();
        $teachers = array();
        $cid = array();
        $category = array();
        $i = 0;
        
        if(!$result){
            printf("Error: %s\n", mysqli_error($link));
            exit();
        }
        while($row = mysqli_fetch_assoc($result)){
            $names[$i] = $row['Cname'];
            $counts[$i] = $row['COUNTER'];
            $teachers[$i] = $row['trName'];
            $cid[$i] = $row['CId'];
            $category[$i] = $row['Category'];
            $i++;
        } 
        // $row2 = mysqli_fetch_assoc($result2);
      
        
        
        
    ?>
    <section id='homepage-rank'>    
        <div class='container'>
            <div class='row'>
                <div class='col-md-12'>
                    <h3 class='text-cn'>熱門課程排行</h3>
                </div>
            </div>
            <div class='row'>
                <div class='col-md-3'>
                    <div class='outer'>
                        <div class='upper'>
                            <div class="card">
                                <div class='card-header text-cn'>                                                                    
                                    <span class="fa-layers fa-fw fa-3x">
                                        <i class="fas fa-crown gold-crown"></i>
                                        <span class="fa-layers-text fa-inverse crown-text" data-fa-transform="shrink-10 down-1">1</span>
                                    </span>                                             
                                    <h5 class='rank-course-name'><?php echo $names[0];?></h5>
                                </div>
                                <div class="card-body">
                                    <span><i class="fas fa-chalkboard-teacher"></i>&nbsp;&nbsp;授課老師：<?php echo $teachers[0];?></span><br>
                                    <span><i class="fas fa-bookmark"></i>&nbsp;&nbsp;收藏數：<?php echo $counts[0];?></span><br><br>
                                    <div class='text-cn'><?php echo "<a href='comment.php?CId=".$cid[0]."&Cname=".urlencode($names[0])."&Category=".$category[0]."' class='btn btn-primary blue-btn'>點擊看評論</a>";?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class='col-md-3'>
                    <div class='outer'>
                        <div class='upper'>
                            <div class="card">
                                <div class='card-header text-cn'>                                                                    
                                    <span class="fa-layers fa-fw fa-3x">
                                        <i class="fas fa-crown silver-crown"></i>
                                        <span class="fa-layers-text fa-inverse crown-text" data-fa-transform="shrink-10 down-1">2</span>
                                    </span>                                             
                                    <h5 class='rank-course-name'><?php echo $names[1];?></h5>
                                </div>
                                <div class="card-body">
                                    <span><i class="fas fa-chalkboard-teacher"></i>&nbsp;&nbsp;授課老師：<?php echo $teachers[1];?></span><br>
                                    <span><i class="fas fa-bookmark"></i>&nbsp;&nbsp;收藏數：<?php echo $counts[1];?></span><br><br>
                                    <div class='text-cn'><?php echo "<a href='comment.php?CId=".$cid[1]."&Cname=".urlencode($names[1])."&Category=".$category[1]."' class='btn btn-primary blue-btn'>點擊看評論</a>";?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class='col-md-3'>
                    <div class='outer'>
                        <div class='upper'>
                            <div class="card">
                                <div class='card-header text-cn'>                                                                    
                                    <span class="fa-layers fa-fw fa-3x">
                                        <i class="fas fa-crown bronze-crown"></i>
                                        <span class="fa-layers-text fa-inverse crown-text" data-fa-transform="shrink-10 down-1">3</span>
                                    </span>                                             
                                    <h5 class='rank-course-name'><?php echo $names[2];?></h5>
                                </div>
                                <div class="card-body">
                                    <span><i class="fas fa-chalkboard-teacher"></i>&nbsp;&nbsp;授課老師：<?php echo $teachers[2];?></span><br>
                                    <span><i class="fas fa-bookmark"></i>&nbsp;&nbsp;收藏數：<?php echo $counts[2];?></span><br><br>
                                    <div class='text-cn'><?php echo "<a href='comment.php?CId=".$cid[2]."&Cname=".urlencode($names[2])."&Category=".$category[2]."' class='btn btn-primary blue-btn'>點擊看評論</a>";?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class='col-md-3'>
                    <div class='outer'>
                        <div class='upper'>
                            <div class="card">
                                <div class='card-header text-cn'>                                                                    
                                    <span class="fa-layers fa-fw fa-3x">
                                        <i class="fas fa-crown red-bronze-crown"></i>
                                        <span class="fa-layers-text fa-inverse crown-text" data-fa-transform="shrink-10 down-1">4</span>
                                    </span>                                             
                                    <h5 class='rank-course-name'><?php echo $names[3];?></h5>
                                </div>
                                <div class="card-body">
                                    <span><i class="fas fa-chalkboard-teacher"></i>&nbsp;&nbsp;授課老師：<?php echo $teachers[3];?></span><br>
                                    <span><i class="fas fa-bookmark"></i>&nbsp;&nbsp;收藏數：<?php echo $counts[3];?></span><br><br>
                                    <div class='text-cn'><?php echo "<a href='comment.php?CId=".$cid[3]."&Cname=".urlencode($names[3])."&Category=".$category[3]."' class='btn btn-primary blue-btn'>點擊看評論</a>";?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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