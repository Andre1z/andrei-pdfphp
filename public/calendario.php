<?php
// public/calendario.php

// Incluir el autoloader (ya sea el de Composer o tu autoloader personalizado)
require_once __DIR__ . '/../vendor/autoload.php';
// Si usas un autoloader personalizado:
// require_once __DIR__ . '/../autoload.php';

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
    // Llamar al método que genera los calendarios
    echo CalendarGenerator::generateCalendars(2025, 2050);
    ?>
</body>
</html>