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
    <title>吱吱課評網 - 編輯個人資料</title>
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
            {
                alert("本名不可以空白哦！");
                return false;
            }
            if (document.myForm.nickname.value.length == 0)
            {
                alert("暱稱不可以空白哦！");
                return false;
            }
            
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
                        編輯個人資料
                        </h1>

                        <!-- Text -->
                        <p class="font-size-lg text-white-75 mb-0"><?php echo "編輯 ".$member_name." 的個人資料";?></p>
                    
                    </div>
                </div> <!-- / .row -->
            </div> <!-- / .container -->
        </div>

        <main class="pb-8 pb-md-11 mt-md-n6 alter-page-main">
            <div class="container-md">
                <div class="row">
                    <div class="col-md-3 alter-page-list">
                        
                            <div class="list-group" id="list-tab" role="tablist">
                                <a class="list-group-item list-group-item-action active" id="list-home-list" data-toggle="list" href="#list-home" role="tab" aria-controls="home">更改會員資料</a>
                                <a class="list-group-item list-group-item-action" id="list-profile-list" data-toggle="list" href="#list-profile" role="tab" aria-controls="profile">更改密碼</a>
                            </div>
                        
                    </div>    
          
                    <div class="col-md-9">

                        <div class="tab-content" id="nav-tabContent">   
                            <div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
                                <!-- Card -->
                                <div class="card alter-page-card-big">
                                    <div class="card-header alter-page-card-small">

                                        <!-- Heading -->
                                        <h4 class="mb-0">基本資料</h4>

                                    </div>
                                    <div class="card-body alter-page-card-small">
                                            <!-- Form -->
                                            <form name='myForm' method='post' action='update_account.php'>
                                                <div class="row">
                                                    <div class="col-md-12">

                                                        <?php $detail = mysqli_fetch_array($result2, MYSQLI_ASSOC); ?>
                                                        <!-- sid -->
                                                        <div class="form-group">
                                                            <label for="sid">*學號（無法更改）</label>
                                                            <?php echo"<input class='form-control' id='sid' type='text' name='sid' readonly='readonly' value=".$detail["SId"].">"; ?>
                                                        </div>

                                                        <!-- name -->
                                                        <div class="form-group">
                                                            <label for="name">*本名</label>
                                                            <?php echo"<input class='form-control' id='name' type='text' name='name' value=".$detail["Name"].">"; ?>
                                                        </div>

                                                        <!-- nickname -->
                                                        <div class="form-group alter-inputbar-margin">
                                                            <label for="nickname">暱稱</label>
                                                            <?php echo"<input class='form-control' id='nickname' type='text' name='nickname' value=".$detail["NickName"].">"; ?>
                                                        </div>
                                                        <div class="form-group alter-inputbar-margin">
                                                            <label for="email">email</label>
                                                            <?php echo"<input class='form-control' id='esmail' type='email' name='email' value=".$detail["email"].">"; ?>
                                                        </div>
                                                        <button type="reset" class="btn btn-primary reset" value="重新重填">重填</button>
						                                <button type="button" class="btn btn-primary submit" value="儲存" onClick="check_data()">儲存</button>
                                                    </div>
                                                    
                                                </div>
                                            </form>                                        
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">
                            <div class="card alter-page-card-big">
                                    <div class="card-header alter-page-card-small">

                                        <!-- Heading -->
                                        <h4 class="mb-0">更改密碼</h4>

                                    </div>
                                    <div class="card-body alter-page-card-small">
                                            <!-- Form -->
                                            <form name='myForm2' method='post' action='update_password.php'>
                                                <div class="row">
                                                    <div class="col-md-12">

                                                        <!-- password -->
                                                        <div class="form-group">
                                                            <label for="password">新密碼</label>
                                                            <input class="form-control" id="password" type="password" name="password">
                                                        </div>

                                                        <!-- re_password -->
                                                        <div class="form-group alter-inputbar-margin">
                                                            <label for="re_password">新密碼確認</label>
                                                            <input class="form-control" id="re_password" type="password" name="re_password">
                                                        </div>
                                                        <button type="reset" class="btn btn-primary reset" value="重新重填">重填</button>
						                                <button type="button" class="btn btn-primary submit" value="確認更改" onClick="check_password()">確認更改</button>
                                                    </div>
                                                    
                                                </div>
                                            </form>                                        
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