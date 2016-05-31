<?php foreach ($pantallas as $pantalla) :?>
<!--div style="border:3px solid #F88000;margin-right: 80%"-->
    <div class="col-md-6" style="text-align:center">
        <img style="border:7px solid buttonface;" width="90%" height="90%"
             src="<?= base_url() . 'asset/img/' . $pantalla['foto'] ?>" class="img-rounded" alt="img_pantalla">
        <b><p style="color:orange;"><?php echo $pantalla['localidad'] ?><br>
                <?php echo $pantalla['direccion'] ?></p></b>
        <div class="dropdown">
            <button class="btn btn-default dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">
                <img src="<?=base_url()."/asset/img/acciones.png"?>"/>&nbsp;Acciones
                <span class="caret"></span></button>
            <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                <li role="presentation">
                    <a href="<?= site_url("Cont_spot/VerSpotDePant/{$pantalla['idpantalla']}")?>">
                        <img src="<?=base_url()."/asset/img/spot.png"?>"/>&nbsp;Ver spots</a>   
                    </li>
                    
                <li role="presentation">
                    <a href="<?= site_url("Cont_spot/BorraPantallaSeg/{$pantalla['idpantalla']}")?>">
                        <img src="<?=base_url()."/asset/img/borrarpant.png"?>"/>&nbsp;Borrar pantalla</a> 
                </li>
            </ul>
        </div><br>
    </div>
    
<?php endforeach; ?>
