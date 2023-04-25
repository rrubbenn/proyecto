<?php

class MaterialModelo {
    private $db;

    public function __construct(){
        $this->db = new Base;
    }

    public function getMateriales($datos){
        $this->db->query("SELECT * FROM Material M INNER JOIN Curso C where M.id_curso=C.id_curso AND M.id_curso=:id_curso");

        $this->db->bind(':id_curso',trim($datos['id_curso']));

        return $this->db->registro();
    }

}