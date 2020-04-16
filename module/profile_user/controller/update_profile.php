<?php
function root_path(){$this_directory = dirname(__FILE__);$archivos=scandir($this_directory);$atras="";$cuenta=0;while(true){foreach($archivos as $actual){if($actual=="root.path"){if($cuenta==0)return "./";return $atras;}}$cuenta++;$atras=$atras."../";$archivos=scandir($atras);}}$nivel=root_path();//fin funcion nivel
require_once($nivel.'model/class.php');
require_once($nivel.'php/exit.php');
require_once($nivel.'php/user.php');

if(isset($_POST['user_id'])){
    $user_id        = $_POST['user_id'];
    $name           = $_POST['name'];
    $apellido       = $_POST['last_name'];
    $email          = $_POST['email'];
    $sex            = $_POST['sex'];
    
    $profile_user   = "UPDATE `user` SET `name`='".$name."',`last_name`='".$apellido."',`email`='".$email."',`sex`='".$sex."' WHERE `user_id`='".$user_id."'";

    system::EjecutarSql($profile_user);

    header("location:../profile_user/");
}else{
   header("location:../profile_user/");
}

?>