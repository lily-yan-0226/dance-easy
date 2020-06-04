<?php
  //檢查 cookie 中的 passed 變數是否等於 TRUE 
  $passed = $_COOKIE{"passed"};
	
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
		
	$SId = $_COOKIE{"SId"};
	require_once("connect_db.inc.php");
    header("Content-type: text/html; charset=utf-8");
    $link = create_connection();
    $sql = "SELECT * FROM member WHERE SId = '$SId' ";
    $result = execute_sql($link, "group_project", $sql);
		
   
  } 
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>吱吱課評網 - 我的收藏</title>
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
        $(document).ready(function($) {
            $(".table-row").click(function() {
                window.document.location = $(this).data("href");
            });
        });
    </script>
</head>
<body class='font' style='background-color:#f6f6f6;'>
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
	
	<section id='course-page-jumbotron'>
        <div class="jumbotron alter-page-header" style='padding-bottom:50px;'>
            <div class="container-md">
                <div class="row align-items-center">
                    <div class="col text-cn text-white">

                        <!-- Heading -->
                        <h1 class="font-weight-bold mb-2">
                        我的收藏
                        </h1>
            
                    </div>
                </div> <!-- / .row -->
            </div> <!-- / .container -->
        </div>
    </section>

	<section id='my-save'>
		<div class='container-md'>
			<table class="table text-cn table-hover">
				<thead>
					<tr>
						<th scope="col-md-4">課程代號</th>
						<th scope="col-md-4">開課系所</th>
						<th scope="col-md-4">課程名稱</th>
					</tr>
				</thead>
				
				<?php
					//建立資料連接
				$link = create_connection();
							
				//執行 SELECT 陳述式取得使用者資料
				$sql = "SELECT `CId`,`Cname`,`Category` FROM savecourse NATURAL JOIN `course`  Where SId = '$SId'";
				$result = execute_sql($link, "group_project", $sql);
				
				
					$total_records = mysqli_num_rows($result);
					for ($i = 0; $i < $total_records; $i++)
					{
						$row = mysqli_fetch_assoc($result); 
						echo "<tr class='table-row' style='cursor: pointer;' data-href='comment.php? CId=" . 
            				$row["CId"] . "&Cname=" . urlencode($row["Cname"]) . 
            				"&Category=" . $row["Category"]."' >";
						echo "<td>" . $row['CId'] . "</td>";
						echo "<td>" . $row['Cname'] . "</td>";			
						echo "<td>" . $row["Category"] . "</td>";	
						echo "</tr>"; 
					}
				
				?>
			</table>
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