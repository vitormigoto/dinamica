<?php 
session_start();
session_destroy();?>
<!doctype html>
<html lang="pt-br">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" >

	<!-- Fontawersome -->	
	<link href="bootstrap/font/css/all.css" rel="stylesheet"> <!--load all styles -->	
    <title>Plataforma do Cliente</title>
  </head>
  <body >
	<header>
	<div class="bg-light shadow-sm mb-3">
        <div class="container d-flex justify-content-between">
			<h1>
				<a href="../index.php" class="nav-link"><img src="images/logo_xpto_color.png" class="img-fluid"  style="height:30px;" alt="XPTO Company"></a>
			</h1>    
        </div>
     </div>
	</header> 

	
    <div class="container">
		<div class="row justify-content-center">
			<div class="col-12 col-sm-6 col-lg-8">
				<div class="card-body">
					<?php 
					if($_GET["erro"]=="1")
					{
						echo "
						<div class='alert alert-warning alert-dismissible fade show' role='alert'>
						  <strong>Acesso Negado! </strong> Sua senha ou usuário estão incorretos. Verifique e digite novamente.
						  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
							<span aria-hidden='true'>&times;</span>
						  </button>
						</div>";
					}
					?>
					<h2 align='center'>Área do Cliente</h2>
					
					<form action="login.php" method="post">
						<div class="form-group">
							<label for="txt_email">E-mail</label>
							<input type="email" name='email' class="form-control" id="txt_email" placeholder="Digite seu email" required>
						</div>
						<div class="form-group">
							<label for="txt_senha">Senha</label>
							<input type="password" name='senha' class="form-control" id="txt_senha" placeholder="Digite sua Senha" required>
						</div>
						<button type="submit" class="btn btn-primary btn-block">Entrar</button>
						<a href='cadastro.php' class="btn btn-success btn-block">Cadastre-se</a>
					</form>
				</div>
			</div>

		</div>
	</div>


	<footer class="footer mt-auto py-3  bg-light">
      <div class="container text-center">
        <span class="text-muted" >XPTO Company - São José dos Campos/SP</span>
      </div>
    </footer>	
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="bootstrap/js/jquery-3.4.1.min.js" ></script>
    <script src="bootstrap/js/popper.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js" ></script>
  </body>
</html>