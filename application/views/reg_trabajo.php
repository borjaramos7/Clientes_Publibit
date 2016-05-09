 <div id="envoltura">
        <div id="contenedor">
            <?php if (validation_errors() != "") : ?>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" width="10%" class="close" data-dismiss="alert">&times;</button>
                    <strong><?= validation_errors(); ?></strong>
                </div>
            <?php endif; ?>
            <div id="cuerpo">
 
                <form style="border:solid 3px orange; margin-right: 170px; margin-left: 2px" action="../AddOrden" method="post" >
                    <input type="hidden" id="idemp" name="idemp" value="<?= $idemp ;?>">
                    <div style="margin-left:30px; padding:3px,3px,3px,3px;">
                    <label for="denom">Denominacion trabajo</label>
                        <input name="denom" type="text" id="denom" class="list-group-item"
                               accept="" value="<?php echo set_value('denom');?>" ><br>
                        
                        <label for="descrip">Descripcion trabajo</label>
                        <textarea id="descrip" name="descrip" class="form-control" rows="9" cols="12">
                            <?php echo set_value('descrip');?>
                        </textarea><br>
                        
                    <label for="pendiente">Estado del trabajo</label><br>
                     <div class="radio">
                          <input class="list-group-item" type="radio" name="estado" id="pendiente" value="pendiente" checked>
                          Pendiente
                      </div>
                        
                      <div class="radio">
                          <input class="list-group-item" type="radio" name="estado" id="finalizada" value="finalizada">
                          Finalizada
                      </div><br> 
                        
                    <!--label for="estado">Estado de la orden:</label>
                    <input name="estado" type="text" id="estado" class="list-group-item" 
                           value="<?php echo set_value('estado');?>"-->
                    
                    <label for="fecha">Fecha inicio:</label>
                    <input name="fecha" type="date" id="fecha" class="list-group-item" 
                               value="<?php echo set_value('fecha');?>"><br>

                    <p id="bot"><input name="submit" type="submit" id="boton" value="Registrar" class="list-group-item"/></p>
                 </div>
                </form>
           
        </div>
    </div>
