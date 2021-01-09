<div class="wrapper fadeInDown">
    <div id="formContent">

      <div class="fadeIn first">
        <p></p>
	<h1>Registro de usuario</h1>
	<img src="img/logo.png" id="icon" alt="Logo" />
      </div>

      <!-- Login Form -->
<form id="frmRegistro" method="post" onsubmit="return agregarUsuarioNuevo()" autocomplete="off">
<input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre completo" required="">
<input type="text" name="fechaNacimiento" id="fechaNacimiento" class="form-control" placeholder="Fecha de nacimiento" required="" readonly="">
<input type="email" name="correo" id="correo" class="form-control" placeholder="Correo electrónico" required="">
<input type="text" name="usuario" id="usuario" class="form-control" placeholder="Nombre de usuario" required="">
<input type="text" maxlength="10" name="tel" id="tel" class="form-control" placeholder="Número de teléfono" required="">
<input type="password" name="password" id="password" class="form-control" placeholder="Contraseña" required="">
<input type="submit" class="fadeIn fourth" value="Regístrate">
</form>

      <div >
	<a class="underlineHover" href="index.php?modulo=iniciodesesiongestor"> Ir a inicio de sesión <i class="fas fa-sign-in-alt"></i></a>
      </div>

   </div>
</div>

	<script type="text/javascript">
		$(function() {
			var fechaA = new Date();
			var yyyy = fechaA.getFullYear();

			$("#fechaNacimiento").datepicker({
				changeMonth: true,
				changeYear: true,
				yearRange: '1900:' + yyyy,
				dateFormat: "dd-mm-yy"
			});
		});

		function agregarUsuarioNuevo() {
			$.ajax({
				method: "POST",
				data: $('#frmRegistro').serialize(),
				url: "procesos/usuario/registro/agregarUsuario.php",
				success: function(respuesta) {

					respuesta = respuesta.trim();

					if (respuesta == 1) {
						$("#frmRegistro")[0].reset();
						swal(":D", "Agregado con exito!", "success");
					} else if (respuesta == 2) {
						swal("Este usuario ya existe, por favor escribe otro !!!");
					} else {
						swal(":(", "Fallo al agregar!", "error");
					}
				}
			});

			return false;
		}
	</script>
