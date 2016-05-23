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
    <span class="help-block"><?php foreach($this->Model_spot->PantallasDeSpot($spot['idspot']) as $pantalla)
        echo $pantalla['localidad']." - ".$pantalla['direccion']."<br>";
        ?></span>
    
<legend>Acciones</legend>
    <div class="col-md-3" style="text-align:center">
        <a  class="btn-warning list-group-item" 
            <?php echo anchor("Cont_spot/ModificaSpot/{$spot['idspot']}", "Modificar Spot"); ?></a>
    </div>
    <div class="col-md-3" style="text-align:center">
        <a  class="btn-warning list-group-item" 
            <?php echo anchor("Cont_spot/AsociarConPant/{$spot['idspot']}", "Asociar a pantalla"); ?></a>
    </div>
</fieldset>