<?php

class Curso extends Controlador{

    public function __construct(){

        Sesion::iniciarSesion($this->datos);

        $this->datos["menuActivo"] = "curso";
        $this->datos["curso"] = false;

        $this->CursoModelo = $this->Modelo('CursoModelo');
        
        
        $this->datos['rolesPermitidos'] = [1,2,3];         // Definimos los roles que tendran acceso                      
        
        // Comprobamos si tiene privilegios
        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol,$this->datos['rolesPermitidos'])) {
            echo "No tienes privilegios!!!";
            exit();
            // redireccionar('/');
        }

    }

    public function index(){

        $this->datos["CursosProfesor"]=$this->CursoModelo->getCursos($this->datos['usuarioSesion']->id_persona);

        $this->vista("CursosAdministrador/index",$this->datos);

    }

    public function ver_curso($id_curso){

        $this->datos['materiales']=$this->CursoModelo->getMateriales($id_curso);

        $this->datos["menuActivo"] = "material";
        $this->datos["curso"] = true;

        $this->vista("/CursosAdministrador/ver_curso",$this->datos);

    }

    public function ver_profesores() {

        $this->datos["menuActivo"] = "profesor";
        $this->datos["curso"] = true;

        $this->vista("/CursosAdministrador/profesores",$this->datos);

    }

    public function ver_alumnos() {

        $this->datos["menuActivo"] = "alumno";
        $this->datos["curso"] = true;

        $this->vista("/CursosAdministrador/alumnos",$this->datos);

    }

    public function ver_materiales() {

        

    }
}