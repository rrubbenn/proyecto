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

        $this->datos["CursosProfesor"]=$this->CursoModelo->getCursosProfesor($this->datos['usuarioSesion']->id_persona);
        $this->datos["CursosAlumno"]=$this->CursoModelo->getCursosAlumno($this->datos['usuarioSesion']->id_persona);
        $this->datos["CursosAdmin"]=$this->CursoModelo->getCursosAdmin();

        $this->vista("Cursos/index",$this->datos);

    }

    public function add_curso() {

        if ($_SERVER["REQUEST_METHOD"]=="POST") {

            $datos = $_POST;

            $this->vistaApi($this->CursoModelo->addCurso($datos));

        }
    }

    public function del_curso(){

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            $id_curso = $_POST["id_curso"];

            if ($this->CursoModelo->delCurso($id_curso)){
                
                $this->vistaApi(true);

            } else {
                
                $this->vistaApi(false);

            }
        }
    }

    /////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////
    /////////////RELACIONADO CON ver_curso //////////////////
    /////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////

    public function ver_curso($id_curso){

        $this->datos['materialesEvaluables']=$this->CursoModelo->getEvaluables($id_curso);
        $this->datos['materialesNoEvaluables']=$this->CursoModelo->getNoEvaluables($id_curso);

        //Indica que se ilumina en el menu superior
        $this->datos["menuActivo"] = "curso";

        $this->datos["cursoactual"] = $id_curso;

        $this->vista("/Cursos/ver_curso",$this->datos);

    }
    
    /////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////
    ///////////RELACIONADO CON ver_profesores////////////////
    /////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////
    
    public function ver_profesores($id_curso) {

        $this->datos["profesores"] = $this->CursoModelo->getProfesores($id_curso);

        //Indica que se ilumina en el menu superior
        $this->datos["menuActivo"] = "profesor";

        $this->datos["cursoactual"]= $id_curso;

        $this->vista("/Cursos/ver_profesores",$this->datos);

    }

    public function add_profesor_curso($id_curso) {

        if ($_SERVER["REQUEST_METHOD"]=="POST") {

            $datos = $_POST;

            if ($this->CursoModelo->addProfesorCurso($datos)) {
                redireccionar("/curso/ver_profesores/".$id_curso);
            }else{
                echo "error";
            }
            
        } 
    }

    public function delete_profesor_curso($id_curso) {

        if ($_SERVER["REQUEST_METHOD"]=="POST") {

            $datos = $_POST;

            if ($this->CursoModelo->deleteProfesorCurso($datos)) {
                redireccionar("/curso/ver_profesores/".$id_curso);
            }else{
                echo "error";
            }
            
        } 
    }

    public function rellenarSelectProfesor($id_curso) {

        $datos = $this->CursoModelo->getProfesorSelectDNI($id_curso);

        $this->vistaApi($datos);

    }

    /////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////
    /////////////RELACIONADO CON ver_alumnos/////////////////
    /////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////


    public function ver_alumnos($id_curso) {

        $this->datos["alumnos"] = $this->CursoModelo->getAlumnos($id_curso);

        //Indica que se ilumina en el menu superior
        $this->datos["menuActivo"] = "alumno";

        $this->datos["cursoactual"] = $id_curso;

        $this->vista("/Cursos/ver_alumnos",$this->datos);

    }

    public function add_alumno_curso($id_curso) {

        if ($_SERVER["REQUEST_METHOD"]=="POST") {

            $datos = $_POST;

            if ($this->CursoModelo->addAlumnoCurso($datos)) {
                redireccionar("/curso/ver_alumnos/".$id_curso);
            }else{
                echo "error";
            }
            
        } 
    }

    public function delete_alumno_curso($id_curso) {

        if ($_SERVER["REQUEST_METHOD"]=="POST") {

            $datos = $_POST;

            if ($this->CursoModelo->deleteAlumnoCurso($datos)) {
                redireccionar("/curso/ver_alumnos/".$id_curso);
            }else{
                echo "error";
            }
            
        } 
    }

    public function rellenarSelectAlumno($id_curso) {

        $datos = $this->CursoModelo->getAlumnoSelectDNI($id_curso);

        $this->vistaApi($datos);

    }

    // FUNCION PARA ver_alumnos Y ver_profesores
    public function rellenarFormularioDNI($dni) {

        $datos = $this->CursoModelo->getDatosDNI($dni);

        $this->vistaApi($datos);

    }

    /////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////
    //////////////RELACIONADO CON ver_curso//////////////////
    /////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////

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

    public function update_material($id_curso) {

        if ($_SERVER["REQUEST_METHOD"]=="POST") {

            $material = $_POST;

            if ($this->CursoModelo->updateMaterial($material)) {
                redireccionar("/curso/ver_curso/".$id_curso);
            }else{
                echo "error";
            }
            
        } 
    }

    public function delete_material($id_curso) {

        if ($_SERVER["REQUEST_METHOD"]=="POST") {

            $material = $_POST;

            if ($this->CursoModelo->deleteMaterial($material)) {
                redireccionar("/curso/ver_curso/".$id_curso);
            }else{
                echo "error";
            }
            
        } 
    }

    public function get_datosmaterial() {

        if ($_SERVER["REQUEST_METHOD"]=="POST") {

            $info = $_POST;

            $this->vistaApi($this->CursoModelo->getDatosMaterial($info));
            
        } 
    }

    /////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////
    /////////////RELACIONADO CON ver_material////////////////
    /////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////

    public function ver_material($id_material) {

        //Indica que se ilumina en el menu superior
        $this->datos["menuActivo"] = "curso";

        $this->datos["material"] = $this->CursoModelo->getMaterial($id_material);

        $this->datos["cursoactual"]= $this->CursoModelo->getCursoMaterial($id_material);

        $this->datos["materialRealizado"] = $this->CursoModelo->getAlumnosRealizados($id_material);
        
        $this->datos["materialNoRealizado"] = $this->CursoModelo->getAlumnosNoRealizados($id_material);

        $this->vista("/Cursos/ver_material",$this->datos);

    }
    
    public function add_notas($id_material) {

        if ($_SERVER["REQUEST_METHOD"]=="POST") {

            $nota = $_POST;

            if ($this->CursoModelo->addNotas($nota)) {
                redireccionar("/curso/ver_material/".$id_material);
            }else{
                echo "error";
            }
            
        } 
    }

    public function edit_notas($id_material) {

        if ($_SERVER["REQUEST_METHOD"]=="POST") {

            $nota = $_POST;

            if ($nota['nota'] == "") {

                if ($this->CursoModelo->deleteNotas($nota)) {
                    redireccionar("/curso/ver_material/".$id_material);
                }else{
                    echo "error";
                }

            } else {

                if ($this->CursoModelo->editNotas($nota)) {
                    redireccionar("/curso/ver_material/".$id_material);
                }else{
                    echo "error";
                }

            }
        } 
    }

    public function get_notas() {

        if ($_SERVER["REQUEST_METHOD"]=="POST") {

            $info = $_POST;

            $this->vistaApi($this->CursoModelo->getNotas($info));
            
        } 
    }


}