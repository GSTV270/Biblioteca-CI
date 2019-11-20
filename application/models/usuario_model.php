<?php

class Usuario_model extends CI_Model {

    public function cadastrar($cpf,$dtnascimento,$nome,$email,$senha, $rua=NULL, $numero=NULL, $bairro=NULL, $cep=NULL, $ctps=NULL, $cargo=NULL) {

        $this->load->database('biblioteca');

        $sql="INSERT INTO usuario(cpf,dtnascimento,nome,email) VALUES($cpf,'".$dtnascimento."','".$nome."','".$email."');";
        $this->db->query($sql);
        
        $sql="INSERT INTO dados_acesso(cpf_usuario, senha) VALUES($cpf,'".$senha."')";
        $this->db->query($sql);
        
        if( (!is_null($rua)) && !is_null($numero) && !is_null($bairro) && !is_null($cep) )
        {
            $sql="INSERT INTO endereco(cpf_usuario,rua,numero,bairro,cep) VALUES($cpf,'".$rua."','".$numero."','".$bairro."','".$cep."')";
            $this->db->query($sql);
        }
        
        if( (!is_null($ctps)) && !is_null($cargo) )
        {
            $sql="INSERT INTO funcionario(cpf_usuario,ctps,cargo) VALUES($cpf,$ctps,'".$cargo."')";
            $this->db->query($sql);
        }
    } 
}