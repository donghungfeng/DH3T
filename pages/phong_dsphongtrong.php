<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link rel="stylesheet" type="text/css" href="../bootstrap4/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
	<style type="text/css">
	.check_container {
		display: inline;
		position: relative;
		padding-left: 35px;
		margin-bottom: 12px;
		cursor: pointer;
		font-size: 15px;
		-webkit-user-select: none;
		-moz-user-select: none;
		-ms-user-select: none;
		user-select: none;
		color: black;
	}

	/* Hide the browser's default checkbox */
	.check_container input {
		position: absolute;
		opacity: 0;
		cursor: pointer;
	}

	/* Create a custom checkbox */
	.checkmark {
		position: absolute;
		top: 0;
		left: 0;
		height: 25px;
		width: 25px;
		background-color: #eee;
	}

	/* On mouse-over, add a grey background color */
	.check_container:hover input ~ .checkmark {
		background-color: #ccc;
	}

	/* When the checkbox is checked, add a blue background */
	.check_container input:checked ~ .checkmark {
		background-color: #2196F3;
	}

	/* Create the checkmark/indicator (hidden when not checked) */
	.checkmark:after {
		content: "";
		position: absolute;
		display: none;
	}

	/* Show the checkmark when checked */
	.check_container input:checked ~ .checkmark:after {
		display: block;
	}

	/* Style the checkmark/indicator */
	.check_container .checkmark:after {
		left: 9px;
		top: 5px;
		width: 5px;
		height: 10px;
		border: solid white;
		border-width: 0 3px 3px 0;
		-webkit-transform: rotate(45deg);
		-ms-transform: rotate(45deg);
		transform: rotate(45deg);
	}
</style>
</head>
<body>
	<br>
	<form method="POST" action="">
		<div class="row well" style="border-left:2px solid aqua;">
			<div class="col-lg-3">
				<div class="form-group">
					<select class="form-control" name="selKhung_gio">
						<?php 
						include("../config.php");
						$select_khung_gio = "SELECT * FROM khung_gio";
						$khung_gio = @mysqli_query($conn,$select_khung_gio);
						while($row = mysqli_fetch_array($khung_gio)){
						echo "<option>".$row["mota"]."</option>";
					}
					?>
					</select>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="input-group">
					<label class="check_container">Thứ 2
						<input type="checkbox" value="2" name="check1" checked="">
						<span class="checkmark"></span>
					</label>
					<label class="check_container" >Thứ 3
						<input type="checkbox" value="3" name="check2" checked="">
						<span class="checkmark"></span>
					</label>
					<label class="check_container" >Thứ 4
						<input type="checkbox" value="4" name="check3" checked="">
						<span class="checkmark"></span>
					</label>
					<label class="check_container" >Thứ 5
						<input type="checkbox" value="5" name="check4" checked="">
						<span class="checkmark"></span>
					</label>
					<label class="check_container" >Thứ 6
						<input type="checkbox" value="6" name="check5" checked="">
						<span class="checkmark"></span>
					</label>
					<label class="check_container" >Thứ 7
						<input type="checkbox" value="7" name="check6" checked="">
						<span class="checkmark"></span>
					</label>
				</div>
			</div>
			<div class="col-lg-2">
				<label>Từ ngày</label>
				<input type="date" class="form-control" name="">
			</div>
			<div class="col-lg-2">
				<label>Đến ngày</label>
				<input type="date" class="form-control" name="">
			</div>
			<div class="col-lg-1">
				<button name="btnTimKiem" class="btn btn-info btn-sm" type="">Tìm Kiếm</button>
			</div>
		</form>
</div>
<br>

<h3 class="text-center font-weight-bold">DANH SÁCH PHÒNG TRỐNG</h3>
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