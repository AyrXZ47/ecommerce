<?php
session_start();
if (isset($_SESSION['idUsuario'])) {
?>
	<div class="container">
		<div class="jumbotron">
			<h1 class="display-4"><strong>Clientes</strong></h1>
			<hr>
			<div id="tablaclientes"></div>
		</div>
	</div>
	<script type="text/javascript">
		$(document).ready(function() {
			$('#tablaclientes').load("vistas/usuario/tablaclientes.php");
		});
	</script>

<?php
} else {
	header("location:index.php");
}
?>
