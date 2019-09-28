<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link rel="stylesheet" type="text/css" href="../bootstrap4/css/bootstrap.min.css">
</head>
<body>
	<h3 class="text-center font-weight-bold">THÊM BỘ MÔN</h3>
	<form action="" method="POST">
		<div class="form-group">
	      <label for="txtMa">Mã môn:</label>
	      <input type="textbox" class="form-control" id="txtMa" name="txtMa" placeholder="Mã môn">
	    </div>
	    <div class="form-group">
	      <label for="txtMa">Tên môn:</label>
	      <input type="textbox" class="form-control" id="txtMa" name="txtTen" placeholder="Tên môn">
	    </div>
	    <div class="form-group">
	      <label for="txtSo_hoc_sinh">Thời lượng (giờ):</label>
	      <input type="number" class="form-control" id="txtSo_hoc_sinh" name="txtThoiLuong" placeholder="Thời lượng">
	    </div>
	    <div class="form-group">
	      <label for="txtMa">Nội dung:</label>
	      <input type="textbox" class="form-control" id="txtMa" name="txtNoiDung" placeholder="Nội dung">
	    </div>
	    <div class="form-group">
	      <label for="txtMa">Ghi chú:</label>
	      <input type="textbox" class="form-control" id="txtMa" name="txtGhiChu" placeholder="Ghi chú">
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
		<button type="submit" name="submit" class="btn btn-success">Thêm môn</button>
		<button type="" class="btn btn-info">Làm mới</button>
	</form>
	<?php 
		if(isset($_POST["submit"])){
			$sql_insert = "INSERT INTO `mon`(`id`, `name`, `thoi_luong`, `noi_dung`, `ghi_chu`, `khoa_hoc`) VALUES ('".$_POST["txtMa"]."','".$_POST["txtTen"]."',".$_POST["txtThoiLuong"].",'".$_POST["txtNoiDung"]."','".$_POST["txtGhiChu"]."','".$_POST["selKhoa_hoc"]."')";
			$insert = @mysqli_query($conn,$sql_insert);
			echo "<script type='text/javascript'>alert('Thêm thành công')</script>";
		}
	 ?>
</body>


</html>