function agregarArchivosGestor() {
	var formData = new FormData(document.getElementById('frmArchivos'));

	$.ajax({
		url: "procesos/gestor/guardarArchivos.php",
		type: "POST",
		datatype: "html",
		data: formData,
		cache: false,
		contentType: false,
		processData: false,
		success: function (respuesta) {
			console.log(respuesta);
			respuesta = respuesta.trim();

			if (respuesta == 1) {
				$('#frmArchivos')[0].reset();
				$('#tablaGestorArchivos').load("vistas/gestor/tablaGestor.php");
				swal(":D", "¡Agregado con exito!", {
								icon: "success",
							});
			} else {
				swal(":(", "Fallo al agregar",{
					icon:"error",
				});
			}
		}
	});
}



function eliminarArchivo(idArchivo) {
	swal({
		title: "¿Estas seguro de eliminar este producto?",
		text: "Una vez eliminado, no podra recuperarse",
		icon: "warning",
		buttons: true,
		dangerMode: true,
	})
		.then((willDelete) => {
			if (willDelete) {
				$.ajax({
					type: "POST",
					data: "idArchivo=" + idArchivo,
					url: "procesos/gestor/eliminaArchivo.php",
					success: function (respuesta) {
						console.log(respuesta);
						respuesta = respuesta.trim();
						if (respuesta == 1) {


							$('#tablaGestorArchivos').load("vistas/gestor/tablaGestor.php");
							swal(":D","¡Eliminado con exito!", {
								icon: "success",
							});
						} else {
							swal(":(","Error al eliminar", {
								icon: "error",
							});
						}


					}
				});
			}
		});
}


function obtenerArchivoPorId(idArchivo) {
	$.ajax({
		type: "POST",
		data: "idArchivo=" + idArchivo,
		url: "procesos/gestor/obtenerArchivo.php",
		success: function (respuesta) {
			$('#archivoObtenido').html(respuesta);
		}
	});
}
function obtenerinfo(idArchivo) {
	$.ajax({
		type: "POST",
		data: "idArchivo=" + idArchivo,
		url: "procesos/gestor/verinfo.php",
		success: function (respuesta) {
			$('#infoObtenida').html(respuesta);
		}
	});
}
