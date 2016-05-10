<div id="envoltura">
        <div id="contenedor">
            <?php if (validation_errors() != "") : ?>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" width="10%" class="close" data-dismiss="alert">&times;</button>
                    <strong><?= validation_errors(); ?></strong>
                </div>
            <?php endif; ?>
        </div>
            <div id="cuerpo">
 
                <form style="border:solid 3px orange; margin-right: 420px; margin-left: 2px" 
                      action="<?php echo $action;?>" method="post" >
                <input type="hidden" id="idemp" name="idemp" value="<?= $datosemp['idcliente'] ;?>">
                <div style="margin-left:30px; padding:3px 3px 3px 3px;">
                    <label for="nombreemp">Nombre de empresa/cliente:</label>
                        <input name="nombreemp" type="text" id="nombreemp" class="list-group-item"
                               accept="" value="<?php echo $datosemp['nomempresa'];?>" >
                    
                    <label for="numcon">Numero de contacto:</label>
                    <input name="numcon" type="text" id="numcon" class="list-group-item" 
                           value="<?php echo $datosemp['numcontacto'];?>">
                                 
                    <label for="correo">Correo:</label>
                        <input name="correo" type="email" id="correo" class="list-group-item" 
                               value="<?php echo $datosemp['emailcontacto'];?>">
                        
                   <label for="cif">CIF:</label>
                        <input name="cif" type="text" id="cif" class="list-group-item"
                              value="<?php echo $datosemp['cif'];?>" >
                       
 
                    <p id="bot"><input name="submit" type="submit" id="boton" value="Guardar cambios" class="list-group-item"/></p>
                 </div>
                </form>
           
        </div>
 
    </div>
