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

    public function index(){

        $this->datos["Usuarios"]=$this->UsuarioModelo->getUsuarios();

        $this->vista("Usuarios/index",$this->datos);

    }

    public function delete_usuario(){

        if ($_SERVER["REQUEST_METHOD"]=="POST") {

            $id_persona = $_POST['id_persona'];

            if ($this->UsuarioModelo->deleteUsuario($id_persona)) {
                redireccionar("/usuario");
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

    public function editar_usuario(){

        if ($_SERVER["REQUEST_METHOD"]=="POST") {

            $datos = $_POST;

            if ($this->UsuarioModelo->editarUsuario($datos)) {
                redireccionar("/usuario");
            }else{
                echo "error";
            }
            
        } 

    }

    public function get_roles() {

        $this->vistaApi($this->UsuarioModelo->getRoles());

    }

}