<?php
function root_path(){$this_directory = dirname(__FILE__);$archivos=scandir($this_directory);$atras="";$cuenta=0;while(true){foreach($archivos as $actual){if($actual=="root.path"){if($cuenta==0)return "./";return $atras;}}$cuenta++;$atras=$atras."../";$archivos=scandir($atras);}}$nivel=root_path();//fin funcion nivel
require_once($nivel.'model/class.php');
require_once($nivel.'php/exit.php');
require_once($nivel.'php/user.php');

/*////////////////////////////Solo los admin tien acceso///////////////////////////////*/
if(isset($_SESSION['MM_UserGroup']) AND $_SESSION['MM_UserGroup'] !='admin'){
  header("location:".$nivel);
}

//preguntamos si tenemos un archivo seleccionado
if (!(empty($_FILES['fichero_usuario']))) {


 $msj = system::CargarArchivoAsignaturas($_POST['escuela'],$_FILES['fichero_usuario']['name']);

 header("location:./");
}


/*////////////////////////////Selecccion de registro///////////////////////////////*/
$WHERE = '';
$competencias = system::EjecutarConsulta("competencias",$WHERE);

/*////////////////////////////escuela///////////////////////////////*/
$where = ' WHERE `estado_esc`=1';
$listaCategorias = system::EjecutarConsulta("escuela",$where);
/*////////////////////////////END/escuela///////////////////////////////*/


/****************************************
/////////RegistrarMateria//////////////////*/
if (isset($_POST["form-RegistrarMateria"])) {
 
  $escuela            = $_POST["escuela"];
  $clave              = $_POST["clave"];
  $descripcion        = $_POST["descripcion"];
  $prerequisito       = $_POST["prerequisito"];

  $sql = "INSERT INTO `competencias`(`id_esc`, `clave_comp`, `desc_comp`, `prere_comp`, `estado_comp`) VALUES (".$escuela.",'".$clave."','".$descripcion."','".$prerequisito."',1)";
  system::EjecutarSql($sql);

  header("location:./");
}

/****************************************
/////////Editar escuela//////////////////*/
if (!(empty($_POST['form-edit']))) {
    $id_comp        = $_POST['id_comp'];
    $descripcion    = $_POST['descripcion'];
    $prerequisito   = $_POST['prerequisito'];
    $estado         = $_POST['estado'];

    $sql = "UPDATE `competencias` SET `desc_comp`='".$descripcion."',`prere_comp`='".$prerequisito."',`estado_comp`='".$estado."' WHERE `id_comp` = '".$id_comp."'";
    system::EjecutarSql($sql);

    header("location:./");
}

/****************************************
/////////DELETE escuela//////////////////*/
if (!(empty($_POST['form-Delete']))) {
    $id_comp       = $_POST['id_comp'];

    $sql = "DELETE FROM `competencias` WHERE `id_comp` = '".$id_comp."'";
    system::EjecutarSql($sql);

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
              <li class="active">Asignatura</li>
            </ol>
          </div>
        </div>
      </div>
    </section>
    <section>
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-12 col-md-12">
            <!--////////////Mostramos Mensaje/////////-->
                <?php 
                if (isset($msj)) {          
                  echo $msj;
                }?>
            <div class="panel panel-primary">
              <div class="panel-heading text-center">
                <h3 class="panel-title">Asignatura </h3>
                <span class="pull-right control">
                  <a href="#" class="btn btn-success" data-toggle="modal" data-target="#RegistrarMateria">
                    <i class="fa fa-plus-circle" aria-hidden="true"></i> Registrar Asignatura
                  </a>

                  <a href="#" class="btn btn-success" data-toggle="modal" data-target="#Cargar_Archivo">
                    <i class="fa fa-plus-circle" aria-hidden="true"></i> Cargar Archivo
                  </a>
                </span>
              </div>
              <div class="panel-body">

          

                <table class="table table-striped" id="example">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Clave</th>
                      <th>Descripción</th>
                      <th>Prerequisito</th>
                      <th>Estado</th>
                      <th>Opciones</th>
                    </tr>
                  </thead>
                  <?php $n = 1; foreach ($competencias as $key => $value) { ?>
                    <tr>
                      <td><?php echo $n; ?></td>
                      <td><?php echo $value['clave_comp']; ?></td>
                      <td><?php echo $value['desc_comp']; ?></td>
                      <td><?php echo $value['prere_comp']; ?></td>
                      <td><?php echo active($value['estado_comp']); ?></td>
                      <td>
                       <!--/////////btn group/////////////-->
                        <div class="btn-group" role="group">
                          <a href="#" class="btn btn-warning" title="Editar" data-toggle="modal" data-target="#EditCompetencias<?php echo $value['id_comp']; ?>">
                            <strong class="fa fa-edit"></strong>
                          </a>
                          <!-- <a href="#" class="btn btn-danger" title="Eliminar" data-toggle="modal" data-target="#EliminarCompetencias<?php echo $value['id_comp']; ?>">
                            <strong class="fa fa-trash-alt"></strong> -->
                          </a>
                        </div>
                        <!--/////////btn group/////////////-->
                      </td>
                    </tr>

                    <!-- Modal Edit Competencias -->
                      <div class="modal fade" id="EditCompetencias<?php echo $value['id_comp']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                              <h4 class="modal-title" id="myModalLabel">Editar Competencias</h4>
                            </div>
                            <form action="" method="post">

                            <div class="modal-body">
                              <div class="form-group">
                                <label>Clave</label>
                                <input type="text" name="clave" value="<?php echo $value['clave_comp']; ?>" required="" class="form-control disabled">
                              </div>

                              <div class="form-group">
                                <label>Descripción</label>
                                <input type="text" name="descripcion" value="<?php echo $value['desc_comp']; ?>" required="" class="form-control">
                              </div>

                              <div class="form-group">
                                <label>Prerequisito</label>
                                <input type="text" name="prerequisito" value="<?php echo $value['prere_comp']; ?>" required="" class="form-control">
                              </div>

                              <div class="form-group">
                                <label>Estado</label>
                                <select name="estado" id="" class="form-control">
                                  <option value="0" <?= selected($value['estado_comp'],0); ?>>Desactivado</option>
                                  <option value="1" <?= selected($value['estado_comp'],1); ?>>Activado</option>
                                </select>
                              </div>
                                <input type="hidden" name="id_comp" value="<?php echo $value['id_comp']; ?>">
                                              
                            </div>
                            <div class="modal-footer">
                              <input type="hidden" name="form-edit" value="edit-escuela">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                              <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>

                          </form>
                          </div>
                        </div>
                      </div>

                      <!-- Modal Eliminar Competencias -->
                      <div class="modal fade" id="EliminarCompetencias<?php echo $value['id_comp']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                              <h4 class="modal-title" id="myModalLabel">Eliminar Asignatura</h4>
                            </div>
                            <form action="" method="post">

                            <div class="modal-body">
                              
                                <div class="alert alert-info" role="alert">
                                  <strong>Advertencia!</strong> Esta Seguro Que Desea Eliminar <?php echo $value['desc_comp']; ?>
                                </div>

                                <input type="hidden" name="id_comp" value="<?php echo $value['id_comp']; ?>">
                                              
                            </div>
                            <div class="modal-footer">
                              <input type="hidden" name="form-Delete" value="del-Competencias">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                              <button type="submit" class="btn btn-danger">Eliminar</button>
                            </div>

                          </form>
                          </div>
                        </div>
                      </div>
   

                  <?php $n++; } ?>

                  <tfoot>
                      <tr>
                          <th>#</th>
                          <th>Clave</th>
                          <th>Descripción</th>
                          <th>Prerequisito</th>
                          <th>Estado</th>
                          <th>Opciones</th>
                      </tr>
                  </tfoot>
                </table>

              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Modal categoryModal -->
    <div class="modal fade" id="Cargar_Archivo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Cargar Pensum</h4>
          </div>
          <form action="" method="post" enctype="multipart/form-data">

          <div class="modal-body">
            
              <label>Seleccionar La escuela</label>
              <select class="form-control" name="escuela">
                <?php 
                  foreach ($listaCategorias as $key => $value) {
                    echo '<option value="'.$value['id_esc'].'" >'.$value['des_esc'].'</option>';
                  }
               ?>

              </select>
              <br>
              <label>Seleccionar Archivo de Excel</label>
              <br>
              <input type="file" name="fichero_usuario" required="" class="form-control">
                            
          </div>
          <div class="modal-footer">
            <input type="hidden" name="form-habitos" value="form-habitos">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary">Guardar</button>
          </div>

        </form>
        </div>
      </div>
    </div>


    <!-- Modal categoryModal -->
    <div class="modal fade" id="RegistrarMateria" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Registrar Asignatura</h4>
          </div>
          <form action="" method="post" id="AddFormCompetencias">

          <div class="modal-body">
            
              <label>Seleccionar La escuela</label>
              <select class="form-control" name="escuela">
                <?php 
                  foreach ($listaCategorias as $key => $value) {
                    echo '<option value="'.$value['id_esc'].'" >'.$value['des_esc'].'</option>';
                  }
                ?>
              </select>
              <br>
              <label>Ingresa una Clave</label>
                <div class="input-group" id="class_ced">
                  <span class="input-group-addon" id="resp"><i class="fa fa-comment" aria-hidden="true"></i></span>
                  <input type="text" name="clave" id="clave" class="form-control" placeholder="Buscar..." required="">
                  
                                  
                </div><!-- /input-group -->

          
              <label for="">Descripción</label>
              <input type="text" name="descripcion" required="" placeholder="Descripción" class="form-control">

              <br>
              <label for="">Prerequisito</label>
              <input type="text" name="prerequisito" required="" placeholder="Prerequisito" class="form-control">
                            
          </div>
          <div class="modal-footer">
            <input type="hidden" name="form-RegistrarMateria" value="form-RegistrarMateria">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary" id="btncompetencias">Guardar</button>
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

    
  </body>
</html>
