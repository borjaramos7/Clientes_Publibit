<div id="envoltura">
        <div id="contenedor">
            <?php if (validation_errors() != "") : ?>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" width="10%" class="close" data-dismiss="alert">&times;</button>
                    <strong><?= validation_errors(); ?></strong>
                </div>
            <?php endif; ?>
            <div id="cuerpo">
                <form style="border:solid 3px orange; margin-right: 60%; margin-left: 2px" action="../AddSpotxPant" method="post" >
                    
                    <div style="margin-left:30px; padding:3px,3px,3px,3px;">
                        <input type="hidden" id="idspot" name="idspot" value="<?= $idspot ;?>">
                        <label for="pant">Pantalla:</label>
                        <select class="form-control" name="pant">
                            <?php foreach ($pantallas as $pantalla) :?>
                                <option value="<?php echo $pantalla['idpantalla'];?>">
                                    <?php echo $pantalla['localidad'];?>&nbsp;-&nbsp;<?php echo $pantalla['direccion'];?>
                                </option>
                            <?php endforeach; ?>
                          </select>
                    
                    <label for="fecha">Fecha inicio:</label>
                    <input name="fechai" type="date" id="fechai" class="list-group-item" 
                               value="<?php echo set_value('fecha');?>"><br>
                    
                    <label for="fecha">Fecha fin:</label>
                    <input name="fechaf" type="date" id="fechaf" class="list-group-item" 
                               value="<?php echo set_value('fechaf');?>"><br>

                    <p id="bot"><input name="submit" type="submit" id="boton" value="Registrar" class="list-group-item"/></p>
                 </div>
                </form>
           
        </div>
        </div>
    </div>
