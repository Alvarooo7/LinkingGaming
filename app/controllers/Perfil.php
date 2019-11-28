<?php

class Perfil extends Controller
{

    public function __construct()
    {
        $this->perfil = $this->model('perfilUsuario');
        $this->usuario = $this->model('usuario');
        $this->publicaciones = $this->model('publicar');
    }

    public function index($user)
    {
        if(isset($_SESSION['logueado'])) {

            $datosUsuario = $this->usuario->getUsuario($user);
            $datosPefil = $this->usuario->getPerfil($datosUsuario->idusuario);
            $misNotificaciones = $this->publicaciones->getNotificaciones($_SESSION['logueado']);
            $misMensajes = $this->publicaciones->getMensajes($_SESSION['logueado']);

            $datos = [
                'perfil' => $datosPefil,
                'usuario' => $datosUsuario,
                'misNoticaciones' => $misNotificaciones,
                'misMensajes' => $misMensajes
            ];

            $this->view('pages/perfil/perfil' , $datos);
        }
    }

    public function cambiarImagen()
    {

        $carpeta = 'C:/xampp/htdocs/SocialNetwork/public/img/imagenesPerfil/';
        opendir($carpeta);
        $rutaImagen = 'img/imagenesPerfil/' . $_FILES['imagen']['name'];
        $ruta = $carpeta . $_FILES['imagen']['name'];
        copy($_FILES['imagen']['tmp_name'] , $ruta);

        $datos = [
            'idusuario' => trim($_POST['id_user']),
            'ruta' => $rutaImagen
        ];

        $imagenActual = $this->usuario->getPerfil($datos['idusuario']);

        unlink('C:/xampp/htdocs/SocialNetwork/public/' . $imagenActual->fotoPerfil);

         if($this->perfil->editarFoto($datos)) {
             redirection('/home');
         } else {
             echo 'El perfil no se ha guardado';
         }
    }

}
