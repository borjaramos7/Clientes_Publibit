<!-- Vista para subir ficheros ya sean xml o excel -->
<form enctype="multipart/form-data" action="../subirarchivo" method="POST">
<input type="hidden" id="idorden" name="idorden" value="<?= $idorden ;?>">
<input name="uploadedfile" type="file" />
<br>
<input class="btn btn-info" type="submit" value="Subir archivo" />
</form>
    </body>
</html>