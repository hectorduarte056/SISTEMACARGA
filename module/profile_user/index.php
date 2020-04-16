<?php
function root_path(){$this_directory = dirname(__FILE__);$archivos=scandir($this_directory);$atras="";$cuenta=0;while(true){foreach($archivos as $actual){if($actual=="root.path"){if($cuenta==0)return "./";return $atras;}}$cuenta++;$atras=$atras."../";$archivos=scandir($atras);}}$nivel=root_path();//fin funcion nivel
require_once($nivel.'model/class.php');
require_once($nivel.'php/exit.php');
require_once($nivel.'php/user.php');


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
  <body >
     <?php include($nivel."module/header/index.php"); ?>


<section>
             <div class="container-fluid" style="margin-top:20px;">
    <div class="row-fluid">
   
        <div class="col-sm-5 col-md-5"align=center >
        
            <?php
              if (!empty($_GET['msj'])) {
                switch ($_GET['msj']) {
                  case 1:
                      echo "<div class='alert alert-success text-center'>La Contraseña Fue Actualizada Correctamente</div>";
                      break;
                  case 2:
                      echo "<div class='alert alert-warning text-center'>La Contraseña Nueva No Coinciden</div>";
                      break;
                  case 3:
                      echo "<div class='alert alert-warning text-center'>La Contraseña Actual No Coincide</div>";
                      break;
                  }
                }
            ?>
            
         <div class="panel panel-info">
         
             <div class="panel-heading">
                   <h3 class="panel-title"><?php echo $row_usuarios['name']." ".$row_usuarios['last_name'];; ?></h3>
              </div>
              
              <div class="panel-body">
              
                  <div class="row">
                    <div class="col-md-3 col-lg-3 " align="center">
                    <div class="text" align="center">
                        <!-- <img alt="User Pic" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iMjQyIiBoZWlnaHQ9IjIwMCIgdmlld0JveD0iMCAwIDI0MiAyMDAiIHByZXNlcnZlQXNwZWN0UmF0aW89Im5vbmUiPjwhLS0KU291cmNlIFVSTDogaG9sZGVyLmpzLzEwMCV4MjAwCkNyZWF0ZWQgd2l0aCBIb2xkZXIuanMgMi42LjAuCkxlYXJuIG1vcmUgYXQgaHR0cDovL2hvbGRlcmpzLmNvbQooYykgMjAxMi0yMDE1IEl2YW4gTWFsb3BpbnNreSAtIGh0dHA6Ly9pbXNreS5jbwotLT48ZGVmcz48c3R5bGUgdHlwZT0idGV4dC9jc3MiPjwhW0NEQVRBWyNob2xkZXJfMTVkNDQ0MDZhNDggdGV4dCB7IGZpbGw6I0FBQUFBQTtmb250LXdlaWdodDpib2xkO2ZvbnQtZmFtaWx5OkFyaWFsLCBIZWx2ZXRpY2EsIE9wZW4gU2Fucywgc2Fucy1zZXJpZiwgbW9ub3NwYWNlO2ZvbnQtc2l6ZToxMnB0IH0gXV0+PC9zdHlsZT48L2RlZnM+PGcgaWQ9ImhvbGRlcl8xNWQ0NDQwNmE0OCI+PHJlY3Qgd2lkdGg9IjI0MiIgaGVpZ2h0PSIyMDAiIGZpbGw9IiNFRUVFRUUiLz48Zz48dGV4dCB4PSI4OS44MDQ2ODc1IiB5PSIxMDUuMSI+MjQyeDIwMDwvdGV4dD48L2c+PC9nPjwvc3ZnPg==" class="img-circle img-responsive"> -->
                    </div>
                    
                    <div class=" col-md-9 col-lg-9 "> 
                   
                      <table class="table table-user-information">
                          <tbody>
                              <tr>
                                  <td>Nombre:</td>
                                  <td><?php echo $row_usuarios['name']." ".$row_usuarios['last_name'];; ?></td>
                              </tr>
                              <tr>
                                  <td>Usuario:</td>
                                  <td><?php echo $row_usuarios['user_name']; ?></td>
                              </tr>
                              <tr>
                                  <td>Sexo:</td>
                                  <td><?php echo sexo($row_usuarios['sex']); ?></td>
                              </tr>
                              <tr>
                                  <td>Email:</td>
                                  <td><?php echo $row_usuarios['email']; ?></td>
                              </tr>
                              <tr>
                                  <td>Control:</td>
                                  <td><?php echo $row_usuarios['control']; ?></td>
                              </tr>                              
                            </tbody>
                        </table>
                                  
                      
                    </div>
                  </div>
                </div>
               
                <div class="panel-footer">
                    <a href="" class="btn btn-success" data-toggle="modal" data-target="#pass_new">
                        <i class="fa fa-key" aria-hidden="true"></i> Cambiar Contraseña 
                    </a>
                  <span class="pull-right">
                    <a href="" class="btn btn-warning" data-toggle="modal" data-target="#edit_profile">
                        <i class="fa fa-user-edit"></i> Editar Perfil
                    </a>
                  </span>
             </div>
             
          </div>
        </div>
    </div>
</div>
</section><!--section close-->
      
      <!-- pass_new -->
    <div class="modal fade" id="pass_new" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Cambiar Contraseña</h4>
          </div>
          <form method="post" action="../update_pass/" class="form-input">
              <div class="modal-body">
                    <div class="row">
                      <div class="col-sm-12 col-md-12 col-lg-12">
                           <div class="input-group">
                               <span class="input-group-addon"><i class="fa fa-unlock-alt" aria-hidden="true"></i></span>
                               <input type="password" class="form-control" name="pass_actual" placeholder="Contraceña Actual" required>
                           </div>
                       </div>
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
                      
                      <input type="hidden" name="id_user" value="<?php echo $row_usuarios['user_id']; ?>">
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

         <!-- editar perfil -->
    <div class="modal fade" id="edit_profile" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Editar Perfil De <?php echo $row_usuarios['user_name']; ?></h4>
          </div>
          <form method="post" action="../update_profile/" class="form-input">
              <div class="modal-body">
                <div class="row">
                    
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
                            <input type="text" class="form-control" name="name" placeholder="Nombre" required value="<?php echo $row_usuarios['name']; ?>">
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
                            <input type="text" class="form-control" name="last_name" placeholder="Apellido" required value="<?php echo $row_usuarios['last_name']; ?>">
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-envelope" aria-hidden="true"></i></span>
                            <input type="email" class="form-control" name="email" placeholder="Email" required value="<?php echo $row_usuarios['email']; ?>">
                        </div>
                    </div>
                  
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-venus-mars" aria-hidden="true"></i></span>
                        <select name="sex" class="form-control" required>
                            <option disabled="disabled" selected="selected" value="0">Sexo</option>
                            <option value="m" <?php echo selected("m",$row_usuarios['sex']);?>>Masculino</option>
                            <option value="f" <?php echo selected("f",$row_usuarios['sex']);?>>Femenina</option>
                            <option value="o" <?php echo selected("o",$row_usuarios['sex']);?>>Otros</option>
                        </select>
                    </div>
                </div>
               
                </div>
              </div>
              <div class="modal-footer">
                <input type="hidden" name="user_id" value="<?php echo $row_usuarios['user_id']; ?>">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary">Guargar Cambios</button>
              </div>
          </form>
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
