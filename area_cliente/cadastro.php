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
	
<!-- Adicionando Javascript CPF -->
<script type="text/javascript">
function valida() {
									  validateForm();
									  if (document.form1.cpf.validity.patternMismatch) {
										 alert("O CPF está incorreto");
									  } else {
										 alert("O CPF está correto");
									  }									  
									  return false;
								   }
								
								
								function val_cpf(cpf,campo)
								{
									var cpf = cpf.replace(/[^0-9]/g, '').toString();
									var campo = campo;
										if( cpf.length == 11 )
										{
											var v = [];

											//Calcula o primeiro dígito de verificação.
											v[0] = 1 * cpf[0] + 2 * cpf[1] + 3 * cpf[2];
											v[0] += 4 * cpf[3] + 5 * cpf[4] + 6 * cpf[5];
											v[0] += 7 * cpf[6] + 8 * cpf[7] + 9 * cpf[8];
											v[0] = v[0] % 11;
											v[0] = v[0] % 10;

											//Calcula o segundo dígito de verificação.
											v[1] = 1 * cpf[1] + 2 * cpf[2] + 3 * cpf[3];
											v[1] += 4 * cpf[4] + 5 * cpf[5] + 6 * cpf[6];
											v[1] += 7 * cpf[7] + 8 * cpf[8] + 9 * v[0];
											v[1] = v[1] % 11;
											v[1] = v[1] % 10;

											//Retorna Verdadeiro se os dígitos de verificação são os esperados.
											if ( (v[0] != cpf[9]) || (v[1] != cpf[10]) )
											{
												//alert('CPF inválido: ' + cpf);
												document.getElementById(campo).value='';
												document.getElementById(campo).style.background = 'red';
												document.getElementById(campo).style.color = 'white';
												document.getElementById("ok_cpf").className = "fas fa-times";
												document.getElementById("ok_cpf").style.color = "red";

											}
											else
											{
												document.getElementById(campo).style.background = 'white';
												document.getElementById(campo).style.color = 'black';
												document.getElementById("ok_cpf").className = "fas fa-check";
												document.getElementById("ok_cpf").style.color = "green";
											}
										}
										else
										{
											//alert('CPF inválido:' + cpf);
											document.getElementById(campo).value='';
											document.getElementById(campo).style.background = 'red';
											document.getElementById(campo).style.color = 'white';
											document.getElementById("ok_cpf").className = "fas fa-times";
											document.getElementById("ok_cpf").style.color = "red";
										}
								}
								
								
								
								
								
</script>	
	
	<!-- Adicionando Javascript CEP -->
<script type="text/javascript" >
    
    function limpa_formulário_cep() {
            //Limpa valores do formulário de cep.
            document.getElementById('rua').value=("");
            document.getElementById('bairro').value=("");
            document.getElementById('cidade').value=("");
            document.getElementById('uf').value=("");
            document.getElementById('ibge').value=("");
    }

    function meu_callback(conteudo) {
        if (!("erro" in conteudo)) {
            //Atualiza os campos com os valores.
            document.getElementById('rua').value=(conteudo.logradouro);
            document.getElementById('bairro').value=(conteudo.bairro);
            document.getElementById('cidade').value=(conteudo.localidade);
            document.getElementById('uf').value=(conteudo.uf);
            document.getElementById('ibge').value=(conteudo.ibge);
        } //end if.
        else {
            //CEP não Encontrado.
            limpa_formulário_cep();
            alert("CEP não encontrado.");
        }
    }
        
    function pesquisacep(valor) {

        //Nova variável "cep" somente com dígitos.
        var cep = valor.replace(/\D/g, '');

        //Verifica se campo cep possui valor informado.
        if (cep != "") {

            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if(validacep.test(cep)) {

                //Preenche os campos com "..." enquanto consulta webservice.
                document.getElementById('rua').value="...";
                document.getElementById('bairro').value="...";
                document.getElementById('cidade').value="...";
                document.getElementById('uf').value="...";

                //Cria um elemento javascript.
                var script = document.createElement('script');

                //Sincroniza com o callback.
                script.src = 'http://viacep.com.br/ws/'+ cep + '/json/?callback=meu_callback';

                //Insere script no documento e carrega o conteúdo.
                document.body.appendChild(script);

            } //end if.
            else {
                //cep é inválido.
                limpa_formulário_cep();
                alert("Formato de CEP inválido.");
            }
        } //end if.
        else {
            //cep sem valor, limpa formulário.
            limpa_formulário_cep();
        }
		document.getElementById('num').focus();
    };

	function valida_senha()
	{
		var s1 = document.getElementById("txt_senha").value;
		var s2 = document.getElementById("txt_senha2").value;
		
		if(s1==s2)
		{
			document.getElementById("txt_senha2").style.background = 'white';
			document.getElementById("txt_senha2").style.color = 'black';
			document.getElementById("ok_senha").className = "fas fa-check";
			document.getElementById("ok_senha").style.color = "green";			
			document.getElementById("ok_senha").innerHTML = "";	
		}
		else
		{
			document.getElementById("txt_senha2").style.background = 'red';
			document.getElementById("txt_senha2").style.color = 'white';
			document.getElementById("ok_senha").className = "fas fa-times";
			document.getElementById("ok_senha").style.color = "red";						
			document.getElementById("ok_senha").innerHTML = " As senhas não são iguais.";	
		}
		
	}
    </script>
	
	
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
		<div class="row justify-content-center mb-5">
			<div class="col-12 col-sm-6 col-lg-8">
				<div class="card-body">
					<h2 align='center'>Novo Cliente</h2>
					
					<form action="exe_cadastro.php" method="post">
						<div class="row">
							<div class="col-sm-8 form-group">
								<label for="txt_nome">Nome</label>
								<input type="text" name='nome' class="form-control alert-danger" id="txt_nome" placeholder="Nome" required>
							</div>
							<div class="col-sm-4 form-group">
								<label for="txt_nasc">Data de Nascimento</label>
								<input type="date" name='dt_nasc' class="form-control alert-danger" id="txt_nasc" placeholder="Nome" required>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-4 form-group">
								<label for="txt_cpf">CPF   <span class='fas' id="ok_cpf" style='color:green;' ></span></label>
								<input type="text" name='cpf' class="form-control alert-danger" data-mask="000.000.000-00" id="txt_cpf" onblur="val_cpf(this.value,'txt_cpf');" placeholder="CPF" required>
																	
							</div>	
							<div class="col-sm-4 form-group">
								<label for="txt_telefone">Telefone</label>
								<input type="text" name='telefone' class="form-control txt_telefone alert-danger" data-mask="(00)0000-00000" id="txt_telefone" placeholder="Telefone" required>
							</div>
							<div class="col-sm-4 form-group">
								<label for="txt_celular">Celular</label>
								<input type="text" name='celular' class="form-control" data-mask="(00)0000-00000" id="txt_celular" placeholder="Celular">
							</div>
						</div>						
						<div class="form-group">
							<label for="txt_email">Email</label>
							<input type="email" name='email' class="form-control alert-danger" id="txt_email" placeholder="Digite seu email" required>
						</div>
						<div class="row">
							<div class="col-sm-6 form-group">
								<label for="txt_senha">Senha</label>
								<input type="password" name='senha' class="form-control alert-danger" id="txt_senha" placeholder="Digite sua Senha" required>
							</div>
							<div class="col-sm-6 form-group">
								<label for="txt_senha2">Repita a Senha <span class='fas' id="ok_senha" style='color:green;' ></span></label>
								<input type="password" name='senha2' class="form-control alert-danger" onblur='valida_senha();' id="txt_senha2" placeholder="Redigite sua Senha" required>
							</div>
						</div>
						<div class='row'>
							<div class="col-sm-3 form-group">
								<label for="cep">CEP</label>
								<input type="text" name='cep' maxlength="9" class="form-control alert-danger" id="cep" placeholder="CEP" required onblur="pesquisacep(this.value);" value="">
							</div>
							<div class="col-sm-6 form-group">
								<label for="rua">Endereço</label>
								<input type="text" name='endereco' class="form-control alert-danger" id="rua" placeholder="Endereço" required>
							</div>							
							<div class="col-sm-2 form-group">
								<label for="num">Nº</label>
								<input type="text" name='numero' class="form-control alert-danger" id="num" placeholder="Nº" required>
							</div>	
						</div>
						<div class='row'>
							<div class="col-sm-4 form-group">
								<label for="bairro">Bairro</label>
								<input type="text" name='bairro' class="form-control alert-danger" id="bairro" placeholder="Bairro" required>
							</div>
							<div class="col-sm-4 form-group">
								<label for="cidade">Cidade</label>
								<input type="text" name='cidade' class="form-control alert-danger" id="cidade" placeholder="Cidade" required>
							</div>
							<div class="col-sm-4 form-group">
								<label for="uf">Estado</label>
								<input type="text" name='estado' maxlength='2' class="form-control alert-danger" id="uf" placeholder="Estado" required>
							</div>							
						</div>						
						
						

						<button type="submit" class="btn btn-primary btn-block">Cadastrar</button>
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