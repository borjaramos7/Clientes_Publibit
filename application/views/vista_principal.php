<!-- Vista base donde esta el cuerpo y encabezado que modificamos desde los controaldores. -->
<!DOCTYPE html>
<html lang="es">

<head>
    <!-- Necesario para jquery -->
         <link rel="icon" type="image/png" href="<?=base_url().'asset/img/negocios.png'?>" />
	 <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
         <script src="https://use.fontawesome.com/4df1932761.js"></script>
	 <!--cript src="//code.jquery.com/jquery-1.10.2.js"></script>
	 <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script-->
         <script type="text/javascript" src="<?=base_url().'asset/js/ajax.js'?>"></script>
         <!--link href="cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css">
<link href="cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js">
<script>$(document).ready(function(){
    $('#myTable').DataTable();
});</script-->
	 <link rel="stylesheet" href="/resources/demos/style.css">
	 <!-- jQuery -->
          <script src="<?=base_url().'asset/'?>plantilla/js/jquery.js"></script>
	  <script>
  			$.datepicker.regional['es'] = {
		  closeText: 'Cerrar',
		  prevText: '<Ant',
		  nextText: 'Sig>',
		  currentText: 'Hoy',
		  monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
		  monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
		  dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
		  dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
		  dayNamesMin: ['D','L','M','X','J','V','S'],
		  weekHeader: 'Sm',
		  dateFormat: 'yy-mm-dd',
		  firstDay: 1,
		  isRTL: false,
		  showMonthAfterYear: false,
		  yearSuffix: ''
		  };
		  $.datepicker.setDefaults($.datepicker.regional['es']);
		 $(function () {
		 $("#fecha").datepicker();
		 });
                 
        </script>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Clientes Publibit</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?=base_url().'asset/'?>plantilla/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?=base_url().'asset/'?>plantilla/css/shop-homepage.css" rel="stylesheet">

</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <!--button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button-->
                <!--
                <?php if ($this->session->userdata('username')==null) :?>
                <a class="navbar-brand"
                    <?php echo anchor("Cont_user/Login","Login");?></a>
               <?php endif; ?>    -->                 
            </div>
            <a <?php echo anchor("","<img  src='".base_url()."asset/img/publibitblanco.png'>")?>
            
            <?php if ($this->session->userdata('username')!=null) :?>
            <div class="collapse navbar-collapse pull-right" id="bs-example-navbar-collapse-1">
                <div class="dropdown">
                <button class="btn btn-default dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">
                    <?php echo $this->session->userdata('username');?>
                <span class="caret"></span></button>
                <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                  <li role="presentation"><?php echo anchor("Cont_user/LogOut","Logout");?></li>
                  <li role="presentation"><?php echo anchor("Cont_user/DarBajausuario","Dar de baja") ;?></li>
                  <li role="presentation" class="divider"></li>
                  <li role="presentation"><?php echo anchor("Cont_user/CargaDatosUs","Modificar Datos") ;?></li>
                </ul>
              </div>
            <?php endif; ?>
               
            <?php if ($this->session->userdata('username')==null) :?>
                <div class="collapse navbar-collapse pull-right" id="bs-example-navbar-collapse-1">
                <a class="navbar-brand" 
                    <?php echo anchor("Cont_user/Login","Login","style='color: #FFFFFF'");?></a>
                </div>
            <?php endif; ?>
            <!-- /.navbar-collapse -->
        <!-- /.container -->
    </nav>

    <!-- Page Content -->
    <div style="margin-top: 3%" class="container">
        
        <div class="col-md-2">
            <div class="row">

                <div id="botones" style="text-align: center;" class="col-md-12">
                    <?php if ($this->session->userdata('username')!=null) :?>
                    <b><div class="list-group">
                            <?php echo anchor("Cont_empresa/AddEmpresa","Añadir cliente",
                                    'style="background-color: orange" class="list-group-item"');?>
                    </div>
                    <br>
                    <div class="list-group">
                            <?php echo anchor("Cont_empresa/VerEmpresa","Ver clientes",
                                    'style="background-color: orange" class="list-group-item"');?>

                            <?php echo anchor("Cont_empresa/VerOrdenesPend","Ordenes pendientes",
                                    'style="background-color: orange;font-size: 12px;" class="list-group-item" ');?>
                        
                    <hr style="color: orange" size="1"/>
                    
                            <?php echo anchor("Cont_spot/AddPantalla","Añadir Pantalla",
                                    'style="background-color: buttonface" class="list-group-item" ');?>
                    
                            <?php echo anchor("Cont_spot/VerPantallas","Ver pantallas",
                                    'style="background-color: buttonface" class="list-group-item" ');?>
                    <br>    
                            <?php echo anchor("Cont_spot/VerSpotsActivos","Spots Activos",
                                    'style="background-color: buttonface" class="list-group-item"');?>
                    </div>
                    </b>
                    <?php endif; ?>
                </div>
            </div>
        </div>
            <div class="col-md-8">
                <div class="row">
                    <?php if ($encabezado == "Empresas asociadas"): ?>
                        <div class="col-lg-6">
                            <div class="input-group">
                                <legend>Buscar por nombre</legend>
                                <input type="text" class="form-control" id="bus" name="bus" onkeyup="buscador()"/>
                            </div>
                        </div>
                </div>
                <div class="row">    
                    <?php endif; ?>
                    <div id="myDiv">
                    <?php
                    if (isset($cuerpo)) {
                        echo " <div  id='underline'>
                                <h1 style='text-align:left; color:#FF8000'>
                                <b>" . $encabezado . "</b></h1>
                             </div>";
                        echo $cuerpo;
                    } else {
                        $cuerpo = $this->load->view('inicio');
                    }
                    ?>
                    </div>
                </div>
            </div>
        <form action=<?= site_url("Cont_empresa/BuscaOrd")?> method="post">
            <div class="col-md-2"><h4>Busca ordenes por denominacion</h4>
                <div class="input-group">
                <span class="input-group-btn">
                <input name="buscaordenes" id="buscaordenes" type="text" class="form-control">
                <button class="btn btn-info" type="submit"><i class='fa fa-search fa-lg' aria-hidden='true'></i></button>  
                </span>
                </div>
              </div>
        </form>
    </div>
    <!-- /.container -->

    <div class="container">

        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p></p>
                </div>
            </div>
        </footer>

    </div>
    <!-- /.container -->

    <!-- Bootstrap Core JavaScript -->
    <script src="<?=base_url().'asset/'?>plantilla/js/bootstrap.min.js"></script>

</body>

</html>
