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
                    <i class="fa fa-user fa-lg" aria-hidden="true"></i>&nbsp<?php echo $this->session->userdata('username');?>
                <span class="caret"></span></button>
                <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                  <li role="presentation">
                      <a href="<?= site_url('Cont_user/LogOut')?>">
                          <i class="fa fa-sign-out fa-lg" aria-hidden="true"></i>&nbsp Logout
                  </li>
                  <li role="presentation">
                      <a href="<?= site_url('Cont_user/DarBajausuario')?>">
                          <i class="fa fa-user-times fa-lg" aria-hidden="true"></i>&nbsp Dar de baja
                  </li>
                  <li role="presentation" class="divider"></li>
                  <li role="presentation">
                      <a href="<?= site_url('Cont_user/CargaDatosUs')?>">
                      <i class="fa fa-edit fa-lg" aria-hidden="true"></i>&nbsp Modificar Datos</a>
                  </li>
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

                <div id="botones" style="text-align: left;" class="col-md-12">
                    <?php if ($this->session->userdata('username')!=null) :?>
                    <b><div class="list-group">
                        <a href="<?= site_url('Cont_empresa/AddEmpresa')?>" 
                           style="background-color: orange" class="list-group-item" title="Añadir cliente">
                            <i class="fa fa-user-plus fa-lg" aria-hidden="true"></i>&nbsp;Añadir cliente</a>
                        </div>
                    <br>
                    <div class="list-group">
                        <a href="<?= site_url('Cont_empresa/VerEmpresa')?>" 
                           style="background-color: orange" class="list-group-item" title="Ver clientes">
                            <i class="fa fa-group fa-lg" aria-hidden="true"></i>&nbsp;Ver clientes</a>
                            
                            <a href="<?= site_url('Cont_empresa/VerOrdenesPend')?>" 
                           style="background-color: orange ;font-size: 11px;" class="list-group-item" title="Ordenes pendientes">
                            <i class="fa fa-exclamation-circle fa-lg" aria-hidden="true"></i>&nbsp;Ordenes pendientes</a>

                    <hr size="2"/>
                            
                            <a href="<?= site_url('Cont_spot/AddPantalla')?>" 
                           style="background-color: activecaption; font-size:12px;" class="list-group-item" title="Añadir pantalla">
                            <i class="fa fa-tv fa-lg" aria-hidden="true"></i>
                                <i class="fa fa-plus fa-lg" aria-hidden="true"></i>&nbsp;Añadir Pantalla</a>
                            
                            <a href="<?= site_url('Cont_spot/VerPantallas')?>" 
                           style="background-color: activecaption;" class="list-group-item" title="Ver Pantallas">
                            <i class="fa fa-tv fa-lg" aria-hidden="true"></i>
                                &nbsp;Ver Pantallas</a>
                    <br>  
                    <a href="<?= site_url('Cont_spot/VerSpotsActivos')?>" 
                           style="background-color: activecaption;" class="list-group-item" title="Spots activos">
                            <i class="fa fa-lightbulb-o fa-lg" aria-hidden="true"></i>
                                &nbsp;Spots activos</a>
                      
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
                                <legend><i class="fa fa-search fa-lg" aria-hidden="true"></i>&nbspBuscar por nombre</legend>
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
        <?php if ($this->session->userdata('username')!=null) :?>
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
        <?php endif; ?>
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
