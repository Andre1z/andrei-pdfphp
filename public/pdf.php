<?php
// public/pdf.php
require_once __DIR__ . '/../vendor/autoload.php';

use App\PDFGenerator;

// En Windows, asegúrate de que la ruta del ejecutable sea correcta.
$wkhtmltopdfPath = "C:\\Program Files\\wkhtmltopdf\\bin\\wkhtmltopdf.exe";
$pdfGenerator = new PDFGenerator($wkhtmltopdfPath);

$html = '
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>PDF Test</title>
    <link rel="stylesheet" href="css/pdf.css">
</head>
<body>
    <h1>Hola, PDF generado correctamente!</h1>
    <p>Este PDF se ha generado a partir de HTML usando un estilo minimalista y colores vibrantes.</p>
</body>
</html>
';

// Enviar cabeceras para que el navegador interprete la salida como PDF.
header('Content-Type: application/pdf');
header('Content-Disposition: inline; filename="documento.pdf"');

// Mostrar el PDF generado.
echo $pdfGenerator->generateFromHtml($html);
?>