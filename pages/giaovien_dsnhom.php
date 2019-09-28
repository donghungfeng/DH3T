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

<h3 class="text-center font-weight-bold">DANH SÁCH NHÓM GIÁO VIÊN</h3>
<br>
<div class="card-body">
	<table class="table table-bordered">
		<th>Mã nhóm</th>
		<th>Tên nhóm giáo viên </th>
		<th>Mô tả</th>
		<th>Tác vụ</th>
		<?php 
		include('../config.php');
		$select = "select * from nhom_giao_vien";
		$query = @mysqli_query($conn,$select);
		$index = 0;
		$arr = [];
		$tacvu = "<button class='btn btn-success'><a>Sửa</a></button><button class='btn btn-warning'><a>Xóa</a></button>";
		while($row = mysqli_fetch_array($query)){
		echo "<tr><td>".$row["id"]."</td><td>".$row["name"]."</td><td>".$row["mo_ta"]."</td><td>".$tacvu."</td></tr>";
	}
	?>
</table>
</div>
</div>		



</html>