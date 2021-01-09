<?php 
	require_once "admin/clases/Conexion.php";

	class Gestor extends Conectar{
		public function obtenerDescripcion($idArchivo) {
			$c = new Conectar();
			$conexion = $c->conexion();

			$sql = "SELECT descripcion 
					FROM t_archivos 
					WHERE id_archivo = '$idArchivo'";
			$result = mysqli_query($conexion, $sql);
			return mysqli_fetch_array($result)['descripcion'];
		}
    }

 ?>