<?php 

	require_once "cliente.php";

	$password = sha1($_POST['password']);
	$fechaNacimiento = explode("-", $_POST['fechaNacimiento']);
	$fechaNacimiento = $fechaNacimiento[2] . "-" . $fechaNacimiento[1] . "-" . $fechaNacimiento[0];
	$datos = array(
				"nombre" => $_POST['nombre'], 
			    "fechaNacimiento" => $fechaNacimiento, 
			    "email" => $_POST['correo'], 
			    "cliente" => $_POST['cliente'], 
			    "tel" => $_POST['tel'],
			    "password" => $password
			);

	$cliente = new cliente();
	echo $cliente->agregarcliente($datos);
 ?>  
