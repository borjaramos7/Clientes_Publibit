<?php if (isset($idemp)): ?>
    <?php if ($this->Model_spot->NumSpots($idemp) == 0) : ?>
    <p><b>Aun no existen spots asociados a esta empresa.</b></p>
    <?php endif; ?>
<?php endif; ?>

<?php foreach ($spots as $spot) :?>
        <div class="col-md-6 col-lg-4 col-sm-12">
                <h2><u>Spot nÂº: <?= $spot['idspot']?></u></h2>
            <b>Cliente <p style="color:orange;"><?= $this->Model_emp->SacaNombreCliente($spot['_idcliente'])?></p>
            Meses contratados <p style="color:orange;"><?= $spot['mesescont'] ?></p>
            Mes gratis <p style="color:orange;"><?= $spot['mes_gratis'] ?></p>
            Repeticiones por mes <p style="color:orange;"><?= $spot['repxmes'] ?></p></b>
           
           <div style="text-align:center">
                    <a href="<?= site_url("Cont_spot/VerSpotComp/{$spot['idspot']}")?>" 
                                   class="btn-info list-group-item" title="Ver spot detalle">
                        <b>Ver spot detalle</b>&nbsp;&nbsp;&nbsp;&nbsp;
                        <img src="<?=base_url()."/asset/img/icon.png"?>"/></a>
            </div>
        </div>
<?php endforeach; ?>