<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Emprestimo extends CI_Controller {

	public function index()
	{
        if( !isset($this->session->userdata['logged_in']['cpf']) )
        {   
            redirect('Login', 'refresh');
        } else {
            $this->load->model('emprestimo_model');
            $emprestimo['dados']=$this->emprestimo_model->get_emprestimos($this->session->userdata['logged_in']['cpf']);
            $this->load->view('emprestimo_view',$emprestimo);
        }
    }
    
    public function devolver($emprestimo_id=NULL)
	{
        if( !is_null($emprestimo_id) )
        {
            $this->load->model('emprestimo_model');
            $this->emprestimo_model->devolver_emprestimo($emprestimo_id);
            redirect('emprestimos', 'refresh');
        }
    }

    public function alugar($livro_id=NULL)
	{
        if( !is_null($livro_id) )
        {
            $this->load->model('emprestimo_model');
            $this->emprestimo_model->realizar_emprestimo($this->session->userdata['logged_in']['cpf'], $livro_id);
            redirect('emprestimos', 'refresh');
        }
    }
}
