<?php 
	require_once "Gestor.php";
	$Gestor =  new Gestor();
	$idArchivo = $_POST['idArchivo'];	
	
	echo $Gestor->obtenerDescripcion($idArchivo);
 ?> 
