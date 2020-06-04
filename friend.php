<?php
  //檢查 cookie 中的 passed 變數是否等於 TRUE 
  $passed = $_COOKIE{"passed"};
//   $total_new=isset( $_COOKIE{"total_new"}) ? $_COOKIE{"total_new"}:"0";

  //如果 cookie 中的 passed 變數不等於 TRUE
  //表示尚未登入網站，將使用者導向首頁 index.html
  if ($passed != "TRUE")
  {
    header("location:login.html");
    exit();
  }	

  //如果 cookie 中的 passed 變數等於 TRUE
  //表示已經登入網站，取得使用者資料	
  else
  {
    require_once("connect_db.inc.php");
		
    $sid = $_COOKIE{"SId"};
		
   
  } 
    require_once("connect_db.inc.php");
    header("Content-type: text/html; charset=utf-8");
    $link = create_connection();
    $sql = "SELECT * FROM member WHERE SId = '$sid' ";
    $result = execute_sql($link, "group_project", $sql);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>吱吱課評網 - 好友列表</title>
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
                        好友列表</h1>

                        <!-- Text -->
                      <p class="font-size-lg text-white-75 mb-0"><?php echo "查看 ".$member_name." 的好友列表";?></p>
                    
                    </div>
                </div> <!-- / .row -->
            </div> <!-- / .container -->
        </div>

        <main class="pb-8 pb-md-11 mt-md-n6 alter-page-main">
            <div class="container-md">
                <div class="row">
                    <div class="col-md-3 alter-page-list">
                        
                            <div class="list-group" id="list-tab" role="tablist">
                                <a class="list-group-item list-group-item-action active" id="list-home-list" data-toggle="list" href="#list-home" role="tab" aria-controls="home">我的好友&nbsp;</a>
                                <a class="list-group-item list-group-item-action" id="list-profile-list" data-toggle="list" href="#list-profile" role="tab" aria-controls="profile">新增好友&nbsp;</a>
                            </div>
                        
                    </div>    
          
                    <div class="col-md-9">

                        <div class="tab-content" id="nav-tabContent">   
                            <div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
                                <!-- Card -->
                                <div class="card alter-page-card-big">
                                    <div class="card-header alter-page-card-small">

                                        <!-- Heading -->
                                        <h4 class="mb-0">&nbsp;全部好友</h4>

                                    </div>
                                    <div class="card-body alter-page-card-small">
                                            <table class="table table-striped">
    <?php   
                //建立資料連接
                $link = create_connection();
							
                //篩選出所有產品資料
                $sql = "SELECT `SId`,`NickName` FROM `member` WHERE `SId` IN(SELECT `friend` FROM `friendship` 
                WHERE `if_friend`=1 
                AND friendship.SId='$sid' AND `friend` IN( SELECT friendship.SId FROM `friendship` 
                WHERE `if_friend`=1 AND `friend`='$sid' ))
                ";
                $result2 = execute_sql($link, "group_project", $sql);
                              
                //計算總記錄數
                $total_records = mysqli_num_rows($result2);  
                             
         //列出所有產品資料
         for ($i = 0; $i < $total_records; $i++)
         {
           //取得好友資料
           $row = mysqli_fetch_assoc($result2);
           echo "<form method='post' id='form2' name='fr' action='what_friends_save.php? friend=". 
           $row['SId']. " ' >";
           echo "<tr align='center' >";
           echo "<td>" . $row['SId'] . "</td>";			
           echo "<td>" . $row['NickName'] . "</td>";	
           echo "<td><input type='submit' class='see-fr-save-btn' value='查看好友收藏課程'> </td>";
           echo "<td><input type='submit' class='delete-fr-btn' value='絕交' formaction='delete_friend.php? friend=". 
           $row['SId']. " '> </td>";
           echo "</tr>";
           echo "</form>";
         }
    ?>
												
												
										</table>
                                            
                                                                                   
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">
                            <div class="card alter-page-card-big">
                                    <div class="card-header alter-page-card-small">

                                        <!-- Heading -->
                                        <h4 class="mb-0">新增好友</h4>

                                    </div>
                                    <div class="card-body alter-page-card-small">
                                        <div class='container-md'>
                                            <div class='row'>
                                                <div class='col-xs-3'>
                                                    <input id='friend' type='text' name='friend' placeholder='請輸入學號' class='search-fr-bar'>
                                                    <button id="send" type="button" data-toggle="modal" data-target="#myModal" class='see-fr-save-btn'>發送邀請</button>
                                                </div>
                                            </div>
                                        
	                                        <div class="modal fade" id="myModal">
	                                            <div class="modal-dialog">
	                                                <div class="modal-content">
	                                                    <div class="modal-header">
                                                            <h4>確認邀請</h4>
	                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
	                                                    </div>
                                                        <div class="modal-body" id="f_detail">
                                                        
                                                            <script>
                                                                function load_data(query) {
                                                                    $.ajax({
                                                                        url: "search_fr.php",
                                                                        method: "GET",
                                                                        data: {
                                                                            s: query
                                                                        },
                                                                        success: function (data) {
                                                                            $('#f_detail').html(data);
                                                                        }
                                                                    });
                                                                }
                                                                $('#send').click(function () {
                                                                    var search = $('#friend').val();
                                                                        if (search != '') {
                                                                            load_data(search);
                                                                        } 
                                                                        else{
                                                                            load_data();
                                                                        }
                                                                    $("#myModal").modal();
                                                                });
                                                            </script>
	                                                    </div>
	                                                    <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" onclick="location.href='new_friend.php'">確認</button>
	                                                    </div>
	                                                </div>
	                                            </div>
	                                        </div>
                                            <div class='row mt-4'>
                                                <h5 style='color:#000000;'>好友邀請：</h5>
                                            </div>
                                                <?php   
                                                    //建立資料連接
                                                    $link = create_connection();
                                                                
                                                    //篩選出所有好友邀請
                                                    $sql = "SELECT `SId`,`NickName` FROM `member` WHERE `SId` IN(SELECT `SId` FROM `friendship` 
                                                    WHERE `if_friend`=1 AND friendship.friend='$sid') 
                                                    EXCEPT (SELECT `SId`,`NickName` FROM `member` WHERE `SId` IN(SELECT `friend` FROM `friendship` 
                                                    WHERE `if_friend`=1 AND friendship.SId='$sid' AND `friend` IN( SELECT friendship.SId FROM `friendship` 
                                                    WHERE `if_friend`=1 AND `friend`='$sid' )) )";
                                                    $result4 = execute_sql($link, "group_project", $sql);
                                                                
                                                    //計算總記錄數
                                                    $total_records2 = mysqli_num_rows($result4);  
                                                                
                                                    //列出所有產品資料
                                                    for ($i = 0; $i < $total_records2; $i++)
                                                    {
                                                        //取得好友資料
                                                        echo "<div class='row mb-2'>";
                                                       
                                                        $row = mysqli_fetch_assoc($result4);
                                                        echo "<form method='post' action='accept_friend.php? friend=". 
                                                        $row['SId']. " '>";
                                                        
                                                        echo "<span class='col-5' style='padding-left:0;'>" . $row['SId'] . "</span>";			
                                                        echo "<span class='col-5'>" . $row['NickName'] . "</span>";	
                                                        echo "<span class='col-5'><button name='accept' type='submit' class='see-fr-save-btn''>接受</button>";
                                                        echo "<span class='col-5'><button name='reject' type='submit' class='delete-fr-btn' formaction='reject_friend.php? friend=". 
                                                        $row['SId']. "'>拒絕</button>";
                                                        
                                                        echo "</form>";
                                                        
                                                        echo "</div>";
                                                    }
                                                ?>
                                            </>
                                        </div>
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