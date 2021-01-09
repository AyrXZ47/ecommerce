<!DOCTYPE html>
<html lang="es">
<head>
    <title>Ecommerce</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="admin/css/all.css">
    <link rel="stylesheet" type="text/css" href="admin/lib/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="admin/lib/jquery-ui/jquery-ui.theme.css">
    <link rel="stylesheet" type="text/css" href="admin/lib/jquery-ui/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="admin/lib/fontawesome/css/all.css">
    <link rel="stylesheet" type="text/css" href="admin/lib/datatable/dataTables.bootstrap4.min.css">
    <?php
    session_start();
    $accion = $_REQUEST['accion'] ?? '';
    if ($accion == 'cerrar') {
        session_destroy();
	header("location:index.php");
    }
    ?>
</head>
<body>
    <script src="admin/lib/jquery/dist/jquery-3.4.1.min.js"></script>
    <script src="admin/lib/jquery-ui/jquery-ui.js"></script>
    <script src="admin/lib/bootstrap/popper.min.js"></script> 
    <script src="admin/lib/bootstrap/dist/js/bootstrap.min.js"></script> 
    <script src="admin/lib/bootstrap/dist/js/bootstrap5.bundle.min.js"></script>
    <script src="admin/lib/datatable/jquery.dataTables.min.js"></script>
    <script src="admin/lib/datatable/dataTables.bootstrap4.min.js"></script>
    <script src="admin/lib/sweetalert.min.js"></script>
    <script src="admin/js/ecommerce.js"></script>
    <?php
    include_once "admin/clases/Conexion.php";
    $c = new Conectar();
    $conexion = $c->conexion();


    $modulo = $_REQUEST['modulo'] ?? '';
    if ($modulo == "inicio" || $modulo == "") {
 	include_once "nav.php";
        include_once "productos.php";
    }
    if ($modulo == "login") {
        include_once "login.php";
    }
    if ($modulo == "registro") {
        include_once "registro.php";
    }
    if ($modulo == "carrito") {
	include_once "nav.php";
        include_once "carrito.php";
    }
    if ($modulo == "envio") {
	include_once "nav.php";
        include_once "envio.php";
    }
    if ($modulo == "pasarela") {
	include_once "nav.php";
        include_once "pasarela.php";
    }
    if ($modulo == "factura") {
	include_once "nav.php";
        include_once "factura.php";
    }

?>
</body>
</html>
