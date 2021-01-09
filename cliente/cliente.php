<?php  
	
	require_once "../admin/clases/Conexion.php";

	class cliente extends Conectar{

		public function agregarcliente($datos) {
			$c = new Conectar();
			$conexion = $c->conexion();

			if (self::buscarclienteRepetido($datos['cliente'])) {
				return 2;  
			}else {
				$sql = "INSERT INTO t_clientes (nombre,
											fechaNacimiento,
											email,
											cliente,
											tel,
											password) 
							VALUES (?, ?, ?, ?, ?, ?)";
				$query = $conexion->prepare($sql);
				$query->bind_param('ssssss', $datos['nombre'],
											$datos['fechaNacimiento'],
											$datos['email'],
											$datos['cliente'],
											$datos['tel'],
											$datos['password']);
				$exito = $query->execute();
				$query->close();
				return $exito;
			}
		}

		public function buscarclienteRepetido($cliente) {
			$c = new Conectar();
			$conexion = $c->conexion();

		    	$sql = "SELECT cliente 
				         FROM t_clientes 
				         WHERE cliente = '$cliente'";
			$result = mysqli_query($conexion, $sql);
			$datos = mysqli_fetch_array($result);

			if ($datos != NULL) {
				if ($datos['cliente'] != "" || $datos['cliente'] == $cliente) {
					return 1;
				} else {
					return 0;
				}
			} else {
				return 0;
			}
		}

		public function login($cliente, $password) {
			$c = new Conectar();
			$conexion = $c->conexion();

			$sql = "SELECT count(*) as existecliente 
					FROM t_clientes 
					WHERE cliente = '$cliente' 
						AND password = '$password'";
			$result = mysqli_query($conexion, $sql);

			$respuesta = mysqli_fetch_array($result)['existecliente'];

			if ($respuesta > 0) {
				$_SESSION['cliente'] = $cliente;

				$sql = "SELECT id_cliente 
						FROM t_clientes 
						WHERE cliente = '$cliente' 
						AND password = '$password'";
				$result = mysqli_query($conexion ,$sql);
				$idcliente = mysqli_fetch_row($result)[0];

				$_SESSION['idcliente'] = $idcliente;

				return 1;
			} else {
				return 0;
			}
		}
	}
	
 ?>
