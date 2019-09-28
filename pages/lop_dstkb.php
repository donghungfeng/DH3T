<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link rel="stylesheet" type="text/css" href="../bootstrap4/css/bootstrap.min.css">
	<style type="text/css">
		#popup{
			width: 250px;
			height: 250px;
			background: orange;
			border-radius: 5px;
			display: none;
			position: absolute;
			z-index: 2;
		}
	</style>

</head>
<body>
	<div id="popup">	
	</div>
	<br>
        <h3 style="text-align: center;"><b>THỜI KHÓA BIỂU CÁC LỚP</b></h3>
    <br>
	<table class="table table-bordered">
		<tr>
			<th></th>
			<th colspan="5">
				Thứ 2
			</th>
			<th colspan="5">Thứ 3</th>
			<th colspan="5">Thứ 4</th>
			<th colspan="5">Thứ 5</th>
			<th colspan="5">Thứ 6</th>
			<th colspan="5">Thứ 7</th>
		</tr>
		<tr>
			<td>Lớp</td>
			<td>A</td>
			<td>B</td>
			<td>C</td>
			<td>D</td>
			<td>E</td>
			<td>A</td>
			<td>B</td>
			<td>C</td>
			<td>D</td>
			<td>E</td>
			<td>A</td>
			<td>B</td>
			<td>C</td>
			<td>D</td>
			<td>E</td>
			<td>A</td>
			<td>B</td>
			<td>C</td>
			<td>D</td>
			<td>E</td>
			<td>A</td>
			<td>B</td>
			<td>C</td>
			<td>D</td>
			<td>E</td>
			<td>A</td>
			<td>B</td>
			<td>C</td>
			<td>D</td>
			<td>E</td>
			
		</tr>
		<?php 
		include('../config.php');
		$select_lop = "select * from lop";
		$lop = @mysqli_query($conn,$select_lop);
		$index = 0;
		$arr = [];
		while($row_lop = mysqli_fetch_array($lop)){
			$select_kip = "SELECT kip_hoc_thu_khung_gio.khung_gio, kip_hoc_thu_khung_gio.thu_int FROM phan_lop_phong_mon_giao_vien,kip_hoc_thu_khung_gio WHERE phan_lop_phong_mon_giao_vien.lop ='".$row_lop["id"]."' AND phan_lop_phong_mon_giao_vien.kip_hoc = kip_hoc_thu_khung_gio.id";
			$arr = [];
			$kip = @mysqli_query($conn, $select_kip);
			$temp = 0;
			$temp2 = 0;
			while ($row = mysqli_fetch_array($kip)) {
				$arr[$index][$temp2] = 5*$row["thu_int"]+$row["khung_gio"];
				$temp2++;
			}
			echo "<tr><td><a href='#'>".$row_lop["id"]."</a></td>";
			for($i = 11 ; $i<=40;$i++){
				if($temp<count($arr[$index])){
					if($i == $arr[$index][$temp]){
						$temp++;
						echo "<td><button class='btn btn-info myBtn' >V</button></td>";
					}
					else{
						echo "<td></td>";
					}

				}
				else{
					echo "<td></td>";
				}
			}
			$index++;

		}

		
		echo "</tr></table>";

		?>
		
	</table>
	
</body>


</html>
