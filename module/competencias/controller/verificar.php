<?php
function root_path(){$this_directory = dirname(__FILE__);$archivos=scandir($this_directory);$atras="";$cuenta=0;while(true){foreach($archivos as $actual){if($actual=="root.path"){if($cuenta==0)return "./";return $atras;}}$cuenta++;$atras=$atras."../";$archivos=scandir($atras);}}$nivel=root_path();//fin funcion nivel
require_once($nivel.'model/class.php');
require_once($nivel.'php/exit.php');
require_once($nivel.'php/user.php');

//verifico si la clave esta registrada
if(isset($_POST['verificar'])){
    
    $clave                  = $_POST['verificar'];
    $id_faci                = $_POST['id_faci'];
    
    //funcion para verificar si la clave esta disponible y si es correcta
    echo ConsultarClave($clave,$id_faci);
}

//registro la competencia al facilitador
if(isset($_POST['clave'])){
    
    $id_faci             = $_POST['id_faci'];
    $clave               = strtoupper($_POST['clave']);

    if (ConsultarClave($clave,$id_faci) == 3 ) {
       
        

        $competencia            = Conexion::conectar()->prepare("INSERT INTO `compfacili`(`clave_comp`, `id_faci`) VALUES (?,?)");
        $competencia            ->execute(array($clave, $id_faci));
        $competencias           = $competencia->fetchAll(PDO::FETCH_ASSOC);
        
        echo "Registrado Correctamente";
        //($_POST['clave'] > 0)? '1' : '0';

    } else {
        echo "Clave Incorrecta!";
    }
    
    
}

?>
