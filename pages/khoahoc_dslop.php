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
			  		$select_khoa_hoc = "SELECT * FROM khoa_hoc";
			  		$khoa_hoc = @mysqli_query($conn,$select_khoa_hoc);
			  		while($row = mysqli_fetch_array($khoa_hoc)){
			  			echo "<option>".$row["name"]."</option>";
			  		}
			  	 ?>
			  </select>
			</div>
			<button type="submit" name="submit" class="btn btn-info">Hiển thị</button>
		</form>
	</div>
	<div>
		<h3 align="center">Danh sách lớp theo khóa học</h3>
		<table class="table table-bordered">
			<th>Mã lớp</th>
			<th>Tên lớp</th>
		<?php 
			include('../config.php');
			if(isset($_POST["submit"])){
				$select_lop = "SELECT lop.id,lop.name FROM lop,khoa_hoc WHERE lop.khoa_hoc = khoa_hoc.id AND khoa_hoc.name='".$_POST["selKhoa_hoc"]."'";
				$lop = @mysqli_query($conn,$select_lop);
				
				while($row = mysqli_fetch_array($lop)){
					echo "<tr><td>".$row["id"]."</td><td>".$row["name"]."</td></tr>";
				}
			}
		 ?>
		 </table>
	</div>

</body>
</html>