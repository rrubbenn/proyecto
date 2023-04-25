<?php

class Material extends Controlador{

    public function __construct(){

        Sesion::iniciarSesion($this->datos);

        $this->datos["menuActivo"] = "home";

        $this->MaterialModelo = $this->Modelo('MaterialModelo');
        
        
        $this->datos['rolesPermitidos'] = [1,2,3];         // Definimos los roles que tendran acceso                      
        
        // Comprobamos si tiene privilegios
        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol,$this->datos['rolesPermitidos'])) {
            echo "No tienes privilegios!!!";
            exit();
            // redireccionar('/');
        }

    }

    public function index(){

        $this->datos['materiales'] = $this->MaterialModelo->getMateriales();

        $this->vista("materiales/index",$this->datos);

    }
}