<?php 
if(isset($_GET['id'])){

	include ('../config.php');
	function kip()
	{
		GLOBAL $conn;
		$select_kip ="SELECT kip_hoc from lop WHERE lop.id='".$_GET["id"]."'";
		$kip = @mysqli_query($conn,$select_kip);
		$row = mysqli_fetch_array($kip);
		return $row["kip_hoc"];
	}
	$kip = kip();
	echo $kip;
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
	function ngay_nghi(){
		GLOBAL $conn;
		$select_ngay_nghi= "SELECT ngay_nghi From lop WHERE id='".$_GET["id"]."'";
		$day = @mysqli_query($conn,$select_ngay_nghi);
		return mysqli_fetch_array($day)["ngay_nghi"];
	}
	$ngay_nghi = ngay_nghi();
	function them_ngay_nghi($thoi_gian_bat_dau, $thoi_gian_ket_thuc){
		if (strtotime($thoi_gian_bat_dau) > strtotime(date("Y-m-d"))){
			$thoi_gian_bat_dauarr = explode("-", $thoi_gian_bat_dau);
		}
		else{
			$thoi_gian_bat_dauarr = explode("-", date("Y-m-d"));
		}
		GLOBAL $ngay_nghi;
		GLOBAL $conn;
		$nam_bat_dau = $thoi_gian_bat_dauarr[0];
		$thang_bat_dau = $thoi_gian_bat_dauarr[1];
		$ngay_bat_dau = $thoi_gian_bat_dauarr[2];
		while(true){
			$d=mktime(00, 00, 00, $thang_bat_dau, $ngay_bat_dau, $nam_bat_dau);
			if(strpos(thu(), date("l",$d))>0){
				$ngay_nghi = $ngay_nghi."*".date("Y-m-d",$d);
			}
			$ngay_bat_dau++;
			if(strtotime(date("Y-m-d",$d))>strtotime($thoi_gian_ket_thuc)){
				break;
			}
		}
		$sql_update_ngay_nghi = "UPDATE `lop` SET `ngay_nghi`='".$ngay_nghi."'  WHERE id='".$_GET["id"]."'";
		echo $sql_update_ngay_nghi;
		$update_ngay_nghi = @mysqli_query($conn,$sql_update_ngay_nghi);
	}
	them_ngay_nghi($_GET['nbd'],$_GET['nkt']);
	$header = "Location: autoload.php?id=".$_GET['id'];
	header($header);
 }
?>