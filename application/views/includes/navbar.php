<nav class="navbar navbar-expand-lg navbar-light bg-light">
	<a class="navbar-brand">Biblioteca</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav mr-auto">
			<li class="nav-item active">
				<a class="nav-link" href="<?=base_url().'pagina-inicial'?>">Home <span class="sr-only">(current)</span></a>
			</li>
			<?php
			if(isset($this->session->userdata['logged_in']['ctps']))
			{
				echo   '<li class="nav-item">
						<a class="nav-link" href="'.base_url().'cadastrar-usuario">Cadastrar Usuário</a>
						</li>
						<li class="nav-item">
						<a class="nav-link" href="'.base_url().'cadastrar-administrador">Cadastrar Administrador</a>
						</li>
						<li class="nav-item">
						<a class="nav-link" href="'.base_url().'cadastrar-livro">Cadastrar Livro</a>
						</li>';
			}?>			
			<li class="nav-item">
				<a class="nav-link" href="<?=base_url().'emprestimos'?>">Emprestimos</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="<?=base_url().'logout'?>">Logout</a>
			</li>				  
		</ul>
		<p class="nav-item">
			<a class="nav-link" style="text-decoration:none !important; text-align: right;">
				<a href="<?=base_url().'perfil'?>">
					Bem-vindo <?=$this->session->userdata['logged_in']['nome'];?>
				</a>
			</a>
		</p>
	</div>
</nav>
