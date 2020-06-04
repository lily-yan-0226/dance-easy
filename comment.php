<?php
	//檢查 cookie 中的 passed 變數是否等於 TRUE 
	$passed = $_COOKIE{"passed"};

	// error_reporting(E_ALL^E_NOTICE);

	$CId =  isset( $_GET["CId"]) ? $_GET["CId"]:$_COOKIE{"CId"};
	$Cname = isset( $_GET["Cname"]) ? $_GET["Cname"]:$_COOKIE{"Cname"};
	$Category = isset( $_GET["Category"]) ? $_GET["Category"]:$_COOKIE{"Category"};

	setcookie("CId", $CId);
	setcookie("Cname",$Cname);
	setcookie("Category", $Category);

	
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
			
		//建立資料連接
		$link = create_connection();
					
		//執行 SELECT 陳述式取得使用者資料
		$sql = "SELECT * FROM member Where SId = '$SId'";
		$result_nav = execute_sql($link, "group_project", $sql);
		
		$result_m = execute_sql($link, "group_project", $sql);
			
		$row = mysqli_fetch_assoc($result_m); 
		$total_records = mysqli_num_rows($result_m);
		
	} 
   
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>吱吱課評網 - 評論區</title>
    <script type="text/javascript" src="utility.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+TC:wght@100;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="style.css">
	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

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
		var XHR = null;  
			
		function startRequest()
		{
			XHR = createXMLHttpRequest();
			XHR.open("GET", "save_course.php");
			XHR.onreadystatechange = handleStateChange;          
			XHR.send(null);
		}
		
		function handleStateChange()
		{
			if (XHR.readyState == 4)
			{
			if (XHR.status == 200)
				document.getElementById("span1").innerHTML = XHR.responseText;
			else
				window.alert("無法收藏課程!");
			}
		}
		function startRequest2()
		{
			XHR = createXMLHttpRequest();
			XHR.open("GET", "unsave_course.php");
			XHR.onreadystatechange = handleStateChange2;          
			XHR.send(null);
		}
		
		function handleStateChange2()
		{
			if (XHR.readyState == 4)
			{
			if (XHR.status == 200)
				document.getElementById("span2").innerHTML = XHR.responseText;
			else
				window.alert("無法取消收藏課程!");
			}
		}      
		function check_data()
		{
			if (document.myForm.Srating.value.length == 0)
			alert("請選擇給分甜度！");
			else if (document.myForm.Hrating.value.length == 0)
			alert("請選擇難易度！");
			else if (document.myForm.Prating.value.length == 0)
			alert("請選擇實用性！"); 
			else
			myForm.submit();
		}
		function disableElement(){
			var save = document.getElementById("save");
			document.getElementById("save").disabled=true;
		}
		function disableElement2(){
			document.getElementById("save2").disabled=true;
		}
		
		
		
	</script>	
		
</head>
<body class='font comment-page-bg'>
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
                    $member_name = mysqli_fetch_object($result_nav)->NickName;
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
					mysqli_free_result($result_nav);
                ?>    
                
            </div>
        </nav>
	</section>
	<section id='comment-page-jumbotron'>
		<div class='jumbotron comment-page-header'>
			<div class='container-md'>
				<div class='row align-items-center'>
					<div class='col text-cn text-white'>
						<!-- Heading -->
                        <h1 class="font-weight-bold mb-2">
                        評論區
						</h1>
						<p>所在課程：<?php echo $Cname ?></p>
						<!--收藏/取消收藏按鈕 -->
						<?php
							require_once("connect_db.inc.php");
							$link = create_connection(); 
							//執行SQL查詢
							$sql = "SELECT  `SId`, `CId`
									FROM  `savecourse` 
									WHERE  SId='$SId' AND CId='$CId' " ;
							$result3 = execute_sql($link, "group_project", $sql);
							$total_records3 = 0;
							$total_records3 = mysqli_num_rows($result3);
							if($total_records3==0){
								echo "<form id= 'form1' name='save_course' class='comment-btns'>";
								echo "<button id='save' type='button' class='btn btn-primary save-btn' value='收藏' onclick='startRequest();disableElement()' >收藏</button>";
								echo "<span id='span1'></span>";
								echo "</form>";
							}
							else{
								echo "<form id='form2' name='unsave' class='comment-btns'>";
								echo "<button id='save2' type='button' class='btn btn-primary save-btn' value='取消收藏'  onclick='startRequest2();disableElement2()'>取消收藏</button>";
								echo "<span id='span2'></span>";
								echo "</form>";
							}
							
							
						?>  
						<button id='add' type="button" class="btn btn-primary save-btn comment-btns" value='撰寫評論' data-toggle="modal" data-target="#modalContactForm">撰寫評論</button>  
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- 所有留言 -->
	<?php
		require_once("connect_db.inc.php");
				
		//建立資料連接
		$link = create_connection();
					  
		//執行SQL查詢
		$sql = "SELECT `SId`, `Times`, `CId`, `Score`, `Qhard`, `Practicality`, `Word` ,`NickName` 
			FROM comments NATURAL JOIN member 
			WHERE comments.CId='$CId' ORDER BY Times DESC";
		$result2 = execute_sql($link, "group_project", $sql);
		$result_d = execute_sql($link, "group_project", $sql);
		$total_records = 0;
		$total_records = mysqli_num_rows($result2);
	?>

	<section>
		<div class='container-md'>
			<div class='row justify-content-center'>
				<div class='col-lg-8'>
					<ul class='list-group'>
						<?php	  
							if($total_records==0){
						?>
							<li class='list-group-item list-group-item-action'><p class='text-cn'>沒有留言</p></li>
						<?php	
							}
							else{
								for ($i = 0; $i < $total_records; $i++){
									$row2 = mysqli_fetch_assoc($result2);
						?>
						<li class='list-group-item list-group-item-action'>
						<?php echo "<form class='alter-delete-btn' name='alter_comment' method='post' action='alter_comment.php?Times=" . $row2['Times'] ." '>";
			  			?>	
								<div class="d-flex w-100 justify-content-between">
									<h4 class="mb-2 comment-title"><?php echo "發文者：".$row2['NickName'];?></h4>
									<small class="text-muted"><?php echo $row2['Times'];?></small>
								</div>
								<div class="row">
								<div class="col-lg-9 col-sm-9 col-9">
								<p class="mb-1 text-break"><?php echo "給分甜度：" . $row2['Score'] . "<br>";
												echo "難易度：" . $row2['Qhard'] . "<br>";
												echo "實用性：" . $row2['Practicality'] . "<br>";
												echo "內容：" . $row2['Word'];?>
								</p>
								</div>
                                <div class="col-lg-3 col-sm-3 col-3 text-cn" >
								<?php
									$result3 = $row2["SId"];
									if($result3==$_COOKIE{"SId"}){
											  
							
								echo "<input type='submit' class='btn btn-primary blue-btn' style='margin-bottom:8px;' value='修改評論'>";
								echo "<input type='submit' class='btn btn-primary blue-btn' style='background-color:#C32336;' value='刪除評論' formaction='delete_comment.php?Times=".$row2['Times']."' >";

									}
								?>
								</div>
								</div>
								</form>
								
						</li>
						
								  
						<?php
									
								}
							}
						?>
						
					</ul>
				</div>
			</div>
		</div>
	</section>

	<section id='new-post'>
		<div class="modal fade" id="modalContactForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
			aria-hidden="true">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header text-center">
						<h4 class="modal-title w-100 font-weight-bold">撰寫評論</h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<form name="myForm" method="post" action="new_comment.php">	
						<div class="modal-body mx-3">
							<div class="md-form mb-4">
								<label data-error="wrong" data-success="right" for="post_name">暱稱</label>
								<input type="text" id="post_name" class="form-control validate" readonly="readonly" value="<?php echo $row['NickName'];?>">
							</div>

							<div class="md-form mb-3">
								<label for="score-rating">給分甜度（1星最不甜，10星最甜）</label>
								<div id='score-rating' class='rating-direction'>	
									<input class='star-rating' type="radio" id="sst10" name='Srating' value="10" />
									<label class='star-label' for="sst10" title='star 10'></label>
									<input class='star-rating' type="radio" id="sst9" name='Srating' value="9" />
									<label class='star-label' for="sst9" title='star 9'></label>
									<input class='star-rating' type="radio" id="sst8" name='Srating' value="8" />
									<label class='star-label' for="sst8" title='star 8'></label>
									<input class='star-rating' type="radio" id="sst7" name='Srating' value="7" />
									<label class='star-label' for="sst7" title='star 7'></label>
									<input class='star-rating' type="radio" id="sst6" name='Srating' value="6" />
									<label class='star-label' for="sst6" title='star 6'></label>
									<input class='star-rating' type="radio" id="sst5" name='Srating' value="5" />
									<label class='star-label' for="sst5" title='star 5'></label>
									<input class='star-rating' type="radio" id="sst4" name='Srating' value="4" />
									<label class='star-label' for="sst4" title='star 4'></label>
									<input class='star-rating' type="radio" id="sst3" name='Srating' value="3" />
									<label class='star-label' for="sst3" title='star 3'></label>
									<input class='star-rating' type="radio" id="sst2" name='Srating' value="2" />
									<label class='star-label' for="sst2" title='star 2'></label>
									<input class='star-rating' type="radio" id="sst1" name='Srating' value="1" />
									<label class='star-label' for="sst1" title='star 1'></label>
								</div>
							</div>

							<div class="md-form mb-3">
								<label for="hard-rating">難易度（1星最簡單，10星最難）</label>
								<div id='hard-rating' class='rating-direction'>	
									<input class='star-rating' type="radio" id="hst10" name='Hrating' value="10" />
									<label class='star-label' for="hst10" title='star 10'></label>
									<input class='star-rating' type="radio" id="hst9" name='Hrating' value="9" />
									<label class='star-label' for="hst9" title='star 9'></label>
									<input class='star-rating' type="radio" id="hst8" name='Hrating' value="8" />
									<label class='star-label' for="hst8" title='star 8'></label>
									<input class='star-rating' type="radio" id="hst7" name='Hrating' value="7" />
									<label class='star-label' for="hst7" title='star 7'></label>
									<input class='star-rating' type="radio" id="hst6" name='Hrating' value="6" />
									<label class='star-label' for="hst6" title='star 6'></label>
									<input class='star-rating' type="radio" id="hst5" name='Hrating' value="5" />
									<label class='star-label' for="hst5" title='star 5'></label>
									<input class='star-rating' type="radio" id="hst4" name='Hrating' value="4" />
									<label class='star-label' for="hst4" title='star 4'></label>
									<input class='star-rating' type="radio" id="hst3" name='Hrating' value="3" />
									<label class='star-label' for="hst3" title='star 3'></label>
									<input class='star-rating' type="radio" id="hst2" name='Hrating' value="2" />
									<label class='star-label' for="hst2" title='star 2'></label>
									<input class='star-rating' type="radio" id="hst1" name='Hrating' value="1" />
									<label class='star-label' for="hst1" title='star 1'></label>
								</div>
							</div>

							<div class="md-form mb-3">
								<label for="practicality-rating">實用性（1星最不實用，10星最實用）</label>
								<div id='practicality-rating' class='rating-direction'>	
									<input class='star-rating' type="radio" id="pst10" name='Prating' value="10" />
									<label class='star-label' for="pst10" title='star 10'></label>
									<input class='star-rating' type="radio" id="pst9" name='Prating' value="9" />
									<label class='star-label' for="pst9" title='star 9'></label>
									<input class='star-rating' type="radio" id="pst8" name='Prating' value="8" />
									<label class='star-label' for="pst8" title='star 8'></label>
									<input class='star-rating' type="radio" id="pst7" name='Prating' value="7" />
									<label class='star-label' for="pst7" title='star 7'></label>
									<input class='star-rating' type="radio" id="pst6" name='Prating' value="6" />
									<label class='star-label' for="pst6" title='star 6'></label>
									<input class='star-rating' type="radio" id="pst5" name='Prating' value="5" />
									<label class='star-label' for="pst5" title='star 5'></label>
									<input class='star-rating' type="radio" id="pst4" name='Prating' value="4" />
									<label class='star-label' for="pst4" title='star 4'></label>
									<input class='star-rating' type="radio" id="pst3" name='Prating' value="3" />
									<label class='star-label' for="pst3" title='star 3'></label>
									<input class='star-rating' type="radio" id="pst2" name='Prating' value="2" />
									<label class='star-label' for="pst2" title='star 2'></label>
									<input class='star-rating' type="radio" id="pst1" name='Prating' value="1" />
									<label class='star-label' for="pst1" title='star 1'></label>
								</div>
							</div>

							<div class="md-form">
								<label data-error="wrong" data-success="right" for="content">內容</label>
								<textarea type="text" id="content" name='content' class="md-textarea form-control" rows="4"></textarea>
							</div>

						</div>
						<div class="modal-footer d-flex justify-content-center">
							<button type='button' class="btn btn-primary blue-btn" value='張貼討論' onClick="check_data()">張貼評論</button>
							<button type="reset" class="btn btn-primary blue-btn" value="重新輸入">重新輸入</button>
						</div>
					</form>
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