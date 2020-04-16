<?php
function root_path(){$this_directory = dirname(__FILE__);$archivos=scandir($this_directory);$atras="";$cuenta=0;while(true){foreach($archivos as $actual){if($actual=="root.path"){if($cuenta==0)return "./";return $atras;}}$cuenta++;$atras=$atras."../";$archivos=scandir($atras);}}$nivel=root_path();//fin funcion nivel
require_once($nivel.'model/class.php');
require_once($nivel.'php/exit.php');
require_once($nivel.'php/user.php');

if(isset($_POST["MM_insert"]) AND $_POST["MM_insert"] == "form2"){
    
    
    $name           = $_POST["name"];
    $last_name      = $_POST["last_name"];
    $cedula         = $_POST["cedula"];
    $edad           = $_POST["edad"];
    $sex            = $_POST["sex"];
    $estado_civil   = $_POST["estado_civil"];
    $telefono       = $_POST["telefono"];
    $telefono2      = $_POST["telefono2"];
    $telefono3      = $_POST["telefono3"];
    $email          = $_POST["email"];
    $ocupacion      = $_POST["ocupacion"];
    $address        = $_POST["address"];
    
    
    $add_facilita   = Conexion::conectar()->prepare("INSERT INTO `facilitadores`(`nom_faci`, `apell_faci`, `ced_faci`, `edad_faci`, `sex_faci`, `tel_faci`, `tel2_faci`, `tel3_faci`, `direcc_faci`, `ocupa_faci`, `est_civil_faci`, `email_faci`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)");
    $add_facilita   ->execute(array($name,$last_name,$cedula,$edad,$sex,$telefono,$telefono2,$telefono3,$address,$ocupacion,$estado_civil,$email,'1'));
    $id_facilita    = Conexion::conectar()->lastInsertId();
    
    header("location:../add_salud/".$id_facilita);
}






?>