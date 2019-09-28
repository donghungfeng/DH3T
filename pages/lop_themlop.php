<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link rel="stylesheet" type="text/css" href="../bootstrap4/css/bootstrap.min.css">
</head>
<body>
	<div id="them">
		<h3 class="text-center font-weight-bold">THÊM LỚP HỌC</h3>
	<form action="" method="POST">
		<div class="form-group">
	      <label for="txtMa">Mã lớp:</label>
	      <input type="textbox" class="form-control" name="txtMa" id="txtMa" placeholder="Mã lớp">
	    </div>
	    <div class="form-group">
	      <label for="txtMa">Tên lớp:</label>
	      <input type="textbox" class="form-control" name="txtTenLop" id="txtTenLop" placeholder="Tên lớp">
	    </div>
	    <div class="form-group">
	      <label for="txtNBD">Ngày bắt đầu:</label>
	      <input type="date" class="form-control" name="txtNBD" id="txtNBD">
	    </div>
	    <div class="form-group">
	      <label for="txtSo_hoc_sinh">Số học sinh:</label>
	      <input type="textbox" class="form-control" name="txtSoHocSinh" id="txtSoHocSinh" placeholder="Số học sinh">
	    </div>
	    <div class="form-group">
		  <label for="selKhoa_hoc">Khóa học:</label>
		  <select class="form-control" name="selKhoa_hoc">
		  	<?php 
		  		include("../config.php");
		  		$select_khoa_hoc = "SELECT * FROM khoa_hoc";
		  		$khoa_hoc = @mysqli_query($conn,$select_khoa_hoc);
		  		while($row = mysqli_fetch_array($khoa_hoc)){
		  			echo "<option value='".$row["id"]."'>".$row["name"]."</option>";
		  		}
		  	 ?>
		  </select>
		</div>
		 <div class="form-group">
		  <label for="selKip_hoc">Kíp học:</label>
		  <select class="form-control" name="selKip_hoc">
		  	<?php 
		 
		  		$select_kip_hoc = "SELECT * FROM kip_hoc";
		  		$kip_hoc = @mysqli_query($conn,$select_kip_hoc);
		  		while($row = mysqli_fetch_array($kip_hoc)){
		  			echo "<option value='".$row["id"]."'>".$row["mo_ta"]."</option>";
		  		}
		  	 ?>
		  </select>
		</div>
		<button type="submit" name="btnThem" class="btn btn-success">Thêm lớp</button>
		<button type="" class="btn btn-info">Làm mới</button>
	</form>
	</div>
	<?php 
		if(isset($_POST["btnThem"])){
			$sql_insert = "INSERT INTO `lop`(`id`, `name`, `so_hoc_sinh`, `khoa_hoc`, `kip_hoc`, `ngay_bat_dau`, `ngay_nghi`) VALUES ('".$_POST["txtMa"]."','".$_POST["txtTenLop"]."',".$_POST["txtSoHocSinh"].",'".$_POST["selKhoa_hoc"]."','".$_POST["selKip_hoc"]."','".$_POST["txtNBD"]."','')";
			$insert = @mysqli_query($conn,$sql_insert);
			$header = "Location: insert.php?id=".$_POST["txtMa"];
			echo "<script type='text/javascript'>
				document.getElementById('them').style.display = 'none';
				</script>";
	      echo "</br><a href='insert.php?id=".$_POST["txtMa"]."'><button class='btn btn-success'>Tự động phân công</button></a><br>";
	      echo "</br><a href=''><button class='btn btn-success'>Phân công thủ công</button></a>";
		}
	 ?>

	
</body>

</html>