<!doctype html>
<html lang="pt-br">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    
	<!-- Fontawersome -->	
	<link href="bootstrap/font/css/all.css" rel="stylesheet"> <!--load all styles -->	

    <title>Plataforma do Cliente</title>

	<?php include("config.php");?>
	
  </head>
  <body>
	<header class=''>
	<div class="bg-light shadow-sm mb-3">
        <div class="container d-flex justify-content-between">
			<h1>
				<a href="../index.php" class="nav-link"><img src="images/logo_xpto_color.png" class="img-fluid"  style="height:30px;" alt="XPTO Company"></a>
			</h1>   
        </div>
     </div>   
	<header>


    <div class="container">
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb bg-white">
		<li class="breadcrumb-item"><a href="index.php">Login</a></li>
		<li class="breadcrumb-item active" aria-current="page">Novo Cliente</li>
	  </ol>
	</nav>
		<div class="row justify-content-center">
			<div class="col-12 col-sm-6 col-lg-8">
				<div class="card-body">
					<h2 align='center'>Novo Cliente</h2>
					
					<?php
					
						$email 		= $_GET["email"];
						
						
						if(($email==""))
						{
							echo "
							<div class='card border-danger shadow-sm' >
								<div class='card-header text-white bg-danger'>
									<b>ERRO!!!</b>
								</div>
								<div class='card-body bg-light text-danger '>									
									<p class='card-text'>Erro ao validar seu email. Entre em contato com o suporte.</p>
									<a href='index.php' class='btn btn-primary'>Voltar</a>
								</div>
							</div>
							";
						}
						else
						{
							
							
								$sql = "UPDATE cliente SET status='S' WHERE email='$email'";
								$exe = mysqli_query($con,$sql);
								echo "
								<div class='card border-success shadow-sm' >
									<div class='card-header text-white bg-success'>
										<b>Sucesso!!!</b>
									</div>
									<div class='card-body bg-light '>									
										<p class='card-text'>Seu email está validado! Agora você pode retornar ao início e realizar seu login!</p>
										<a href='index.php' class='btn btn-primary'>Voltar</a>
									</div>
								</div>
								";																
								envia("$email","Usuário","Confirmação de Cadastro","Confirmação de Cadastro","Seu email foi validado com sucesso! Obrigado por se cadastrar em nosso site.","http://www.sibox.com.br/","Acessar o Site","#","#");
								
							
						}
					?>
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
    <script src="bootstrap/js/bootstrap.min.js"></script>
	<script src="bootstrap/js/mask/jquery.mask.js"></script>
	<script src="bootstrap/js/mask/jquery.mask.min.js"></script>

  </body>
</html>