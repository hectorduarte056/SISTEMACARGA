<?php
function root_path(){$this_directory = dirname(__FILE__);$archivos=scandir($this_directory);$atras="";$cuenta=0;while(true){foreach($archivos as $actual){if($actual=="root.path"){if($cuenta==0)return "./";return $atras;}}$cuenta++;$atras=$atras."../";$archivos=scandir($atras);}}$nivel=root_path();//fin funcion nivel
require_once($nivel.'model/class.php');
require_once($nivel.'php/exit.php');
require_once($nivel.'php/user.php');
/*////////////////////////////Solo los admin tien acceso///////////////////////////////*/
if(isset($_SESSION['MM_UserGroup']) AND $_SESSION['MM_UserGroup'] !='admin'){
  header("location:".$nivel);
}

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Asignación De Facilitadores</title>
    <!--
      //////////////////////////////estylo css/////////////////////////
    -->
    <?php include($nivel."module/head/index.php"); ?>
    <!--
      ///////////////////////////END///estylo css/////////////////////////
    -->
    <style media="screen">
      .panel-body .btn:not(.btn-block) { min-width:120px;margin-bottom:10px; }
    </style>
  </head>
  <body>
    <?php include($nivel."module/header/index.php"); ?>


    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <span class="fa fa-ellipsis-h"></span> Acceso Directos</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-xs-6 col-md-6">
                              <a href="asignaturas/" class="btn btn-info btn-lg" role="button"><i class="fa fa-list-ul" aria-hidden="true"></i> <br/> Asignaturas</a>
                              <a href="escuelas/" class="btn btn-warning btn-lg" role="button"><i class="fa fa-school" aria-hidden="true"></i> <br/>Escuela</a>
                              <a href="user/" class="btn btn-success btn-lg" role="button"><span class="fa fa-user"></span> <br/>Users</a>
                              <a href="backup/" class="btn btn-info btn-lg" role="button"><i class="fa fa-database" aria-hidden="true"></i> <br/>Backup</a>
                            </div>
                            <div class="col-xs-6 col-md-6">
                              
                            </div>
                        </div>
                    </div>
                </div>

                <!-- <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <span class="fa fa-ellipsis-h"></span> Notificaciónes</h3> -->
                    <!-- </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-xs-12 col-md-12">
                              <a href="notificaciones/" class="btn btn-info btn-lg" role="button"><i class="fas fa-bell"></i> <br/> Configurar Notificaciones</a>
                              
                            </div>
                            
                        </div>
                    </div>
                </div> --> 

                <div class="panel panel-danger">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <span class="fa fa-ellipsis-h"></span> Mantenimiento de Datos</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-xs-12 col-md-12">
                              <a href="MantenimientoCarga/" class="btn btn-danger btn-lg" role="button"><i class="fa fa-list-ul" aria-hidden="true"></i> <br/> Carga</a>
                              <a href="MantenimientoReporte/" class="btn btn-danger btn-lg" role="button"><i class="fa fa-school" aria-hidden="true"></i> <br/>Reporte</a>
                            </div>
                        </div>
                        
                    </div>
                </div>

            </div>
        </div>
    </div>

    <?php include($nivel."module/footer/index.php"); ?>
  </body>
</html>
