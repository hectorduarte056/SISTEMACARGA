<?php 
function root_path(){$this_directory = dirname(__FILE__);$archivos=scandir($this_directory);$atras="";$cuenta=0;while(true){foreach($archivos as $actual){if($actual=="root.path"){if($cuenta==0)return "./";return $atras;}}$cuenta++;$atras=$atras."../";$archivos=scandir($atras);}}$nivel=root_path();//fin funcion nivel
require_once($nivel.'model/class.php');
require_once($nivel.'php/exit.php');
require_once($nivel.'php/user.php');



/*/////////////////////////////carga///////////////////////////////*/
if (!empty($_GET)) {
   $escuela              = $_GET['escuela'];
   $cuatrimestre         = $_GET['cuatrimestre'];

	$where = " WHERE `id_esc`=".$escuela." AND `ciclo`='".$cuatrimestre."'";
	$Asignacion = system::EjecutarConsulta("carga",$where);

	foreach ($Asignacion as $key => $value) {

		$msj = system::AsignacionFacilitadores(
		    $value['id_carga'],
		    $value['id_esc'],
		    $value['ciclo'],
		    $value['clave'],
		    $value['seccion'],
		    $value['aula'],
		    $value['dia'],
		    $value['hi'],
			$value['hf'],
			$value['carga_esc'],
		    $pdo
		  );
	                              
	                          
	header("location:../reporte/".$escuela."&".$cuatrimestre);
	}
}
 ?>