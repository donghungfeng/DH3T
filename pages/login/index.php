<!--
	Author: W3layouts
	Author URL: http://w3layouts.com
	License: Creative Commons Attribution 3.0 Unported
	License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html>
<head>
  <title>Đăng nhập </title>
 <!-- custom-theme -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Elegant Login Form Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />

	<style>
		
	</style>
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
		function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- //custom-theme  -->
<link rel="stylesheet" href="css/style.css">
   <!-- font-awesome icons -->
<link href="css/font-awesome.css" rel="stylesheet"> 
<!-- //font-awesome icons -->
<link href="//fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">
  </head>
  <body>
<div class="login-form w3_form">
  <!--  Title-->
      <div class="login-title w3_title">
           <h1></h1>
      </div>
           <div class="login w3_login">
                <h2 class="login-header w3_header">Đăng nhập</h2>
				    <div class="w3l_grid">
                        <form class="login-container" action="#" method="post">
                             <input type="email" placeholder="Tài khoản" name="Email" required="" >
                             <input type="password" placeholder="Mật khẩu" name="password" required="">
                             <input type="submit" name="btnSubmit" value="Đăng nhập">
                        </form>
						<?php 
							if(isset($_POST["btnSubmit"])){
								if($_POST["Email"]=="admin@gmail.com" && $_POST["password"]=="123456"){
									header("Location: http://localhost:81/timesheet/pages/viewdanhsach.php?action=lop_dstkb.php");
								}
								else{
									echo "Tài khoản hoặc mật khẩu không đúng";
								}
							}
						?>
<div class="second-section w3_section">
     <div class="bottom-header w3_bottom">
          <h3>Hoặc</h3>
     </div>
     <div class="social-links w3_social">
         <ul>
         <!-- facebook -->
             <li> <a class="facebook" href="#" target="blank"><i class="fa fa-facebook"></i></a></li>

         <!-- twitter -->
             <li> <a class="twitter" href="#" target="blank"><i class="fa fa-twitter"></i></a></li>

         <!-- google plus -->
             <li> <a class="googleplus" href="#" target="blank"><i class="fa fa-google-plus"></i></a></li>
       </ul>
   </div>
</div>
                 
<div class="bottom-text w3_bottom_text">
      <p>Bạn chưa có tài khoản ?<a href="#">Đăng ký ngay</a></p>
      <h4> <a href="#">Bạn quên mật khẩu đăng nhập ?</a></h4>
</div>

                  </div>
       </div>
  
</div>
  
  


  
<div class="footer-w3l">
		
</div>
</body>
</html>