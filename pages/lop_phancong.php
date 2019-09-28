<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link rel="stylesheet" type="text/css" href="../bootstrap4/css/bootstrap.min.css">
	<style type="text/css">
		#thu_cong{
			display: none;
		}
		#thay_doi{
			display: none;
		}
		#menu{
			display: block;
		}

	</style>
</head>
<body>
	<div id="menu">
		<div class="left-menu dhf-animate-left" style="background-color: white">
	      <a class="dhf-bar-item dhf-button dhf-hover-white" href=""><button class="btn btn-info"><span style="color:black ">Phân công tự động</span></button></a>
	      <a class="dhf-bar-item dhf-button dhf-hover-white" href=""><button class="btn btn-info" onclick="btn_thu_cong();"><span style="color:black">Phân công thủ công</span></button></a>
	      <a class="dhf-bar-item dhf-button dhf-hover-white"><button class="btn btn-info" onclick="btn_thay_doi();"><span style="color:black;">Thay đổi thông tin đã phân công</span></button></a>
	    </div>
	</div>
	
    <div id="thu_cong">
    </div>
    <div id="thay_doi">
    	
    </div>
    <script type="text/javascript">
  
    	function btn_thu_cong() {
    		document.getElementById('menu').style.display = "none";
    		document.getElementById('thu_cong').style.display = "block";
    		document.getElementById('thay_doi').style.display = "none";
    	}
    	function btn_thay_doi() {
    		document.getElementById('menu').style.display = "none";
    		document.getElementById('thu_cong').style.display = "none";
    		document.getElementById('thay_doi').style.display = "block";
    	}
    </script>
</body>
</html>