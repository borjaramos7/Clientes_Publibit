<!-- Vista para modificar usuarios -->
<html>  
<head>
    <title></title>
    <meta charset="utf-8">
    <link type="text/css" href="./../css/style.css" rel="stylesheet" />
</head>
 
<body>
    <?php foreach ($usuarios as $user) : ?>
    <div id="envoltura">
        <div id="contenedor">
        
            <div id="lead">
                <!--Datos de <?= $user->nombreus ;?>-->
            </div>
            <?php if (validation_errors() != "") : ?>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" width="10%" class="close" data-dismiss="alert">&times;</button>
                    <strong><?= validation_errors(); ?></strong>
                </div>
            <?php endif; ?>
            <div id="cuerpo">
 
                <form style="border:solid 3px orange; margin-right: 65%; margin-left: 2%" action="VerificaDatosUsuarioMod" method="post" >
                <div style="margin-left:5%; padding:2% 2% 2% 2%;">
                      
                    <label for="nombre">Nombre:</label>
                    <input name="nombre" type="text" id="nombre" class="list-group-item" 
                           value="<?= $user->nombre;?>">
                    
                    <label for="apellidos">Apellidos:</label>
                        <input name="apellidos" type="text" id="apellidos" class="list-group-item"
                              value="<?= $user->apellidos;?>" >
                
                    <label for="correo">Correo:</label>
                        <input name="correo" type="text" id="correo" class="list-group-item" 
                               value="<?= $user->correo;?>">
                        
                    <p id="bot"><input name="submit" type="submit" id="boton" value="Guardar cambios" class="list-group-item"/></p>
                 </div>
                </form>
                <br>
                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12" style="text-align:center">
                    <button style="text-align:center" data-toggle="modal" data-target="#modal_cont"
                            accesskey="" class="btn-info list-group-item" id="cambiar">
                        <img src="<?=base_url()."/asset/img/contrasena.png"?>"/>Cambiar contraseña</button>
                </div>
        </div>
            
    </div>
   </div>    
    
    <div class="modal fade" id="modal_cont" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button><br>
                        <h4 class="modal-title"></h4>
                    </div>
                    <div class="modal-body">
                        <form action="CambiarContrasena" method="post" >
                            <label for="contvieja">Contraseña anterior:</label>
                            <input name="contvieja" type="password" id="contvieja" class="list-group-item"/> 
                            <label for="pass">Nuevo Password:</label>
                            <input name="pass" type="password" id="pass" class="list-group-item" placeholder="Pon tu contraseña"/>
                            <label for="repass">Repetir nuevo Password:</label>
                            <input name="repass" type="password" id="repass" class="list-group-item" placeholder="Repite contraseña">
                            <br><br>
                            <input type="submit" class="btn btn-info" style="color: white" value="Realizar cambio">      
                        </form>    
                           <br>
                           <input type="button" class="btn btn-warning" data-dismiss="modal" style="color: white" value="Cancelar">
                    </div>
                            <div class="modal-footer">

                                
                            </div>
                    </div>
                </div>
            </div>
    
   <?php endforeach; ?>
</body>
 
</html>
