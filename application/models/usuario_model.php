<?php

class Usuario_model extends CI_Model {

    public function cadastrar($cpf,$dtnascimento,$nome,$email,$senha, $rua=NULL, $numero=NULL, $bairro=NULL, $cep=NULL, $ctps=NULL, $cargo=NULL) {

        $this->load->database('biblioteca');

        $sql="INSERT INTO pessoa VALUES($cpf,'".$nome."','".$dtnascimento."','".$email."','(\"".$rua."\", ".$numero.", \"".$bairro."\", ".$cep.")','(\"".$senha."\")')";
        $this->db->query($sql);

        if( (!is_null($ctps)) && !is_null($cargo) )
        {
            $sql="INSERT INTO funcionario VALUES('".$cpf."','".$ctps."','".$cargo."')";
            $this->db->query($sql);
        }
	}
	
	public function exibir($cpf) {
		$this->load->database('biblioteca');

		$sql="SELECT nome, datanasc, email, (endereco).rua, (endereco).numero, (endereco).bairro, (endereco).cep FROM pessoa WHERE cpf='".$cpf."' ";
		$perfil = $this->db->query($sql);

		return $perfil->result_array()[0];
	}
}
