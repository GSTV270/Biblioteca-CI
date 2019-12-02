<?php

class Livro_model extends CI_Model {
    
    public function busca_livro($texto, $filtro) {

        $this->load->database('biblioteca');

        if($filtro=='titulo')
        {
            $sql="SELECT livro.id, livro.titulo, livro.autor, livro.editora,  livro.genero, livro.publicacao, livro.secao, livro.qtde-alugado AS qtde FROM livro WHERE LOWER(titulo) LIKE LOWER('%$texto%') ORDER BY titulo DESC";
        }
        if($filtro=='autor')
        {
            $sql="SELECT livro.id, livro.titulo, livro.autor, livro.editora,  livro.genero, livro.publicacao, livro.secao, livro.qtde-alugado AS qtde FROM livro WHERE LOWER(autor) LIKE LOWER('%$texto%') ORDER BY titulo DESC";
        }
        if($filtro=='genero')
        {
            $sql="SELECT livro.id, livro.titulo, livro.autor, livro.editora,  livro.genero, livro.publicacao, livro.secao, livro.qtde-alugado AS qtde FROM livro WHERE LOWER(genero) LIKE LOWER('%$texto%') ORDER BY titulo DESC";
        }        
        $obj=$this->db->query($sql);
        $result=$obj->result_array();
        return $result;
    }

    public function cadastra_livro($titulo, $autor, $editora, $dtpublicacao, $genero, $secao, $qttotal) {
        
        $this->load->database('biblioteca');

        $sql="INSERT INTO livro(titulo,autor,editora,publicacao,genero,secao,qtde,alugado) VALUES('".$titulo."','".$autor."','".$editora."','".$dtpublicacao."','".$genero."','".$secao."',".$qttotal.",0);";
        $this->db->query($sql);
    }
}
