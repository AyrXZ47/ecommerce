<!DOCTYPE html>
<html lang="es">
<head>
  <title>Ecommerce / Admin</title>
  <link rel="stylesheet" type="text/css" href="css/all.css">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" type="text/css" href="lib/bootstrap/dist/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="lib/jquery-ui/jquery-ui.theme.css">
<link rel="stylesheet" type="text/css" href="lib/jquery-ui/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="lib/fontawesome/css/all.css">
<link rel="stylesheet" type="text/css" href="lib/datatable/dataTables.bootstrap4.min.css">
</head>
<body>
<script src="lib/jquery/dist/jquery.min.js"></script>
<script src="lib/jquery-ui/jquery-ui.js"></script>
<script src="lib/bootstrap/popper.min.js"></script>
<script src="lib/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="lib/bootstrap/dist/js/bootstrap5.bundle.min.js"></script>
<script src="lib/datatable/jquery.dataTables.min.js"></script>
<script src="lib/datatable/dataTables.bootstrap4.min.js"></script>
<script src="lib/sweetalert.min.js"></script>
   <?php
   $modulo = $_REQUEST['modulo'] ?? '';
	if ($modulo == "iniciodesesiongestor" || $modulo == "") {
        include_once "login.php";
    }
     	if ($modulo == "registrodeusuariosgestor") {
        include_once "registro.php";
    }
     	if ($modulo == "inicio") {
	include "nav.php";
        include_once "vistas/inicio.php";
    }
      	if ($modulo == "cat") {
        include "nav.php";
	include_once "vistas/categorias.php";
    }
    	if ($modulo == "prod") {
        include "nav.php";
	include_once "vistas/productos.php";
    }
    	if ($modulo == "clien") {
        include "nav.php";
	include_once "vistas/clientes.php";
    }
    	if ($modulo == "vent") {
        include "nav.php";
	include_once "vistas/ventas.php";
    }
?>
</body>
</html> 
