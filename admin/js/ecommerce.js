$(document).ready(function () {
    $.ajax({
        type: "post",
        url: "ajax/leerCarrito.php",
        dataType: "json",
        success: function (response) {
            llenaCarrito(response);
        }
    });
    $.ajax({
        type: "post",
        url: "ajax/leerCarrito.php",
        dataType: "json",
        success: function (response) {
            llenarTablaCarrito(response);
        }
    });
    function llenarTablaCarrito(response) {
        $("#tablaCarrito tbody").text("");
        var TOTAL = 0;
        response.forEach(element => {
            var precio = parseFloat(element['precio']);
            var totalProd = element['cantidad'] * precio;
            TOTAL = TOTAL + totalProd;
            $("#tablaCarrito tbody").append(
                `
                <tr>
                    <td><img src="${element['web_path']}" style="max-width:80px;"/> <br> ${element['nombre']}</td>
                    <td>
		<div style="position:absolute;">
                        <button type="button" class="btn-xs btn-primary menos" 
                        data-id="${element['id']}"
                        data-tipo="menos"
                        >-</button>
                        ${element['cantidad']}
                        <button type="button" class="btn-xs btn-success mas" 
                        data-id="${element['id']}"
                        data-tipo="mas"
                        >+</button>
                    </td>
		</div>
                    <td>$${totalProd.toFixed(2)}</td>
                    <td><i class="fa fa-trash text-danger borrarProducto" data-id="${element['id']}" ></i></td>
                <tr>
                `
            );
        });
        $("#tablaCarrito tbody").append(
            `
            <tr>
                <td colspan="2" class="text-right"><strong>Total:</strong></td>
                <td>$${TOTAL.toFixed(2)}</td>
                <td></td>
            <tr>
            `
        );
    }
    $.ajax({
        type: "post",
        url: "ajax/leerCarrito.php",
        dataType: "json",
        success: function (response) {
            llenarTablaPasarela(response);
        }
    });
    function llenarTablaPasarela(response) {
        $("#tablaPasarela tbody").text("");
        var TOTAL = 0;
        response.forEach(element => {
            var precio = parseFloat(element['precio']);
            var totalProd = element['cantidad'] * precio;
            TOTAL = TOTAL + totalProd;
            $("#tablaPasarela tbody").append(
                `
                <tr>
                    <td><img src="${element['web_path']}" style="max-width:80px;"/></td>
                    <td>${element['nombre']}</td>
                    <td>
                        ${element['cantidad']}
                        <input type="hidden" name="id[]" value="${element['id']}">
                        <input type="hidden" name="cantidad[]" value="${element['cantidad']}">
                        <input type="hidden" name="precio[]" value="${precio.toFixed(2)}">
                    </td>
                    <td>$${precio.toFixed(2)}</td>
                    <td>$${totalProd.toFixed(2)}</td>
                <tr>
                `
            );
        });
        $("#tablaPasarela tbody").append(
            `
            <tr>
                <td colspan="4" class="text-right"><strong>Total:</strong></td>
                <td>
                $${TOTAL.toFixed(2)}
                <input type="hidden" name="total" value="${TOTAL.toFixed(2) * 100}" >
                </td>
            <tr>
            `
        );
    }
    $(document).on("click", ".mas,.menos", function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        var tipo = $(this).data('tipo');
        $.ajax({
            type: "post",
            url: "ajax/cambiaCantidadProductos.php",
            data: { "id": id, "tipo": tipo },
            dataType: "json",
            success: function (response) {
                llenarTablaCarrito(response);
                llenaCarrito(response);
            }
        });
    });
    $(document).on("click", ".borrarProducto", function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        $.ajax({
            type: "post",
            url: "ajax/borrarProductoCarrito.php",
            data: { "id": id },
            dataType: "json",
            success: function (response) {
                llenarTablaCarrito(response);
                llenaCarrito(response);
            }
        });
    });
    $(".agregarCarrito").click(function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        var nombre = $(this).data('nombre');
        var web_path = $(this).data('web_path');
        var cantidad = 1;
        var precio = $(this).data('precio');
        $.ajax({
            type: "post",
            url: "ajax/agregarCarrito.php",
            data: { "id": id, "nombre": nombre, "web_path": web_path, "cantidad": cantidad, "precio": precio },
            dataType: "json",
            success: function (response) {
                llenaCarrito(response);
                $(".badgeProducto").hide(500).show(500);
            }
        });
    });
    function llenaCarrito(response) {
        var cantidad = Object.keys(response).length;
        if (cantidad > 0) {
            $(".badgeProducto").text(cantidad);
        } else {
            $(".badgeProducto").text("");
        }
        $(".listaCarrito").text("");
        response.forEach(element => {
            $(".listaCarrito").append(
                `

                    <!-- Message Start -->
                    <div class="container media">
                        <img src="${element['web_path']}" style="max-width:80px; border-radius: 200px 200px 200px 20opx; -webkit-border-radius: 200px 200px 200px 200px; -moz-border-radius: 200px 200px 200px 200px; margin:10px;">
                        <div class="media-body" style="margin:10px">
                            <h3 class="dropdown-item-title">
                                ${element['nombre']}
                            </h3>
                            <p class="text-sm">Cantidad ${element['cantidad']}</p>
                        </div>
                    </div>
                    <!-- Message End -->
                </a>
                <div class="dropdown-divider"></div>
                `
            );
        });
        $(".listaCarrito").append(
            `
	    <div style="text-align: center; align-items: center; justify-content: center; align-content: center;">
            <a href="index.php?modulo=carrito" style="margin:3px;" class="btn btn-outline-primary">
                Ver carrito 
                <i class="fa fa-cart-plus"></i>
            </a>

            <div class="dropdown-divider"></div>
            <a href="#" class="btn btn-outline-danger" style="margin:3px;" id="borrarCarrito">
                Borrar carrito 
                <i class="fa fa-trash"></i>
            </a>
	    </div>
            `
        );
    }
    $(document).on("click", "#borrarCarrito", function (e) {
        e.preventDefault();
        $.ajax({
            type: "post",
            url: "ajax/borrarCarrito.php",
            dataType: "json",
            success: function (response) {
                llenaCarrito(response);
            }
        });
    });

    var nombreRec = $("#nombreRec").val();
    var emailRec = $("#emailRec").val();
    var direccionRec = $("#direccionRec").val();
    $("#jalar").click(function (e) {
        var nombreCli = $("#nombreCli").val();
        var emailCli = $("#emailCli").val();
        var direccionCli = $("#direccionCli").val();

        if ($(this).prop("checked") == true) {
            $("#nombreRec").val(nombreCli);
            $("#emailRec").val(emailCli);
            $("#direccionRec").val(direccionCli);
        } else {
            $("#nombreRec").val(nombreRec);
            $("#emailRec").val(emailRec);
            $("#direccionRec").val(direccionRec);
        }

    });
});
