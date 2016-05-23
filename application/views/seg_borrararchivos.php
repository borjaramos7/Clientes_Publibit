<div class="col-md-4" style="text-align:center">
    <a class="btn-warning list-group-item" <?php echo anchor("Cont_empresa/BorraArchivosOrden/{$idorden}","Si,borrar."); ?></a>
</div>
<div class="col-md-4" style="text-align:center">
    <a class="btn-warning list-group-item" 
        <?php echo anchor("Cont_empresa/VerOrdenComp/{$idorden}", "No,mejor no borrarlos."); ?></a>
</div>

