<!-- Vista del registro de un usuario -->
<!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta charset="utf-8">
    <link type="text/css" href="./../css/style.css" rel="stylesheet" />
</head>
<body>
    <div id="envoltura">
        <div id="contenedor">
            <?php if (validation_errors() != "") : ?>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" width="10%" class="close" data-dismiss="alert">&times;</button>
                    <strong><?= validation_errors(); ?></strong>
                </div>
            <?php endif; ?>
            <div id="cuerpo">
 
                <form style="border:solid 2px orange; margin-right: 60%; margin-left: 2px" action="VerificaDatosUsuario" method="post" >
                <div style="margin-left:30px; padding:3px,3px,3px,3px;">
                    <label for="nombreuser">Nombre de usuario:</label>
                        <input name="nombreuser" type="text" id="nombreuser" class="list-group-item"
                               accept="" value="<?php echo set_value('nombreuser');?>" >
                    
                    <label for="nombre">Nombre:</label>
                    <input name="nombre" type="text" id="nombre" class="list-group-item" 
                           value="<?php echo set_value('nombre');?>">
                    
                    
                    <label for="apellidos">Apellidos:</label>
                        <input name="apellidos" type="text" id="apellidos" class="list-group-item"
                              value="<?php echo set_value('apellidos');?>" >
                    
                
                    <label for="correo">Correo:</label>
                        <input name="correo" type="text" id="correo" class="list-group-item" 
                               value="<?php echo set_value('correo');?>">
                        
                    <label for="pass">Clave de registro:</label></p>
                        <input name="clave" type="password" id="clave" class="list-group-item" placeholder="Introduce la clave publibit para registro">
                    
                    <p><label for="pass">Password:</label></p>
                        <input name="pass" type="password" id="pass" class="list-group-item" placeholder="Introduce tu contraseña"></p>
 
                    <p><label for="repass">Repetir Password:</label></p>
                        <input name="repass" type="password" id="repass" class="list-group-item" placeholder="Repite contraseña"></p>
 
                    <p id="bot"><input name="submit" type="submit" id="boton" value="Registrar" class="list-group-item"/></p>
                 </div>
                </form>
           
        </div>
 
    </div>
    </div>
 
</body>
 
</html>