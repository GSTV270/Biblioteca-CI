<?php

class Usuario_model extends CI_Model {

    public function cadastrar($cpf,$dtnascimento,$nome,$email,$senha, $rua=NULL, $numero=NULL, $bairro=NULL, $cep=NULL, $ctps=NULL, $cargo=NULL) {

        $this->load->database('biblioteca');

        $sql="INSERT INTO ALUNO VALUES(
			PESSOA_TYPE(
				$cpf,
				'".$nome."',
				TO_DATE('".$dtnascimento."', 'yyyy/mm/dd'),
				'".$email."',
				ENDERECO_TYPE(
					'".$rua."',
					'".$numero."',
					'".$bairro."',
					$cep
				),
				ACESSO_NESTED(
					'".$senha."'
				)
			)
		);";
        $this->db->query($sql);
        
        if( (!is_null($rua)) && !is_null($numero) && !is_null($bairro) && !is_null($cep) )
        {
			
        }
        
        if( (!is_null($ctps)) && !is_null($cargo) )
        {
            $sql="INSERT INTO funcionario(cpf_usuario,ctps,cargo) VALUES($cpf,$ctps,'".$cargo."')";
            $this->db->query($sql);
        }
    } 
}
