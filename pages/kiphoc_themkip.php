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
		display: block;
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
	<h3 align="center">
		THÊM KÍP HỌC
	</h3>
	<form method="POST" action="">
		<div class="row well">
			<div class="form-group">
				<div class="col-md-1">Mã kíp học</div>
				<div class="col-md-11">
					<input type="text" name="txtMaKip" class="form-control" placeholder="Mã kíp học">
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-1">Mô tả</div>
				<div class="col-md-11">
					<input type="text" name="txtMoTa" class="form-control" placeholder="Mô tả">
				</div>
			</div>

		</div>
		<table class="table table-bordered">
			<th>Chọn thứ</th>
			<th>Chọn khung giờ</th>
			<tr>
				<td width="10%">
				<label class="check_container">Thứ 2
					<input type="checkbox" value="2" name="check1">
					<span class="checkmark"></span>
				</label>
				<label class="check_container">Thứ 3
					<input type="checkbox" value="3" name="check2">
					<span class="checkmark"></span>
				</label>
				<label class="check_container">Thứ 4
					<input type="checkbox" value="4" name="check3"> 
					<span class="checkmark"></span>
				</label>
				<label class="check_container">Thứ 5
					<input type="checkbox" value="5" name="check4">
					<span class="checkmark"></span>
				</label>
				<label class="check_container">Thứ 6
					<input type="checkbox" value="6" name="check5">
					<span class="checkmark"></span>
				</label>
				<label class="check_container">Thứ 7
					<input type="checkbox" value="7" name="check6">
					<span class="checkmark"></span>
				</label>
				</td>
				<td>
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
				</td>
			</tr>
		</table>
		
		<button class="btn btn-success" name="btnThemKip">Thêm kíp</button>
	</form>
	<?php 
		if(isset($_POST['btnThemKip'])){
			$insert = "INSERT INTO `kip_hoc`(`id`, `mo_ta`) VALUES (".$_POST["txtMaKip"].",'".$_POST["txtMoTa"]."')";
			$query = @mysqli_query($conn, $insert);
			$select_khung_gio = "SELECT khung_gio.id FROM khung_gio where khung_gio.mota = '".$_POST['selKhung_gio']."'";

			$khung_gio = @mysqli_query($conn,$select_khung_gio);
			$row = mysqli_fetch_array($khung_gio)["id"];
			for($i = 1;$i<7;$i++){
				$check = "check".$i;
				$thu="";
				switch ($i) {
					case '1':
						$thu = "Monday";
						break;
					case '2':
						$thu = "Tuesday";
						break;
					case '3':
						$thu = "Wednesday";
						break;
					case '4':
						$thu = "Thursday";
						break;
					case '5':
						$thu = "Friday";
						break;
					case '6':
						$thu = "Saturday";
						break;
					
				}
				if(isset($_POST[$check])){
					$insert2 = "INSERT INTO `kip_hoc_thu_khung_gio`(`id`, `khung_gio`, `thu`, `so_gio_tren_tuan`, `thu_int`) VALUES (".$_POST["txtMaKip"].",".$row.",'".$thu."',6,".$_POST[$check].")";
					$query2 = mysqli_query($conn, $insert2);
				}
			}
			
		}
	 ?>
</html>