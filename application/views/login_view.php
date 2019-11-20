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
			<?php include 'includes/navbar_no_itens.php' ?>
			<form id="login" class="login" method="POST" action="<?= base_url().'login/autenticacao'?>">
				<div class="form-group">
					<label for="cpf">CPF</label>
					<input type="text" class="form-control" id="cpf" name = "cpf" placeholder="CPF">
				</div>
				<div class="form-group">
					<label for="senha">Senha</label>
					<input type="password" class="form-control" id="senha" name="senha" placeholder="Password">
				</div>
					<button type="button" id="entrar" name="entrar" onclick="validarlogin()"class="btn btn-primary">Login</button>					
			</form>
			<button type="button" id="cadastrar" class="btn btn-secondary"><a href="<?= base_url().'cadastrar-usuario'?>">Cadastre-se</a></button>
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