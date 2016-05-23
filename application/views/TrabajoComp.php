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
    <div class="col-md-4" style="text-align:center">
        <a  class="btn-warning list-group-item" 
            <?php echo anchor("Cont_empresa/importar/{$orden['idtrabajo']}", "Adjuntar archivo"); ?></a>
    </div>
    <div class="col-md-4" style="text-align:center">
         <a  class="btn-warning list-group-item" 
            <?php echo anchor("Cont_empresa/ListaArchivos/{$orden['idtrabajo']}", "Ver archivos"); ?></a>
    </div>
    <div class="col-md-4" style="text-align:center">
        <button onclick="MultiplesTareas()" id="borrar">Borrar orden</button>
         <!--a id="borrar" class="btn-warning list-group-item" 
            <?php echo anchor("Cont_empresa/BorrarArchConSeg/{$orden['idtrabajo']}", "Borrar Orden"); ?></a-->
    </div>
        <?php if ($orden['estado'] == 'pendiente') : ?>
            <div class="col-md-4" style="text-align:center">
                <a  class="btn-warning list-group-item" 
                    <?php echo anchor("Cont_empresa/FinalizaOrden/{$orden['idtrabajo']}", "Orden finalizada"); ?></a>
            </div>
            <div class="col-md-4" style="text-align:center">
                <a  class="btn-warning list-group-item" 
                    <?php echo anchor("Cont_empresa/ShowModificaOrden/{$orden['idtrabajo']}", "Modificar orden"); ?></a>
            </div>
         <?php endif; ?>
</fieldset>

