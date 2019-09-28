<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link rel="stylesheet" type="text/css" href="../bootstrap4/css/bootstrap.min.css">
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
	<h3 class="text-center font-weight-bold">THÊM GIÁO VIÊN</h3>
	<form action="" method="POST">
		<div class="form-group">
	      <label for="txtMa">Mã giáo viên:</label>
	      <input type="textbox" class="form-control" name="txtMa" placeholder="Mã giáo viên">
	    </div>
	    <div class="form-group">
	      <label for="txtTen">Tên giáo viên:</label>
	      <input type="textbox" class="form-control" name="txtTen" placeholder="Tên giáo viên">
	    </div>
	    <div class="form-group">
	      <label for="txtDiaChi">Địa chỉ:</label>
	      <input type="textbox" class="form-control" name="txtDiaChi" placeholder="Địa chỉ">
	    </div>
	    <div class="form-group">
	      <label for="txtSDT">Số điện thoại:</label>
	      <input type="textbox" class="form-control" name="txtSDT" placeholder="Số điện thoại">
	    </div>
	    <div class="form-group">
	      <label for="txtEmail">Email</label>
	      <input type="textbox" class="form-control" name="txtEmail" placeholder="Email">
	    </div>
	    <div class="form-group">
	      <label for="txtGhiChu">Ghi chú</label>
	      <input type="textbox" class="form-control" name="txtGhiChu" placeholder="Ghi chú">
	    </div>
	     <div class="form-group">
	     
	    </div>
	    <div class="input-group">
			<label >Lựa chọn các môn:</label>
			<?php include("../config.php"); 
				$sql_select_mon = "select * from mon";
				$select_mon = @mysqli_query($conn,$sql_select_mon);
				while($row = mysqli_fetch_array($select_mon)){
					echo "<label class='check_container' >".$row["name"]."
							<input type='checkbox' value='".$row['id']."' name='".$row['id']."'>
							<span class='checkmark'></span>
						</label>";
				}

			?>
		</div>
		<br>
		<div class="input-group">
			<label >Lựa chọn các nhóm:</label>
			<?php include("../config.php"); 
				$sql_select_mon = "select * from nhom_giao_vien";
				$select_mon = @mysqli_query($conn,$sql_select_mon);
				while($row = mysqli_fetch_array($select_mon)){
					echo "<label class='check_container' >".$row["name"]."
							<input type='checkbox' value='".$row['id']."' name='".$row['id']."'>
							<span class='checkmark'></span>
						</label>";
				}

			?>
		</div>
		<br>
		<button type="submit" name="btnThemGV" class="btn btn-success">Thêm phòng</button>
		
	</form>
	<?php 
		if(isset($_POST["btnThemGV"]) ){
			$sql_select_mon = "select * from mon";
			$sql_select_nhomgv = "select * from nhom_giao_vien";
			$sql_insert_gv = "INSERT INTO `giao_vien`(`id`, `name`, `dia_chi`, `dien_thoai`, `email`, `ghi_chu`) VALUES ('".$_POST["txtMa"]."','".$_POST["txtTen"]."','".$_POST["txtDiaChi"]."','".$_POST["txtSDT"]."','".$_POST["txtEmail"]."','".$_POST["txtGhiChu"]."')";
			$select_mon = @mysqli_query($conn,$sql_select_mon);
			$select_nhomgv = @mysqli_query($conn,$sql_select_nhomgv);
			$insert_gv = @mysqli_query($conn,$sql_insert_gv);
			while($row = mysqli_fetch_array($select_mon)){
				if(isset($_POST[$row["id"]])){
					$sql_insert_gvm = "INSERT INTO `giao_vien_mon`(`ma_giao_vien`, `ma_mon`) VALUES ('".$_POST["txtMa"]."','".$row['id']."')";
					$insert_gvm = @mysqli_query($conn,$sql_insert_gvm);
				}
			}
			while($row = mysqli_fetch_array($select_nhomgv)){
				if(isset($_POST[$row["id"]])){
					$sql_insert_gvn = "INSERT INTO `giao_vien_nhom`(`ma_giao_vien`, `ma_nhom`) VALUES ('".$_POST["txtMa"]."','".$row["id"]."')";
					$insert_gvn = @mysqli_query($conn,$sql_insert_gvn);
				}
			}
		}

	 ?>
	
</body>
<script type="text/javascript">
	function hienthi(){
		document.getElementById('demo').style.display = "block";
	}

</script>
</html>