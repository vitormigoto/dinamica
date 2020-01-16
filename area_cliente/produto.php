<?php session_start(); 
require("config.php");
require("valida.php");

$_SESSION["current"] = basename( __FILE__ );

//********************************* ADICIONANDO PRODUTOS NO CARRINHO ******************************//
$cod_produto = $_GET["cod_produto"];
$produtos = array();
$produtos = $_SESSION["produtos"];

if(isset($cod_produto))
{	
	$produtos[]=$cod_produto;
	$_SESSION["produtos"] = $produtos;
}
$qtd = count($produtos);

//print_r(array_values($produtos));

?>
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
	<?php include "menu_nav.php";?>
	
		<nav aria-label="breadcrumb">
		  <ol class="breadcrumb bg-white">
			<li class="breadcrumb-item"><a href="#">Login</a></li>
			<li class="breadcrumb-item active" aria-current="page">Produtos</li>
		  </ol>
		</nav>
		<div class="row justify-content-center mb-5">
			<div class="col-12 col-sm-12 col-lg-12">
				<div class="card-body">
					<h2 align='center'>Produtos</h2>									
				</div>				 
								
				<div class="container mb-3">				
					<?php 
					
					$codp = $_GET["codp"];
					
					$sql = "SELECT * FROM produtos WHERE libera='S' and cod_produto='$codp'";
					$exe = mysqli_query($con,$sql);
					$num=0;
					$html="";
					while($res = mysqli_fetch_array($exe))
					{
						$caminho = explode(".",$res[4]);										
						$html.="
						<div class='row mb-2'>
							<div class='col-sm-12'>
								<div class='row'>
									<div class='col-sm-4 bg-light p-2 ml-5 rounded'>
										<div id='carouselExampleControls' class='carousel slide m-1' data-ride='carousel'>
											<ol class='carousel-indicators'>
											<li data-target='#carouselExampleIndicators' data-slide-to='0' class='active'></li>
											<li data-target='#carouselExampleIndicators' data-slide-to='1'></li>
											<li data-target='#carouselExampleIndicators' data-slide-to='2'></li>
										  </ol>
										  <div class='carousel-inner'>
											<div class='carousel-item active'>
											  <img class='rounded d-block w-100' src='$caminho[0]/1.jpg' alt='Primeiro Slide'>
											</div>
											<div class='carousel-item'>
											  <img class='rounded d-block w-100' src='$caminho[0]/2.jpg' alt='Segundo Slide'>
											</div>
											<div class='carousel-item'>
											  <img class='rounded d-block w-100' src='$caminho[0]/3.jpg' alt='Terceiro Slide'>
											</div>
										  </div>
										  <a class='carousel-control-prev' href='#carouselExampleControls' role='button' data-slide='prev'>
											<span class='carousel-control-prev-icon' aria-hidden='true'></span>
											<span class='sr-only'>Anterior</span>
										  </a>
										  <a class='carousel-control-next' href='#carouselExampleControls' role='button' data-slide='next'>
											<span class='carousel-control-next-icon' aria-hidden='true'></span>
											<span class='sr-only'>Próximo</span>
										  </a>
										</div>
										<!--<img class='rounded' width='100%' src='$res[4]' alt='$res[1]'>-->										
									</div>
									<div class='col-sm-4 bg-light p-2 mr-3 rounded'>
											<h5 class='card-title'>$res[1]</h5>																						
											<p class='card-text'><strong>Descrição:</strong>
											<br align='justify'>$res[2]</br></p>
											<p class='card-text'><a href='$caminho[0]/detalhes.pdf' class='text-danger' target='_blank'><span class='fas fa-file-pdf fa-4x text-danger'></span><br><strong>Detalhes</strong></a>
											
									</div>
									<div class='col-sm-3 bg-light p-2 rounded'>
										<h2 class='text-left'>R$ ".number_format($res[7],2,',','')."</h2>
										<p class='text-left text-black-50'>em até 6x sem juros</p>									
										<a href='produto.php?cod_produto=$res[0]&codp=$res[0]' class='btn btn-primary btn-block '>Adicionar <span class='fas fa-cart-plus fa-1x'></span></a>
										<h6 class='text-center'>Quantidade: $res[5]</h6>
									</div>
								</div>
							</div>
						</div>
						
							";
						$num++;												
					}
						echo $html;
					
					?>
					
				</div>
				
				<div class="card-body">
					<h2 align='center'>Outros Produtos</h2>									
				</div>
				<div class="container">				
					<?php 
					
					$sql = "SELECT * FROM produtos WHERE libera='S'";
					$exe = mysqli_query($con,$sql);
					$num=0;
					$html="<div class='row mb-2'>";
					while($res = mysqli_fetch_array($exe))
					{
						if($num==3)
						{
							$html.="</div><div class='row mb-2'>";
						}
						$html.="
							<div class='col-sm-4 mb-2'>
								<div class='card'>
									<a href='produto.php?codp=$res[0]'><img class='card-img-top' src='$res[4]' alt='$res[1]'></a>
									<div class='card-body text-center'>
										<h5 class='card-title'><a href='produto.php?codp=$res[0]'>$res[1]</a></h5>
										<p class='card-text' align='justify'>$res[2]</p>
										<h5 class='text-center'>R$ ".number_format($res[7],2,',','')."</h5>
										<a class='col-6 card-link justify-content-start' ><strong>Qtd: $res[5]</strong></a>
										<a href='produto.php?cod_produto=$res[0]' class='col-6  card-link btn btn-primary '>Adicionar <span class='fas fa-cart-plus fa-1x'></span></a>
									</div>
								</div>
							</div>
							";
						$num++;												
					}
					$html.="</div>";
						echo $html;
					
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

  </body>
</html>