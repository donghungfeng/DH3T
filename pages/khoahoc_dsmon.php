<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="../bootstrap4/css/bootstrap.min.css">
</head>
<body>
	<div>
		<h3>Lựa chọn khóa học</h3>
		<form action="" method="POST">
			<div class="form-group">
			  <select class="form-control" name="selKhoa_hoc">
			  	<?php 
			  		include("../config.php");
			  		$select_khoa_hoc = "SELECT distinct khoa_hoc FROM mon";
			  		$khoa_hoc = @mysqli_query($conn,$select_khoa_hoc);
			  		while($row = mysqli_fetch_array($khoa_hoc)){
			  			echo "<option>".$row["khoa_hoc"]."</option>";
			  		}
			  	 ?>
			  </select>
			</div>
			<button type="submit" name="submit" class="btn btn-info">Hiển thị</button>
		</form>
	</div>
	<div>
		<h3 align="center">Danh sách môn của khóa học</h3>
		<table class="table table-bordered">
			<th>Vị trí</th>
			<th>Tên môn</th>
			<th>Tác vụ</th>
		<?php 
			include('../config.php');
			if(isset($_POST["submit"])){
				$select_mon = "SELECT * FROM `khoa_hoc_mon`,khoa_hoc,mon WHERE khoa_hoc_mon.mon = mon.id and khoa_hoc_mon.khoa_hoc = khoa_hoc.id AND khoa_hoc.name='".$_POST["selKhoa_hoc"]."' order by vi_tri_mon";
				$mon = @mysqli_query($conn,$select_mon);
				$tac_vu="<button class='btn btn-success'>Sửa</button><button class='btn btn-warning'>Xóa</button>";
				while($row = mysqli_fetch_array($mon)){
					echo "<tr><td>".$row["vi_tri_mon"]."</td><td>".$row["name"]."</td><td>".$tac_vu."</td></tr>";
				}
			}
		 ?>
		 </table>
	</div>

</body>
</html>