<?php foreach ($pantallas as $pantalla) :?>
<!--div style="border:3px solid #F88000;margin-right: 80%"-->
    <div class="col-md-6" style="text-align:center">
        <img style="border:7px solid buttonface;" width="90%" height="90%"
             src="<?= base_url() . 'asset/img/' . $pantalla['foto'] ?>" class="img-rounded" alt="img_pantalla">
        <b><p style="color:orange;"><?php echo $pantalla['localidad'] ?><br>
                <?php echo $pantalla['direccion'] ?></p></b>
        <div class="dropdown">
            <button class="btn btn-default dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">
                Acciones
                <span class="caret"></span></button>
            <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                <li role="presentation"><?php echo anchor("Cont_spot/VerSpotDePant/{$pantalla['idpantalla']}", "Ver Spots"); ?></li>
                <li role="presentation"><?php echo anchor("Cont_spot/BorraPantallaSeg/{$pantalla['idpantalla']}", "Borrar Pantalla"); ?></li>
            </ul>
        </div><br>
    </div>
    
<?php endforeach; ?>
