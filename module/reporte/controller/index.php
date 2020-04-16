<?php 
function root_path(){$this_directory = dirname(__FILE__);$archivos=scandir($this_directory);$atras="";$cuenta=0;while(true){foreach($archivos as $actual){if($actual=="root.path"){if($cuenta==0)return "./";return $atras;}}$cuenta++;$atras=$atras."../";$archivos=scandir($atras);}}$nivel=root_path();//fin funcion nivel
require_once($nivel.'model/class.php');
require_once($nivel.'php/exit.php');
require_once($nivel.'php/user.php');



if (!empty($_POST['Escuela'])) {
	
	$Escuela = $_POST['Escuela'];

	$where = " WHERE `id_esc` = ".$Escuela;

	$ListarCiclos = system::MostrarDISTINCT("ciclo","reporte",$where);

	var_dump ($ListarCiclos);
 	foreach ($ListarCiclos as $key => $value) {
   		echo '<option value="'.$value['ciclo'].'">'.$value['ciclo'].'</option>';
  	}

} else {
	header("location:".$nivel);
}




 ?>