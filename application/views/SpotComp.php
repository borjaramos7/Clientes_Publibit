<fieldset>
    <legend>Cliente</legend>
    <span class="help-block"><?= $this->Model_emp->SacaNombreCliente($spot['_idcliente']) ?></span>
    <legend>Meses contratados</legend>
    <span class="help-block"><?= $spot['mesescont'] ?></span>
    <legend>Mes gratis</legend>
    <span class="help-block"><?= $spot['mes_gratis'] ?></span>
    <legend>Numero de repeticiones al mes</legend>
    <span class="help-block"><?= $spot['repxmes'] ?></span>
    <legend>Precio</legend>
    <span class="help-block"><?= $spot['precio'] ?>€</span>
    <legend>Pantalla(s)</legend>
    <span class="help-block">
        <?php foreach ($this->Model_spot->PantallasDeSpot($spot['idspot']) as $pantalla) :?>
                            <a href="" class="btn btn-info" data-toggle="modal" data-target="#modal_fechas_<?= $pantalla['idpantalla'];?>">
                                <?php echo $pantalla['localidad'] . " - " . $pantalla['direccion'];?></a><br>                               
    </span>

    <div class="modal fade" id="modal_fechas_<?= $pantalla['idpantalla'];?>" role="dialog">
        <?php $asociacion=$this->Model_spot->Asociacion($spot['idspot'],$pantalla['idpantalla']);?>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button><br>
                    <h4 class="modal-title">Fechas de spot <?=$spot['idspot']?> <br> 
                        <?php echo $pantalla['localidad'] . " - " . $pantalla['direccion'];?></h4>
                </div>
                <div class="modal-body">
                    <br>
                    <p><b>Fecha inicio: <?php echo $asociacion['fechainicio'] ?></b></p>
                    <p><b>Fecha fin: <?php echo $asociacion['fechafin'] ?></b></p>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>   
    <?php endforeach; ?>
    
    
    
    
<legend>Acciones</legend>
    <div class="col-md-3" style="text-align:left">
        <a href="<?= site_url("Cont_spot/ModificaSpot/{$spot['idspot']}") ?>" 
           class="btn-warning list-group-item" title="Modificar Spot">
            <img src="<?= base_url() . "/asset/img/edit.png" ?>"/>&nbsp;Modificar spot</a>
    </div>

    <div class="col-md-3" style="text-align:left;font-size: 12.5px">
        <a href="<?= site_url("Cont_spot/AsociarConPant/{$spot['idspot']}") ?>" 
           class="btn-warning list-group-item" title="Asociar a pantalla">
            <img src="<?= base_url() . "/asset/img/pantalla.png" ?>"/>&nbsp;Asociar a pantalla</a>
    </div>

    <div class="col-md-3" style="text-align:left">
        <a href="<?= site_url("Cont_spot/BorrarSpot/{$spot['idspot']}") ?>" 
           class="btn-warning list-group-item" title="Borrar Spot">
            <img src="<?= base_url() . "/asset/img/borrarpant.png" ?>"/>&nbsp;Borrar Spot</a>
    </div>
</fieldset>