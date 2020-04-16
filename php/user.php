<?php
//juego de registro que se encarga de verificar el user que acaba de iniciar seccion

//include("encrypt.php");
//cookies
$cookies_id_enc       = encrypt("idreyorder");
$cookies_user_enc     = encrypt("userreyorder");
$colname_usuarios     = "-1";
$colname_id           = "-1";
if (isset($_SESSION['MM_Username'])){
    $colname_usuarios = $_SESSION['MM_Username'];
    $colname_id       = $_SESSION['MM_Userid'];
    //si el user viene dado por una session
}else
if(isset($_COOKIE[$cookies_user_enc])){
    $cookies_id       = $_COOKIE[$cookies_id_enc];
    $cookies_user     = $_COOKIE[$cookies_user_enc];
    $cookies_id_dec   = decrypt($cookies_id);
    $cookies_user_dec = decrypt($cookies_user);
    //si el user viene dado por una cookie
    $colname_usuarios = $cookies_user_dec;
    $colname_id       = $cookies_id_dec;
}
if(!preg_match("/^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/",$colname_usuarios)){
        //si no es un email
        $usuario="SELECT * FROM user WHERE user_name= ? AND user_id= ?";
    }
    else
        {
            //si es un email
            $usuario="SELECT * FROM user WHERE email= ? AND user_id= ?";
        }
//compruevo el user o el email estan en la BD
$statement = Conexion::conectar()->prepare($usuario);
$statement ->execute(array($colname_usuarios, $colname_id));
$result    = $statement->fetchAll(PDO::FETCH_ASSOC);
$totalRows_usuarios     = count($result);
$row_usuarios = array_shift($result);
if ($totalRows_usuarios > 0) {
$_SESSION['MM_Username']  = $row_usuarios['user_name'];
$_SESSION['MM_UserGroup'] = $row_usuarios['control'];
$_SESSION['MM_Userid']    = $row_usuarios['user_id'];
}
//codigo si se le va adar un tiempo de vida a la session, session inactiva
/*
if ($totalRows_usuarios > 0) {
$tiempo="SELECT * FROM session_inactive";
$tiempos = mysqli_query($barbershop, $tiempo);
$row_tiempos = mysqli_fetch_assoc($tiempos);
if($row_tiempos['s_m_h']=='second'){
    $cuanto ='1';
    $tem    ='Second';
}else
if($row_tiempos['s_m_h']=='minute'){
    $cuanto ='60';
    $tem    ='Minute';
}else
if($row_tiempos['s_m_h']=='hour'){
    $cuanto ='3600';
    $tem    ='Hour';
}else
if($row_tiempos['s_m_h']=='day'){
    $cuanto ='86400';
    $tem    ='Day';
}
$off_times =$row_tiempos['off_times'];
$inactivo  =$cuanto*$off_times;// variable que define el tiempo que el usuario esta inactivo para que lo saque el sistema
//Buscamos la existencia de la variable de session en una condicion, luego en la variable $vida_session almacenamos el resultado de la resta entre la $_SESSION['tiempo'] y el tiempo actual (time).
//Comparamos este resultado ($vida_session) con el tiempo de inactividad que definimos mas arriba, si el resultado es mayor que la variable $inactivo entonces la sesión se destruye y redirecciona a la pagina de  index.
if(isset($_SESSION['tiempo']) ) {
    $vida_session = time() - $_SESSION['tiempo'];
        if($vida_session > $inactivo){
            echo "<script languaje='javascript'>alert (' Inactive Session for over $off_times $tem, back to Login. ');</script>";
			session_destroy();
            $cerrar = $page_home;
            header("Refresh: 0; URL=$cerrar");
            exit();
        }
}
//Caso contrario se actualiza la sesion almacenando el tiempo actual en la variable $_SESSION['tiempo']
$_SESSION['tiempo'] = time();
}
//mysql_free_result($usuarios);extencion obsoleta
*/
?>
