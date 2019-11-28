<?php

class Mensajes extends Controller
{
    public function __construct()
    {
        $this->publicaciones = $this->model('publicar');
        $this->usuario = $this->model('usuario');
        $this->mensaje = $this->model('mensajesMod');
    }

    public function index()
    {
        
            if ($_SERVER['REQUEST_METHOD'] == 'POST') { 

                $datosMensaje = [
                    'idusermando' => trim($_POST['idusermando']),
                    'enviar' => trim($_POST['enviar']),
                    'mensaje' => trim($_POST['mensaje'])
                ];

                if($this->mensaje->enviarMensaje($datosMensaje)) {
                    redirection('/mensajes');
                } else {
                    redirection('/mensajes');
                }

            } else {
                if (isset($_SESSION['logueado'])) {
                    $datosUsuario = $this->usuario->getUsuario($_SESSION['usuario']);
                    $datosPefil = $this->usuario->getPerfil($datosUsuario->idusuario);
                    $misNotificaciones = $this->publicaciones->getNotificaciones($_SESSION['logueado']);
                    $misMensajes = $this->publicaciones->getMensajes($_SESSION['logueado']);
                    $datosUsuarios = $this->usuario->getUsuarios();
                    $ownMensajes = $this->mensaje->getMensajes($_SESSION['logueado']);

                    $datos = [
                        'perfil' => $datosPefil,
                        'usuario' => $datosUsuario,
                        'misNoticaciones' => $misNotificaciones,
                        'usuarios' => $datosUsuarios,
                        'misMensajes' => $misMensajes,
                        'ownMensajes' => $ownMensajes
                    ];

                    $this->view('pages/mensajes/mensajes', $datos);
                } else {
                    redirection('/home');
                }
            }
    }

    public function eliminarMensaje($id) 
    {
        if($this->mensaje->eliminarMensaje($id)) {
            redirection('/mensajes');
        } else {
            redirection('/mensajes');
        }
    }
}
