<?php

class Login_model extends CI_Model {
    public function check($cpf,$senha) {
        $this->load->database('biblioteca');

        $sql="SELECT * FROM ALUNO WHERE CPF='".$cpf."' AND SENHA=HOME.ACESSO_NESTED('".$senha."')";
		$result=$this->db->query("SELECT * FROM ALUNO");
		var_dump($result->result_array());
		die;
        if( !empty($result->result_array()) )
        {
            return true;
        } else {
            return false;
        }
    }

    public function get_userdata($cpf)
    {
        $this->load->database('biblioteca');

        $sql="SELECT CPF, NOME, DATANASC, EMAIL FROM ALUNO WHERE CPF='".$cpf."'";
        $result=$this->db->query($sql);
        return $result->result_array()[0];
    }
    
    public function check_funcionario($cpf)
    {
        $this->load->database('biblioteca');

        $sql = "SELECT * FROM funcionario";
        $result=$this->db->query($sql);
        if( !empty($result->result_array()) )
        {
            return true;
        } else {
            return false;
        }
    }

    public function get_funcdata($cpf)
    {
        $this->load->database('biblioteca');

        $sql = "SELECT ctps,cargo FROM funcionario WHERE cpf_usuario='$cpf';";
        $result=$this->db->query($sql);
        return $result->result_array()[0];
    }
}
