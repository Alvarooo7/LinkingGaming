<?php

include_once URL_APP . '/views/custom/header.php';

include_once URL_APP . '/views/custom/navbar.php';

//echo "<pre>";
//print_r($datos['notificaciones']);
//echo "</pre>";
?>

<div class="container mt-3">
    <div class="container-notificaciones-usuario">
        <div class="contenido-notificaciones-usuario">
            <h3 class="text-center">Tienes <?php echo $datos['misNoticaciones'] ?> Notificaciones</h3>
            <hr>
        </div>
        <div class="container-notificaciones-usuario-revisar">
            <?php foreach($datos['notificaciones'] as $datosNotifiacion): ?>
                <a href="<?php echo URL_PROJECT ?>/notificaciones/eliminar/<?php echo $datosNotifiacion->idnotificacion ?>" class="link-notificacion mb-1"><div class="alert alert-success"><?php echo $datosNotifiacion->usuario . ' ' . $datosNotifiacion->mensajeNotificacion ?></div></a>
            <?php endforeach ?>
        </div>
    </div>
</div>

<?php

include_once URL_APP . '/views/custom/footer.php';

?>
