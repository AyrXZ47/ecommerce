<?php
$sql = "SELECT 		archivos.id_archivo as idArchivo,
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
				";
$result = mysqli_query($conexion, $sql);
?>
<?php
while ($mostrar = mysqli_fetch_array($result)) {
	$rutaArchivo = $mostrar['rutaArchivo'];
	$idArchivo = $mostrar['idArchivo'];
	$cat = $mostrar['categoria'];
	if ($cat == 'cat 2'){
?>
	<div class="col-sm-6 col-md-4 col-lg-3" style="float:left; margin-top:3vw; text-align:center; align-items:center; align-content:center;">
		<div class="card">
			<div class="card-body">
				<?php echo "<img src='admin/.$rutaArchivo' class='card-img-top'>";  ?>
				<div class="card-body">
					<p class="card-text">Categoria: <?php echo $mostrar['categoria'] ?></p>
					<h5 class="card-title"><strong><?php echo $mostrar['producto'] ?></h5></strong>
					<p class="card-text">$<?php echo $mostrar['precio'] ?>.00 MXN</p>
					<p class="card-text">Quedan <?php echo $mostrar['existencia'] ?> Disponibles</p>

					<span class="btn btn-primary" data-toggle="modal" data-target="#visualizarinfo" onclick="obtenerinfo('<?php echo $idArchivo ?>')">
						<i class="fas fa-info-circle"></i> Más información
					</span>
					<div class="mt-4">
						<button class="btn btn-success agregarCarrito" data-id="<?php echo $idArchivo ?>" data-nombre="<?php echo $mostrar['producto'] ?>" data-web_path="<?php echo "admin/.$rutaArchivo" ?>" data-precio="<?php echo $mostrar['precio'] ?>">
							<i class="fas fa-cart-plus fa-lg mr-2"></i>Agregar al carrito
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>


<?php
}
}
?>
<!-- Modal descripcion-->
<div class="modal fade" id="visualizarinfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Descripción</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div id="infoObtenida"></div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
			</div>
		</div>
	</div>
</div>
<script>
	function obtenerinfo(idArchivo) {
		$.ajax({
			type: "POST",
			data: "idArchivo=" + idArchivo,
			url: "verinfo.php",
			success: function(respuesta) {
				$('#infoObtenida').html(respuesta);
			}
		});
	}
</script>
