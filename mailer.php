<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	
	require 'vendor/autoload.php';
	 
	$destinatario = $_POST['destinatario'];
	$asunto = $_POST['asunto'];
 	$mensaje = $_POST['mensaje'];
	$adjunto = $_POST['adjunto'];	

	$mail = new PHPMailer();
	$mail->SetFrom('apache@om.anida.cl','Diagnostico Anida'); 
	$mail->addAddress($destinatario);
	$mail->Subject = $asunto;
	$mail->Body = $mensaje;
	
	$mail->addAttachment("/usr/share/zabbix/scripts/diagnostico/pdf/$adjunto");

	if($mail->send()){
	echo "<div class=\"alert alert-success\" role=\"alert\">Correo enviado con exito a $destinatario!!</div>";
	}else{
	$errorMessage = error_get_last()['message'];
	echo "<div class=\"alert alert-danger\" role=\"alert\">No se ha podido enviar el correo!! ".$mail->ErrorInfo."</div>";
	}
?>
	
