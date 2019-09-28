<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link rel="stylesheet" type="text/css" href="../bootstrap4/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
</head>
<body>
	<br>
	<h3 class="text-center font-weight-bold">DANH SÁCH KHÓA HỌC</h3>
	<br>
	<div class="card-body">
		<table class="table table-bordered">
			<th>Mã khóa học</th>
			<th>Tên khóa học</th>
			<th>Số môn</th>
			<th>Loại hình đào tạo</th>
			<th>Tác vụ</th>
			<?php 
			include('../config.php');
			$select_khoahoc = "select * from khoa_hoc";
			$lop = @mysqli_query($conn,$select_khoahoc);
			$index = 0;
			$arr = [];
			$tacvu = "<button class='btn btn-success'><a>Sửa</a></button><button class='btn btn-warning'><a>Xóa</a></button>";
			while($row_lop = mysqli_fetch_array($lop)){
				echo "<tr><td>".$row_lop["id"]."</td><td>".$row_lop["name"]."</td><td>".$row_lop["so_mon"]."</td><td>".$row_lop["loai_hinh_dao_tao"]."</td><td>".$tacvu."</td></tr>";
			}
			 ?>
		</table>
	</div>
</div>		



</html>