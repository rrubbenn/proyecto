<?php

class Curso extends Controlador{

    public function __construct(){

        Sesion::iniciarSesion($this->datos);

        //Indica que se ilumina en el menu superior
        $this->datos["menuActivo"] = "cursos";

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

        $this->vista("CursosProfesor/index",$this->datos);

    }

    public function ver_curso($id_curso){

        $this->datos['materialesEvaluables']=$this->CursoModelo->getEvaluables($id_curso);
        $this->datos['materialesNoEvaluables']=$this->CursoModelo->getNoEvaluables($id_curso);

        //Indica que se ilumina en el menu superior
        $this->datos["menuActivo"] = "curso";

        $this->datos["cursoactual"] = $id_curso;

        $this->vista("/CursosProfesor/ver_curso",$this->datos);

    }

    public function ver_profesores($id_curso) {

        $this->datos["profesores"] = $this->CursoModelo->getProfesores($id_curso);

        //Indica que se ilumina en el menu superior
        $this->datos["menuActivo"] = "profesor";

        $this->datos["cursoactual"]= $id_curso;

        $this->vista("/CursosProfesor/ver_profesores",$this->datos);

    }

    public function ver_alumnos($id_curso) {

        $this->datos["alumnos"] = $this->CursoModelo->getAlumnos($id_curso);

        //Indica que se ilumina en el menu superior
        $this->datos["menuActivo"] = "alumno";

        $this->datos["cursoactual"]= $id_curso;

        $this->vista("/CursosProfesor/ver_alumnos",$this->datos);

    }

    public function ver_material($id_material) {

            //Indica que se ilumina en el menu superior
            $this->datos["menuActivo"] = "curso";

            $this->datos["material"] = $this->CursoModelo->getMaterial($id_material);

            $this->datos["cursoactual"]= $this->CursoModelo->getCursoMaterial($id_material);

            $this->datos["materialRealizado"] = $this->CursoModelo->getAlumnosRealizados($id_material);
            
            $this->datos["materialNoRealizado"] = $this->CursoModelo->getAlumnosNoRealizados($id_material);

            $this->vista("/CursosProfesor/ver_material",$this->datos);

    }

    public function add_evaluable($id_curso) {

        if ($_SERVER["REQUEST_METHOD"]=="POST") {

            $material = $_POST;

            if ($this->CursoModelo->addEvaluable($material)) {
                redireccionar("/curso/ver_curso/".$id_curso);
            }else{
                echo "error";
            }
            
        } 

    }

    public function add_noevaluable($id_curso) {

        if ($_SERVER["REQUEST_METHOD"]=="POST") {

            $material = $_POST;

            if ($this->CursoModelo->addNoEvaluable($material)) {
                redireccionar("/curso/ver_curso/".$id_curso);
            }else{
                echo "error";
            }
            
        } 

    }

    public function add_nota($id_material) {

        if ($_SERVER["REQUEST_METHOD"]=="POST") {

            $nota = $_POST;

            if ($this->CursoModelo->addNotas($nota)) {
                redireccionar("/curso/ver_material/".$id_material);
            }else{
                echo "error";
            }
            
        } 
    }

    public function get_notas($id_material) {

        $this->datos["notas"] = $this->CursoModelo->getNotas($id_material);

    }


}