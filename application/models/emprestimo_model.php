<?php

class Emprestimo_model extends CI_Model {

    public function get_emprestimos($cpf_usuario) {

        $this->load->database('biblioteca');

        $sql= "SELECT emprestimo.id, emprestimo.data, livro.titulo FROM emprestimo, livro WHERE livro.id=emprestimo.livro AND emprestimo.usuario='".$cpf_usuario."' AND emprestimo.id NOT IN (SELECT devolucao.emprestimo FROM devolucao)";    
        $obj=$this->db->query($sql);
        $result=$obj->result_array();
        return $result;
    }

    public function realizar_emprestimo($cpf_usuario, $id_livro) {
        
        $this->load->database('biblioteca');

        $sql="INSERT INTO emprestimo(livro, usuario, data) VALUES(".$id_livro.",'".$cpf_usuario."', NOW());";    
        $this->db->query($sql);
    }
    
    public function devolver_emprestimo($emprestimo_id) {

        $this->load->database('biblioteca');

        $sql="INSERT INTO devolucao(emprestimo, devolucao) VALUES(".$emprestimo_id.", NOW());";    
        $this->db->query($sql);
    }
}
