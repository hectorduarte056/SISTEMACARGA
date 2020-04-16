<?php
function root_path(){$this_directory = dirname(__FILE__);$archivos=scandir($this_directory);$atras="";$cuenta=0;while(true){foreach($archivos as $actual){if($actual=="root.path"){if($cuenta==0)return "./";return $atras;}}$cuenta++;$atras=$atras."../";$archivos=scandir($atras);}}$nivel=root_path();//fin funcion nivel
require_once($nivel.'model/class.php');
require_once($nivel.'php/exit.php');
require_once($nivel.'php/user.php');

/*////////////////////////////Solo los admin tien acceso///////////////////////////////*/
if(isset($_SESSION['MM_UserGroup']) AND $_SESSION['MM_UserGroup'] !='admin'){
  header("location:system/carga/".$nivel);
}

/****************************************
/////////Insert escuela//////////////////*/
if (!(empty($_POST['form-add']))) {

    $escuela          = $_POST['escuela'];

    $sql = "INSERT INTO `escuela`(`des_esc`, `estado_esc`) VALUES ('".$escuela."',1)";
    system::EjecutarSql($sql);

    header("location:./");
}

/****************************************
/////////Editar escuela//////////////////*/
if (!(empty($_POST['form-edit']))) {
    $id_escuela       = $_POST['id_escuela'];
    $escuela          = $_POST['escuela'];
    $estado           = $_POST['estado'];

    $sql = "UPDATE `escuela` SET `des_esc`='".$escuela."',`estado_esc`='".$estado."' WHERE `id_esc` = '".$id_escuela."'";
    system::EjecutarSql($sql);

    header("location:./");
}

/****************************************
/////////DELETE escuela//////////////////*/
if (!(empty($_POST['form-Delete']))) {
    $id_escuela       = $_POST['id_escuela'];

    $sql = "DELETE FROM `escuela` WHERE `id_esc` = '".$id_escuela."'";
    system::EjecutarSql($sql);

    header("location:./");
}

/*////////////////////////////Selecccion de registro///////////////////////////////*/
$where = '';
$escuela = system::EjecutarConsulta("escuela",$where);
/*////////////////////////////Selecccion de registro///////////////////////////////*/
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
                <h3 class="panel-title">Escuelas Registradas </h3>
                <span class="pull-right control">
                  <a href="#" class="btn btn-success" data-toggle="modal" data-target="#escuela">
                    <i class="fa fa-plus-circle" aria-hidden="true"></i> Registrar Escuela
                  </a>
                </span>
              </div>
              <div class="panel-body">

                
               <?php //if ($totalRows_escuelas > 0) { ?>

                <table class="table table-border" id="example">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Escuela</th>
                      <th>Estado</th>
                      <th>Opciones</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php $n = 1; foreach ($escuela as $key => $value) {
                   ?>
                    <tr>
                      <td><?php echo $n; ?></td>
                      <td><?php echo $value['des_esc']; ?></td>
                      <td><?php echo active($value['estado_esc']); ?></td>
                      <td>
                        <!--/////////btn group/////////////-->
                        <div class="btn-group" role="group">
                          <a href="#" class="btn btn-warning" title="Editar" data-toggle="modal" data-target="#Editarescuela<?php echo $value['id_esc']; ?>">
                            <strong class="fa fa-edit"></strong>
                          </a>
                          <!-- <a href="#" class="btn btn-danger" title="Eliminar" data-toggle="modal" data-target="#Eliminarescuela<?php echo $value['id_esc']; ?>">
                            <strong class="fa fa-trash-alt"></strong> -->
                          </a>
                        </div>
                        <!--/////////btn group/////////////-->
                      </td>
                    </tr>
                      
                      <!-- Modal Editar Escuela -->
                      <div class="modal fade" id="Editarescuela<?php echo $value['id_esc']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                              <h4 class="modal-title" id="myModalLabel">Registrar Escuela</h4>
                            </div>
                            <form action="" method="post">

                            <div class="modal-body">
                              
                                <label>Escuela</label>
                                <br>
                                <input type="text" name="escuela" value="<?php echo $value['des_esc']; ?>" required="" class="form-control">
                                <label>Estado</label>
                                <br>
                                <select name="estado" id="" class="form-control">
                                  <option value="0" <?= selected($value['estado_esc'],0); ?>>Desactivado</option>
                                  <option value="1" <?= selected($value['estado_esc'],1); ?>>Activado</option>
                                </select>
                                <input type="hidden" name="id_escuela" value="<?php echo $value['id_esc']; ?>">
                                              
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

                      <!-- Modal Editar Escuela -->
                      <!-- <div class="modal fade" id="Eliminarescuela<?php echo $value['id_esc']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header"> -->
                              <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
                              <!-- <h4 class="modal-title" id="myModalLabel">Eliminar Escuela</h4> -->
                            <!-- </div>
                            <form action="" method="post">

                            <div class="modal-body">
                              
                                <div class="alert alert-info" role="alert">
                                  <strong>Advertencia!</strong> Esta Seguro Que Desea Eliminar <?php echo $value['des_esc']; ?>
                                </div>

                                <input type="hidden" name="id_escuela" value="<?php echo $value['id_esc']; ?>">
                                              
                            </div>
                            <div class="modal-footer">
                              <input type="hidden" name="form-Delete" value="del-escuela"> -->
                              <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button> -->
                              <!-- <button type="submit" class="btn btn-danger">Eliminar</button> -->
                            </div>

                          </form>
                          </div>
                        </div>
                      </div>
   

                  <?php $n++; }  ?>
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>#</th>
                      <th>Escuela</th>
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
    <div class="modal fade" id="escuela" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Registrar Escuela</h4>
          </div>
          <form action="" method="post" enctype="multipart/form-data">

          <div class="modal-body">
            
              <label>Escuela</label>
              <br>
              <input type="text" name="escuela" required="" class="form-control">
                            
          </div>
          <div class="modal-footer">
            <input type="hidden" name="form-add" value="add-escuela">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary">Guardar</button>
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
