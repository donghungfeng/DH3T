<!DOCTYPE html>
<html>
<head>
    <title></title>
    <style type="text/css">
        #menu-fix{
        background: #003ba8;
        color: #fff;
        border-radius: 0;
        height: 50px;
        display: block;
        width: 100%;
        transition:0.3s;
       }
        .container{
        margin:0px auto;
        width: 1170px;
        height: auto;
        color:white;
       }
       #menu-fix .container li{
        float: left;
        margin-left:10px;
        padding: 12px;
        font-family: 'Roboto Condensed',sans-serif;
        font-size:17px;
        font-weight: bold;

       }
       #menu-fix .container li a{
        color:white;
       }
       #menu-fix .container li a:hover{
        text-decoration: none;
       }
       .header{
        width: 1920px;
        height: 100px;
        background: white;
       }
       
       .header .container li{
        float: left;
        margin-left:10px;
        padding: 12px;
        font-family: 'Roboto Condensed',sans-serif;
        font-size:17px;
        font-weight: bold;

       }
       .header .container .title h3{
            font-family: 'Roboto', sans-serif;
            font-size: 22.5px;
            font-weight: 550;
            text-align: center;
            color: #10228c;
            margin: 20px 0px 10px -2px;
        }
        .header .container .title p{
            text-align: center;
            margin:;
            font-size: 14px;
            font-weight: 500;
            color: #10228c;
        }
    </style>
</head>
<body>
    
    <div class="header dhf-theme-14" >
        <div class="container">
            <ul style="list-style: none">
                <li>
                    <img src="../image/logo.png" height="90px">
                </li>
                <li>
                    <div class="title">
                        <h3>ITPLUS ACADEMY HỌC VIỆN HỢP TÁC ĐÀO TẠO CNTT ITPLUS</h3>
                        <p></p>
                    </div>
                </li>
                <li>
                    <img src="../image/logotkb.jpg" width="100px" />
                </li>
            </ul>
        </div>
    </div>
    <br>
    <div id="menu-fix">
        <div class="container">
            <ul style="list-style: none">
                <li class="dhf-hover-blue"><a href="view_danhsach_khoahoc.php?action=khoahoc_danhsach.php">Môn học</a></li>
                <li class="dhf-hover-blue"><a href="viewdanhsach.php?action=lop_dslop.php">Lớp học</a></li>
                <li class="dhf-hover-blue"><a href="view_danhsach_phonghoc.php?action=phong_dsphong.php">Phòng học</a></li>
                <li class="dhf-hover-blue"><a href="view_danhsach_giaovien.php?action=giaovien_dsgv.php">Giáo viên</a></li>
                <li class="dhf-hover-blue"><a href="view_danhsach_kiphoc.php?action=kiphoc_dskip.php">Kíp học</a></li>
                <li class="dhf-hover-blue"><a href="view_danhsach_thongbao.php?action=thongbao_dsthongbao.php">Trung tâm thông báo</a></li>
            </ul>
        </div>
    </div>

</body>
</html>