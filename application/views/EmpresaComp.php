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
    <div class="col-md-3" style="text-align:left">
        <a href="<?= site_url("Cont_empresa/AddTrabajo/{$datosemp['idcliente']}")?>" 
                           class="btn-warning list-group-item" title="Añadir trabajo">
            <img src="<?=base_url()."/asset/img/nuevoarchivo.png"?>"/>&nbsp;Añadir trabajo</a>
    </div>
    <div class="col-md-3" style="text-align:left">
        <a href="<?= site_url("Cont_spot/NuevoSpot/{$datosemp['idcliente']}")?>" 
                           class="btn-warning list-group-item" title="Añadir spot">
            <img src="<?=base_url()."/asset/img/nuevospot.png"?>"/>&nbsp;Añadir Spot</a>
    </div>
    <br><br><br>
    <div class="col-md-3" style="text-align:left">
            <a href="<?= site_url("Cont_empresa/VerTrabajos/{$datosemp['idcliente']}")?>" 
                           class="btn-warning list-group-item" title="Ver trabajos">
            <img src="<?=base_url()."/asset/img/listar.png"?>"/>&nbsp;Ver trabajos</a>
    </div>
    <div class="col-md-3" style="text-align:left">
            <a href="<?= site_url("Cont_spot/VerSpots/{$datosemp['idcliente']}")?>" 
                           class="btn-warning list-group-item" title="Ver spots">
            <img src="<?=base_url()."/asset/img/listar.png"?>"/>&nbsp;Ver spots</a>
    </div>
    <div class="col-md-3" style="text-align:left">
            <a href="<?= site_url("Cont_empresa/ModificaEmpresa/{$datosemp['idcliente']}")?>" 
                           class="btn-warning list-group-item" title="Modificar datos">
            <img src="<?=base_url()."/asset/img/edit.png"?>"/>&nbsp;Modificar datos</a>
    </div>
</fieldset>

