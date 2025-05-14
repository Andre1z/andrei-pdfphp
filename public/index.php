<?php
// public/index.php

// Cargar el autoloader de Composer para que las clases estén disponibles en el proyecto
require_once __DIR__ . '/../vendor/autoload.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Página de Inicio - PDF Calendario</title>
    <!-- Enlaza el estilo específico para la página principal -->
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
    <h1>Bienvenido a PDF Calendario</h1>
    <nav>
        <ul>
            <li><a href="calendario.php">Ver Calendario</a></li>
            <li><a href="pdf.php">Generar PDF</a></li>
        </ul>
    </nav>
    <p>Aquí puedes ver el calendario o generar un PDF a partir de contenido HTML.</p>
</body>
</html>