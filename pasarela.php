<link rel="stylesheet" type="text/css" href="admin/css/stripe.css">
<div class="container">
<div class="jumbotron">
<h1 class="display-4"><strong>Información de Pago</strong></h1>
<form action="index.php?modulo=factura" method="post" id="payment-form">
<div class="table-responsive">
    <table class="table table-borderless table-hover" id="tablaPasarela">
        <thead>
            <tr>
                <th>Imagen</th>
                <th>Nombre</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div> <br>
    <div class="form-row"> 
        <h4 class="mt3">Datos de su tarjeta</h4>
        <div id="card-element" class="form-control">
            <!-- A Stripe Element will be inserted here. -->
        </div>
        <!-- Used to display form errors. -->
        <div id="card-errors" role="alert"></div>
    </div>
    <div class="mt-3">
<p>
    <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#terminos" aria-expanded="false" aria-controls="terminos">  <i class="fas fa-info-circle"></i>  Terminos y condiciones  </button>
</p>
<div class="row">
  <div class="col">
    <div class="collapse multi-collapse" id="terminos">
      <div class="card card-body container">
        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Minima, soluta non quibusdam, assumenda mollitia expedita nihil quisquam sapiente optio rem reiciendis voluptatum laborum eos consectetur obcaecati sint incidunt doloribus placeat!
        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Minima, soluta non quibusdam, assumenda mollitia expedita nihil quisquam sapiente optio rem reiciendis voluptatum laborum eos consectetur obcaecati sint incidunt doloribus placeat!
	Lorem, ipsum dolor sit amet consectetur adipisicing elit. Minima, soluta non quibusdam, assumenda mollitia expedita nihil quisquam sapiente optio rem reiciendis voluptatum laborum eos consectetur obcaecati sint incidunt doloribus placeat!
      </div>
    </div>
  </div>
</div>
        <div class="form-check">
            <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="" id="" value="checkedValue" required="">
                Acepto los terminos y condiciones
            </label>
        </div>
    </div>
    <div class="mt-3">
        <a class="btn btn-primary" href="index.php?modulo=envio" role="button"> <i class="far fa-edit"></i> Editar envío  </a>
        <button type="submit" class="btn btn-success">Pagar <i class="fas fa-check-circle"></i> </button>
    </div>
</form>
</div>
</div>
    <script src="https://js.stripe.com/v3/"></script>
    <script src="admin/js/stripe.js"></script>
