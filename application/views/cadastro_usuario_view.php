<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<link href="<?= base_url().'assets/css/bootstrap.min.css'?>" rel="stylesheet" type="text/css" />		
		<link href="<?= base_url().'assets/css/custom.css'?>" rel="stylesheet" type="text/css" />
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Biblioteca - Cadastrar Usuário</title>
	</head>
	<body>		
		<?php
		if(isset($this->session->userdata['logged_in']['cpf']))
		{
			include 'includes/navbar.php';
		} else {
			include 'includes/navbar_no_itens.php';
		}		
		?>
		<center>
			<form id="cadastrar-usuario" style="width: 300px;" method="POST" action="<?= base_url().'usuario/cadastro' ?>">
				<div class="form-group">
					<label for="nome">Nome</label>
					<input type="text" class="form-control" id="nome" name="nome" placeholder="Nome">
				</div>
				<div class="form-group">
					<label for="cpf">CPF</label>
					<input type="text" class="form-control" id="cpf" name="cpf" placeholder="CPF">
				</div>
				<div class="form-group">
					<label for="cep">CEP</label>
					<input type="text" class="form-control" id="cep" name="cep" placeholder="CEP" maxlength="8">
				</div>
				<div class="form-group">
					<label for="rua">Rua</label>
					<input type="text" class="form-control" id="rua" name="rua" placeholder="Rua">
				</div>
				<div class="form-group">
					<label for="numero">Número</label>
					<input type="number" class="form-control" id="numero" name="numero" placeholder="Nº">
				</div>
				<div class="form-group">
					<label for="bairro">Bairro</label>
					<input type="text" class="form-control" id="bairro" name="bairro" placeholder="Bairro">
				</div>
				<div class="form-group">
					<label for="data">Data Nascimento</label>
					<input type="date" class="form-control" id="data" name="data" >
				</div>
				<div class="form-group">
					<label for="posicao">E-mail</label>
					<input type="email" class="form-control" id="email" name="email" placeholder="E-mail">
				</div>
				<div class="form-group">
					<label for="senha">Senha</label>
					<input type="password" class="form-control" id="senha" name="senha" placeholder="Senha">
				</div>				
				<button type="button" onclick="validarcadastro()" class="btn btn-primary">Cadastrar</button>
			</form>
		</center>
	</body>
	<script src="<?= base_url().'assets/js/bootstrap/bootstrap.min.js'?>" type="text/javascript"></script>
	<script src="<?= base_url().'assets/js/jquery/jquery-3.4.1.js'?>" type="text/javascript"></script>
	<script src="<?= base_url().'assets/js/custom/mascara.js'?>" type="text/javascript"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.0/jquery.mask.js"></script>
	<script>
				
		function validarcadastro()
		{
			if($(`#nome`).val()=='')
			{
				alert('Nome não foi preenchida');
				return false;
			}
			if($(`#cpf`).val()=='')
			{
				alert('CPF não foi preenchido');
				return false;
			}
			if($(`#cep`).val()=='')
			{
				alert('CEP não foi preenchida');
				return false;
			}
			if($(`#rua`).val()=='')
			{
				alert('Rua não foi preenchida');
				return false;
			}
			if($(`#numero`).val()=='')
			{
				alert('Número não foi preenchida');
				return false;
			}
			if($(`#bairro`).val()=='')
			{
				alert('Bairro não foi preenchida');
				return false;
			}
			if($(`#email`).val()=='')
			{
				alert('Email não foi preenchida');
				return false;
			}	
			if($(`#senha`).val()=='')
			{
				alert('Senha não foi preenchida');
				return false;
			}
			else
			{
				$(`#cadastrar-usuario`).submit();
			}			
		}
		
	</script>
</html>