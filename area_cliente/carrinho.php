<?php session_start(); 
require("config.php");
require("valida.php");

$_SESSION["current"] = basename( __FILE__ );


//*********************************CALCULO DO FRETE ***********************************************//

# 
# implementa funcao de calculo de preços e prazos 
# para serviços dos correios
#
if( !function_exists( 'calculaFrete' ))
{
   function calculaFrete(
      $cod_servico, /* codigo do servico desejado */
      $cep_origem,  /* cep de origem, apenas numeros */
      $cep_destino, /* cep de destino, apenas numeros */
      $peso,        /* valor dado em Kg incluindo a embalagem. 0.1, 0.3, 1, 2 ,3 , 4 */
      $altura,      /* altura do produto em cm incluindo a embalagem */
      $largura,     /* altura do produto em cm incluindo a embalagem */
      $comprimento, /* comprimento do produto incluindo embalagem em cm */
      $valor_declarado='0' /* indicar 0 caso nao queira o valor declarado */
   ){

      $cod_servico = strtoupper( $cod_servico );
      if( $cod_servico == 'SEDEX10' ) $cod_servico = 40215 ; 
      if( $cod_servico == 'SEDEXACOBRAR' ) $cod_servico = 40045 ; 
      if( $cod_servico == 'SEDEX' ) $cod_servico = 40010 ; 
      if( $cod_servico == 'PAC' ) $cod_servico = 41106 ;
	  
	  /*$cod_servico = strtoupper( $cod_servico );
      if( $cod_servico == 'SEDEX10' ) $cod_servico = 40215 ; 
      if( $cod_servico == 'SEDEXACOBRAR' ) $cod_servico = 40045 ; 
      if( $cod_servico == 'SEDEX' ) $cod_servico = 40010 ; 
      if( $cod_servico == 'PAC' ) $cod_servico = 41106 ;
	  */
      # ###########################################
      # Código dos Principais Serviços dos Correios
      # 41106 PAC sem contrato
      # 40010 SEDEX sem contrato
      # 40045 SEDEX a Cobrar, sem contrato
      # 40215 SEDEX 10, sem contrato
      # ###########################################

      $correios = "http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx?nCdEmpresa=&sDsSenha=&sCepOrigem=".$cep_origem."&sCepDestino=".$cep_destino."&nVlPeso=".$peso."&nCdFormato=1&nVlComprimento=".$comprimento."&nVlAltura=".$altura."&nVlLargura=".$largura."&sCdMaoPropria=n&nVlValorDeclarado=".$valor_declarado."&sCdAvisoRecebimento=n&nCdServico=".$cod_servico."&nVlDiametro=0&StrRetorno=xml";

      $xml = simplexml_load_file($correios);

      $_arr_ = array();
      if($xml->cServico->Erro == '0'):
         $_arr_['codigo'] = $xml -> cServico -> Codigo ;
         $_arr_['valor'] = $xml -> cServico -> Valor ;
         $_arr_['prazo'] = $xml -> cServico -> PrazoEntrega .' Dias' ;
         // return $xml->cServico->Valor;
         return $_arr_ ; 
      else:
         return false;
      endif;
   }
}

if(isset($_POST["cep"]))
{
	$cep = preg_replace("/[^0-9]/", "", $_POST["cep"]);
	$origem = 12228615;						/* cep de origem, apenas numeros */
    $destino = $cep;  						/* cep de destino, apenas numeros */
    $peso = 0.8;							/* valor dado em Kg incluindo a embalagem. 0.1, 0.3, 1, 2 ,3 , 4 */
    $altura = 10;							/* altura do produto em cm incluindo a embalagem */
    $largura = 14;
    $comprimento = 22;						/* comprimento do produto incluindo embalagem em cm */
    $servico = 'SEDEX';						/* 40010 SEDEX sem contrato */
    $_resultado = calculaFrete( 
        $servico, 
        $origem, 
        $destino, 
        $peso, 
        $altura, $largura, $comprimento, 0 );


    $valor_frete = $_resultado['valor'];
    $prazo_frete = $_resultado['prazo'];

}
//************************************************* FIM CALCULO FRETE ***************************************************************//



//********************************* ADICIONANDO PRODUTOS NO CARRINHO ******************************//
$cod_produto = $_GET["cod_produto"];
$produtos = array();
$produtos = $_SESSION["produtos"];

//********************************* REMOVENDO PRODUTOS NO CARRINHO ******************************//
$cod_remover = $_GET["remove"];
$key = array_search($cod_remover, $produtos);
unset($produtos[$key]);
$_SESSION["produtos"] = $produtos;
//*********************************

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
			<li class="breadcrumb-item active" aria-current="page">Carrinho</li>
		  </ol>
		</nav>
		<div class="row justify-content-center mb-5">
			<div class="col-12 col-sm-12 col-lg-12">
				<div class="card-body">
					<h2 align='center'>Meu Carrinho</h2>									
				</div>				 
								
				<div class="container">				
					<?php 
					
					sort($produtos);					
					$produtos_qtd = array_count_values($produtos);
					$prods = array_unique($produtos);
					
					$html="
					<table class='table table-striped-responsive-' >
					  <thead>
						<tr>
							<th>#</th>
							<th  scope='col'>Produto</th>
							<th style='text-align:center;' scope='col'>Quantidade</th>
							<th style='text-align:center;' scope='col'>Valor Unitario</th>
							<th style='text-align:center;' scope='col'>Total</th>
						</tr>
					  </thead>
					  <tbody>						
					";

					foreach($prods as $value)
					{					
						$sql = "SELECT * FROM produtos WHERE libera='S' and cod_produto='$value'";
						$exe = mysqli_query($con,$sql);
						while($res = mysqli_fetch_array($exe))
						{
							$caminho = explode(".",$res[4]);
							$html.="
							<tr>
								<td style='text-align:center;'><a href='carrinho.php?remove=$res[0]' class='col-6  card-link btn btn-light '><span class='fas fa-times fa-1x'></span></a></td>							  
								<td >
									<a href='produto.php?codp=$res[0]'>$res[1]</a>
								</td>
								<td style='text-align:center;'>$produtos_qtd[$value]</td>
								<td style='text-align:center;'>R$ ".number_format($res[7],2,',','')."</td>
								<td style='text-align:center;'>R$ ".number_format($res[7]*$produtos_qtd[$value],2,',','')."</td>
							</tr>
							";
						$total+= number_format($res[7]*$produtos_qtd[$value],2,',','');
						}
					}
					
					if(isset($_POST["cep"]))
					{
						$valor_frete = str_replace(",",".",$valor_frete);
						$valor_final = $total + $valor_frete;
						$monta_frete="
						<tr>							
							<td colspan='4' style='text-align:right;'>Frete: (Entrega em: $prazo_frete)</th>
							<td style='text-align:center;'>R$ ".number_format($valor_frete,2,',','')."</th>
						</tr>						
						<tr>							
							<th colspan='3'></th>
							<th style='text-align:right;'>TOTAL COMPRA:</th>
							<th style='text-align:center;' class='bg-info'>R$ ".number_format($valor_final,2,',','')."</th>
						</tr>							
						";
					}
					$html.="
						<tr>							
							<th colspan='4' style='text-align:right;'>Total:</th>
							<th style='text-align:center;'>R$ ".number_format($total,2,',','')."</th>
						</tr>
						$monta_frete
						</tbody>
					</table>";
					echo $html;
					
					?>
					
					<form action='carrinho.php' method='post'>
						<div class="form-row">
							<div class="col-md-1">							
							  <label for="ceps">CEP</label>
							</div>
							<div class="col-md-2">
							  <input type="text" name='cep' required title="Preencha no Formato 00000-000" value="<?php if(isset($_POST['cep'])) echo $_POST['cep'];?>" data-mask="00000-000" pattern="\d{5}-\d{3}" class="form-control" id="cep" placeholder="Digite o CEP">
							</div>
							<button type="submit" class="btn btn-primary mb-2">Calcular Frete</button>
						</div>					
						
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
    <script src="bootstrap/js/bootstrap.min.js"></script>
	<script src="bootstrap/js/mask/jquery.mask.js"></script>
	<script src="bootstrap/js/mask/jquery.mask.min.js"></script>

  </body>
</html>