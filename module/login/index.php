<?php
function root_path(){$this_directory = dirname(__FILE__);$archivos=scandir($this_directory);$atras="";$cuenta=0;while(true){foreach($archivos as $actual){if($actual=="root.path"){if($cuenta==0)return "./";return $atras;}}$cuenta++;$atras=$atras."../";$archivos=scandir($atras);}}$nivel=root_path();//fin funcion nivel
require_once($nivel.'model/class.php');
require_once($nivel.'php/exit.php');
require_once($nivel.'php/user.php');

if ($totalRows_usuarios > 0) {
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
<body class="bg-image">
    
    <div id="login-overlay" class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Fechar</span></button>
              <h1 class="modal-title text-center" id="myModalLabel">Sistema CUVA</h1>
              <h3 class="modal-title text-center">Iniciar Sesión</h3>
              
        

          </div>
          <div class="modal-body">
              <div class="row">
                  <div class="col-sm-12 col-md-12">
                      <?php if(isset($_GET['error'])){ ?>
                      <div class="alert alert-warning" role="alert">Por Favor Verificar Usuario y Contraseña</div>
                      <?php } ?>
                      <div class="well">
                          <form id="loginForm" method="POST" action="login_action.php" novalidate="novalidate">
                              <div class="form-group">
                                  <label for="username" class="control-label">Nombre de Usuario</label>
                                  <input type="text" class="form-control" id="user" name="user" value="" required="" title="Please enter you username" placeholder="Usuario">
                                  <span class="help-block"></span>
                              </div>
                              <div class="form-group">
                                  <label for="password" class="control-label">Contraseña</label>
                                  <input type="password" class="form-control" id="pass" name="pass" value="" required="" title="Por Favor Ingrese Su Contraseña"  placeholder="Contraseña">
                                  <span class="help-block"></span>
                              </div>
                              
                              <div class="checkbox">
                                  <label>
                                      <input type="checkbox" name="recor" id="recor"> No cerrar sesión
                                  </label>
                                  <p class="help-block">(Si se trata de un ordenador personal)</p>
                              </div>
                              <button type="submit" class="btn btn-info btn-block">Entrar</button>
                              <!-- <button type="submit" class="btn btn-success btn-block">Entrar</button> -->
                          </form>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
</body>
</html>
