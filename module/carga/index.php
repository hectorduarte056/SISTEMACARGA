<?php
function root_path(){$this_directory = dirname(__FILE__);$archivos=scandir($this_directory);$atras="";$cuenta=0;while(true){foreach($archivos as $actual){if($actual=="root.path"){if($cuenta==0)return "./";return $atras;}}$cuenta++;$atras=$atras."../";$archivos=scandir($atras);}}$nivel=root_path();//fin funcion nivel
require_once($nivel.'model/class.php');
require_once($nivel.'php/exit.php');
require_once($nivel.'php/user.php');


//preguntamos si tenemos un archivo seleccionado
if (!(empty($_FILES['fichero_usuario']))) {


  $msj = system::CargarArchivo($_FILES['fichero_usuario']['name']);

}


/*/////////////////////////////carga///////////////////////////////*/
if (!empty($_GET)) {
  @$escuela              = $_GET['escuela'];
  @$cuatrimestre         = $_GET['cuatrimestre'];
  $where        = ' WHERE `id_esc`="'.$escuela.'" AND `ciclo`="'.$cuatrimestre.'"';
  $row_cargas   = system::EjecutarConsulta("carga",$where);
  /*////////////////////////////END/carga///////////////////////////////*/

}else {
  $totalRows_cargas = 0;
  $escuela = "";
  $cuatrimestre= "";
}
/*////////////////////////////END/carga///////////////////////////////*/

/*////////////////////////////escuela///////////////////////////////*/
$where = ' WHERE `estado_esc`=1';
$listaCategorias = system::EjecutarConsulta("escuela",$where);
/*////////////////////////////END/escuela///////////////////////////////*/

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

    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">

         <!--////////////Mostramos Mensaje/////////-->
          <?php 
          if (isset($msj)) {          
            echo $msj;
          }?>
          
          <div class="panel">
            <div class="panel-body" style="overflow: auto;">
              <form action="" method="get">
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <select name="escuela" id="escuela" class="form-control">
                        <option value="" disabled="" selected="">Seleccionar Escuela</option>

                        <?php

                         foreach ($listaCategorias as $key => $value) {
                           echo '<option value="'.$value['id_esc'].'"'.selected($value['id_esc'],$escuela).' >'.$value['des_esc'].'</option>';
                          }
                        ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <select name="cuatrimestre" id="cuatrimestre" class="form-control">
                        <option value="" disabled="" selected="">Seleccionar Trimestre  </option>
                          <?php if (!empty($_GET['cuatrimestre'])):
                            echo '<option value="'.$_GET['cuatrimestre'].'" selected="">'.$_GET['cuatrimestre'].'</option>';
                          endif ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4 text-left">
                    <div class="form-group">
                      <button type="sumit" class="btn btn-success">Buscar</button>
                      
                      <?php if (!empty($row_cargas)) { ?>
                        <a href="../asignacion/<?php echo $escuela.'&'.$cuatrimestre; ?>" class="btn btn-primary">Procesar Asignación de Facilitadores</a>
                      <?php } ?>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>

          <div class="panel panel-primary">
              <div class="panel-heading text-center">
                <h3 class="panel-title">Carga de Horario </h3>
                <span class="pull-right control">
                  <a href="#" class="btn btn-success" data-toggle="modal" data-target="#categoryModal">
                    <i class="fa fa-plus-circle" aria-hidden="true"></i> Agregar
                  </a>
                </span>
              </div>
              <div class="panel-body" style="overflow: auto;">

                    <?php if (!empty($row_cargas)) { ?>
                    <table class="table table-striped table-hover" id="example">
                      <thead>
                        <tr>
                          
                          <th>Clave</th>
                          <th>Descripción</th>
                          <th>ciclo</th>
                          <th>Seccion</th>
                          <th>Aula</th>
                          <th>Día</th>
                          <th>Hi</th>
                          <th>Hf</th>
                          <th>Escuela</th>
                          <th>Estado</th>
                          
                          
                        </tr>
                      </thead>
                      
                      <tbody>
                        <?php foreach ($row_cargas as $key => $value) { ?>

                          <tr>
                            
                            <td><?php echo $value['clave']; ?></td>
                            <td><?php echo ConsultarDescripAulas($value['clave']); ?></td>
                            <td><?php echo $value['ciclo']; ?></td>
                            <td><?php echo $value['seccion']; ?></td>
                            <td><?php echo $value['aula']; ?></td>
                            <td><?php 
                           echo Dia($value['dia']);
                           //echo ClearString($row_home_cargas['dia']);
                            ?></td>
                            <td><?php echo $value['hi']; ?></td>
                            <td><?php echo $value['hf']; ?></td>
                            <td><?php echo $value['carga_esc']; ?></td>


                            <!---////////////////////////////////proceso de asignacion/////////////-->
                            <?php 
                            

                            
                          
                              $msj = system::AsignacionEstado(
                                                            $value['id_carga'],
                                                            $value['id_esc'],
                                                            $value['ciclo'],
                                                            $value['clave'],
                                                            $value['seccion'],
                                                            $value['aula'],
                                                            $value['dia'],
                                                            $value['hi'],
                                                            $value['hf'],
                                                            $value['carga_esc']
                                                          );
                            ?>
                            <!---///////////////////////////////END/proceso de asignacion/////////////-->

                            <td>
                              <?php echo $msj;

                              //if($row_home_cargas['id_faci'] != null){ echo 1;}else{ echo "Indefinido";} ?></td>
                          </tr>
                          
                        <?php } ?>
                      </tbody>
                      <tfoot>
                        <tr>
                         
                          <th>Clave</th>
                          <th>Descripción</th>
                          <th>ciclo</th>
                          <th>Seccion</th>
                          <th>Aula</th>
                          <th>Día</th>
                          <th>Hi</th>
                          <th>Hf</th>
                          <th>Escuela</th>
                          <th>Estado</th>
                          

                        </tr>
                      </tfoot>
                    </table>
                    <?php }else{
                      echo "<div class='alert alert-info' role='alert'>No se encontraron registros</div>";

                    } ?>
              </div>
          </div>
        </div>

        
      
     
          <!-- Modal categoryModal -->
          <div class="modal fade" id="categoryModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-body">
                  <div class="panel panel-primary">
                          <div class="panel-heading text-center">
                            <h3 class="panel-title">Carga de Horario</h3>
                          </div>
                          <div class="panel-body" style="overflow: auto;">
                            <div class="col-md-12 text-center">
                              <form action="" method="post" enctype="multipart/form-data">
                                  <label>Seleccionar La escuela</label>
                                  <select class="form-control" name="escuela" required="">
                                    <option value="" disabled="" selected="">Seleccionar Escuela</option>
                                    <?php
                                     foreach ($listaCategorias as $key => $value) {
                                       echo '<option value="'.$value['id_esc'].'"'.selected($value['id_esc'],$escuela).' >'.$value['des_esc'].'</option>';
                                      }
                                   ?>
                                  </select>
                                  <br>
                                  <label>Ingresa el Ciclo</label>
                                  <input type="text" name="ciclo" class="form-control" placeholder="Ciclo Ej. 1-2018" required="">
                                  <label>Seleccionar Archivo de Excel</label>
                                  <br>
                                  <input type="file" name="fichero_usuario" class="form-control" required="">
                                  <hr>
                                  <input type="submit" name="enviar" class="btn btn-primary btn-md">
                              </form>
                            </div>
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
    <script type="text/javascript">
      $('#escuela').change(function(event) {
        event.preventDefault();
        // guardamos el valor en una variable
        var escuela = $('#escuela').val();
        console.log("escuela", escuela);
        //enviamos los datos por post al archivo
   $.post(
      '../mostrar_ciclo/', {
         Escuela: escuela,
      },
      function(data) {
         $('#cuatrimestre').show('slow');
         $('#cuatrimestre').html(data);
      });
  });
    </script>

  </body>
</html>
