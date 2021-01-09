<?php
session_start();
require_once "admin/clases/Conexion.php";
$c = new Conectar();
$conexion = $c->conexion();

$queryRecibe = "SELECT nombre,email,direccion 
from recibe 
where idCli='" . $_SESSION['idcliente'] . "';";
$resRecibe = mysqli_query($conexion, $queryRecibe);
$rowRecibe = mysqli_fetch_assoc($resRecibe);

$queryCli = "SELECT nombre,email,direccion 
from t_clientes 
where id_cliente='" . $_SESSION['idcliente'] . "';";
$resCli = mysqli_query($conexion, $queryCli);
$rowCli = mysqli_fetch_assoc($resCli);

$idVenta = mysqli_real_escape_string($conexion, $_REQUEST['idVenta'] ?? '');
$queryVenta = "SELECT v.id,v.fecha
FROM ventas AS v
WHERE v.id = '$idVenta';";
$resVenta = mysqli_query($conexion, $queryVenta);
$rowVenta = mysqli_fetch_assoc($resVenta);
?>
<div>

    <img src="admin/img/logo.png" style="width: 30px;">
    My ecommerce

    <span style="float:right;">

        <strong>Fecha:</strong><?php echo $rowVenta['fecha'] ?>
        <br>
        <strong>ID Venta:</strong><?php echo $rowVenta['id'] ?>

    </span>
</div>


<table class="table table-striped table-hover" style="width:100%;">
    <tr>
        <th colspan="4"><br><br></th>
    </tr>
    <thead>
        <tr>
            <th scope="col"></th>
            <th scope="col">Cliente</th>
            <th scope="col"></th>
            <th scope="col">Recibe</th>
        </tr>
        <tr>
            <th colspan="4"><br></th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th scope="row">Nombre:</th>
            <td>
                <?php echo $rowCli['nombre'] ?>

            </td>
            <th scope="col"></th>
            <td>
                <?php echo $rowRecibe['nombre'] ?>
            </td>

        </tr>
        <tr>
            <th scope="row">Correo:</th>
            <td>
                <?php echo $rowCli['email'] ?>
            </td>
            <th scope="row"></th>
            <td>
                <?php echo $rowRecibe['email'] ?>
            </td>

        </tr>
        <tr>
            <th scope="row">Dirección:</th>

            <td>
                <?php echo $rowCli['direccion'] ?>
            </td>
            <th scope="row"></th>
            <td>
                <?php echo $rowRecibe['direccion'] ?>
            </td>
        </tr>
    </tbody>
    <tr>
        <th colspan="4"><br><br><br><br></th>
    </tr>
    <thead>
        <tr>
            <th scope="col">Producto</th>
            <th scope="col">Cantidad</th>
            <th scope="col">Precio</th>
            <th scope="col">SubTotal</th>
        </tr>
        <tr>
            <th colspan="4"><br></th>
        </tr>
    </thead>
    <tbody>
        <?php
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
                <th><?php echo $row['producto'] ?></th>
                <th><?php echo $row['cantidad'] ?></th>
                <th>$<?php echo $row['precio'] ?>.00</th>
                <th>$<?php echo $row['subTotal'] ?>.00</th>
            </tr>
        <?php
        }
        ?>
        <tr>
            <th colspan="4"><br><br><br></th>
        </tr>
        <tr>
            <th colspan="3" class="text-right" style="text-align: right;">Total:</th>
            <th>$<?php echo $total ?>.00</th>
        </tr>

    </tbody>
</table>

<?php $html = ob_get_clean(); ?>
<?php
include_once "dompdf/autoload.inc.php";

use Dompdf\Dompdf;

$pdf = new Dompdf();
$pdf->loadHtml($html);
$pdf->setPaper("A4", "landingscape");
$pdf->render();
$pdf->stream();
?>
