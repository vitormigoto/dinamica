<?php

if(!isset($_SESSION['email']))
{	
	$email = $_POST["email"];
	$senha = $_POST["senha"];
}
else
{
	$email = $_SESSION['email'];
	$senha = $_SESSION['senha'];
}


$sql = "select senha from cliente where email='$email' and status='S'";
$exe = mysqli_query($con,$sql);
$senha_bd = mysqli_fetch_array($exe);

if (password_verify($senha, $senha_bd[0])) 
{
	$_SESSION['email'] = $email;
	$_SESSION['senha'] = $senha;
	$pesquisa_cliente = "select * from cliente where email='$email' and status='S'";
	$exe_pesq = mysqli_query($con,$pesquisa_cliente);
	if($exe_pesq == true)
	{
		$mostra = 1;
		while($linha = mysqli_fetch_array($exe_pesq))
		{ 
			$cod_cliente = $linha[0];
			$nome = $linha[1];
			$cpf = $linha[2];				
		}
	}
	else
	{
		echo "
		<script>		 
		 window.location = 'index.php?erro=1';
		</script>
		";	
	}  
}
else 
{
	echo "
	<script>
	 //alert('Login Incorreto! Tente novamente.');
	 window.location = 'index.php?erro=1';
	</script>
	";	
}
?>