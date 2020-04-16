<?php
function root_path(){$this_directory = dirname(__FILE__);$archivos=scandir($this_directory);$atras="";$cuenta=0;while(true){foreach($archivos as $actual){if($actual=="root.path"){if($cuenta==0)return "./";return $atras;}}$cuenta++;$atras=$atras."../";$archivos=scandir($atras);}}$nivel=root_path();//fin funcion nivel
require_once($nivel.'model/class.php');
require_once($nivel.'php/exit.php');
require_once($nivel.'php/user.php');


/*/////////////////////////////home page///////////////////////////////*/
$row_facilitadores  = system::MostrarRegistro('facilitadores');
/*////////////////////////////END/home page///////////////////////////////*/

/*////////////////////////////Eliminar Facilitadores///////////////////////////////*/
(!empty($_POST['id_f']))? system::EliminarFacilitadores($_POST['id_f']) : "";

/*////////////////////////////Editar Facilitadores///////////////////////////////*/
if(isset($_POST["MM_insert"]) AND $_POST["MM_insert"] == "form2"){

 $datos = array("nom_faci"=>$_POST["name"],
                "apell_faci"=>$_POST["last_name"],
                "ced_faci"=>$_POST["cedula"],
                "date_faci"=>$_POST["fecha_n"],
                "sex_faci"=>$_POST["sex"],
                "tel_faci"=>$_POST["telefono"],
                "tel2_faci"=>$_POST["telefono2"],
                "tel3_faci"=>$_POST["telefono3"],
                "direcc_faci"=>$_POST["address"],
                "ocupa_faci"=>$_POST["ocupacion"],
                "est_civil_faci"=>$_POST["estado_civil"],
                "email_faci"=>$_POST["email"],
                "stado_faci"=>$_POST["stado_faci"],
                "id_faci"=>$_POST["id_faci"]);

system::EditarFacilitadores($datos);
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
    <?php include($nivel."module/header/index.php"); 
    ?>

    <section>
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <ol class="breadcrumb">
              <li><a href="<?php echo $nivel;?>">Inicio</a></li>
              <li class="active">Facilitadores</li>
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
                      <h3 class="panel-title">Facilitadores</h3>
                      <span class="pull-right control">
                        <a href="../add_facilitadores/" class="btn btn-success">
                          <i class="fa fa-plus-circle" aria-hidden="true"></i> Registrar Facilitador
                        </a>
                      </span>
                    </div>
                    <div class="panel-body" style="overflow: auto;">
                       <?php if (!empty($row_facilitadores)) { ?>
                    <table class="table table-striped table-hover" id="example">
                      <thead>
                        <tr>
                          <th>Clave</th>
                          <th>Nombre</th>
                          <th>Telefóno</th>
                          <th>Email</th>
                          <th>Cédula</th>
                          <th>Estado</th>
                          
                          
                          <?php if($_SESSION['MM_UserGroup']=='admin'){ ?><th>Opciones</th><?php } ?>
                         
                        </tr>
                      </thead>
                      
                      <tbody>
                        <?php foreach ($row_facilitadores as $key => $value) { ?>

                          <tr>
                            <td>
                              <a href="../profile/<?php echo $value['id_faci']; ?>">
                                <?php echo $value['id_faci']; ?>
                              </a>
                            </td>
                            <td>
                            <a href="../profile/<?php echo $value['id_faci']; ?>">
                                <?php echo $value['nom_faci']." ".$value['apell_faci']; ?>
                              </a>
                            </td>
                            <td><?php echo $value['tel_faci']; ?></td>
                            <td><?php echo $value['email_faci']; ?></td>
                            <td><?php echo $value['ced_faci']; ?></td>
                            <td><?php echo active($value['stado_faci']); ?></td>
                            
                            <?php if($_SESSION['MM_UserGroup']=='admin'){ ?>
                            <td>
                             <!--/////////btn group/////////////-->
                              <div class="btn-group" role="group">
                                <a href="#" class="btn btn-warning" title="Editar" data-toggle="modal" data-target="#editF<?php echo $value['id_faci']; ?>">
                                  <strong class="fa fa-edit"></strong>
                              

                              
                            </td>
                            <?php } ?>
                          </tr>
                            <?php if($_SESSION['MM_UserGroup']=='admin'){ ?>
                              <!-- ///////////////////////editar perfil //////////////////////////-->
                              <div class="modal fade" id="editF<?php echo $value['id_faci']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog modal-lg" role="document">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                          <h4 class="modal-title" id="myModalLabel">Editar Perfil De <?php echo $value["nom_faci"]." ".$value["apell_faci"];?></h4>
                                        </div>
                                        <form method="post" action="" class="form-input" id="form3">
                                            <div class="modal-body">
                                                  <div class="row">
                                                          <div class="col-sm-12 col-md-6 col-lg-6">
                                                              <div class="input-group">
                                                                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                                                  <input type="text" name="name" value="<?php echo $value["nom_faci"];?>" id="name" size="32" placeholder="Nombre" class="form-control" required>
                                                              </div>
                                                          </div>

                                                          <div class="col-sm-12 col-md-6 col-lg-6">
                                                              <div class="input-group">
                                                                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                                                  <input type="text" name="last_name" value="<?php echo $value["apell_faci"];?>" id="last_name" size="32" placeholder="Apellido" class="form-control" required>
                                                              </div>
                                                          </div>

                                                          <div class="col-sm-12 col-md-6 col-lg-6">
                                                              <div class="input-group " id="class_ced">
                                                                  <span class="input-group-addon"><i class="fa fa-id-card"></i></span>
                                                                  <input type="text" name="cedula" value="<?php echo $value["ced_faci"];?>" id="cedula" size="32" placeholder="Cedula" autocomplete="OFF" onkeyup="mascara(this,'',patron3,true)" maxlength="13" class="form-control" required min="0">
                                                                  <span class="input-group-addon" id="resp"><i class="fa fa-comment" aria-hidden="true"></i></span>

                                                              </div>
                                                          </div>

                                                          <div class="col-sm-12 col-md-6 col-lg-6">
                                                              <div class="input-group">
                                                                  <span class="input-group-addon"><i class="fa fa-calendar-alt" aria-hidden="true"></i></span>
                                                                  <input type="date" name="fecha_n" value="<?php echo $value["date_faci"];?>"  placeholder="Fecha de Nacimiento" autocomplete="OFF" class="form-control" required>
                                                              </div>
                                                          </div>

                                                          <div class="col-sm-12 col-md-6 col-lg-6">
                                                              <div class="input-group">
                                                                  <span class="input-group-addon"><i class="fa fa-venus-mars" aria-hidden="true"></i></span>
                                                                  <select name="sex" class="form-control" required>
                                                                      <option disabled="disabled" selected="selected" value="0">Sexo</option>
                                                                      <option value="m" <?php echo selected('m',$value["sex_faci"]);?>>Masculino</option>
                                                                      <option value="f" <?php echo selected('f',$value["sex_faci"]);?>>Femenina</option>
                                                                      <option value="o" <?php echo selected('o',$value["sex_faci"]);?>>Otros</option>
                                                                  </select>
                                                              </div>
                                                          </div>

                                                          <div class="col-sm-12 col-md-6 col-lg-6">
                                                             <div class="input-group">
                                                                  <span class="input-group-addon"><i class="fa fa-street-view" aria-hidden="true"></i></span>
                                                                  <select name="estado_civil" class="form-control">
                                                                      <option disabled="disabled" selected="selected" value="0">Estado Civil</option>
                                                                      <option value="s" <?php echo selected('s',$value["est_civil_faci"]);?>>Soltero/a</option>
                                                                      <option value="p" <?php echo selected('p',$value["est_civil_faci"]);?>>Comprometido/a</option>
                                                                      <option value="c" <?php echo selected('c',$value["est_civil_faci"]);?>>Casado/a</option>
                                                                      <option value="d" <?php echo selected('d',$value["est_civil_faci"]);?>>Divorciado/a</option>
                                                                      <option value="v" <?php echo selected('v',$value["est_civil_faci"]);?>>Viudo/a</option>
                                                                  </select>
                                                              </div>
                                                           </div>

                                                         
                                                          <div class="col-sm-12 col-md-4 col-lg-4">
                                                              <div class="input-group">
                                                                  <span class="input-group-addon"><i class="fa fa-phone" aria-hidden="true"></i></span>
                                                                  <input type="tel" name="telefono" value="<?php echo $value["tel_faci"];?>" size="32" placeholder="Teléfono" autocomplete="OFF" onkeyup="mascara(this,'-',patron,true)" maxlength="12" class="form-control">
                                                              </div>
                                                          </div>
                                                          <div class="col-sm-12 col-md-4 col-lg-4">
                                                              <div class="input-group">
                                                                  <span class="input-group-addon"><i class="fa fa-phone" aria-hidden="true"></i></span>
                                                                  <input type="tel" name="telefono2" value="<?php echo $value["tel2_faci"];?>" size="32" placeholder="Teléfono" autocomplete="OFF" onkeyup="mascara(this,'-',patron,true)" maxlength="12" class="form-control">
                                                              </div>
                                                          </div>
                                                          <div class="col-sm-12 col-md-4 col-lg-4">
                                                              <div class="input-group">
                                                                  <span class="input-group-addon"><i class="fa fa-phone" aria-hidden="true"></i></span>
                                                                  <input type="text" name="telefono3" value="<?php echo $value["tel3_faci"];?>" size="32" placeholder="Teléfono" autocomplete="OFF" class="form-control">
                                                              </div>
                                                          </div>

                                                                                 

                                                          <div class="col-sm-12 col-md-6 col-lg-6">
                                                              <div class="input-group">
                                                                  <span class="input-group-addon"><i class="fa fa-envelope" aria-hidden="true"></i></span>
                                                                  <input type="text" name="email" value="<?php echo $value["email_faci"];?>" size="32" placeholder="Email" class="form-control">
                                                              </div>
                                                          </div>



                                                          <div class="col-sm-12 col-md-6 col-lg-6">
                                                              <div class="input-group">
                                                                  <span class="input-group-addon"><i class="fa fa-street-view"></i></span>
                                                                  <input type="text" name="ocupacion" value="<?php echo $value["ocupa_faci"];?>" size="32" placeholder="Grado Académico" class="form-control">
                                                              </div>
                                                          </div>

                                                          <div class="col-sm-12 col-md-12 col-lg-12">
                                                              <div class="input-group">
                                                                  <span class="input-group-addon"><i class="fa fa-map-signs" aria-hidden="true"></i></span>
                                                                  <input type="text" name="address" value="<?php echo $value["direcc_faci"];?>" size="32" placeholder="Dirección" class="form-control">
                                                              </div>
                                                          </div>

                                                          <div class="col-sm-12 col-md-6 col-lg-6">
                                                          <div class="input-group">
                                                               <label>Estado</label>
                                                                  <select name="stado_faci" id="" class="input-group">
                                                                   <option value="0" <?=selected($value['stado_faci'],0); ?>>Desactivado</option>
                                                                  <option value="1" <?= selected($value['stado_faci'],1); ?>>Activado</option>
                                                                            
                                                                           
                                                                      
                                                                  </select>
                                                              </div>
                                                           </div>



                                                          <br>
                                                          <br>

                                                          <div class="col-sm-12 col-md-12 col-lg-12 text-center">
                                                             <input type="hidden" name="id_faci" value="<?php echo $value["id_faci"];?>">
                                                             <input type="hidden" name="MM_insert" value="form2">
                                                              <button type="submit" class="btn btn-lg btn-success btn-block" id="sutmit_facilitador">
                                                                  <i class="fa fa-floppy-o" aria-hidden="true"></i> Actualizar Datos
                                                              </button>
                                                          </div>
                                                  </div>
                                            </div>
                                        </form>
                                      </div>
                                    </div>
                              </div>

                              <!-- Eliminar Facilitadores -->
                              <div class="modal fade" id="delF<?php echo $value['id_faci']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                      <h4 class="modal-title" id="myModalLabel">Eliminar Facilitador: <?php echo $value['nom_faci']." ".$value['apell_faci']; ?></h4>
                                    </div>
                                    <form method="post" action="" class="form-input">
                                        <div class="modal-body">
                                              <div class="row">
                                                <div class="col-sm-12 col-md-12 col-lg-12">
                                                    <div class="alert alert-info" role="alert">
                                                     <strong>Advertencia!</strong> Esta Seguro Que Desea Eliminar A  <?php echo $value['nom_faci']." ".$value['apell_faci']; ?>.
                                                    </div>
                                                 </div>
                                                
                                                <input type="hidden" name="id_f" value="<?php echo $value['id_faci']; ?>">
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

                          
                        <?php }
                         } 
                         ?>
                      </tbody>
                      <tfoot>
                        <tr>
                          <th>Clave</th>
                          <th>Nombre</th>
                          <th>Telefóno</th>
                          <th>Email</th>
                          <th>Cédula</th>
                          <th>Estado</th>

                         <?php if($_SESSION['MM_UserGroup']=='admin'){ ?> <th>Opciones</th>  <?php }?>
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

  </body>
</html>
