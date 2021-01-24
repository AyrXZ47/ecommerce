<?php 
	require_once "cliente.php";
	$cli = ($_POST['cli']);
	$cliente = new cliente();
	echo $cliente->verificarcliente($cli);
 ?>  
