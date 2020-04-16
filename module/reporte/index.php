<?php
function root_path(){$this_directory = dirname(__FILE__);$archivos=scandir($this_directory);$atras="";$cuenta=0;while(true){foreach($archivos as $actual){if($actual=="root.path"){if($cuenta==0)return "./";return $atras;}}$cuenta++;$atras=$atras."../";$archivos=scandir($atras);}}$nivel=root_path();//fin funcion nivel
require_once($nivel.'model/class.php');
require_once($nivel.'php/exit.php');
require_once($nivel.'php/user.php');

/*/////////////////////////////carga///////////////////////////////*/

if (!empty($_GET['escuela'])) {
  @$escuela              = $_GET['escuela'];
  @$cuatrimestre         = $_GET['cuatrimestre'];

  $where    = ' WHERE `id_esc`='.$escuela.' AND `ciclo`= "'.$cuatrimestre.'"';

  $reporte  = system::EjecutarConsulta("reporte",$where);

}
/*////////////////////////////END/carga///////////////////////////////*/

/*////////////////////////////escuela///////////////////////////////*/
  $where     = ' WHERE `estado_esc`=1';
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
        
        <?php 
          ///////////////muestro las notificacion del email////////////////////////
          echo (!empty($_GET['msj']) AND $_GET['msj']== "email-enviado")? "<div class='alert alert-success' role='alert'>Notificación Enviada Correctamente</div>":"";

          echo (!empty($_GET['msj']) AND $_GET['msj']== "error-envio-email")? "<div class='alert alert-danger' role='alert'>Notificación No Enviada</div>":"";
         ?>

          <div class="panel">
            <div class="panel-body" style="overflow: auto;">
              <form action="../reporte/" method="get">
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
                        <option value="" disabled="" selected="">Seleccionar Trimestre</option>
                          <?php if (!empty($_GET['cuatrimestre'])):
                            echo '<option value="'.$_GET['cuatrimestre'].'" selected="">'.$_GET['cuatrimestre'].'</option>';
                          endif ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <button type="sumit" class="btn btn-success">Buscar</button>
                      
                    </div>
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
                          <th>Escuela</th>
                          <th>Facilitador</th>
                          <th></th>
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
                            <td><?php echo Dia($value['dia']);?></td>
                            <td><?php echo $value['hi']; ?></td>
                            <td><?php echo $value['hf']; ?></td>
                             <td><?php echo $value['carga_esc']; ?></td>

                            <!---///////////////////////////////END/proceso de asignacion/////////////-->

                            <td>
                              <?php echo system::NombreFacilitadores($value['id_faci']);?>
                            </td>
                            <td>
                           
                                </a>
                            </td>
                          </tr>

                          <!-- Modal categoryModal -->
                          <div class="modal fade" id="Editar<?=$value['id_carga']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-body">
                                  <div class="panel panel-primary">
                                          <div class="panel-heading text-center">
                                            <h3 class="panel-title">Actualizar Facilitador</h3>
                                          </div>
                                          <div class="panel-body" style="overflow: auto;">
                                            <div class="col-md-12 text-center">
                                              <form action="" method="post">
                                                 
                                                  <label>Ingresa el Nombre del Facilitador</label>
                                                  <input type="text" name="facilidor" class="form-control" placeholder="Ingresar Nombre de Facilitador" required="">
                                                  
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
                          <th>Escuela</th>
                          <th>Facilitador</th>
                          <th></th>
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
      '../reporte_ciclo/', {
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
