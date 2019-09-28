<?php 
	function send_mail($email,$name,$title,$content,$file_name){
		include('PHPMailerAutoload.php');
		$mail             = new PHPMailer();
		$mail->IsSMTP(); 
		$mail->CharSet 	  = "utf-8";
		$mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
		$mail->SMTPAuth   = true;                  	// enable SMTP authentication
		$mail->SMTPSecure = 'tls';                 // sets the prefix to the servier
		$mail->Host       = 'smtp.gmail.com';      	
		$mail->Port       = 25;
		$mail->Username   =  'donghung.feng@gmail.com';
		$mail->Password   = 'donghung';        
		$mail->isHTML(true);
		$mail->setFrom('donghung.feng@gmail.com',"Nguyễn Đông Hưng");
		$mail->addCC($email,$name);
		$mail->Subject = $title;
		$mail->Body = $content;
		$path = "../phpmailer/file/".$file_name.".xlsx";
		$mail->AddAttachment($path,$file_name);
		if(!$mail->send()){
			echo "Could not be sent";
			echo "Mailer Error: " . $mail->ErrorInfo;
		}
		else{
			echo "Message has been sent";
		}
	}
	
 ?>