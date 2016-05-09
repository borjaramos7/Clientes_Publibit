<!-- Vista para modificar usuarios -->
<html>  
<head>
    <title>Formulario</title>
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
            <div style='color:orangered; border:2px solid orange;'><b>
            <?php echo validation_errors(); ?></b></div>
            <div id="cuerpo">
 
                <form style="border:solid 2px orange; " action="VerificaDatosUsuarioMod" method="post" >
                <div style="margin-left:30px; padding:3px,3px,3px,3px;">
                      
                    <label for="nombre">Nombre:</label>
                    <input name="nombre" type="text" id="nombre" class="list-group-item" 
                           value="<?= $user->nombre;?>">
                    
                    <label for="apellidos">Apellidos:</label>
                        <input name="apellidos" type="text" id="apellidos" class="list-group-item"
                              value="<?= $user->apellidos;?>" >
                
                    <label for="correo">Correo:</label>
                        <input name="correo" type="text" id="correo" class="list-group-item" 
                               value="<?= $user->correo;?>">
                        
                    <!--p><label for="pass">Nuevo Password:</label></p>
                        <input name="pass" type="password" id="pass" class="list-group-item" placeholder="Pon tu contraseña"></p>
 
                    <p><label for="repass">Repetir nuevo Password:</label></p>
                        <input name="repass" type="password" id="repass" class="list-group-item" placeholder="Repite contraseña"></p-->
 
                    <p id="bot"><input name="submit" type="submit" id="boton" value="Guardar cambios" class="list-group-item"/></p>
                 </div>
                </form>
           
        </div>
            
    </div>
   <?php endforeach; ?>
</body>
 
</html>
