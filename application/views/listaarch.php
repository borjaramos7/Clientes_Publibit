<b>
<div class="list-group" >
    <?php foreach ($archivos as $archivo) :?>
    <?php  $nomarchivo=$archivo['nomarchivo'] ?>
    <a 
                <?php echo anchor(base_url()."archivos/$nomarchivo",$nomarchivo); ?></a><br>
    <?php endforeach; ?>
</div>