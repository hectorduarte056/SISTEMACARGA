<?php
function root_path(){$this_directory = dirname(__FILE__);$archivos=scandir($this_directory);$atras="";$cuenta=0;while(true){foreach($archivos as $actual){if($actual=="root.path"){if($cuenta==0)return "./";return $atras;}}$cuenta++;$atras=$atras."../";$archivos=scandir($atras);}}$nivel=root_path();//fin funcion nivel
require_once($nivel.'model/class.php');
require_once($nivel.'php/exit.php');
require_once($nivel.'php/user.php');

if (isset($_GET['facilitador'])) {

$id_faci            = $_GET['facilitador'];
/*/////////////////////////////home page///////////////////////////////*/
$home_page          = Conexion::conectar()->prepare("SELECT nom_faci, apell_faci, ced_faci FROM `facilitadores` WHERE `id_faci`= ?");
$home_page          ->execute(array($id_faci));

$home_result        = $home_page->fetchAll(PDO::FETCH_ASSOC);
$totalRows_page     = count($home_result);
$row_home_pages     = array_shift($home_result);
/*////////////////////////////END/home page///////////////////////////////*/

/*/////////////////////////////home page///////////////////////////////*/
$competencia            = Conexion::conectar()->prepare("SELECT * FROM competencias INNER JOIN compfacili on competencias.clave_comp = compfacili.clave_comp WHERE compfacili.id_faci = ? ORDER BY compfacili.id_compfacili DESC");
$competencia            ->execute(array($id_faci));
$competencias           = $competencia->fetchAll(PDO::FETCH_ASSOC);
$totalRows_competencias = count($competencias);
$row_competencias       = array_shift($competencias);
/*////////////////////////////END/home page///////////////////////////////*/

/*////////////////////////////Eliminar Competencia///////////////////////////////*/
(!empty($_POST['id_comp']))? system::EliminarFacilitadoresCompetencia($_POST['id_comp']) : "";

}else{
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
  </head>
  <body>
    <?php include($nivel."module/header/index.php"); ?>
    <section>
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <ol class="breadcrumb">
              <li><a href="<?php echo $nivel;?>">Inicio</a></li>
              <li>
                <a href="../profile/<?php echo $id_faci;?>">
                  <?php echo $row_home_pages['nom_faci']." ".$row_home_pages['apell_faci']; ?>
                </a>
              </li>
              <li class="active">Registrar Competencias</li>
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
                        <h3 class="panel-title">Registrar Competencias</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-12 col-md-6 col-lg-6">
                               <label>Nombre</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input type="text" name="name" value="<?php echo $row_home_pages['nom_faci']." ".$row_home_pages['apell_faci']; ?>" class="form-control" disabled required>
                                </div>
                            </div>


                            <div class="col-sm-12 col-md-6 col-lg-6">
                               <label>Cédula</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-id-card"></i></span>
                                    <input type="text" value="<?php echo $row_home_pages['ced_faci']; ?>" class="form-control" disabled required>
                                </div>
                            </div>

                           
                          <div class="col-sm-12 col-md-6 col-lg-6">
                            <br>
                              <form name="competencias" class="form-input" id="FormCompetencias">
                                <label>Ingresa una Clave</label>
                                <div class="input-group" id="class_ced">
                                  <span class="input-group-addon" id="resp"><i class="fa fa-comment" aria-hidden="true"></i></span>
                                  <input type="text" name="clave" id="clave" class="form-control" placeholder="Buscar..." required="">
                                  <input type="hidden" name="id_faci" id="id_faci" value="<?php echo $id_faci; ?>">
                                  <span class="input-group-btn">
                                    <a href="" class="btn btn-primary" id="btncompetencias">Agregar</a>
                                  </span>
                                </div><!-- /input-group -->

                              </form>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-12" id="divcompetencias">
                              
                              <?php if ($totalRows_competencias > 0) {
                                # code...
                              
                               ?>
                             
                               <table class="table">
                                 <thead>
                                   <tr>
                                     <th>Clave</th>
                                     <th>Descripción</th>
                                     <th>Opciones</th>
                                   </tr>
                                 </thead>
                                 <tbody>
                                  <?php do {?>
                                  
                                   <tr>
                                     <td><?php echo $row_competencias['clave_comp']; ?></td>
                                     <td><?php echo $row_competencias['desc_comp']; ?></td>
                                     <td>
                                       <!--/////////btn group/////////////-->
                                        <div class="btn-group" role="group">
                                          <a href="#" class="btn btn-default" title="Eliminar" data-toggle="modal" data-target="#delComp<?php echo $row_competencias['id_compfacili']; ?>">
                                            <strong class="fa fa-trash-alt"></strong>
                                          </a>
                                        </div>
                                        <!--/////////btn group/////////////-->
                                     </td>
                                   </tr>

                                   <!-- Eliminar Competencia -->
                                    <div class="modal fade" id="delComp<?php echo $row_competencias['id_compfacili']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                      <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myModalLabel">Eliminar Competencia: <?php echo $row_competencias['desc_comp']; ?></h4>
                                          </div>
                                          <form method="post" action="" class="form-input">
                                              <div class="modal-body">
                                                    <div class="row">
                                                      <div class="col-sm-12 col-md-12 col-lg-12">
                                                          <div class="alert alert-info" role="alert">
                                                           <strong>Advertencia!</strong> Esta Seguro Que Desea Eliminar <?php echo $row_competencias['desc_comp']; ?>.
                                                          </div>
                                                       </div>
                                                      
                                                      <input type="hidden" name="id_comp" value="<?php echo $row_competencias['id_compfacili']; ?>">
                                                    </div>
                                              </div>
                                              <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                                <button type="submit" class="btn btn-danger">Eliminar</button>
                                              </div>
                                          </form>
                                        </div>
                                      </div>
                                    </div>

                                 <?php  } while ($row_competencias       = array_shift($competencias)); ?>
                                 </tbody>
                               </table>

                               <?php 
                               } else {
                                echo '<div class="alert alert-info text-center">No se encontraron registros</div>';
                              }
                               ?>
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
  </body>
</html>
<?php



/*////////////////////////////Selecccion de registro///////////////////////////////*/
$WHERE = '';
$competencias = system::EjecutarConsulta("competencias",$WHERE);

/*////////////////////////////escuela///////////////////////////////*/
$where = ' WHERE `estado_esc`=1';
$listaCategorias = system::EjecutarConsulta("escuela",$where);
/*////////////////////////////END/escuela///////////////////////////////*/




?>
<!DOCTYPE html>
<html>
  
  <body>
    
   
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
                <h3 class="panel-title">Consulta De Asignatura </h3>
                <span class="pull-right control">
     
                  </a>

                
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

                      </td>
                    </tr>                   

                          </form>
                          </div>
                        </div>
                      </div>
                  <?php $n++; } ?>


              </select>
        
          </div>
        </form>
        </div>
      </div>
    </div>
              
          </div>
        </form>
        </div>
      </div>
    </div>
   
  </body>
</html>
