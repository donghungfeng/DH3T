<form action="" method="POST" enctype="multipart/form-data">

<input type="file" name="HinhAvatar" />

<input type="submit" value="Dang ky" name="submit" />
</form>
<?php 
	include('../config.php');
	if(isset($_POST["submit"])){
		$file = $_FILES["HinhAvatar"]["tmp_name"];
		//Nhúng file PHPExcel
		require_once 'Classes/PHPExcel.php';

//Đường dẫn file
//Tiến hành xác thực file
$objFile = PHPExcel_IOFactory::identify($file);
$objData = PHPExcel_IOFactory::createReader($objFile);

//Chỉ đọc dữ liệu
$objData->setReadDataOnly(true);

// Load dữ liệu sang dạng đối tượng
$objPHPExcel = $objData->load($file);

//Lấy ra số trang sử dụng phương thức getSheetCount();
// Lấy Ra tên trang sử dụng getSheetNames();

//Chọn trang cần truy xuất
$sheet  = $objPHPExcel->setActiveSheetIndex(0);

//Lấy ra số dòng cuối cùng
$Totalrow = $sheet->getHighestRow();
//Lấy ra tên cột cuối cùng
$LastColumn = $sheet->getHighestColumn();

//Chuyển đổi tên cột đó về vị trí thứ, VD: C là 3,D là 4
$TotalCol = PHPExcel_Cell::columnIndexFromString($LastColumn);

//Tạo mảng chứa dữ liệu
$data = [];

//Tiến hành lặp qua từng ô dữ liệu
//----Lặp dòng, Vì dòng đầu là tiêu đề cột nên chúng ta sẽ lặp giá trị từ dòng 2
for ($i = 2; $i <= $Totalrow; $i++)
{
	//----Lặp cột
	for ($j = 1; $j < $TotalCol; $j++)
	{
    	// Tiến hành lấy giá trị của từng ô đổ vào mảng
		$data[$i-2][$j-1]=$sheet->getCellByColumnAndRow($j, $i)->getValue();;
	}
}
//Hiển thị mảng dữ liệu
echo '<pre>';
	}
	for($i=0;$i<sizeof($data);$i++){
		$sql_insert_mon = "INSERT INTO `mon`(`id`, `name`, `thoi_luong`, `khoa_hoc`, `noi_dung`, `ghi_chu`, `thuoc_tinh`) VALUES ('".$data[$i][0]."','".$data[$i][1]."',".$data[$i][2].",'".$data[$i][3]."','".$data[$i][4]."','".$data[$i][5]."','".$data[$i][6]."'";
		
		$insert_mon = @mysqli_query($conn,$sql_insert_mon);
	}
	echo "done";
