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
		<div class="table">
			<h3>Empréstimo</h3>
			<table id="emprestimotable">
				<thead>	
					<th>id</th>
					<th>Livro</th>
					<th>Data de Empréstimo</th>
					<th>Ação</th>
				</thead>
				<tbody>
                    <?php
                        foreach($dados as $emprestimo)
                        {
                            echo '
                            <tr>
                                <td>'.$emprestimo['id'].'</td>
                                <td>'.$emprestimo['titulo'].'</td>
                                <td>'.$emprestimo['data'].'</td>
                                <td><button type="button" class="btn btn-primary"><a href="'.base_url().'emprestimo/devolver/'.$emprestimo['id'].'">Devolver</a></button></td>
                            </tr>';
                        }
                    ?>		
				</tbody>
			</table>
		</div>
		<script src="<?= base_url().'assets/js/jquery/jquery-3.4.1.js'?>" type="text/javascript"></script>
		<script src="<?= base_url().'assets/DataTables/datatables.min.js'?>" type="text/javascript"></script>
		<script>
			$(document).ready( function () {
				$('#emprestimotable').DataTable({
					"searching": false,
					"order": [[ 0, "asc"]],
					"columnDefs": [
						{ "orderable": false, "targets": 3 }
					]
				});
			});		
		</script>
	</body>
</html>
