<?php 
	require_once "Usuario.php";
	$user = ($_POST['user']);
	$usuario = new Usuario();
	echo $usuario->verificaradmin($user);
 ?>  
