<?php

class UsuarioModelo {
    private $db;

    public function __construct(){
        $this->db = new Base;
    }

    public function getUsuarios($inicio, $fin){

        $this->db->query("SELECT * FROM Persona LIMIT :paglimite OFFSET :paginicio");

        $this->db->bind(':paginicio',$inicio);
        $this->db->bind(':paglimite',$fin);
        
        return $this->db->registros();

    }

    public function numUsuarios() {

        $this->db->query("SELECT COUNT(id_persona) FROM Persona");
        
        return $this->db->registroIndividual();

    }

    public function getDatosUsuario($id_persona){

        $this->db->query("SELECT * FROM Persona P INNER JOIN Rol R ON P.id_rol = R.id_rol where id_persona = :id_persona");

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

    public function addUsuario($datos) {

        $this->db->query("INSERT INTO Persona (dni, clave, nombre, apellidos, mail, telefono, id_rol)
                        VALUES (:dni, :clave, :nombre, :apellidos, :mail, :telefono, :id_rol)");

        $this->db->bind(':dni',$datos['dni']);
        $this->db->bind(':clave',$datos['clave']);
        $this->db->bind(':nombre',$datos['nombre']);
        $this->db->bind(':apellidos',$datos['apellidos']);
        $this->db->bind(':mail',$datos['mail']);
        $this->db->bind(':telefono',$datos['telefono']);
        $this->db->bind(':id_rol',$datos['rol']);
            
        // Esto sirve para que en el modelo no sepa si darte error o redirigirte correctamente
        if($this->db->execute()) {

            return true;

        } else {

            return false;

        }

    }

    public function editarUsuario($datos){

        $this->db->query("UPDATE Persona SET dni = :dni, nombre = :nombre, apellidos = :apellidos, mail = :mail, telefono = :telefono, id_rol = :id_rol WHERE id_persona = :id_persona");

        $this->db->bind(':dni',$datos['dni']);
        $this->db->bind(':nombre',$datos['nombre']);
        $this->db->bind(':apellidos',$datos['apellidos']);
        $this->db->bind(':mail',$datos['mail']);
        $this->db->bind(':telefono',$datos['telefono']);
        $this->db->bind(':id_rol',$datos['rol']);
        $this->db->bind(':id_persona',$datos['id_persona']);

        // Esto sirve para que en el modelo no sepa si darte error o redirigirte correctamente
        if($this->db->execute()) {

            return true;

        } else {

            return false;

        }

    }

    public function getRoles() {

        $this->db->query("SELECT * FROM Rol");
        
        return $this->db->registros();

    }

}