<?php
// public/pdf.php

// Incluir el autoloader de Composer (asegúrate de haberlo generado con "composer install")
require_once __DIR__ . '/../vendor/autoload.php';

use App\PDFGenerator;

// En Windows, especifica la ruta completa al binario wkhtmltopdf.
// Verifica que la ruta exista en tu sistema.
$wkhtmltopdfPath = "C:\\Program Files\\wkhtmltopdf\\bin\\wkhtmltopdf.exe";

$pdfGenerator = new PDFGenerator($wkhtmltopdfPath);

// Contenido HTML a convertir en PDF.
$html = '
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>PDF Test</title>
    <style>
        body { font-family: Arial, sans-serif; }
        h1 { color: #007bff; }
    </style>
</head>
<body>
    <h1>Hola, PDF generado correctamente!</h1>
    <p>Este PDF se generó a partir de HTML usando Knp\Snappy.</p>
</body>
</html>
';

// Configurar las cabeceras para que el navegador interprete la respuesta como PDF.
header('Content-Type: application/pdf');
header('Content-Disposition: inline; filename="test.pdf"');

// Mostrar el PDF generado.
echo $pdfGenerator->generateFromHtml($html);