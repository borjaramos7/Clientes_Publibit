<table id="myTable" style="text-align: center;" class="table table-hover">
            <tr class="success">
                <td>
                    Cliente
                </td>
                <td>
                    Pantalla(s)
                </td>
            </tr>
        <?php foreach ($listaspot as $spot) :?>
            <tr class="info">
                <td><?= $spot['nomcli'] ?></td>
                <td>
                    <?php foreach ($spot['locpant'] as $pantalla) 
                      echo $pantalla['localidad']."<br>" ?>
                </td>
            </tr>   

    <?php endforeach; ?>
</table>