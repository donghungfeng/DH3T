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
				<select class="form-control" name="selNhom_gv">
					
					<?php 
					include("../config.php");
					$select = "SELECT * FROM nhom_giao_vien";
					$query = @mysqli_query($conn,$select);
					while($row = mysqli_fetch_array($query)){
						echo "<option>".$row["name"]."</option>";
					}
					?>
				</select>
			</div>
		</div>
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

<h3 class="text-center font-weight-bold">DANH SÁCH GIÁO VIÊN</h3>
<br>
<div class="card-body">
	<table class="table table-bordered">
		<th>Mã giáo viên</th>
		<th>Tên giáo viên</th>
		<th>Giới tính</th>
		<th>Địa chỉ</th>
		<th>Email</th>
		<th>SĐT</th>
		<th>Tác vụ</th>
		<?php 
		include('../config.php');
		$select = "select * from giao_vien";
		$query = @mysqli_query($conn,$select);
		$index = 0;
		$arr = [];
		$tacvu = "<button class='btn btn-success'><a>Sửa</a></button><button class='btn btn-warning'><a>Xóa</a></button>";
		while($row = mysqli_fetch_array($query)){
		echo "<tr><td>".$row["id"]."</td><td>".$row["name"]."</td><td>".$row["gioi_tinh"]."</td><td>".$row["dia_chi"]."</td><td>".$row["email"]."</td><td>".$row["dien_thoai"]."</td><td>".$tacvu."</td></tr>";
	}
	?>
</table>
</div>
</div>		



</html>