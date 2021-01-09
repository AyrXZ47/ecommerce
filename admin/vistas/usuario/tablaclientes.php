<?php
session_start();
require_once "../../clases/Conexion.php";
$c = new Conectar();
$conexion = $c->conexion();
$idUsuario = $_SESSION['idUsuario'];

$sql = "SELECT id_cliente,
				nombre,
				fechaNacimiento,
				email,
				tel
			FROM 
			    t_clientes";
$result = mysqli_query($conexion, $sql);

?>

<div class="row">
	<div class="col-sm-12">
		<div class="table-responsive">
			<table class="table table-hover table-dark" id="tablaClientesDatatable">
				<thead>
					<tr>
						<th scope="col">Id cliente</th>
						<th scope="col">Nombre</th>
						<th scope="col">Fecha de nacimiento</th>
						<th scope="col">Email</th>
						<th scope="col">Teléfono</th>
					</tr>
				</thead>
				<tbody>
					<?php

					/*
						Arreglo de extensiones validas
					*/


					while ($mostrar = mysqli_fetch_array($result)) {

					?>
						<tr>
							<td><?php echo $mostrar[0] ?></td>
							<td><?php echo $mostrar[1] ?></td>
							<td><?php echo $mostrar[2] ?></td>
							<td><?php echo $mostrar[3] ?></td>
							<td><?php echo $mostrar[4] ?></td>
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
	$('#tablaClientesDatatable').DataTable();
	});
</script>
