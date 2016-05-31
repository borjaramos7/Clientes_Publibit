
<?php if (isset($idemp)): ?>
    <?php if ($this->Model_emp->NumTrabajos($idemp) == 0) : ?>
    <p><b>Aun no existen trabajos de esta empresa.</b></p>
    <?php endif; ?>
<?php endif; ?>

    <?php foreach ($trabajos as $trabajo) :?>
            <div class="col-md-6 col-lg-4 col-sm-12">
                    <h1><u>Orden nº: <?= $trabajo['idtrabajo']?></u></h1>
                <b>Cliente <p style="color:orange;"><?= $this->Model_emp->SacaNombreCliente($trabajo['_idcliente'])?></p>
                Denominación <p style="color:orange;"><?= $trabajo['denominacion'] ?></p>
                Fecha inicio <p style="color:orange;"><?= $trabajo['fecha_inicio'] ?></p>
                Escrita por <p style="color:orange;"><?= $trabajo['redactor'] ?></p>
                Estado <p style="color:orange;"><?= $trabajo['estado'] ?></p></b>
                <!--Descripción: <?= $trabajo['descripcion'] ?><br-->

               <div style="text-align:left">
                    <a href="<?= site_url("Cont_empresa/VerOrdenComp/{$trabajo['idtrabajo']}")?>" 
                                   class="btn-info list-group-item" title="Ver order detalle">
                        <b>Ver orden en detalle</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <img src="<?=base_url()."/asset/img/icon.png"?>"/></a>
                </div>
            </div>
    <?php endforeach; ?>
