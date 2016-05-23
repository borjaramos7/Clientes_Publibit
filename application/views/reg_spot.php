 <div id="envoltura">
        <div id="contenedor">
            <?php if (validation_errors() != "") : ?>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" width="10%" class="close" data-dismiss="alert">&times;</button>
                    <strong><?= validation_errors(); ?></strong>
                </div>
            <?php endif; ?>
            <div id="cuerpo">
                <form style="border:solid 3px orange; margin-right: 380px; margin-left: 2px" action="" method="post" >
                    <input type="hidden" id="idemp" name="idemp" value="<?= $idemp ;?>">
                    <div style="margin-left:30px; padding:3px,3px,3px,3px;">
                    <label for="meses">Meses Contratado: </label>
                        <input name="meses" type="number" id="meses" class="list-group-item"
                               accept="" value="<?php echo set_value('meses');?>" ><br>
                        
                        <label for="repet">Repeticiones por mes: </label>
                        <input type="text" id="repet" name="repet" class="list-group-item"
                         value="<?php echo set_value('repet');?>"><br>
                        
                        
                    <label for="gratis">Mes gratis: </label><br>
                     <div class="radio">
                          <input class="list-group-item" type="radio" name="gratis" id="gratis" value="si">
                          Si
                      </div>
                        
                      <div class="radio">
                          <input class="list-group-item" type="radio" name="gratis" id="gratis" value="no">
                          No
                      </div><br> 
                        
                    
                    <label for="precio">Precio:</label>
                    <input name="precio" type="text" id="precio" class="list-group-item" 
                               value="<?php echo set_value('precio');?>"><br>

                    <p id="bot"><input name="submit" type="submit" id="boton" value="Registrar" class="list-group-item"/></p>
                 </div>
                </form>
           
        </div>
 
    </div>

