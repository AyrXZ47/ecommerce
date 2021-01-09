<?php
session_start();
if (isset($_SESSION['idUsuario'])) {
?>
	<div class="container">
		<div class="jumbotron">
			<h1 class="display-4"><strong>Productos</strong></h1>
			<span class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarArchivos">
				<span class="fas fa-plus-circle"></span> Agrega un nuevo producto :D
			</span>
			<hr>
			<div id="tablaGestorArchivos"></div>
		</div>
	</div>

	<!--Modal para agregar archivos-->
	<div class="modal fade" id="modalAgregarArchivos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content ">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Productos</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id="frmArchivos" enctype="multipart/form-data">
						<label>Categoria</label>
						<div id="categoriasLoad"></div>
						<input type="text" class="form-control input-sm" id="producto" name="producto" placeholder="Producto">
						<input type="text" class="form-control input-sm" id="precio" name="precio" placeholder="Precio (sin puntos ni simbolos)">
						<input type="text" class="form-control input-sm" id="existencia" name="existencia" placeholder="Existencia">
						<textarea class="form-control" id="descripcion" name="descripcion" wrap="hard" placeholder="Descripcion: (sin símbolos especiales)"></textarea>
						<input type="file" name="archivos[]" id="archivos" class="form-control" multiple="multiple" placeholder="Archivo">
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
					<button type="button" class="btn btn-success" id="btnGuardarArchivos">Guardar</button>
				</div>
			</div>
		</div>
	</div>



	<!-- Modal -->
	<div class="modal fade" id="visualizarArchivo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Archivo</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div id="archivoObtenido" style="max-width:40vw;" ></div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
				</div>
			</div>
		</div>
	</div>
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
	<script src="js/gestor.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$('#tablaGestorArchivos').load("vistas/gestor/tablaGestor.php");
			$('#categoriasLoad').load("vistas/categorias/selectCategorias.php");

			$('#btnGuardarArchivos').click(function() {
				agregarArchivosGestor();
			});

		});
	</script>

<?php
} else {
	header("location:index.php");
}
?>
