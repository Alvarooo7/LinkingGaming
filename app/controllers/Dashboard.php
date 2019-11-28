<?php

class Dashboard extends Controller
{
  public function __construct()
  {

      $this->publicaciones = $this->model('publicar');
      $this->usuario = $this->model('usuario');
  }

  if (isset($_SESSION['logueado'])) {

    $datosUsuario = $this->usuario->getUsuario($_SESSION['usuario']);
    $datosPerfil = $this->usuario->getPerfil($_SESSION['logueado']);

    $datosPublicaciones = $this->publicaciones->getPublicaciones();

    $verificarLike = $this->publicaciones->misLikes($_SESSION['logueado']);

    $comentarios = $this->publicaciones->getComentarios();

    $informacionComentarios = $this->publicaciones->getInformacionComentarios($comentarios);

    $misNotificaciones = $this->publicaciones->getNotificaciones($_SESSION['logueado']);

    $misMensajes = $this->publicaciones->getMensajes($_SESSION['logueado']);

    $miPrivilegio = $_SESSION['privilege'];

    $nroPublicaciones = $this->publicaciones->getCantidadPublicaciones($_SESSION['logueado']); 

    $nroLikes = $this->publicaciones->misLikesXusuario($_SESSION['logueado']);

    if ($datosPerfil) {
        $datosRed = [
            'usuario' => $datosUsuario,
            'perfil' => $datosPerfil,
            'publicaciones' => $datosPublicaciones,
            'misLikes' => $verificarLike,
            'comentarios' => $informacionComentarios,
            'misNoticaciones' => $misNotificaciones,
            'misMensajes' => $misMensajes,
            'miPrivilegio' => $miPrivilegio,
            'nroPublicaciones' => $nroPublicaciones,
            'nroLikesXusuario' => $nroLikes
        ];
        
        $this->view('pages/dashboard/dashboard', $datosRed);
    } else {
        $this->view('pages/perfil/completarPerfil', $_SESSION['logueado']);
    }
} else {
    redirection('/home/login');
}

    
  }


    //FUNCION PARA LOGUEARSE
   

