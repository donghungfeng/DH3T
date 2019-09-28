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
	<h3 class="text-center font-weight-bold">DANH SÁCH LỚP HỌC</h3>
	<br>
	<div class="card-body">
		<table class="table table-bordered">
			<th>Mã lớp</th>
			<th>Số học sinh</th>
			<th>Khóa học</th>
			<th>Kíp học</th>
			<th>Ngày nhập học</th>
			<th>Tác vụ</th>
			<?php 
			include('../config.php');
			$select_lop = "select * from lop";
			$lop = @mysqli_query($conn,$select_lop);
			$index = 0;
			$arr = [];
			$tacvu = "<button class='btn btn-success'><a>Sửa</a></button><button class='btn btn-warning'><a>Xóa</a></button>";
			while($row_lop = mysqli_fetch_array($lop)){
				echo "<tr><td>".$row_lop["id"]."</td><td>".$row_lop["so_hoc_sinh"]."</td><td>".$row_lop["khoa_hoc"]."</td><td>".$row_lop["kip_hoc"]."</td><td>".$row_lop["ngay_bat_dau"]."</td><td>".$tacvu."</td></tr>";
			}
			 ?>
		</table>
	</div>
</div>		



</html>