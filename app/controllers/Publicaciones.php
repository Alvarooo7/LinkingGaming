<?php

class Publicaciones extends Controller
{
    public function __construct()
    {
        $this->publicar = $this->model('publicar');
    }

    public function publicar($idUsuario)
    {

        if (isset($_FILES['imagen'])) {
            $carpeta = 'C:/xampp/htdocs/SocialNetwork/public/img/imagenesPublicaciones/';
            opendir($carpeta);
            $nombreImagen = $_FILES['imagen']['name'];
            $rutaImagen = 'img/imagenesPublicaciones/' . $nombreImagen;
            $ruta = $carpeta . $_FILES['imagen']['name'];
            copy($_FILES['imagen']['tmp_name'], $ruta);

            $imagenFileType = strtolower(pathinfo($ruta,PATHINFO_EXTENSION));
        } else {
            $rutaImagen = 'sin imagen';
        }

        $datos = [
            'iduser' => trim($idUsuario),
            'contenido' => trim($_POST['contenido']),
            'foto' => $rutaImagen,
            
        ];


        if($datos['contenido']=='' && $datos['foto']=='img/imagenesPublicaciones/'){
          $_SESSION['validarPublicacion'] = 'No hay nada por subir';
          redirection('/home');
        }

        else if($imagenFileType !="jpg" && $imagenFileType != "png" && $imagenFileType != "jpeg" &&
          $datos['foto']!='img/imagenesPublicaciones/'){
         $_SESSION['validarPublicacion'] = 'Lo siento solo JPG, JPEG o PNG está permitido';
         redirection('/home');
        }

        else if(strlen($datos['contenido'])>250){
          $_SESSION['validarPublicacion'] = 'Por favor ingrese un texto no mayor a 250 caracteres';
          redirection('/home');
        }


        else if ($this->publicar->publicar($datos)) {
          $_SESSION['publicacionExitosa'] = 'Publicación exitosa :)';
          redirection('/home');
          } else {
          $_SESSION['publicacionExitosa'] = 'Algo ocurrio mal';
        }
    }

    public function eliminar($idpublicacion)
    {

        $publicacion = $this->publicar->getPublicacion($idpublicacion);


        if ($this->publicar->eliminarPublicacion($publicacion)) {
            unlink('C:/xampp/htdocs/SocialNetwork/public/' . $publicacion->fotoPublicacion);
            redirection('/home');
        } else { }
    }

    public function megusta($idpublicacion, $idusuario , $idusaurioPropietario)
    {
        $datos = [
            'idpublicacion' => $idpublicacion,
            'idusuario' => $idusuario,
            'idusaurioPropietario' => $idusaurioPropietario
        ];

        $datosPublicacion = $this->publicar->getPublicacion($idpublicacion);

        if ($this->publicar->rowLikes($datos)) {
            if ($this->publicar->eliminarLike($datos)) {
                $this->publicar->deleteLikeCount($datosPublicacion);
            }
            redirection('/home');
        } else {
            if ($this->publicar->agregarLike($datos)) {
                $this->publicar->addLikeCount($datosPublicacion);
                $this->publicar->addNotificacionLike($datos);
            }
            redirection('/home');
        }
    }

    public function comentar()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $datos = [
                'iduserPropietario' => trim($_POST['iduserPropietario']),
                'iduser' => trim($_POST['iduser']),
                'idpublicacion' => trim($_POST['idpublicacion']),
                'comentario' => trim($_POST['comentario']),
            ];

            if ($this->publicar->publicarComentario($datos)) {
                $this->publicar->addNotificacionComentario($datos);
                redirection('/home');
            } else {
                redirection('/home');
            }
        } else {
            redirection('/home');
        }
    }

    public function eliminarComentario($id)
    {
        if ($this->publicar->eliminarComentarioUsuario($id)) {
            redirection('/home');
        } else {
            redirection('/home');
        }
    }

}
