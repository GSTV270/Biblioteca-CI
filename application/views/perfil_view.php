<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<link href="<?= base_url().'assets/css/bootstrap.min.css'?>" rel="stylesheet" type="text/css" />		
		<link href="<?= base_url().'assets/css/custom.css'?>" rel="stylesheet" type="text/css" />		
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Biblioteca - Login</title>
	</head>
	<body>
		<center>
			<?php include 'includes/navbar.php' ?>
			<h1>Perfil</h1>
			<br>
			<p><strong>Nome: </strong><?=$usuario_logado['nome']?></p>
			<p><strong>Data de Nascimento: </strong><?=date('d/m/Y',strtotime($usuario_logado['datanasc']))?></p>
			<p><strong>Email: </strong><?=$usuario_logado['email']?></p>
			<p><strong>Endereço: </strong><?=$usuario_logado['rua']?></p>
			<p><strong>Número: </strong><?=$usuario_logado['numero']?></p>
			<p><strong>Bairro: </strong><?=$usuario_logado['bairro']?></p>
			<p><strong>CEP: </strong><?=$usuario_logado['cep']?></p>
		</center>
	</body>
	<script src="<?= base_url().'assets/js/bootstrap/bootstrap.min.js'?>" type="text/javascript"></script>
	<script src="<?= base_url().'assets/js/jquery/jquery-3.4.1.js'?>" type="text/javascript"></script>
	<script src="<?= base_url().'assets/js/custom/mascara.js'?>" type="text/javascript"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.0/jquery.mask.js"></script>
	<script>
				
		function validarlogin()
		{
			if($(`#cpf`).val()=='')
			{
				alert('CPF não foi preenchido');
				return false;
			}
			if($(`#senha`).val()=='')
			{
				alert('Senha não foi preenchida');
				return false;
			}
			else
			{
				$(`#login`).submit();
			}			
		}
		
	</script>
</html>
