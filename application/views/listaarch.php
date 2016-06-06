<b>
    
        <?php if ($this->Model_emp->Numarchivosxorden($idorden) == 0) : ?>
        <p><b>Este trabajo no tiene archivos.</b></p>
    <?php endif; ?>

<div class="list-group" >
    <?php foreach ($archivos as $archivo) :?>
    <?php  $nomarchivo=$archivo['nomarchivo'] ?>
    <a 
                <?php echo anchor(base_url()."archivos/$nomarchivo",$nomarchivo); ?></a><br>
    <?php endforeach; ?>
</div>
</b>