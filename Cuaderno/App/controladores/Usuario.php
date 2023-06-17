<?php

class Usuario extends Controlador{

    public function __construct(){

        Sesion::iniciarSesion($this->datos);

        //Indica que se ilumina en el menu superior
        $this->datos["menuActivo"] = "usuarios";

        $this->UsuarioModelo = $this->Modelo('UsuarioModelo');
        
        
        $this->datos['rolesPermitidos'] = [3];         // Definimos los roles que tendran acceso                      
        
        // Comprobamos si tiene privilegios
        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol,$this->datos['rolesPermitidos'])) {
            echo "No tienes privilegios!!!";
            exit();
            // redireccionar('/');
        }

    }

    public function index($pag){

        $numusuarios = $this->UsuarioModelo->numUsuarios();
        
        $objporpaj = 10;
        $paginas = ceil($numusuarios / $objporpaj);
        
        $pag = (int) $pag;
        $inicio = ($pag - 1) * $objporpaj;
        $fin = $objporpaj;

        $this->datos["nPaginas"]=$paginas;

        $this->datos["pagActual"] = $pag;

        $this->datos["Usuarios"]=$this->UsuarioModelo->getUsuarios($inicio, $fin);
        

        $this->vista("Usuarios/index",$this->datos);

    }

    public function add_usuario() {

        if ($_SERVER["REQUEST_METHOD"]=="POST") {

            $datos = $_POST;

            $this->UsuarioModelo->addUsuario($datos);

        } 

    }

    public function delete_usuario($pag){

        if ($_SERVER["REQUEST_METHOD"]=="POST") {

            $id_persona = $_POST['id_persona'];

            if ($this->UsuarioModelo->deleteUsuario($id_persona)) {
                redireccionar("/usuario/".$pag);
            }else{
                echo "error";
            }
            
        } 

    }

    public function get_datosusuario() {

        if ($_SERVER["REQUEST_METHOD"]=="POST") {

            $id_persona = $_POST['id_persona'];
            
            $this->vistaApi($this->UsuarioModelo->getDatosUsuario($id_persona));
            
        } 
    }

    public function editar_usuario($pag){

        if ($_SERVER["REQUEST_METHOD"]=="POST") {

            $datos = $_POST;

            if ($this->UsuarioModelo->editarUsuario($datos)) {
                redireccionar("/usuario/".$pag);
            }else{
                echo "error";
            }
            
        } 

    }

    public function get_roles() {

        $this->vistaApi($this->UsuarioModelo->getRoles());

    }

}