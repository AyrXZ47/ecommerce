<?php
session_start();
session_regenerate_id(true);
if (isset($_SESSION['usuario'])) {

?>
	<div class="container">
		<div class="jumbotron">
			<h1 class="display-4">Bienvenido</h1>
			<p class="lead">Gestiona los productos de tu empresa en línea</p>
			<hr class="my-4">

<div class="card col col-sm-3">
  <img src="img/cat.jpg" style="margin-top:15px;" class="card-img-top" alt="Categorías">
  <div class="card-body">
    <h5 class="card-title">Categorías</h5>
    <p class="card-text">Crea, edita y organiza áreas de tu empresa<br><br><br></p>
    <a href="index.php?modulo=cat" class="btn btn-primary">Ir a Categorías</a>
  </div>
</div>
<div class="card col col-sm-3">
  <img src="img/prod.jpg" style="margin-top:15px;" class="card-img-top" alt="Productos">
  <div class="card-body">
    <h5 class="card-title">Productos</h5>
    <p class="card-text">Elige la categoría, toma una foto del producto y sube todo lo que deseas vender en línea</p>
    <a href="index.php?modulo=prod" class="btn btn-primary"> Ir a Productos</a>
  </div>
</div>
<div class="card col col-sm-3">
  <img src="img/users.jpg" style="margin-top:15px;" class="card-img-top" alt="Usuarios">
  <div class="card-body">
    <h5 class="card-title">Tus clientes</h5>
    <p class="card-text">Obtén información de contacto de los clientes que se registran en tu página</p>
    <a href="index.php?modulo=clien" class="btn btn-primary">Ir a Clientes</a>
  </div>
</div>
<div class="card col col-sm-3">
  <img src="img/shop.jpg" style="margin-top:15px;" class="card-img-top" alt="Usuarios">
  <div class="card-body">
    <h5 class="card-title">Tus ventas</h5>
    <p class="card-text">Aquí consulta las compras realizadas en tu e-commerce, por tus clientes</p>
    <a href="index.php?modulo=vent" class="btn btn-primary">Ir a Ventas</a>
  </div>
</div>
		</div>
	</div>

<?php
} else {
	header("location:index.php");
}
?>
