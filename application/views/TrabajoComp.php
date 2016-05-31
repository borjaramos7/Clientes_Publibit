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
        <div class="col-md-3" style="text-align:left; font-size:13.5px">
                <a href="<?= site_url("Cont_empresa/importar/{$orden['idtrabajo']}")?>" 
                               class="btn-warning list-group-item" title="Adjuntar archivo">
                <img src="<?=base_url()."/asset/img/addarchivo.png"?>"/>&nbsp;Adjuntar archivo</a>
        </div>
    
        <div class="col-md-3" style="text-align:left;">
                <a href="<?= site_url("Cont_empresa/ListaArchivos/{$orden['idtrabajo']}")?>" 
                               class="btn-warning list-group-item" title="Ver archivos">
                <img src="<?=base_url()."/asset/img/verarchivos2.png"?>"/>&nbsp;Ver archivos</a>
        </div>

    <div class="col-md-3" style="text-align:left">
        <button id="btnTareas" style="text-align:left" 
                class="btn btn-danger list-group-item" id="borrar">
            <img src="<?=base_url()."/asset/img/borrar.png"?>"/>Borrar orden</button>
    </div>
        <?php if ($orden['estado'] == 'pendiente') : ?>
            <div class="col-md-3" style="text-align:left;font-size: 13.5px">
                <a href="<?= site_url("Cont_empresa/FinalizaOrden/{$orden['idtrabajo']}")?>" 
                               class="btn-warning list-group-item" title="Orden finalizada">
                <img src="<?=base_url()."/asset/img/ordenfinalizada.png"?>"/>&nbsp;Orden finalizada</a>
            </div>
            <br><br><br>
            <div class="col-md-3" style="text-align:left">
                <a href="<?= site_url("Cont_empresa/ShowModificaOrden/{$orden['idtrabajo']}")?>" 
                               class="btn-warning list-group-item" title="Modificar orden">
                <img src="<?=base_url()."/asset/img/edit.png"?>"/>&nbsp;Modificar orden</a>
            </div>
         <?php endif; ?>
</fieldset>

<script language="javascript">
  $("#btnTareas").click(function() {
      <?php if ($this->Model_emp->Numarchivosxorden($orden['idtrabajo']) > 0) : ?>
        window.open("<?=site_url('cont_empresa/CreaZip/'.$orden['idtrabajo'])?>");
     <?php endif;?>
     location.href="<?=site_url('cont_empresa/BorrarArchConSeg/'.$orden['idtrabajo'])?>";
     
  });  
</script>