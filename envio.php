<?php
if (isset($_SESSION['idcliente'])) {
    if (isset($_REQUEST['guardar'])) {
        $nombreCli = $_REQUEST['nombreCli'] ?? '';
        $emailCli = $_REQUEST['emailCli'] ?? '';
        $direccionCli = $_REQUEST['direccionCli'] ?? '';
        $queryCli = "UPDATE t_clientes set nombre='$nombreCli',email='$emailCli',direccion='$direccionCli' where id_cliente='" . $_SESSION['idcliente'] . "' ";
        $resCli = mysqli_query($conexion, $queryCli);

        $nombreRec = $_REQUEST['nombreRec'] ?? '';
        $emailRec = $_REQUEST['emailRec'] ?? '';
        $direccionRec = $_REQUEST['direccionRec'] ?? '';
        $queryRec = "INSERT INTO recibe (nombre,email,direccion,idCli) VALUES ('$nombreRec','$emailRec','$direccionRec','" . $_SESSION['idcliente'] . "')
        ON DUPLICATE KEY UPDATE
        nombre='$nombreRec',email='$emailRec',direccion='$direccionRec'; ";
        $resRec = mysqli_query($conexion, $queryRec);
        if ($resCli && $resRec) {
            echo '<meta http-equiv="refresh" content="0; url=index.php?modulo=pasarela" />';
        } else {
?>
            <div class="alert alert-danger" role="alert">
                Error
            </div>
    <?php
        }
    }
    $queryCli = "SELECT nombre,email,direccion from t_clientes where id_cliente='" . $_SESSION['idcliente'] . "';";
    $resCli = mysqli_query($conexion, $queryCli);
    $rowCli = mysqli_fetch_assoc($resCli);

    $queryRec = "SELECT nombre,email,direccion from recibe where idCli='" . $_SESSION['idcliente'] . "';";
    $resRec = mysqli_query($conexion, $queryRec);
    $rowRec = mysqli_fetch_assoc($resRec);

?> 
<div class="container">
	<div class="jumbotron">
		<h1 class="display-4"><strong>Información de envío</strong></h1>
    <form method="post">
        <div class="container mt-3">
            <div class="row">
                <div class="col-sm">
                    <h3>Datos del cliente</h3> <br>
                    <div class="form-group">
                        <label for="">Nombre</label>
                        <input type="text" name="nombreCli" id="nombreCli" class="form-control" value="<?php echo $rowCli['nombre'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" name="emailCli" id="emailCli" class="form-control" readonly="readonly" value="<?php echo $rowCli['email'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="">Direccion</label>
                        <textarea name="direccionCli" id="direccionCli" class="form-control" row="3"><?php echo $rowCli['direccion'] ?></textarea>
                    </div>
                </div>
                <div class="col-sm">
		    <h3>Datos de quien recibe</h3>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" id="jalar">
                            ¿Utilizar los mismos datos?
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="">Nombre</label>
                        <input type="text" name="nombreRec" id="nombreRec" class="form-control" value="<?php echo $rowRec['nombre'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" name="emailRec" id="emailRec" class="form-control" value="<?php echo $rowRec['email'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="">Direccion</label>
                        <textarea name="direccionRec" id="direccionRec" class="form-control" row="3"><?php echo $rowRec['direccion'] ?></textarea>
                    </div>

                </div>
            </div>
        </div>
        <a class="btn btn-primary" href="index.php?modulo=carrito" role="button"> <i class="fas fa-arrow-circle-left"></i> Regresar al carrito</a>
        <button type="submit" class="btn btn-success" name="guardar" value="guardar">Ir a pagar <i class="fas fa-arrow-circle-right"></i> </button>
    </form>
<?php
} else {
?>

    <div style="padding:50px; background:rgba(0,0,0,0.7); color:rgba(255,255,255,1); font-size:25px; border-radius: 50px 50px 50px 50px; -webkit-border-radius: 50px 50px 50px 50px; -moz-border-radius: 50px 50px 50px 50px;" class="container">
<div class="col">
Para poder continuar tienes que 
</div>
<div class="col">
<a href="index.php?modulo=login" class="btn btn-outline-primary"> <i class="fas fa-sign-in-alt"></i> Iniciar Sesión</a>
<div>
<div class="col">
o
<div>
<div class="col">
<a href="index.php?modulo=registro" class="btn btn-outline-primary"> <i class="fas fa-user-plus"></i> Crear Una Cuenta</a>
<div>

    </div>
<?php

}
?>
	</div>
</div>
