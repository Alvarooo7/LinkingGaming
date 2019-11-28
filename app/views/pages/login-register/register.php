<?php

include_once URL_APP . '/views/custom/header.php';

?>

<div class="container-center center">
    <div class="container-content center">
        <div class="content-action center">
            <h4>Registrarme</h4>
            <form action="<?php echo URL_PROJECT ?>/home/register" method="POST" onsubmit="return validar();">
                <input type="text" name="email" id="email" placeholder="Email" >
                <input type="text" name="usuario" id="usuario" placeholder="Usuario"  >
                <input type="password" name="contrasena" id="contrasena" placeholder="Contraseña"   >
                <button class="btn-purple btn-block">Registrarme</button>
            </form>

            <?php if (isset($_SESSION['requisitos'])) : ?>
                <div class="alert alert-danger alert-dismissible fade show mt-2 mb-2" role="alert">
                    <?php echo $_SESSION['requisitos'].'.<br>' ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php unset($_SESSION['requisitos']);
            endif ?>



            <?php if (isset($_SESSION['usuarioError'])) : ?>
                <div class="alert alert-danger alert-dismissible fade show mt-2 mb-2" role="alert">
                    <?php echo $_SESSION['usuarioError'] ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php unset($_SESSION['usuarioError']);
            endif ?>

            <div class="contenido-link mt-2">
                <span class="mr-2">¿Ya tienes una cuenta?</span>
                <a href="<?php echo URL_PROJECT ?>/home/login">Ingresar</a>
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

<script src="<?php echo URL_PROJECT ?>/js/registroME.js"></script>
