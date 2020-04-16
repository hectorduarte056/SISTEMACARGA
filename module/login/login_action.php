<?php
function root_path(){$this_directory = dirname(__FILE__);$archivos=scandir($this_directory);$atras="";$cuenta=0;while(true){foreach($archivos as $actual){if($actual=="root.path"){if($cuenta==0)return "./";return $atras;}}$cuenta++;$atras=$atras."../";$archivos=scandir($atras);}}$nivel=root_path();//fin funcion nivel

require_once($nivel.'model/class.php');

include($nivel."php/user.php");
//**************************** Sistema de login normal por formulario *************************************
if(!isset($_SESSION)){
    session_start();
}
//compruevo si se ha iniciado sesion.
$loginFormAction = $_SERVER['PHP_SELF'];
if(isset($_GET['accesscheck'])){
    $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}
//si el campo * user * es rellenado en el formulario de login y enviados por POST que haga estas comprobaciones.
if(isset($_POST['user'])){
    //la variable $salt y las funciones de session esta definida en el archivo funtion_for_user.php, que a su vez esta requerido en el archivo user.php
    $loginUsername           =$_POST['user'];
    $pass_concat             =$salt.$_POST['pass'];
    $password                =sha1(md5($pass_concat));
    if(isset($_POST['recor'])){
        if($_POST['recor']=="activo"){
            $recor = 1;
        }else
            {
                $recor = NULL;
            }
    }else
        {
            $recor = NULL;
        }
    $MM_fldUserAuthorization ="control";//este determina a que grupo pertenece el user que acaba de iniciar seccion.
    $MM_redirectLoginSuccess ="";
    $MM_redirectLoginFailed  =$nivel."module/login/?error";//si algun campo contiene errores entonces te manda a esta pagina
    $MM_redirecttoReferrer   =false;

    if(!preg_match("/^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/",$loginUsername)){
        //si no es un email
        $Login="SELECT * FROM user WHERE user_name= ?";
        $preg_match =1;
    }
    else
        {
            //si es un email
            $Login="SELECT * FROM user WHERE email= ?";
            $preg_match =2;
        }
    //compruevo si el user o el email estan en la BD
    $statement = Conexion::conectar()->prepare($Login);
    $statement ->execute(array($loginUsername));
    $result    = $statement->fetchAll(PDO::FETCH_ASSOC);
    $total     = count($result);
    $row_login = array_shift($result);
    //variables a usar
    $user_id        =$row_login['user_id'];
    $user_name      =$row_login['user_name'];
    $contrasena     =$row_login['password'];
    $statu          =$row_login['statu'];
    $session_error  ="";//$row_login['session_error']
    $date_session   ="";//$row_login['date_session']
    $session_lock   ="";//$row_login['session_lock']
    //$group          =$row_login['control'];
    //si se encontro un user, es por que los datos introduccidos son correctos
    if($total > 0){
        //compruevo si el (user o email) Y la contrasena concuerdan
        if($contrasena==$password){
            //si la cuenta esta activa
            if($statu==1){
                //obtengo la hora actual
                $Hora        = Time();//time me da la hora del servidor
                $hora_actual = date('Y-m-d H:i:s',$Hora);
                //si el user no tiene la session bloqueda, O
                //si la cuenta esta bloqueada y ha pasado el tiempo de espera puede entrar
                if(($date_session == NULL) OR ($date_session < $hora_actual)){
                     //la function iniciar_session esta definida en funtion_for_user.php
                    //inicio session
                    iniciar_session ($user_id,$user_name,$session_error,$recor,$page_home);
                }else
                    {
                    //si tiene la session bloqueada
                    //si la fecha de bloqueo es mayor, no lo dejo pasar y le digo cuanto tiempo le queda bloqueada
                    $dt1   = new DateTime($date_session);
                    $dt2   = new DateTime($hora_actual);
                    $falta = $dt1->diff($dt2);
                    $a     = $falta->format('%a');
                    $h     = $falta->format('%h');
                    $i     = $falta->format('%i');
                    $s     = $falta->format('%s');
                    //$falta ->format('quedan %a dias %h horas %i minuto(s) %s segundo(s)');
                    //si la cuenta esta bloqueada y no ha pasado el tiempo de espera
                    $_SESSION['login_lock']="Account blocked, remaining time to unlock ( " .$a." Dais ".$h." Hours ".$i." Minutes ".$s." seconds )";
                    //creo la session de error
                    iniciar_session_error($MM_redirectLoginFailed);
                    }
            }
            else
                {
                    //si la cuenta no esta activa
                    $_SESSION['login_disabled']="Account temporarily disabled";//creo la session de error
                    iniciar_session_error($MM_redirectLoginFailed);
                }
        //si el (user o email) Y la contrasena no concuerdan
        }
        else
            {
                /*
                //SQL para sacar el maximo numero de inteto permitido
                $sql_max       = 'SELECT * FROM max_attempts';
                $max_attempts  = Conexion::conectar()->prepare($sql_max);
                $max_attempts  ->execute();
                $row_max       = $max_attempts->fetch(PDO::FETCH_ASSOC);
                $max_number    = $row_max['max_number'];
                //session error
                $session_error = $session_error + 1;
                //pregunto si el # de intentos es menor a 10
                if($session_error < $max_number){
                    //actualizo el campo date_session
                    $sql_fail       = "UPDATE user SET session_error= ? WHERE user_id= ?";
                    $session_fail   = Conexion::conectar()->prepare($sql_fail);
                    $session_fail   ->execute(array(
                                                    $session_error,
                                                    $user_id
                                                    ));
                    //pregunto si el campo user fue rellenado con un username o un email
                    if($preg_match==1){
                        //no es un email
                        $login_error="The password does not match the Username";
                    }
                    else
                        {
                            //es un email
                            $login_error="The password does not match the E-mail";
                        }
                    //creo la session de error
                    $login_error = $login_error . ", " . $session_error . " try";
                    $_SESSION['login_error'] = $login_error;
                    iniciar_session_error($MM_redirectLoginFailed);

                //si session error no es menor que el numero max permitido
                }else
                //pregunto si el # de intentos es >= a maximo permitido
                if($session_error >= $max_number){
                    //tiempo que el user tiene que esperar para volver a entrar
                    $sql_off       = 'SELECT * FROM time_off';
                    $off_attempts  = Conexion::conectar()->prepare($sql_off);
                    $off_attempts  ->execute();
                    $row_off       = $off_attempts->fetch(PDO::FETCH_ASSOC);
                    $tiempo        = $row_off['wait'];
                    $cantida       = $row_off['quantity'];
                    $esperar       = tiempo_de_espera($tiempo);
                    $mult          = $cantida * $esperar;
                    $Hora          = Time() + $mult;
                    $date_session  = date('Y/m/d H:i:s a',$Hora);
                    //si es igual, actualizo los campos session_error, date_session y session_lock
                    if($session_error == $max_number){
                        $sql_fail       = "UPDATE user SET session_error= ?, date_session= ?, session_lock= ? WHERE user_id= ?";
                        $session_fail   = Conexion::conectar()->prepare($sql_fail);
                        $session_fail   ->execute(array(
                                                        $session_error,
                                                        $date_session,
                                                        1,
                                                        $user_id
                                                        ));
                    }else
                        //si es mayor, actualizo el campo date_session
                        {
                            $sql_fail       = "UPDATE user SET date_session= ? WHERE user_id= ?";
                            $session_fail   = Conexion::conectar()->prepare($sql_fail);
                            $session_fail   ->execute(array(
                                                            $date_session,
                                                            $user_id
                                                            ));
                        }
                    //creo la session de error
                    $_SESSION['login_intentos'] = "It has exceeded the maximum number ( ".$max_number." ) of attempts allowed <br/> Account blocked for " . date('H:i:s',$mult);
                    iniciar_session_error($MM_redirectLoginFailed);
                }*/
                iniciar_session_error($MM_redirectLoginFailed);
            }
    }//si no se encontro un user, es por que los datos introduccidos son incorrectos
    else
        {
            //pregunto si el campo user fue rellenado con un username o un email
            if($preg_match==1){
                //no es un email
                $login_do_not="This Username is not registered in our database";
            }
            else
                {
                    //es un email
                    $login_do_not="This E-mail is not registered in our database";
                }
            //creo la session de error
            $_SESSION['login_do_not']=$login_do_not;
            iniciar_session_error($MM_redirectLoginFailed);
        }
}


?>
