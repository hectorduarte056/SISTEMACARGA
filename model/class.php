<?php
require_once 'conexion.php';
require_once $nivel.'php/function.php';
class System {
	/**
	* Consultar Todos los registro de una tabla X
	*/

static public function NombreFacilitadores($id_faci){
		$idf              = Conexion::conectar()->prepare("SELECT nom_faci, apell_faci FROM `facilitadores` WHERE `id_faci`=?");
        $idf              ->execute(array($id_faci));
        $idfs             = $idf->fetchAll(PDO::FETCH_ASSOC);
        $totalRows_idfs   = count($idfs);
        $row_idfs         = array_shift($idfs);

        return $row_idfs['nom_faci']." ".$row_idfs['apell_faci'];
	}

	
	static public function EscuelaPresentar($id_esc1){
		$idf              = Conexion::conectar()->prepare("SELECT des_esc FROM `escuela` WHERE `id_esc`=?");
        $idf              ->execute(array($id_esc1));
        $idfs             = $idf->fetchAll(PDO::FETCH_ASSOC);
        $totalRows_idfs   = count($idfs);
        $row_idfs         = array_shift($idfs);

        return $row_idfs['des_esc'];
	}

	static public function MostrarRegistro($tabla)
	{
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

		$stmt ->execute();

		return $stmt-> fetchAll();

		$stmt -> close();

		$stmt =null;
	}

	/**
	* Consultar Todos los registro de una tabla X
	*/
	static public function MostrarDISTINCT($campo,$tabla,$where)
	{
		$stmt = Conexion::conectar()->prepare("SELECT DISTINCT $campo FROM $tabla $where");//SELECT DISTINCT `ciclo` FROM `carga`

		$stmt ->execute();

		return $stmt-> fetchAll();

		$stmt -> close();

		$stmt =null;
	}

	/**
	* Consultar Todos los registro de una tabla X
	*/
	static public function EjecutarConsulta($tabla,$where)
	{
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla $where");

		$stmt ->execute();

		return $stmt-> fetchAll();

		$stmt -> close();

		$stmt =null;
	}
	
	static public function EjecutarSql($sql)
	{
		$stmt = Conexion::conectar()->prepare("$sql");

		$stmt ->execute();

		$stmt = null;
		
		
	}

	static public function EjecutarSqlResult($sql)
	{
		$stmt = Conexion::conectar()->prepare("$sql");

		$stmt ->execute();

		return $stmt-> fetchAll();

		$stmt = null;
		
		
	}
	/**
	* Cargar Archivo de Excel
	*/
	static public function CargarArchivo($archivo)
	{
		

		//directorio donde guardamos el archivo
		$dir_subida = './';

		$fichero_subido = $dir_subida . basename($_FILES['fichero_usuario']['name']);

		//ver cual es la extension del archivo
		$valores = explode(".", $_FILES['fichero_usuario']['name']);


		//preguntamos si el archivo es de Excel
		if ($valores[1] == "xlsx") {
		
			//movemos el archivo y preguntamos si fue subido correctamente.
			 if (move_uploaded_file($_FILES['fichero_usuario']['tmp_name'], $fichero_subido)) {
						
						//llamamos la libreria para leer el archivo de excel
						require_once '../../extenciones/simplexlsx.class.php';

						//pasamos el archivo a la funcion SimpleXLSX
						$xlsx = new SimpleXLSX( $_FILES['fichero_usuario']['name'] );


						//Insertamos los datos en la tabla
						$stmt = Conexion::conectar()->prepare( "INSERT INTO carga (id_esc,ciclo, clave, seccion, aula, dia, hi, hf, carga_esc) VALUES (?, ?, ?, ?, ?, ?, ?, ?,?)");
						
						
						$stmt->bindParam( 1, $_POST['escuela']);
						$stmt->bindParam( 2, $_POST['ciclo']);
						$stmt->bindParam( 3, $clave);
						$stmt->bindParam( 4, $seccion);
						$stmt->bindParam( 5, $aula);
						$stmt->bindParam( 6, $dia);
						$stmt->bindParam( 7, $hi);
						$stmt->bindParam( 8, $hf);
						$stmt->bindParam( 9, $carga_esc);
						
						$num = 1;
						//con el ciclo foreach recorremos los datos que contiene el archivo de excel
						foreach ($xlsx->rows(1) as $fields)
						{
							if ($num > 1) {

							   $clave 	= trim($fields[0]);
							   $seccion = trim($fields[1]);
							   $aula 	= trim($fields[2]);
							   $dia 	= NumDia(strtolower($fields[3]));
							   $hi 		= trim($fields[4]);
							   $hf 		= trim($fields[5]);
							   $carga_esc = trim($fields[6]);

							   $stmt->execute();
							}
						  $num++; 
						}

					 $msj = "<div class='alert alert-success'>El fichero es válido y se subió con éxito.</div>";

				} else {
					 $msj = "<div class='alert alert-warning'>¡Posible ataque de subida de ficheros!</div>";
				}

			}else{
				 $msj = "<div class='alert alert-danger'>¡Tipo de Archivo NO PERMITIDO!</div>";
			}
			unlink("../../module/carga/".$_FILES['fichero_usuario']['name']);

			return $msj;

			header("location:system/carga./");
	
		}// END CargarArchivo


	
	/**
	* Cargar Archivo de Excel
	*/
	static public function CargarArchivoAsignaturas($escuela,$archivo){
		

		//directorio donde guardamos el archivo
		$dir_subida = './';
		$fichero_subido = $dir_subida . basename($_FILES['fichero_usuario']['name']);

		//ver cual es la extension del archivo
		$valores = explode(".", $_FILES['fichero_usuario']['name']);


		//preguntamos si el archivo es de Excel
		if ($valores[1] == "xlsx") {
		
			//movemos el archivo y preguntamos si fue subido correctamente.
			 if (move_uploaded_file($_FILES['fichero_usuario']['tmp_name'], $fichero_subido)) {
						
						//llamamos la libreria para leer el archivo de excel
						require_once '../../../extenciones/simplexlsx.class.php';

						//pasamos el archivo a la funcion SimpleXLSX
						$xlsx = new SimpleXLSX( $_FILES['fichero_usuario']['name'] );
						
						//Insertamos los datos en la tabla
						$stmt = Conexion::conectar()->prepare( "INSERT INTO competencias (`id_esc`,`clave_comp`, `desc_comp`, `prere_comp`) VALUES (?,?,?,?)");
						
						$stmt->bindParam( 1, $escuela);
						$stmt->bindParam( 2, $clave);
						$stmt->bindParam( 3, $descri);
						$stmt->bindParam( 4, $prere_comp);
						
						//con el ciclo foreach recorremos los datos que contiene el archivo de excel
						$num = 1;
						foreach ($xlsx->rows() as $fields)
						{
							
							if (VerificarClave($fields[0]) == 1) {
								
								if ($num > 1) {
									if (!empty($fields[0])) {
										
											$clave 			= trim($fields[0]);
										   	$descri 		= trim($fields[1]);
										   	$prere_comp 	= trim($fields[2]);
										   	$stmt->execute();
									} 						
								
								}

							} 
						   	
						   	$num++;
						}



					 $msj = "<div class='alert alert-success'>El fichero es válido y se subió con éxito.</div>";

				} else {
					 $msj = "<div class='alert alert-warning'>¡Posible ataque de subida de ficheros!</div>";
				}

		}else{
			 $msj = "<div class='alert alert-danger'>¡Tipo de Archivo NO PERMITIDO!</div>";
		}
		

		unlink("../../../module/admin/asignaturas/".$_FILES['fichero_usuario']['name']) ;

		return $msj;
		header("location:./");

	}// END CargarArchivo



	/**
	* Asignacion de Facilitadores
	*/
	static public function AsignacionFacilitadores($idcarga,$id_esc,$ciclo,$clave,$seccion,$aula,$dia,$hi,$hf,$carga_esc){

		$idf              = Conexion::conectar()->prepare("SELECT * FROM `compfacili` WHERE `clave_comp`=?");
        $idf              ->execute(array($clave));
        $idfs             = $idf->fetchAll(PDO::FETCH_ASSOC);
        $totalRows_idfs   = count($idfs);
        $row_idfs         = array_shift($idfs);
        $p = "";
        $msj ="";

       //consultamos los facilitadores que pueden dar esa asignatura
        do{
        	if ($totalRows_idfs > 0) {
        		
        		//facilitador que tiene esa clave
	        	$id_faci = $row_idfs['id_faci'];

	        	$horario              = Conexion::conectar()->prepare("SELECT * FROM `facilihorario` WHERE `id_faci`=? AND `dia`=?");
		        $horario              ->execute(array($id_faci,$dia));
		        $horarios             = $horario->fetchAll(PDO::FETCH_ASSOC);
		        $totalRows_horarioss  = count($horarios);
		        $row_horarioss        = array_shift($horarios);


		        do {

		        	 if ($totalRows_horarioss > 0) {


		        				//pregunto si el facilitador esta disponible a la hora de la materia
		        				if (($row_horarioss['hi'] <= $hi) and ($row_horarioss['hf'] >= $hf) ) {
		        					

		        					$id_faci = $row_horarioss['id_faci'];

		        				
		        					//SELECT * FROM `reporte` WHERE `id_faci`= 3 AND `dia`=1 AND (`hi` BETWEEN '12:00:00' AND '14:00:00') AND (`hf` BETWEEN '12:00:00' AND '14:00:00')

									$ConsulReport              = Conexion::conectar()->prepare("SELECT * FROM `reporte` WHERE `ciclo`=? AND `dia`=? AND (`hi` BETWEEN ? AND ?) AND (`hf` BETWEEN ? AND ?)  AND `id_faci` =?");
									$ConsulReport              ->execute(array($ciclo,$dia,$hi,$hf,$hi,$hf,$id_faci));
									$ConsulReportes            = $ConsulReport->fetchAll(PDO::FETCH_ASSOC);
									$totalRows_ConsulReportes  = count($ConsulReportes);
									$row_ConsulReportes        = array_shift($ConsulReportes);

									if (($totalRows_ConsulReportes == 0) AND ($row_ConsulReportes['id_faci'] != $id_faci)) {
										
										

										if (ConsultarAulas($ciclo,$dia,$hi,$hf,$aula) == 1) {

										  $msj ="<label class='label label-info'>Aula no Disponible</label>";//Aula no Disponible

										} else {
											//inserto si esta disponible el facilitador 
											InsertarRegistos($idcarga,$id_esc,$ciclo,$clave,$seccion,$aula,$dia,$hi,$hf,$carga_esc,$id_faci,$pdo);
											$msj ="<label class='label label-success'>Facilitador Asignado</label>";
										}
										
										
											
									}else {
										$msj ="<label class='label label-info'>Facilitador No Disponible</label>";//si el facilitador no esta disponible ese dia
									}
									
		        					
		        					
		        					
		        				} else {
		        					$msj = "<label class='label label-info'>Hora No Disponible</label>";//hora no disponible
		        				}
		        				
		        				
		        		//http://www.forosdelweb.com/f86/between-entre-dos-horas-702893/

						}else {
							$msj ="<label class='label label-info'>Facilitador No Disponible</label>";//si el facilitador no esta disponible ese dia
							
						}

		        	} while ( $row_horarioss        = array_shift($horarios));
		      

	        } else {
        		 $msj = "<label class='label label-info'>Facilitador No Disponible</label>";//si el facilitador no tiene la clave
        	}

        }while ($row_idfs = array_shift($idfs));
      

       return ($msj) ;
        
	}

	/**
	* Asignacion Estado
	*/
	static public function AsignacionEstado($idcarga,$id_esc,$ciclo,$clave,$seccion,$aula,$dia,$hi,$hf,$carga_esc){

		$idf              = Conexion::conectar()->prepare("SELECT * FROM `compfacili` WHERE `clave_comp`=?");
        $idf              ->execute(array($clave));
        $idfs             = $idf->fetchAll(PDO::FETCH_ASSOC);
        $totalRows_idfs   = count($idfs);
        $row_idfs         = array_shift($idfs);
        $msj ="";

       //consultamos los facilitadores que pueden dar esa asignatura
        do{
        	if ($totalRows_idfs > 0) {
        		
        		//facilitador que tiene esa clave
	        	$id_faci = $row_idfs['id_faci'];

	        	$horario              = Conexion::conectar()->prepare("SELECT * FROM `facilihorario` WHERE `id_faci`=? AND `dia`=?");
		        $horario              ->execute(array($id_faci,$dia));
		        $horarios             = $horario->fetchAll(PDO::FETCH_ASSOC);
		        $totalRows_horarioss  = count($horarios);
		        $row_horarioss        = array_shift($horarios);


		        do {

		        	 if ($totalRows_horarioss > 0) {


		        				//pregunto si el facilitador esta disponible a la hora de la materia
		        				if (($row_horarioss['hi'] <= $hi) and ($row_horarioss['hf'] >= $hf) ) {
		        					

		        					$id_faci = $row_horarioss['id_faci'];

		        				
		        					//SELECT * FROM `reporte` WHERE `id_faci`= 3 AND `dia`=1 AND (`hi` BETWEEN '12:00:00' AND '14:00:00') AND (`hf` BETWEEN '12:00:00' AND '14:00:00')

									$ConsulReport              = Conexion::conectar()->prepare("SELECT * FROM `reporte` WHERE `ciclo`=? AND `dia`=? AND (`hi` BETWEEN ? AND ?) AND (`hf` BETWEEN ? AND ?) AND `id_faci` =?");
									$ConsulReport              ->execute(array($ciclo,$dia,$hi,$hf,$hi,$hf,$id_faci));
									$ConsulReportes            = $ConsulReport->fetchAll(PDO::FETCH_ASSOC);
									$totalRows_ConsulReportes  = count($ConsulReportes);
									$row_ConsulReportes        = array_shift($ConsulReportes);

									if (($totalRows_ConsulReportes == 0) AND ($row_ConsulReportes['id_faci'] != $id_faci)) {
										
										

										if (ConsultarAulas($ciclo,$dia,$hi,$hf,$aula) == 1) {

										  	$msj ="<label class='label label-warning'>Aula no Disponible</label>";//Aula no Disponible

										} else {
											//inserto si esta disponible el facilitador 
											$msj ="<label class='label label-success'>Disponible</label>";
										}
										
										
											
									}else {
										$msj ="<label class='label label-primary'>Facilitador Seleccionado</label>";//si el facilitador no esta disponible ese dia
									}
									
		        					
		        					
		        					
		        				} else {
		        					$msj = "<label class='label label-info'>Hora No Disponible</label>";//hora no disponible
		        				}
		        				
		        				
		        		//http://www.forosdelweb.com/f86/between-entre-dos-horas-702893/

						}else {
							$msj ="<label class='label label-info'>Facilitador No Disponible</label>";//si el facilitador no esta disponible ese dia
							
						}

		        	} while ( $row_horarioss        = array_shift($horarios));
		      

	        } else {
        		 $msj = "<label class='label label-info'>Facilitador No Disponible</label>";//si el facilitador no tiene la clave
        	}

        }while ($row_idfs = array_shift($idfs));
      

       return ($msj) ;
        
	}
	/**
	* Asignacion de Nombre de Facilitadores
	*/
	


	/**
	* Eliminar Facilitadores
	*/
	static public function EliminarFacilitadores($id_faci){

		$stmt = Conexion::conectar()->prepare("DELETE FROM `facilitadores` WHERE `id_faci`= $id_faci");

		$stmt ->execute();

		$stmt =null;

		header("location:./");
	}
/**
	* Eliminar Facilitadores Competencias
	*/
	static public function EliminarFacilitadoresCompetencia($id_faci_comp){

		$stmt = Conexion::conectar()->prepare("DELETE FROM `compfacili` WHERE `id_compfacili`= $id_faci_comp");

		$stmt ->execute();

		$stmt =null;

		header("Refresh:0");
	}

	/**
	* Editar Facilitadores
	*/
	static public function EditarFacilitadores($datos){

		$stmt = Conexion::conectar()->prepare("UPDATE `facilitadores` SET `nom_faci`=:nom_faci,`apell_faci`=:apell_faci,`ced_faci`=:ced_faci,`date_faci`=:date_faci,`sex_faci`=:sex_faci,`tel_faci`=:tel_faci,`tel2_faci`=:tel2_faci,`tel3_faci`=:tel3_faci,`direcc_faci`=:direcc_faci,`ocupa_faci`=:ocupa_faci,`est_civil_faci`=:est_civil_faci,`email_faci`=:email_faci,`stado_faci`=:stado_faci WHERE `id_faci`=:id_faci");

		$stmt -> bindparam(":nom_faci", $datos['nom_faci'], PDO::PARAM_STR);
		$stmt -> bindparam(":apell_faci", $datos['apell_faci'], PDO::PARAM_STR);
		$stmt -> bindparam(":ced_faci", $datos['ced_faci'], PDO::PARAM_STR);
		$stmt -> bindparam(":date_faci", $datos['date_faci'], PDO::PARAM_STR);
		$stmt -> bindparam(":sex_faci", $datos['sex_faci'], PDO::PARAM_STR);
		$stmt -> bindparam(":tel_faci", $datos['tel_faci'], PDO::PARAM_STR);
		$stmt -> bindparam(":tel2_faci", $datos['tel2_faci'], PDO::PARAM_STR);
		$stmt -> bindparam(":tel3_faci", $datos['tel3_faci'], PDO::PARAM_STR);
		$stmt -> bindparam(":direcc_faci", $datos['direcc_faci'], PDO::PARAM_STR);
		$stmt -> bindparam(":ocupa_faci", $datos['ocupa_faci'], PDO::PARAM_STR);
		$stmt -> bindparam(":est_civil_faci", $datos['est_civil_faci'], PDO::PARAM_STR);
		$stmt -> bindparam(":email_faci", $datos['email_faci'], PDO::PARAM_STR);
		$stmt -> bindparam(":stado_faci", $datos['stado_faci'], PDO::PARAM_STR);
		$stmt -> bindparam(":id_faci", $datos['id_faci'], PDO::PARAM_STR);

		if($stmt ->execute())
		{
			return "ok";
		
		}else{

			return "error";

		}

		$stmt -> close();

		$stmt = null;

		
	}

	/**
	* Editar Imagen
	*/
	static public function CargarImagen($foto,$id_faci){

		$foto     = $_POST['old_img'];

      foreach ($_FILES["imagen"]["error"] as $clave => $error) {
        if ($error == UPLOAD_ERR_OK) {
            $nombre_tmp = $_FILES["imagen"]["tmp_name"][$clave];

            crear_carpeta("../../module/banck_img/facilitador_".$id_faci."/");
            sleep(1);
            $url      =  "../../module/banck_img/facilitador_".$id_faci."/".$foto;
            
            @unlink($url); 
            $nombre   = basename($_FILES["imagen"]["name"][$clave]);
            $ext      = pathinfo($nombre, PATHINFO_EXTENSION);
            $foto     = md5($id_faci).$ext;//$ext
            $url      = "../../module/banck_img/facilitador_".$id_faci."/".$foto;
            move_uploaded_file($nombre_tmp, $url);
            sleep(1);
            $alto = '240';
            $ancho= '500';
            $extension= $ext;
            $nombreN= sha1(md5($id_faci));
            
            resizeImagen("../../module/banck_img/facilitador_".$id_faci."/", $foto, $alto, $ancho,$nombreN,$extension);
            @unlink($url); 
        }
      }
      (isset($nombreN))? $foto = $nombreN.".jpg" : $foto;
      $statement   = Conexion::conectar()->prepare("UPDATE `facilitadores` SET `img_faci`=? WHERE `id_faci`=?");
      $statement   ->execute(array($foto,$id_faci));
      
      
		
	}



}// END system


 ?>