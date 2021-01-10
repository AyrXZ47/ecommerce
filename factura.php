<div class="container">
<div class="jumbotron">
<h1>¡Gracias por tu compra! :D </h1>
<?php
$total = $_REQUEST['total'] ?? '';
include_once "stripe/init.php";
\Stripe\Stripe::setApiKey("sk_test_............................");
$toke = $_POST['stripeToken'];
$charge = \Stripe\Charge::create([
    'amount' => $total,
    'currency' => 'mxn',
    'description' => 'Pago de ecommerce',
    'source' => $toke
]);
if ($charge['captured']) {
    $queryVenta = "INSERT INTO ventas 
        (idCli                       ,idPago             ,fecha) values
        ('" . $_SESSION['idcliente'] . "','" . $charge['id'] . "',now());
        ";
    $resVenta = mysqli_query($conexion, $queryVenta);
    $id = mysqli_insert_id($conexion);

    $insertaDetalle = "";
    $cantProd = count($_REQUEST['id']);
    for ($i = 0; $i < $cantProd; $i++) {
        $subTotal = $_REQUEST['precio'][$i] * $_REQUEST['cantidad'][$i];
        $insertaDetalle = $insertaDetalle . "('" . $_REQUEST['id'][$i] . "','$id','" . $_REQUEST['cantidad'][$i] . "','" . $_REQUEST['precio'][$i] . "','$subTotal'),";
    }
    $insertaDetalle = rtrim($insertaDetalle, ",");
    $queryDetalle = "INSERT INTO detalleVentas 
        (idProd, idVenta, cantidad, precio, subTotal) values 
        $insertaDetalle;";
    $resDetalle = mysqli_query($conexion, $queryDetalle);
    if ($resVenta && $resDetalle) {
?>
        <div class="row">
            <div class="col-sm">
                <?php muestraRecibe($id); ?>
            </div>
            <div class="col-sm">
                <?php muestraDetalle($id); ?>
            </div>
        </div>
    <?php
        borrarCarrito();
    }
}
function borrarCarrito()
{
    ?>
    <script>
        $.ajax({
            type: "post",
            url: "ajax/borrarCarrito.php",
            dataType: "json",
            success: function(response) {
                $("#badgeProducto").text("");
                $("#listaCarrito").text("");
            }
        });
    </script>
<?php
}
function muestraRecibe($idVenta)
{
?>
<div class="table-responsive">

    <table class="table">
        <thead>
            <tr>
                <th colspan="3" class="text-center">Persona que recibe</th>
            </tr>
            <tr>
                <th>Nombre</th>
                <th>Email</th>
                <th>Direccion</th>
            </tr>
        </thead>
        <tbody>
            <?php
            global $conexion;
            $queryRecibe = "SELECT nombre,email,direccion 
                from recibe 
                where idCli='" . $_SESSION['idcliente'] . "';";
            $resRecibe = mysqli_query($conexion, $queryRecibe);
            $row = mysqli_fetch_assoc($resRecibe);
            ?>
            <tr>
                <td><?php echo $row['nombre'] ?></td>
                <td><?php echo $row['email'] ?></td>
                <td><?php echo $row['direccion'] ?></td>
            </tr>
        </tbody>
    </table>
</div>
<?php
}
function muestraDetalle($idVenta)
{
?>

<div class="table-responsive">

    <table class="table">
        <thead>
            <tr>
                <th colspan="4" class="text-center">Detalle de venta</th>
            </tr>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>SubTotal</th>
            </tr>
        </thead>
        <tbody>
            <?php
            global $conexion;
            $queryDetalle = "SELECT
                    p.producto,
                    dv.cantidad,
                    dv.precio,
                    dv.subTotal
                    FROM
                    ventas AS v
                    INNER JOIN detalleVentas AS dv ON dv.idVenta = v.id
                    INNER JOIN t_archivos AS p ON p.id_archivo = dv.idProd
                    WHERE
                    v.id = '$idVenta'";
            $resDetalle = mysqli_query($conexion, $queryDetalle);
            $total = 0;
            while ($row = mysqli_fetch_assoc($resDetalle)) {
                $total = $total + $row['subTotal'];
            ?>
                <tr>
                    <td><?php echo $row['producto'] ?></td>
                    <td><?php echo $row['cantidad'] ?></td>
                    <td>$<?php echo $row['precio'] ?>.00</td>
                    <td>$<?php echo $row['subTotal'] ?>.00</td>
                </tr>
            <?php
            }
            ?>
            <tr>
                <td colspan="3" class="text-right">Total:</td>
                <td>$<?php echo $total; ?>.00</td>
            </tr>

        </tbody>
    </table>
</div>
<br>
    <a class="btn btn-success" target="_blank" href="imprimirFactura.php?idVenta=<?php echo $idVenta; ?>" role="button">  Imprimir  <i class="fas fa-file-pdf"></i> </a>

<?php
}

?>
<div>
<div>
