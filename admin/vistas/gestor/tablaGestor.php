<?php
session_start();
require_once "../../clases/Conexion.php";
$c = new Conectar();
$conexion = $c->conexion();
$idUsuario = $_SESSION['idUsuario'];

$sql = "SELECT 
			archivos.id_archivo as idArchivo,
			usuario.nombre as nombreUsuario,
			categorias.nombre as categoria,
			archivos.nombre as nombreArchivo,
			archivos.tipo as tipoArchivo,
			archivos.ruta as rutaArchivo,
			archivos.fecha as fecha,
			producto,
			precio,
			existencia,
			descripcion
			FROM
			    t_archivos AS archivos
			        INNER JOIN
			    t_usuarios AS usuario ON archivos.id_usuario = usuario.id_usuario
			        INNER JOIN
			    t_categorias AS categorias ON archivos.id_categoria = categorias.id_categoria
				and archivos.id_usuario = '$idUsuario'";
$result = mysqli_query($conexion, $sql);

?>
<div class="row">
	<div class="col-sm-12">
		<div class="table-responsive">
			<table class="table table-hover table-dark" id="tablaGestorDataTable">
				<thead>
					<tr>
						<th scope="col">Categoria</th>
						<th scope="col">Producto</th>
						<th scope="col">Id</th>
						<th scope="col">Precio</th>
						<th scope="col">Existencia</th>
						<th scope="col">Descripción</th>
						<th scope="col">Imagenes</th>
						<th scope="col">Acciones</th>
					</tr>
				</thead>
				<tbody>
					<?php

					/*
						Arreglo de extensiones validas
					*/

					$extensionesValidas = array('png', 'jpg', 'pdf', 'mp3', 'mp4');

					while ($mostrar = mysqli_fetch_array($result)) {

						$rutaDescarga = "archivos/" . $idUsuario . "/" . $mostrar['nombreArchivo'];
						$nombreArchivo = $mostrar['nombreArchivo'];
						$idArchivo = $mostrar['idArchivo'];
					?>
						<tr>
							<td><?php echo $mostrar['categoria']; ?></td>
							<td><?php echo $mostrar[7] ?></td>
							<td><?php echo $mostrar['idArchivo'] ?></td>
							<td>$<?php echo $mostrar[8] ?>.00</td>
							<td><?php echo $mostrar[9] ?></td>
							<td>
								<span class="btn btn-primary btn-sm" data-toggle="modal" data-target="#visualizarinfo" onclick="obtenerinfo('<?php echo $idArchivo ?>')">
									<span class="fas fa-eye"></span>
								</span>
							</td>
		</div>
	</div>




	<td><?php echo $mostrar['nombreArchivo']; ?>
	</td>
	<td>
		<a href="<?php echo $rutaDescarga; ?>" download="<?php echo $nombreArchivo; ?>" class="btn btn-success btn-sm">
			<span class="fas fa-download"></span>
		</a>


		<?php
						for ($i = 0; $i < count($extensionesValidas); $i++) {
							if ($extensionesValidas[$i] == $mostrar['tipoArchivo']) {
		?>
				<span class="btn btn-primary btn-sm" data-toggle="modal" data-target="#visualizarArchivo" onclick="obtenerArchivoPorId('<?php echo $idArchivo ?>')">
					<span class="fas fa-eye"></span>
				</span>
		<?php
							}
						}
		?>

		<span class="btn btn-danger btn-sm" onclick="eliminarArchivo('<?php echo $idArchivo ?>')">
			<span class="fas fa-trash-alt"></span>
		</span>
	</td>
	</tr>
<?php
					}
?>
</tbody>
</table>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		$('#tablaGestorDataTable').DataTable();
	});
</script>
