<?php
function root_path(){$this_directory = dirname(__FILE__);$archivos=scandir($this_directory);$atras="";$cuenta=0;while(true){foreach($archivos as $actual){if($actual=="root.path"){if($cuenta==0)return "./";return $atras;}}$cuenta++;$atras=$atras."../";$archivos=scandir($atras);}}$nivel=root_path();//fin funcion nivel
require_once($nivel.'model/class.php');
require_once($nivel.'php/exit.php');
require_once($nivel.'php/user.php');

if (isset($_POST["form"]) AND $_POST["form"] = "success") {
  $name         = $_POST["name"];
  $user         = $_POST["user"];
  $email        = $_POST["email2"];
  $pass         = $_POST["pass"];
  $pass2        = $_POST["pass2"];

  $user_valid   = comprobar_nombre_usuario($user);
  $email_valid  = comprobar_email($email);

  if ($pass === $pass2 AND $user_valid === 1 AND $email_valid === 1) {
    
      $password  = sha1(md5($salt.$pass));

      $users = "INSERT INTO `user`(`user_name`, `name`, `password`, `email`, `control`, `statu`) VALUES ('".$user."','".$name."','".$password."','".$email."','user',1)";
      
      system::EjecutarSql($users);
     
      header("location:../user/4");

  }else {

    header("location:../user/5");

  }

}else {

  header("location:".$nivel);

}
 ?>
