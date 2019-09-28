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

<h3 class="text-center font-weight-bold">DANH SÁCH PHÒNG</h3>
<br>
<div class="card-body">
	<table class="table table-bordered">
		<th>Mã phòng</th>
		<th>Tên phòng</th>
		<th>Kiểu phòng</th>
		<th>Số ghế</th>
		<th>Ghi chú</th>
		<th>Tác vụ</th>
		<?php 
		include('../config.php');
		$select = "select * from phong";
		$query = @mysqli_query($conn,$select);
		$index = 0;
		$arr = [];
		$tacvu = "<button class='btn btn-success'><a>Sửa</a></button><button class='btn btn-warning'><a>Xóa</a></button>";
		while($row = mysqli_fetch_array($query)){
		echo "<tr><td>".$row["id"]."</td><td>".$row["name"]."</td><td>".$row["kieu_phong"]."</td><td>".$row["so_ghe"]."</td><td>".$row["ghi_chu"]."</td><td>".$tacvu."</td></tr>";
	}
	?>
</table>
</div>
</div>		



</html>