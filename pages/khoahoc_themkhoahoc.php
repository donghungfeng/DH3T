<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link rel="stylesheet" type="text/css" href="../bootstrap4/css/bootstrap.min.css">
</head>
<body>
	<h3 class="text-center font-weight-bold">THÊM KHÓA HỌC</h3>
	<div id="h">
		<form action="" method="POST">
	    <div class="form-group">
	      <label for="SoMon">Số môn:</label>
	      <input type="textbox" class="form-control" id="SoMon" name="SoMon" placeholder="Số môn">
	    </div>
		<button type="submit" onclick="check_number();" name="mon" class="btn btn-success">Thêm môn</button>
		<button type="" class="btn btn-info">Làm mới</button>
	</form>
	</div>
	<?php 
		include("../config.php");
		if(isset($_POST["mon"]) && $_POST["SoMon"]>0){
			echo "<script type='text/javascript'>document.getElementById('h').style.display = 'none';</script>";
			echo "
				
				<form action='' method='POST'>
				
			    <input type='hidden' value='".$_POST["SoMon"]."' name='txtSoMon'>
				<div class='form-group'>
			      <label for='txtMa'>Mã khóa học:</label>
			      <input type='textbox' class='form-control' id='txtMa' placeholder='Mã khóa học' name='txtMa'>
			    </div>
			    <div class='form-group'>
			      <label for='txtMa'>Tên khóa học:</label>
			      <input type='textbox' class='form-control' id='txtMa' placeholder='Tên khóa học' name='txtName'>
			    </div>
			    <div class='form-group'>
			      <label for='txtMa'>Loại hình đào tạo:</label>
			      <input type='textbox' class='form-control' id='txtMa' placeholder='Loại hình đào tạo' name='txtLoaiHinh'>
			    </div>";
			for($i = 0;$i<$_POST["SoMon"];$i++){
				$select_mon = "SELECT * FROM mon";
				$mon = @mysqli_query($conn,$select_mon);
				
				echo "<h6>Môn thứ ".($i+1).":</h4>";
				echo "<div class='form-group'><select class='form-control' name='selMon".$i."'>";
				  while($row = mysqli_fetch_array($mon)){
				  			echo "<option value='".$row["id"]."'>".$row["name"]."</option>";
				  }
				echo " </select></div>";
				
			}
			echo "<button type='submit' name='submit' class='btn btn-success'>Thêm khóa học</button></form>";
		}
		if(isset($_POST["submit"])){
			
			$sql = "INSERT INTO `khoa_hoc`(`id`, `name`, `so_mon`, `loai_hinh_dao_tao`) VALUES ('".$_POST["txtMa"]."','".$_POST["txtName"]."',".$_POST["txtSoMon"].",'".$_POST["txtLoaiHinh"]."')";
			$query = @mysqli_query($conn,$sql);
			echo $_POST["selMon0"];
			for ($i=0; $i < $_POST["txtSoMon"]; $i++) { 
				$sel = "selMon".$i;
				$sql_mon = "INSERT INTO `khoa_hoc_mon`(`khoa_hoc`, `mon`, `vi_tri_mon`) VALUES ('".$_POST["txtMa"]."','".$sel."',".($i+1).")";
				$query_mon = @mysqli_query($conn,$sql_mon);
			}
		}
	?>
	
</body>
<script type="text/javascript">

</script>
</html>