<?php
session_name("admin");
session_start();

if ($_SESSION['en_session']) {
    header("Location: index.php");
}
?>
<html>
    <head>
        <title>Servidores FCOVOIP</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
        <script src="https://kit.fontawesome.com/a8b4643699.js" crossorigin="anonymous"></script>
        <link href="./varios/css/login.css" rel="stylesheet" type="text/css"></link>
    </head>
    <body>
        <div class="wrapper fadeInDown">
                    
            <?php
                $error= filter_input(INPUT_GET, "error",FILTER_SANITIZE_STRING);
                if($error!=""){       
            ?>    
                <div class="float-end me-5 mt-5 alert alert-danger alert-dismissible fade show" role="alert" >
                <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                    <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                    </symbol>
                </svg>
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                    Acceso no autorizado.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" tabindex="-1"></button>
                </div>   
            <?php
            }
            ?>

            <div id="formContent" class="row position-absolute top-50 start-50 translate-middle bg-light shadow p-3 mb-3 bg-body rounded">
                <!-- Tabs Titles -->
                <div class="m-2 p-2">  
                <!-- Icon -->
                    <div class="m-2 p-2 d-flex justify-content-center">
                        <h1> Iniciar sesión </h1>
                    <!-- <img src="http://danielzawadzki.com/codepen/01/icon.svg" id="icon" alt="User Icon" />-->
                    </div>

                    <!-- Login Form -->
                    <form class="me-2 p-2" action="process/login.process.php" method="post">
                        <div class="mt-2 p-2">
                            <input type="text" id="login" class="form-control" name="email" placeholder="email">
                        </div>
                        <div class="mt-2 mb-2 p-2">
                            <input type="password" id="password" class="form-control" name="clave" placeholder="password">
                        </div>
                        <div class="mb-2 p-2 d-flex justify-content-center">
                            <input type="submit" class="btn btn-info pe-5 ps-5" value="Ingresar">
                        </div>
                    </form>

                </div> 
            </div>
            
        </div>
        

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

        <script src="js/libreria.js"></script>

    </body>
</html>
