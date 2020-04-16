<?php
//contrasena con seguridad SALT
$salt = "@#$%&aBc2016XYZ?!+-*/";

//consultar aulas
  function ConsultarEmail($id){
    
    $facilitadore             = Conexion::conectar()->prepare("SELECT `email_faci` FROM `facilitadores` WHERE `id_faci`=?");
    $facilitadore             ->execute(array($id));
    $facilitadores            = $facilitadore->fetchAll(PDO::FETCH_ASSOC);
    $totalRows_facilitadores  = count($facilitadores);
    $row_facilitadores        = array_shift($facilitadores);

    return $row_facilitadores['email_faci'];
    
  }

/////////////////////////Consultar si la Clave esta disponible
 function ConsultarAulas($ciclo,$dia,$hi,$hf,$aula){
//SELECT count(`dia`) AS total FROM `reporte` WHERE `dia`=7 AND (`hi` BETWEEN '12:00:00' AND '14:00:00') AND (`hf` BETWEEN '12:00:00' AND '14:00:00') AND `aula`='D-INF-05'
  $ConsulReport              = Conexion::conectar()->prepare("SELECT count(dia) AS total FROM `reporte` WHERE `ciclo`=? AND`dia`=? AND (`hi` BETWEEN ? AND ?) AND (`hf` BETWEEN ? AND ?) AND `aula`=?");
  $ConsulReport              ->execute(array($ciclo,$dia,$hi,$hf,$hi,$hf,$aula));
  $ConsulReportes            = $ConsulReport->fetchAll(PDO::FETCH_ASSOC);
  $totalRows_ConsulReportes  = count($ConsulReportes);
  $row_ConsulReportes        = array_shift($ConsulReportes);

  return  $row_ConsulReportes['total'];
 }


 //inserto si esta disponible el facilitador 
  function InsertarRegistos($idcarca,$id_esc,$ciclo,$clave,$seccion,$aula,$dia,$hi,$hf,$carga_esc,$id_faci){
    $InsertReport = Conexion::conectar()->prepare("INSERT INTO `reporte`(`id_esc`, `ciclo`,`id_carga`, `clave_comp`, `seccion`, `aula`, `dia`, `hi`, `hf`,`carga_esc`, `id_faci`) VALUES (?,?,?,?,?,?,?,?,?,?,?)");
    $InsertReport ->execute(array($id_esc,$ciclo,$idcarca,$clave,$seccion,$aula,$dia,$hi,$hf,$carga_esc,$id_faci));
  }


  //consultar aulas
  function ConsultarDescripAulas($clave){
    
    $competencia         = Conexion::conectar()->prepare("SELECT * FROM `competencias` WHERE `clave_comp`=?");
    $competencia         ->execute(array($clave));
    $competencias        = $competencia->fetchAll(PDO::FETCH_ASSOC);
    $totalRows_competencias  = count($competencias);
    $row_competencias    = array_shift($competencias);

    if ($totalRows_competencias > 0) {

      $msj = $row_competencias['desc_comp']; 
    } else {
      $msj = "<label class='label label-info'>No Registrado</label>";
    }
    return $msj;
    
  }




//////////////////////////////////SEXO
function sexo($sex){
    switch ($sex) {
    case "m":
        echo "Masculino";
        break;
    case "f":
        echo "Femenina";
        break;
    case "o":
        echo "Otros";
        break;
    }
}

//////////////////////////////////Limpiar string
function ClearString($string){
   $text = ltrim($string);
   $text = rtrim($text);
   $text = mb_strtoupper($text,'utf-8');
   return $text;
}

/////////////////////////Asignar numero del dia
function Dia($dia){
$array = array(
              1=>"Dom",2=>"Lun",3=>"Mar",4=>"Mie",5=>"Jue",6=>"Vie",7=>"Sáb"
            );
     return $array[ClearString($dia)];
}

//////////////////////////////////Asignar numero del dia
function NumDia($dia){
$array = array(
              "DOM"=>1,"LUN"=>2,"MAR"=>3,"MIE"=>4,"MIÉ"=>4,"JUE"=>5,"VIE"=>6,"SÁB"=>7,"SAB"=>7,"S?B"=>7
              );
     return $array[ClearString($dia)];
}

/////////////////////////Consultar si la Clave esta disponible
 function ConsultarClave($clave_comp,$id_faci){
   $claves        = Conexion::conectar()->prepare("SELECT count(clave_comp) AS clave FROM `competencias` WHERE `clave_comp`= ?");
   $claves        ->execute(array($clave_comp));
   $clave         = $claves->fetchAll(PDO::FETCH_ASSOC);
   $row_clave     = array_shift($clave);
   

   if ($row_clave['clave'] == 1) {
     
     $compfacili        = Conexion::conectar()->prepare("SELECT count(clave_comp) AS comp FROM `compfacili` WHERE `id_faci`=? AND `clave_comp`=?");
     $compfacili        ->execute(array($id_faci,$clave_comp));
     $compfacilis       = $compfacili->fetchAll(PDO::FETCH_ASSOC);
     $row_compfacilis   = array_shift($compfacilis);

     

       if ($row_compfacilis['comp'] == 0) {
         return 3;//la clave se puede registrar
       }else {
        return 2;//la clave ya esta asignada al facilitador
       } 
     

     } else {
       return 1;//la clave ingresada no existe
     }
   
  }

  /////////////////////////Consultar si la Clave esta disponible
 function VerificarClave($clave_comp){
   $claves        = Conexion::conectar()->prepare("SELECT count(clave_comp) AS clave FROM `competencias` WHERE `clave_comp`= ?");
   $claves        ->execute(array($clave_comp));
   $clave         = $claves->fetchAll(PDO::FETCH_ASSOC);
   $row_clave     = array_shift($clave);
   

   if ($row_clave['clave'] > 0) {
     
      return 0;//la clave ingresada no existe

     } else {
       return 1;//la clave ingresada existe
     }
   
  }
  
//////////////////////////////////SEXO
function control($control){
    switch ($control) {
    case "admin":
        echo "Administrador";
        break;
    case "user":
        echo "Usuario";
        break;
    }
}
//////////////////////////////////Si O NO
function stado($stado){
    switch ($stado) {
    case "s":
        echo "Si";
        break;
    case "n":
        echo "No";
        break;
    }
}
//////////////////////////////////Si O NO
function active($active){
    switch ($active) {
    case "1":
        echo "<label class='label label-success'>Disponible</label>";
        break;
    case "0":
        echo "<label class='label label-warning'>No Disponible</label>";
        break;
    }
}

//////////////////////////////////Estado Civil
function estado_civil($estado_civil){
    switch ($estado_civil) {
    case "s":
        echo "Soltero/a";
        break;
    case "p":
        echo "Comprometido/a";
        break;
    case "c":
        echo "Casado/a";
        break;
     case "d":
        echo "Divorciado/a";
        break;
     case "v":
        echo "Viudo/a";
        break;
    }
}
/*///////////////////////////////////Funcion para la fecha//////////////////////////////////*/
function fecha($fecha){
$fecha = strtotime($fecha);
$dias = array("Dom","Lun","Mar","Mie","Jue","Vie","Sáb");
$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
//echo $dias[date('w')]." ".date('d').", ".$meses[date('n')-1]. " ".date('Y') ;
//Salida: Viernes 24 de Febrero del 2012
$fecha_1 = $dias[date('w',$fecha)]." ".date('d',$fecha).", ".$meses[date('n',$fecha)-1]." ".date('Y',$fecha)." ".date('g:i A',$fecha);

return $fecha_1;

}

/*///////////////////////////////////Funcion para la fecha//////////////////////////////////*/
function fecha_normal($fecha_norm){
    $date_n = date_create($fecha_norm);
    $fecha_normal =date_format($date_n, 'd/m/Y');
    
return $fecha_normal;

}


/*///////////////////////////////////Funcion para la fecha AM PM//////////////////////////////////*/
function fecha_AM_PM($fecha_norm){
    $date_n = date_create($fecha_norm);
    $fecha_normal =date_format($date_n, 'Y-m-d H:i');

return $fecha_normal;

}
//////////////////////////////////comprobar_nombre_usuario
function comprobar_nombre_usuario($nombre_usuario){

  $usuario_problem   = Conexion::conectar()->prepare("SELECT * FROM `user` WHERE `user_name`=?");
  $usuario_problem   ->execute(array($nombre_usuario));
  $usuario_problems  = $usuario_problem->fetchAll(PDO::FETCH_ASSOC);
  $totalRows_usuario = count($usuario_problems);

  if ($totalRows_usuario > 0) {
    echo 0;
    return 0;
  }else {


   //compruebo que el tamaño del string sea válido.
   if (strlen($nombre_usuario)<3 || strlen($nombre_usuario)>30){
      echo 0;
      return 0;
   }

   //compruebo que los caracteres sean los permitidos
   $permitidos = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789-_";
   for ($i=0; $i<strlen($nombre_usuario); $i++){
      if (strpos($permitidos, substr($nombre_usuario,$i,1))===false){
         echo 0;
         return 0;
      }
   }
   echo 1;
   return 1;
  }
}
/////////////////////////////////END/comprobar_nombre_usuario

//////////////////////////////////comprobar_email
function comprobar_email($email){
  //compruevo si el campo email es un E-mail valido
  if(!preg_match("/^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/",$email)){
    echo 0;
    return 0;
  }else {

    $email_problem   = Conexion::conectar()->prepare("SELECT * FROM `user` WHERE `email`=?");
    $email_problem   ->execute(array($email));
    $email_problems  = $email_problem->fetchAll(PDO::FETCH_ASSOC);
    $totalRows_email = count($email_problems);

    if ($totalRows_email > 0) {
      echo 0;
      return 0;
    }else {
      echo 1;
      return 1;
    }
  }
}
/////////////////////////////////END/comprobar_email
//funcion comprovar si tiene caracteres rarros y si es menor a 6 o mayor a 20, Usando las funciones de tratamiento de string de PHP
function comprobar_caracteres_pass($pass){
   //compruebo que el tamaño del string sea valido.
   if (strlen($pass)<6 || strlen($pass)>20){
     echo 0;
    return false;
   }
   //compruebo que los caracteres sean los permitidos
   $permitidos = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789-_.";
   for ($i=0; $i<strlen($pass); $i++){
    if (strpos($permitidos, substr($pass,$i,1))===false){
     echo 0;
     return false;

    }
   }
   echo 1;
   return true;
}//fin de //funcion comprovar

//function de hora
$Hora = Time(); // Hora actual
//function que calcula el tiempo
function tiempo_de_espera ($var){

    switch ($var){
        case "seconds":
            $var=1;
            break;
        case "minutes":
            $var=60;
            break;
        case "hours":
            $var=3600;
            break;
        case "days":
            $var=86400;
            break;
    }
    return $var;
}
function iniciar_session ($user_id,$user,$session_error,$recor,$page_home){
    //declaro las 2 variables de sessiones para el user
    $_SESSION['MM_Username']  =$user;//creo la session del user
    $_SESSION['MM_Userid']    =$user_id;//creo la session del user id
    //$_SESSION['MM_UserGroup'] =$grou;//creo la session del grupo al que pertenece el user
    //pregunto si el user tenia intentos fallidos
    if($session_error > 0){
        //actualizo los campos session_error, date_session y session_lock
        $sql            = "UPDATE user SET session_error= ?, date_session= ?, session_lock= ? WHERE user_id= ?";
        $session_susses = Conexion::conectar()->prepare($sql);
        $session_susses ->execute(array(
                                        0,
                                        NULL,
                                        0,
                                        $user_id
                                        ));
    }
    if($recor==1){
        //si $recor = 1 es que el user quiere ser recordado
        $caduca         = time()+(365*24*60*60);
        $id_encript     = encrypt($user_id);
        $nombre_encript = encrypt($user);
        $cookie_id      = encrypt("idreyorder");
        $cookie_user    = encrypt("userreyorder");
        setcookie( $cookie_id, $id_encript, $caduca, $page_home );
        setcookie( $cookie_user, $nombre_encript, $caduca, $page_home );
    }
    //redirijo la pagina donde hise el login
    if(isset($_SESSION['PrevUrl']) && false){
        $MM_redirectLoginSuccess=$_SESSION['PrevUrl'];
    }
    //si los datos son corecto redireciona a la pagina donde hisiste el login
    header("Location:".getenv('HTTP_REFERER'));
    exit();
    return;
}
//si el inicio de session es denegado
function iniciar_session_error($failed){
    header("Location:".$failed);
    exit();
    return;
}
require_once('encryption_config.php');
function encrypt($string) {
    $output = FALSE;
    $key = hash('sha256', SECRET_KEY);
    $iv = substr(hash('sha256', SECRET_IV), 0, 16);

    $output = openssl_encrypt($string, METHOD, $key, 0, $iv);
    $output = base64_encode($output);

    return $output;
}
//desencriptar
function decrypt($string) {
    $key = hash('sha256', SECRET_KEY);
    $iv = substr(hash('sha256', SECRET_IV), 0, 16);

    $output = openssl_decrypt(base64_decode($string), METHOD, $key, 0, $iv);
    return $output;
}

 
 
    /////////////////////////Activar option en select
    function selected($category,$get){
           $selected = ($category == $get) ? "selected='selected'" : "";

         return $selected;
     }


  ////////////////////////mostrar lo que sigue despues de una letra o valor indicado.. 
   function after ($text, $inthat)
    {
        if (!is_bool(strpos($inthat, $text)))
        return substr($inthat, strpos($inthat,$text)+strlen($text));
    };
////////////////////////mostrar lo que ante de una letra o valor indicado..  muestra 
    function before ($text, $inthat)
    {
        return substr($inthat, 0, strpos($inthat, $text));
    };
/*///////////////////////////////////Funcion para crear carpeta//////////////////////////////////*/
function crear_carpeta($carpeta){
  if (!file_exists($carpeta)) {
      mkdir($carpeta, 0777, true);
  }
 }
/*///////////////////////////////////Funcion para listar todos los archivos zip de una carpeta//////////////////////////////////*/
function listar_archivos($carpeta){
    if(is_dir($carpeta)){
        if($dir = opendir($carpeta)){
            $carpeta = "../../../module/admin/backup_bd/bd";
            while(($archivo = readdir($dir)) !== false){
                if($archivo != '.' && $archivo != '..' && $archivo != '.htaccess' && substr($archivo,-4)==".zip"){
                    echo '<a class="list-group-item" target="_blank" href="'.$carpeta.'/'.$archivo.'">'.$archivo.' <i class="fa fa-download" aria-hidden="true"></i></a>';

                }
            }
            closedir($dir);
        }
    }
        
}

####
## Función para redimencionar las imágenes
## utilizando las liberías de GD de PHP
####

function resizeImagen($ruta, $nombre, $alto, $ancho,$nombreN,$extension){
    $rutaImagenOriginal = $ruta.$nombre;
    if($extension == 'GIF' || $extension == 'gif'){
    $img_original = imagecreatefromgif($rutaImagenOriginal);
    }
    if($extension == 'jpg' || $extension == 'JPG' || $extension == 'jpeg'){
    $img_original = imagecreatefromjpeg($rutaImagenOriginal);
    }
    if($extension == 'png' || $extension == 'PNG'){
    $img_original = imagecreatefrompng($rutaImagenOriginal);
    }
    $max_ancho = $ancho;
    $max_alto = $alto;
    list($ancho,$alto)=getimagesize($rutaImagenOriginal);
    $x_ratio = $max_ancho / $ancho;
    $y_ratio = $max_alto / $alto;
    if( ($ancho <= $max_ancho) && ($alto <= $max_alto) ){//Si ancho 
  	$ancho_final = $ancho;
		$alto_final = $alto;
	} elseif (($x_ratio * $alto) < $max_alto){
		$alto_final = ceil($x_ratio * $alto);
		$ancho_final = $max_ancho;
	} else{
		$ancho_final = ceil($y_ratio * $ancho);
		$alto_final = $max_alto;
	}
    $tmp=imagecreatetruecolor($ancho_final,$alto_final);
    imagecopyresampled($tmp,$img_original,0,0,0,0,$ancho_final, $alto_final,$ancho,$alto);
    imagedestroy($img_original);
    $calidad=70;
    imagejpeg($tmp,$ruta.$nombreN.".jpg",$calidad);
    
}

////////////////////////borrar directorio con archivos
function eliminarDir($carpeta)
    {
        foreach(glob($carpeta . "/*") as $archivos_carpeta)
        {
            //echo $archivos_carpeta;

            if (is_dir($archivos_carpeta))
            {
                eliminarDir($archivos_carpeta);
            }
            else
            {
                unlink($archivos_carpeta);
            }
        }

        rmdir($carpeta);
    }
?>
