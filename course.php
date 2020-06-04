<!DOCTYPE html>
<?php
    // check login status
    if(isset($_COOKIE["passed"]) != "TRUE"){
        $passed = " ";
        $sid = " ";
    }
    else{
        $passed = $_COOKIE["passed"];
        $sid = $_COOKIE["SId"];
    }

    // check course searching status
    if(!isset($_COOKIE["category"])){
        $category_cookie = "default";
    }
    else $category_cookie = $_COOKIE["category"];

    if(!isset($_COOKIE["course_name"])){
        $search_cookie = " ";
    }
    else $search_cookie = $_COOKIE["course_name"];

    require_once("connect_db.inc.php");
    header("Content-type: text/html; charset=utf-8");
    $link = create_connection();
    $sql = "SELECT * FROM member WHERE SId = '$sid' ";
    $sql3 = "SELECT * FROM course WHERE Category = '$category_cookie' ";
    $result = execute_sql($link, "group_project", $sql);
    $result3 = execute_sql($link, "group_project", $sql3);
?>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <title>吱吱課評網 - 課程列表</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+TC:wght@100;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/e3962a2758.js" crossorigin="anonymous"></script>
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
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
            if ((document.search-course.category.value != "default") || (document.search-course.search_bar.value.length != 0))
            {
                search-course.submit();
            } 
        }
    </script>
</head>
<body class='font course-section'>
    <section>
        <nav class="navbar navbar-expand-lg navbar-light bg-light navbar-bg fixed-top">
            <a class="navbar-brand" href="homepage.php"><img src="logo_black.png" width="110" height="35" loading="lazy"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav" style='width:93%;'>
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
                <li class='nav-item ml-2' style='width:60%;'>
                    <form name='search-course' method='post' action='course_searching.php' class="form-inline my-2 my-lg-0" style='width:100%;'>
                    <!-- class="form-control" -->
                    <input  class="form-control" style='width: 100%;' type="text" placeholder="輸入你想搜尋的課程" name='search_bar' id="search_bar"/>
    
                    
                
                </form>
                    </li>
                

                </ul>
                
    
                    <?php
                    if($passed == " "){
                ?>
                        <button type="button" class="btn btn2 btn-primary mr-0" onclick="window.location.href='login.html'">login<i class="fas fa-arrow-right arrow"></i></button>
                <?php
                    }
                ?>  
                
               
            </div>
        </nav>
    </section>
    <section id='course-page-jumbotron'>
        <div class="jumbotron alter-page-header">
            <div class="container-md">
                <div class="row align-items-center">
                    <div class="col text-cn text-white">

                        <!-- Heading -->
                        <h1 class="font-weight-bold mb-2">
                        課程列表
                        </h1>
            
                    </div>
                </div> <!-- / .row -->
            </div> <!-- / .container -->
        </div>
    </section>
    
    <section id='course-page-middle'>
        <div class='container-md'>
            <div class='row'>
                <div class='col-md-12'>
                    <div id="search_result"></div>
                    <script>
                        $(document).ready(function () {

                            load_data();

                            function load_data(query) {
                                $.ajax({
                                    url: "search.php",
                                    method: "GET",
                                    data: {
                                        s: query
                                    },
                                    success: function (data) {
                                        $('#search_result').html(data);
                                    }
                                });
                            }
                            $('#search_bar').keyup(function () {
                                var search = $(this).val();
                                if (search != '') {
                                    load_data(search);
                                } else {
                                    load_data();
                                }
                            });
                        });
                    </script>   
                    
                        
                    
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