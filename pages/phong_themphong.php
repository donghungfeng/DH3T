<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link rel="stylesheet" type="text/css" href="../bootstrap4/css/bootstrap.min.css">
</head>
<body>
	<br>
	<h3 class="text-center font-weight-bold">THÊM PHÒNG</h3>
	<form action="" method="POST">
		<div class="form-group">
	      <label for="txtMa">Mã phòng:</label>
	      <input type="textbox" class="form-control" name="txtMa" placeholder="Mã phòng">
	    </div>
	    <div class="form-group">
	      <label for="txtTen">Tên phòng:</label>
	      <input type="textbox" class="form-control" name="txtTen" placeholder="Tên phòng">
	    </div>
	    <div class="form-group">
	      <label for="txtKieu">Kiểu phòng:</label>
	      <input type="textbox" class="form-control" name="txtKieu" placeholder="Kiểu phòng">
	    </div>
	    <div class="form-group">
	      <label for="txtGhe">Số ghế:</label>
	      <input type="textbox" class="form-control" name="txtGhe" placeholder="Số ghế">
	    </div>
	    <div class="form-group">
	      <label for="txtGhiChu">Ghi chú:</label>
	      <input type="textbox" class="form-control" name="txtGhiChu" placeholder="Ghi chú">
	    </div>
	     <div class="form-group">
	      <label for="txtUT">Mức ưu tiên:</label>
	      <select class="form-control" name="txtUT">
		  	<?php 
		  		for($i=1;$i<6;$i++){
		  			echo "<option>".$i."</option>";
		  		}
		  	 ?>
		  </select>
	    </div>
		<button type="submit" name="btnThemPhong" class="btn btn-success">Thêm phòng</button>
		<button type="" class="btn btn-info">Làm mới</button>
	</form>
	<?php 
		if(isset($_POST["btnThemPhong"]) && $_POST["txtGhe"]>0){
			include("../config.php");
			$sql_insert = "INSERT INTO `phong`(`id`, `name`, `kieu_phong`, `so_ghe`, `ghi_chu`, `muc_uu_tien`) VALUES ('".$_POST["txtMa"]."','".$_POST["txtTen"]."','".$_POST["txtKieu"]."',".$_POST["txtGhe"].",'".$_POST["txtGhiChu"]."',".$_POST["txtUT"].")";
			$insert = @mysqli_query($conn,$sql_insert);

		}

	 ?>
	
</body>
<script type="text/javascript">
	function check_number(){
	}

</script>
</html>