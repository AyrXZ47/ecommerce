<?php
session_start();
require_once "../../clases/Conexion.php";
$c = new Conectar();
$conexion = $c->conexion();
$idUsuario = $_SESSION['idUsuario'];

$sql = "SELECT 			d.idVenta,
				r.nombre,
				r.email,
				r.direccion,
				d.idProd,
				d.cantidad,
				d.subtotal
			FROM 
				recibe AS r
				INNER JOIN
				detalleVentas AS d";
$result = mysqli_query($conexion, $sql);

?>

<div class="row">
	<div class="col-sm-12">
		<div class="table-responsive">
			<table class="table table-hover table-dark" id="tablaVentasDatatable">
				<thead>
					<tr>
						<th scope="col">Id de venta</th>
						<th scope="col">Cliente</th>
						<th scope="col">Email</th>
						<th scope="col">Dirección</th>
						<th scope="col">Id de producto</th>
						<th scope="col">Cantidad</th>
						<th scope="col">Subtotal</th>
					</tr>
				</thead>
				<tbody>
					<?php
					while ($mostrar = mysqli_fetch_array($result)) {
					?>
						<tr>
							<td><?php echo $mostrar[0] ?></td>
							<td><?php echo $mostrar[1] ?></td>
							<td><?php echo $mostrar[2] ?></td>
							<td><?php echo $mostrar[3] ?></td>
							<td><?php echo $mostrar[4] ?></td>
							<td><?php echo $mostrar[5] ?></td>
							<td>$<?php echo $mostrar[6] ?>.00</td>
						</tr>
					<?php
					}
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
	$('#tablaVentasDatatable').DataTable();
	});
</script>
