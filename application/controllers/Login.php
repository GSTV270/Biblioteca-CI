<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index()
	{
        if( !isset($this->session->userdata['logged_in']['cpf']) )
        {   
            $this->load->view('login_view');
        } else {
            $this->load->view('busca_view');
        }
    }
    
    public function checarlogin()
	{
        $this->load->model('login_model');

        $cpf=$_POST['cpf'];
        $senha=$_POST['senha'];

        if( ( is_null($cpf)||empty($cpf) ) || ( is_null($senha)||empty($senha) ) )
        {
            $this->load->view('login_view');

        } else {

            $cpf_filtrado = str_replace(['+', '-'], '', filter_var($cpf, FILTER_SANITIZE_NUMBER_INT));

            $bool = $this->login_model->check($cpf_filtrado, $senha);

            if($bool==true){
                if(!isset($_SESSION))
                {
                    session_start();
                }

				$dados=$this->login_model->get_userdata($cpf_filtrado);
                $this->session->userdata['logged_in']['cpf'] = $dados['cpf'];
                $this->session->userdata['logged_in']['dtnascimento'] = $dados['datanasc'];
                $this->session->userdata['logged_in']['nome'] = $dados['nome'];
                $this->session->userdata['logged_in']['email'] = $dados['email'];

                $check_funcionario=$this->login_model->check_funcionario($cpf_filtrado); 
                if($check_funcionario==true)
                {
                    $dados_func=$this->login_model->get_funcdata($cpf_filtrado);
                    $this->session->userdata['logged_in']['ctps'] = $dados_func['ctps'];
                    $this->session->userdata['logged_in']['cargo'] = $dados_func['cargo'];
                }                
                redirect('pagina-inicial', 'refresh');
            } else {
                $this->load->view('login_view');
            }	
        }        	
    }

    public function logout()
	{
        unset($this->session->userdata['logged_in']);
        $this->load->view('login_view');
    }
}
