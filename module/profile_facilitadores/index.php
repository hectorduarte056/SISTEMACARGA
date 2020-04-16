<?php
function root_path(){$this_directory = dirname(__FILE__);$archivos=scandir($this_directory);$atras="";$cuenta=0;while(true){foreach($archivos as $actual){if($actual=="root.path"){if($cuenta==0)return "./";return $atras;}}$cuenta++;$atras=$atras."../";$archivos=scandir($atras);}}$nivel=root_path();//fin funcion nivel
require_once($nivel.'model/class.php');
require_once($nivel.'php/exit.php');
require_once($nivel.'php/user.php');

/*/////////////////////////////home page///////////////////////////////*/
if(!empty($_GET['facilitador'])){
    $id_faci          = $_GET['facilitador'];
    /*////////////////////Consultar Facilitador///////////////////////////*/
    $where            = " WHERE `id_faci`= '".$id_faci."'";
    $row_facilitador  = system::EjecutarConsulta('facilitadores',$where);
    
    //si el facilitador no existe
    if(empty($row_facilitador)){
      header("location:".$nivel);  
    }

    /*/////////////////////////////Consultar competencias///////////////////////////////*/
    $INNER            = "INNER JOIN compfacili on competencias.clave_comp = compfacili.clave_comp WHERE compfacili.id_faci ='".$id_faci."'";
    $row_competencias = system::EjecutarConsulta('competencias',$INNER);
    
    /*/////////////////////////////facili horario///////////////////////////////*/
    $where            = " WHERE `id_faci`= '".$id_faci."'";
    $row_horarios     = system::EjecutarConsulta('facilihorario',$where);

    /*////////////////////////////facili horario//////////////////////////////*/
    if(isset($_POST['dia'])){

          $dia                   = $_POST['dia'];
          $hi                    = $_POST['hi'];
          $hf                    = $_POST['hf'];

          $facilihorario           = Conexion::conectar()->prepare("INSERT INTO `facilihorario`(`id_faci`, `dia`, `hi`, `hf`) VALUES (?,?,?,?)");
          $facilihorario           ->execute(array($id_faci,$dia,$hi,$hf));
          header("refresh:0");
    }

    /*////////////////////////////Delete facili horario//////////////////////////////*/
    if(isset($_POST['id'])){

          $dia                   = $_POST['dia'];
          $hi                    = $_POST['hi'];
          $hf                    = $_POST['hf'];

          Conexion::conectar()->prepare("INSERT INTO `facilihorario`(`id_faci`, `dia`, `hi`, `hf`) VALUES (?,?,?,?)");
        
          header("refresh:0");
    }

    /*////////////////////////////Editar Facilitador///////////////////////////////*/
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
    header("Refresh:0");
    }
    
    /*////////////////////////////edit_img//////////////////////////////*/
    if (isset($_POST['form']) AND $_POST['form']== "insert_img") {
    
      $foto     = $_POST['old_img'];

      system::CargarImagen($foto,$id_faci);

      header("location:./".$id_faci); 

      }
   


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
     <!--///////////////////////END///java script///////////////////////////////-->
   
  </head>
  <body>
    <?php include($nivel."module/header/index.php"); ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                
                <div>
                  <!-- Nav tabs -->
                  <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#Datos_Generales" aria-controls="Datos Generales" role="tab" data-toggle="tab"><i class="fa fa-user" aria-hidden="true"></i> Datos Generales</a>
                    </li>
                      
                    <li role="presentation">
                        <a href="#Competencias" aria-controls="Datos Personales y Familiares" role="tab" data-toggle="tab"><i class="fa fa-medal" aria-hidden="true"></i> Competencias</a>
                    </li>
                 
                  </ul>

                  <!-- Tab panes -->
                  <div class="tab-content">
                   <!--///////////////////////Profile del facilitador////////////////////////-->
                    <div role="tabpanel" class="tab-pane active" id="Datos_Generales">
                        <div class="row">
                            <div class="col-md-4">
                                <hr>
                                    <a href="#" class="thumbnail">
                                     <?php if($row_facilitador[0]["img_faci"] != ""){ 
                                            $img = $nivel."module/banck_img/facilitador_".$id_faci."/".$row_facilitador[0]["img_faci"];
                                        }else{
                                            $img = $nivel."images/person.png";
                                        }                                       
                                        ?>
                                      <img src="<?php echo $img; ?>" height="250">
                                      
                                    </a>
                                    <p class="text-center">
                                        <label>
                                            <?php echo $row_facilitador[0]["nom_faci"]." ".$row_facilitador[0]["apell_faci"];?>
                                        </label>
                                        <a href="#" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#insert_img">
                                          <i class="fa fa-camera-retro" aria-hidden="true"></i> Insert Image
                                        </a>
                                     
                                    </p>
                            
                            
                            <!-- Modal Insert IMG -->
                            <div class="modal fade" id="insert_img" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Insert Image</h4>
                                  </div>
                                  <form action="" method="post" enctype="multipart/form-data" accept-charset="UTF-8">
                                    <div class="modal-body">
                                      <div class="row">
                                        <div class="col-md-12">
                                          <label>Imagen</label>
                                          <input type="file" name="imagen[]" value="" class="form-control">
                                        </div>
                                      </div>
                                    </div>
                                    <div class="modal-footer">
                                      <input type="hidden" name="form" value="insert_img">
                                      <input type="hidden" name="old_img" value="<?php echo $row_facilitador[0]["image"]; ?>">
                                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                      <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                  </form>
                                </div>
                              </div>
                            </div>
                           
                           
                            </div>
                            <div class="col-md-8">
                               <hr>
                                <div class="panel panel-primary">
                                    <div class="panel-heading text-center">
                                        <h3 class="panel-title">Datos Personales</h3>
                                    </div>
                                    <div class="panel-body">
                                        <table class="table table-striped">
                                                <tbody>
                                                    <tr>
                                                        <td><i class="fa fa-user"></i> Nombre</td>
                                                        <td><?php echo $row_facilitador[0]["nom_faci"]." ".$row_facilitador[0]["apell_faci"];?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><i class="fa fa-id-card"></i> Cédula</td>
                                                        <td><?php echo $row_facilitador[0]["ced_faci"];?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><i class="fa fa-calendar-alt"></i> Fecha de Nacimiento</td>
                                                        <td><?php echo fecha_normal($row_facilitador[0]["date_faci"]);?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><i class="fa fa-venus-mars"></i> Sexo</td>
                                                        <td><?php echo sexo($row_facilitador[0]["sex_faci"]);?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><i class="fa fa-street-view"></i> Estado Civil</td>
                                                        <td><?php echo estado_civil($row_facilitador[0]["est_civil_faci"]);?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><i class="fa fa-phone"></i> Teléfono</td>
                                                        <td><?php echo $row_facilitador[0]["tel_faci"];?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><i class="fa fa-phone"></i> Celular</td>
                                                        <td><?php echo $row_facilitador[0]["tel2_faci"];?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><i class="fa fa-phone"></i> Teléfono de Familiar</td>
                                                        <td><?php echo $row_facilitador[0]["tel3_faci"];?></td>
                                                    </tr>
                                                    
                                                    <tr>
                                                        <td><i class="fa fa-envelope"></i> Email</td>
                                                        <td><?php echo $row_facilitador[0]["email_faci"];?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><i class="fa fa-street-view"> Grado Académico</td>
                                                        <td><?php echo $row_facilitador[0]["ocupa_faci"];?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><i class="fa fa-map-signs"></i> Dirección</td>
                                                        <td><?php echo $row_facilitador[0]["direcc_faci"];?></td>
                                               
                                                        
                                                    
                                                    </tr>
                                                </tbody>
                                            </table>
                                    </div>
                                    <div class="panel-footer">
                                        <a href="" class="btn btn-warning" data-toggle="modal" data-target="#edit_profile">
                                            <i class="fa fa-user-edit"></i> Editar Perfil
                                        </a>
                                 </div>
                                    
                                <!-- ///////////////////////editar perfil //////////////////////////-->
                                <div class="modal fade" id="edit_profile" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                  <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">Editar Perfil De <?php echo $row_facilitador[0]["nom_faci"]; ?></h4>
                                      </div>
                                      <form method="post" action="" class="form-input" id="form3">
                                          <div class="modal-body">
                                                <div class="row">
                                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                                                <input type="text" name="name" value="<?php echo $row_facilitador[0]["nom_faci"];?>" id="name" size="32" placeholder="Nombre" class="form-control" required>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                                                <input type="text" name="last_name" value="<?php echo $row_facilitador[0]["apell_faci"];?>" id="last_name" size="32" placeholder="Apellido" class="form-control" required>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                                            <div class="input-group " id="class_ced">
                                                                <span class="input-group-addon"><i class="fa fa-id-card"></i></span>

                                                                <input type="text" name="cedula" value="<?php echo $row_facilitador[0]["ced_faci"];?>" id="cedula" size="32" placeholder="Cedula" autocomplete="OFF" onkeyup="mascara(this,'',patron3,true)" maxlength="13" class="form-control" required min="0">

                                                                <span class="input-group-addon" id="resp"><i class="fa fa-comment" aria-hidden="true"></i></span>

                                                            </div>
                                                        </div>

                                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><i class="fa fa-calendar-alt"></i></span>
                                                                <input type="date" name="fecha_n" value="<?php echo $row_facilitador[0]["date_faci"];?>"  placeholder="Fecha de Nacimiento" autocomplete="OFF" class="form-control" required>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><i class="fa fa-venus-mars"></i></span>
                                                                <select name="sex" class="form-control" required>
                                                                    <option disabled="disabled" selected="selected" value="0">Sexo</option>
                                                                    <option value="m" <?php echo selected('m',$row_facilitador[0]["sex_faci"]);?>>Masculino</option>
                                                                    <option value="f" <?php echo selected('f',$row_facilitador[0]["sex_faci"]);?>>Femenina</option>
                                                                    <option value="o" <?php echo selected('o',$row_facilitador[0]["sex_faci"]);?>>Otros</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                                           <div class="input-group">
                                                                <span class="input-group-addon"><i class="fa fa-street-view"></i></span>
                                                                <select name="estado_civil" class="form-control">
                                                                    <option disabled="disabled" selected="selected" value="0">Estado Civil</option>
                                                                    <option value="s" <?php echo selected('s',$row_facilitador[0]["est_civil_faci"]);?>>Soltero/a</option>
                                                                    <option value="p" <?php echo selected('p',$row_facilitador[0]["est_civil_faci"]);?>>Comprometido/a</option>
                                                                    <option value="c" <?php echo selected('c',$row_facilitador[0]["est_civil_faci"]);?>>Casado/a</option>
                                                                    <option value="d" <?php echo selected('d',$row_facilitador[0]["est_civil_faci"]);?>>Divorciado/a</option>
                                                                    <option value="v" <?php echo selected('v',$row_facilitador[0]["est_civil_faci"]);?>>Viudo/a</option>
                                                                </select>
                                                            </div>
                                                         </div>

                                                       
                                                        <div class="col-sm-12 col-md-4 col-lg-4">
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                                                <input type="tel" name="telefono" value="<?php echo $row_facilitador[0]["tel_faci"];?>" size="32" placeholder="Teléfono" autocomplete="OFF" onkeyup="mascara(this,'-',patron,true)" maxlength="12" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12 col-md-4 col-lg-4">
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                                                <input type="tel" name="telefono2" value="<?php echo $row_facilitador[0]["tel2_faci"];?>" size="32" placeholder="Teléfono" autocomplete="OFF" onkeyup="mascara(this,'-',patron,true)" maxlength="12" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12 col-md-4 col-lg-4">
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                                                <input type="text" name="telefono3" value="<?php echo $row_facilitador[0]["tel3_faci"];?>" size="32" placeholder="Teléfono" autocomplete="OFF" class="form-control">
                                                            </div>
                                                        </div>

                                                                               

                                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                                                <input type="text" name="email" value="<?php echo $row_facilitador[0]["email_faci"];?>" size="32" placeholder="Email" class="form-control">
                                                            </div>
                                                        </div>



                                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><i class="fa fa-street-view"></i></span>
                                                                <input type="text" name="ocupacion" value="<?php echo $row_facilitador[0]["ocupa_faci"];?>" size="32" placeholder="Grado Académico" class="form-control">
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><i class="fa fa-map-signs"></i></span>
                                                                <input type="text" name="address" value="<?php echo $row_facilitador[0]["direcc_faci"];?>" size="32" placeholder="Dirección" class="form-control">
                                                            </div>
                                                        </div>


                                                     
                                                        <br>
                                                        <br>

                                                        <div class="col-sm-12 col-md-12 col-lg-12 text-center">
                                                           <input type="hidden" name="id_faci" value="<?php echo $row_facilitador[0]["id_faci"];?>">
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
                                 <!-- /////////////////////END//editar perfil //////////////////////////-->    
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/////////////////////Competencias y horario////////////////////-->
                  
                    <div role="tabpanel" class="tab-pane" id="Competencias">
                        <div class="row">
                           <!--//////////////////////Competencias///////////////////////////////-->
                            <div class="col-md-6">
                                <hr>
                                <div class="panel panel-primary">
                                    <div class="panel-heading text-center">
                                        <h3 class="panel-title">Competencias</h3>
                                    </div>
                                    <div class="panel-body">
                                        <?php if(!empty($row_competencias)){?>

                                          <table class="table table-striped">
                                             <thead>
                                               <tr>
                                                 <th>Clave</th>
                                                 <th>Descripción</th>
                                                 <!--<th>Opciones</th>-->
                                               </tr>
                                             </thead>
                                             <tbody>
                                              <?php foreach ($row_competencias as $key => $value) { ?>
                                              
                                               <tr>
                                                 <td><?php echo $value['clave_comp']; ?></td>
                                                 <td><?php echo $value['desc_comp']; ?></td>
                                                 <!--
                                                 <td>
                                                   <a href="">Eliminar</a>
                                                 </td>
                                               -->
                                               </tr>

                                             <?php  } ?>
                                             </tbody>
                                           </table>
                                     
                                        
                                        <?php }else{
                                            echo '<div class="alert alert-info text-center">No se encontraron registros <a href="../competencias/'.$id_faci.'" class="btn btn-primary">Ingresar Datos Personales</a></div>';
                                                    
                                                }
                                        ?>                        
                                    </div>
                                    <?php if(!empty($row_competencias)){?>
                                    <div class="panel-footer">
                                        <a href="../competencias/<?php echo $id_faci;?>" class="btn btn-warning">
                                            <i class="fa fa-edit"></i> Actualizar Registros
                                        </a>
                                    </div>
                                    
                                 <?php } ?>
                                </div>
                            </div>


                            <!--//////////////////////Horario///////////////////////////////-->
                            <div class="col-md-6">
                                <hr>
                                <div class="panel panel-primary">
                                    <div class="panel-heading text-center">
                                        <h3 class="panel-title">Horario</h3>
                                        <span class="pull-right control">
                                            <a href="#" class="btn btn-success" data-toggle="modal" data-target="#AddHorario">
                                              <i class="fa fa-plus-circle" aria-hidden="true"></i> Agregar
                                            </a>
                                          </span>
                                    </div>
                                    <div class="panel-body">
                                        <?php if(!empty($row_horarios)){?>

                                          <table class="table table-striped">
                                             <thead>
                                               <tr>
                                                 <th>Dia</th>
                                                 <th>HI</th>
                                                 <th>HF</th>
                                                 <th>Opciones</th>
                                               </tr>
                                             </thead>
                                             <tbody>
                                              <?php foreach ($row_horarios as $key => $value) { ?>
                                              
                                               <tr>
                                                 <td><?php echo Dia($value['dia']); ?></td>
                                                 <td><?php echo $value['hi']; ?></td>
                                                 <td><?php echo $value['hf']; ?></td>
                                                 <td>
                                                   <a href="">Eliminar</a>
                                                 </td>
                                               </tr>

                                             <?php  }  ?>
                                             </tbody>
                                           </table>
                                     
                                        
                                        <?php }else{
                                            echo '<div class="alert alert-info text-center">No se encontraron registros</div>';
                                                    
                                                }
                                        ?>                        
                                    </div>
                                </div>
                            </div>


                                <!-- pass_new -->
                                <div class="modal fade" id="AddHorario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">Registrar Horario</h4>
                                      </div>
                                      <form method="post" action="" class="form-input">
                                          <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                                      <label>Día</label>
                                                       <div class="input-group">
                                                           <span class="input-group-addon"><i class="fa fa-calendar-alt" aria-hidden="true"></i></span>
                                                           <select name="dia" class="form-control">
                                                             <option value="1">Dom</option>
                                                             <option value="2">Lun</option>
                                                             <option value="3">Mar</option>
                                                             <option value="4">Mie</option>
                                                             <option value="5">Jue</option>
                                                             <option value="6">Vie</option>
                                                             <option value="7">Sáb</option>
                                                           </select>
                                                       </div>
                                                   </div>
                                                  <div class="col-sm-12 col-md-12 col-lg-12">
                                                        <label>HI</label>
                                                       <div class="input-group">
                                                           <span class="input-group-addon"><i class="fa fa-clock" aria-hidden="true"></i></span>
                                                           <input type="time" class="form-control" name="hi" placeholder="HI" required>
                                                       </div>
                                                   </div>
                                                   <div class="col-sm-12 col-md-12 col-lg-12">
                                                        <label>HF</label>
                                                       <div class="input-group">
                                                            <span class="input-group-addon">
                                                              <i class="fa fa-clock" aria-hidden="true"></i>
                                                            </span>
                                                            <input type="time" class="form-control" name="hf" placeholder="HF" required>
                                                       </div>
                                                   </div>
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
