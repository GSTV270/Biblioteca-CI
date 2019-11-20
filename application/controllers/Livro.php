<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Livro extends CI_Controller {

	public function index()
	{
		if( !isset($this->session->userdata['logged_in']['ctps']) )
        {   
            redirect('Login','refresh');
        } else {
            $this->load->view('cadastro_livro_view');
        }		
	}
	
	public function cadastro()
	{

		$this->load->model('livro_model');
		$titulo=$_POST['titulo'];		
		$autor=$_POST['autor'];
		$editora=$_POST['editora'];
		$dtpublicacao=$_POST['data'];
		$genero=$_POST['genero'];
		$secao=$_POST['secao'];
		$qttotal=$_POST['qttotal'];
		$this->livro_model->cadastra_livro($titulo, $autor, $editora, $dtpublicacao, $genero, $secao, $qttotal);
		redirect('pagina-inicial','refresh');
    }
}
