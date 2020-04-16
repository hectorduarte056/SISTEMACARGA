<?php if ($totalRows_usuarios === 0) { header("location:".$nivel."module/login");}?>

<header >
  
<!--   
   <img src="images/logo.jpg" width="300" height="150">   
  </div>
   -->


  <nav class="navbar navbar-default">
  <div class="bg-primary text-white">
    <!-- <div class="p-3 mb-2 bg-info text"> -->
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        
        <a class="navbar-brand" href="<?php echo $nivel;?>"style = "color:#FFFFFF">
        <i class="fas fa-address-card"></i> Sistema CUVA</a>
      </div>
     
      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <!--
        <ul class="nav navbar-nav">
          <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>
          <li><a href="#">Link</a></li>

        </ul>-->

        <ul class="nav navbar-nav navbar-right">
                    <!-- boton de inicio inactivado -->

          <!--    <li>
              <a href="<?php echo $nivel; ?>"
              style = "color:#FFFFFF">
                  <i class="fa fa-home"  aria-hidden="true"></i> Inicio
              </a>
            </li> -->
          <?php if ($totalRows_usuarios == 1) { ?>
            <li>
              <a href="<?php echo $nivel; ?>system/facilitadores/" style = "color:#FFFFFF">
                  <i class="fa fa-chalkboard-teacher" aria-hidden="true"></i>
                  Facilitadores
              </a>
            </li>
            
          <?php }?>
          <!-- system/carga/ -->
          <li><a href="<?php echo $nivel; ?>system/carga/" style = "color:#FFFFFF">
            <i class="fa fa-upload" aria-hidden="true"></i> Carga</a></li>
            <li><a href="<?php echo $nivel; ?>system/reporte/"style = "color:#FFFFFF"><i class="fa fa-file-alt" aria-hidden="true"></i> Reporte</a></li>
          <?php if ($totalRows_usuarios == 1) { ?>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" title="Bienvenido! <?php echo $row_usuarios['user_name']; ?>"style = "color:#FFFFFF"><i class=""></i> Bienvenido! <?php echo $row_usuarios['user_name'];?><b class="caret"></b></a>

              <ul class="dropdown-menu text-left menu-user" role="menu">

                <li><a href="<?php echo $nivel; ?>system/profile_user/"><i class="fa fa-address-card" aria-hidden="true"></i> Perfil</a></li>

                <?php if($_SESSION['MM_UserGroup']=='admin'){ ?>

                <li role="menuitem">
                  <a href="<?php echo $nivel; ?>system/admin/"><i class="fa fa-cogs" aria-hidden="true"></i> Administrar</a>
                </li>

                <?php }?>

                <li role="menuitem">
                  <a href="<?php echo $logoutAction ?>" class="hvr-shadow hvr-bounce-to-right" title="Sign off"><i class="fa fa-sign-out-alt"></i> Salir</a>
                </li>

              </ul>
            </li>


            <?php }else { ?>
            <li><a href="<?php echo $nivel; ?>module/login/">Login</a></li>
          <?php }  ?>
        </ul>
      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav>
  
</header>
