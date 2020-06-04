<?php 
    require_once("connect_db.inc.php");
    //建立資料連接
    $link = create_connection();

    $SId=$_GET['friend'];
				
    //執行 SELECT 陳述式取得使用者資料
	$sql = "SELECT `CId`,`Cname`,`Category` FROM savecourse NATURAL JOIN `course`  Where SId = '$SId'";
	$sql2 = "SELECT * FROM member WHERE SId = '$SId' ";
	$result = execute_sql($link, "group_project", $sql);
	$result2 = execute_sql($link, "group_project", $sql2);
	$fr_name = mysqli_fetch_object($result2)->NickName;
?>   
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title><?php echo $fr_name."的收藏";?></title>

    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+TC:wght@100;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/e3962a2758.js" crossorigin="anonymous"></script>
    <script defer src="/fontawesome-free-5.13.0-web/js/all.js"></script>

	<script type="text/javascript">
        $(document).ready(function($) {
            $(".table-row").click(function() {
                window.document.location = $(this).data("href");
            });
        });
    </script>

</head>
<body class='font' style='background-color:#f6f6f6;'>
	
	<section id='course-page-jumbotron'>
        <div class="jumbotron alter-page-header fr-save-title">
            <div class="container-md">
                <div class="row align-items-center">
                    <div class="col text-cn text-white">

                        <!-- Heading -->
                        <h1 class="font-weight-bold mb-2">
                        <?php echo "查看 ".$fr_name." 的收藏";?>
                        </h1>
            
                    </div>
                </div> <!-- / .row -->
            </div> <!-- / .container -->
        </div>
	</section>
	
	<section id='fr-save'>
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
	
</body>
</html> 
    
		
