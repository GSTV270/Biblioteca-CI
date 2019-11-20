<!DOCTYPE html>
<html lang="pt-br">
	<head>
	<link href="<?= base_url().'assets/css/bootstrap.min.css'?>" rel="stylesheet" type="text/css" />		
	<link href="<?= base_url().'assets/css/custom.css'?>" rel="stylesheet" type="text/css" />
	<link href="<?= base_url().'assets/DataTables/datatables.min.css'?>" rel="stylesheet" type="text/css"/>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>Biblioteca - Busca</title>
	</head>
	<body>
		<?php include 'includes/navbar.php' ?>		
		<div class="container">
			<h3>Busca de livros</h3>
			<div class="row">
				<div class="col-md-3">
					<p>Buscar por:</p>
					<input type="radio" name="filtro" id="titulo" value="titulo"><label for="titulo">Título</label>
					<input type="radio" name="filtro" id="autor" value="autor"><label for="autor">Autor</label>
					<input type="radio" name="filtro" id="genero" value="genero"><label for="genero">Gênero</label>
				</div>
				<div class="col-md-6">
					<input id="campo-busca" type="text">
				</div>
				<div class="col-md-3">
					<button id="button-busca">Pesquisar</button>
				</div>
			</div>		
		</div>
		<div class="table">
			<h3>Resultado</h3>
			<table id="resulttable">
				<thead>	
					<th>id</th>
					<th>Título</th>
					<th>Autor</th>
					<th>Editora</th>
					<th>Gênero</th>
					<th>Data de Publicação</th>
					<th>Seção</th>
					<th>Quantidade Disponível</th>
					<th>Ação</th>
				</thead>
				<tbody>					
				</tbody>
			</table>
		</div>
		<script src="<?= base_url().'assets/js/jquery/jquery-3.4.1.js'?>" type="text/javascript"></script>
		<script src="<?= base_url().'assets/DataTables/datatables.min.js'?>" type="text/javascript"></script>
		<script>
			$(document).ready( function () {
				$('#resulttable').DataTable({
					"searching": false,
					"order": [[ 1, "asc"]],
					"columnDefs": [
						{ "orderable": false, "targets": 8 }
					]
				});
			});
			
			$('#button-busca').on('click', function(){

				if($("input[name='filtro']:checked").val()===undefined)
				{
					alert('Por Favor, selecione uma das opções de filtro antes fazer a busca.');
					return false;
				}
				if($("input[name='filtro']:checked").val()===undefined)
				{
					alert('Por Favor, selecione uma das opções de filtro antes fazer a busca.');
					return false;
				}
				let filtro = $("input[name='filtro']:checked").val();
				let texto = $('#campo-busca').val();
				$.ajax({
					url: '<?= base_url()."busca/busca_livro"?>',
					type: 'POST',
					data: { 'filtro': filtro, 'texto': texto},
					datatype: 'json',
					success: function(data) {
						console.log(data);
						let obj_data = JSON.parse(data)
						console.log(obj_data);
						$('#resulttable').DataTable( {
							"destroy": true,
							"searching": false,
							"order": [[ 1, "asc"]],
							"columnDefs": [
								{ "orderable": false, "targets": 8 }
							],
							"data": obj_data
						});
						return true;
					},
					error: function (data) {						
						alert('Não foi possível concluir a busca.')
						return false;
					}
				});
			});			
		</script>
	</body>
</html>