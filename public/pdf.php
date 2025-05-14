<?php
// public/pdf.php

// Cargar el autoloader de Composer
require_once __DIR__ . '/../vendor/autoload.php';

use App\PDFGenerator;

// Instanciar el generador de PDF (en este ejemplo, PDFGenerator utiliza Dompdf internamente)
$pdfGenerator = new PDFGenerator();

// Contenido HTML que se convertirá en PDF
$html = '
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>PDF generado con Dompdf</title>
    <style>
        body { font-family: Arial, sans-serif; }
        h1 { color: #007bff; }
        p  { font-size: 1rem; }
    </style>
</head>
<body>
    <h1>Hola, PDF generado con Dompdf!</h1>
    <p>Este PDF se ha generado a partir de HTML usando Dompdf y PDFGenerator.</p>
</body>
</html>
';

// Generar el contenido PDF a partir del HTML
$pdfOutput = $pdfGenerator->generateFromHtml($html);

// Configurar las cabeceras para que el navegador interprete la respuesta como PDF
header('Content-Type: application/pdf');
header('Content-Disposition: inline; filename="documento.pdf"');

// Mostrar el PDF generado
echo $pdfOutput;