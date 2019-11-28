<?php

include_once URL_APP . '/views/custom/header.php';

?>

<div class="container-center center">
    <div class="container-content center">
        <div class="content-action center">
            <h4>Iniciar sesión</h4>
            <form action="<?php echo URL_PROJECT ?>/home/login" method="POST">
                <input type="text" name="usuario" placeholder="Usuario" >
                <input type="password" name="contrasena" placeholder="Contraseña" >
                <button class="btn-purple btn-block">Ingresar</button>
            </form>
            <!-- Esta es la alerta cuando el usuario o la contraseña son incorrectos -->
            <?php if (isset($_SESSION['errorLogin'])) : ?>
                <div class="alert alert-danger alert-dismissible fade show mt-2 mb-2" role="alert">
                    <?php echo $_SESSION['errorLogin'] ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php unset($_SESSION['errorLogin']);
            endif ?>

            <!-- Esta es la alerta cuanto el registro se completo -->
            <?php if (isset($_SESSION['loginComplete'])) : ?>
                <div class="alert alert-success alert-dismissible fade show mt-2 mb-2" role="alert">
                    <?php echo $_SESSION['loginComplete'] ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php unset($_SESSION['loginComplete']);
            endif ?>

            <div class="contenido-link mt-2">
                <span class="mr-2">¿No tienes una cuenta?</span><a href="<?php echo URL_PROJECT ?>/home/register">Registrarme</a>
            </div>
        </div>
        <div class="content-image center">
            <img src="<?php echo URL_PROJECT ?>/img/vector.png" alt="Hombre sentado en una computadora">
        </div>
    </div>
</div>

<?php

include_once URL_APP . '/views/custom/footer.php';

?>
