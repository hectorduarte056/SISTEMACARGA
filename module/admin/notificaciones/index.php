<?php
function root_path(){$this_directory = dirname(__FILE__);$archivos=scandir($this_directory);$atras="";$cuenta=0;while(true){foreach($archivos as $actual){if($actual=="root.path"){if($cuenta==0)return "./";return $atras;}}$cuenta++;$atras=$atras."../";$archivos=scandir($atras);}}$nivel=root_path();//fin funcion nivel
require_once($nivel.'model/class.php');
require_once($nivel.'php/exit.php');
require_once($nivel.'php/user.php');

/*/////////////////////////////Configuracion de email///////////////////////////////*/
$conf_email = system::MostrarRegistro("conf_email");


//Actualizar configuracion
if (!empty($_POST['MM_insert'])) {

  $SMTPSecure   = $_POST['SMTPSecure'];
  $Host         = $_POST['Host'];
  $Port         = $_POST['Port'];
  $Username     = $_POST['Username'];
  $Password     = $_POST['Password'];
  $setFrom      = $_POST['setFrom'];
  $Asunto       = $_POST['Asunto'];
  $Subject      = $_POST['Subject'];


  $sql              = "UPDATE `conf_email` SET `smtpsecure`='".$SMTPSecure."',`host`='".$Host."',`port`='".$Port."',`username`='".$Username."',`password`='".$Password."',`setfrom`='".$setFrom."',`asunto`='".$Asunto."',`subject`='".$Subject."' WHERE `id`=1";
  $msj              = system::EjecutarSql($sql);

  header("location:./");
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
              <li class="active">Configuración De Cuenta de Email </li>
            </ol>
          </div>
        </div>
      </div>
    </section>
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
        

          
          <div class="panel panel-primary">
              <div class="panel-heading text-center">
                <h3 class="panel-title">Configuración De Cuenta de Email </h3>
              </div>
              <div class="panel-body" style="overflow: auto;">

                   
                    <table class="table table-striped table-hover" id="example">
                      
                        <tr>
                          <th>SMTPSecure</th>
                          <td><?=$conf_email[0]['smtpsecure']?></td>
                        </tr>
                        <tr>
                          <th>Host</th>
                          <td><?=$conf_email[0]['host']?></td>
                        </tr>
                        <tr>
                          <th>Port</th>
                          <td><?=$conf_email[0]['port']?></td>
                        </tr>
                        <tr>
                          <th>Username</th>
                          <td><?=$conf_email[0]['username']?></td>
                        </tr>
                        <tr>
                          <th>Password</th>
                          <td>******</td>
                        </tr>
                        <tr>
                          <th>setFrom</th>
                          <td><?=$conf_email[0]['setfrom']?></td>
                        </tr>
                        <tr>
                          <th>Asunto</th>
                          <td><?=$conf_email[0]['asunto']?></td>
                        </tr>
                        <tr>
                          <th>Subject</th>
                          <td><?=$conf_email[0]['subject']?></td>
                        </tr>
                    </table>
                    <a href="" class="btn btn-info" title="Actualizar Configuración" data-toggle="modal" data-target="#update">Actualizar Configuración</a>
              </div>
          </div>
        </div>

        
      <!-- ///////////////////////editar perfil //////////////////////////-->
        <div class="modal fade" id="update" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Actualizar Configuración</h4>
                  </div>
                  <form method="post" action="" class="form-input">
                      <div class="modal-body">
                            <div class="row">
                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                        <label>SMTPSecure</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fas fa-cog"></i></span>
                                            <input type="text" name="SMTPSecure" value="<?=$conf_email[0]['smtpsecure']?>" placeholder="SMTPSecure" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                        <label>Host</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fas fa-cog"></i></span>
                                            <input type="text" name="Host" value="<?=$conf_email[0]['host']?>"placeholder="Host" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                        <label>Port</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fas fa-cog"></i></span>
                                            <input type="text" name="Port" value="<?=$conf_email[0]['port']?>"placeholder="Port" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                        <label>Username</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fas fa-cog"></i></span>
                                            <input type="email" name="Username" value="<?=$conf_email[0]['username']?>" placeholder="Username" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                        <label>Password</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fas fa-cog"></i></span>
                                            <input type="password" name="Password" value="" placeholder="Password" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                        <label>setFrom</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fas fa-cog"></i></span>
                                            <input type="text" name="setFrom" value="<?=$conf_email[0]['setfrom']?>"  placeholder="setFrom" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                        <label>Asunto</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fas fa-cog"></i></span>
                                            <input type="text" name="Asunto" value="<?=$conf_email[0]['asunto']?>"  placeholder="Asunto" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                        <label>Subject</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fas fa-cog"></i></span>
                                            <input type="text" name="Subject" value="<?=$conf_email[0]['subject']?>" placeholder="Subject" class="form-control" required>
                                        </div>
                                    </div>
                                   

                                    <div class="col-sm-12 col-md-12 col-lg-12 text-center">
                                       <input type="hidden" name="MM_insert" value="form2">
                                        <button type="submit" class="btn btn-lg btn-success btn-block">
                                            <i class="fa fa-floppy-o" aria-hidden="true"></i> Actualizar Datos
                                        </button>
                                    </div>
                            </div>
                      </div>
                  </form>
                </div>
              </div>
        </div>
     
          

      </div>
    </div>

   <!--
      ///////////////////////////footer/AND//java script/////////////////////////
    -->
     <?php include($nivel."module/footer/index.php"); ?>
    <!--
      ///////////////////////////END///java script/////////////////////////
    -->
    <!--
      ///////////////////////////java script//Personalizado///////////////////////
    -->
 
  </body>
</html>
