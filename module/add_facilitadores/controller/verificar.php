<?php
function root_path(){$this_directory = dirname(__FILE__);$archivos=scandir($this_directory);$atras="";$cuenta=0;while(true){foreach($archivos as $actual){if($actual=="root.path"){if($cuenta==0)return "./";return $atras;}}$cuenta++;$atras=$atras."../";$archivos=scandir($atras);}}$nivel=root_path();//fin funcion nivel
require_once($nivel.'model/class.php');
require_once($nivel.'php/exit.php');
require_once($nivel.'php/user.php');


if(isset($_POST['cedula'])){
    
   $cedula = $_POST['cedula'];
    
    
    $facilitadore          	= Conexion::conectar()->prepare("SELECT COUNT(*) AS registro FROM `facilitadores` WHERE `ced_faci`= ?");
    $facilitadore           ->execute(array($cedula));
    $facilitadores          = $facilitadore->fetchAll(PDO::FETCH_ASSOC);
    $totalRows_facilitadores= count($facilitadores);
    $row_facilitadores = array_shift($facilitadores);
    
    echo ($row_facilitadores['registro'] > 0)? '1' : '0';
}
?>
