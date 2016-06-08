<fieldset>
    <legend>Denominacion del trabajo</legend>
    <span class="help-block"><?= $orden['denominacion'] ?></span>
    <legend>Descripcion</legend>
    <span class="help-block"><pre><?= $orden['descripcion'] ?></pre></span>
    <legend>Escrito por</legend>
    <span class="help-block"><?= $orden['redactor'] ?></span>
    <legend>Cliente</legend>
    <span class="help-block"><?= $this->Model_emp->SacaNombreCliente($orden['_idcliente']) ?></span>
    <legend>Fecha inicio</legend>
    <span class="help-block"><?= $orden['fecha_inicio'] ?></span>
    <legend>Estado</legend>
    <span class="help-block"><?= $orden['estado'] ?></span>
    
    <input type="hidden" id="idorden" name="idorden" value="<?= $orden['idtrabajo'] ;?>">
    <legend>Acciones</legend>
        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12" style="text-align:center">
                <a href="<?= site_url("Cont_empresa/importar/{$orden['idtrabajo']}")?>" 
                               class="btn-warning list-group-item" title="Adjuntar archivo">
                <img src="<?=base_url()."/asset/img/addarchivo.png"?>"/>&nbsp;Adjuntar archivo</a>
        </div>
    
        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12" style="text-align:center">
                <a href="<?= site_url("Cont_empresa/ListaArchivos/{$orden['idtrabajo']}")?>" 
                               class="btn-warning list-group-item" title="Ver archivos">
                <img src="<?=base_url()."/asset/img/verarchivos2.png"?>"/>&nbsp;Ver archivos</a>
        </div>

        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12" style="text-align:center">
                <a href="<?= site_url("Cont_empresa/ExportaOrden/{$orden['idtrabajo']}")?>" 
                               class="btn-warning list-group-item" title="Exporta pdf">
                <img src="<?=base_url()."/asset/img/pdf.png"?>"/>&nbsp;Exportar en PDF</a>
        </div>

    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12" style="text-align:center">
        <button style="text-align:center" data-toggle="modal" data-target="#modal_seg"
                class="btn btn-danger list-group-item" id="borrar">
            <img src="<?=base_url()."/asset/img/borrar.png"?>"/>Borrar orden</button>
    </div>
        <?php if ($orden['estado'] == 'pendiente') : ?>
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12" style="text-align:center">
                <a href="<?= site_url("Cont_empresa/FinalizaOrden/{$orden['idtrabajo']}")?>" 
                               class="btn-warning list-group-item" title="Orden finalizada">
                <img src="<?=base_url()."/asset/img/ordenfinalizada.png"?>"/>&nbsp;Orden finalizada</a>
            </div>

            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12" style="text-align:center">
                <a href="<?= site_url("Cont_empresa/ShowModificaOrden/{$orden['idtrabajo']}")?>" 
                               class="btn-warning list-group-item" title="Modificar orden">
                <img src="<?=base_url()."/asset/img/edit.png"?>"/>&nbsp;Modificar orden</a>
            </div>
        <?php endif; ?>
</fieldset>

<div class="modal fade" id="modal_seg" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button><br>
                    <h4 class="modal-title">Descargados los archivos de esta orden.<br><br>
                Â¿Estas seguro de borrar dichos archivos ,asi como la propia orden del sistema?</h4>
                </div>

                <div class="modal-footer">
                    <button id="btnTareas" class="btn btn-danger" 
                            data-dismiss="modal" style="color: white">Si,estoy seguro.</button>
                    <button type="button" class="btn btn-info" data-dismiss="modal" style="color: white">No,mejor no.</button>
                </div>
            </div>
        </div>
    </div>

<script language="javascript">
  $("#btnTareas").click(function() {
      <?php if ($this->Model_emp->Numarchivosxorden($orden['idtrabajo']) > 0) : ?>
        window.open("<?=site_url('cont_empresa/CreaZip/'.$orden['idtrabajo'])?>","_blank");
     <?php endif;?>
      window.open("<?= site_url('Cont_empresa/ExportaOrden/' . $orden['idtrabajo']) ?>","_blank");
     location.href="<?=site_url('cont_empresa/BorrarOrden/'.$orden['idtrabajo'])?>";
  });  
</script>