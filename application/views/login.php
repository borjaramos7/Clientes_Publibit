<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta charset="utf-8">
    <link type="text/css" href="./../css/style.css" rel="stylesheet" />
</head>
 
<body>
    <?php if ($error!="") :?>
    <div class="alert alert-danger alert-dismissable">
        <button type="button" width="10%" class="close" data-dismiss="alert">&times;</button>
        <strong><?=$error?></strong>
    </div>
    <?php endif; ?>
<form style="border:solid 3px grey;background-color:black; margin-right:65%; padding-top: 10px; opacity: 0.8;"
      action="VerificaLogin" method="post">
                <div style="margin-left:20px; padding:3px,3px,3px,3px;">
                    
                    <!--label for="user">Nombre de usuario:</label-->
                    <input name="user" type="text" id="user" class="list-group-item" placeholder="Nombre de usuario"><br>
                    
                    <!--p><label for="cont">Contraseña:</label></p-->
                    <input name="cont" type="password" id="cont" class="list-group-item" placeholder="Contraseña"/><br>
                <p id="bot">
                    <input name="submit" type="submit" id="boton" value="Aceptar" class="list-group-item warning"/></p><br>
                 </div>
    <b><p style="color:white;">Registro de <a <?php echo anchor("Cont_user/Registro"," nuevos empleados");?></a></b>
                    
</form>
</body>
</html>