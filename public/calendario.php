<?php
// public/calendario.php

// Habilitar errores para depuración
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Incluir el autoload generado por Composer
require_once __DIR__ . '/../vendor/autoload.php';

use App\CalendarGenerator;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Calendario 2025-2050</title>
    <link rel="stylesheet" href="css/calendario.css">
</head>
<body>
    <?php
    // Generar y mostrar los calendarios de 2025 a 2050
    echo CalendarGenerator::generateCalendars(2025, 2050);
    ?>
</body>
</html>