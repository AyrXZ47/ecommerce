<div style="margin-bottom:100px;"></div>
<!-- Navigation -->
<nav class="navbar fixed-top">
	<div class="container">
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
			<i style="color:#005eff;" class="fas fa-bars"></i>
		</button>
	            <a class="nav-link" data-toggle="dropdown" id="iconoCarrito">
	                <i class="fa fa-cart-plus" aria-hidden="true"></i>
	                <span class="badge badge-danger navbar-badge badgeProducto"></span>
	            </a>
	            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right listaCarrito" style="max-height: 500px; overflow-y: auto; background-attachment: local, local, scroll, scroll; margin:15px;"></div>
		<div class="collapse navbar-collapse" id="navbarResponsive">
		<ul class="navbar-nav ml-auto">
			<li class="nav-item">
				<a class="nav-link" href="index.php?modulo=inicio">
				<img src="admin/img/logo.png" alt="Logo" width="75px">
				</a>
			</li>
        <!-- Login -->
	            <?php
                    if (isset($_SESSION['idcliente']) == false) {
                    ?><li class="nav-item">
	                    <a href="index.php?modulo=login" class="btn btn-outline-primary">
				<i class="fa fa-user-friends" aria-hidden="true"></i> Iniciar Sesión 
			    </a>
			</li>
	                <?php
                    } else {
                    ?><li class="nav-item">
			<a class="navbar-brand">
				<i class="fas fa-user text-primary mr-2"></i>Hola <?php echo $_SESSION['cliente']; ?>
			</a>
			</li>
			    <form action="index.php" method="post">
			<li class="nav-item">
	                        <button name="accion" class="btn btn-outline-danger" type="submit" value="cerrar" >
	                        	<i class="fas fa-power-off"> Salir </i> 
				</button>
			</li>
	                    </form>
	                <?php
                    }
                    ?>

		</ul>
	      </div>
	</div>
</nav>
