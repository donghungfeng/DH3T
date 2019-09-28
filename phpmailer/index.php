<!DOCTYPE html>
<html>
<head>
	<title>Mailer</title>
</head>
<body>
	<form method="POST" action="" enctype="multipart/form-data">
		<table>
			<tr>
				<td>Họ và tên</td>
				<td><input type="text" name="txtHoVaTen"></td>
			</tr>
			<tr>
				<td>Email</td>
				<td><input type="text" name="txtEmail"></td>
			</tr>
			<tr>
				<td>Tiêu đề</td>
				<td><input type="text" name="txtTieuDe"></td>
			</tr>
			<tr>
				<td>Nội dung</td>
				<td><textarea name="txtNoiDung"></textarea></td>
			</tr>

			
		</table>
		<input type="file" name="file"><br>
		<button name="send" type="submit">SEND</button>
	</form>
<?php 
	if(isset($_POST["send"])){
		include('PHPMailerAutoload.php');
		$mail             = new PHPMailer();
		$mail->IsSMTP(); 
		$mail->CharSet 	  = "utf-8";
		$mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
		$mail->SMTPAuth   = true;                  	// enable SMTP authentication
		$mail->SMTPSecure = 'tls';                 // sets the prefix to the servier
		$mail->Host       = 'smtp.gmail.com';      	
		$mail->Port       = 25;
		$mail->Username   =  'donghung.feng3@gmail.com';
		$mail->Password   = 'donghung';        
		$mail->isHTML(true);
		$mail->setFrom('donghung.feng3@gmail.com',"Nguyễn Đông Hưng");
		$mail_group  =explode(",",$_POST["txtEmail"]);
		for($i = 0; $i<sizeof($mail_group);$i++){
			echo $mail_group[$i]."<br>";
			$mail->addCC($mail_group[$i],$_POST["txtHoVaTen"]);
		}
		$mail->Subject = $_POST["txtTieuDe"];
		$mail->Body = $_POST["txtNoiDung"];
		$mail->AddAttachment("photo/dhf.jpg","dhf");
		if(!$mail->send()){
			echo "Could not be sent";
			echo "Mailer Error: " . $mail->ErrorInfo;
		}
		else{
			echo "Message has been sent";
		}
	}
 ?>
</body>
</html>