<?php
require "Classes/PHPExcel.php";
include ('../config.php');
$sql_select_lop = "select * from lop WHERE id='".$_GET['id']."'";
$select_lop = @mysqli_query($conn,$sql_select_lop);
$row_lop = mysqli_fetch_array($select_lop);
$sql_select_kip="select mo_ta from kip_hoc WHERE id =".$row_lop["kip_hoc"];
$select_kip = @mysqli_query($conn,$sql_select_kip);
$row_kip = mysqli_fetch_array($select_kip);
$thoi_gian_bat_dau = explode("-",$row_lop["ngay_bat_dau"]);
$d=mktime(00, 00, 00, $thoi_gian_bat_dau[1], $thoi_gian_bat_dau[2], $thoi_gian_bat_dau[0]);
while (date("l",$d) != "Monday") {
	$thoi_gian_bat_dau[2]--;
	$d=mktime(00, 00, 00, $thoi_gian_bat_dau[1], $thoi_gian_bat_dau[2], $thoi_gian_bat_dau[0]);
}
	//Khởi tạo đối tượng
$excel = new PHPExcel();
	//Chọn trang cần ghi (là số từ 0->n)
$excel->setActiveSheetIndex(0);
	//Tạo tiêu đề cho trang
$excel->getActiveSheet()->setTitle('demo ghi dữ liệu');

	//Xét chiều rộng
$excel->getActiveSheet()->getRowDimension(1)->setRowHeight(50);
$excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
	//Header
$excel->getActiveSheet()->getStyle('B1:C1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$excel->getActiveSheet()->getStyle('B1:C1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$excel->getActiveSheet()->getStyle('B2:B4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
$excel->getActiveSheet()->getStyle('C2:C4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

$excel->getActiveSheet()->setCellValue('B1',"ITPLUS");
$tkb = "THỜI KHÓA BIỂU ".$_GET["id"];
$excel->getActiveSheet()->setCellValue('C1',$tkb);
$excel->setActiveSheetIndex(0)->mergeCells("C1:H1");
$excel->getActiveSheet()->setCellValue('B2',"Lớp:");
$excel->getActiveSheet()->setCellValue('C2',$_GET["id"]);
$excel->getActiveSheet()->setCellValue('B3',"Ngày bắt đầu học:");
$excel->getActiveSheet()->setCellValue('C3',$row_lop["ngay_bat_dau"]);
$excel->getActiveSheet()->setCellValue('E2',"Thời gian học");
$excel->getActiveSheet()->setCellValue('F2',$row_kip["mo_ta"]);

$numRow = 4;
$sql_select_gv = "SELECT giao_vien.name from phan_lop_phong_mon_giao_vien, giao_vien WHERE phan_lop_phong_mon_giao_vien.giao_vien = giao_vien.id AND lop ='".$_GET["id"]."'";
$select_gv = @mysqli_query($conn,$sql_select_gv);
while ($row = mysqli_fetch_array($select_gv)) {
	$cell = "C".$numRow;
	$cell_0 ="B".$numRow;
	$excel->getActiveSheet()->setCellValue($cell_0,"Giảng viên");
	$excel->getActiveSheet()->setCellValue($cell,$row["name"]);
	$numRow++;
}

	//Xét in đậm cho khoảng cột
$excel->getActiveSheet()->getStyle('A1:H8')->getFont()->setBold(true);
$excel->getActiveSheet()->getStyle('A2:H6')->getFont()->setItalic(true);

$excel->getActiveSheet()->setCellValue('A8',"Tuần");
$excel->getActiveSheet()->setCellValue('B8',"Ngày");
$excel->getActiveSheet()->setCellValue('C8',"Thứ 2");
$excel->getActiveSheet()->setCellValue('D8',"Thứ 3");
$excel->getActiveSheet()->setCellValue('E8',"Thứ 4");
$excel->getActiveSheet()->setCellValue('F8',"Thứ 5");
$excel->getActiveSheet()->setCellValue('G8',"Thứ 6");
$excel->getActiveSheet()->setCellValue('H8',"Thứ 7");

	// thực hiện thêm dữ liệu vào từng ô bằng vòng lặp
	// dòng bắt đầu = 2
$numRow=9;
	$sql_select_mon="SELECT * FROM `phan_lop_phong_mon_giao_vien` WHERE phan_lop_phong_mon_giao_vien.lop = '".$_GET["id"]."' ORDER BY thu_tu_mon";
	$select_mon = @mysqli_query($conn, $sql_select_mon);
	while($row_mon = mysqli_fetch_array($select_mon)){
		$ngay_hoc = explode("*",$row_mon["ngay_hoc"]);
		$buoi_so = 1;
		while($buoi_so <= $row_mon["so_buoi"]){
			$d=mktime(00, 00, 00, $thoi_gian_bat_dau[1], $thoi_gian_bat_dau[2], $thoi_gian_bat_dau[0]);
			if(date("l",$d) == "Monday"){
				$numRow++;
				$cell = "B".$numRow;
				$excel->getActiveSheet()->setCellValue($cell,date("d-m-Y",$d));
			}
			if(strpos($row_mon["ngay_hoc"], date("Y-m-d",$d))>0){
				switch (date("l",$d)) {
				case 'Monday':
					$cell = "C".$numRow;
					break;
				case 'Tuesday':
					$cell = "D".$numRow;
					break;
				case 'Wednesday':
					$cell = "E".$numRow;
					break;
				case 'Thursday':
					$cell = "F".$numRow;
					break;
				case 'Friday':
					$cell = "G".$numRow;
					break;
				case 'Saturday':
					$cell = "H".$numRow;
					break;
				}
				$mon = $row_mon["mon"]."-".$buoi_so;
				$excel->getActiveSheet()->setCellValue($cell,$mon);
				$buoi_so++;
			}
			$thoi_gian_bat_dau[2]++;
		}
	}
$cell_2 = "A9:H".$numRow;
$excel->getActiveSheet()->getStyle($cell_2)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
$numRow++;
$cell = "A".$numRow;
$excel->getActiveSheet()->setCellValue($cell,"CÁC MÔN HỌC");
$numRow++;
$sql_select_mon = "SELECT mon.id, mon.name from phan_lop_phong_mon_giao_vien, mon WHERE phan_lop_phong_mon_giao_vien.mon = mon.id AND lop ='".$_GET["id"]."'";
$select_mon = @mysqli_query($conn,$sql_select_mon);
while ($row = mysqli_fetch_array($select_mon)) {
	$cell = "C".$numRow;
	$cell_0 ="B".$numRow;
	$excel->getActiveSheet()->setCellValue($cell_0,$row['id']);
	$excel->getActiveSheet()->setCellValue($cell,$row["name"]);
	$numRow++;
}



header('Content-type: application/vnd.ms-excel');
$name = "TKB_".$_GET['id'].".xlsx";
$name2 = "TKB_".$_GET['id'];
$sql_insert_tb = "INSERT INTO `thong_bao`(`id`, `mo_ta`, `email`, `chu_ky`, `ngay_gui`,`file`) VALUES ('TB_".$_GET["id"]."','','',7,'2018-07-07','".$name2."')";
$insert_tb = @mysqli_query($conn,$sql_insert_tb);
$header = 'Content-Disposition: attachment; filename="'.$name2.'"';
header($header);
PHPExcel_IOFactory::createWriter($excel, 'Excel2007')->save('php://output');