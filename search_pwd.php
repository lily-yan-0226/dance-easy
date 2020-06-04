<?php
  // composer require phpmailer/phpmailer;
  use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

  require_once("connect_db.inc.php");
  // require_once("PHPMailer.php");
  header("Content-type: text/html; charset=utf-8");  
  // include("PHPMailer.php");
  //取得表單資料
  $SId = $_POST["sid"]; 	
  $email = $_POST["email"];

  //建立資料連接
  $link = create_connection();
			
  //檢查查詢的帳號是否存在
  $sql = "SELECT Password,Name FROM member WHERE 
          SId = '$SId' AND email = '$email'";
  $result = execute_sql($link, "group_project", $sql);

  //如果帳號不存在
  if (mysqli_num_rows($result) == 0)
  {
    //顯示訊息告知使用者，查詢的帳號並不存在
    echo "<script type='text/javascript'>
            alert('您所查詢的資料不存在，請檢查是否輸入錯誤。');
            history.back();
          </script>";
  }
  else  //如果帳號存在
  {
    $row = mysqli_fetch_object($result);
    $Password = $row->Password;
    $Name = $row->Name;

    $message = "
      <!doctype html>
      <html>
        <head>
          <title></title>
          <meta charset='utf-8'>
        </head>
        <body>
          $Name 您好，您的帳號資料如下：<br><br>
          　　帳號：$SId<br>
          　　密碼：$Password<br><br>
            <a href='http://127.0.0.1/zhizhi_course/login.html'>按此登入本站</a>
          </body>
      </html>
    ";
	
    $mail= new PHPMailer();
    $mail->IsSMTP();
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = "ssl";
    $mail->Host = "smtp.gmail.com"; //Gamil的SMTP主機        
    $mail->Port = 465;  //Gamil的SMTP主機的SMTP埠位為465埠。        
    $mail->CharSet = "big5"; //設定郵件編碼    
    $mail->Username = "u06xu4s@gmail.com"; //設定驗證帳號        
    $mail->Password = "u06xu4u06xu4"; //設定驗證密碼
    $mail->From = "u06xu4s@gmail.com";  
    $mail->FromName = "zhizhi"; //設定寄件者姓名      
    $mail->Subject = "=?utf-8?B?" . base64_encode("帳號通知") . "?=";
    $mail->Body = $message;
    $mail->IsHTML(true);
    $mail->AddAddress("$email", "$Name");
      // echo $message;   //顯示訊息告知使用者帳號密碼
      if(!$mail->Send()) {        
        echo "Mailer Error: " . $mail->ErrorInfo;        
        } else {        
        echo "$Name 您好，您的帳號資料已經寄至 $email<br><br>
             <a href='login.html'>按此登入本站</a>";        
        }    
    

  }

  //釋放 $result 佔用的記憶體
  mysqli_free_result($result);
		
  //關閉資料連接	
  mysqli_close($link);
?>