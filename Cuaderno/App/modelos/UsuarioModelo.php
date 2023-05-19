<?php

class UsuarioModelo {
    private $db;

    public function __construct(){
        $this->db = new Base;
    }

    public function getUsuarios(){

        $this->db->query("SELECT * FROM Persona");
        
        return $this->db->registros();

    }

    public function getDatosUsuario($id_persona){

        $this->db->query("SELECT * FROM Persona where id_persona = :id_persona");

        $this->db->bind(':id_persona',$id_persona);
        
        return $this->db->registro();

    }

    public function deleteUsuario($id_persona){

        $this->db->query("DELETE FROM Persona WHERE id_persona = :id_persona");
        
        $this->db->bind(':id_persona',$id_persona);

        if($this->db->execute()) {

            return true;

        } else {

            return false;

        }

    }

    public function editarUsuario($datos){

        $this->db->query("UPDATE Persona SET dni = :dni, nombre = :nombre, apellidos = :apellidos, mail = :mail, telefono = :telefono WHERE id_persona = :id_persona");

        $this->db->bind(':dni',$datos['dni']);
        $this->db->bind(':nombre',$datos['nombre']);
        $this->db->bind(':apellidos',$datos['apellidos']);
        $this->db->bind(':mail',$datos['mail']);
        $this->db->bind(':telefono',$datos['telefono']);
        $this->db->bind(':id_persona',$datos['id_persona']);

        // Esto sirve para que en el modelo no sepa si darte error o redirigirte correctamente
        if($this->db->execute()) {

            return true;

        } else {

            return false;

        }

    }

}