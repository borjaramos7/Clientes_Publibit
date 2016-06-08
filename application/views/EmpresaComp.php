<fieldset>
    <legend>Nº Contacto</legend>
    <span class="help-block"><?= $datosemp['numcontacto'] ?></span>
    <legend>Email</legend>
    <span class="help-block"><?= $datosemp['emailcontacto'] ?></span>
    <legend>CIF</legend>
    <span class="help-block"><?= $datosemp['cif'] ?></span>
    <legend>Ordenes pendientes</legend>
    <span class="help-block"><?= $this->Model_emp->NumPendientes($datosemp['idcliente'])?></span>
    <legend>Acciones</legend>
    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12" style="text-align:center">
        <a href="<?= site_url("Cont_empresa/AddTrabajo/{$datosemp['idcliente']}")?>" 
                           class="btn-warning list-group-item" title="Crear trabajo">
            <img src="<?=base_url()."/asset/img/nuevoarchivo.png"?>"/>&nbsp;Crear trabajo</a>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12" style="text-align:center">
        <a href="<?= site_url("Cont_spot/NuevoSpot/{$datosemp['idcliente']}")?>" 
                           class="btn-warning list-group-item" title="Crear spot">
            <img src="<?=base_url()."/asset/img/nuevospot.png"?>"/>&nbsp;Crear Spot</a>
    </div>
    
    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12" style="text-align:center">
            <a href="<?= site_url("Cont_empresa/ModificaEmpresa/{$datosemp['idcliente']}")?>" 
                           class="btn-warning list-group-item" title="Modificar datos">
            <img src="<?=base_url()."/asset/img/edit.png"?>"/>&nbsp;Modificar datos</a>
    </div>
    
    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12" style="text-align:center">
            <a href="<?= site_url("Cont_empresa/VerTrabajos/{$datosemp['idcliente']}")?>" 
                           class="btn-warning list-group-item" title="Ver trabajos">
            <img src="<?=base_url()."/asset/img/listar.png"?>"/>&nbsp;Ver trabajos</a>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12" style="text-align:center">
            <a href="<?= site_url("Cont_spot/VerSpots/{$datosemp['idcliente']}")?>" 
                           class="btn-warning list-group-item" title="Ver spots">
            <img src="<?=base_url()."/asset/img/listar.png"?>"/>&nbsp;Ver spots</a>
    </div>
    
    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12" style="text-align:center">
        <button style="text-align:center" data-toggle="modal" data-target="#modal_emp_<?= $datosemp['idcliente'];?>"
                class="btn-danger list-group-item" id="borrar">
            <img src="<?=base_url()."/asset/img/borrar.png"?>"/>Eliminar cliente</button>
    </div>
    
</fieldset>

<div class="modal fade" id="modal_emp_<?= $datosemp['idcliente'];?>" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button><br>
                    <h4 class="modal-title">Â¿Estas seguro de borrar esta empresa?<br><br>Se borraran recursivamente todos los datos
                    asociados a esta empresa(ordenes y spots asi como sus asociaciones).</h4>
                </div>

                <div class="modal-footer">
                    <button id="descarga" class="btn btn-danger" data-toggle="modal" data-target="#modal_descarga"
                            data-dismiss="modal" style="color: white">Si,estoy seguro.</button>
                    <button type="button" class="btn btn-info" data-dismiss="modal" style="color: white">No,mejor no.</button>
                </div>
            </div>
        </div>
    </div>

<div class="modal fade" id="modal_descarga" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    
                    <h4 class="modal-title">Se ha procedido a la descarga de archivos predecesora del borrado</h4>
                </div>

                <div class="modal-footer">
                    <button id="BorraEmp" class="btn btn-info" data-dismiss="modal" style="color: white">Aceptar</button>
                </div>
            </div>
        </div>
    </div> 

<script language="javascript">
    $("#descarga").click(function() {
    <?php $listatraba = $this->Model_emp->TrabajosXEmp($datosemp['idcliente']);
    foreach ($listatraba as $trabajo):?>
            window.open("<?= site_url('Cont_empresa/ExportaOrden/' . $trabajo['idtrabajo']) ?>","_blank");
        <?php if ($this->Model_emp->Numarchivosxorden($trabajo['idtrabajo']) > 0) : ?>
            window.open("<?= site_url('Cont_empresa/CreaZip/' . $trabajo['idtrabajo']) ?>","_blank");
        <?php endif; ?>
    <?php endforeach; ?>
        });
    
  $("#BorraEmp").click(function() {
    location.href="<?= site_url('Cont_empresa/BorraEmpresa/' . $datosemp['idcliente']) ?>";
  });  
</script>
