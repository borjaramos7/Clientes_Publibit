<fieldset>
    <legend>Nª Contacto</legend>
    <span class="help-block"><?= $datosemp['numcontacto'] ?></span>
    <legend>Email</legend>
    <span class="help-block"><?= $datosemp['emailcontacto'] ?></span>
    <legend>CIF</legend>
    <span class="help-block"><?= $datosemp['cif'] ?></span>
    <legend>Ordenes pendientes</legend>
    <span class="help-block"><?= $this->Model_emp->NumPendientes($datosemp['idcliente'])?></span>
    <legend>Acciones</legend>
    <div class="col-md-3" style="text-align:center">
        <a  class="btn-warning list-group-item" 
            <?php echo anchor("Cont_empresa/AddTrabajo/{$datosemp['idcliente']}", "Añadir trabajo"); ?></a>
    </div>
    <div class="col-md-3" style="text-align:center">
        <a  class="btn-warning list-group-item" 
            <?php echo anchor("Cont_spot/NuevoSpot/{$datosemp['idcliente']}", "Añadir spot"); ?></a>
    </div>
    <br><br><br>
    <div class="col-md-3" style="text-align:center">
        <a  class="btn-warning list-group-item" 
            <?php echo anchor("Cont_empresa/VerTrabajos/{$datosemp['idcliente']}", "Ver trabajos"); ?></a>
    </div>
    <div class="col-md-3" style="text-align:center">
        <a  class="btn-warning list-group-item" 
            <?php echo anchor("Cont_spot/VerSpots/{$datosemp['idcliente']}", "Ver spots"); ?></a>
    </div>
    <div class="col-md-3" style="text-align:center">
        <a  class="btn-warning list-group-item" 
            <?php echo anchor("Cont_empresa/ShowModEmpresa/{$datosemp['idcliente']}", "Modificar datos"); ?></a>
    </div>
</fieldset>

