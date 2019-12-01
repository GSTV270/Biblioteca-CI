<?php

class Login_model extends CI_Model {
    public function check($cpf,$senha) {
        $this->load->database('biblioteca');

        $sql="SELECT * FROM pessoa WHERE cpf='".$cpf."' AND (senha).senha='".$senha."'";
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

        $sql="SELECT * FROM pessoa WHERE cpf='".$cpf."'";
        $result=$this->db->query($sql);
        return $result->result_array()[0];
    }
    
    public function check_funcionario($cpf)
    {
        $this->load->database('biblioteca');

        $sql = "SELECT * FROM administrador WHERE cpf='".$cpf."'";
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

        $sql = "SELECT ctps,cargo FROM administrador WHERE cpf='$cpf';";
        $result=$this->db->query($sql);
        return $result->result_array()[0];
    }
}
