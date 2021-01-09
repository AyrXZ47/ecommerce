<div class="wrapper fadeInDown">
    <div id="formContent">

      <div class="fadeIn first">
        <p></p>
        <img src="admin/img/logo.png" id="icon" alt="Logo" />
      </div>

      <!-- Login Form -->
      <form method="post" id="frmLogin" onsubmit="return log()">
        <input type="text" id="login" class="fadeIn second" name="login" placeholder="Usuario" required="">
        <input type="password" id="password" class="fadeIn third" name="password" placeholder="Contraseña" required="">
        <input type="submit" class="fadeIn fourth " value="Iniciar sesión">
      </form>

      <div >
        <a class="underlineHover" href="index.php?modulo=registro">Crear Cuenta <i class="fas fa-sign-in-alt"></i></a>
      </div>

    </div>
  </div>

  <script type="text/javascript">
    function log() {
      $.ajax({
        type: "POST",
        data: $('#frmLogin').serialize(),
        url: "cliente/login.php",
        success: function(respuesta) {

          respuesta = respuesta.trim();
          if (respuesta == 1) {
            window.location = "index.php?modulo=inicio";
          } else {
            swal(":(", "Fallo al entrar!", "error");
          }
        }
      });

      return false;
    }
  </script>
