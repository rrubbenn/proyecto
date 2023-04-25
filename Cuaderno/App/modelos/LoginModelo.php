<?php

class LoginModelo {
    private $db;

    public function __construct(){
        $this->db = new Base;
    }

    public function loginUsuario($datos){
        $this->db->query("SELECT * 
                                FROM Persona 
                                WHERE nombre = :login 
                                    AND clave = :password");
                                    
        $this->db->bind(':login',$datos['usuario']);
        $this->db->bind(':password',$datos['pass']);

        return $this->db->registro();
    }

}