<?php
// Cargar el autoloader de Composer desde la raíz del proyecto.
require_once __DIR__ . '/../vendor/autoload.php';

use App\PDFGenerator;

// Configura la ruta para wkhtmltopdf. En Windows, podría ser algo como:
// $wkhtmltopdfPath = "C:\\Program Files\\wkhtmltopdf\\bin\\wkhtmltopdf.exe";
$wkhtmltopdfPath = '/usr/bin/wkhtmltopdf'; // Ajusta según tu sistema

// Crea una instancia del generador de PDFs
$pdfGenerator = new PDFGenerator($wkhtmltopdfPath);

// Ejemplo: generar un PDF a partir de un HTML simple
$html = '
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>PDF Test</title>
    <style>
        body { font-family: Arial; }
        h1 { color: #007bff; }
    </style>
</head>
<body>
    <h1>Hola, PDF generado correctamente</h1>
    <p>Esto es un PDF generado desde HTML.</p>
</body>
</html>
';

// Configurar cabeceras para PDF
header('Content-Type: application/pdf');
header('Content-Disposition: inline; filename="test.pdf"');

// Imprimir el PDF generado
echo $pdfGenerator->generateFromHtml($html);