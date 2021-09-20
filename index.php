<?php
/*
 Author: Jessica Leonel
 Email: Jessica.leonel.p@gmail.com   
*/

$pagina_principal = 'lists/cliente.php';
?>

<!doctype html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://kit.fontawesome.com/a8b4643699.js" crossorigin="anonymous"></script>
        <link href="public/css/design.css" rel="stylesheet" type="text/css">

        <title>Servidores FCOVOIP</title>

    </head>

    <body onload="abrirPagina('<?php echo $pagina_principal; ?>','contenido','');">
        <nav class="navbar navbar-expand-lg navbar-light bg-light shadow ">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <a class="navbar-brand" href="#" onclick="abrirPagina('./lists/reseller.php','contenido','');">FCOVOIP</a>
                <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#" onclick="abrirPagina('./lists/servidor.php','contenido','');">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " aria-current="page" href="#" onclick="abrirPagina('./lists/cliente.php','contenido','');">Clientes</a>
                        </li>
                    
                        <li class="nav-item">
                            <a class="nav-link" href="#" onclick="abrirPagina('./lists/servidor.php','contenido','');">Servidor</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link " aria-current="page" href="#">Contabilidad</a>    
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " aria-current="page" href="#">Administracion</a>    
                        </li>
                    </ul>
                    <div class="d-flex">
                        <a class="nav-link active text-secondary material-icons me-1" aria-current="page" href="#">
                            <i class="fas fa-power-off"></i> Cerrar sesión
                        </a>
                    </div>
                </div>
            </div>
        </nav>

        <div class="container shadow p-3 mt-3 bg-white rounded">
            <div class="card bg-white border-0">
                <div class="card-body" id="contenido">               
                </div>
            </div>  
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="public/js/libreria.js"></script>
    </body>
</html>
