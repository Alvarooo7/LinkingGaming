<?php

class Home extends Controller
{
    public function __construct()
    {
        $this->usuario = $this->model('usuario');
        $this->publicaciones = $this->model('publicar');
    }

    public function index()
    {
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
                    'nroLikesXusuario' => $nroLikes,
                    
                ];
                
                $this->view('pages/home', $datosRed);
            } else {
                $this->view('pages/perfil/completarPerfil', $_SESSION['logueado']);
            }
        } else {
            redirection('/home/login');
        }
    }

//FUNCION PARA REDIRIGIR A DASHBOARD SOLO A LOS ADMIN
public function dashboard(){
  $datosUsuario = $this->usuario->getUsuario($_SESSION['usuario']);
  $datosPerfil = $this->usuario->getPerfil($_SESSION['logueado']);
  $misNotificaciones = $this->publicaciones->getNotificaciones($_SESSION['logueado']);
  $misMensajes = $this->publicaciones->getMensajes($_SESSION['logueado']);
  $totalLikes = $this->publicaciones->cantidadTotalLikes();
  $totalUsers = $this->usuario->getCantidadUsuarios();
  $totalComentario = $this->publicaciones->getCantidadComentarios();
  $totalPost = $this->publicaciones->getCantidadPosts();
  $usuariosPorMes = $this->usuario->getUsuariosXmes();
  if ($datosPerfil) {
      $datosRed = [
          'usuario' => $datosUsuario,
          'perfil' => $datosPerfil,
          'misNoticaciones' => $misNotificaciones,
          'misMensajes' => $misMensajes,
          'totalLikes' =>  $totalLikes,
          'totalUsers' => $totalUsers,
          'totalComentario' => $totalComentario,
          'totalPost' => $totalPost,
          'usuariosPorMes' => $usuariosPorMes
      ];
  
  $this->view('pages/dashboard/dashboard',$datosRed);
}
}

    //FUNCION PARA LOGUEARSE
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $datosLogin = [
                'usuario' => trim($_POST['usuario']),
                'contrasena' => trim($_POST['contrasena'])
            ];

            $datosUsuario = $this->usuario->getUsuario($datosLogin['usuario']);

            if ($this->usuario->verificarContrasena($datosUsuario, $datosLogin['contrasena'])) {
                $_SESSION['logueado'] = $datosUsuario->idusuario;
                $_SESSION['usuario'] = $datosUsuario->usuario;
                $_SESSION['privilege'] = $datosUsuario->idPrivilegio;
                redirection('/home');
            } else {
              if($datosLogin['usuario']=="" && $datosLogin['contrasena']==""){
                $_SESSION['errorLogin'] = 'Ingrese password y contrasena';
                redirection('/home');
              }
              else if($datosLogin['usuario']==""){
                $_SESSION['errorLogin'] = 'Ingrese usuario';
                redirection('/home');
              }
              else if($datosLogin['contrasena']==""){
                $_SESSION['errorLogin'] = 'Ingrese contrasena';
                redirection('/home');
              }
              else{
                $_SESSION['errorLogin'] = 'El usuario y/o la contraseña son incorrectos';
                redirection('/home');
              }
            }
        } else {
            if (isset($_SESSION['logueado'])) {
                redirection('/home');
            } else {
                $this->view('pages/login-register/login');
            }
        }
    }

    //CONTROLADOR PARA REGISTRAR USUARIO
    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $datosRegistro = [
                'privilegio' => '2',
                'email' => trim($_POST['email']),
                'usuario' => trim($_POST['usuario']),
                'contrasena' => password_hash(trim($_POST['contrasena']), PASSWORD_DEFAULT)
            ];

            //QUE LOS CAMPOS ESTEN CON REGISTRO
            if($datosRegistro['email']=='' && $datosRegistro['usuario']=='' && $_POST['contrasena']==''){
              $_SESSION['requisitos'] = 'Debe llenar todos los campos para registrarse';
              $this->view('pages/login-register/register');
            }


            //VALIDACION DEL EMAIL CORRECTO
            else if($datosRegistro['email']==''){
              $_SESSION['requisitos'] = 'Ingrese un email';
              $this->view('pages/login-register/register');
            }else if(!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$datosRegistro['email'])){
              $_SESSION['requisitos'] = 'Formato incorrecto de email';
              $this->view('pages/login-register/register');
            }

            //VALIDACION DEL USUARIO
            else if($datosRegistro['usuario']==''){
              $_SESSION['requisitos'] = 'Ingrese un usuario';
              $this->view('pages/login-register/register');
            }
            //USUARIO CON CARACTERES MAYOR A LOS 20
            else if(strlen($datosRegistro['usuario'])>20){
              $_SESSION['requisitos'] = 'El usuario no puede exceder las 20 letras';
              $this->view('pages/login-register/register');
            }

            //VALIDACION DE CONTRASEÑA
            //LA CONTRASEÑA NO PUEDE IR VACIA
            else if(empty($_POST['contrasena'])){
              $_SESSION['requisitos'] = 'Ingrese una contraseña';
              $this->view('pages/login-register/register');
            }
              //LA CONTRASENA NO DEBE SER MENOR DE 8 DIGITOS
            else if(strlen($_POST['contrasena'])<8){
              $_SESSION['requisitos'] = 'La contraseña debe tener al menos 8 caracteres';
              $this->view('pages/login-register/register');
            }
              //LA CONTRASENA NO PUEDE SER MAYOR A 16 CARACTERES
            else if(strlen($_POST['contrasena'])>16){
              $_SESSION['requisitos'] = 'La contraseña debe tener máximo 16 caracteres';
              $this->view('pages/login-register/register');
            }
              //LA CONTRASENA DEBE TENER AL MENOS UNA MINUSCULA
            else if(!preg_match('`[a-z]`',$_POST['contrasena'])){
              $_SESSION['requisitos'] = 'La contraseña debe tener al menos una letra minuscula';
              $this->view('pages/login-register/register');
            }
              //LA CONTRASENA DEBE TENER AL MENOS UNA MAYUSCULA
            else if(!preg_match('`[A-Z]`',$_POST['contrasena'])){
              $_SESSION['requisitos'] = 'La contraseña debe tener al menos una letra mayuscula';
              $this->view('pages/login-register/register');
            }
              //LA CONTRASENA DEBE TENER UN CARACTER NUMERICO COMO MINIMO
            else if(!preg_match('`[0-9]`',$_POST['contrasena'])){
              $_SESSION['requisitos'] = 'La contraseña debe tener al menos un caracter numerico';
              $this->view('pages/login-register/register');
            }

            //VERIFICAR SI ESTÁ REGISTRADO EL EMAIL O EL USUARIO
            else if ($this->usuario->verificarUsuario($datosRegistro)) {
              //SI TOD ESTÁ CORRECTO SE MANDA EL REGISTRO
                if ($this->usuario->register($datosRegistro)) {
                    $_SESSION['loginComplete'] = 'Tu registro se ha completado satisfactoriamente, ahora puedes ingresar';
                    redirection('/home');
                } else { }

            } else {
                $_SESSION['usuarioError'] = 'El usuario y/o email no estan disponibles, intententelo de nuevo';
                $this->view('pages/login-register/register');
            }
        } else {
            if (isset($_SESSION['logueado'])) {
                redirection('/home');
            } else {
                $this->view('pages/login-register/register');
            }
        }
    }



    //COMPLETAR EL REGISTRO DE PERFIL CON NOMBRE Y FOTO DE PERFIL
    public function insertarRegistrosPerfil()
    {
        $carpeta = 'C:/xampp/htdocs/SocialNetwork/public/img/imagenesPerfil/';

        opendir($carpeta);
        $nombreImagen = $_FILES['imagen']['name'];
        $rutaImagen = 'img/imagenesPerfil/' . $nombreImagen;

        $ruta = $carpeta . $nombreImagen;

        if($nombreImagen == "" && $_POST['nombre']=='' ){
          $_SESSION['completarPerfil'] = 'Ingresar nombre y una foto para terminar su registro';
          $this->view('pages/perfil/completarPerfil');
        }

        if($nombreImagen == ''){
          $_SESSION['completarPerfil'] = 'Debe ingresar una imagen para completar su perfil';
          $this->view('pages/perfil/completarPerfil');
        }else {
          copy($_FILES['imagen']['tmp_name'], $ruta);
        }

        $imagenFileType = strtolower(pathinfo($ruta,PATHINFO_EXTENSION));

        $datos = [
            'idusuario' => trim($_POST['id_user']),
            'nombre' => trim($_POST['nombre']),
            'ruta' => $rutaImagen,
           
        ];


        if($datos['nombre']==''){
          $_SESSION['completarPerfil'] = 'Debe ingresar un nombre';
          $this->view('pages/perfil/completarPerfil');
        }

        else if(!preg_match("/^[a-zA-Z]+/",$datos['nombre'])){
          $_SESSION['completarPerfil'] = 'Solo se permiten letras como nombre';
          $this->view('pages/perfil/completarPerfil');
        }
        else if(strlen($datos['nombre'])>60 ){
          $_SESSION['completarPerfil'] = 'El nombre no puede execeder los 60 caracteres';
          $this->view('pages/perfil/completarPerfil');
        }
        else if($datos['ruta'] == ""){
          $_SESSION['completarPerfil'] = 'Debe ingresar una imagen para completar su perfil';
          $this->view('pages/perfil/completarPerfil');
        }


        else if($imagenFileType !="jpg" && $imagenFileType != "png" && $imagenFileType != "jpeg"){
          $_SESSION['completarPerfil'] = 'Lo siento solo JPG, JPEG o PNG está permitido';
          $this->view('pages/perfil/completarPerfil');
        }

        else if ($this->usuario->insertarPerfil($datos)) {
            redirection('/home');
        } else {
            echo 'El perfil no se ha guardado';
        }
    }


    //FUNCiON PARA CERRAR SESION
    public function logout()
    {
        session_start();

        $_SESSION = [];

        session_destroy();

        redirection('/home');
    }

    public function usuarios()
    {
        if (isset($_SESSION['logueado'])) {

            $datosUsuario = $this->usuario->getUsuario($_SESSION['usuario']);
            $datosPerfil = $this->usuario->getPerfil($_SESSION['logueado']);
            $misNotificaciones = $this->publicaciones->getNotificaciones($_SESSION['logueado']);
            $misMensajes = $this->publicaciones->getMensajes($_SESSION['logueado']);
            $usuariosRegistrados = $this->usuario->getAllUsuarios();
            $cantidadUsuarios = $this->usuario->getCantidadUsuarios();

            if ($datosPerfil) {
                $datosRed = [
                    'usuario' => $datosUsuario,
                    'perfil' => $datosPerfil,
                    'misNoticaciones' => $misNotificaciones,
                    'misMensajes' => $misMensajes,
                    'allUsuarios' => $usuariosRegistrados,
                    'cantidadUsuarios' => $cantidadUsuarios
                ];
                $this->view('pages/usuarios/usuarios', $datosRed);
            } else {
                redirection('/home');
            }
        }
    }

    public function buscar()
    {
        if (isset($_SESSION['logueado'])) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $busqueda = '%' . trim($_POST['buscar']) . '%';
                $datosBusqueda = $this->usuario->buscar($busqueda);


                $datosUsuario = $this->usuario->getUsuario($_SESSION['usuario']);
                $datosPerfil = $this->usuario->getPerfil($_SESSION['logueado']);
                $misNotificaciones = $this->publicaciones->getNotificaciones($_SESSION['logueado']);
                $misMensajes = $this->publicaciones->getMensajes($_SESSION['logueado']);


                if ($datosPerfil) {
                    $datosRed = [
                        'usuario' => $datosUsuario,
                        'perfil' => $datosPerfil,
                        'misNoticaciones' => $misNotificaciones,
                        'misMensajes' => $misMensajes,
                        'resultado' => $datosBusqueda
                    ];

                    if ($datosBusqueda) {
                        $this->view('pages/busqueda/buscar' , $datosRed);
                    } else {
                        redirection('/home');
                    }
                } else {
                    redirection('/home');
                }
            } else {
                redirection('/home');
            }
        }
    }

  
}
