	<?php
	
	if($_SESSION["current"]=="login.php")
	{
		$mprodutos = "<span class='sr-only'>(atual)</span>";
	}
	if($_SESSION["current"]=="perfil.php")
	{
		$perfil = "<span class='sr-only'>(atual)</span>";
	}
	if($_SESSION["current"]=="pedidos.php")
	{
		$pedidos = "<span class='sr-only'>(atual)</span>";
	}
	
	if($qtd>0)
	{
		$badge = "<span class='badge badge-light'>$qtd</span>";
	}
	?>
	
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark rounded">
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarTogglerDemo01">
			<ul class="navbar-nav mr-auto mt-2 mt-lg-0">
				<li class="nav-item active">
					<a class="nav-link" href="login.php">Produtos <?php echo $mprodutos;?></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#">Meus Dados<?php echo $perfil;?></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#">Meus Pedidos<?php echo $pedidos;?></a>
				</li>
			</ul>			
			<a href="index.php" class="btn btn-dark my-2 my-sm-0">Sair</a>
			<a href="carrinho.php" class="btn btn-dark my-2 my-sm-0">
				<span class='fas fa-shopping-cart fa-1x'></span>
				<?php echo $badge;?>
			</a>
		</div>
	</nav>