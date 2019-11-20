<?php

class Emprestimo_model extends CI_Model {

    public function get_emprestimos($cpf_usuario) {

        $this->load->database('biblioteca');

        $sql= "SELECT emprestimo.id,emprestimo.dtemprestimo,livro.titulo AS nome FROM emprestimo INNER JOIN livro ON livro.id=emprestimo.id_livro WHERE emprestimo.cpf_usuario=".$cpf_usuario." AND emprestimo.id NOT IN (SELECT devolucao.id_emprestimo FROM devolucao);";    
        $obj=$this->db->query($sql);
        $result=$obj->result_array();
        return $result;
    }

    public function realizar_emprestimo($cpf_usuario, $id_livro) {
        
        $this->load->database('biblioteca');

        $sql="INSERT INTO emprestimo(id_livro,cpf_usuario,dtemprestimo) VALUES(".$id_livro.",".$cpf_usuario.", NOW());";    
        $this->db->query($sql);
    }
    
    public function devolver_emprestimo($emprestimo_id) {

        $this->load->database('biblioteca');

        $sql="INSERT INTO devolucao(id_emprestimo, dtdevolucao) VALUES(".$emprestimo_id.", NOW());";    
        $this->db->query($sql);
    }
}