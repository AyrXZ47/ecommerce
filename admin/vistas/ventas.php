<?php
session_start();
if (isset($_SESSION['idUsuario'])) {
?>
	<div class="container">
		<div class="jumbotron">
			<h1 class="display-4"><strong>Ventas</strong></h1>
			<hr>
			<div id="tablaventas"></div>
		</div>
	</div>
	<script type="text/javascript">
		$(document).ready(function() {
			$('#tablaventas').load("vistas/ventas/tablaventas.php");
		});
	</script>

<?php
} else {
	header("location:index.php");
}
?>
