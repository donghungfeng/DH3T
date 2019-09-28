<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="../bootstrap4/css/bootstrap.min.css">

    <style type="text/css">
       body{
        width:1920px;
        margin:0px auto;
        font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
        font-size: 14px;
        line-height: 1.42857143;
        color: #333;
        background-color: #fff;
        float: left;
       }
       th,td{
        width: 50px;
       }
       .main-container{
        width: 100%;
        min-height: 1200px;
        float: left;
       }
       .left-menu{
        width: 300px;
        min-height: inherit;
        font-weight: bold;
        background: black;
       }
       .left-menu a{
        transition: 0.3s;
       }
       .left-menu a span:after {
          content: '\00bb';
          position: absolute;
          opacity: 0;
          left: 10px;
          transition: 0.5s;
        }

        .left-menu a:hover span {
          padding-right: 25px;
        }

        .left-menu a:hover span:after {
          opacity: 1;
          left: 20px;
        }
       .left-menu a:hover{
        padding-left: 40px;
        text-decoration: none;
       }
        .right-list{
        margin-left: 300px;
        min-height: ;
        z-index: 2;
       }
       .quick-menu{
        position: fixed;
        width: 50px;
        height: 150px;
        border-radius: 20px;
        background: #00248F;
        top: 650px;
        left:1850px;
       }
       .quick-menu-item{
        width: 200px;
        height: 50px;
        position: fixed;
        border-radius: 20px;
        transition: 0.3s;
        background: #31758D;
        color:white;
       }
       .quick-menu-item:hover{
        left: 1750px;
       }
       .item-1{
        left: 1850px;
        top: 650px;
       }
       .item-2{
        left: 1850px;
        top: 700px;
       }
       .item-3{
        left: 1850px;
        top: 750px;
       }
       .footer{
        clear: both;
        color: black;
        height: 250px;
        width: 100%;
        background: #E1E1E1;
       }
       .footer .lienhe{
        width: 40%;
        float: left;
        padding: 10px;
      }
      .footer .lienhe .logo img{
        width: 45%;
      }
      .footer .bando{
        width: 25%;
        float: left;
        padding: 10px;
      }
      .footer .face{
        width: 25%;
        float: right;
        padding: 10px;
      }
       .banquyen{
        width: 100%;
        height: 50px;
        text-align: center;
        color: white;
        background:#363636;
        padding-top: 15px;
        padding-left: 600px;
        font-size: 14px;
      }
      .footer .thongtin{
        color:black;
        font-weight: bold;
        font-size:12px;
      }
      
    </style>
</head>
<body>
    <?php 
      include('header.php');
     ?>
    <div class="main-container">
        <nav class="dhf-sidebar dhf-bar-block  dhf-medium left-menu dhf-animate-left">
          <h4 class="dhf-bar-item"><b>DANH MỤC</b></h4>
          <a class="dhf-bar-item dhf-button dhf-hover-blue" href="view_danhsach_thongbao.php?action=thongbao_dsthongbao.php"><span>Danh sách thông báo<span></a>
          <a class="dhf-bar-item dhf-button dhf-hover-blue" href="view_danhsach_thongbao.php?action=thongbao_themngaynghi.php"><span>Danh sách thông báo<span></a>
          <a class="dhf-bar-item dhf-button dhf-hover-blue" href="view_danhsach_thongbao.php?action=thongbao_themngaynghi.php"><span>Thêm ngày nghỉ<span></a>
          <a class="dhf-bar-item dhf-button dhf-hover-blue" href="view_danhsach_thongbao.php?action=thongbao_cauhinhmail.php"><span>Cấu hình Email</span></a>
        </nav>
        <div class="right-list">
            <?php include($_GET['action']); ?>
        </div>
        <div class="quick-menu"></div>
        <div class="quick-menu-item item-1"><img src="../image/icon_classroom.png" width="49.5px">TKB Lớp học</div>
        <div class="quick-menu-item item-2"><img src="../image/icon_teacher.png">Lịch dạy</div>
        <div class="quick-menu-item item-3"><img src="../image/icon_room.png">DS phòng</div>
    </div>

<footer class="footer">
      <div class="container">
        <div class="lienhe">
          <div class="logo">
            <a href=""><img src="../image/logo.png"></a>
          </div>
          <div class="thongtin">
            <p>Cơ sở 1: Tầng 5, Nhà E3, Viện CNTT, ĐHQG HN, 144 Xuân Thủy, Cầu Giấy, Hà Nội</p>
            <p>Cơ sở 2: Số 1 Hoàng Đạo Thúy, Thanh Xuân, Hà Nội</p>
            <p>Điện thoại : 024 3754 6732 Hotline: 0966 205 643</p>
            <p>Email: info@itplus-academy.edu.vn</p>
          </div>
        </div>
        <div class="bando">
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1862.3342288347962!2d105.80368115792544!3d21.0059230965027!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x313454b5534fb3bf%3A0x3af152649f6b709a!2sItplus+Academy!5e0!3m2!1sen!2sin!4v1503546330631" width="350" height="220" frameborder="0" style="border:0" allowfullscreen=""></iframe>
        </div>
        <div class="face">
          <iframe name="f1b444a0bb85d08" width="400px" height="270px" frameborder="0" allowtransparency="true" allowfullscreen="true" scrolling="no" title="fb:page Facebook Social Plugin" src="https://www.facebook.com/v2.10/plugins/page.php?adapt_container_width=false&amp;app_id=1213750372079302&amp;channel=http%3A%2F%2Fstaticxx.facebook.com%2Fconnect%2Fxd_arbiter%2Fr%2FlY4eZXm_YWu.js%3Fversion%3D42%23cb%3Dff6e6f68b3f914%26domain%3Ditplus-academy.edu.vn%26origin%3Dhttp%253A%252F%252Fitplus-academy.edu.vn%252Ffd1fa36606f874%26relation%3Dparent.parent&amp;container_width=360&amp;hide_cover=false&amp;href=https%3A%2F%2Fwww.facebook.com%2FHocVienITPlusAcademy%2F&amp;locale=vi_VN&amp;sdk=joey&amp;show_facepile=true&amp;small_header=false" ></iframe>
        </div>
      </div>
    </footer>
    <div class="banquyen">Copyright © 2011 All Rights Reserved.Desgin by DHF</div>
</body>
</html>