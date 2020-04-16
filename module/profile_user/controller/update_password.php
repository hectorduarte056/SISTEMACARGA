<?php
function root_path(){$this_directory = dirname(__FILE__);$archivos=scandir($this_directory);$atras="";$cuenta=0;while(true){foreach($archivos as $actual){if($actual=="root.path"){if($cuenta==0)return "./";return $atras;}}$cuenta++;$atras=$atras."../";$archivos=scandir($atras);}}$nivel=root_path();//fin funcion nivel
require_once($nivel.'model/class.php');
require_once($nivel.'php/exit.php');
require_once($nivel.'php/user.php');


if(!empty($_POST['pass_actual'])){
    $pass_concat        =$salt.$_POST['pass_actual'];
    $pass_actual        =sha1(md5($pass_concat));
    
    $pass_nueva         = $_POST['pass_nueva'];
    $pass_confir        = $_POST['pass_confir'];
    $id_admin           = $_POST['id_user'];
    
    $pas_new            = "SELECT count(*) AS contador FROM user WHERE user_id='".$id_admin."' AND password='".$pass_actual."'";

    $row_count          = system::EjecutarSqlResult($pas_new);


    if($row_count[0]['contador'] != 0){
        
        if($pass_nueva == $pass_confir){

            $pass       = sha1(md5($salt.$_POST['pass_confir']));
       
            $pas_new     = "UPDATE `user` SET `password`='".$pass."' WHERE `user_id`='".$id_admin."'";

            system::EjecutarSql($pas_new);

                header("location:../profile_user/1");//La contraceña Fue Actualizada Correctamente
            
         }else{
               header("location:../profile_user/2");//La contraceña Nueva No Coinciden
              }
    }else{
            header("location:../profile_user/3");//La contraceña Actual No Coinciden
        }
        
}else{
    header("location:../profile_user/");
}

?>