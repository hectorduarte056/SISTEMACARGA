<?php
function root_path(){$this_directory = dirname(__FILE__);$archivos=scandir($this_directory);$atras="";$cuenta=0;while(true){foreach($archivos as $actual){if($actual=="root.path"){if($cuenta==0)return "./";return $atras;}}$cuenta++;$atras=$atras."../";$archivos=scandir($atras);}}$nivel=root_path();//fin funcion nivel
require_once($nivel.'model/class.php');
require_once($nivel.'php/exit.php');
require_once($nivel.'php/user.php');

/*////////////////////////////Solo los admin tien acceso///////////////////////////////*/
if(isset($_SESSION['MM_UserGroup']) AND $_SESSION['MM_UserGroup'] !='admin'){
  header("location:system/carga/".$nivel);
}
/*////////////////////////////user///////////////////////////////*/
  $where     = ' ORDER BY `user_id` ASC';
  $listaUser = system::EjecutarConsulta("user",$where);


/*////////////////////////////control///////////////////////////////*/
if(isset($_POST['control'])){
    
    $control        = $_POST['control'];
    $id_admin       = $_POST['id_user'];

    $control_up     = "UPDATE `user` SET `control`='".$control."' WHERE `user_id`='".$id_admin."'";
    system::EjecutarSql($control_up);
    
    header("location:3");//El control Fue Actualizado Correctamente
              
}

/*////////////////////////////pass nueva///////////////////////////////*/
if(isset($_POST['pass_nueva'])){
    
    $pass_nueva         = $_POST['pass_nueva'];
    $pass_confir        = $_POST['pass_confir'];
    $id_admin           = $_POST['id_user'];
    
     if($pass_nueva == $pass_confir){

    $pass               =sha1(md5($salt.$_POST['pass_confir']));
       
    $pas_new            = "UPDATE `user` SET `password`='".$pass."' WHERE `user_id`='".$id_admin."'";
    system::EjecutarSql($pas_new);
    
            header("location:1");//La contraceña Fue Actualizada Correctamente
            
    }else{
            header("location:2");//La contraceña Nueva No Coinciden
          }
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
    <style>
      .input-group{
        margin-bottom: 20px !important;
      }
    </style>
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
              <li class="active">Usuarios</li>
            </ol>
          </div>
        </div>
      </div>
    </section>
    <section>
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
              
              <?php
              if(isset($_GET['msj'])){
                  
                switch ($_GET['msj']) {
                case 1:
                    echo "<div class='alert alert-success text-center'>La Contraseña Fue Actualizada Correctamente</div>";
                    break;
                case 2:
                    echo "<div class='alert alert-danger text-center'>La Contraseñas No Coinciden</div>";
                    break;
                case 3:
                    echo "<div class='alert alert-success text-center'>El Nivel Fue Actualizado Correctamente</div>";
                    break;
                case 4:
                    echo "<div class='alert alert-success text-center'>Usuario Registrado Correctamente</div>";
                    break;
                case 5:
                    echo "<div class='alert alert-warning text-center'>Por Favor Confirmar Que El Formulario Este Completado Correctamente</div>";
                    break;
                }}
            ?>
              
              <div class="panel panel-primary">
                <div class="panel-heading text-center">
                  <h3 class="panel-title">Usuarios Registrados</h3>

                </div>
                <div class="col-md-12">
                  <hr>
                    <a href="" class="btn btn-info text-right" data-toggle="modal" data-target="#add_user">
                      <i class="fa fa-check-circle-o" aria-hidden="true"></i> Registrar Usuario
                    </a>
                  <hr>
                </div>
                   
                <div class="panel-body" style="overflow: auto;">

              <?php if (!empty($listaUser)) { ?>
              <table class="table table-striped table-hover" id="example">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Usuario</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Control</th>
                    <th>Opciones</th>
                  </tr>
                </thead>
                
                <tbody>
                  <?php foreach ($listaUser as $key => $row_user) { ?>
                  <tr>
                    <td><?php echo $row_user["user_id"];?></td>
                    <td><?php echo $row_user["user_name"];?></td>
                    <td><?php echo $row_user["name"]." ".$row_user["last_name"];?></td>
                    <td><?php echo $row_user["email"];?></td>
                    <td><?php echo control($row_user["control"]);?></td>
                    <td>
                        <a href="" class="btn btn-info" data-toggle="modal" data-target="#control<?php echo $row_user["user_id"];?>">
                        <i class="fa fa-check-circle-o" aria-hidden="true"></i> Control
                        </a>
                        <a href="" class="btn btn-success" data-toggle="modal" data-target="#pass_new<?php echo $row_user["user_id"];?>">
                        <i class="fa fa-key" aria-hidden="true"></i> Contraseña
                        </a> 
                    </td>
                  </tr>
                    <!-- pass_new -->
                    <div class="modal fade" id="pass_new<?php echo $row_user["user_id"];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Cambiar Contraseña</h4>
                          </div>
                          <form method="post" action="" class="form-input">
                              <div class="modal-body">
                                    <div class="row">
                                      <div class="col-sm-12 col-md-12 col-lg-12">
                                           <div class="input-group">
                                               <span class="input-group-addon"><i class="fa fa-unlock-alt" aria-hidden="true"></i></span>
                                               <input type="password" class="form-control" name="pass_nueva" placeholder="Contraceña Nueva" required>
                                           </div>
                                       </div>
                                       <div class="col-sm-12 col-md-12 col-lg-12">
                                           <div class="input-group">
                                               <span class="input-group-addon"><i class="fa fa-unlock-alt" aria-hidden="true"></i></span>
                                               <input type="password" class="form-control" name="pass_confir" placeholder="Confirmar Contraceña Nueva" required>
                                           </div>
                                       </div>

                                      <input type="hidden" name="id_user" value="<?php echo $row_user["user_id"];?>">
                                    </div>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-primary">Guargar Cambios</button>
                              </div>
                          </form>
                        </div>
                      </div>
                    </div>
                    
                    <!-- control -->
                    <div class="modal fade" id="control<?php echo $row_user["user_id"];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Cambiar Nivel</h4>
                          </div>
                          <form method="post" action="" class="form-input">
                              <div class="modal-body">
                                    <div class="row">
                                      
                                       <div class="col-sm-12 col-md-12 col-lg-12">
                                           <div class="input-group">
                                               <span class="input-group-addon"><i class="fa fa-unlock-alt" aria-hidden="true"></i></span>
                                               <select class="form-control" name="control">
                                                    <option value="admin">Admin</option>
                                                    <option value="user">User</option>
                                               </select>
                                           </div>
                                       </div>

                                      <input type="hidden" name="id_user" value="<?php echo $row_user["user_id"];?>">
                                    </div>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-primary">Guargar Cambios</button>
                              </div>
                          </form>
                        </div>
                      </div>
                    </div>
                    
                  <?php } ?>
                </tbody>
                <tfoot>
                  <tr>
                    <th>ID</th>
                    <th>Usuario</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Control</th>
                    <th>Opciones</th>
                  </tr>
                </tfoot>
              </table>
              <?php }else{
                echo "<div class='alert alert-info' role='alert'>No se encontraron registros</div>";

              } ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

      
      <!-- add user -->
    <div class="modal fade" id="add_user" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Registrar Usuario</h4>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-sm-12 col-md-12">
    					  <div class="panel panel-success">
    						  <div class="panel-body">
                    <?php
                    ///abrir ventana modal si el form de registro tiene errores
                    if (isset($_GET['error']) AND ($_GET['error'] == "error-sign-up")) {?>
                      <div class="alert alert-danger">
                        <p><b>¡ERORR!</b> Please verify that all fields are completed correctly</p>
                      </div>
                    <?php }?>
                      <form id="register-form" action="../add_user/" method="post" role="form">
                        <div class="form-group has-feedback">
    											<label for="username">Nombre *</label>
    											<span class="form-control-feedback input-validator-feedback" data-fieldname="username"></span>
    											<input type="text" name="name" id="name" tabindex="1" class="form-control validate-input" placeholder="Name" value="" autocomplete="off">
    										</div>
    										<div id="msj_user" class="form-group has-feedback">
    											<label for="username">Usuario *</label>
    											<span class="form-control-feedback input-validator-feedback" data-fieldname="username"></span>
    											<input type="text" name="user" id="user" tabindex="1" class="form-control validate-input" placeholder="Username" value="" autocomplete="off">
    										</div>
    										<div id="msj_email" class="form-group has-feedback">
    											<label for="email">Email *</label>
    											<span class="form-control-feedback input-validator-feedback" data-fieldname="email"></span>
    											<input type="email" name="email2" id="email2" tabindex="2" class="form-control validate-input" placeholder="Email" value="" autocomplete="off">
    										</div>
    										<div id="msj_pass" class="form-group">
    											<label for="password">Contraseña *</label>
    											<input type="password" name="pass" id="pass" tabindex="3" class="form-control" placeholder="Password" autocomplete="off">
    										</div>
    										<div id="msj_pass2" class="form-group">
    											<label for="confirm-password">Confirmar Contraseña *</label>
    											<input type="password" name="pass2" id="pass2" tabindex="4" class="form-control" placeholder="Confirm Password" autocomplete="off">
    										</div>
                        <div class="form-group">
      										<div class="row">
      											<div class="col-sm-12">
                              <input type="hidden" name="form" id="form" value="success">
      												<input type="submit" name="login-submit" id="submit" tabindex="4" class="form-control btn btn-primary btn-block" value="Registrar Usuario">
      											</div>
      										</div>
      									</div>

    									</form>

    						</div>
    					  </div>
    				  </div>
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
    <script type="text/javascript">
               $(document).ready(function() {
                $('#solution').DataTable({

                    "order":[[0, "desc"]]
                });
            } );
        </script>
  </body>
</html>
