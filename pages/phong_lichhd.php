<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="../bootstrap4/css/bootstrap.min.css">
</head>
<body>
	<div>
		<h3>Lựa chọn phòng học</h3>
		<form action="" method="POST">
			<div class="form-group">
			  <select class="form-control" name="selPhong">
			  	<?php 
			  		include("../config.php");
			  		$select_phong = "SELECT * FROM phong";
			  		$phong = @mysqli_query($conn,$select_phong);
			  		while($row = mysqli_fetch_array($phong)){
			  			echo "<option>".$row["name"]."</option>";
			  		}
			  	 ?>
			  </select>
			</div>
			<button type="submit" name="submit" class="btn btn-info">Hiển thị</button>
		</form>
	</div>
	<div>
		<h3 align="center">Thời gian hoạt động của phòng</h3>
		<table class="table table-bordered">
			<th>Ngày bắt đầu</th>
			<th>Ngày kết thúc</th>
			<th>Thứ</th>
			<th>Khung giờ</th>
		<?php 
			if(isset($_POST["submit"])){
				$select_lich = "SELECT * FROM phong_co_lop,phong,khung_gio WHERE phong_co_lop.phong = phong.id AND khung_gio.id = phong_co_lop.khung_gio AND phong.name ='".$_POST["selPhong"]."'";
				$lich = @mysqli_query($conn,$select_lich);
				$tac_vu="<button class='btn btn-success'>Sửa</button><button class='btn btn-warning'>Xóa</button>";
				while($row = mysqli_fetch_array($lich)){
					echo "<tr><td>".$row["ngay_bat_dau"]."</td><td>".$row["ngay_ket_thuc"]."</td><td>".$row["thu"]."</td><td>".$row["mota"]."</td></tr>";
				}
			}
		 ?>
		 </table>
	</div>

</body>
</html>