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
<div class="row well" style="border-left:2px solid aqua;">
		
		<div class="col-lg-3">
			<div class="form-group">
		      <input type="textbox" class="form-control" id="txtMa" placeholder="Tên giáo viên">
		    </div>
		</div>
		<div class="col-lg-3">
			<button class="btn btn-success">Search</button>
		</div>
	</div>

<br>

<h3 class="text-center font-weight-bold">LỊCH GIẢNG DẠY</h3>
<br>
<div class="card-body">
	<table class="table table-bordered">
		<th>Tên giáo viên</th>
		<th>Lớp</th>
		<th>Môn</th>
		<th>Phòng</th>
		<th>Kíp học</th>
		<th>Tác vụ</th>
		<?php 
		include('../config.php');
		$select = "select * from phan_lop_phong_mon_giao_vien,giao_vien,kip_hoc WHERE giao_vien.id = phan_lop_phong_mon_giao_vien.giao_vien AND phan_lop_phong_mon_giao_vien.kip_hoc = kip_hoc.id";
		$query = @mysqli_query($conn,$select);
		$index = 0;
		$arr = [];
		$tacvu = "<button class='btn btn-success'><a>Sửa</a></button><button class='btn btn-warning'><a>Xóa</a></button>";
		while($row = mysqli_fetch_array($query)){
		echo "<tr><td>".$row["name"]."</td><td>".$row["lop"]."</td><td>".$row["mon"]."</td><td>".$row["phong"]."</td><td>".$row["mo_ta"]."</td><td>".$tacvu."</td></tr>";
	}
	?>
</table>
</div>
</div>		



</html>