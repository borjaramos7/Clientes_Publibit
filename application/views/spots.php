<?php if (isset($idemp)): ?>
    <?php if ($this->Model_spot->NumSpots($idemp) == 0) : ?>
    <p><b>Aun no existen spots asociados a esta empresa.</b></p>
    <?php endif; ?>
<?php endif; ?>

<?php foreach ($spots as $spot) :?>
        <div>
            <h1><u>Spot nº: <?= $spot['idspot']?></u></h1>
        <b>Cliente <p style="color:orange;"><?= $this->Model_emp->SacaNombreCliente($spot['_idcliente'])?></p>
        Meses contratados <p style="color:orange;"><?= $spot['mesescont'] ?></p>
        Mes gratis <p style="color:orange;"><?= $spot['mes_gratis'] ?></p>
        Repeticiones por mes <p style="color:orange;"><?= $spot['repxmes'] ?></p></b>
        
       <div class="col-md-3" style="text-align:center">
        <a  class="btn list-group-item btn-info" 
        <?php echo anchor("Cont_spot/VerSpotComp/{$spot['idspot']}","Ver spot detalle");?></a></div>
        </div>
        <br><br>
<?php endforeach; ?>