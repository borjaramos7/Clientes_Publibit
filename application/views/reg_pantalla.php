<div id="envoltura">
        <div id="contenedor">
            <?php if (validation_errors() != "") : ?>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" width="10%" class="close" data-dismiss="alert">&times;</button>
                    <strong><?= validation_errors(); ?></strong>
                </div>
            <?php endif; ?>
            <div id="cuerpo">
                <form style="border:solid 3px orange; margin-right: 60%; margin-left: 2px" action="" method="post" >
                    
                    <div style="margin-left:30px; padding:3px,3px,3px,3px;">
                        
                        <label for="provincia">Provincia:</label>
                        <select class="form-control" name="provincia">
                            <?php foreach ($provincias as $provincia) :?>
                                <option value="<?php echo $provincia['cod'];?>">
                                    <?php echo $provincia['nombre'];?>
                                </option>
                            <?php endforeach; ?>
                          </select>
                    
                    <label for="localidad">Localidad:</label>
                    <input name="localidad" type="text" id="localidad" class="list-group-item" 
                               value="<?php echo set_value('localidad');?>"><br>
                    
                    <label for="direccion">Direccion:</label>
                        <input name="direccion" type="text" id="direccion" class="list-group-item"
                               accept="" value="<?php echo set_value('direccion');?>" ><br>

                    <p id="bot"><input name="submit" type="submit" id="boton" value="Registrar" class="list-group-item"/></p>
                 </div>
                </form>
           
        </div>
      </div>          
    </div>

