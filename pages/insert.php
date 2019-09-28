<?php 
	include('../config.php');
	if(isset($_GET['id'])){
		$sql_select_mon = "SELECT * from khoa_hoc_mon,lop WHERE lop.khoa_hoc = khoa_hoc_mon.khoa_hoc AND lop.id='".$_GET["id"]."' ORDER BY vi_tri_mon";
		$sql_select_phong = "SELECT phong.id FROM `phong`,lop WHERE  phong.id not in (SELECT phong FROM phong_co_lop) AND lop.id='".$_GET["id"]."' AND lop.so_hoc_sinh <= phong.so_ghe ORDER BY muc_uu_tien limit 1";
		$sql_select_kip = "SELECT lop.kip_hoc FROM `phong`,lop WHERE  phong.id not in (SELECT phong FROM phong_co_lop) AND lop.id='".$_GET["id"]."' AND lop.so_hoc_sinh <= phong.so_ghe ORDER BY muc_uu_tien limit 1";
		echo $sql_select_phong;
		$select_phong = @mysqli_query($conn,$sql_select_phong);
		$select_kip = @mysqli_query($conn,$sql_select_kip);
		$phong=mysqli_fetch_array($select_phong)["id"];
		$kip=mysqli_fetch_array($select_kip)["kip_hoc"];
		echo "<br>";
		$select_mon = @mysqli_query($conn, $sql_select_mon);
		while($row = mysqli_fetch_array($select_mon)){
			$sql_select_gv  = "SELECT * FROM `giao_vien_mon` WHERE ma_mon = '".$row["mon"]."'ORDER BY muc_uu_tien Limit 1";
			$select_gv = @mysqli_query($conn,$sql_select_gv);
			$ma_gv = mysqli_fetch_array($select_gv)["ma_giao_vien"];
			$all = "INSERT INTO `phan_lop_phong_mon_giao_vien`(`lop`, `mon`, `thu_tu_mon`, `giao_vien`, `phong`, `kip_hoc`) VALUES ('".$_GET["id"]."','".$row["mon"]."',".$row["vi_tri_mon"].",'".$ma_gv."','".$phong."',".$kip.")";
			echo $all;
			$query_all =@mysqli_query($conn,$all);
		}
		$header = "Location: autoload.php?id=".$_GET["id"];
		header($header);
	}
 ?>