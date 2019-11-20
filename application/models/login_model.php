<?php

class Login_model extends CI_Model {
    public function check($cpf,$senha) {
        $this->load->database('biblioteca');

        $sql="SELECT * FROM dados_acesso WHERE cpf_usuario='".$cpf."' AND senha='".$senha."'";
        $result=$this->db->query($sql);
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

        $sql="SELECT usuario.cpf, usuario.dtnascimento, usuario.nome, usuario.email, endereco.rua, endereco.numero, endereco.bairro, endereco.cep FROM usuario INNER JOIN endereco ON endereco.cpf_usuario=usuario.cpf WHERE cpf='".$cpf."'";
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