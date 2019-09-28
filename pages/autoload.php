<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<?php 
	include('../config.php');
	function kip()
	{
		GLOBAL $conn;
		$select_kip ="SELECT kip_hoc from lop WHERE lop.id='".$_GET["id"]."'";
		$kip = @mysqli_query($conn,$select_kip);
		$row = mysqli_fetch_array($kip);
		return $row["kip_hoc"];
	}
	$kip = kip();
	function thu(){
		GLOBAL $conn;
		GLOBAL $kip;
		$total_thu="";
		$select_thu = "SELECT thu FROM kip_hoc_thu_khung_gio WHERE id =" .$kip;
		$thu = @mysqli_query($conn,$select_thu);
		while ($row = mysqli_fetch_array($thu)) {
			$total_thu = $total_thu."-".$row["thu"];
		}
		return $total_thu;
	}
	function thoi_gian_bat_dau(){
		GLOBAL $conn;
		$select_day = "SELECT ngay_bat_dau,khoa_hoc From lop WHERE id='".$_GET["id"]."'";
		$day = @mysqli_query($conn,$select_day);
		return mysqli_fetch_array($day)["ngay_bat_dau"];
	}
	function thoi_luong(){
		GLOBAL $conn;
		GLOBAL $kip;
		$select_so_gio_trong_kip = "SELECT DISTINCT khung_gio.thoi_luong FROM khung_gio, kip_hoc_thu_khung_gio WHERE khung_gio.id = kip_hoc_thu_khung_gio.khung_gio AND kip_hoc_thu_khung_gio.id =".$kip;
		$so_gio = @mysqli_query($conn,$select_so_gio_trong_kip);
		return mysqli_fetch_array($so_gio)["thoi_luong"];
	}
	function cac_mon_hoc(){
		GLOBAL $conn;
		$total_mon = "";
		$select_mon = "SELECT * FROM khoa_hoc_mon,lop WHERE khoa_hoc_mon.khoa_hoc = lop.khoa_hoc AND lop.id='".$_GET["id"]."' ORDER BY vi_tri_mon";
		$mon = @mysqli_query($conn,$select_mon);
		while($row = mysqli_fetch_array($mon)){
			$total_mon = $total_mon."-".$row["mon"];
		}
		return $total_mon;

	}
	$monarr = explode("-", cac_mon_hoc());
	function so_gio_mon($value){
		GLOBAL $conn;
		$select_so_gio_trong_mon = "SELECT thoi_luong from mon WHERE mon.id='".$value."'";
		$thoi_luong_mon = @mysqli_query($conn,$select_so_gio_trong_mon);
		return mysqli_fetch_array($thoi_luong_mon)["thoi_luong"];
	}	$thoi_gian_bat_dau = explode("-",thoi_gian_bat_dau());
	
	function ngay_nghi(){
		GLOBAL $conn;
		$select_ngay_nghi= "SELECT ngay_nghi From lop WHERE id='".$_GET["id"]."'";
		$day = @mysqli_query($conn,$select_ngay_nghi);
		return mysqli_fetch_array($day)["ngay_nghi"];
	}

	
	function ngay_hoc_mon($value){
		$so_ngay = so_gio_mon($value)/thoi_luong();
		$index = 0;
		$ngay_hoc = "";
		$ngay_ket_thuc = "";
		GLOBAL $thoi_gian_bat_dau;
		$nam_bat_dau = $thoi_gian_bat_dau[0];
		$thang_bat_dau = $thoi_gian_bat_dau[1];
		$ngay_bat_dau = $thoi_gian_bat_dau[2];
		while($index<$so_ngay){
			$d=mktime(00, 00, 00, $thang_bat_dau, $ngay_bat_dau, $nam_bat_dau);
			if(strpos(thu(), date("l",$d))>0 && !(strpos(ngay_nghi(), date("Y-m-d",$d))>0)){
				$ngay_hoc = $ngay_hoc."*".date("Y-m-d",$d);
				$index++;
			}
			if($index == $so_ngay){
				$ngay_ket_thuc = date("Y-m-d",$d);
				echo $ngay_ket_thuc;
			}
			$ngay_bat_dau++;
		}
		$d=mktime(00, 00, 00, $thang_bat_dau, $ngay_bat_dau, $nam_bat_dau);
		$thoi_gian_bat_dau[0] = date("Y",$d);
		$thoi_gian_bat_dau[1] = date("m",$d);
		$thoi_gian_bat_dau[2] = date("d",$d);
		GLOBAL $conn;
		$sql_update_ngay_hoc = "UPDATE `phan_lop_phong_mon_giao_vien` SET `ngay_hoc`='".$ngay_hoc."',`so_buoi`=".$so_ngay.",`ngay_ket_thuc`='".$ngay_ket_thuc."' WHERE phan_lop_phong_mon_giao_vien.lop = '".$_GET["id"]."' AND phan_lop_phong_mon_giao_vien.mon = '".$value."'";
		$update_ngay_hoc = @mysqli_query($conn,$sql_update_ngay_hoc);
	}

	function insert(){
		GLOBAL $conn;
		$select_mon = "SELECT mon FROM `phan_lop_phong_mon_giao_vien` WHERE lop = '".$_GET["id"]."' ORDER BY thu_tu_mon";
		$mon =@mysqli_query($conn, $select_mon);
		while ($row = mysqli_fetch_array($mon)) {
			ngay_hoc_mon($row["mon"]);
		}
	}
	insert();
	$header = "Location: ../phpexcel/excel.php?id=".$_GET["id"];
	header($header);
	 ?>
</body>
</html>