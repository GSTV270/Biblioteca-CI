<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<link href="<?= base_url().'assets/css/bootstrap.min.css'?>" rel="stylesheet" type="text/css" />		
		<link href="<?= base_url().'assets/css/custom.css'?>" rel="stylesheet" type="text/css" />
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Biblioteca - Cadastrar Livro</title>
	</head>
	<body>		
		<?php
		if(isset($this->session->userdata['logged_in']['cpf']))
		{
			include 'includes/navbar.php';
		} else {
			redirect('pagina-inicial','refresh');
		}		
		?>
		<center>
			<form id="cadastrar-livro" style="width: 300px;" method="POST" action="<?= base_url().'livro/cadastro' ?>">
				<div class="form-group">
					<label for="nome">Titulo</label>
					<input type="text" class="form-control" id="titulo" name="titulo" placeholder="Titulo">
				</div>
				<div class="form-group">
					<label for="cpf">Autor</label>
					<input type="text" class="form-control" id="autor" name="autor" placeholder="Autor">
				</div>
				<div class="form-group">
					<label for="cep">Editora</label>
					<input type="text" class="form-control" id="editora" name="editora" placeholder="Editora">
				</div>
				<div class="form-group">
					<label for="data">Data de Publicação</label>
					<input type="date" class="form-control" id="data" name="data">
				</div>
				<div class="form-group">
					<label for="posicao">Gênero</label>
					<input type="text" class="form-control" id="genero" name="genero" placeholder="Gênero">
				</div>
				<div class="form-group">
					<label for="senha">Seção</label>
					<input type="text" class="form-control" id="secao" name="secao" placeholder="Seção">
				</div>
                <div class="form-group">
					<label for="senha">Quantidade Total</label>
					<input type="number" class="form-control" id="qttotal" name="qttotal" placeholder="Quantidade Total">
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
			if($(`#titulo`).val()=='')
			{
				alert('Título não foi preenchida');
				return false;
			}
			if($(`#autor`).val()=='')
			{
				alert('Autor não foi preenchido');
				return false;
			}
			if($(`#editora`).val()=='')
			{
				alert('Editora não foi preenchida');
				return false;
			}
			if($(`#data`).val()=='')
			{
				alert('Data não foi preenchida');
				return false;
			}
			if($(`#genero`).val()=='')
			{
				alert('Gênero não foi preenchida');
				return false;
			}
			if($(`#secao`).val()=='')
			{
				alert('Seção não foi preenchida');
				return false;
			}
			if($(`#qttotal`).val()=='')
			{
				alert('Quantidade total não foi preenchida');
				return false;
			}
			else
			{
				$(`#cadastrar-livro`).submit();
			}			
		}
		
	</script>
</html>