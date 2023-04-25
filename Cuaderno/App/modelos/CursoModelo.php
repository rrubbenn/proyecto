<?php

class CursoModelo {
    private $db;

    public function __construct(){
        $this->db = new Base;
    }

    public function getCursos($id_persona){
        
        $this->db->query("SELECT C.* FROM Curso C INNER JOIN Participar_Profesor P ON C.id_curso = P.id_curso WHERE P.id_profesor = :id_profesor");
        
        $this->db->bind(':id_profesor',trim($id_persona));

        return $this->db->registros();
    }

    public function getNombreCurso($id_curso) {

        $this->db->query("SELECT nombre FROM Curso WHERE id_curso = :id_curso");

        $this->db->bind(':id_curso',trim($id_curso));

        return $this->db->registro();
        
    }

    public function getMateriales($id_curso){
        
        $this->db->query("SELECT * FROM Material WHERE id_curso = :id_curso");
        
        $this->db->bind(':id_curso',trim($id_curso));

        return $this->db->registros();
    }

}