<?php

include_once URL_APP . '/views/custom/header.php';

include_once URL_APP . '/views/custom/navbar.php';

?>

<div class="perfil-container-usuario">
    <div class="imagen-header-perfil-usuario">
        <img src="<?php echo URL_PROJECT ?>/img/imagenesPerfil/imagenes-portada-perfil/cover-img.jpg" class="imagen-portada-perfil" alt="">
    </div>
    <div class="container-header-usuario">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="datos-perfil-usuario">
                        <img src="<?php echo URL_PROJECT ?>/<?php echo $datos['perfil']->fotoPerfil ?>" class="imagen-perfil-usuario" alt="">
                        <?php if ($datos['usuario']->idusuario == $_SESSION['logueado']) : ?>
                            <div class="imagen-perfil-cambiar">
                                <form action="<?php echo URL_PROJECT ?>/perfil/cambiarImagen" method="POST" enctype="multipart/form-data">
                                    <i class="fas fa-camera"></i>
                                    <div class="input-file">
                                        <input type="hidden" name="id_user" value="<?php echo $_SESSION['logueado']?> ">
                                        <input type="file" name="imagen" id="imagen" required>
                                    </div>
                                    </div>
                                    <div class="editar-perfil">
                                        <button class="btn-change-image">Editar</button>
                                    </div>
                                </form>
                            
                        <?php endif ?>
                        <div class="datos-personales-usuario">
                            <h3><?php echo ucwords($datos['usuario']->usuario) ?></h3>
                            <div class="descripcion-usuario">
                                <span><?php echo $datos['perfil']->nombreCompleto ?></span>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-md-6">
                    <div class="container-principal-informacion-usuario">
                        <div class="container-style-main">
                            <?php if ($datos['usuario']->idusuario == $_SESSION['logueado']) : ?>
                                <div class="container-usuario-publicar">
                                    <a href="<?php echo URL_PROJECT ?>/perfil/<?php echo $datos['usuario']->usuario ?>"><img src="<?php echo URL_PROJECT . '/' . $datos['perfil']->fotoPerfil ?>" class="image-border " alt=""></a>
                                    <form action="" class="form-publicar ml-2">
                                        <textarea name="" id="" class="published mb-0" name="post" placeholder="Que estas pensando?" required></textarea>
                                        <div class="image-upload-file">
                                            <div class="upload-photo">
                                                <img src="<?php echo URL_PROJECT ?>/img/image.png" alt="" class="image-public">
                                                <div class="input-file">
                                                    <input type="file" name="imagen" id="imagen">
                                                </div>
                                                <span class="ml-1">Subir foto</span>
                                            </div>
                                            <button class="btn-publi">Publicar</button>
                                        </div>

                                    </form>
                                </div>
                            <?php endif ?>

                        </div>
                    </div>
                </div>


                <div class="col-md-2">
                  
                </div>
            </div>
        </div>
    </div>
</div>


<?php

include_once URL_APP . '/views/custom/footer.php';

?>