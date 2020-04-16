<html>
    <head>
        <title>Asignación De Facilitadores</title>
        <link rel="icon" href="<?php echo $nivel;?>images/consultas_medica.ico" type="image/x-icon"/>
        <link rel="shortcut icon" href="<?php echo $nivel;?>images/consultas_medica.ico" type="image/x-icon"/>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Error!</title>
        <!--
        //////////////////////////////estylo css/////////////////////////
        -->
        <?php include($nivel."module/head/index.php"); ?>
        <!--
          ///////////////////////////END///estylo css/////////////////////////
        -->
        <style>
            .msj{
                margin-top: 100px;
            }
            img{
                width: 25px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                   
                    <div class="alert alert-danger msj" role="alert">
                    
                        <h2 class="text-center">¡ERROR! AL INTENTAR INGRESAR AL SISTEMA, SI ESTA VIENDO ESTE MENSAJE ES PORQUE NO A ADQUIRIDO UNA LICENCIA VALIDA</h2>
                        
                        <hr>
                        <p class="text-center">Si no le permite acceder a su cuenta por favor comunicarse con el administrador</p>
                        <p class="text-center">Email: <a href=""></a> </p>
                        <p class="text-center">Cell: <a href=""><i class="fa fa-whatsapp" aria-hidden="true"></i></a></p>
                        <p class="text-center"><a href="" target="_blank"><i class="fa fa-facebook-official" aria-hidden="true"></i></a></p>
                        
                        <hr>
                        <p class="text-center">Soporte a través de <a href="">TeamViewer</a></p>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>