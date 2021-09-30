<?php

require '../vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;
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

<body>
<h1 class="display-6">HOla Hola</h1>
</body>

</html>



<?php
$html=ob_get_clean();
$options = new Options();
$options->set('defaultFont', ' Helvetica');
$options->setIsHtml5ParserEnabled(true);
$options->setLogOutputFile($ruta);


$dompdf = new Dompdf($options);
$dompdf->loadHtml($html);
$dompdf->setPaper('A4');
$dompdf->render();
//$output = $dompdf->output();
//file_put_contents("../public/pdf/Brochure.pdf", $output);
$dompdf->stream('report_'.date("dmYHis"));

?>