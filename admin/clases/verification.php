<?php
$ADMIN = $_GET['ADMIN'];
?>


	<script type="text/javascript">
		var user = '<?php echo $ADMIN; ?>';
			$.ajax({
				method: "POST",
				data: {user},
				url: "clases/verifiuser.php",
				success: function(respuesta) {

					respuesta = respuesta.trim();

					if (respuesta == 1) {
						swal("¡Genial! :D", "Tu cuenta ha sido verificada",{
							icon: "success",
						});
					} else if (respuesta == 2) {
						swal(":c", "Hubo un error al verificar tu cuenta, intentalo de nuevo",{
							icon: "error",
					});
					} else {
						swal(":(", "Lo sentimos, algo salió mal", "Error",{
							icon: "error",
					});
					}
				}
			});

	</script>
