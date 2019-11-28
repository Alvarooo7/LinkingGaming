<?php

include_once URL_APP . '/views/custom/header.php';

?>


<div class="completarPerfil">
    <div class="container">
        <div class="container-perfil">
            <h2 class="text-center">Completa tu perfil</h2>
            <h6 class="text-center">Antes de continuar deberas completar tu perfil</h6>
            <hr>
            <div class="content-completar-perfil center">
                <form action="<?php echo URL_PROJECT ?>/home/insertarRegistrosPerfil" method="POST" enctype="multipart/form-data" id="validationForm" name="validationForm">

                    <input type="hidden" name="id_user" value="<?php echo $_SESSION['logueado'] ?>">
                    <div class="form-group">
                        <input type="text" name="nombre" id="nombre"class="form-control" placeholder="Nombre completo"  onkeyup="validar()" onblur="validar()" >
                    </div>

                    <div id="message" style="position: absolute; right: 475px;
                    bottom: 40px; background-color: rgba(96, 55, 162, 0.74); z-index: 10" hidden>
                      Introduzca solo letras (A-Z) o (a-z). Máximo 60 caracteres.
                    </div>

                    <div class="form-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input"
                            name="imagen" id="imagen" name="imagen" >
                            <label class="custom-file-label" for="imagen">Seleccionar una foto</label>
                        </div>
                    </div>
                    <button class="btn-purple btn-block" onclick="verificar()">Registrar datos</button>
                </form>
            </div>
            <br>

            <?php if (isset($_SESSION['completarPerfil'])) : ?>
                <div class="alert alert-danger alert-dismissible fade show mt-0 mb-0" role="alert">
                    <?php echo $_SESSION['completarPerfil'] ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php unset($_SESSION['completarPerfil']);
            endif ?>


        </div>
    </div>
</div>

<?php

include_once URL_APP . '/views/custom/footer.php';

?>

<script src="<?php echo URL_PROJECT?>/js/completarPerfil.js"></script>
