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
  <body>
    <?php include($nivel."module/header/index.php"); ?>
    <section>
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <ol class="breadcrumb">
              <li><a href="<?php echo $nivel;?>">Inicio</a></li>
              <li><a href="../facilitadores/">Facilitadores</a></li>
              <li class="active">Registrar Facilitadores</li>
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
                        <h3 class="panel-title">Registrar Facilitadores</h3>
                    </div>
                    <div class="panel-body">
                    <form action="../reg_facilitadores/" method="post" name="form2" id="form2" class="form-input">
                        <div class="row">
                            <div class="col-sm-12 col-md-6 col-lg-6">
                               <label>Nombre</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input type="text" name="name" value="" id="name" size="32" placeholder="Nombre" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6 col-lg-6">
                               <label>Apellido</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input type="text" name="last_name" value="" id="last_name" size="32" placeholder="Apellido" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6 col-lg-6">
                               <label>Cédula</label>
                                <div class="input-group " id="class_ced">
                                    <span class="input-group-addon"><i class="fa fa-id-card"></i></span>
                                    <input type="text" name="cedula" value="" id="cedula" size="32" placeholder="Cédula" autocomplete="OFF" onkeyup="mascara(this,'',patron3,true)" maxlength="13" class="form-control" min="0">
                                    <span class="input-group-addon" id="resp"><i class="fa fa-comment" aria-hidden="true"></i></span>
                                    
                                </div>
                            </div>
                            
                            <div class="col-sm-12 col-md-6 col-lg-6">
                               <label>Fecha de Nacimiento</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-calendar-alt" aria-hidden="true"></i></span>
                                    <input type="date" name="date_n" value="" size="3" placeholder="Fecha de Nacimiento" autocomplete="OFF" class="form-control">
                                </div>
                            </div>
                            
                            <div class="col-sm-12 col-md-6 col-lg-6">
                               <label>Sexo</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-venus-mars" aria-hidden="true"></i></span>
                                    <select name="sex" class="form-control" required>
                                        <option disabled="disabled" selected="selected" value="0">Sexo</option>
                                        <option value="m">Masculino</option>
                                        <option value="f">Femenina</option>
                                        <option value="o">Otros</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-sm-12 col-md-6 col-lg-6">
                              <label>Estado Civil</label>
                               <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-street-view" aria-hidden="true"></i></span>
                                    <select name="estado_civil" class="form-control">
                                        <option disabled="disabled" selected="selected" value="0">Estado Civil</option>
                                        <option value="s">Soltero/a</option>
                                        <option value="p">Comprometido/a</option>
                                        <option value="c">Casado/a</option>
                                        <option value="d">Divorciado/a</option>
                                        <option value="v">Viudo/a</option>
                                    </select>
                                </div>
                             </div>
                            
                            <div class="col-sm-12 col-md-4 col-lg-4">
                               <label>Teléfono</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-phone" aria-hidden="true"></i></span>
                                    <input type="tel" name="telefono" value="" size="32" placeholder="Teléfono" autocomplete="OFF" onkeyup="mascara(this,'-',patron,true)" maxlength="12" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-4">
                               <label>Celular</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-phone" aria-hidden="true"></i></span>
                                    <input type="tel" name="telefono2" value="" size="32" placeholder="Celular" autocomplete="OFF" onkeyup="mascara(this,'-',patron,true)" maxlength="12" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-4">
                               <label>Teléfono de Familiar</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-phone" aria-hidden="true"></i></span>
                                    <input type="text" name="telefono3" value="" size="32" placeholder="Ej. Tio 000 000 0000" autocomplete="OFF" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6">
                               <label>Email</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-envelope" aria-hidden="true"></i></span>
                                    <input type="text" name="email" value="" size="32" placeholder="Email" class="form-control" required="">
                                </div>
                            </div>

                            

                            <div class="col-sm-12 col-md-6 col-lg-6">
                               <label>Grado Académico</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-briefcase"></i></span>
                                    <input type="text" name="ocupacion" value="" size="32" placeholder="Grado Académico" class="form-control">
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-12 col-lg-12">
                               <label>Dirección</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-map-signs" aria-hidden="true"></i></span>
                                    <input type="text" name="address" value="" size="32" placeholder="Dirección" class="form-control">
                                </div>
                            </div>



                            
                            <br>
                            <br>

                            <div class="col-sm-12 col-md-12 col-lg-12 text-center">
                                <button type="submit" class="btn btn-lg btn-success btn-block" id="sutmit_paciente">
                                    <i class="fa fa-floppy-o" aria-hidden="true"></i> Registrar Facilitador
                                </button>
                            </div>

                            <input type="hidden" name="MM_insert" value="form2">
                        </div>
                    </form>
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
