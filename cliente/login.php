<?php 
	session_start();
	require_once "cliente.php";

	$cliente = $_POST['login'];
	$password = sha1($_POST['password']);

	$clienteObj = new cliente();

	echo $clienteObj->login($cliente, $password);
	
?>