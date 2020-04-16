<?php
function root_path(){$this_directory = dirname(__FILE__);$archivos=scandir($this_directory);$atras="";$cuenta=0;while(true){foreach($archivos as $actual){if($actual=="root.path"){if($cuenta==0)return "./";return $atras;}}$cuenta++;$atras=$atras."../";$archivos=scandir($atras);}}$nivel=root_path();//fin funcion nivel
require_once($nivel.'model/class.php');
require_once($nivel.'php/exit.php');
require_once($nivel.'php/user.php');
require_once($nivel.'extenciones/PHPMailer/PHPMailerAutoload.php');

/*/////////////////////////////carga///////////////////////////////*/

if (!empty($_GET)) {
	@$escuela              = $_GET['escuela'];
  	@$cuatrimestre         = $_GET['cuatrimestre'];

  	$conf_email = system::MostrarRegistro("conf_email");

	$where = ' WHERE `id_esc`='.$escuela.' AND `ciclo`= "'.$cuatrimestre.'"';

	$reporte = system::MostrarDISTINCT("id_faci","reporte",$where);


	foreach ($reporte as $key => $value) {

		$id_faci 	= $value['id_faci'];

		$where 		= " WHERE `id_faci`=".$id_faci;

		$facilitador= system::EjecutarConsulta("reporte",$where);

		$html ='<div style="width:100%; background:#eee; position:relative; font-family:sans-serif; padding-bottom:40px">

					<center>

						<img style="padding:20px; width:40%;text-align:center;" src="http://www.uapa.edu.do/wp-content/uploads/logo-azul.png">

					</center>

					<div style="position:relative; margin:auto; width:600px; background:white; padding:20px">

						<center>

						<img style="padding:20px; width:15%" src="http://tutorialesatualcance.com/tienda/icon-email.png">

						<h3 style="font-weight:100; color:#999">HORARIO DE ASIGNATURAS</h3>

						<hr style="border:1px solid #ccc; width:80%">

						<table style="border-spacing: 0;width: 100%;text-align: center;">
	                      <thead>
	                        <tr style="border-collapse: separate !important;">
	                          <th  style="padding: 8px;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">Clave</th>
	                          <th  style="padding: 8px;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">Descripción</th>
	                          <th  style="padding: 8px;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">Sección</th>
	                          <th  style="padding: 8px;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">Aula</th>
	                          <th  style="padding: 8px;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">Dia</th>
	                          <th  style="padding: 8px;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">Hi</th>
	                          <th  style="padding: 8px;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">Hf</th>
	                          <th  style="padding: 8px;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">Facilitador</th>
	                        </tr>
	                      </thead>
	                      <tbody>';

		foreach ($facilitador as $key => $value) {

		$html .= '<tr>
                    <td  style="padding: 8px;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">'.$value['clave_comp'].'</td>
                    <td  style="padding: 8px;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">'.ConsultarDescripAulas($value['clave_comp']).'</td>
                    <td  style="padding: 8px;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">'.$value['seccion'].'</td>
                    <td  style="padding: 8px;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">'.$value['aula'].'</td>
                    <td  style="padding: 8px;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">'.Dia($value['dia']).'</td>
                    <td  style="padding: 8px;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">'.$value['hi'].'</td>
                    <td  style="padding: 8px;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">'.$value['hf'].'</td>
                    <td  style="padding: 8px;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">'.system::NombreFacilitadores($value['id_faci'] ).'</td>
                  </tr>';

		}

		$html .= '</tbody>
            </table>';

            date_default_timezone_set("America/Santo_Domingo");

			$mail = new PHPMailer(true);

			$mail->IsSMTP(); // telling the class to use SMTP
			$mail->SMTPAuth = true; // enable SMTP authentication
			$mail->SMTPSecure = $conf_email[0]['smtpsecure']; // sets the prefix to the servier
			$mail->Host = $conf_email[0]['host']; // sets GMAIL as the SMTP server
			$mail->Port = $conf_email[0]['port']; // set the SMTP port for the GMAIL server
			$mail->Username = $conf_email[0]['username']; // GMAIL username elisareyes@uapa.edu.do
			$mail->Password = $conf_email[0]['password']; // GMAIL password agrimensura1234

			$mail->CharSet = 'UTF-8';
			//$mail->isMail();
			$mail->setFrom($conf_email[0]['setfrom'], $conf_email[0]['asunto']);
			//si deseas que te respondan usas addReplyTo
			$mail->addReplyTo($conf_email[0]['setfrom'], $conf_email[0]['asunto']);
			$mail->Subject = $conf_email[0]['subject'];
			$mail->addAddress(ConsultarEmail($id_faci));
			$mail->msgHTML($html);
			$envioEmail = $mail->Send();

			if($envioEmail){

				$msj = "email-enviado";

			}else{

				$msj = "error-envio-email";

			}
	}

	header("location:../reporte/".$msj);

}
?>
