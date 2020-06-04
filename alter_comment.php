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

    $Times=$_GET["Times"];
    setcookie("Times", $Times);

    require_once("connect_db.inc.php");
    header("Content-type: text/html; charset=utf-8");
    $link = create_connection();
    
    $sql2 = "SELECT * FROM comments WHERE SId = '$sid' AND Times='$Times'";
    $sql3 = "SELECT * FROM member WHERE SId = '$sid' ";

    $result2 = execute_sql($link, "group_project", $sql2);
    $result3 = execute_sql($link, "group_project", $sql3);
?>
<html>
<head>
    <meta charset="UTF-8">
    <title>吱吱課評網 - 編輯個人資料</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+TC:wght@100;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/e3962a2758.js" crossorigin="anonymous"></script>
    <script defer src="/fontawesome-free-5.13.0-web/js/all.js"></script>
    <script type="text/javascript" src="utility.js"></script>
    <script type="text/javascript" src="bell.js"></script>
    <script type="text/javascript" src="Notification.js"> </script>

    <script type="text/javascript">
        function check_data()
      {
        if (document.myForm.Srating.value.length == 0 || document.myForm.Srating.value.length >10)
          alert("請選擇給分甜度！");
        else if (document.myForm.Hrating.value.length == 0)
          alert("請選擇難易度！");
        else if (document.myForm.Prating.value.length == 0)
          alert("請選擇實用性！"); 
        else
          myForm.submit();
      }
      
    </script>

</head>
<body class='font' style='background-color: #1F2E54;'>
 
    <section id='alter-page' style='background-color: transparent;'>
        

        <main class="pb-8 pb-md-11 mt-md-n6" style='margin:40px auto;'>
            <div class="container-md">
                <div class="row">
                       
          
                    <div class="col-md-12">

                        <div class="tab-content" id="nav-tabContent">   
                            <div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
                                <!-- Card -->
                                <div class="card alter-page-card-big">
                                    <div class="card-header alter-page-card-small">

                                        <!-- Heading -->
                                        <h4 class="mb-0">編輯評論</h4>

                                    </div>
                                    <div class="card-body alter-page-card-small">
                                            <!-- Form -->
                                            <form name='myForm' method='post' action='update_comment.php'>
                                                <div class="row">
                                                    <div class="col-md-12">

                                                        <?php
                                                            $total_records = 0;
                                                            $total_records = mysqli_num_rows($result2);  
                                                        
                                                            $detail = mysqli_fetch_array($result2, MYSQLI_ASSOC);
                                                            $score = $detail["Score"];
                                                            $qhard = $detail["Qhard"];
                                                            $p = $detail["Practicality"];
                                                        ?>
                                                            <div class="form-group">
                                                             <label for="Times">日期（無法更改）</label>
                                                                <?php echo"<input class='form-control' id='Times' type='text' name='Times' readonly='readonly' value=".$detail["Times"].">"; ?>
                                                             </div>
                                                             <form method='post' action='update_comment.php '>

                                                            <div class="form-group">
                                                                <div class="md-form mb-3">
                                                                    <label for="score-rating">給分甜度（1星最不甜，10星最甜）</label>
                                                                    <div id='score-rating' class='rating-direction'>	
                                                                        
                                                                        <?php
                                                                            for($i=10;$i>=1;$i--){
                                                                        ?>
                                                                        <input class='star-rating' type="radio" id="sst<?php echo $i;?>" name='Srating' value="<?php echo $i;?>"<?php if($i==$score){echo "checked";}?>/>
                                                                        <label class='star-label' for="sst<?php echo $i;?>" title='star <?php echo $i;?>'></label>
                                                                        <?php
                                                                            }
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!-- nickname -->
                                                            <div class="form-group">
                                                                <div class="md-form mb-3">
                                                                    <label for="hard-rating">難易度（1星最簡單，10星最難）</label>
                                                                    <div id='hard-rating' class='rating-direction'>	
                                                                        <?php
                                                                            for($i=10;$i>=1;$i--){
                                                                        ?>
                                                                        <input class='star-rating' type="radio" id="hst<?php echo $i;?>" name='Hrating' value="<?php echo $i;?>"<?php if($i==$qhard){echo "checked";}?> />
                                                                        <label class='star-label' for="hst<?php echo $i;?>" title='star <?php echo $i;?>'></label>
                                                                        <?php
                                                                            }
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="md-form mb-3">
                                                                    <label for="practicality-rating">實用性（1星最不實用，10星最實用）</label>
                                                                    <div id='practicality-rating' class='rating-direction'>	
                                                                        <?php
                                                                            for($i=10;$i>=1;$i--){
                                                                        ?>
                                                                        <input class='star-rating' type="radio" id="pst<?php echo $i;?>" name='Prating' value="<?php echo $i;?>" <?php if($i==$p){echo "checked";}?>/>
                                                                        <label class='star-label' for="pst<?php echo $i;?>" title='star <?php echo $i;?>'></label>
                                                                        <?php
                                                                            }
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="Word">內容：</label>
                                                                <?php echo"<textarea class='form-control' style='border-radius:20px;' rows='4' id='Word' type='text' name='Word'>".$detail["Word"]."</textarea>"; ?>
                                                            </div>
                                                            <input type="reset" class="btn btn-primary reset" value="重填">
                                                            <input type="submit" class="btn btn-primary submit" value="儲存">
                                                            </form>
                                                            <?php  
                                                        ?>
                                                    </div>
                                                    
                                                </div>
                                            </form>                                        
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">
                            <div class="card alter-page-card-big">
                                   
                                </div>
                            
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </main>
    </section>

    
    
 </body>
</html>