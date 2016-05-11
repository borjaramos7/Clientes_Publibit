<table style="text-align: center;" class="table table-hover">
            <tr class="info">
                <td >
                    <img src="<?=base_url().'asset/'?>img/negocios.png"><br>Nombre empresa
                </td>
                <td>
                    <img src="<?=base_url().'asset/'?>img/telefono.png"><br>Nº Contacto
                </td>
                <td>
                    <img src="<?=base_url().'asset/'?>img/interfaz.png"><br>Email
                </td>
                <td>
                    <img src="<?=base_url().'asset/'?>img/tecnologia.png"><br>CIF
                </td>
                <td>
                    <img src="<?=base_url().'asset/'?>img/negocios-1.png"><br>
                        <?php echo anchor("Cont_empresa/VerEmpresa/".'pendientes',"Ordenes <br> Pendientes");?>
                </td>
            </tr>
        <?php foreach ($listacli as $cliente) :?>
            <tr class="warning">
                <td><?= $cliente['nomempresa'] ?></td>
                <td><?= $cliente['numcontacto'] ?></td>
                <td><?= $cliente['emailcontacto'] ?></td>
                <td><?= $cliente['cif'] ?></td>
                <td><?= $this->Model_emp->NumPendientes($cliente['idcliente'])?></td>
                <td>
                    <a class="btn btn-warning"<?php echo anchor("Cont_empresa/VerEmpresaComp/{$cliente['idcliente']}","Ver empresa");?>
                    </a>
                </td>
            </tr>   
    <?php endforeach; ?>
    </table>
<div style="text-align: center" class="paginacion"><?php echo @$paginacion ?></div>
                    

        

