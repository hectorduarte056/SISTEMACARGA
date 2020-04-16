<?php
function root_path(){$this_directory = dirname(__FILE__);$archivos=scandir($this_directory);$atras="";$cuenta=0;while(true){foreach($archivos as $actual){if($actual=="root.path"){if($cuenta==0)return "./";return $atras;}}$cuenta++;$atras=$atras."../";$archivos=scandir($atras);}}$nivel=root_path();//fin funcion nivel
require_once($nivel.'model/class.php');
require_once($nivel.'php/exit.php');
require_once($nivel.'php/user.php');

/*/////////////////////////////carga///////////////////////////////*/

if (!empty($_GET['escuela'])) {
  @$escuela              = $_GET['escuela'];
  @$cuatrimestre         = $_GET['cuatrimestre'];

$where = ' WHERE `id_esc`='.$escuela.' AND `ciclo`= "'.$cuatrimestre.'"';

$reporte = system::EjecutarConsulta("reporte",$where);

}
/*////////////////////////////END/carga///////////////////////////////*/

/*////////////////////////////escuela///////////////////////////////*/
$where = ' WHERE `estado_esc`=1';
$listaCategorias = system::EjecutarConsulta("escuela",$where);
/*////////////////////////////END/escuela///////////////////////////////*/

//Eliminar carga
if (!(empty($_POST['escuela'])) AND !(empty($_POST['cuatrimestre']))) {
  $escuela         = $_GET['escuela'];
  $cuatrimestre    = $_GET['cuatrimestre'];

  $sql              = 'DELETE FROM `reporte` WHERE `id_esc`="'.$escuela.'" AND `ciclo`="'.$cuatrimestre.'"';
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
              <li class="active">Eliminar Reporte</li>
            </ol>
          </div>
        </div>
      </div>
    </section>
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
        
        <?php 
          ///////////////muestro las notificacion del email////////////////////////
          echo (!empty($_GET['msj']) AND $_GET['msj']== "email-enviado")? "<div class='alert alert-success' role='alert'>Notificación Enviada Correctamente</div>":"";

          echo (!empty($_GET['msj']) AND $_GET['msj']== "error-envio-email")? "<div class='alert alert-danger' role='alert'>Notificación No Enviada</div>":"";
         ?>

          <div class="panel">
            <div class="panel-body" style="overflow: auto;">
              <form action="" method="get">
                <div class="row">
                  <div class="col-md-4">
                      <select name="escuela" id="escuela" class="form-control">
                        <option value="" disabled="" selected="">Seleccionar Escuela</option>

                        <?php
                          foreach ($listaCategorias as $key => $value) {
                           echo '<option value="'.$value['id_esc'].'"'.selected($value['id_esc'],$escuela).' >'.$value['des_esc'].'</option>';
                          }
                        ?>
                      </select>
                  </div>
                  <div class="col-md-4">
                      <select name="cuatrimestre" id="cuatrimestre" class="form-control">
                        <option value="" disabled="" selected="">Seleccionar Cuatrimestre</option>
                          <?php if (!empty($_GET['cuatrimestre'])):
                            echo '<option value="'.$_GET['cuatrimestre'].'" selected="">'.$_GET['cuatrimestre'].'</option>';
                          endif ?>
                      </select>
                  </div>
                  <div class="col-md-4">
                    <button type="sumit" class="btn btn-success">Buscar</button>
                    <?php if (!empty($reporte)) { ?>
                    <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#EliminarReporte">
                      Borrar Todo El Contenido
                    </a>                  
                  <?php } ?>
                  </div>
                </div>
              </form>
            </div>
          </div>

         <!--////////////Mostramos Mensaje/////////-->
          <?php 
          if (isset($msj)) {          
            echo $msj;
          }?>
          
          <div class="panel panel-primary">
              <div class="panel-heading text-center">
                <h3 class="panel-title">Reporte de Horario </h3>
              </div>
              <div class="panel-body" style="overflow: auto;">

                    <?php if (!empty($reporte)) { ?>
                    <table class="table table-striped table-hover" id="example">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Clave</th>
                          <th>Descripción</th>
                          <th>Sección</th>
                          <th>Aula</th>
                          <th>Dia</th>
                          <th>Hi</th>
                          <th>Hf</th>
                          <th>Facilitador</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($reporte as $key => $value) { ?>

                          <tr>
                            <td><?php echo $value['id_carga']; ?></td>
                            <td><?php echo $value['clave_comp']; ?></td>
                            <td><?php echo ConsultarDescripAulas($value['clave_comp']); ?></td>
                            <td><?php echo $value['seccion']; ?></td>
                            <td><?php echo $value['aula']; ?></td>
                            <td><?php 
                           echo Dia($value['dia']);
                           //echo ClearString($row_home_reportes['dia']);
                            ?></td>
                            <td><?php echo $value['hi']; ?></td>
                            <td><?php echo $value['hf']; ?></td>
                            <td><?php echo $value['carga_esc']; ?></td>


                            <!---////////////////////////////////proceso de asignacion/////////////-->
                            <?php 
                            

                              //echo $row_idfs['id_faci'];

                              $msj = system::NombreFacilitadores($value['id_faci'] );
                            ?>
                            <!---///////////////////////////////END/proceso de asignacion/////////////-->

                            <td>
                              <?php echo $msj;

                              //if($row_home_reportes['id_faci'] != null){ echo 1;}else{ echo "Indefinido";} ?></td>
                          </tr>
                          
                        <?php }; ?>
                      </tbody>
                      <tfoot>
                        <tr>
                          <th>ID</th>
                          <th>Clave</th>
                          <th>Descripción</th>
                          <th>Sección</th>
                          <th>Aula</th>
                          <th>Dia</th>
                          <th>Hi</th>
                          <th>Hf</th>
                          <th>Facilitador</th>
                        </tr>
                      </tfoot>
                    </table>
                    <?php }else{
                      echo "<div class='alert alert-info' role='alert'>No se encontraron registros</div>";

                    } ?>
              </div>
          </div>
        </div>

        
      <div class="modal fade" id="EliminarReporte" tabindex="-1" role="dialog">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Eliminar Reporte</h4>
                  </div>
                  <div class="modal-body">
                    <div class="alert alert-danger">
                      <h5>Esta Seguro Que Desea Eliminar El Reporte<strong><?php echo $cuatrimestre;?></strong></h5>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <form action="" method="post">
                      <input type="hidden" name="escuela" value="<?php echo $escuela;?>">
                      <input type="hidden" name="cuatrimestre" value="<?php echo $cuatrimestre;?>">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-danger">Eliminar Carga</button>
                    </form>
                  </div>
                </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
     
          

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
    <script>
  $('#loading').on('click', function () {
    var $btn = $(this).button("loading")
    // business logic...
    //$btn.button('reset')
  })
</script>
      <script type="text/javascript">
      $('#escuela').change(function(event) {
        event.preventDefault();
        // guardamos el valor en una variable
        var escuela = $('#escuela').val();
        console.log("escuela", escuela);
        //enviamos los datos por post al archivo
   $.post(
      '../../reporte_ciclo/', {
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
