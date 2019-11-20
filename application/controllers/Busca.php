<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Busca extends CI_Controller {

	public function index()
	{
		if(!isset($this->session->userdata['logged_in']['cpf']))
		{
			redirect('Login','refresh');
		} else {
			$this->load->view('busca_view');
		}		
    }
    
    public function busca_livro()
	{
		$filtro = $_POST['filtro'];
		$texto = $_POST['texto'];
		if( is_null($filtro) || empty($filtro) || is_null($texto) || empty($texto) )
		{
			echo json_encode($_POST);
			die();
		}

		$this->load->model('livro_model');
		$livros=$this->livro_model->busca_livro($texto, $filtro);

		$array_livros=array();
		$i=0;
		foreach($livros as $value)
		{
			$array_livros[$i][]=$value['id'];
			$array_livros[$i][]=$value['titulo'];
			$array_livros[$i][]=$value['autor'];
			$array_livros[$i][]=$value['editora'];
			$array_livros[$i][]=$value['genero'];
			$array_livros[$i][]=$value['dtpublicacao'];
			$array_livros[$i][]=$value['secao'];
			$array_livros[$i][]=$value['qtdisponivel'];
			$array_livros[$i][]='<button type="button" class="btn btn-primary"><a href="'.base_url().'emprestimo/alugar/'.$value['id'].'">Alugar</a></button>';
			$i++;
		}

		echo json_encode($array_livros);
		die();
	}
}
