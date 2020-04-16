<?php
function root_path(){$this_directory = dirname(__FILE__);$archivos=scandir($this_directory);$atras="";$cuenta=0;while(true){foreach($archivos as $actual){if($actual=="root.path"){if($cuenta==0)return "./";return $atras;}}$cuenta++;$atras=$atras."../";$archivos=scandir($atras);}}$nivel=root_path();//fin funcion nivel
require_once($nivel.'model/class.php');
require_once($nivel.'php/exit.php');
require_once($nivel.'php/user.php');

/*////////////////////////////Solo los admin tien acceso///////////////////////////////*/
if(isset($_SESSION['MM_UserGroup']) AND $_SESSION['MM_UserGroup'] !='admin'){
  header("location:".$nivel);
}
/*////////////////////////////Selecccion de categoria registradas///////////////////////////////*/
$user_problem   = Conexion::conectar()->prepare("SELECT * FROM `user` ORDER BY `user_id` ASC");
$user_problem   ->execute(array("1"));
$user_problems  = $user_problem->fetchAll(PDO::FETCH_ASSOC);
$totalRows_user = count($user_problems);
$row_user       = array_shift($user_problems);

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
  </head>
  <body>
    <?php include($nivel."module/header/index.php"); ?>
    <section>
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <ol class="breadcrumb">
              <li><a href="<?php echo $nivel;?>">Inicio</a></li>
              <li><a href="../">Acceso Directos</a></li>
              <li class="active">Copia de Seguridad de la Base de Datos</li>
            </ol>
          </div>
        </div>
      </div>
    </section>
    
    <section>
      <div class="container-fluid">
        <div class="row">
           <div class="col-md-12">
              <div class="panel panel-default">
                  <div class="panel-heading">
                    <i class="fa fa-database" aria-hidden="true"></i> Copia de Seguridad de la Base de Datos

                    <span class="pull-right control" style="margin-top: -5px !important;">
                      <a href="bd/" class="btn btn-success">
                        <i class="fa fa-database"></i> Realizar Copia de BD
                      </a>
                      <!--
                      <a href="../backup-img/" class="btn btn-success">
                        <i class="fa fa-database"></i> Realizar Copia de Imagenes
                      </a>-->
                    </span>
                  </div>
                  <div class="panel-body">
                        <div class="list-group">
                           <?php  echo listar_archivos('bd');/*si esta ne la misma carpeta poner un . */?>
                       </div>
                  </div>
              </div>
            </div>
        </div>
      </div>
     </section>

    <!--
      ///////////////////////////footer/AND//java script/////////////////////////
    -->
     <?php include($nivel."module/footer/index.php"); ?>
    <!--
      ///////////////////////////END///java script/////////////////////////
    -->
  </body>
</html>
