<?php

class Inicio extends Controlador{

    public function __construct(){

        Sesion::iniciarSesion($this->datos);

        $this->datos["menuActivo"] = "home";
        $this->datos["curso"] = false;

        $this->datos['rolesPermitidos'] = [1,2,3];         // Definimos los roles que tendran acceso                      
        
        // Comprobamos si tiene privilegios
        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol,$this->datos['rolesPermitidos'])) {
            echo "No tienes privilegios!!!";
            exit();
            // redireccionar('/');
        }

    }

    public function index(){

        $this->vista("index",$this->datos);

    }

    
}
