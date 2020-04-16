<?php
function root_path(){$this_directory = dirname(__FILE__);$archivos=scandir($this_directory);$atras="";$cuenta=0;while(true){foreach($archivos as $actual){if($actual=="root.path"){if($cuenta==0)return "./";return $atras;}}$cuenta++;$atras=$atras."../";$archivos=scandir($atras);}}$nivel=root_path();//fin funcion nivel
require_once($nivel.'model/class.php');
require_once($nivel.'php/exit.php');
require_once($nivel.'php/user.php');

//verifico si la clave esta registrada
if(isset($_POST['verificar'])){
    
    $clave                  = $_POST['verificar'];
    
    //funcion para verificar si la clave esta disponible y si es correcta
    echo VerificarClave($clave);
}


?>
