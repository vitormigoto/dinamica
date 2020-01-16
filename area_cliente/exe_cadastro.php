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
					
						$nome 		= $_POST["nome"];
						$dt_nasc	= $_POST["dt_nasc"];
						$cpf		= $_POST["cpf"];
						$telefone	= $_POST["telefone"];	
						$celular	= $_POST["celular"];
						$email		= $_POST["email"];
						$senha		= $_POST["senha"];
						$cep		= $_POST["cep"];
						$endereco	= $_POST["endereco"];
						$numero		= $_POST["numero"];
						$bairro		= $_POST["bairro"];
						$cidade		= $_POST["cidade"];
						$estado		= $_POST["estado"];
						
						if(($nome=="") OR ($dt_nasc=="") OR ($cpf=="") OR ($telefone=="") OR ($email=="") OR ($senha=="")OR ($cep=="") OR ($endereco=="")OR ($numero=="") OR($cidade=="") OR ($estado=="") OR ($bairro==""))
						{
							echo "
							<div class='card border-danger shadow-sm' >
								<div class='card-header text-white bg-danger'>
									<b>ERRO!!!</b>
								</div>
								<div class='card-body bg-light text-danger '>									
									<p class='card-text'>Algum campo necessário ficou sem ser preenchido. Favor retornar e tentar novamente o cadastro.</p>
									<a href='javascript:history.back();' class='btn btn-primary'>Voltar</a>
								</div>
							</div>
							";
						}
						else
						{
							$senha = password_hash($senha, PASSWORD_DEFAULT);
							$sql = "SELECT * FROM cliente WHERE email='$email'";
							$exe = mysqli_query($con,$sql);
							if(mysqli_num_rows($exe)>=1)
							{
								echo "
								<div class='card border-danger shadow-sm' >
									<div class='card-header text-white bg-danger'>
										<b>EMAIL JÁ CADASTRADO!</b>
									</div>
									<div class='card-body bg-light text-danger '>									
										<p class='card-text'>O email <u>$email</u> já foi utilizado em outro cadastro. Se você esqueceu sua senha clique no botão abaixo para recuperar. Caso queria realizar um novo cadastro clique em voltar.</p>
										<div class='btn-group btn-group-toggle' data-toggle='buttons'>
											<a href='recupera_senha.php' class='btn btn-success'>Recuperar Senha</a>
											<a href='javascript:history.back();' class='btn btn-primary'>Voltar</a>
										</div>
									</div>
								</div>
							";
							}
							else
							{
							
								$sql = "INSERT INTO cliente(nome,cpf,telefone,celular,email,senha,endereco,numero,bairro,cep,cidade,estado,dt_nasc,dt_cadastro,status)
										VALUES('$nome','$cpf','$telefone','$celular','$email','$senha','$endereco','$numero','$bairro','$cep','$cidade','$estado','$dt_nasc',NOW(),'S')";
								$exe = mysqli_query($con,$sql);
								echo "
								<div class='card border-success shadow-sm' >
									<div class='card-header text-white bg-success'>
										<b>Sucesso!!!</b>
									</div>
									<div class='card-body bg-light '>									
										<p class='card-text'>Cadastro realizado com sucesso! Você receberá um email para confirmar seu cadastro, favor acessar seu email antes de efetuar seu login!</p>
										<a href='index.php' class='btn btn-primary'>Voltar</a>
									</div>
								</div>
								";																
								envia("$email","$nome","Confirmação de Cadastro","Confirmação de Cadastro","Seu cadastro no site SiBox foi realizado com sucesso! O próximo passo agora é clicar no botão abaixo para confirmar seu cadastro!","http://www.sibox.com.br/novo/area_cliente/confirma_conta.php?email=$email","Confirmar Email","Verifique seu email para confirmação do cadastro","Erro ao encaminhar o seu email. Entre em contato com o nosso suporte.");
								
							}
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