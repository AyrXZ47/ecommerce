<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
  
   // Codigo para que funcione de manera  local xd
    $mail->SMTPOptions = array(
		'ssl' => array(
		'verify_peer' => false,
		'verify_peer_name' => false,
		'allow_self_signed' => true
		)
	);
    // Termina codigo para que funcione de manera local
    




    //Server settings
    $mail->SMTPDebug = 0;                                  // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                       // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'jajaprueba40@gmail.com';                     // SMTP username
    $mail->Password   = 'creado0121';                               // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('jajaprueba@gmail.com', 'By AyrXZTech');
    $mail->addAddress($_POST['correo'], $_POST['cliente']); 
 

// Lo comentado es para enviar archivos o imagenes en el correo (creo xd)
// Attachments
  //  $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Hola! '.$_POST['cliente'].' :D';
    $mail->Body    = '<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>
<body style="justify-content: center; align-items: center; text-align:center;">

	<table>
		<tr>
			<td style="background:#C70039; color:#ffffff;">
				<h1><strong>Gracias por estar con nosotros '.$_POST['cliente'].' </strong></h1>
			</td>
		</tr>

		<tr>
			<td>
				<div>
					<p>
					<h2>Te hemos enviado éste correo para que hagas clic en el siguiente enlace, verifiques tu cuenta y puedas iniciar sesión en nuestra plataforma: <br><br>    

<a href="https://localhost/PWA/index.php?modulo=ver&CLIENTE='.$_POST['cliente'].'">Verificar cuenta</a></h2> <br> 

					<h5>(en caso de que el URL no funcione, por favor copia y pega el enlace en tu navegador)<br><br>www.AyrXZTech.com</h5>
					</p>
				</div>

			</td>
		</tr>
		<tr>
			<td>
				<img src="https://i.ibb.co/NK2yy74/logo.png" style="max-width:85px;" alt="logo de empresa">
			</td>
		</tr>
	</table>

</body>
</html>';
   $mail->send();
    echo '1';
} catch (Exception $e) {
    echo "Error al enviar mensaje: {$mail->ErrorInfo}";
}
?>
