<div id="envoltura">
        <div id="contenedor">
            <div style="border:solid 3px orange; margin-right: 170px; margin-left: 2px"><b>
            <?php echo validation_errors(); ?></b></div>
            <div id="cuerpo">
                <form style="border:solid 3px orange; margin-right: 170px; margin-left: 2px" action="../ModificaOrden" method="post" >
                    <input type="hidden" id="idemp" name="idemp" value="<?= $idemp ;?>">
                    <input type="hidden" id="idorden" name="idorden" value="<?= $orden['idtrabajo'] ;?>">
                    <div style="margin-left:30px; padding:3px,3px,3px,3px;">
                    <label for="denom">Denominacion trabajo</label>
                        <input name="denom" type="text" id="denom" class="list-group-item"
                               accept="" value="<?= $orden['denominacion'];?>" ><br>
                        <label for="descrip">Descripcion trabajo</label>
                        <textarea id="descrip" name="descrip" class="form-control" rows="9" cols="12"><?php echo ltrim($orden['descripcion']);?>
                        </textarea><br>
                                 
                     <!--label>Fecha inicio : </label><?php echo $orden['fecha_inicio'];?><br-->
                    <label for="fecha">Modificar fecha inicio:</label>
                    <input name="fecha" type="date" id="fecha" class="list-group-item" 
                               value="<?= $orden['fecha_inicio'];?>"><br>

                    <p id="bot"><input name="submit" type="submit" id="boton" value="Guardar cambios" class="list-group-item"/></p>
                 </div>
                </form>
           
        </div>
 
    </div>
